<?php

namespace HWafeq\LaravelWafeq\Tests\Pests;

use Illuminate\Support\Facades\Http;

class WafeqFake
{
    public static function url(): string
    {
        return 'https://api-sandbox.wafeq.com/v1';
    }

    /**
     * Build a paginated response body.
     *
     * @param  array<int, array<string, mixed>>  $results
     * @return array<string, mixed>
     */
    public static function page(array $results, ?string $next = null, int $count = 0): array
    {
        return [
            'count' => $count > 0 ? $count : count($results),
            'next' => $next,
            'previous' => null,
            'results' => $results,
        ];
    }

    /**
     * Register a fake response for a given path prefix.
     *
     * @param  array<string, mixed>|callable|string  $body
     */
    public static function fakePath(string $path, array|callable|string $body, int $status = 200): void
    {
        $matcher = self::path().$path;

        Http::fake(self::callback($matcher, $body, $status));
    }

    /**
     * Register a fake response for the exact URL.
     *
     * @param  array<string, mixed>  $body
     */
    public static function fakeExact(string $url, array $body, int $status = 200): void
    {
        Http::fake([
            $url => Http::response($body, $status),
        ]);
    }

    /**
     * Build an Http::fake callback that matches a URL pattern.
     *
     * @param  array<string, mixed>|callable|string  $body
     */
    private static function callback(string $matcher, array|callable|string $body, int $status): callable
    {
        return function ($request) use ($matcher, $body, $status) {
            if (! self::matches($request->url(), $matcher)) {
                return null;
            }

            if (is_callable($body)) {
                $payload = $body($request->method(), $request->url());

                return Http::response($payload, $status);
            }

            if (is_array($body)) {
                return Http::response($body, $status);
            }

            return Http::response($body, $status);
        };
    }

    /**
     * Match a URL against a pattern. Supports trailing `*` wildcard.
     */
    private static function matches(string $url, string $pattern): bool
    {
        if (! str_ends_with($pattern, '*')) {
            return $url === $pattern;
        }

        $prefix = substr($pattern, 0, -1);

        return str_starts_with($url, $prefix);
    }

    /**
     * The base URL used for fakes.
     */
    public static function path(): string
    {
        return 'https://api-sandbox.wafeq.com/v1';
    }
}
