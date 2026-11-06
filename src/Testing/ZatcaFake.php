<?php

namespace HWafeq\LaravelWafeq\Testing;

use GuzzleHttp\Promise\PromiseInterface;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaEnvironment;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Assert;

/**
 * Offline fake for the Wafeq ZATCA API, for your application's tests.
 *
 * ```php
 * use HWafeq\LaravelWafeq\Testing\ZatcaFake;
 *
 * ZatcaFake::fake();                                   // every endpoint succeeds
 * ZatcaFake::fake([                                     // or override specific endpoints
 *     'simplified-invoices/report/' => ZatcaFake::validationError('Invalid VAT number.', 'document.supplier'),
 * ]);
 *
 * // … run the code under test …
 *
 * ZatcaFake::assertReported(ZatcaDocumentType::SimplifiedInvoice, fn (array $body) => $body['document']['document_number'] === 'INV-1');
 * ZatcaFake::assertSentToEnvironment(ZatcaEnvironment::Simulation);
 * ```
 *
 * Override keys are paths relative to `/zatca/`, optionally prefixed with
 * an HTTP method (`'PATCH invoices/*'`), with `*` wildcards. Values can be
 * an array (200 JSON), an `Http::response(…)`, or a callable receiving the
 * {@see Request}. Non-ZATCA requests fall through to your other fakes.
 */
final class ZatcaFake
{
    private const HTTP_BAD_REQUEST = 400;

    private const HTTP_FORBIDDEN = 403;

    private const HTTP_FAILED_DEPENDENCY = 424;

    private const HTTP_TOO_MANY_REQUESTS = 429;

    private const HTTP_SERVER_ERROR = 500;

    private const FAKE_QR_CODE = 'AQxGYWtlIFN1cHBsaWVyAg8zMDAwMDAwMDAwMDAwMDM=';

    /**
     * @param  array<string, mixed>  $overrides
     */
    public static function fake(array $overrides = []): void
    {
        $responder = new ZatcaFakeResponder($overrides);

        // Http::fake() only treats closures as dynamic responders.
        Http::fake(static fn (Request $request): ?PromiseInterface => $responder($request));
    }

    /**
     * A `detail-read` document body.
     *
     * @param  array<string, mixed>  $overrides  Merged recursively (e.g. `['document' => ['id' => 'x']]`).
     * @return array<string, mixed>
     */
    public static function document(string $status = 'REPORTED', array $overrides = []): array
    {
        $now = now()->toIso8601String();

        return array_replace_recursive([
            'created_ts' => $now,
            'document' => [
                'id' => 'zdoc_fake',
                'document_number' => 'DOC-1',
                'issue_datetime' => $now,
                'supply_date' => now()->toDateString(),
            ],
            'metadata' => [],
            'qr_code_data' => self::FAKE_QR_CODE,
            'reference' => '',
            'reported_ts' => $status === 'REPORTED' ? $now : null,
            'response' => ['validationResults' => ['status' => 'PASS']],
            'sent_ts' => null,
            'status' => $status,
        ], $overrides);
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    public static function device(string $status = 'active', array $overrides = []): array
    {
        return [
            'id' => 'zdev_fake',
            'common_name' => 'Fake device',
            'branch' => '',
            'connected_account' => null,
            ...$overrides,
            'status' => $status,
        ];
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    public static function connectedAccount(array $overrides = []): array
    {
        return [
            'id' => 'ca_fake',
            'name' => 'Fake Customer',
            'address' => 'King Fahd Road',
            'city' => 'Riyadh',
            'country' => 'SA',
            'business_category' => 'Retail',
            'tax_registration_number' => '300000000000003',
            ...$overrides,
        ];
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    public static function usage(array $overrides = []): array
    {
        return [
            'available' => 1000,
            'balance' => 'OK',
            'debt' => 0,
            'enforced' => false,
            'exempt' => false,
            'simulation' => true,
            'extras_available' => 0,
            'included_available' => 1000,
            'included_expires_ts' => null,
            'packs_available' => 0,
            'term_allowance' => null,
            'term_consumed' => 0,
            'term_reserved' => 0,
            'term_starts_ts' => null,
            'term_ends_ts' => null,
            'next_term_allowance' => null,
            'next_term_starts_ts' => null,
            ...$overrides,
        ];
    }

    /**
     * A paginated list body.
     *
     * @param  array<int, array<string, mixed>>  $results
     * @return array<string, mixed>
     */
    public static function page(array $results = []): array
    {
        return ['count' => count($results), 'next' => null, 'previous' => null, 'results' => $results];
    }

    /**
     * 400: the payload failed validation or ZATCA business rules.
     */
    public static function validationError(string $detail, ?string $attribute = null, string $code = 'invalid'): PromiseInterface
    {
        return self::errorResponse('validation_error', $code, $detail, $attribute, self::HTTP_BAD_REQUEST);
    }

    /**
     * 424: Wafeq accepted the document but ZATCA rejected reporting / clearance.
     */
    public static function submissionError(string $detail = 'ZATCA reporting failed.', string $code = 'zatca_error'): PromiseInterface
    {
        return self::errorResponse('client_error', $code, $detail, null, self::HTTP_FAILED_DEPENDENCY);
    }

    /**
     * 403: no active device for this environment / branch / connected account.
     */
    public static function noActiveDevice(string $detail = 'No active device found.'): PromiseInterface
    {
        return Http::response(['attr' => null, 'code' => 'permission_denied', 'detail' => $detail], self::HTTP_FORBIDDEN);
    }

    public static function rateLimited(int $retryAfterSeconds = 1): PromiseInterface
    {
        return Http::response(['detail' => 'Request was throttled.'], self::HTTP_TOO_MANY_REQUESTS, ['Retry-After' => (string) $retryAfterSeconds]);
    }

    public static function serverError(string $detail = 'Unexpected error.'): PromiseInterface
    {
        return self::errorResponse('server_error', 'error', $detail, null, self::HTTP_SERVER_ERROR);
    }

    /**
     * Every recorded ZATCA request, optionally filtered.
     *
     * @param  (callable(Request, string): bool)|null  $filter  Receives the request and its path relative to `/zatca/`.
     * @return Collection<int, Request>
     */
    public static function recorded(?callable $filter = null): Collection
    {
        return Http::recorded()
            ->map(static fn (array $pair): Request => $pair[0])
            ->filter(static function (Request $request) use ($filter): bool {
                $path = ZatcaFakeResponder::zatcaPath($request);

                return $path !== null && ($filter === null || $filter($request, $path));
            })
            ->values();
    }

    /**
     * Assert a document of the given type was reported (or issued).
     *
     * @param  (callable(array<array-key, mixed>, Request): bool)|null  $callback  Receives the request body.
     */
    public static function assertReported(ZatcaDocumentType $type, ?callable $callback = null): void
    {
        Assert::assertTrue(
            self::reportRequests($type, ['report', 'issue', 'bulk-report', 'bulk-issue'], $callback)->isNotEmpty(),
            "No [{$type->value}] document was reported to ZATCA.",
        );
    }

    /**
     * Assert a simplified document was issued (asynchronous reporting).
     *
     * @param  (callable(array<array-key, mixed>, Request): bool)|null  $callback
     */
    public static function assertIssued(ZatcaDocumentType $type, ?callable $callback = null): void
    {
        Assert::assertTrue(
            self::reportRequests($type, ['issue', 'bulk-issue'], $callback)->isNotEmpty(),
            "No [{$type->value}] document was issued to ZATCA.",
        );
    }

    public static function assertNotReported(ZatcaDocumentType $type): void
    {
        Assert::assertTrue(
            self::reportRequests($type, ['report', 'issue', 'bulk-report', 'bulk-issue'])->isEmpty(),
            "A [{$type->value}] document was unexpectedly reported to ZATCA.",
        );
    }

    public static function assertNothingReported(): void
    {
        foreach (ZatcaDocumentType::cases() as $type) {
            self::assertNotReported($type);
        }
    }

    /**
     * @param  (callable(array<array-key, mixed>, Request): bool)|null  $callback
     */
    public static function assertDeviceRegistered(?callable $callback = null): void
    {
        $matches = self::recorded(static fn (Request $request, string $path): bool => $request->method() === 'POST'
            && $path === 'devices/register/'
            && ($callback === null || $callback($request->data(), $request)));

        Assert::assertTrue($matches->isNotEmpty(), 'No ZATCA device was registered.');
    }

    /**
     * Assert every scoped ZATCA request targeted the given environment.
     */
    public static function assertSentToEnvironment(ZatcaEnvironment $environment): void
    {
        $scoped = self::recorded(static fn (Request $request): bool => $request->hasHeader('X-ZATCA-Environment'));

        Assert::assertTrue($scoped->isNotEmpty(), 'No environment-scoped ZATCA request was sent.');
        Assert::assertTrue(
            $scoped->every(static fn (Request $request): bool => $request->header('X-ZATCA-Environment') === [$environment->value]),
            "Not every ZATCA request targeted the [{$environment->value}] environment.",
        );
    }

    /**
     * Assert at least one ZATCA request was made on behalf of the connected account.
     */
    public static function assertSentForConnectedAccount(string $connectedAccountId): void
    {
        Assert::assertTrue(
            self::recorded(static fn (Request $request): bool => $request->header('X-ZATCA-Connected-Account-Id') === [$connectedAccountId])->isNotEmpty(),
            "No ZATCA request was sent for connected account [{$connectedAccountId}].",
        );
    }

    /**
     * @param  list<string>  $actions
     * @param  (callable(array<array-key, mixed>, Request): bool)|null  $callback
     * @return Collection<int, Request>
     */
    private static function reportRequests(ZatcaDocumentType $type, array $actions, ?callable $callback = null): Collection
    {
        $paths = array_map(static fn (string $action): string => "{$type->value}/{$action}/", $actions);

        return self::recorded(static fn (Request $request, string $path): bool => $request->method() === 'POST'
            && in_array($path, $paths, true)
            && ($callback === null || $callback($request->data(), $request)));
    }

    private static function errorResponse(string $type, string $code, string $detail, ?string $attribute, int $status): PromiseInterface
    {
        return Http::response([
            'type' => $type,
            'errors' => [['code' => $code, 'detail' => $detail, 'attr' => $attribute]],
            'metadata' => null,
        ], $status);
    }
}
