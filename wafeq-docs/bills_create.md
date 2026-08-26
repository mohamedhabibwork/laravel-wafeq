---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Create bill

Endpoint for creating a new bill.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "AmortizationInput": {
        "properties": {
          "account": {
            "description": "The expense account used for amortization recognition.",
            "type": "string"
          },
          "amount": {
            "description": "The total amount to amortize.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "description": {
            "description": "The description of the amortization.",
            "type": "string"
          },
          "duration": {
            "allOf": [
              {
                "$ref": "#/components/schemas/DurationEnum"
              }
            ],
            "description": "The recognition duration.\n\n* `3_MONTHS` - 3 Months\n* `4_MONTHS` - 4 Months\n* `6_MONTHS` - 6 Months\n* `12_MONTHS` - 12 Months\n* `24_MONTHS` - 24 Months\n* `CUSTOM` - Custom"
          },
          "end_date": {
            "description": "The end date of the amortization schedule.",
            "format": "date",
            "type": "string"
          },
          "recognition_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/RecognitionTypeEnum"
              }
            ],
            "description": "How the amortization is recognized (DAILY or MONTHLY).\n\n* `DAILY` - Daily\n* `MONTHLY` - Monthly"
          },
          "start_date": {
            "description": "The start date of the amortization schedule.",
            "format": "date",
            "type": "string"
          },
          "use_entity_date": {
            "description": "Whether the amortization start date follows the bill date.",
            "type": "boolean"
          }
        },
        "required": [
          "account",
          "amount",
          "description",
          "duration",
          "end_date",
          "recognition_type",
          "start_date",
          "use_entity_date"
        ],
        "type": "object"
      },
      "Bill": {
        "description": "Adds nested create feature",
        "properties": {
          "amount": {
            "description": "The total amount of the bill, including taxes and discounts.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "attachments": {
            "description": "List of attachments linked to this bill.",
            "items": {
              "type": "string"
            },
            "type": "array"
          },
          "balance": {
            "description": "The remaining balance of the bill that is yet to be paid.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "bill_date": {
            "description": "The date when the bill was issued.",
            "format": "date",
            "type": "string"
          },
          "bill_due_date": {
            "description": "The date by which the bill should be paid.",
            "format": "date",
            "type": "string"
          },
          "bill_number": {
            "description": "The unique identifier or number assigned to this bill.",
            "type": "string"
          },
          "branch": {
            "description": "The branch associated with this bill, if applicable.",
            "type": [
              "string",
              "null"
            ]
          },
          "contact": {
            "description": "The contact (vendor) associated with this bill.",
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the bill was created",
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
            "description": "The currency in which the bill is issued.\n\n* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `AZN` - AZN ман.\n* `BAM` - BAM KM\n* `BDT` - BDT ৳\n* `BGN` - BGN лв.\n* `BHD` - BHD د.ب.‏\n* `BIF` - BIF FBu\n* `BND` - BND $\n* `BOB` - BOB Bs\n* `BRL` - BRL R$\n* `BWP` - BWP P\n* `BYN` - BYN BYN\n* `BZD` - BZD $\n* `CDF` - CDF FrCD\n* `CHF` - CHF CHF\n* `CLP` - CLP $\n* `CNY` - CNY CN¥\n* `COP` - COP $\n* `CRC` - CRC ₡\n* `CVE` - CVE CV$\n* `CZK` - CZK Kč\n* `DJF` - DJF Fdj\n* `DKK` - DKK kr\n* `DOP` - DOP RD$\n* `DZD` - DZD د.ج.‏\n* `EGP` - EGP ج.م.‏\n* `ERN` - ERN Nfk\n* `ETB` - ETB Br\n* `GBP` - GBP £\n* `GEL` - GEL GEL\n* `GHS` - GHS GH₵\n* `GNF` - GNF FG\n* `GTQ` - GTQ Q\n* `HKD` - HKD $\n* `HNL` - HNL L\n* `HRK` - HRK kn\n* `HUF` - HUF Ft\n* `IDR` - IDR Rp\n* `ILS` - ILS ₪\n* `INR` - INR ₹\n* `IQD` - IQD د.ع.‏\n* `IRR` - IRR ﷼\n* `ISK` - ISK kr\n* `JMD` - JMD $\n* `JOD` - JOD د.أ.‏\n* `JPY` - JPY ￥\n* `KES` - KES Ksh\n* `KHR` - KHR ៛\n* `KMF` - KMF FC\n* `KRW` - KRW ₩\n* `KWD` - KWD د.ك.‏\n* `KZT` - KZT тңг.\n* `LBP` - LBP ل.ل.‏\n* `LKR` - LKR SL Re\n* `LYD` - LYD د.ل.‏\n* `MAD` - MAD د.م.‏\n* `MDL` - MDL MDL\n* `MGA` - MGA MGA\n* `MKD` - MKD MKD\n* `MMK` - MMK K\n* `MOP` - MOP MOP$\n* `MUR` - MUR MURs\n* `MXN` - MXN $\n* `MYR` - MYR RM\n* `MZN` - MZN MTn\n* `NAD` - NAD N$\n* `NGN` - NGN ₦\n* `NIO` - NIO C$\n* `NOK` - NOK kr\n* `NPR` - NPR नेरू\n* `NZD` - NZD $\n* `OMR` - OMR ر.ع.‏\n* `PAB` - PAB B/.\n* `PEN` - PEN S/.\n* `PHP` - PHP ₱\n* `PKR` - PKR ₨\n* `PLN` - PLN zł\n* `PYG` - PYG ₲\n* `QAR` - QAR ر.ق.‏\n* `RON` - RON RON\n* `RSD` - RSD дин.\n* `RUB` - RUB руб.\n* `RWF` - RWF FR\n* `SDG` - SDG SDG\n* `SEK` - SEK kr\n* `SGD` - SGD $\n* `SOS` - SOS Ssh\n* `SYP` - SYP ل.س.‏\n* `THB` - THB ฿\n* `TND` - TND د.ت.‏\n* `TOP` - TOP T$\n* `TRY` - TRY TL\n* `TTD` - TTD $\n* `TWD` - TWD NT$\n* `TZS` - TZS TSh\n* `UAH` - UAH ₴\n* `UGX` - UGX USh\n* `UYU` - UYU $\n* `UZS` - UZS UZS\n* `VES` - VES Bs.S.\n* `VND` - VND ₫\n* `XAF` - XAF FCFA\n* `XOF` - XOF CFA\n* `YER` - YER ر.ي.‏\n* `ZAR` - ZAR R\n* `ZMW` - ZMW ZK"
          },
          "custom_fields": {
            "additionalProperties": {},
            "description": "A mapping of custom field IDs to their values.",
            "type": "object"
          },
          "debit_notes": {
            "description": "The debit notes applied to this bill for payment or adjustment.",
            "items": {
              "$ref": "#/components/schemas/BillDebitNote"
            },
            "type": "array"
          },
          "exchange_rate": {
            "description": "The exchange rate to the organization base currency at the time of the document.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": [
              "number",
              "null"
            ]
          },
          "external_id": {
            "default": "",
            "description": "External identifier for the bill.",
            "maxLength": 255,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the bill.",
            "readOnly": true,
            "type": "string"
          },
          "language": {
            "$ref": "#/components/schemas/LanguageEnum"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the bill.",
            "readOnly": true,
            "type": "string"
          },
          "line_items": {
            "description": "The individual line items that make up the bill.",
            "items": {
              "$ref": "#/components/schemas/BillLineItem"
            },
            "type": "array"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the bill was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "notes": {
            "description": "Any additional notes or comments related to the bill.",
            "type": "string"
          },
          "order_number": {
            "default": "",
            "description": "The order number associated with this bill, if any.",
            "type": "string"
          },
          "project": {
            "description": "The project associated with this bill, if any.",
            "type": [
              "string",
              "null"
            ]
          },
          "reference": {
            "default": "",
            "description": "Any additional reference information for this bill.",
            "type": "string"
          },
          "status": {
            "allOf": [
              {
                "$ref": "#/components/schemas/BillStatusEnum"
              }
            ],
            "default": "DRAFT",
            "description": "The current status of the bill (Draft, Authorized, or Paid).\n\n* `DRAFT` - DRAFT\n* `AUTHORIZED` - AUTHORIZED\n* `PAID` - PAID"
          },
          "tax_amount": {
            "description": "The total tax amount applied to the bill.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "tax_amount_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/TaxAmountTypeEnum"
              }
            ],
            "description": "Specifies whether the tax amount is inclusive or exclusive of the line item amounts.\n\n* `TAX_INCLUSIVE` - inc. tax\n* `TAX_EXCLUSIVE` - exc. tax"
          }
        },
        "required": [
          "amount",
          "balance",
          "bill_date",
          "bill_due_date",
          "bill_number",
          "created_ts",
          "currency",
          "id",
          "legacy_id",
          "line_items",
          "modified_ts",
          "tax_amount"
        ],
        "type": "object"
      },
      "BillDebitNote": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "amount": {
            "description": "The amount of the debit note applied to the bill.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "date": {
            "description": "The date when the debit note was applied to the bill.",
            "format": "date",
            "type": "string"
          },
          "debit_note": {
            "description": "The unique identifier of the associated debit note",
            "type": "string"
          }
        },
        "required": [
          "amount",
          "debit_note"
        ],
        "type": "object"
      },
      "BillLineItem": {
        "description": "Augment ``custom_fields`` in the output with computed CALCULATED field values.\n\nApply to any line-item serializer whose model has ``get_resolved_custom_fields``.",
        "properties": {
          "account": {
            "description": "The account associated with this line item.",
            "type": "string"
          },
          "amortization": {
            "description": "Optional amortization configuration. When provided, an amortization is created for this line item.",
            "oneOf": [
              {
                "$ref": "#/components/schemas/AmortizationInput"
              },
              {
                "type": "null"
              }
            ],
            "writeOnly": true
          },
          "amortization_id": {
            "description": "The unique identifier of the amortization linked to this line item, if any.",
            "readOnly": true,
            "type": [
              "string",
              "null"
            ]
          },
          "cost_center": {
            "description": "The cost center associated with this line item, if any.",
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the line item was created.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "custom_fields": {
            "additionalProperties": {},
            "description": "A mapping of custom field IDs to their values.",
            "type": "object"
          },
          "description": {
            "description": "The detailed description of the line item.",
            "type": "string"
          },
          "discount": {
            "description": "The discount as the percentage.",
            "exclusiveMaximum": 10000000000000000,
            "format": "double",
            "minimum": 0,
            "type": [
              "number",
              "null"
            ]
          },
          "id": {
            "description": "The unique identifier of the line item.",
            "readOnly": true,
            "type": "string"
          },
          "item": {
            "description": "The item associated with this line item.",
            "type": "string"
          },
          "item_unit_of_measure": {
            "description": "The item unit of measure for this line item.",
            "type": [
              "string",
              "null"
            ]
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the line item.",
            "readOnly": true,
            "type": "string"
          },
          "line_amount": {
            "description": "The total amount for this line item, calculated as quantity * unit_amount - discount.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the line item was last modified.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "order": {
            "type": "integer",
            "writeOnly": true
          },
          "quantity": {
            "description": "The quantity of the item or service.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "tax_amount": {
            "description": "The total tax amount for this line item.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "tax_rate": {
            "description": "The tax rate applied to this line item, if any.",
            "type": "string"
          },
          "unit_amount": {
            "description": "The price per unit of the item or service.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          }
        },
        "required": [
          "account",
          "amortization_id",
          "created_ts",
          "description",
          "id",
          "legacy_id",
          "line_amount",
          "modified_ts",
          "quantity",
          "tax_amount",
          "unit_amount"
        ],
        "type": "object"
      },
      "BillStatusEnum": {
        "description": "* `DRAFT` - DRAFT\n* `AUTHORIZED` - AUTHORIZED\n* `PAID` - PAID\n\nFull information for [BillStatusEnum](billstatusenum)",
        "enum": [
          "DRAFT",
          "AUTHORIZED",
          "PAID"
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
      "LanguageEnum": {
        "description": "* `ar` - Arabic\n* `en` - English\n\nFull information for [LanguageEnum](languageenum)",
        "enum": [
          "ar",
          "en"
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
    "/bills/": {
      "post": {
        "description": "Endpoint for creating a new bill.",
        "operationId": "bills_create",
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
                "$ref": "#/components/schemas/Bill"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/Bill"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/Bill"
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
                  "$ref": "#/components/schemas/Bill"
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
        "summary": "Create bill",
        "tags": [
          "Bills"
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