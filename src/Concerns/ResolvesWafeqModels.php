<?php

namespace HWafeq\LaravelWafeq\Concerns;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use LogicException;

/**
 * Shared id-resolution + payload-building plumbing used by every
 * per-resource `InteractsWithXxxModel` trait.
 *
 * Reads the bound Eloquent model from {@see HoldsWafeqModel} on the host
 * class — the resource is responsible for being bound to a model before any
 * of the `*Model` overloads are called. The model is normally bound by the
 * {@see WafeqResourceProxy} when callers go through `HasWafeqResource::wafeq()`,
 * or directly via `withModel()`.
 *
 * Resolution order for the Wafeq id:
 *   1. `$model->wafeqId()` method if defined.
 *   2. `wafeq_id` attribute if present.
 *   3. `(string) $model->getKey()` as the final fallback.
 *
 * Payload source for the create/update payload:
 *   1. `$model->toWafeqPayload()` method if defined (overrides raw attributes).
 *   2. `$model->getAttributes()` (scalar/null cast) merged with `$extra`.
 *
 * @see LaravelWafeq
 */
trait ResolvesWafeqModels
{
    /**
     * Return the Eloquent model currently bound to the host resource.
     *
     * @throws LogicException when no model has been bound yet. The host
     *                        class is required to use {@see HoldsWafeqModel}
     *                        — every per-resource `InteractsWith*Model` trait
     *                        is documented to be mixed into a resource that
     *                        already pulls `HoldsWafeqModel` in.
     */
    protected function wafeqModel(): Model
    {
        $model = $this->model();

        if ($model === null) {
            throw new LogicException('No model has been bound to this resource; call withModel($model) first (or go through HasWafeqResource::wafeq()).');
        }

        return $model;
    }

    /**
     * Resolve the Wafeq id for the bound Eloquent model.
     *
     * @throws InvalidArgumentException when the resolved value is empty.
     */
    protected function resolveWafeqId(): string
    {
        $model = $this->wafeqModel();

        if (method_exists($model, 'wafeqId')) {
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
     * Build a Wafeq create/update payload from the bound model's attributes.
     *
     * The model's `id` key is always stripped — Wafeq rejects it on
     * create/update requests. Values that are not scalar or null are
     * cast to string so payloads stay JSON-safe.
     *
     * @param  array<string, mixed>  $extra
     * @return array<string, mixed>
     */
    protected function payloadFromModel(array $extra = []): array
    {
        $model = $this->wafeqModel();

        $base = method_exists($model, 'toWafeqPayload')
            ? $model->toWafeqPayload()
            : $this->scalarize($model->getAttributes());

        unset($base['id']);

        /** @var array<string, mixed> $payload */
        $payload = array_merge($base, $extra);

        return $payload;
    }

    /**
     * Public accessor for the Wafeq id resolved from the bound model.
     *
     * Mirrors `resolveWafeqId` so callers and tests can ask the same
     * question the overloads answer internally.
     */
    public function wafeqId(): string
    {
        return $this->resolveWafeqId();
    }

    /**
     * Cast every value in the model's raw attributes to a scalar/null.
     *
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
    private function scalarize(array $attributes): array
    {
        return array_map(
            fn ($value): mixed => is_scalar($value) || $value === null ? $value : (string) $value,
            $attributes,
        );
    }
}
