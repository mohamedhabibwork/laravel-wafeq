<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Expenses;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /expenses/{id}/` — Partial update expense.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/expenses_partial_update.md`. The `PatchedExpense` schema
 * defines no `required` array, so every field is treated as optional —
 * clients only send the keys they want to mutate.
 *
 * The endpoint's request body shape (read-write fields, all optional):
 *
 *   - `account`              string  — the expense account
 *   - `amount`               number  — monetary amount
 *   - `attachments`          array<string> — file/document ids
 *   - `branch`               string|null   — branch reference
 *   - `contact`              string|null   — contact reference
 *   - `cost_center`          string|null   — cost-center reference
 *   - `currency`             string        — ISO currency code
 *   - `date`                 date          — incurred-on date
 *   - `description`          string        — human description
 *   - `exchange_rate`        number|null   — FX to base currency
 *   - `external_id`          string(255)   — caller-provided id
 *   - `paid_through_account` string        — payment source account
 *   - `project`              string|null   — project reference
 *   - `reference`            string        — internal reference code
 *   - `tax_amount_type`      enum          — TAX_INCLUSIVE|TAX_EXCLUSIVE
 *   - `tax_rate`             string|null   — tax-rate reference
 *
 * Server-managed (`readOnly`) properties such as `id`, `status`,
 * `created_ts`, `modified_ts`, `legacy_id` are intentionally **not**
 * validated — they are returned by the API and must never be
 * client-sent.
 */
class PartialUpdateExpenseRequest extends WafeqFormRequest
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
            'account' => ['sometimes', 'string'],

            'amount' => ['sometimes', 'numeric'],

            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            'branch' => ['sometimes', 'nullable', 'string'],

            'contact' => ['sometimes', 'nullable', 'string'],

            'cost_center' => ['sometimes', 'nullable', 'string'],

            'currency' => ['sometimes', 'string'],

            'date' => ['sometimes', 'date_format:Y-m-d'],

            'description' => ['sometimes', 'string'],

            'exchange_rate' => ['sometimes', 'nullable', 'numeric'],

            'external_id' => ['sometimes', 'string', 'max:255'],

            'paid_through_account' => ['sometimes', 'string'],

            'project' => ['sometimes', 'nullable', 'string'],

            'reference' => ['sometimes', 'string'],

            'tax_amount_type' => ['sometimes', 'string', 'in:TAX_INCLUSIVE,TAX_EXCLUSIVE'],

            'tax_rate' => ['sometimes', 'nullable', 'string'],
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
            'attachments' => 'attachments',
            'branch' => 'branch',
            'contact' => 'contact',
            'cost_center' => 'cost center',
            'currency' => 'currency',
            'date' => 'date',
            'description' => 'description',
            'exchange_rate' => 'exchange rate',
            'external_id' => 'external id',
            'paid_through_account' => 'paid through account',
            'project' => 'project',
            'reference' => 'reference',
            'tax_amount_type' => 'tax amount type',
            'tax_rate' => 'tax rate',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ExpenseData::class;
    }
}
