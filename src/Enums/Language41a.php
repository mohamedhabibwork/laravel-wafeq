<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Language41aEnum mirrors the Wafeq `Language41aEnum` schema. Used for the
 * `language` field on resources that take a printable-document language.
 *
 * @method static self English()
 * @method static self Arabic()
 *
 * @see LaravelWafeq
 */
enum Language41a: string
{
    case English = 'en';
    case Arabic = 'ar';
}
