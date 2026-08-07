<?php

namespace HWafeq\LaravelWafeq\Support;

use Closure;
use Psr\Http\Message\RequestInterface;

/**
 * RetryMiddleware Support.
 *
 * @see LaravelWafeq
 */
class RetryMiddleware
{
    /**
     * @param  array<string, mixed>  $config
     */
    public static function factory(array $config): Closure
    {
        return function (callable $handler) use ($config): Closure {
            return function (RequestInterface $request, array $options) use ($handler, $config) {
                $max = (int) ($config['http']['retry']['times'] ?? 0);
                $delay = (int) ($config['http']['retry']['delay'] ?? 0);
                $when = (array) ($config['http']['retry']['when'] ?? []);

                $attempts = 0;
                $lastException = null;

                do {
                    try {
                        $response = $handler($request, $options);

                        if ($attempts >= $max || ! in_array($response->getStatusCode(), $when, true)) {
                            return $response;
                        }
                    } catch (\Throwable $exception) {
                        $lastException = $exception;

                        if ($attempts >= $max) {
                            throw $exception;
                        }
                    }

                    $attempts++;
                    if ($delay > 0) {
                        usleep($delay * 1000);
                    }
                } while (true);
            };
        };
    }
}
