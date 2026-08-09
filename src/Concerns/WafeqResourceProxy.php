<?php

namespace HWafeq\LaravelWafeq\Concerns;

use HWafeq\LaravelWafeq\Contracts\WafeqResourceWithModelMethods;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

/**
 * Model-scoped proxy returned by `HasWafeqResource::wafeq()`.
 *
 * Wraps a concrete Wafeq resource (e.g. `ContactsResource`) together
 * with the originating Eloquent model and exposes the five CRUD-style
 * methods as a small, typed surface that callers can chain without
 * having to pass the model around on every call.
 *
 * Each forward binds the model onto the resource via
 * {@see HoldsWafeqModel::withModel()} before delegating to the
 * `*Model` overload, so the resource methods themselves stay
 * model-free. The proxy does not perform HTTP — the resource does.
 *
 * @see HasWafeqResource
 * @see LaravelWafeq
 */
class WafeqResourceProxy
{
    public function __construct(
        protected readonly Model $model,
        protected readonly WafeqResourceWithModelMethods $resource,
    ) {}

    /**
     * Resolve the Wafeq id for the wrapped model using the same
     * precedence as `ResolvesWafeqModels::resolveWafeqId`:
     *   1. `$model->wafeqId()` method if defined (host class wins).
     *   2. `wafeq_id` attribute if present.
     *   3. `(string) $model->getKey()` as the final fallback.
     *
     * @throws InvalidArgumentException when the resolved value is empty.
     */
    public function wafeqId(): string
    {
        $model = $this->model;

        if (method_exists($model, 'wafeqId') && (new \ReflectionMethod($model, 'wafeqId'))->getDeclaringClass()->getName() !== HasWafeqResource::class) {
            $value = (string) $model->wafeqId();
        } elseif (array_key_exists('wafeq_id', $model->getAttributes())) {
            $value = (string) ($model->getAttribute('wafeq_id') ?? '');
        } else {
            $value = (string) $model->getKey();
        }

        if ($value === '') {
            throw new InvalidArgumentException('Cannot resolve a Wafeq id from the given model; id, wafeq_id, and wafeqId() are all empty.');
        }

        return $value;
    }

    /**
     * Forward to the resource's `createFromModel()` method.
     *
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload = []): mixed
    {
        return $this->resource->withModel($this->model)->createFromModel($payload);
    }

    /**
     * Forward to the resource's `retrieveModel()` method.
     */
    public function retrieve(): mixed
    {
        return $this->resource->withModel($this->model)->retrieveModel();
    }

    /**
     * Forward to the resource's `updateModel()` method.
     *
     * @param  array<string, mixed>  $payload
     */
    public function update(array $payload): mixed
    {
        return $this->resource->withModel($this->model)->updateModel($payload);
    }

    /**
     * Forward to the resource's `partialUpdateModel()` method.
     *
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(array $payload): mixed
    {
        return $this->resource->withModel($this->model)->partialUpdateModel($payload);
    }

    /**
     * Forward to the resource's `destroyModel()` method.
     */
    public function destroy(): bool
    {
        return $this->resource->withModel($this->model)->destroyModel();
    }

    /**
     * Forward arbitrary calls to the underlying resource.
     *
     * If the resource exposes a matching `*Model` method, it is used
     * with the model bound up-front. Otherwise, the method is called
     * with the resolved Wafeq id as its first argument — this lets
     * callers use e.g. `download()` and `endEarly()` through the proxy
     * without extra plumbing.
     *
     * @param  array<int, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        $modelMethod = $method.'Model';

        if (method_exists($this->resource, $modelMethod)) {
            return $this->resource->withModel($this->model)->{$modelMethod}(...$arguments);
        }

        return $this->resource->{$method}($this->wafeqId(), ...$arguments);
    }
}
