<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\RevenueRecognitions;

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /revenue-recognitions/preview/` — Preview revenue-recognition schedule.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/revenue_recognitions_preview_create.md`. The schema's
 * `required` array drives the rule set below; every key listed there is
 * required from the caller.
 *
 * The endpoint's request body shape:
 *
 *   - `amount`           required number      — total amount to recognise
 *   - `currency`         string               — schedule currency (defaults to org base)
 *   - `description`      required string      — human description
 *   - `duration`         required enum        — 3|4|6|12|24_MONTHS|CUSTOM
 *   - `end_date`         required date        — schedule end date
 *   - `recognition_type` required enum        — DAILY|MONTHLY
 *   - `start_date`       required date        — schedule start date
 */
class CreateRevenueRecognitionPreviewRequest extends WafeqFormRequest
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
            // Total amount to recognise across the schedule.
            'amount' => ['required', 'numeric'],

            // ISO-4217 currency code. Optional — defaults to the
            // organisation's base currency when omitted.
            'currency' => ['nullable', 'string'],

            // Human-readable description of the revenue recognition.
            'description' => ['required', 'string'],

            // Recognition-window length.
            'duration' => ['required', 'string', 'in:3_MONTHS,4_MONTHS,6_MONTHS,12_MONTHS,24_MONTHS,CUSTOM'],

            // End date of the revenue-recognition schedule.
            'end_date' => ['required', 'date_format:Y-m-d'],

            // Recognition cadence (DAILY or MONTHLY).
            'recognition_type' => ['required', 'string', 'in:DAILY,MONTHLY'],

            // Start date of the revenue-recognition schedule.
            'start_date' => ['required', 'date_format:Y-m-d'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'amount' => 'amount',
            'currency' => 'currency',
            'description' => 'description',
            'duration' => 'duration',
            'end_date' => 'end date',
            'recognition_type' => 'recognition type',
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
