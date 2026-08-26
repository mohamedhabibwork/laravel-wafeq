<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * LanguageAc1Enum mirrors the Wafeq `LanguageAc1Enum` schema. Alias of
 * `Language41a` used by a different set of resources. Order of cases
 * matches the published docs.
 *
 * @method static self Arabic()
 * @method static self English()
 *
 * @see LaravelWafeq
 */
enum LanguageAc1: string
{
    case Arabic = 'ar';
    case English = 'en';
}
