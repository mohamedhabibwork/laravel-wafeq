<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * Identifier types accepted for the customer (buyer) party.
 */
enum ZatcaCustomerIdentificationType: string
{
    case CommercialRegistration = 'CRN';
    case GccId = 'GCC';
    case Iqama = 'IQA';
    case MhrsdLicense = 'MLS';
    case MisaLicense = 'SAG';
    case MomrahLicense = 'MOM';
    case NationalId = 'NAT';
    case UnifiedNumber = '700';
    case Other = 'OTH';
    case Passport = 'PAS';
    case TaxIdentificationNumber = 'TIN';
}
