<?php

namespace HWafeq\LaravelWafeq\Contracts;

/**
 * Marker interface for every Wafeq resource contract.
 *
 * Resources (sub-interfaces) declare the full set of operations they expose.
 */
/**
 * ResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ResourceContract
{
    /**
     * The resource name (e.g. "invoices", "contacts").
     *
     * @var string
     */
    public const RESOURCE_NAME = '';
}
