<?php

namespace HWafeq\LaravelWafeq\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HWafeq\LaravelWafeq\LaravelWafeq
 */
class LaravelWafeq extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \HWafeq\LaravelWafeq\LaravelWafeq::class;
    }
}
