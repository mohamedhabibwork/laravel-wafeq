<?php

namespace HWafeq\LaravelWafeq\Concerns;

use HWafeq\LaravelWafeq\Data\AmortizationData;

/**
 * Model-aware overloads for the `Amortizations` resource.
 *
 * Pulls in the shared id-resolution + payload-building helpers from
 * {@see ResolvesWafeqModels} and exposes the standard five `*Model`
 * CRUD overloads with concrete `AmortizationData` return types so static analysers
 * and IDEs see the exact DTO shape.
 *
 * The bound Eloquent model is read from {@see HoldsWafeqModel}
 * on the resource — bind it via `withModel($model)` on the resource instance,
 * or go through {@see HasWafeqResource::wafeq()}
 * which binds the model automatically before forwarding.
 *
 * @see LaravelWafeq
 */
trait InteractsWithAmortizationsModel
{
    use ResolvesWafeqModels;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): AmortizationData
    {
        return $this->create($this->payloadFromModel($extra));
    }

    public function retrieveModel(): AmortizationData
    {
        return $this->retrieve($this->resolveWafeqId());
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): AmortizationData
    {
        return $this->update($this->resolveWafeqId(), $payload);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): AmortizationData
    {
        return $this->partialUpdate($this->resolveWafeqId(), $payload);
    }

    public function destroyModel(): bool
    {
        return $this->destroy($this->resolveWafeqId());
    }

    /**
     * End the amortization schedule early.
     *
     * @param  array<string, mixed>  $payload
     */
    public function endEarlyModel(array $payload = []): AmortizationData
    {
        return $this->endEarly($this->resolveWafeqId(), $payload);
    }

    /**
     * Preview creating an amortization from a model payload.
     *
     * @param  array<string, mixed>  $payload
     */
    public function previewCreateFromModel(array $payload = []): AmortizationData
    {
        return $this->previewCreate($this->payloadFromModel($payload));
    }

    /**
     * Preview ending the amortization early.
     *
     * @param  array<string, mixed>  $payload
     */
    public function previewEndEarlyModel(array $payload = []): AmortizationData
    {
        return $this->previewEndEarly($this->resolveWafeqId(), $payload);
    }
}
