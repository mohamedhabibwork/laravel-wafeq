<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\RevenueRecognitions;

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /revenue-recognitions/{id}/end-early/` — End revenue recognition early.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/revenue_recognitions_end_early_create.md`. The schema's
 * `required` array drives the rule set below; every key listed there is
 * required from the caller.
 *
 * The endpoint's request body shape:
 *
 *   - `amount`             required number — early-termination revenue
 *   - `end_early_account`  required string — revenue-account reference
 *   - `end_early_date`     required date   — effective termination date
 *   - `notes`              required string — reason for termination
 *   - `start_date`         date            — auto-populated by server
 */
class CreateRevenueRecognitionEndEarlyRequest extends WafeqFormRequest
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
            // Amount to recognise as the early-termination revenue.
            'amount' => ['required', 'numeric'],

            // Revenue account used to recognise the early termination.
            'end_early_account' => ['required', 'string'],

            // Effective date of the early termination.
            'end_early_date' => ['required', 'date_format:Y-m-d'],

            // Notes documenting the reason for early termination.
            'notes' => ['required', 'string'],

            // Auto-populated by the server; not user-provided.
            'start_date' => ['sometimes', 'date_format:Y-m-d'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'amount' => 'amount',
            'end_early_account' => 'end early account',
            'end_early_date' => 'end early date',
            'notes' => 'notes',
            'start_date' => 'start date',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return RevenueRecognitionData::class;
    }
}
