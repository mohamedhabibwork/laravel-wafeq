<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * CurrencyEnum mirrors the Wafeq `CurrencyEnum` schema. The set of ISO-4217
 * currency codes Wafeq currently accepts in the `currency` field on any
 * currency-aware resource.
 *
 * @method static self AED()
 * @method static self SAR()
 * @method static self USD()
 * @method static self EUR()
 * @method static self CAD()
 * @method static self AFN()
 * @method static self ALL()
 * @method static self AMD()
 * @method static self ARS()
 * @method static self AUD()
 * @method static self AZN()
 * @method static self BAM()
 * @method static self BDT()
 * @method static self BGN()
 * @method static self BHD()
 * @method static self BIF()
 * @method static self BND()
 * @method static self BOB()
 * @method static self BRL()
 * @method static self BWP()
 * @method static self BYN()
 * @method static self BZD()
 * @method static self CDF()
 * @method static self CHF()
 * @method static self CLP()
 * @method static self CNY()
 * @method static self COP()
 * @method static self CRC()
 * @method static self CVE()
 * @method static self CZK()
 * @method static self DJF()
 * @method static self DKK()
 * @method static self DOP()
 * @method static self DZD()
 * @method static self EGP()
 * @method static self ERN()
 * @method static self ETB()
 * @method static self GBP()
 * @method static self GEL()
 * @method static self GHS()
 * @method static self GNF()
 * @method static self GTQ()
 * @method static self HKD()
 * @method static self HNL()
 * @method static self HRK()
 * @method static self HUF()
 * @method static self IDR()
 * @method static self ILS()
 * @method static self INR()
 * @method static self IQD()
 * @method static self IRR()
 * @method static self ISK()
 * @method static self JMD()
 * @method static self JOD()
 * @method static self JPY()
 * @method static self KES()
 * @method static self KHR()
 * @method static self KMF()
 * @method static self KRW()
 * @method static self KWD()
 * @method static self KZT()
 * @method static self LBP()
 * @method static self LKR()
 * @method static self LYD()
 * @method static self MAD()
 * @method static self MDL()
 * @method static self MGA()
 * @method static self MKD()
 * @method static self MMK()
 * @method static self MOP()
 * @method static self MUR()
 * @method static self MXN()
 * @method static self MYR()
 * @method static self MZN()
 * @method static self NAD()
 * @method static self NGN()
 * @method static self NIO()
 * @method static self NOK()
 * @method static self NPR()
 * @method static self NZD()
 * @method static self OMR()
 * @method static self PAB()
 * @method static self PEN()
 * @method static self PHP()
 * @method static self PKR()
 * @method static self PLN()
 * @method static self PYG()
 * @method static self QAR()
 * @method static self RON()
 * @method static self RSD()
 * @method static self RUB()
 * @method static self RWF()
 * @method static self SDG()
 * @method static self SEK()
 * @method static self SGD()
 * @method static self SOS()
 * @method static self SYP()
 * @method static self THB()
 * @method static self TND()
 * @method static self TOP()
 * @method static self TRY()
 * @method static self TTD()
 * @method static self TWD()
 * @method static self TZS()
 * @method static self UAH()
 * @method static self UGX()
 * @method static self UYU()
 * @method static self UZS()
 * @method static self VES()
 * @method static self VND()
 * @method static self XAF()
 * @method static self XOF()
 * @method static self YER()
 * @method static self ZAR()
 * @method static self ZMW()
 *
 * @see LaravelWafeq
 */
enum Currency: string
{
    case AED = 'AED';
    case SAR = 'SAR';
    case USD = 'USD';
    case EUR = 'EUR';
    case CAD = 'CAD';
    case AFN = 'AFN';
    case ALL = 'ALL';
    case AMD = 'AMD';
    case ARS = 'ARS';
    case AUD = 'AUD';
    case AZN = 'AZN';
    case BAM = 'BAM';
    case BDT = 'BDT';
    case BGN = 'BGN';
    case BHD = 'BHD';
    case BIF = 'BIF';
    case BND = 'BND';
    case BOB = 'BOB';
    case BRL = 'BRL';
    case BWP = 'BWP';
    case BYN = 'BYN';
    case BZD = 'BZD';
    case CDF = 'CDF';
    case CHF = 'CHF';
    case CLP = 'CLP';
    case CNY = 'CNY';
    case COP = 'COP';
    case CRC = 'CRC';
    case CVE = 'CVE';
    case CZK = 'CZK';
    case DJF = 'DJF';
    case DKK = 'DKK';
    case DOP = 'DOP';
    case DZD = 'DZD';
    case EGP = 'EGP';
    case ERN = 'ERN';
    case ETB = 'ETB';
    case GBP = 'GBP';
    case GEL = 'GEL';
    case GHS = 'GHS';
    case GNF = 'GNF';
    case GTQ = 'GTQ';
    case HKD = 'HKD';
    case HNL = 'HNL';
    case HRK = 'HRK';
    case HUF = 'HUF';
    case IDR = 'IDR';
    case ILS = 'ILS';
    case INR = 'INR';
    case IQD = 'IQD';
    case IRR = 'IRR';
    case ISK = 'ISK';
    case JMD = 'JMD';
    case JOD = 'JOD';
    case JPY = 'JPY';
    case KES = 'KES';
    case KHR = 'KHR';
    case KMF = 'KMF';
    case KRW = 'KRW';
    case KWD = 'KWD';
    case KZT = 'KZT';
    case LBP = 'LBP';
    case LKR = 'LKR';
    case LYD = 'LYD';
    case MAD = 'MAD';
    case MDL = 'MDL';
    case MGA = 'MGA';
    case MKD = 'MKD';
    case MMK = 'MMK';
    case MOP = 'MOP';
    case MUR = 'MUR';
    case MXN = 'MXN';
    case MYR = 'MYR';
    case MZN = 'MZN';
    case NAD = 'NAD';
    case NGN = 'NGN';
    case NIO = 'NIO';
    case NOK = 'NOK';
    case NPR = 'NPR';
    case NZD = 'NZD';
    case OMR = 'OMR';
    case PAB = 'PAB';
    case PEN = 'PEN';
    case PHP = 'PHP';
    case PKR = 'PKR';
    case PLN = 'PLN';
    case PYG = 'PYG';
    case QAR = 'QAR';
    case RON = 'RON';
    case RSD = 'RSD';
    case RUB = 'RUB';
    case RWF = 'RWF';
    case SDG = 'SDG';
    case SEK = 'SEK';
    case SGD = 'SGD';
    case SOS = 'SOS';
    case SYP = 'SYP';
    case THB = 'THB';
    case TND = 'TND';
    case TOP = 'TOP';
    case TRY = 'TRY';
    case TTD = 'TTD';
    case TWD = 'TWD';
    case TZS = 'TZS';
    case UAH = 'UAH';
    case UGX = 'UGX';
    case UYU = 'UYU';
    case UZS = 'UZS';
    case VES = 'VES';
    case VND = 'VND';
    case XAF = 'XAF';
    case XOF = 'XOF';
    case YER = 'YER';
    case ZAR = 'ZAR';
    case ZMW = 'ZMW';
}
