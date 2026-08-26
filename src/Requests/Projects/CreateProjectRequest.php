<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Projects;

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /projects/` — Create project.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/projects_create.md`. The `Project.required` array lists
 * `created_ts`, `id`, `legacy_id`, `modified_ts` (all read-only)
 * and `name` — the only client-sent field that must be supplied.
 *
 *   - `name`        required string (max 200) — project name
 *   - `attachments` array<string>            — attachment ids
 */
class CreateProjectRequest extends WafeqFormRequest
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
            'name' => ['required', 'string', 'max:200'],
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
