---
updatedAt: 2026-06-12T06:59:25.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Retrieve amortization

Endpoint for retrieving a single amortization.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "Amortization": {
        "properties": {
          "account": {
            "description": "The expense account used for amortization recognition.",
            "readOnly": true,
            "type": "string"
          },
          "amount": {
            "description": "The total amount being amortized.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "balance": {
            "description": "The remaining un-amortized balance.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": [
              "number",
              "null"
            ]
          },
          "bill": {
            "description": "The bill that this amortization belongs to.",
            "readOnly": true,
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the amortization was created.",
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
            "description": "The currency of the amortization.\n\n* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `AZN` - AZN ман.\n* `BAM` - BAM KM\n* `BDT` - BDT ৳\n* `BGN` - BGN лв.\n* `BHD` - BHD د.ب.‏\n* `BIF` - BIF FBu\n* `BND` - BND $\n* `BOB` - BOB Bs\n* `BRL` - BRL R$\n* `BWP` - BWP P\n* `BYN` - BYN BYN\n* `BZD` - BZD $\n* `CDF` - CDF FrCD\n* `CHF` - CHF CHF\n* `CLP` - CLP $\n* `CNY` - CNY CN¥\n* `COP` - COP $\n* `CRC` - CRC ₡\n* `CVE` - CVE CV$\n* `CZK` - CZK Kč\n* `DJF` - DJF Fdj\n* `DKK` - DKK kr\n* `DOP` - DOP RD$\n* `DZD` - DZD د.ج.‏\n* `EGP` - EGP ج.م.‏\n* `ERN` - ERN Nfk\n* `ETB` - ETB Br\n* `GBP` - GBP £\n* `GEL` - GEL GEL\n* `GHS` - GHS GH₵\n* `GNF` - GNF FG\n* `GTQ` - GTQ Q\n* `HKD` - HKD $\n* `HNL` - HNL L\n* `HRK` - HRK kn\n* `HUF` - HUF Ft\n* `IDR` - IDR Rp\n* `ILS` - ILS ₪\n* `INR` - INR ₹\n* `IQD` - IQD د.ع.‏\n* `IRR` - IRR ﷼\n* `ISK` - ISK kr\n* `JMD` - JMD $\n* `JOD` - JOD د.أ.‏\n* `JPY` - JPY ￥\n* `KES` - KES Ksh\n* `KHR` - KHR ៛\n* `KMF` - KMF FC\n* `KRW` - KRW ₩\n* `KWD` - KWD د.ك.‏\n* `KZT` - KZT тңг.\n* `LBP` - LBP ل.ل.‏\n* `LKR` - LKR SL Re\n* `LYD` - LYD د.ل.‏\n* `MAD` - MAD د.م.‏\n* `MDL` - MDL MDL\n* `MGA` - MGA MGA\n* `MKD` - MKD MKD\n* `MMK` - MMK K\n* `MOP` - MOP MOP$\n* `MUR` - MUR MURs\n* `MXN` - MXN $\n* `MYR` - MYR RM\n* `MZN` - MZN MTn\n* `NAD` - NAD N$\n* `NGN` - NGN ₦\n* `NIO` - NIO C$\n* `NOK` - NOK kr\n* `NPR` - NPR नेरू\n* `NZD` - NZD $\n* `OMR` - OMR ر.ع.‏\n* `PAB` - PAB B/.\n* `PEN` - PEN S/.\n* `PHP` - PHP ₱\n* `PKR` - PKR ₨\n* `PLN` - PLN zł\n* `PYG` - PYG ₲\n* `QAR` - QAR ر.ق.‏\n* `RON` - RON RON\n* `RSD` - RSD дин.\n* `RUB` - RUB руб.\n* `RWF` - RWF FR\n* `SDG` - SDG SDG\n* `SEK` - SEK kr\n* `SGD` - SGD $\n* `SOS` - SOS Ssh\n* `SYP` - SYP ل.س.‏\n* `THB` - THB ฿\n* `TND` - TND د.ت.‏\n* `TOP` - TOP T$\n* `TRY` - TRY TL\n* `TTD` - TTD $\n* `TWD` - TWD NT$\n* `TZS` - TZS TSh\n* `UAH` - UAH ₴\n* `UGX` - UGX USh\n* `UYU` - UYU $\n* `UZS` - UZS UZS\n* `VES` - VES Bs.S.\n* `VND` - VND ₫\n* `XAF` - XAF FCFA\n* `XOF` - XOF CFA\n* `YER` - YER ر.ي.‏\n* `ZAR` - ZAR R\n* `ZMW` - ZMW ZK",
            "readOnly": true
          },
          "description": {
            "description": "The description of the amortization.",
            "readOnly": true,
            "type": "string"
          },
          "duration": {
            "allOf": [
              {
                "$ref": "#/components/schemas/DurationEnum"
              }
            ],
            "description": "The recognition duration (e.g. 3_MONTHS, 12_MONTHS, CUSTOM).\n\n* `3_MONTHS` - 3 Months\n* `4_MONTHS` - 4 Months\n* `6_MONTHS` - 6 Months\n* `12_MONTHS` - 12 Months\n* `24_MONTHS` - 24 Months\n* `CUSTOM` - Custom",
            "readOnly": true
          },
          "end_date": {
            "description": "The end date of the amortization schedule.",
            "format": "date",
            "readOnly": true,
            "type": "string"
          },
          "end_early_account": {
            "description": "The expense account used to recognize the early termination, if any.",
            "readOnly": true,
            "type": "string"
          },
          "end_early_date": {
            "description": "The date when the amortization was terminated early, if applicable.",
            "format": "date",
            "readOnly": true,
            "type": [
              "string",
              "null"
            ]
          },
          "end_early_ts": {
            "description": "The timestamp in UTC when the amortization was terminated early, if applicable.",
            "format": "date-time",
            "readOnly": true,
            "type": [
              "string",
              "null"
            ]
          },
          "events": {
            "description": "The list of amortization events generated by this amortization.",
            "items": {
              "$ref": "#/components/schemas/AmortizationEvent"
            },
            "readOnly": true,
            "type": "array"
          },
          "id": {
            "description": "The unique identifier of the amortization.",
            "readOnly": true,
            "type": "string"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the amortization.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the amortization was last modified.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "notes": {
            "description": "Free-form notes about the amortization.",
            "readOnly": true,
            "type": "string"
          },
          "recognition_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/RecognitionTypeEnum"
              }
            ],
            "description": "How the amortization is recognized (DAILY or MONTHLY).\n\n* `DAILY` - Daily\n* `MONTHLY` - Monthly",
            "readOnly": true
          },
          "start_date": {
            "description": "The start date of the amortization schedule.",
            "format": "date",
            "readOnly": true,
            "type": "string"
          },
          "status": {
            "allOf": [
              {
                "$ref": "#/components/schemas/AmortizationStatusEnum"
              }
            ],
            "description": "The current status of the amortization.\n\n* `AMORTIZING` - Amortizing\n* `DRAFT` - Draft\n* `ENDED_EARLY` - Ended Early\n* `FULLY_AMORTIZED` - Fully Amortized\n* `INACTIVE` - Inactive\n* `SCHEDULED` - Scheduled",
            "readOnly": true
          },
          "use_entity_date": {
            "description": "Whether the amortization start date follows the bill date.",
            "readOnly": true,
            "type": "boolean"
          }
        },
        "required": [
          "account",
          "amount",
          "balance",
          "bill",
          "created_ts",
          "currency",
          "description",
          "duration",
          "end_date",
          "end_early_account",
          "end_early_date",
          "end_early_ts",
          "events",
          "id",
          "legacy_id",
          "modified_ts",
          "notes",
          "recognition_type",
          "start_date",
          "status",
          "use_entity_date"
        ],
        "type": "object"
      },
      "AmortizationEvent": {
        "properties": {
          "amount": {
            "description": "The amount recognized for this event.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "amount_to_bcy": {
            "description": "The amount converted to the organization base currency.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": [
              "number",
              "null"
            ]
          },
          "balance": {
            "description": "The remaining balance after this event.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "date": {
            "description": "The date when this event is recognized.",
            "format": "date",
            "readOnly": true,
            "type": "string"
          },
          "description": {
            "description": "The description of the event.",
            "readOnly": true,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the amortization event.",
            "readOnly": true,
            "type": "string"
          },
          "journal": {
            "description": "The journal entry generated by this amortization event, if posted.",
            "readOnly": true,
            "type": [
              "string",
              "null"
            ]
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the amortization event.",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "amount",
          "amount_to_bcy",
          "balance",
          "date",
          "description",
          "id",
          "journal",
          "legacy_id"
        ],
        "type": "object"
      },
      "AmortizationStatusEnum": {
        "description": "* `AMORTIZING` - Amortizing\n* `DRAFT` - Draft\n* `ENDED_EARLY` - Ended Early\n* `FULLY_AMORTIZED` - Fully Amortized\n* `INACTIVE` - Inactive\n* `SCHEDULED` - Scheduled\n\nFull information for [AmortizationStatusEnum](amortizationstatusenum)",
        "enum": [
          "AMORTIZING",
          "DRAFT",
          "ENDED_EARLY",
          "FULLY_AMORTIZED",
          "INACTIVE",
          "SCHEDULED"
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
      "DurationEnum": {
        "description": "* `3_MONTHS` - 3 Months\n* `4_MONTHS` - 4 Months\n* `6_MONTHS` - 6 Months\n* `12_MONTHS` - 12 Months\n* `24_MONTHS` - 24 Months\n* `CUSTOM` - Custom\n\nFull information for [DurationEnum](durationenum)",
        "enum": [
          "3_MONTHS",
          "4_MONTHS",
          "6_MONTHS",
          "12_MONTHS",
          "24_MONTHS",
          "CUSTOM"
        ],
        "type": "string"
      },
      "RecognitionTypeEnum": {
        "description": "* `DAILY` - Daily\n* `MONTHLY` - Monthly\n\nFull information for [RecognitionTypeEnum](recognitiontypeenum)",
        "enum": [
          "DAILY",
          "MONTHLY"
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
    "/amortizations/{id}/": {
      "get": {
        "description": "Endpoint for retrieving a single amortization.",
        "operationId": "amortizations_retrieve",
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
                  "$ref": "#/components/schemas/Amortization"
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
        "summary": "Retrieve amortization",
        "tags": [
          "Amortizations"
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