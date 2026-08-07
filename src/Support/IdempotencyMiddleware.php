<?php

namespace HWafeq\LaravelWafeq\Support;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Str;
use Psr\Http\Message\RequestInterface;

/**
 * IdempotencyMiddleware Support.
 *
 * @see LaravelWafeq
 */
class IdempotencyMiddleware
{
    /**
     * @var list<string>
     */
    private const MUTATING_METHODS = ['POST', 'PUT', 'PATCH', 'DELETE'];

    /**
     * Mark the PendingRequest as idempotent. The header will be added the
     * next time the PendingRequest is asked to send a mutating request.
     *
     * @param  array<string, mixed>  $config
     */
    public static function apply(PendingRequest $request, array $config): PendingRequest
    {
        $header = $config['idempotency_header'] ?? 'X-Wafeq-Idempotency-Key';

        return $request->withMiddleware(function (callable $handler) use ($header) {
            return function ($request, $options = []) use ($handler, $header) {
                if (! $request instanceof RequestInterface) {
                    return $handler($request, $options);
                }

                $method = strtoupper($request->getMethod());

                if (in_array($method, self::MUTATING_METHODS, true)) {
                    $headers = array_change_key_case($options['headers'] ?? []);

                    if (! isset($headers[strtolower($header)]) && ! $request->hasHeader($header)) {
                        $request = $request->withHeader($header, (string) Str::uuid());
                    }
                }

                return $handler($request, $options);
            };
        });
    }
}
