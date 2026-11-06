<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * Special properties that change how a ZATCA document is reported.
 */
enum ZatcaDocumentIndicator: string
{
    case Summary = 'SUMMARY';
    case Export = 'EXPORT';
    case Nominal = 'NOMINAL';
    case ThirdParty = 'THIRD_PARTY';
    case SelfBilling = 'SELF_BILLING';
}
