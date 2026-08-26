<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Projects;

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /projects/{id}/` — Partial update project.
 *
 * The PATCH body uses the `PatchedProject` schema (no `required`
 * array) — every field becomes `sometimes`.
 */
class PartialUpdateProjectRequest extends WafeqFormRequest
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
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],
            'name' => ['sometimes', 'nullable', 'string', 'max:200'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'attachments' => 'attachments',
            'name' => 'name',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ProjectData::class;
    }
}
