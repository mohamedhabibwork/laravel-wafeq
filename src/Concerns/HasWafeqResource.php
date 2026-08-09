<?php

namespace HWafeq\LaravelWafeq\Concerns;

use HWafeq\LaravelWafeq\Contracts\ClientContract;

/**
 * Add a model-side Wafeq API to any Eloquent model.
 *
 * Usage:
 *
 * ```php
 * use HWafeq\LaravelWafeq\Concerns\HasWafeqResource;
 *
 * class Customer extends Model
 * {
 *     use HasWafeqResource;
 *
 *     public static function wafeqResourceName(): string
 *     {
 *         return 'contacts';
 *     }
 * }
 * ```
 *
 * Then:
 *
 * ```php
 * $customer = Customer::find(1);
 * $contact  = $customer->wafeq()->retrieve();        // ContactData
 * $contact  = $customer->wafeq()->create([...]);     // ContactData
 * $customer->wafeq()->update(['phone' => '…']);      // ContactData
 * $customer->wafeq()->destroy();                      // bool
 * ```
 *
 * The model-side `wafeqId()` resolution mirrors the resource-side
 * `ResolvesWafeqModels::resolveWafeqId` precedence:
 *   1. `wafeqId()` method (if defined on the model — wins; this trait's
 *      default does steps 2-3 so the override is the only override).
 *   2. `wafeq_id` attribute.
 *   3. `(string) $model->getKey()` as the final fallback.
 *
 * @see LaravelWafeq
 */
trait HasWafeqResource
{
    /**
     * Resolve the Wafeq id for this model using the standard precedence.
     *
     * Mirrors {@see ResolvesWafeqModels::resolveWafeqId()}. Models may
     * override this method (PHP trait override rules give the host class
     * precedence) when they need a custom resolution strategy.
     */
    public function wafeqId(): ?string
    {
        $value = array_key_exists('wafeq_id', $this->getAttributes())
            ? (string) ($this->getAttribute('wafeq_id') ?? '')
            : (string) $this->getKey();

        return $value === '' ? null : $value;
    }

    /**
     * The Wafeq resource name (camelCase factory method on
     * `ClientContract`) that this model maps to.
     *
     * Models using this trait MUST override this method.
     */
    public static function wafeqResourceName(): string
    {
        throw new \LogicException(static::class.' must override wafeqResourceName() to return the Wafeq resource factory name (e.g. "contacts").');
    }

    /**
     * Return a {@see WafeqResourceProxy} scoped to this model.
     */
    public function wafeq(): WafeqResourceProxy
    {
        $resourceName = static::wafeqResourceName();
        /** @var ClientContract $client */
        $client = app(ClientContract::class);
        $resource = $client->{$resourceName}();

        return new WafeqResourceProxy($this, $resource);
    }
}
