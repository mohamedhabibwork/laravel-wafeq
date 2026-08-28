<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\Data;

/**
 * Base class for every Wafeq FormRequest.
 *
 * Each concrete request:
 *
 *   1. Maps the OpenAPI schema in `wafeq-docs/<resource>_<action>.md`
 *      into Laravel validation rules via `rules()`.
 *   2. Returns the matching Spatie Data DTO class via `dto()`.
 *   3. Exposes a `toDto()` shortcut that materialises the DTO from the
 *      validated payload in one call.
 *
 * The base class intentionally does NOT call `validateResolved()` itself
 * — Laravel's FormRequest pipeline does that before this class is
 * constructed, so by the time `validated()` is reachable the data has
 * already been merged, validated, and made available through the usual
 * `$this->input`, `$this->validated()` etc. APIs.
 */
abstract class WafeqFormRequest extends FormRequest
{
    /**
     * Authorise the request. The package ships with auth-open resources;
     * callers can override `authorize()` in their subclass or supply
     * a custom FormRequest of their own that extends this base.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * The Spatie Data DTO class that this request materialises.
     *
     * @return class-string<Data>
     */
    abstract public function dto(): string;

    /**
     * Materialise the matching DTO from the validated payload.
     *
     * Wire-format keys are already snake_case; the package's
     * `SnakeCaseMapper` configuration handles the bidirectional
     * translation, so callers receive a fully-populated DTO.
     *
     * @return Data The concrete DTO subtype declared by the subclass.
     */
    public function toDto(): Data
    {
        /** @var class-string<Data> $dto */
        $dto = $this->dto();

        return $dto::from($this->validated());
    }
}
