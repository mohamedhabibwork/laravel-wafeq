<?php

namespace HWafeq\LaravelWafeq\Data\Shared;

use HWafeq\LaravelWafeq\Casts\DualLangCast;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Castable;
use Spatie\LaravelData\Data;

/**
 * @property string $en
 * @property ?string $ar
 *
 * Dual-language value object that mirrors Wafeq's `common-dual-lang-model`
 * schema ({ en: required, ar: optional }). Used everywhere a localised field
 * appears in the API (city, district, address, name on warehouses, branches,
 * contacts, accounts, …).
 *
 * Implements {@see Castable} so Spatie Data will pass wire-format arrays
 * (and even bare strings — wrapped as `{en: $string, ar: null}`) through
 * {@see DualLangCast} automatically when this is used as a typed DTO
 * property.
 *
 * @see LaravelWafeq
 */
class DualLangData extends Data implements Castable
{
    public function __construct(
        public string $en = '',
        public ?string $ar = null,
    ) {}

    /**
     * @param  array<int, mixed>  $arguments
     */
    public static function dataCastUsing(array $arguments): Cast
    {
        return new DualLangCast;
    }

    /**
     * Flatten the localised value to the requested language, falling back to
     * the other language when the requested one is empty.
     */
    public function display(?string $language = 'en'): string
    {
        $language = $language === 'ar' ? 'ar' : 'en';

        if ($language === 'ar') {
            return $this->ar !== null ? $this->ar : $this->en;
        }

        return $this->en !== '' ? $this->en : (string) $this->ar;
    }

    public function isComplete(): bool
    {
        return $this->en !== '' && $this->ar !== null && $this->ar !== '';
    }
}
