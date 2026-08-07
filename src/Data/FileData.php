<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 * @property ?string $mimeType
 * @property ?int $size
 * @property ?string $url
 * @property ?string $createdAt
 * @property array<string, mixed> $extra
 */
/**
 * FileData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class FileData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $name = null,
        public ?string $mimeType = null,
        public ?int $size = null,
        public ?string $url = null,
        public ?string $createdAt = null,
        public array $extra = [],
    ) {}
}
