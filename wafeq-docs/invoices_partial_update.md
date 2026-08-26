---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Partial update invoice

Endpoint for partially updating an existing invoice.

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
      "Invoice": {
        "description": "Adds nested create feature",
        "properties": {
          "amount": {
            "description": "The total amount of the invoice, including taxes.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "attachments": {
            "description": "Any files or documents attached to this invoice.",
            "items": {
              "type": "string"
            },
            "type": "array"
          },
          "balance": {
            "description": "The remaining balance of the invoice.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "branch": {
            "description": "The branch associated with this invoice.",
            "type": [
              "string",
              "null"
            ]
          },
          "contact": {
            "description": "The contact (customer) associated with this invoice.",
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the invoice was created.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "credit_notes": {
            "description": "The credit notes applied to this invoice.",
            "items": {
              "$ref": "#/components/schemas/InvoiceCreditNote"
            },
            "type": "array"
          },
          "currency": {
            "allOf": [
              {
                "$ref": "#/components/schemas/CurrencyEnum"
              }
            ],
            "description": "The currency code for the invoice.\n\n* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `AZN` - AZN ман.\n* `BAM` - BAM KM\n* `BDT` - BDT ৳\n* `BGN` - BGN лв.\n* `BHD` - BHD د.ب.‏\n* `BIF` - BIF FBu\n* `BND` - BND $\n* `BOB` - BOB Bs\n* `BRL` - BRL R$\n* `BWP` - BWP P\n* `BYN` - BYN BYN\n* `BZD` - BZD $\n* `CDF` - CDF FrCD\n* `CHF` - CHF CHF\n* `CLP` - CLP $\n* `CNY` - CNY CN¥\n* `COP` - COP $\n* `CRC` - CRC ₡\n* `CVE` - CVE CV$\n* `CZK` - CZK Kč\n* `DJF` - DJF Fdj\n* `DKK` - DKK kr\n* `DOP` - DOP RD$\n* `DZD` - DZD د.ج.‏\n* `EGP` - EGP ج.م.‏\n* `ERN` - ERN Nfk\n* `ETB` - ETB Br\n* `GBP` - GBP £\n* `GEL` - GEL GEL\n* `GHS` - GHS GH₵\n* `GNF` - GNF FG\n* `GTQ` - GTQ Q\n* `HKD` - HKD $\n* `HNL` - HNL L\n* `HRK` - HRK kn\n* `HUF` - HUF Ft\n* `IDR` - IDR Rp\n* `ILS` - ILS ₪\n* `INR` - INR ₹\n* `IQD` - IQD د.ع.‏\n* `IRR` - IRR ﷼\n* `ISK` - ISK kr\n* `JMD` - JMD $\n* `JOD` - JOD د.أ.‏\n* `JPY` - JPY ￥\n* `KES` - KES Ksh\n* `KHR` - KHR ៛\n* `KMF` - KMF FC\n* `KRW` - KRW ₩\n* `KWD` - KWD د.ك.‏\n* `KZT` - KZT тңг.\n* `LBP` - LBP ل.ل.‏\n* `LKR` - LKR SL Re\n* `LYD` - LYD د.ل.‏\n* `MAD` - MAD د.م.‏\n* `MDL` - MDL MDL\n* `MGA` - MGA MGA\n* `MKD` - MKD MKD\n* `MMK` - MMK K\n* `MOP` - MOP MOP$\n* `MUR` - MUR MURs\n* `MXN` - MXN $\n* `MYR` - MYR RM\n* `MZN` - MZN MTn\n* `NAD` - NAD N$\n* `NGN` - NGN ₦\n* `NIO` - NIO C$\n* `NOK` - NOK kr\n* `NPR` - NPR नेरू\n* `NZD` - NZD $\n* `OMR` - OMR ر.ع.‏\n* `PAB` - PAB B/.\n* `PEN` - PEN S/.\n* `PHP` - PHP ₱\n* `PKR` - PKR ₨\n* `PLN` - PLN zł\n* `PYG` - PYG ₲\n* `QAR` - QAR ر.ق.‏\n* `RON` - RON RON\n* `RSD` - RSD дин.\n* `RUB` - RUB руб.\n* `RWF` - RWF FR\n* `SDG` - SDG SDG\n* `SEK` - SEK kr\n* `SGD` - SGD $\n* `SOS` - SOS Ssh\n* `SYP` - SYP ل.س.‏\n* `THB` - THB ฿\n* `TND` - TND د.ت.‏\n* `TOP` - TOP T$\n* `TRY` - TRY TL\n* `TTD` - TTD $\n* `TWD` - TWD NT$\n* `TZS` - TZS TSh\n* `UAH` - UAH ₴\n* `UGX` - UGX USh\n* `UYU` - UYU $\n* `UZS` - UZS UZS\n* `VES` - VES Bs.S.\n* `VND` - VND ₫\n* `XAF` - XAF FCFA\n* `XOF` - XOF CFA\n* `YER` - YER ر.ي.‏\n* `ZAR` - ZAR R\n* `ZMW` - ZMW ZK"
          },
          "custom_fields": {
            "additionalProperties": {},
            "description": "A mapping of custom field IDs to their values.",
            "type": "object"
          },
          "discount_account": {
            "description": "The account to which the discount will be booked, if applicable.",
            "type": "string"
          },
          "discount_amount": {
            "description": "The discount amount to apply to the invoice.",
            "exclusiveMaximum": 10000000000000000,
            "format": "double",
            "minimum": 0,
            "type": "number"
          },
          "discount_cost_center": {
            "description": "The cost center associated with the discount, if applicable.",
            "type": "string"
          },
          "discount_tax_rate": {
            "description": "The tax rate applied to the discount, if applicable.",
            "type": "string"
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
            "description": "External identifier for the invoice.",
            "maxLength": 255,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the invoice.",
            "readOnly": true,
            "type": "string"
          },
          "invoice_date": {
            "description": "The date when the invoice was issued.",
            "format": "date",
            "type": "string"
          },
          "invoice_due_date": {
            "description": "The date by which the invoice should be paid.",
            "format": "date",
            "type": "string"
          },
          "invoice_number": {
            "description": "The unique number assigned to this invoice.",
            "type": "string"
          },
          "language": {
            "allOf": [
              {
                "$ref": "#/components/schemas/LanguageEnum"
              }
            ],
            "default": "en",
            "description": "The language in which the invoice is written.\n\n* `ar` - Arabic\n* `en` - English"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the invoice.",
            "readOnly": true,
            "type": "string"
          },
          "line_items": {
            "description": "The individual line items included in this invoice.",
            "items": {
              "$ref": "#/components/schemas/InvoiceLineItem"
            },
            "type": "array"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the invoice was last modified.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "notes": {
            "description": "Additional notes or comments about the invoice.",
            "type": "string"
          },
          "place_of_supply": {
            "description": "The place of supply for UAE organizations. Must be one of: ABU_DHABI, AJMAN, DUBAI, FUJAIRAH, RAS_AL_KHAIMAH, SHARJAH, UMM_AL_QUWAIN or OUTSIDE_UAE.",
            "type": "string"
          },
          "project": {
            "description": "The project associated with this invoice, if applicable.",
            "type": [
              "string",
              "null"
            ]
          },
          "purchase_order": {
            "description": "An optional purchase order number or code for this invoice.",
            "type": "string"
          },
          "reference": {
            "description": "An optional reference number or code for this invoice.",
            "type": "string"
          },
          "status": {
            "allOf": [
              {
                "$ref": "#/components/schemas/Status730Enum"
              }
            ],
            "default": "DRAFT",
            "description": "The current status of the invoice (draft, sent, or finalized).\n\n* `DRAFT` - DRAFT\n* `SENT` - SENT\n* `FINALIZED` - FINALIZED"
          },
          "tax_amount": {
            "description": "The total tax amount applied to this invoice.",
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
            "description": "Specifies whether the tax amount is inclusive or exclusive.\n\n* `TAX_INCLUSIVE` - inc. tax\n* `TAX_EXCLUSIVE` - exc. tax"
          },
          "warehouse": {
            "description": "The warehouse associated with this invoice, if applicable.",
            "type": [
              "string",
              "null"
            ]
          }
        },
        "required": [
          "amount",
          "balance",
          "contact",
          "created_ts",
          "currency",
          "id",
          "invoice_date",
          "invoice_due_date",
          "invoice_number",
          "legacy_id",
          "line_items",
          "modified_ts",
          "tax_amount"
        ],
        "type": "object"
      },
      "InvoiceCreditNote": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "amount": {
            "description": "The amount of the credit note applied to the invoice.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "credit_note": {
            "description": "The unique identifier of the credit note applied to the invoice.",
            "type": "string"
          },
          "date": {
            "description": "The date when the credit note was applied to the invoice.",
            "format": "date",
            "type": "string"
          }
        },
        "required": [
          "amount",
          "credit_note"
        ],
        "type": "object"
      },
      "InvoiceLineItem": {
        "description": "Augment ``custom_fields`` in the output with computed CALCULATED field values.\n\nApply to any line-item serializer whose model has ``get_resolved_custom_fields``.",
        "properties": {
          "account": {
            "description": "The account associated with this line item.",
            "type": "string"
          },
          "cost_center": {
            "description": "The cost center associated with this line item.",
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
            "description": "The total amount for this line item (quantity * unit_amount).",
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
          "revenue_recognition": {
            "description": "Optional revenue recognition configuration. When provided, a revenue recognition is created for this line item.",
            "oneOf": [
              {
                "$ref": "#/components/schemas/RevenueRecognitionInput"
              },
              {
                "type": "null"
              }
            ],
            "writeOnly": true
          },
          "revenue_recognition_id": {
            "description": "The unique identifier of the revenue recognition linked to this line item, if any.",
            "readOnly": true,
            "type": [
              "string",
              "null"
            ]
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
            "description": "The tax rate applied to this line item.",
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
          "created_ts",
          "description",
          "id",
          "legacy_id",
          "line_amount",
          "modified_ts",
          "quantity",
          "revenue_recognition_id",
          "tax_amount",
          "unit_amount"
        ],
        "type": "object"
      },
      "LanguageEnum": {
        "description": "* `ar` - Arabic\n* `en` - English\n\nFull information for [LanguageEnum](languageenum)",
        "enum": [
          "ar",
          "en"
        ],
        "type": "string"
      },
      "PatchedInvoice": {
        "description": "Adds nested create feature",
        "properties": {
          "amount": {
            "description": "The total amount of the invoice, including taxes.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "attachments": {
            "description": "Any files or documents attached to this invoice.",
            "items": {
              "type": "string"
            },
            "type": "array"
          },
          "balance": {
            "description": "The remaining balance of the invoice.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "branch": {
            "description": "The branch associated with this invoice.",
            "type": [
              "string",
              "null"
            ]
          },
          "contact": {
            "description": "The contact (customer) associated with this invoice.",
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the invoice was created.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "credit_notes": {
            "description": "The credit notes applied to this invoice.",
            "items": {
              "$ref": "#/components/schemas/InvoiceCreditNote"
            },
            "type": "array"
          },
          "currency": {
            "allOf": [
              {
                "$ref": "#/components/schemas/CurrencyEnum"
              }
            ],
            "description": "The currency code for the invoice.\n\n* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `AZN` - AZN ман.\n* `BAM` - BAM KM\n* `BDT` - BDT ৳\n* `BGN` - BGN лв.\n* `BHD` - BHD د.ب.‏\n* `BIF` - BIF FBu\n* `BND` - BND $\n* `BOB` - BOB Bs\n* `BRL` - BRL R$\n* `BWP` - BWP P\n* `BYN` - BYN BYN\n* `BZD` - BZD $\n* `CDF` - CDF FrCD\n* `CHF` - CHF CHF\n* `CLP` - CLP $\n* `CNY` - CNY CN¥\n* `COP` - COP $\n* `CRC` - CRC ₡\n* `CVE` - CVE CV$\n* `CZK` - CZK Kč\n* `DJF` - DJF Fdj\n* `DKK` - DKK kr\n* `DOP` - DOP RD$\n* `DZD` - DZD د.ج.‏\n* `EGP` - EGP ج.م.‏\n* `ERN` - ERN Nfk\n* `ETB` - ETB Br\n* `GBP` - GBP £\n* `GEL` - GEL GEL\n* `GHS` - GHS GH₵\n* `GNF` - GNF FG\n* `GTQ` - GTQ Q\n* `HKD` - HKD $\n* `HNL` - HNL L\n* `HRK` - HRK kn\n* `HUF` - HUF Ft\n* `IDR` - IDR Rp\n* `ILS` - ILS ₪\n* `INR` - INR ₹\n* `IQD` - IQD د.ع.‏\n* `IRR` - IRR ﷼\n* `ISK` - ISK kr\n* `JMD` - JMD $\n* `JOD` - JOD د.أ.‏\n* `JPY` - JPY ￥\n* `KES` - KES Ksh\n* `KHR` - KHR ៛\n* `KMF` - KMF FC\n* `KRW` - KRW ₩\n* `KWD` - KWD د.ك.‏\n* `KZT` - KZT тңг.\n* `LBP` - LBP ل.ل.‏\n* `LKR` - LKR SL Re\n* `LYD` - LYD د.ل.‏\n* `MAD` - MAD د.م.‏\n* `MDL` - MDL MDL\n* `MGA` - MGA MGA\n* `MKD` - MKD MKD\n* `MMK` - MMK K\n* `MOP` - MOP MOP$\n* `MUR` - MUR MURs\n* `MXN` - MXN $\n* `MYR` - MYR RM\n* `MZN` - MZN MTn\n* `NAD` - NAD N$\n* `NGN` - NGN ₦\n* `NIO` - NIO C$\n* `NOK` - NOK kr\n* `NPR` - NPR नेरू\n* `NZD` - NZD $\n* `OMR` - OMR ر.ع.‏\n* `PAB` - PAB B/.\n* `PEN` - PEN S/.\n* `PHP` - PHP ₱\n* `PKR` - PKR ₨\n* `PLN` - PLN zł\n* `PYG` - PYG ₲\n* `QAR` - QAR ر.ق.‏\n* `RON` - RON RON\n* `RSD` - RSD дин.\n* `RUB` - RUB руб.\n* `RWF` - RWF FR\n* `SDG` - SDG SDG\n* `SEK` - SEK kr\n* `SGD` - SGD $\n* `SOS` - SOS Ssh\n* `SYP` - SYP ل.س.‏\n* `THB` - THB ฿\n* `TND` - TND د.ت.‏\n* `TOP` - TOP T$\n* `TRY` - TRY TL\n* `TTD` - TTD $\n* `TWD` - TWD NT$\n* `TZS` - TZS TSh\n* `UAH` - UAH ₴\n* `UGX` - UGX USh\n* `UYU` - UYU $\n* `UZS` - UZS UZS\n* `VES` - VES Bs.S.\n* `VND` - VND ₫\n* `XAF` - XAF FCFA\n* `XOF` - XOF CFA\n* `YER` - YER ر.ي.‏\n* `ZAR` - ZAR R\n* `ZMW` - ZMW ZK"
          },
          "custom_fields": {
            "additionalProperties": {},
            "description": "A mapping of custom field IDs to their values.",
            "type": "object"
          },
          "discount_account": {
            "description": "The account to which the discount will be booked, if applicable.",
            "type": "string"
          },
          "discount_amount": {
            "description": "The discount amount to apply to the invoice.",
            "exclusiveMaximum": 10000000000000000,
            "format": "double",
            "minimum": 0,
            "type": "number"
          },
          "discount_cost_center": {
            "description": "The cost center associated with the discount, if applicable.",
            "type": "string"
          },
          "discount_tax_rate": {
            "description": "The tax rate applied to the discount, if applicable.",
            "type": "string"
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
            "description": "External identifier for the invoice.",
            "maxLength": 255,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the invoice.",
            "readOnly": true,
            "type": "string"
          },
          "invoice_date": {
            "description": "The date when the invoice was issued.",
            "format": "date",
            "type": "string"
          },
          "invoice_due_date": {
            "description": "The date by which the invoice should be paid.",
            "format": "date",
            "type": "string"
          },
          "invoice_number": {
            "description": "The unique number assigned to this invoice.",
            "type": "string"
          },
          "language": {
            "allOf": [
              {
                "$ref": "#/components/schemas/LanguageEnum"
              }
            ],
            "default": "en",
            "description": "The language in which the invoice is written.\n\n* `ar` - Arabic\n* `en` - English"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the invoice.",
            "readOnly": true,
            "type": "string"
          },
          "line_items": {
            "description": "The individual line items included in this invoice.",
            "items": {
              "$ref": "#/components/schemas/InvoiceLineItem"
            },
            "type": "array"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the invoice was last modified.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "notes": {
            "description": "Additional notes or comments about the invoice.",
            "type": "string"
          },
          "place_of_supply": {
            "description": "The place of supply for UAE organizations. Must be one of: ABU_DHABI, AJMAN, DUBAI, FUJAIRAH, RAS_AL_KHAIMAH, SHARJAH, UMM_AL_QUWAIN or OUTSIDE_UAE.",
            "type": "string"
          },
          "project": {
            "description": "The project associated with this invoice, if applicable.",
            "type": [
              "string",
              "null"
            ]
          },
          "purchase_order": {
            "description": "An optional purchase order number or code for this invoice.",
            "type": "string"
          },
          "reference": {
            "description": "An optional reference number or code for this invoice.",
            "type": "string"
          },
          "status": {
            "allOf": [
              {
                "$ref": "#/components/schemas/Status730Enum"
              }
            ],
            "default": "DRAFT",
            "description": "The current status of the invoice (draft, sent, or finalized).\n\n* `DRAFT` - DRAFT\n* `SENT` - SENT\n* `FINALIZED` - FINALIZED"
          },
          "tax_amount": {
            "description": "The total tax amount applied to this invoice.",
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
            "description": "Specifies whether the tax amount is inclusive or exclusive.\n\n* `TAX_INCLUSIVE` - inc. tax\n* `TAX_EXCLUSIVE` - exc. tax"
          },
          "warehouse": {
            "description": "The warehouse associated with this invoice, if applicable.",
            "type": [
              "string",
              "null"
            ]
          }
        },
        "type": "object"
      },
      "RecognitionTypeEnum": {
        "description": "* `DAILY` - Daily\n* `MONTHLY` - Monthly\n\nFull information for [RecognitionTypeEnum](recognitiontypeenum)",
        "enum": [
          "DAILY",
          "MONTHLY"
        ],
        "type": "string"
      },
      "RevenueRecognitionInput": {
        "properties": {
          "account": {
            "description": "The revenue account used for revenue recognition.",
            "type": "string"
          },
          "amount": {
            "description": "The total amount to recognize.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "description": {
            "description": "The description of the revenue recognition.",
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
            "description": "The end date of the revenue recognition schedule.",
            "format": "date",
            "type": "string"
          },
          "recognition_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/RecognitionTypeEnum"
              }
            ],
            "description": "How the revenue recognition is recognized (DAILY or MONTHLY).\n\n* `DAILY` - Daily\n* `MONTHLY` - Monthly"
          },
          "start_date": {
            "description": "The start date of the revenue recognition schedule.",
            "format": "date",
            "type": "string"
          },
          "use_entity_date": {
            "description": "Whether the revenue recognition start date follows the invoice date.",
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
      "Status730Enum": {
        "description": "* `DRAFT` - DRAFT\n* `SENT` - SENT\n* `FINALIZED` - FINALIZED\n\nFull information for [Status730Enum](status730enum)",
        "enum": [
          "DRAFT",
          "SENT",
          "FINALIZED"
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
    "/invoices/{id}/": {
      "patch": {
        "description": "Endpoint for partially updating an existing invoice.",
        "operationId": "invoices_partial_update",
        "parameters": [
          {
            "description": "Client-provided UUID to uniquely identify a request",
            "in": "header",
            "name": "X-Wafeq-Idempotency-Key",
            "schema": {
              "type": "string"
            }
          },
          {
            "in": "path",
            "name": "id",
            "required": true,
            "schema": {
              "type": "string"
            }
          }
        ],
        "requestBody": {
          "content": {
            "application/json": {
              "schema": {
                "$ref": "#/components/schemas/PatchedInvoice"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/PatchedInvoice"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/PatchedInvoice"
              }
            }
          }
        },
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/Invoice"
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
        "summary": "Partial update invoice",
        "tags": [
          "Invoices"
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