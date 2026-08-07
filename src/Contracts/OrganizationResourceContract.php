<?php

/**
 * Contract for the /organization/ resource.
 *
 * @return \HWafeq\LaravelWafeq\Data\OrganizationData
 */

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\OrganizationData;

/**
 * OrganizationResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface OrganizationResourceContract extends ResourceContract
{
    public function retrieve(): OrganizationData;
}
