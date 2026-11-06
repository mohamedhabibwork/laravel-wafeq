<?php

namespace HWafeq\LaravelWafeq\Testing;

use GuzzleHttp\Promise\PromiseInterface;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Default responses for every Wafeq ZATCA endpoint, used by {@see ZatcaFake}.
 *
 * Responses are derived from the request so tests read naturally: a
 * reported document echoes its `document_number`, `reference` and
 * `metadata`, validation computes totals from the line items, and a
 * registered device belongs to the request's branch / connected account.
 *
 * @internal
 */
final class ZatcaFakeResponder
{
    private const HTTP_OK = 200;

    private const HTTP_CREATED = 201;

    private const HTTP_ACCEPTED = 202;

    private const HTTP_NO_CONTENT = 204;

    private const HTTP_NOT_FOUND = 404;

    private const PERCENT = 100;

    /**
     * @param  array<string, mixed>  $overrides  Responses keyed by path pattern relative to `/zatca/`.
     */
    public function __construct(private readonly array $overrides = []) {}

    /**
     * Respond to a ZATCA request, or return `null` for any other URL.
     */
    public function __invoke(Request $request): ?PromiseInterface
    {
        $path = self::zatcaPath($request);

        if ($path === null) {
            return null;
        }

        foreach ($this->overrides as $pattern => $response) {
            if (self::matches($request, $path, (string) $pattern)) {
                return self::toResponse(is_callable($response) ? $response($request) : $response);
            }
        }

        return $this->respond($request, $path);
    }

    /**
     * The request path relative to `/zatca/` (e.g. `simplified-invoices/report/`),
     * or `null` when the request is not a ZATCA call.
     */
    public static function zatcaPath(Request $request): ?string
    {
        $base = rtrim((string) config('wafeq.zatca.base_url', 'https://api.wafeq.com/v1'), '/').'/zatca/';
        $url = strtok($request->url(), '?') ?: '';

        return str_starts_with($url, $base) ? substr($url, strlen($base)) : null;
    }

    /**
     * Whether an override pattern (`[METHOD ]path`, `*` wildcards) matches.
     */
    private static function matches(Request $request, string $path, string $pattern): bool
    {
        if (preg_match('/^(GET|POST|PUT|PATCH|DELETE)\s+(.+)$/i', $pattern, $parts) === 1) {
            return strtoupper($parts[1]) === $request->method() && Str::is(ltrim($parts[2], '/'), $path);
        }

        return Str::is(ltrim($pattern, '/'), $path);
    }

    private static function toResponse(mixed $response): PromiseInterface
    {
        return $response instanceof PromiseInterface
            ? $response
            : Http::response(is_array($response) ? $response : (string) $response, self::HTTP_OK);
    }

    private function respond(Request $request, string $path): PromiseInterface
    {
        $segments = array_values(array_filter(explode('/', $path), static fn (string $segment): bool => $segment !== ''));
        $collection = $segments[0] ?? '';

        return match (true) {
            $collection === 'usage' => Http::response(ZatcaFake::usage()),
            $collection === 'connected-accounts' => $this->connectedAccounts($request, $segments),
            $collection === 'devices' => $this->devices($request, $segments),
            ZatcaDocumentType::tryFrom($collection) !== null => $this->documents($request, $segments),
            default => Http::response(['detail' => "No ZATCA fake for [{$request->method()} {$path}]."], self::HTTP_NOT_FOUND),
        };
    }

    /**
     * @param  list<string>  $segments
     */
    private function documents(Request $request, array $segments): PromiseInterface
    {
        $action = $segments[1] ?? null;
        $method = $request->method();

        return match (true) {
            $action === null => Http::response(ZatcaFake::page()),
            $action === 'report' => Http::response($this->documentFrom($request->data(), 'REPORTED'), self::HTTP_CREATED),
            $action === 'issue' => Http::response($this->documentFrom($request->data(), 'QUEUED'), self::HTTP_ACCEPTED),
            $action === 'validate' => Http::response($this->validation($request->data())),
            $action === 'bulk-validate' => Http::response(array_map(fn (mixed $item): array => $this->validation((array) $item), $request->data())),
            $action === 'bulk-issue' => Http::response(array_map(fn (mixed $item): array => $this->documentFrom((array) $item, 'QUEUED'), $request->data()), self::HTTP_ACCEPTED),
            $action === 'bulk-report' => Http::response(array_map(fn (mixed $item): array => $this->summaryFrom((array) $item), $request->data()), self::HTTP_ACCEPTED),
            ($segments[2] ?? null) === 'download' => $this->download($request),
            ($segments[2] ?? null) === 'retry' => Http::response(ZatcaFake::document('REPORTED', ['document' => ['id' => $action]])),
            ($segments[2] ?? null) === 'send' => Http::response(ZatcaFake::document('REPORTED', ['document' => ['id' => $action], 'sent_ts' => now()->toIso8601String()])),
            $method === 'PATCH' => Http::response(ZatcaFake::document('REPORTED', ['document' => ['id' => $action], 'metadata' => array_filter((array) ($request['metadata'] ?? []), static fn (mixed $value): bool => $value !== null)])),
            default => Http::response(ZatcaFake::document('REPORTED', ['document' => ['id' => $action]])),
        };
    }

    /**
     * @param  list<string>  $segments
     */
    private function devices(Request $request, array $segments): PromiseInterface
    {
        $id = $segments[1] ?? null;
        $scope = [
            'branch' => $request->header('X-ZATCA-Branch')[0] ?? '',
            'connected_account' => $request->header('X-ZATCA-Connected-Account-Id')[0] ?? null,
        ];

        return match (true) {
            $id === null => Http::response(ZatcaFake::page()),
            $id === 'register' => Http::response(ZatcaFake::device('active', [
                ...$scope,
                'id' => 'zdev_'.self::shortHash((string) ($request['common_name'] ?? '')),
                'common_name' => (string) ($request['common_name'] ?? ''),
            ])),
            ($segments[2] ?? null) === 'revoke' => Http::response(ZatcaFake::device('revoked', [...$scope, 'id' => $id])),
            default => Http::response(ZatcaFake::device('active', [...$scope, 'id' => $id])),
        };
    }

    /**
     * @param  list<string>  $segments
     */
    private function connectedAccounts(Request $request, array $segments): PromiseInterface
    {
        $id = $segments[1] ?? null;

        return match (true) {
            $id === null && $request->method() === 'GET' => Http::response(ZatcaFake::page()),
            $id === null => Http::response(ZatcaFake::connectedAccount([
                ...$request->data(),
                'id' => 'ca_'.self::shortHash((string) ($request['tax_registration_number'] ?? '')),
            ]), self::HTTP_CREATED),
            $request->method() === 'DELETE' => Http::response(null, self::HTTP_NO_CONTENT),
            default => Http::response(ZatcaFake::connectedAccount([...$request->data(), 'id' => $id])),
        };
    }

    private function download(Request $request): PromiseInterface
    {
        parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

        return ($query['type'] ?? 'pdf') === 'xml'
            ? Http::response('<?xml version="1.0" encoding="UTF-8"?><Invoice/>', self::HTTP_OK, ['Content-Type' => 'application/xml'])
            : Http::response('%PDF-1.7 fake', self::HTTP_OK, ['Content-Type' => 'application/pdf']);
    }

    /**
     * @param  array<array-key, mixed>  $body
     * @return array<string, mixed>
     */
    private function documentFrom(array $body, string $status): array
    {
        $document = (array) ($body['document'] ?? []);
        $number = (string) ($document['document_number'] ?? 'DOC-1');

        return ZatcaFake::document($status, [
            'document' => [
                'id' => 'zdoc_'.self::shortHash($number),
                'document_number' => $number,
                'supply_date' => $document['supply_date'] ?? null,
            ],
            'reference' => (string) ($body['reference'] ?? ''),
            'metadata' => (array) ($body['metadata'] ?? []),
            'reported_ts' => $status === 'REPORTED' ? now()->toIso8601String() : null,
        ]);
    }

    /**
     * @param  array<array-key, mixed>  $body
     * @return array<string, mixed>
     */
    private function summaryFrom(array $body): array
    {
        $detail = $this->documentFrom($body, 'QUEUED');

        return [
            'created_ts' => $detail['created_ts'],
            'document' => ['id' => $detail['document']['id'], 'document_number' => $detail['document']['document_number']],
            'reported_ts' => null,
            'sent_ts' => null,
            'status' => 'QUEUED',
        ];
    }

    /**
     * Totals computed from the line items (tax-exclusive amounts).
     *
     * @param  array<array-key, mixed>  $body
     * @return array<string, mixed>
     */
    private function validation(array $body): array
    {
        $document = (array) ($body['document'] ?? []);
        $net = 0.0;
        $tax = 0.0;

        foreach ((array) ($document['line_items'] ?? []) as $line) {
            $line = (array) $line;
            $amount = (float) ($line['quantity'] ?? 0) * (float) ($line['unit_price'] ?? 0);
            $net += $amount;
            $tax += $amount * (float) ($line['tax']['percent'] ?? 0) / self::PERCENT;
        }

        return [
            'document_number' => (string) ($document['document_number'] ?? ''),
            'currency' => (string) ($document['currency'] ?? 'SAR'),
            'issue_datetime' => now()->toIso8601String(),
            'customer' => $document['customer'] ?? null,
            'channels' => (array) ($body['channels'] ?? []),
            'provided_tax_total' => $document['tax_total'] ?? null,
            'calculated_total_amount_net' => round($net, 2),
            'calculated_total_amount_tax' => round($tax, 2),
            'calculated_total_amount_gross' => round($net + $tax, 2),
            'calculated_payable_amount_net' => round($net, 2),
            'calculated_payable_amount_tax' => round($tax, 2),
            'calculated_payable_amount_gross' => round($net + $tax, 2),
            'calculated_prepaid_amount_net' => 0.0,
            'calculated_prepaid_amount_tax' => 0.0,
            'calculated_prepaid_amount_gross' => 0.0,
        ];
    }

    private static function shortHash(string $value): string
    {
        return substr(sha1($value), 0, 12);
    }
}
