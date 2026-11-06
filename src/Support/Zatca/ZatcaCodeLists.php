<?php

namespace HWafeq\LaravelWafeq\Support\Zatca;

/**
 * Code lists accepted by the Wafeq ZATCA API that are too long to model
 * as enums. Generated from the Wafeq ZATCA OpenAPI reference
 * (`CountryCodeEnum`, `ChargeReasonCodeEnum`, `DiscountReasonCodeEnum`,
 * `PaymentMeansCodeEnum`) and used by the ZATCA validation rules.
 *
 * @see https://docs.wafeq.com/zatca/llms.txt
 */
final class ZatcaCodeLists
{
    /**
     * ISO 3166-1 alpha-2 country codes.
     *
     * @var list<string>
     */
    public const COUNTRY_CODES = [
        'AD', 'AE', 'AF', 'AG', 'AI', 'AL', 'AM', 'AO', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AW', 'AX', 'AZ', 'BA',
        'BB', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BL', 'BM', 'BN', 'BO', 'BQ', 'BR', 'BS', 'BT', 'BV',
        'BW', 'BY', 'BZ', 'CA', 'CC', 'CD', 'CF', 'CG', 'CH', 'CI', 'CK', 'CL', 'CM', 'CN', 'CO', 'CR', 'CU',
        'CV', 'CW', 'CX', 'CY', 'CZ', 'DE', 'DJ', 'DK', 'DM', 'DO', 'DZ', 'EC', 'EE', 'EG', 'EH', 'ER', 'ES',
        'ET', 'FI', 'FJ', 'FK', 'FM', 'FO', 'FR', 'GA', 'GB', 'GD', 'GE', 'GF', 'GG', 'GH', 'GI', 'GL', 'GM',
        'GN', 'GP', 'GQ', 'GR', 'GS', 'GT', 'GU', 'GW', 'GY', 'HK', 'HM', 'HN', 'HR', 'HT', 'HU', 'ID', 'IE',
        'IL', 'IM', 'IN', 'IO', 'IQ', 'IR', 'IS', 'IT', 'JE', 'JM', 'JO', 'JP', 'KE', 'KG', 'KH', 'KI', 'KM',
        'KN', 'KP', 'KR', 'KW', 'KY', 'KZ', 'LA', 'LB', 'LC', 'LI', 'LK', 'LR', 'LS', 'LT', 'LU', 'LV', 'LY',
        'MA', 'MC', 'MD', 'ME', 'MF', 'MG', 'MH', 'MK', 'ML', 'MM', 'MN', 'MO', 'MP', 'MQ', 'MR', 'MS', 'MT',
        'MU', 'MV', 'MW', 'MX', 'MY', 'MZ', 'NA', 'NC', 'NE', 'NF', 'NG', 'NI', 'NL', 'NO', 'NP', 'NR', 'NU',
        'NZ', 'OM', 'PA', 'PE', 'PF', 'PG', 'PH', 'PK', 'PL', 'PM', 'PN', 'PR', 'PS', 'PT', 'PW', 'PY', 'QA',
        'RE', 'RO', 'RS', 'RU', 'RW', 'SA', 'SB', 'SC', 'SD', 'SE', 'SG', 'SH', 'SI', 'SJ', 'SK', 'SL', 'SM',
        'SN', 'SO', 'SR', 'SS', 'ST', 'SV', 'SX', 'SY', 'SZ', 'TC', 'TD', 'TF', 'TG', 'TH', 'TJ', 'TK', 'TL',
        'TM', 'TN', 'TO', 'TR', 'TT', 'TV', 'TW', 'TZ', 'UA', 'UG', 'UM', 'US', 'UY', 'UZ', 'VA', 'VC', 'VE',
        'VG', 'VI', 'VN', 'VU', 'WF', 'WS', 'YE', 'YT', 'ZA', 'ZM', 'ZW', '1A', 'XI',
    ];

    /**
     * UNTDID 7161 charge reason codes (document- and line-level charges).
     *
     * @var list<string>
     */
    public const CHARGE_REASON_CODES = [
        'AA', 'AAA', 'AAC', 'AAD', 'AAE', 'AAF', 'AAH', 'AAI', 'AAS', 'AAT', 'AAV', 'AAY', 'AAZ', 'ABA',
        'ABB', 'ABC', 'ABD', 'ABF', 'ABK', 'ABL', 'ABN', 'ABR', 'ABS', 'ABT', 'ABU', 'ACF', 'ACG', 'ACH',
        'ACI', 'ACJ', 'ACK', 'ACL', 'ACM', 'ACS', 'ADC', 'ADE', 'ADJ', 'ADK', 'ADL', 'ADM', 'ADN', 'ADO',
        'ADP', 'ADQ', 'ADR', 'ADT', 'ADW', 'ADY', 'ADZ', 'AEA', 'AEB', 'AEC', 'AED', 'AEF', 'AEH', 'AEI',
        'AEJ', 'AEK', 'AEL', 'AEM', 'AEN', 'AEO', 'AEP', 'AES', 'AET', 'AEU', 'AEV', 'AEW', 'AEX', 'AEY',
        'AEZ', 'AJ', 'AU', 'CA', 'CAB', 'CAD', 'CAE', 'CAF', 'CAI', 'CAJ', 'CAK', 'CAL', 'CAM', 'CAN', 'CAO',
        'CAP', 'CAQ', 'CAR', 'CAS', 'CAT', 'CAU', 'CAV', 'CAW', 'CD', 'CG', 'CS', 'CT', 'DAB', 'DAD', 'DL',
        'EG', 'EP', 'ER', 'FAA', 'FAB', 'FAC', 'FC', 'FH', 'FI', 'GAA', 'HAA', 'HD', 'HH', 'IAA', 'IAB',
        'ID', 'IF', 'IR', 'IS', 'KO', 'L1', 'LA', 'LAA', 'LAB', 'LF', 'MAE', 'MI', 'ML', 'NAA', 'OA', 'PA',
        'PAA', 'PC', 'PL', 'RAB', 'RAC', 'RAD', 'RAF', 'RE', 'RF', 'RH', 'RV', 'SA', 'SAA', 'SAD', 'SAE',
        'SAI', 'SG', 'SH', 'SM', 'SU', 'TAB', 'TAC', 'TT', 'TV', 'V1', 'V2', 'WH', 'XAA', 'YY',
    ];

    /**
     * UNTDID 5189 allowance reason codes (document- and line-level discounts).
     *
     * @var list<string>
     */
    public const DISCOUNT_REASON_CODES = [
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18',
        '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35',
        '36', '37', '38', '39', '40', '41', '42', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53',
        '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65', '66', '67', '68', '69', '70',
        '71', '72', '73', '74', '75', '76', '77', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87',
        '88', '89', '90', '91', '92', '93', '94', '95', '96', '97', '98', '99', '100', '101', '102', '103',
        '104', '105',
    ];

    /**
     * UNTDID 4461 payment means codes (e.g. 10 cash, 30 credit transfer, 48 card).
     *
     * @var list<string>
     */
    public const PAYMENT_MEANS_CODES = [
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18',
        '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35',
        '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52',
        '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65', '66', '67', '68', '70',
        '74', '75', '76', '77', '78', '91', '92', '93', '94', '95', '96', '97',
    ];
}
