<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Expenses;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /expenses/` — Create expense.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/expenses_create.md`. Every property whose `description`
 * appears in that document is exposed here with the matching rule set.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `account`              required string  — the expense account
 *   - `amount`               required number  — monetary amount
 *   - `attachments`          array<string>    — file/document ids
 *   - `branch`               string|null      — branch reference
 *   - `contact`              string|null      — contact reference
 *   - `cost_center`          string|null      — cost-center reference
 *   - `currency`             required enum    — ISO currency code
 *   - `date`                 required date    — incurred-on date
 *   - `description`          required string  — human description
 *   - `exchange_rate`        number|null      — FX to base currency
 *   - `external_id`          string(255)      — caller-provided id
 *   - `paid_through_account` required string  — payment source account
 *   - `project`              string|null      — project reference
 *   - `reference`            string           — internal reference code
 *   - `tax_amount_type`      enum (default TAX_INCLUSIVE)
 *   - `tax_rate`             string|null      — tax-rate reference
 *
 * Server-managed (`readOnly`) properties such as `id`, `status`,
 * `created_ts`, `modified_ts`, `legacy_id` are intentionally **not**
 * validated — they are returned by the API and must never be
 * client-sent.
 */
class CreateExpenseRequest extends WafeqFormRequest
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
            // The account (typically a chart-of-accounts id) the expense posts to.
            'account' => ['required', 'string'],

            // Monetary amount of the expense.
            'amount' => ['required', 'numeric'],

            // Ids of files / documents attached to this expense.
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            // Optional branch association.
            'branch' => ['nullable', 'string'],

            // Optional contact (vendor / payee) association.
            'contact' => ['nullable', 'string'],

            // Optional cost-center tagging.
            'cost_center' => ['nullable', 'string'],

            // ISO-4217 currency code. Full enum is enforced via the
            // Currency enum cast on the DTO; this rule keeps the wire
            // value as a non-empty string.
            'currency' => ['required', 'string'],

            // Date the expense was incurred (ISO-8601 yyyy-mm-dd).
            'date' => ['required', 'date_format:Y-m-d'],

            // Human-readable description shown on reports.
            'description' => ['required', 'string'],

            // FX rate to the organisation's base currency at the
            // document date — null when not applicable.
            'exchange_rate' => ['nullable', 'numeric'],

            // External (caller-managed) identifier for idempotency.
            'external_id' => ['nullable', 'string', 'max:255'],

            // Source account the expense was paid through.
            'paid_through_account' => ['required', 'string'],

            // Optional project tagging.
            'project' => ['nullable', 'string'],

            // Optional internal reference / doc number.
            'reference' => ['nullable', 'string'],

            // TAX_INCLUSIVE | TAX_EXCLUSIVE — defaults to TAX_INCLUSIVE
            // when the field is omitted.
            'tax_amount_type' => ['sometimes', 'string', 'in:TAX_INCLUSIVE,TAX_EXCLUSIVE'],

            // Optional tax-rate reference.
            'tax_rate' => ['nullable', 'string'],
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

    /**
     * Convenience accessor — returns a fully-hydrated {@see ExpenseData}.
     */
    public function toDto(): Data
    {
        return parent::toDto();
    }
}
