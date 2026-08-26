<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\BankAccounts;

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /bank-accounts/{id}/` — Partial update bank account.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/bank_accounts_partial_update.md`. The `PatchedBankAccount`
 * schema has no top-level `required` array, so every read-write field
 * is optional here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `currency`            string           — ISO-4217 currency code
 *   - `name`                string           — display name
 *   - `sub_classification`  enum             — BANK | PETTY_CASH | CREDIT_CARD
 *
 * Server-managed (`readOnly`) properties such as `id`, `account`,
 * `classification`, `created_ts`, `modified_ts`, `legacy_id` are
 * intentionally **not** validated.
 */
class PartialUpdateBankAccountRequest extends WafeqFormRequest
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
            'currency' => ['nullable', 'string'],

            // Bank-account display name.
            'name' => ['nullable', 'string'],

            // BankAccountSubClassificationEnum: BANK | PETTY_CASH | CREDIT_CARD
            'sub_classification' => ['nullable', 'string', 'in:BANK,PETTY_CASH,CREDIT_CARD'],
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
