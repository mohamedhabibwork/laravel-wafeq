<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\BankAccounts;

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /bank-accounts/{id}/` — Update bank account.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/bank_accounts_update.md`. The schema is identical to the
 * create endpoint, so the ruleset matches `CreateBankAccountRequest`.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `currency`            required string  — ISO-4217 currency code
 *   - `name`                required string  — display name
 *   - `sub_classification`  required enum    — BANK | PETTY_CASH | CREDIT_CARD
 *
 * Server-managed (`readOnly`) properties such as `id`, `account`,
 * `classification`, `created_ts`, `modified_ts`, `legacy_id` are
 * intentionally **not** validated.
 */
class UpdateBankAccountRequest extends WafeqFormRequest
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
            // ISO-4217 currency code.
            'currency' => ['required', 'string'],

            // Bank-account display name.
            'name' => ['required', 'string'],

            // BankAccountSubClassificationEnum: BANK | PETTY_CASH | CREDIT_CARD
            'sub_classification' => ['required', 'string', 'in:BANK,PETTY_CASH,CREDIT_CARD'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'currency' => 'currency',
            'name' => 'name',
            'sub_classification' => 'sub classification',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return BankAccountData::class;
    }
}
