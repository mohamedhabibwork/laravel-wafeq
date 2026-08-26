<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Payslips;

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /payslips/{id}/` — Partial update payslip.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/payslips_partial_update.md`. The `PatchedPayslip` schema
 * contains the same read-write fields as `Payslip` but without the
 * top-level `required` array, so every field is optional here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `branch`          string|null        — branch reference
 *   - `currency`        enum               — ISO currency code
 *   - `employee`        string             — employee reference
 *   - `exchange_rate`   number|null        — FX to base currency
 *   - `external_id`     string(255)        — caller-provided id
 *   - `language`        enum (default en)  — ar | en
 *   - `pay_items`       array              — nested PayItem list
 *   - `payslip_date`    date               — yyyy-mm-dd
 *   - `payslip_number`  string             — unique payslip number
 *   - `status`          enum (default DRAFT) — DRAFT | POSTED
 *
 * Nested `PayItem` payload (each entry of `pay_items`, when supplied):
 *
 *   - `account`     required string  — chart-of-accounts id
 *   - `amount`      required number  — monetary amount
 *   - `cost_center` string|null      — cost-center reference
 *   - `description` required string  — line description
 *
 * Server-managed (`readOnly`) properties such as `id`, `amount`,
 * `balance`, `created_ts`, `modified_ts`, `legacy_id` are intentionally
 * **not** validated.
 */
class PartialUpdatePayslipRequest extends WafeqFormRequest
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
            // Optional branch association.
            'branch' => ['nullable', 'string'],

            // ISO-4217 currency code. Full enum is enforced via the
            // Currency enum cast on the DTO; this rule keeps the wire
            // value as a non-empty string when supplied.
            'currency' => ['nullable', 'string'],

            // The employee to whom the payslip belongs.
            'employee' => ['nullable', 'string'],

            // FX rate to the organisation's base currency at the
            // document date — null when not applicable.
            'exchange_rate' => ['nullable', 'numeric'],

            // External (caller-managed) identifier for idempotency.
            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],

            // Language for printable payslip copy (ar | en). Full
            // enum is enforced via the Language41a cast on the DTO.
            'language' => ['nullable', 'string'],

            // Nested list of pay items (optional on PATCH; when
            // supplied the array elements are still validated as
            // complete PayItem records).
            'pay_items' => ['sometimes', 'array'],

            // Each PayItem entry's chart-of-accounts id.
            'pay_items.*.account' => ['required', 'string'],

            // Each PayItem entry's unit amount.
            'pay_items.*.amount' => ['required', 'numeric'],

            // Each PayItem entry's optional cost center.
            'pay_items.*.cost_center' => ['nullable', 'string'],

            // Each PayItem entry's line description.
            'pay_items.*.description' => ['required', 'string'],

            // Date when the payslip was issued (ISO-8601 yyyy-mm-dd).
            'payslip_date' => ['nullable', 'date_format:Y-m-d'],

            // Unique number assigned to the payslip.
            'payslip_number' => ['nullable', 'string'],

            // DRAFT | POSTED — defaults to DRAFT when omitted.
            'status' => ['sometimes', 'string', 'in:DRAFT,POSTED'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'branch' => 'branch',
            'currency' => 'currency',
            'employee' => 'employee',
            'exchange_rate' => 'exchange rate',
            'external_id' => 'external id',
            'language' => 'language',
            'pay_items' => 'pay items',
            'pay_items.*.account' => 'pay item account',
            'pay_items.*.amount' => 'pay item amount',
            'pay_items.*.cost_center' => 'pay item cost center',
            'pay_items.*.description' => 'pay item description',
            'payslip_date' => 'payslip date',
            'payslip_number' => 'payslip number',
            'status' => 'status',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return PayslipData::class;
    }
}
