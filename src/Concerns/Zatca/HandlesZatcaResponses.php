<?php

namespace HWafeq\LaravelWafeq\Concerns\Zatca;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Exceptions\ZatcaSubmissionException;
use HWafeq\LaravelWafeq\Exceptions\ZatcaValidationException;
use Illuminate\Http\Client\Response;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * Response plumbing for the Wafeq ZATCA API.
 *
 * Reuses {@see HandlesResponses} and layers the ZATCA-specific error
 * envelope (`{type, errors: [{code, detail, attr}], metadata}`) on top:
 * 400 becomes {@see ZatcaValidationException} and 424 becomes
 * {@see ZatcaSubmissionException}. Every other status is handled by the
 * shared guard.
 *
 * ZATCA mutations are never sent with an idempotency key: the API does
 * not document one, and reporting is not safely repeatable.
 */
trait HandlesZatcaResponses
{
    use HandlesResponses {
        guardResponse as guardWafeqResponse;
    }

    private const HTTP_BAD_REQUEST = 400;

    private const HTTP_FAILED_DEPENDENCY = 424;

    protected function guardResponse(Response $response): void
    {
        if ($response->successful()) {
            return;
        }

        $context = [
            'body' => $response->json(),
            'headers' => $response->headers(),
            'errors' => $this->zatcaErrorList($response),
        ];

        match ($response->status()) {
            self::HTTP_BAD_REQUEST => throw new ZatcaValidationException(
                $this->errorMessage($response),
                $response->status(),
                $context,
            ),
            self::HTTP_FAILED_DEPENDENCY => throw new ZatcaSubmissionException(
                $this->errorMessage($response),
                $response->status(),
                $context,
            ),
            default => $this->guardWafeqResponse($response),
        };
    }

    protected function errorMessage(Response $response): string
    {
        $first = $this->zatcaErrorList($response)[0] ?? null;

        if (is_array($first) && isset($first['detail']) && is_string($first['detail'])) {
            $attribute = isset($first['attr']) && is_string($first['attr']) ? " ({$first['attr']})" : '';

            return $first['detail'].$attribute;
        }

        $body = $response->json();

        if (is_array($body) && isset($body['detail']) && is_string($body['detail'])) {
            return $body['detail'];
        }

        return "Wafeq ZATCA request failed with status {$response->status()}.";
    }

    /**
     * Hydrate a response into a DTO.
     *
     * Unlike the shared implementation, no default-currency fill is
     * applied: ZATCA DTOs carry no `#[WithCurrency]` properties, and the
     * fill would cost an extra `GET /organization/` call against the
     * accounting API, which a ZATCA-only API key may not be allowed to use.
     *
     * @template T of Data
     *
     * @param  class-string<T>  $dataClass
     * @return T
     */
    protected function toData(Response $response, string $dataClass): Data
    {
        $this->guardResponse($response);

        return $dataClass::from($response->json() ?? []);
    }

    /**
     * Hydrate a JSON array response into a collection of DTOs.
     *
     * @template T of Data
     *
     * @param  class-string<T>  $itemClass
     * @return DataCollection<int, T>
     */
    protected function toCollection(Response $response, string $itemClass): DataCollection
    {
        $this->guardResponse($response);

        $items = $response->json();

        return new DataCollection($itemClass, is_array($items) ? $items : []);
    }

    /**
     * @return array<int, mixed>
     */
    private function zatcaErrorList(Response $response): array
    {
        $errors = $response->json('errors');

        return is_array($errors) && array_is_list($errors) ? $errors : [];
    }
}
