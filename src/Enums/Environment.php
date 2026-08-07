<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Sandbox()
 * @method static self Production()
 */
/**
 * Environment Enum.
 *
 * @see LaravelWafeq
 */
enum Environment: string
{
    case Sandbox = 'sandbox';
    case Production = 'production';

    /**
     * Resolve the base URL for the environment.
     */
    public function baseUrl(): string
    {
        return match ($this) {
            self::Sandbox => 'https://api-sandbox.wafeq.com/v1',
            self::Production => 'https://api.wafeq.com/v1',
        };
    }
}
