---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Retrieve manual journal

Endpoint for retrieving a single manual journal.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
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
      "ManualJournal": {
        "description": "Adds nested create feature",
        "properties": {
          "attachments": {
            "description": "The attachments linked to this manual journal.",
            "items": {
              "type": "string"
            },
            "type": "array"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the journal was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "date": {
            "description": "The date of the manual journal.",
            "format": "date",
            "type": "string"
          },
          "external_id": {
            "default": "",
            "description": "External identifier for the manual journal.",
            "maxLength": 255,
            "type": "string"
          },
          "id": {
            "description": "The id of the object.",
            "readOnly": true,
            "type": "string"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the manual journal.",
            "readOnly": true,
            "type": "string"
          },
          "line_items": {
            "description": "The line items of the manual journal.",
            "items": {
              "$ref": "#/components/schemas/ManualJournalLineItem"
            },
            "type": "array"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the journal was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "notes": {
            "default": "",
            "description": "The notes of the manual journal.",
            "type": "string"
          },
          "reference": {
            "default": "",
            "description": "The reference of the manual journal",
            "type": "string"
          },
          "serial_number": {
            "readOnly": true,
            "type": "string"
          },
          "tax_amount_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/TaxAmountTypeEnum"
              }
            ],
            "default": "TAX_EXCLUSIVE",
            "description": "The tax amount type of the manual journal.\n\n* `TAX_EXCLUSIVE` - exc. tax\n* `TAX_INCLUSIVE` - inc. tax"
          }
        },
        "required": [
          "created_ts",
          "date",
          "id",
          "legacy_id",
          "modified_ts",
          "serial_number"
        ],
        "type": "object"
      },
      "ManualJournalLineItem": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "account": {
            "description": "The account associated with this line item.",
            "type": "string"
          },
          "amount": {
            "description": "The amount of the line item.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "amount_to_bcy": {
            "description": "The amount of the line item in base currency.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "branch": {
            "description": "The branch associated with this line item, if any.",
            "type": [
              "string",
              "null"
            ]
          },
          "contact": {
            "description": "The contact associated with this line item, if any.",
            "type": "string"
          },
          "cost_center": {
            "description": "The cost center associated with this line item.",
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the line item was created",
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
            "description": "The currency of the line item.\n\n* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `AZN` - AZN ман.\n* `BAM` - BAM KM\n* `BDT` - BDT ৳\n* `BGN` - BGN лв.\n* `BHD` - BHD د.ب.‏\n* `BIF` - BIF FBu\n* `BND` - BND $\n* `BOB` - BOB Bs\n* `BRL` - BRL R$\n* `BWP` - BWP P\n* `BYN` - BYN BYN\n* `BZD` - BZD $\n* `CDF` - CDF FrCD\n* `CHF` - CHF CHF\n* `CLP` - CLP $\n* `CNY` - CNY CN¥\n* `COP` - COP $\n* `CRC` - CRC ₡\n* `CVE` - CVE CV$\n* `CZK` - CZK Kč\n* `DJF` - DJF Fdj\n* `DKK` - DKK kr\n* `DOP` - DOP RD$\n* `DZD` - DZD د.ج.‏\n* `EGP` - EGP ج.م.‏\n* `ERN` - ERN Nfk\n* `ETB` - ETB Br\n* `GBP` - GBP £\n* `GEL` - GEL GEL\n* `GHS` - GHS GH₵\n* `GNF` - GNF FG\n* `GTQ` - GTQ Q\n* `HKD` - HKD $\n* `HNL` - HNL L\n* `HRK` - HRK kn\n* `HUF` - HUF Ft\n* `IDR` - IDR Rp\n* `ILS` - ILS ₪\n* `INR` - INR ₹\n* `IQD` - IQD د.ع.‏\n* `IRR` - IRR ﷼\n* `ISK` - ISK kr\n* `JMD` - JMD $\n* `JOD` - JOD د.أ.‏\n* `JPY` - JPY ￥\n* `KES` - KES Ksh\n* `KHR` - KHR ៛\n* `KMF` - KMF FC\n* `KRW` - KRW ₩\n* `KWD` - KWD د.ك.‏\n* `KZT` - KZT тңг.\n* `LBP` - LBP ل.ل.‏\n* `LKR` - LKR SL Re\n* `LYD` - LYD د.ل.‏\n* `MAD` - MAD د.م.‏\n* `MDL` - MDL MDL\n* `MGA` - MGA MGA\n* `MKD` - MKD MKD\n* `MMK` - MMK K\n* `MOP` - MOP MOP$\n* `MUR` - MUR MURs\n* `MXN` - MXN $\n* `MYR` - MYR RM\n* `MZN` - MZN MTn\n* `NAD` - NAD N$\n* `NGN` - NGN ₦\n* `NIO` - NIO C$\n* `NOK` - NOK kr\n* `NPR` - NPR नेरू\n* `NZD` - NZD $\n* `OMR` - OMR ر.ع.‏\n* `PAB` - PAB B/.\n* `PEN` - PEN S/.\n* `PHP` - PHP ₱\n* `PKR` - PKR ₨\n* `PLN` - PLN zł\n* `PYG` - PYG ₲\n* `QAR` - QAR ر.ق.‏\n* `RON` - RON RON\n* `RSD` - RSD дин.\n* `RUB` - RUB руб.\n* `RWF` - RWF FR\n* `SDG` - SDG SDG\n* `SEK` - SEK kr\n* `SGD` - SGD $\n* `SOS` - SOS Ssh\n* `SYP` - SYP ل.س.‏\n* `THB` - THB ฿\n* `TND` - TND د.ت.‏\n* `TOP` - TOP T$\n* `TRY` - TRY TL\n* `TTD` - TTD $\n* `TWD` - TWD NT$\n* `TZS` - TZS TSh\n* `UAH` - UAH ₴\n* `UGX` - UGX USh\n* `UYU` - UYU $\n* `UZS` - UZS UZS\n* `VES` - VES Bs.S.\n* `VND` - VND ₫\n* `XAF` - XAF FCFA\n* `XOF` - XOF CFA\n* `YER` - YER ر.ي.‏\n* `ZAR` - ZAR R\n* `ZMW` - ZMW ZK"
          },
          "description": {
            "description": "The line item description.",
            "type": "string"
          },
          "exchange_rate": {
            "description": "The exchange rate of the line item.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "id": {
            "description": "The id of the object.",
            "readOnly": true,
            "type": "string"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the manual journal line item.",
            "readOnly": true,
            "type": "string"
          },
          "manual_journal": {
            "description": "The manual journal this line item belongs to.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the line item was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "place_of_supply": {
            "$ref": "#/components/schemas/PlaceOfSupplyEnum"
          },
          "project": {
            "description": "The project associated with this line item, if any.",
            "type": [
              "string",
              "null"
            ]
          },
          "tax_amount": {
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "tax_rate": {
            "description": "The tax rate applied to this line item, if any.",
            "type": "string"
          }
        },
        "required": [
          "account",
          "amount",
          "amount_to_bcy",
          "created_ts",
          "currency",
          "description",
          "exchange_rate",
          "id",
          "legacy_id",
          "manual_journal",
          "modified_ts"
        ],
        "type": "object"
      },
      "PlaceOfSupplyEnum": {
        "description": "* `ABU_DHABI` - Abu Dhabi\n* `AJMAN` - Ajman\n* `DUBAI` - Dubai\n* `FUJAIRAH` - Fujairah\n* `OUTSIDE_UAE` - Outside UAE\n* `RAS_AL_KHAIMAH` - Ras Al Khaimah\n* `SHARJAH` - Sharjah\n* `UMM_AL_QUWAIN` - Umm Al Quwain\n\nFull information for [PlaceOfSupplyEnum](placeofsupplyenum)",
        "enum": [
          "ABU_DHABI",
          "AJMAN",
          "DUBAI",
          "FUJAIRAH",
          "OUTSIDE_UAE",
          "RAS_AL_KHAIMAH",
          "SHARJAH",
          "UMM_AL_QUWAIN"
        ],
        "type": "string"
      },
      "TaxAmountTypeEnum": {
        "description": "* `TAX_INCLUSIVE` - inc. tax\n* `TAX_EXCLUSIVE` - exc. tax\n\nFull information for [TaxAmountTypeEnum](taxamounttypeenum)",
        "enum": [
          "TAX_INCLUSIVE",
          "TAX_EXCLUSIVE"
        ],
        "type": "string"
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
    "/manual-journals/{id}/": {
      "get": {
        "description": "Endpoint for retrieving a single manual journal.",
        "operationId": "manual_journals_retrieve",
        "parameters": [
          {
            "in": "path",
            "name": "id",
            "required": true,
            "schema": {
              "type": "string"
            }
          }
        ],
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/ManualJournal"
                }
              }
            },
            "description": ""
          }
        },
        "security": [
          {
            "APIKeyAuth": []
          }
        ],
        "summary": "Retrieve manual journal",
        "tags": [
          "Manual Journals"
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