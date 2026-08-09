<?php

namespace HWafeq\LaravelWafeq\Events\Concerns;

use Spatie\LaravelData\Data;

/**
 * Base class for every event dispatched from a Wafeq Resource method.
 *
 * Carries the response payload as a typed Spatie Data DTO plus the
 * resource id (when known) and the request payload that produced the
 * call. Subclasses narrow the `$data` property to the concrete DTO via
 * a `@property` PHPDoc tag so static analysers see the exact shape.
 *
 * Example:
 *
 * ```php
 * Event::listen(ContactCreated::class, function (ContactCreated $event) {
 *     logger()->info('contact created', ['id' => $event->id, 'payload' => $event->payload]);
 * });
 * ```
 *
 * @see LaravelWafeq
 */
abstract class WafeqEvent
{
    /**
     * @param  array<array-key, mixed>  $payload
     */
    public function __construct(
        public readonly Data $data,
        public readonly string $id = '',
        public readonly array $payload = [],
    ) {}
}
