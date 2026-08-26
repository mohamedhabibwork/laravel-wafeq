<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Beneficiaries;

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /beneficiaries/{id}/` — Partial update beneficiary.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/beneficiaries_partial_update.md`. The
 * `Patchedapi-v1-external-beneficiary-read-write` schema has no
 * top-level `required` array, so every read-write field is optional
 * here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `address`      string           — beneficiary full address
 *   - `bank_name`    string(200)      — bank name
 *   - `charge_type`  enum             — OUR | BEN | SHA
 *   - `contacts`     array<string>    — contact ids
 *   - `country`      enum             — ISO-3166 two-letter code
 *   - `currency`     enum             — ISO-4217 currency code
 *   - `iban`         string(34)       — IBAN
 *   - `name`         string           — beneficiary name
 *   - `swift`        string(11)       — SWIFT/BIC code
 *
 * Server-managed (`readOnly`) properties such as `id`, `created_ts`,
 * `modified_ts`, `legacy_id` are intentionally **not** validated.
 */
class PartialUpdateBeneficiaryRequest extends WafeqFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            // Beneficiary full address.
            'address' => ['nullable', 'string'],

            // Name of the bank holding the beneficiary account.
            'bank_name' => ['nullable', 'string', 'max:200'],

            // ChargeTypeEnum: OUR | BEN | SHA
            'charge_type' => ['nullable', 'string', 'in:OUR,BEN,SHA'],

            // Optional list of associated contact ids.
            'contacts' => ['sometimes', 'array'],
            'contacts.*' => ['string'],

            // ISO-3166 two-letter country code.
            'country' => ['nullable', 'string'],

            // ISO-4217 currency code.
            'currency' => ['nullable', 'string'],

            // International Bank Account Number (IBAN).
            'iban' => ['nullable', 'string', 'max:34'],

            // Beneficiary name.
            'name' => ['nullable', 'string'],

            // SWIFT/BIC code.
            'swift' => ['nullable', 'string', 'max:11'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'address' => 'address',
            'bank_name' => 'bank name',
            'charge_type' => 'charge type',
            'contacts' => 'contacts',
            'contacts.*' => 'contact',
            'country' => 'country',
            'currency' => 'currency',
            'iban' => 'IBAN',
            'name' => 'name',
            'swift' => 'SWIFT code',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return BeneficiaryData::class;
    }
}
