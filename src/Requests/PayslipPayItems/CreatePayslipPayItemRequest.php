<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\PayslipPayItems;

use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /payslips/{payslip_id}/pay-items/` — Create pay item.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/payslips_pay_items_create.md`. Every property whose
 * `description` appears in that document is exposed here with the
 * matching rule set.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `account`     required string  — chart-of-accounts id
 *   - `amount`      required number  — monetary amount
 *   - `cost_center` string|null      — cost-center reference
 *   - `description` required string  — line description
 *
 * Server-managed (`readOnly`) properties such as `id`, `created_ts`,
 * `modified_ts`, `legacy_id` are intentionally **not** validated —
 * they are returned by the API and must never be client-sent.
 */
class CreatePayslipPayItemRequest extends WafeqFormRequest
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
            'account' => ['required', 'string'],

            // Monetary amount of the pay item.
            'amount' => ['required', 'numeric'],

            // Optional cost-center tagging.
            'cost_center' => ['nullable', 'string'],

            // Human-readable description for the pay item line.
            'description' => ['required', 'string'],
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
