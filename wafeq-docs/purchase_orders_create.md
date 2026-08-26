---
updatedAt: 2026-05-11T13:43:28.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Create purchase order

Endpoint for creating a new purchase order.

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
      "LanguageEnum": {
        "description": "* `ar` - Arabic\n* `en` - English\n\nFull information for [LanguageEnum](languageenum)",
        "enum": [
          "ar",
          "en"
        ],
        "type": "string"
      },
      "PurchaseOrder": {
        "description": "Adds nested create feature",
        "properties": {
          "amount": {
            "description": "The total amount of the purchase order, including taxes and discounts.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "attachments": {
            "description": "List of attachments linked to this purchase order.",
            "items": {
              "type": "string"
            },
            "type": "array"
          },
          "branch": {
            "description": "The branch associated with this purchase order, if applicable.",
            "type": [
              "string",
              "null"
            ]
          },
          "contact": {
            "description": "The contact (vendor) associated with this purchase order.",
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the purchase order was created.",
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
            "description": "The currency in which the purchase order is issued.\n\n* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `AZN` - AZN ман.\n* `BAM` - BAM KM\n* `BDT` - BDT ৳\n* `BGN` - BGN лв.\n* `BHD` - BHD د.ب.‏\n* `BIF` - BIF FBu\n* `BND` - BND $\n* `BOB` - BOB Bs\n* `BRL` - BRL R$\n* `BWP` - BWP P\n* `BYN` - BYN BYN\n* `BZD` - BZD $\n* `CDF` - CDF FrCD\n* `CHF` - CHF CHF\n* `CLP` - CLP $\n* `CNY` - CNY CN¥\n* `COP` - COP $\n* `CRC` - CRC ₡\n* `CVE` - CVE CV$\n* `CZK` - CZK Kč\n* `DJF` - DJF Fdj\n* `DKK` - DKK kr\n* `DOP` - DOP RD$\n* `DZD` - DZD د.ج.‏\n* `EGP` - EGP ج.م.‏\n* `ERN` - ERN Nfk\n* `ETB` - ETB Br\n* `GBP` - GBP £\n* `GEL` - GEL GEL\n* `GHS` - GHS GH₵\n* `GNF` - GNF FG\n* `GTQ` - GTQ Q\n* `HKD` - HKD $\n* `HNL` - HNL L\n* `HRK` - HRK kn\n* `HUF` - HUF Ft\n* `IDR` - IDR Rp\n* `ILS` - ILS ₪\n* `INR` - INR ₹\n* `IQD` - IQD د.ع.‏\n* `IRR` - IRR ﷼\n* `ISK` - ISK kr\n* `JMD` - JMD $\n* `JOD` - JOD د.أ.‏\n* `JPY` - JPY ￥\n* `KES` - KES Ksh\n* `KHR` - KHR ៛\n* `KMF` - KMF FC\n* `KRW` - KRW ₩\n* `KWD` - KWD د.ك.‏\n* `KZT` - KZT тңг.\n* `LBP` - LBP ل.ل.‏\n* `LKR` - LKR SL Re\n* `LYD` - LYD د.ل.‏\n* `MAD` - MAD د.م.‏\n* `MDL` - MDL MDL\n* `MGA` - MGA MGA\n* `MKD` - MKD MKD\n* `MMK` - MMK K\n* `MOP` - MOP MOP$\n* `MUR` - MUR MURs\n* `MXN` - MXN $\n* `MYR` - MYR RM\n* `MZN` - MZN MTn\n* `NAD` - NAD N$\n* `NGN` - NGN ₦\n* `NIO` - NIO C$\n* `NOK` - NOK kr\n* `NPR` - NPR नेरू\n* `NZD` - NZD $\n* `OMR` - OMR ر.ع.‏\n* `PAB` - PAB B/.\n* `PEN` - PEN S/.\n* `PHP` - PHP ₱\n* `PKR` - PKR ₨\n* `PLN` - PLN zł\n* `PYG` - PYG ₲\n* `QAR` - QAR ر.ق.‏\n* `RON` - RON RON\n* `RSD` - RSD дин.\n* `RUB` - RUB руб.\n* `RWF` - RWF FR\n* `SDG` - SDG SDG\n* `SEK` - SEK kr\n* `SGD` - SGD $\n* `SOS` - SOS Ssh\n* `SYP` - SYP ل.س.‏\n* `THB` - THB ฿\n* `TND` - TND د.ت.‏\n* `TOP` - TOP T$\n* `TRY` - TRY TL\n* `TTD` - TTD $\n* `TWD` - TWD NT$\n* `TZS` - TZS TSh\n* `UAH` - UAH ₴\n* `UGX` - UGX USh\n* `UYU` - UYU $\n* `UZS` - UZS UZS\n* `VES` - VES Bs.S.\n* `VND` - VND ₫\n* `XAF` - XAF FCFA\n* `XOF` - XOF CFA\n* `YER` - YER ر.ي.‏\n* `ZAR` - ZAR R\n* `ZMW` - ZMW ZK"
          },
          "custom_fields": {
            "additionalProperties": {},
            "description": "A mapping of custom field IDs to their values.",
            "type": "object"
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
            "description": "External identifier for the purchase order.",
            "maxLength": 255,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the purchase order.",
            "readOnly": true,
            "type": "string"
          },
          "language": {
            "$ref": "#/components/schemas/LanguageEnum"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the purchase order.",
            "readOnly": true,
            "type": "string"
          },
          "line_items": {
            "description": "The individual line items that make up the purchase order.",
            "items": {
              "$ref": "#/components/schemas/PurchaseOrderLineItem"
            },
            "type": "array"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the purchase order was last modified.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "notes": {
            "description": "Any additional notes or comments related to the purchase order.",
            "type": "string"
          },
          "project": {
            "description": "The project associated with this purchase order, if any.",
            "type": [
              "string",
              "null"
            ]
          },
          "purchase_order_date": {
            "description": "The date when the purchase order was issued.",
            "format": "date",
            "type": [
              "string",
              "null"
            ]
          },
          "purchase_order_number": {
            "description": "The unique identifier or number assigned to this purchase order.",
            "type": "string"
          },
          "reference": {
            "description": "Any additional reference information for this purchase order.",
            "type": "string"
          },
          "status": {
            "allOf": [
              {
                "$ref": "#/components/schemas/PurchaseOrderStatusEnum"
              }
            ],
            "default": "DRAFT",
            "description": "The current status of the purchase order (Draft, Sent, Billed, or Voided).\n\n* `DRAFT` - DRAFT\n* `SENT` - SENT\n* `BILLED` - BILLED\n* `VOIDED` - VOIDED"
          },
          "tax_amount": {
            "description": "The total tax amount applied to the purchase order.",
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
          },
          "terms": {
            "description": "The terms and conditions of the purchase order.",
            "type": "string"
          }
        },
        "required": [
          "amount",
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
      "PurchaseOrderLineItem": {
        "description": "Augment ``custom_fields`` in the output with computed CALCULATED field values.\n\nApply to any line-item serializer whose model has ``get_resolved_custom_fields``.",
        "properties": {
          "account": {
            "description": "The account associated with this line item.",
            "type": "string"
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
      "PurchaseOrderStatusEnum": {
        "description": "* `DRAFT` - DRAFT\n* `SENT` - SENT\n* `BILLED` - BILLED\n* `VOIDED` - VOIDED\n\nFull information for [PurchaseOrderStatusEnum](purchaseorderstatusenum)",
        "enum": [
          "DRAFT",
          "SENT",
          "BILLED",
          "VOIDED"
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
    "/purchase-orders/": {
      "post": {
        "description": "Endpoint for creating a new purchase order.",
        "operationId": "purchase_orders_create",
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
                "$ref": "#/components/schemas/PurchaseOrder"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/PurchaseOrder"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/PurchaseOrder"
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
                  "$ref": "#/components/schemas/PurchaseOrder"
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
        "summary": "Create purchase order",
        "tags": [
          "Purchase Orders"
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