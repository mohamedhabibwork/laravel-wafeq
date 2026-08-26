<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\BankStatementTransactions;

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for
 * `PATCH /bank-accounts/{bank_account_id}/statement-transactions/{id}/`
 * — Partial update bank statement transaction.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/bank_accounts_statement_transactions_partial_update.md`.
 * The `PatchedBankStatementTransaction` schema has no top-level
 * `required` array, so every read-write field is optional here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `amount`            number           — statement amount
 *   - `bank_reference`    string           — bank's reference id
 *   - `cost_center`       string|null      — optional cost-center ref
 *   - `date`              date             — statement date (yyyy-mm-dd)
 *   - `description`       string           — transaction description
 *   - `project`           string|null      — optional project ref
 *   - `reference`         string           — internal reference
 *   - `statement_balance` number           — bank-reported balance
 *
 * Server-managed (`readOnly`) properties such as `bank_account`,
 * `calculated_balance`, `created_ts`, `id`, `is_posted`, `legacy_id`,
 * `modified_ts` are intentionally **not** validated.
 */
class PartialUpdateBankStatementTransactionRequest extends WafeqFormRequest
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
            // Statement amount (double-precision).
            'amount' => ['nullable', 'numeric'],

            // Reference id assigned by the bank.
            'bank_reference' => ['nullable', 'string'],

            // Optional cost-center reference.
            'cost_center' => ['nullable', 'string'],

            // Statement date in ISO-8601 (yyyy-mm-dd).
            'date' => ['nullable', 'date_format:Y-m-d'],

            // Transaction description.
            'description' => ['nullable', 'string'],

            // Optional project reference.
            'project' => ['nullable', 'string'],

            // Internal reference.
            'reference' => ['nullable', 'string'],

            // Balance reported by the bank after this transaction.
            'statement_balance' => ['nullable', 'numeric'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'amount' => 'amount',
            'bank_reference' => 'bank reference',
            'cost_center' => 'cost center',
            'date' => 'date',
            'description' => 'description',
            'project' => 'project',
            'reference' => 'reference',
            'statement_balance' => 'statement balance',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return BankStatementTransactionData::class;
    }
}
