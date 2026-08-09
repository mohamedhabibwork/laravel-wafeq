<?php

namespace HWafeq\LaravelWafeq\Concerns;

use HWafeq\LaravelWafeq\Data\CreditNoteData;

/**
 * Model-aware overloads for the `CreditNotes` resource.
 *
 * Pulls in the shared id-resolution + payload-building helpers from
 * {@see ResolvesWafeqModels} and exposes the standard five `*Model`
 * CRUD overloads with concrete `CreditNoteData` return types so static analysers
 * and IDEs see the exact DTO shape.
 *
 * The bound Eloquent model is read from {@see HoldsWafeqModel}
 * on the resource — bind it via `withModel($model)` on the resource instance,
 * or go through {@see HasWafeqResource::wafeq()}
 * which binds the model automatically before forwarding.
 *
 * @see LaravelWafeq
 */
trait InteractsWithCreditNotesModel
{
    use ResolvesWafeqModels;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): CreditNoteData
    {
        return $this->create($this->payloadFromModel($extra));
    }

    public function retrieveModel(): CreditNoteData
    {
        return $this->retrieve($this->resolveWafeqId());
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): CreditNoteData
    {
        return $this->update($this->resolveWafeqId(), $payload);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): CreditNoteData
    {
        return $this->partialUpdate($this->resolveWafeqId(), $payload);
    }

    public function destroyModel(): bool
    {
        return $this->destroy($this->resolveWafeqId());
    }
}
