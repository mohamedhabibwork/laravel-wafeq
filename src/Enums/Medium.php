<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * MediumEnum mirrors the Wafeq `MediumEnum` schema. Used for the `medium`
 * field on bulk-send / delivery resources.
 *
 * @method static self Email()
 *
 * @see LaravelWafeq
 */
enum Medium: string
{
    case Email = 'email';
}
