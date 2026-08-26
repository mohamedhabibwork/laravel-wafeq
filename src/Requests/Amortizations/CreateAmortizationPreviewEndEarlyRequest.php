<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Amortizations;

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /amortizations/{id}/preview-end-early/` — Preview early termination.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/amortizations_preview_end_early_create.md`. The schema's
 * `required` array drives the rule set below; every key listed there is
 * required from the caller.
 *
 * The endpoint's request body shape:
 *
 *   - `date`       required date — date to preview the early termination at
 *   - `start_date` date          — auto-populated by server
 */
class CreateAmortizationPreviewEndEarlyRequest extends WafeqFormRequest
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
            // Date to preview the early termination at.
            'date' => ['required', 'date_format:Y-m-d'],

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
            'date' => 'date',
            'start_date' => 'start date',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return AmortizationData::class;
    }
}
