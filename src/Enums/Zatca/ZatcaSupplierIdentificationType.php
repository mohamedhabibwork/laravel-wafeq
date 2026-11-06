<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * Identifier types accepted for the supplier (seller) party.
 *
 * Platforms reporting for a connected account put the customer's CRN here.
 */
enum ZatcaSupplierIdentificationType: string
{
    case CommercialRegistration = 'CRN';
    case MhrsdLicense = 'MLS';
    case MisaLicense = 'SAG';
    case MomrahLicense = 'MOM';
    case UnifiedNumber = '700';
    case Other = 'OTH';
}
