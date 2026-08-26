<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Accounts;

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Enums\AccountSubclassification;
use HWafeq\LaravelWafeq\Enums\Classification;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /accounts/` — Create account.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/accounts_create.md`. Every property whose `description`
 * appears in that document is exposed here with the matching rule set.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `account_code`        string(30)       — chart-of-accounts code
 *   - `account_type`        enum             — see AccountTypeEnum
 *   - `classification`      required enum    — see ClassificationEnum
 *   - `external_id`         string(255)      — caller-provided id
 *   - `is_payment_enabled`  bool             — allow payments
 *   - `is_posting`          bool             — allow posting
 *   - `name_ar`             string(200)      — Arabic name
 *   - `name_en`             required string  — English name
 *   - `parent`              string|null      — parent account id
 *   - `sub_classification`  required enum    — see AccountSubClassificationEnum
 *
 * Server-managed (`readOnly`) properties such as `id`, `is_locked`,
 * `is_system`, `created_ts`, `modified_ts`, `legacy_id` are intentionally
 * **not** validated — they are returned by the API and must never be
 * client-sent.
 */
class CreateAccountRequest extends WafeqFormRequest
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

            // AccountTypeEnum — narrowed to string here, the DTO cast
            // handles the enum mapping on the way in.
            'account_type' => ['nullable', 'string'],

            // ClassificationEnum: REVENUE | EXPENSE | ASSET | BANK | LIABILITY | EQUITY
            'classification' => ['required', 'string', Rule::enum(Classification::class)],

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
