<?php

namespace HWafeq\LaravelWafeq\Data;

use Illuminate\Http\Client\Response;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * Generic paginated envelope used by every Wafeq list endpoint:
 *   { "count": int, "next": ?string, "previous": ?string, "results": array }
 *
 * @template T of Data
 */
class PaginatedData extends Data
{
    /**
     * @param  DataCollection<int, T>  $results
     */
    public function __construct(
        public int $count,
        public ?string $next,
        public ?string $previous,
        public DataCollection $results,
    ) {}

    /**
     * @param  class-string<T>  $itemClass
     * @return self<T>
     */
    public static function fromResponse(Response $response, string $itemClass): self
    {
        $body = $response->json();

        return new self(
            count: (int) ($body['count'] ?? 0),
            next: $body['next'] ?? null,
            previous: $body['previous'] ?? null,
            results: new DataCollection($itemClass, $body['results'] ?? []),
        );
    }

    public function hasMore(): bool
    {
        return $this->next !== null;
    }
}
