<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\PayslipPayItems;

use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /payslips/{payslip_id}/pay-items/{id}/` —
 * Partial update pay item.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/payslips_pay_items_partial_update.md`. The `PatchedPayItem`
 * schema contains the same read-write fields as `PayItem` but without
 * the top-level `required` array, so every field is optional here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `account`     string       — chart-of-accounts id
 *   - `amount`      number       — monetary amount
 *   - `cost_center` string|null  — cost-center reference
 *   - `description` string       — line description
 *
 * Server-managed (`readOnly`) properties such as `id`, `created_ts`,
 * `modified_ts`, `legacy_id` are intentionally **not** validated.
 */
class PartialUpdatePayslipPayItemRequest extends WafeqFormRequest
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
            // The account (typically a chart-of-accounts id) the pay
            // item posts to.
            'account' => ['nullable', 'string'],

            // Monetary amount of the pay item.
            'amount' => ['nullable', 'numeric'],

            // Optional cost-center tagging.
            'cost_center' => ['nullable', 'string'],

            // Human-readable description for the pay item line.
            'description' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'account' => 'account',
            'amount' => 'amount',
            'cost_center' => 'cost center',
            'description' => 'description',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return PayslipPayItemData::class;
    }
}
