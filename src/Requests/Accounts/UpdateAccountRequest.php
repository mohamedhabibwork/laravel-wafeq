<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Accounts;

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Enums\AccountSubclassification;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /accounts/{id}/` — Update account.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/accounts_update.md`. The schema is identical to the
 * create endpoint, so the ruleset matches `CreateAccountRequest` one-to-one.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `account_code`        string(30)
 *   - `account_type`        enum
 *   - `classification`      required enum
 *   - `external_id`         string(255)
 *   - `is_payment_enabled`  bool
 *   - `is_posting`          bool
 *   - `name_ar`             string(200)
 *   - `name_en`             required string
 *   - `parent`              string|null
 *   - `sub_classification`  required enum
 *
 * Server-managed (`readOnly`) properties such as `id`, `is_locked`,
 * `is_system`, `created_ts`, `modified_ts`, `legacy_id` are intentionally
 * **not** validated.
 */
class UpdateAccountRequest extends WafeqFormRequest
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
            // Chart-of-accounts code (unique per organisation).
            'account_code' => ['nullable', 'string', 'max:30'],

            // AccountTypeEnum — see AccountTypeEnum doc page.
            'account_type' => ['nullable', 'string'],

            // ClassificationEnum: REVENUE | EXPENSE | ASSET | BANK | LIABILITY | EQUITY
            'classification' => ['required', 'string', 'in:REVENUE,EXPENSE,ASSET,BANK,LIABILITY,EQUITY'],

            // External (caller-managed) identifier.
            'external_id' => ['nullable', 'string', 'max:255'],

            // Whether payments can be made from / to this account.
            'is_payment_enabled' => ['nullable', 'boolean'],

            // Whether transactions can be posted to this account.
            'is_posting' => ['nullable', 'boolean'],

            // Arabic display name.
            'name_ar' => ['nullable', 'string', 'max:200'],

            // English display name — required.
            'name_en' => ['required', 'string'],

            // Parent account id (when this is a sub-account).
            'parent' => ['nullable', 'string'],

            // AccountSubClassificationEnum — secondary classification.
            'sub_classification' => ['required', 'string', Rule::enum(AccountSubclassification::class)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'account_code' => 'account code',
            'account_type' => 'account type',
            'classification' => 'classification',
            'external_id' => 'external id',
            'is_payment_enabled' => 'is payment enabled',
            'is_posting' => 'is posting',
            'name_ar' => 'name (ar)',
            'name_en' => 'name (en)',
            'parent' => 'parent',
            'sub_classification' => 'sub classification',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return AccountData::class;
    }
}
