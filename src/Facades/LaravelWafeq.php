<?php

namespace HWafeq\LaravelWafeq\Facades;

use HWafeq\LaravelWafeq\Contracts\AccountsResourceContract;
use HWafeq\LaravelWafeq\Contracts\ClientContract;
use HWafeq\LaravelWafeq\Contracts\ContactsResourceContract;
use HWafeq\LaravelWafeq\Contracts\InvoicesResourceContract;
use Illuminate\Support\Facades\Facade;

/**
 * Static facade proxy for the Wafeq Client singleton.
 *
 * @see ClientContract
 *
 * @method static AccountsResourceContract accounts()
 * @method static InvoicesResourceContract invoices()
 * @method static ContactsResourceContract contacts()
 */
/**
 * LaravelWafeq Class.
 *
 * @see \HWafeq\LaravelWafeq\LaravelWafeq
 */
class LaravelWafeq extends Facade
{
    /**
     * The container binding the facade resolves to.
     */
    protected static function getFacadeAccessor(): string
    {
        return ClientContract::class;
    }
}
