<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * ZATCA VAT exemption reason codes (VATEX-SA-*).
 *
 * @see https://docs.wafeq.com/zatca/reference/exemptionreasonenum
 */
enum ZatcaExemptionReason: string
{
    case FinancialServices = 'VATEX-SA-29';
    case LifeInsurance = 'VATEX-SA-29-7';
    case RealEstate = 'VATEX-SA-30';
    case ExportOfGoods = 'VATEX-SA-32';
    case CustomsSuspension = 'VATEX-SA-32(bis)';
    case ExportOfServices = 'VATEX-SA-33';
    case InternationalTransportOfGoods = 'VATEX-SA-34-1';
    case InternationalTransportOfPassengers = 'VATEX-SA-34-2';
    case PassengerTransportServices = 'VATEX-SA-34-3';
    case QualifyingMeansOfTransport = 'VATEX-SA-34-4';
    case TransportRelatedServices = 'VATEX-SA-34-5';
    case MedicinesAndMedicalEquipment = 'VATEX-SA-35';
    case QualifyingMetals = 'VATEX-SA-36';
    case DiplomaticMissions = 'VATEX-SA-DIPLOMAT';
    case DutyFree = 'VATEX-SA-DUTYFREE';
    case PrivateEducation = 'VATEX-SA-EDU';
    case PrivateHealthcare = 'VATEX-SA-HEA';
    case Military = 'VATEX-SA-MLTRY';
    case OutOfScope = 'VATEX-SA-OOS';
    case RoyalDecree = 'VATEX-SA-ROYALDECREE';

    /**
     * The tax category this reason belongs to.
     */
    public function category(): ZatcaTaxCategory
    {
        return match ($this) {
            self::FinancialServices, self::LifeInsurance, self::RealEstate => ZatcaTaxCategory::Exempt,
            self::OutOfScope => ZatcaTaxCategory::OutOfScope,
            default => ZatcaTaxCategory::ZeroRated,
        };
    }

    /**
     * Reason codes valid for the given tax category.
     *
     * @return list<self>
     */
    public static function forCategory(ZatcaTaxCategory $category): array
    {
        return array_values(array_filter(self::cases(), static fn (self $reason): bool => $reason->category() === $category));
    }
}
