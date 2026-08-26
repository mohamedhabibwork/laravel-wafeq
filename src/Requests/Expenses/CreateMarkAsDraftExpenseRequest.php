<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Expenses;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /expenses/{id}/mark-as-draft/` — Mark expense as draft.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/expenses_mark_as_draft_create.md`. The endpoint has no
 * request body — only a path parameter `id` — so the rules map is empty
 * by design. The Materialised DTO carries the resulting
 * {@see ExpenseData} shape, but only server-managed fields are filled
 * by the response.
 */
class CreateMarkAsDraftExpenseRequest extends WafeqFormRequest
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
        return [];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ExpenseData::class;
    }
}
