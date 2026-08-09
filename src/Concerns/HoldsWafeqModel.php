<?php

namespace HWafeq\LaravelWafeq\Concerns;

use Illuminate\Database\Eloquent\Model;

/**
 * Bind a single Eloquent model to a resource so the `*Model` CRUD overloads
 * (see {@see ResolvesWafeqModels}) can resolve the Wafeq id and build the
 * payload from the bound instance.
 *
 * The resource is normally stateless — same `PendingRequest`, same endpoint,
 * same DTOs. The model is only relevant when the caller wants the
 * auto-generated CRUD helpers (`createFromModel`, `retrieveModel`,
 * `updateModel`, `partialUpdateModel`, `destroyModel`). Binding the model
 * on the resource keeps those method signatures model-free:
 *
 * ```php
 * $resource = LaravelWafeq::contacts()->withModel($customer);
 * $resource->retrieveModel();   // ContactData
 * $resource->updateModel(['name' => 'Renamed']); // ContactData
 * ```
 *
 * The proxy returned by {@see HasWafeqResource::wafeq()} binds the model
 * automatically before forwarding, so callers usually never see
 * `withModel()`.
 *
 * @see LaravelWafeq
 */
trait HoldsWafeqModel
{
    protected ?Model $model = null;

    /**
     * Bind the given Eloquent model to this resource and return the resource
     * for chaining.
     */
    public function withModel(Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Return the currently bound model, or `null` when none has been set.
     */
    public function model(): ?Model
    {
        return $this->model;
    }
}
