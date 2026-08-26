<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\BankLedgerTransactions;

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /bank-accounts/{bank_account_id}/ledger-transactions/`
 * — Create bank ledger transaction.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/bank_accounts_ledger_transactions_create.md`.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `account`     required string  — account the transaction posts to
 *   - `amount`      required number  — monetary amount
 *   - `contact`     string|null      — optional contact ref
 *   - `date`        required date    — transaction date (yyyy-mm-dd)
 *   - `description` string           — human description
 *   - `project`     string|null      — optional project ref
 *   - `reference`   string           — transaction reference / id
 *   - `tax_rate`    string|null      — optional tax-rate ref
 *
 * Server-managed (`readOnly`) properties such as `bank_account`,
 * `created_ts`, `id`, `is_manual`, `legacy_id`, `modified_ts` are
 * intentionally **not** validated.
 */
class CreateBankLedgerTransactionRequest extends WafeqFormRequest
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
            // Account the transaction posts to.
            'account' => ['required', 'string'],

            // Monetary amount of the transaction (double-precision).
            'amount' => ['required', 'numeric'],

            // Optional contact (customer / supplier) reference.
            'contact' => ['nullable', 'string'],

            // Transaction date in ISO-8601 (yyyy-mm-dd).
            'date' => ['required', 'date_format:Y-m-d'],

            // Human-readable transaction description.
            'description' => ['nullable', 'string'],

            // Optional project reference.
            'project' => ['nullable', 'string'],

            // Transaction reference / identifier.
            'reference' => ['nullable', 'string'],

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
            'contact' => 'contact',
            'date' => 'date',
            'description' => 'description',
            'project' => 'project',
            'reference' => 'reference',
            'tax_rate' => 'tax rate',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return BankLedgerTransactionData::class;
    }
}
