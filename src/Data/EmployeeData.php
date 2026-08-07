<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $email
 * @property ?string $phone
 * @property ?string $hireDate
 * @property ?string $department
 * @property ?string $jobTitle
 * @property ?string $currency
 * @property ?string $salary
 * @property array<string, mixed> $extra
 */
/**
 * EmployeeData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class EmployeeData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $hireDate = null,
        public ?string $department = null,
        public ?string $jobTitle = null,
        public ?string $currency = null,
        public ?string $salary = null,
        public array $extra = [],
    ) {}
}
