<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Concerns\HasWafeqResource;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\WafeqResourceProxy;
use Illuminate\Database\Eloquent\Model;

/**
 * Marker contract that every CRUD resource contract implements.
 *
 * Extends {@see ResourceContract} with the five `*Model` overloads
 * (using generic `mixed` return types here — each per-resource
 * sub-contract narrows the return type to its concrete DTO).
 *
 * The `*Model` overloads read the Eloquent model from the resource's
 * {@see HoldsWafeqModel} binding.
 * The proxy returned by {@see HasWafeqResource::wafeq()}
 * binds the model automatically before forwarding.
 *
 * Exists primarily so {@see WafeqResourceProxy} can type-hint the
 * resource it wraps without taking a dependency on every per-resource
 * contract.
 *
 * @see LaravelWafeq
 */
interface WafeqResourceWithModelMethods extends ResourceContract
{
    /**
     * Bind the given Eloquent model to this resource so the `*Model`
     * overloads can resolve the Wafeq id and build the payload from it.
     */
    public function withModel(Model $model): static;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): mixed;

    public function retrieveModel(): mixed;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): mixed;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): mixed;

    public function destroyModel(): bool;
}
