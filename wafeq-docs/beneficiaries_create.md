---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Create beneficiary

Endpoint for creating a new beneficiary.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "ChargeTypeEnum": {
        "description": "* `OUR` - Ours\n* `BEN` - Beneficiary\n* `SHA` - Shared\n\nFull information for [ChargeTypeEnum](chargetypeenum)",
        "enum": [
          "OUR",
          "BEN",
          "SHA"
        ],
        "type": "string"
      },
      "CountryEnum": {
        "description": "* `SA` - Kingdom of Saudi Arabia\n* `AE` - United Arab Emirates\n* `QA` - Qatar\n* `BH` - Bahrain\n* `KW` - Kuwait\n* `OM` - Oman\n* `EG` - Egypt\n* `US` - United States of America\n* `AF` - Afghanistan\n* `AX` - Åland Islands\n* `...`\n\nFull information for [CountryEnum](countryenum)",
        "enum": [
          "SA",
          "AE",
          "QA",
          "BH",
          "KW",
          "OM",
          "EG",
          "US",
          "AF",
          "AX",
          "AL",
          "DZ",
          "AS",
          "AD",
          "AO",
          "AI",
          "AQ",
          "AG",
          "AR",
          "AM",
          "AW",
          "AU",
          "AT",
          "AZ",
          "BS",
          "BD",
          "BB",
          "BY",
          "BE",
          "BZ",
          "BJ",
          "BM",
          "BT",
          "BO",
          "BQ",
          "BA",
          "BW",
          "BV",
          "BR",
          "IO",
          "BN",
          "BG",
          "BF",
          "BI",
          "CV",
          "KH",
          "CM",
          "CA",
          "KY",
          "CF",
          "TD",
          "CL",
          "CN",
          "CX",
          "CC",
          "CO",
          "KM",
          "CG",
          "CK",
          "CR",
          "CI",
          "HR",
          "CU",
          "CW",
          "CY",
          "CZ",
          "CD",
          "DK",
          "DJ",
          "DM",
          "DO",
          "EC",
          "SV",
          "GQ",
          "ER",
          "EE",
          "SZ",
          "ET",
          "FK",
          "FO",
          "FJ",
          "FI",
          "FR",
          "GF",
          "PF",
          "TF",
          "GA",
          "GM",
          "GE",
          "DE",
          "GH",
          "GI",
          "GR",
          "GL",
          "GD",
          "GP",
          "GU",
          "GT",
          "GG",
          "GN",
          "GW",
          "GY",
          "HT",
          "HM",
          "HN",
          "HK",
          "HU",
          "IS",
          "IN",
          "ID",
          "IR",
          "IQ",
          "IE",
          "IM",
          "IL",
          "IT",
          "JM",
          "JP",
          "JE",
          "JO",
          "KZ",
          "KE",
          "KI",
          "KG",
          "LA",
          "LV",
          "LB",
          "LS",
          "LR",
          "LY",
          "LI",
          "LT",
          "LU",
          "MO",
          "MG",
          "MW",
          "MY",
          "MV",
          "ML",
          "MT",
          "MH",
          "MQ",
          "MR",
          "MU",
          "YT",
          "MX",
          "FM",
          "MD",
          "MC",
          "MN",
          "ME",
          "MS",
          "MA",
          "MZ",
          "MM",
          "NA",
          "NR",
          "NP",
          "NL",
          "NC",
          "NZ",
          "NI",
          "NE",
          "NG",
          "NU",
          "NF",
          "KP",
          "MK",
          "MP",
          "NO",
          "PK",
          "PW",
          "PS",
          "PA",
          "PG",
          "PY",
          "PE",
          "PH",
          "PN",
          "PL",
          "PT",
          "PR",
          "RE",
          "RO",
          "RU",
          "RW",
          "BL",
          "SH",
          "KN",
          "LC",
          "MF",
          "PM",
          "VC",
          "WS",
          "SM",
          "ST",
          "SN",
          "RS",
          "SC",
          "SL",
          "SG",
          "SX",
          "SK",
          "SI",
          "SB",
          "SO",
          "ZA",
          "GS",
          "KR",
          "SS",
          "ES",
          "LK",
          "SD",
          "SR",
          "SJ",
          "SE",
          "CH",
          "SY",
          "TW",
          "TJ",
          "TZ",
          "TH",
          "TL",
          "TG",
          "TK",
          "TO",
          "TT",
          "TN",
          "TR",
          "TM",
          "TC",
          "TV",
          "UG",
          "UA",
          "GB",
          "UM",
          "UY",
          "UZ",
          "VU",
          "VA",
          "VE",
          "VN",
          "VG",
          "VI",
          "WF",
          "EH",
          "YE",
          "ZM",
          "ZW"
        ],
        "type": "string"
      },
      "CurrencyEnum": {
        "description": "* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `...`\n\nFull information for [CurrencyEnum](currencyenum)",
        "enum": [
          "AED",
          "SAR",
          "USD",
          "EUR",
          "CAD",
          "AFN",
          "ALL",
          "AMD",
          "ARS",
          "AUD",
          "AZN",
          "BAM",
          "BDT",
          "BGN",
          "BHD",
          "BIF",
          "BND",
          "BOB",
          "BRL",
          "BWP",
          "BYN",
          "BZD",
          "CDF",
          "CHF",
          "CLP",
          "CNY",
          "COP",
          "CRC",
          "CVE",
          "CZK",
          "DJF",
          "DKK",
          "DOP",
          "DZD",
          "EGP",
          "ERN",
          "ETB",
          "GBP",
          "GEL",
          "GHS",
          "GNF",
          "GTQ",
          "HKD",
          "HNL",
          "HRK",
          "HUF",
          "IDR",
          "ILS",
          "INR",
          "IQD",
          "IRR",
          "ISK",
          "JMD",
          "JOD",
          "JPY",
          "KES",
          "KHR",
          "KMF",
          "KRW",
          "KWD",
          "KZT",
          "LBP",
          "LKR",
          "LYD",
          "MAD",
          "MDL",
          "MGA",
          "MKD",
          "MMK",
          "MOP",
          "MUR",
          "MXN",
          "MYR",
          "MZN",
          "NAD",
          "NGN",
          "NIO",
          "NOK",
          "NPR",
          "NZD",
          "OMR",
          "PAB",
          "PEN",
          "PHP",
          "PKR",
          "PLN",
          "PYG",
          "QAR",
          "RON",
          "RSD",
          "RUB",
          "RWF",
          "SDG",
          "SEK",
          "SGD",
          "SOS",
          "SYP",
          "THB",
          "TND",
          "TOP",
          "TRY",
          "TTD",
          "TWD",
          "TZS",
          "UAH",
          "UGX",
          "UYU",
          "UZS",
          "VES",
          "VND",
          "XAF",
          "XOF",
          "YER",
          "ZAR",
          "ZMW"
        ],
        "type": "string"
      },
      "api-v1-external-beneficiary-read-write": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "address": {
            "description": "The full address of the beneficiary.",
            "type": "string"
          },
          "bank_name": {
            "description": "The name of the bank where the beneficiary account is held.",
            "maxLength": 200,
            "type": "string"
          },
          "charge_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/ChargeTypeEnum"
              }
            ],
            "description": "The charge type of the account, indicating how fees are handled.\n\n* `OUR` - Ours\n* `BEN` - Beneficiary\n* `SHA` - Shared"
          },
          "contacts": {
            "description": "The contacts associated with the beneficiary. Can be multiple.",
            "items": {
              "type": "string"
            },
            "type": "array"
          },
          "country": {
            "allOf": [
              {
                "$ref": "#/components/schemas/CountryEnum"
              }
            ],
            "description": "ISO 3166 two-letter country code of the beneficiary bank account.\n\n* `SA` - Kingdom of Saudi Arabia\n* `AE` - United Arab Emirates\n* `QA` - Qatar\n* `BH` - Bahrain\n* `KW` - Kuwait\n* `OM` - Oman\n* `EG` - Egypt\n* `US` - United States of America\n* `AF` - Afghanistan\n* `AX` - Åland Islands\n* `AL` - Albania\n* `DZ` - Algeria\n* `AS` - American Samoa\n* `AD` - Andorra\n* `AO` - Angola\n* `AI` - Anguilla\n* `AQ` - Antarctica\n* `AG` - Antigua and Barbuda\n* `AR` - Argentina\n* `AM` - Armenia\n* `AW` - Aruba\n* `AU` - Australia\n* `AT` - Austria\n* `AZ` - Azerbaijan\n* `BS` - Bahamas (The)\n* `BD` - Bangladesh\n* `BB` - Barbados\n* `BY` - Belarus\n* `BE` - Belgium\n* `BZ` - Belize\n* `BJ` - Benin\n* `BM` - Bermuda\n* `BT` - Bhutan\n* `BO` - Bolivia\n* `BQ` - Bonaire, Sint Eustatius and Saba\n* `BA` - Bosnia and Herzegovina\n* `BW` - Botswana\n* `BV` - Bouvet Island\n* `BR` - Brazil\n* `IO` - British Indian Ocean Territory\n* `BN` - Brunei\n* `BG` - Bulgaria\n* `BF` - Burkina Faso\n* `BI` - Burundi\n* `CV` - Cabo Verde\n* `KH` - Cambodia\n* `CM` - Cameroon\n* `CA` - Canada\n* `KY` - Cayman Islands\n* `CF` - Central African Republic\n* `TD` - Chad\n* `CL` - Chile\n* `CN` - China\n* `CX` - Christmas Island\n* `CC` - Cocos (Keeling) Islands\n* `CO` - Colombia\n* `KM` - Comoros\n* `CG` - Congo\n* `CK` - Cook Islands\n* `CR` - Costa Rica\n* `CI` - Côte d'Ivoire\n* `HR` - Croatia\n* `CU` - Cuba\n* `CW` - Curaçao\n* `CY` - Cyprus\n* `CZ` - Czechia\n* `CD` - Democratic Republic of the Congo\n* `DK` - Denmark\n* `DJ` - Djibouti\n* `DM` - Dominica\n* `DO` - Dominican Republic\n* `EC` - Ecuador\n* `SV` - El Salvador\n* `GQ` - Equatorial Guinea\n* `ER` - Eritrea\n* `EE` - Estonia\n* `SZ` - Eswatini\n* `ET` - Ethiopia\n* `FK` - Falkland Islands (Malvinas)\n* `FO` - Faroe Islands\n* `FJ` - Fiji\n* `FI` - Finland\n* `FR` - France\n* `GF` - French Guiana\n* `PF` - French Polynesia\n* `TF` - French Southern Territories\n* `GA` - Gabon\n* `GM` - Gambia\n* `GE` - Georgia\n* `DE` - Germany\n* `GH` - Ghana\n* `GI` - Gibraltar\n* `GR` - Greece\n* `GL` - Greenland\n* `GD` - Grenada\n* `GP` - Guadeloupe\n* `GU` - Guam\n* `GT` - Guatemala\n* `GG` - Guernsey\n* `GN` - Guinea\n* `GW` - Guinea-Bissau\n* `GY` - Guyana\n* `HT` - Haiti\n* `HM` - Heard Island and McDonald Islands\n* `HN` - Honduras\n* `HK` - Hong Kong\n* `HU` - Hungary\n* `IS` - Iceland\n* `IN` - India\n* `ID` - Indonesia\n* `IR` - Iran\n* `IQ` - Iraq\n* `IE` - Ireland\n* `IM` - Isle of Man\n* `IL` - Israel\n* `IT` - Italy\n* `JM` - Jamaica\n* `JP` - Japan\n* `JE` - Jersey\n* `JO` - Jordan\n* `KZ` - Kazakhstan\n* `KE` - Kenya\n* `KI` - Kiribati\n* `KG` - Kyrgyzstan\n* `LA` - Laos\n* `LV` - Latvia\n* `LB` - Lebanon\n* `LS` - Lesotho\n* `LR` - Liberia\n* `LY` - Libya\n* `LI` - Liechtenstein\n* `LT` - Lithuania\n* `LU` - Luxembourg\n* `MO` - Macao\n* `MG` - Madagascar\n* `MW` - Malawi\n* `MY` - Malaysia\n* `MV` - Maldives\n* `ML` - Mali\n* `MT` - Malta\n* `MH` - Marshall Islands\n* `MQ` - Martinique\n* `MR` - Mauritania\n* `MU` - Mauritius\n* `YT` - Mayotte\n* `MX` - Mexico\n* `FM` - Micronesia\n* `MD` - Moldova\n* `MC` - Monaco\n* `MN` - Mongolia\n* `ME` - Montenegro\n* `MS` - Montserrat\n* `MA` - Morocco\n* `MZ` - Mozambique\n* `MM` - Myanmar\n* `NA` - Namibia\n* `NR` - Nauru\n* `NP` - Nepal\n* `NL` - Netherlands\n* `NC` - New Caledonia\n* `NZ` - New Zealand\n* `NI` - Nicaragua\n* `NE` - Niger\n* `NG` - Nigeria\n* `NU` - Niue\n* `NF` - Norfolk Island\n* `KP` - North Korea\n* `MK` - North Macedonia\n* `MP` - Northern Mariana Islands\n* `NO` - Norway\n* `PK` - Pakistan\n* `PW` - Palau\n* `PS` - Palestine\n* `PA` - Panama\n* `PG` - Papua New Guinea\n* `PY` - Paraguay\n* `PE` - Peru\n* `PH` - Philippines\n* `PN` - Pitcairn\n* `PL` - Poland\n* `PT` - Portugal\n* `PR` - Puerto Rico\n* `RE` - Réunion\n* `RO` - Romania\n* `RU` - Russia\n* `RW` - Rwanda\n* `BL` - Saint Barthélemy\n* `SH` - Saint Helena\n* `KN` - Saint Kitts and Nevis\n* `LC` - Saint Lucia\n* `MF` - Saint Martin (French part)\n* `PM` - Saint Pierre and Miquelon\n* `VC` - Saint Vincent and the Grenadines\n* `WS` - Samoa\n* `SM` - San Marino\n* `ST` - Sao Tome and Principe\n* `SN` - Senegal\n* `RS` - Serbia\n* `SC` - Seychelles\n* `SL` - Sierra Leone\n* `SG` - Singapore\n* `SX` - Sint Maarten (Dutch part)\n* `SK` - Slovakia\n* `SI` - Slovenia\n* `SB` - Solomon Islands\n* `SO` - Somalia\n* `ZA` - South Africa\n* `GS` - South Georgia\n* `KR` - South Korea\n* `SS` - South Sudan\n* `ES` - Spain\n* `LK` - Sri Lanka\n* `SD` - Sudan\n* `SR` - Suriname\n* `SJ` - Svalbard and Jan Mayen\n* `SE` - Sweden\n* `CH` - Switzerland\n* `SY` - Syria\n* `TW` - Taiwan\n* `TJ` - Tajikistan\n* `TZ` - Tanzania\n* `TH` - Thailand\n* `TL` - Timor-Leste\n* `TG` - Togo\n* `TK` - Tokelau\n* `TO` - Tonga\n* `TT` - Trinidad and Tobago\n* `TN` - Tunisia\n* `TR` - Türkiye\n* `TM` - Turkmenistan\n* `TC` - Turks and Caicos Islands\n* `TV` - Tuvalu\n* `UG` - Uganda\n* `UA` - Ukraine\n* `GB` - United Kingdom\n* `UM` - United States Minor Outlying Islands\n* `UY` - Uruguay\n* `UZ` - Uzbekistan\n* `VU` - Vanuatu\n* `VA` - Vatican City\n* `VE` - Venezuela\n* `VN` - Vietnam\n* `VG` - Virgin Islands (British)\n* `VI` - Virgin Islands (U.S.)\n* `WF` - Wallis and Futuna\n* `EH` - Western Sahara\n* `YE` - Yemen\n* `ZM` - Zambia\n* `ZW` - Zimbabwe"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the beneficiary bank account was created.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "currency": {
            "allOf": [
              {
                "$ref": "#/components/schemas/CurrencyEnum"
              }
            ],
            "description": "The currency of the beneficiary bank account. Must be a valid currency code.\n\n* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `AZN` - AZN ман.\n* `BAM` - BAM KM\n* `BDT` - BDT ৳\n* `BGN` - BGN лв.\n* `BHD` - BHD د.ب.‏\n* `BIF` - BIF FBu\n* `BND` - BND $\n* `BOB` - BOB Bs\n* `BRL` - BRL R$\n* `BWP` - BWP P\n* `BYN` - BYN BYN\n* `BZD` - BZD $\n* `CDF` - CDF FrCD\n* `CHF` - CHF CHF\n* `CLP` - CLP $\n* `CNY` - CNY CN¥\n* `COP` - COP $\n* `CRC` - CRC ₡\n* `CVE` - CVE CV$\n* `CZK` - CZK Kč\n* `DJF` - DJF Fdj\n* `DKK` - DKK kr\n* `DOP` - DOP RD$\n* `DZD` - DZD د.ج.‏\n* `EGP` - EGP ج.م.‏\n* `ERN` - ERN Nfk\n* `ETB` - ETB Br\n* `GBP` - GBP £\n* `GEL` - GEL GEL\n* `GHS` - GHS GH₵\n* `GNF` - GNF FG\n* `GTQ` - GTQ Q\n* `HKD` - HKD $\n* `HNL` - HNL L\n* `HRK` - HRK kn\n* `HUF` - HUF Ft\n* `IDR` - IDR Rp\n* `ILS` - ILS ₪\n* `INR` - INR ₹\n* `IQD` - IQD د.ع.‏\n* `IRR` - IRR ﷼\n* `ISK` - ISK kr\n* `JMD` - JMD $\n* `JOD` - JOD د.أ.‏\n* `JPY` - JPY ￥\n* `KES` - KES Ksh\n* `KHR` - KHR ៛\n* `KMF` - KMF FC\n* `KRW` - KRW ₩\n* `KWD` - KWD د.ك.‏\n* `KZT` - KZT тңг.\n* `LBP` - LBP ل.ل.‏\n* `LKR` - LKR SL Re\n* `LYD` - LYD د.ل.‏\n* `MAD` - MAD د.م.‏\n* `MDL` - MDL MDL\n* `MGA` - MGA MGA\n* `MKD` - MKD MKD\n* `MMK` - MMK K\n* `MOP` - MOP MOP$\n* `MUR` - MUR MURs\n* `MXN` - MXN $\n* `MYR` - MYR RM\n* `MZN` - MZN MTn\n* `NAD` - NAD N$\n* `NGN` - NGN ₦\n* `NIO` - NIO C$\n* `NOK` - NOK kr\n* `NPR` - NPR नेरू\n* `NZD` - NZD $\n* `OMR` - OMR ر.ع.‏\n* `PAB` - PAB B/.\n* `PEN` - PEN S/.\n* `PHP` - PHP ₱\n* `PKR` - PKR ₨\n* `PLN` - PLN zł\n* `PYG` - PYG ₲\n* `QAR` - QAR ر.ق.‏\n* `RON` - RON RON\n* `RSD` - RSD дин.\n* `RUB` - RUB руб.\n* `RWF` - RWF FR\n* `SDG` - SDG SDG\n* `SEK` - SEK kr\n* `SGD` - SGD $\n* `SOS` - SOS Ssh\n* `SYP` - SYP ل.س.‏\n* `THB` - THB ฿\n* `TND` - TND د.ت.‏\n* `TOP` - TOP T$\n* `TRY` - TRY TL\n* `TTD` - TTD $\n* `TWD` - TWD NT$\n* `TZS` - TZS TSh\n* `UAH` - UAH ₴\n* `UGX` - UGX USh\n* `UYU` - UYU $\n* `UZS` - UZS UZS\n* `VES` - VES Bs.S.\n* `VND` - VND ₫\n* `XAF` - XAF FCFA\n* `XOF` - XOF CFA\n* `YER` - YER ر.ي.‏\n* `ZAR` - ZAR R\n* `ZMW` - ZMW ZK"
          },
          "iban": {
            "description": "The International Bank Account Number (IBAN) of the beneficiary account.",
            "maxLength": 34,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the beneficiary bank account.",
            "readOnly": true,
            "type": "string"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the beneficiary.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the beneficiary bank account was last modified.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "description": "The name of the beneficiary. Must contain only Latin letters (A-Z), digits (0-9), and spaces.",
            "type": "string"
          },
          "swift": {
            "description": "The SWIFT code (BIC) of the beneficiary bank.",
            "maxLength": 11,
            "type": "string"
          }
        },
        "required": [
          "address",
          "country",
          "created_ts",
          "currency",
          "iban",
          "id",
          "legacy_id",
          "modified_ts",
          "name"
        ],
        "type": "object"
      }
    },
    "securitySchemes": {
      "APIKeyAuth": {
        "description": "__An API key that will be supplied in  `Authorization` header.__\n\nExample:\n`Api-Key vVLOU1BB.aKz8GWaAGz0w1fO997aCMskNfS0ZpwjS`",
        "in": "header",
        "name": "Authorization",
        "type": "apiKey",
        "x-default": "Api-Key replace_with_your_api_key"
      }
    }
  },
  "info": {
    "title": "Wafeq Public API",
    "version": "v1"
  },
  "openapi": "3.1.1",
  "paths": {
    "/beneficiaries/": {
      "post": {
        "description": "Endpoint for creating a new beneficiary.",
        "operationId": "beneficiaries_create",
        "parameters": [
          {
            "description": "Client-provided UUID to uniquely identify a request",
            "in": "header",
            "name": "X-Wafeq-Idempotency-Key",
            "schema": {
              "type": "string"
            }
          }
        ],
        "requestBody": {
          "content": {
            "application/json": {
              "schema": {
                "$ref": "#/components/schemas/api-v1-external-beneficiary-read-write"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/api-v1-external-beneficiary-read-write"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/api-v1-external-beneficiary-read-write"
              }
            }
          },
          "required": true
        },
        "responses": {
          "201": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/api-v1-external-beneficiary-read-write"
                }
              }
            },
            "description": "",
            "headers": {
              "X-Wafeq-Idempotent-Replayed": {
                "description": "Indicates whether response was served from cache",
                "schema": {
                  "type": "string"
                }
              }
            }
          }
        },
        "security": [
          {
            "APIKeyAuth": []
          }
        ],
        "summary": "Create beneficiary",
        "tags": [
          "Beneficiaries"
        ]
      }
    }
  },
  "servers": [
    {
      "description": "Wafeq API Base URL",
      "url": "https://api.wafeq.com/v1"
    }
  ],
  "x-readme": {
    "proxy-enabled": false,
    "samples-languages": [
      "shell",
      "http"
    ]
  }
}
```