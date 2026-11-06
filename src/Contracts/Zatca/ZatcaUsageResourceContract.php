<?php

namespace HWafeq\LaravelWafeq\Contracts\Zatca;

use HWafeq\LaravelWafeq\Contracts\ResourceContract;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaUsageData;

/**
 * Remaining ZATCA production document credits for the organisation.
 */
interface ZatcaUsageResourceContract extends ResourceContract
{
    public function retrieve(): ZatcaUsageData;
}
