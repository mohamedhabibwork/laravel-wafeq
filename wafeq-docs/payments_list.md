---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# List payments

Endpoint for retrieving a list of payments.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "AdvanceCreditNote": {
        "properties": {
          "amount": {
            "description": "The advance amount in the payment currency. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "credit_note_number": {
            "description": "The number of the credit note auto-generated to back this customer advance. Read-only field.",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "amount",
          "credit_note_number"
        ],
        "type": "object"
      },
      "AdvanceDebitNote": {
        "properties": {
          "amount": {
            "description": "The advance amount in the payment currency. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "debit_note_number": {
            "description": "The number of the debit note auto-generated to back this supplier advance. Read-only field.",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "amount",
          "debit_note_number"
        ],
        "type": "object"
      },
      "BillPayment": {
        "properties": {
          "amount": {
            "description": "The amount to pay off in the bill currency. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "amount_to_pcy": {
            "description": "The same amount expressed in the payment currency. When the bill and the payment share a currency this equals `amount`; otherwise it is the converted value. The two are never subtracted from each other directly — each is valued in the organization base currency, `amount` at the bill exchange rate and `amount_to_pcy` at the payment exchange rate, and the difference between those two base-currency values is posted as an exchange gain or loss. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "bill": {
            "description": "The unique identifier of the bill to be paid.",
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the payment was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the payment was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "amount",
          "amount_to_pcy",
          "bill",
          "created_ts",
          "modified_ts"
        ],
        "type": "object"
      },
      "CreditNotePayment": {
        "properties": {
          "amount": {
            "description": "The amount to apply in the credit note currency. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "amount_to_pcy": {
            "description": "The same amount expressed in the payment currency. When the credit note and the payment share a currency this equals `amount`; otherwise it is the converted value. The two are never subtracted from each other directly — each is valued in the organization base currency, `amount` at the credit note exchange rate and `amount_to_pcy` at the payment exchange rate, and the difference between those two base-currency values is posted as an exchange gain or loss. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the payment was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "credit_note": {
            "description": "The unique identifier of the credit note to be applied.",
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the payment was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "amount",
          "amount_to_pcy",
          "created_ts",
          "credit_note",
          "modified_ts"
        ],
        "type": "object"
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
      "DebitNotePayment": {
        "properties": {
          "amount": {
            "description": "The amount to pay off in the debit note currency. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "amount_to_pcy": {
            "description": "The same amount expressed in the payment currency. When the debit note and the payment share a currency this equals `amount`; otherwise it is the converted value. The two are never subtracted from each other directly — each is valued in the organization base currency, `amount` at the debit note exchange rate and `amount_to_pcy` at the payment exchange rate, and the difference between those two base-currency values is posted as an exchange gain or loss. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the payment was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "debit_note": {
            "description": "The unique identifier of the debit note to be paid.",
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the payment was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "amount",
          "amount_to_pcy",
          "created_ts",
          "debit_note",
          "modified_ts"
        ],
        "type": "object"
      },
      "InvoicePayment": {
        "properties": {
          "amount": {
            "description": "The amount to pay off in the invoice currency. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "amount_to_pcy": {
            "description": "The same amount expressed in the payment currency. When the invoice and the payment share a currency this equals `amount`; otherwise it is the converted value. The two are never subtracted from each other directly — each is valued in the organization base currency, `amount` at the invoice exchange rate and `amount_to_pcy` at the payment exchange rate, and the difference between those two base-currency values is posted as an exchange gain or loss. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the payment was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "invoice": {
            "description": "The unique identifier of the invoice to be paid.",
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the payment was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "amount",
          "amount_to_pcy",
          "created_ts",
          "invoice",
          "modified_ts"
        ],
        "type": "object"
      },
      "PaginatedPaymentList": {
        "properties": {
          "count": {
            "example": 123,
            "type": "integer"
          },
          "next": {
            "example": "http://api.example.org/accounts/?page=4",
            "format": "uri",
            "nullable": true,
            "type": "string"
          },
          "previous": {
            "example": "http://api.example.org/accounts/?page=2",
            "format": "uri",
            "nullable": true,
            "type": "string"
          },
          "results": {
            "items": {
              "$ref": "#/components/schemas/Payment"
            },
            "type": "array"
          }
        },
        "required": [
          "count",
          "results"
        ],
        "type": "object"
      },
      "Payment": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "amount": {
            "description": "The total amount of the payment, in the payment currency. It must reconcile against whichever list is set. The five document-linked lists (`invoice_payments`, `bill_payments`, `credit_note_payments`, `debit_note_payments`, `payslip_payments`) are summed by `amount_to_pcy`; the two advance blocks (`credit_notes`, `debit_notes`) carry no `amount_to_pcy` and are summed by `amount` instead. For money-out payments (`bill_payments`, `credit_note_payments`, `payslip_payments`, `debit_notes`) `amount` equals that sum plus `payment_fees`; for money-in payments (`invoice_payments`, `debit_note_payments`, `credit_notes`) it equals that sum minus `payment_fees`. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "bill_payments": {
            "description": "A list of objects to represent bill payments. Required if paying bills.",
            "items": {
              "$ref": "#/components/schemas/BillPayment"
            },
            "type": "array"
          },
          "contact": {
            "description": "The unique identifier of the contact associated with this payment.",
            "type": "string"
          },
          "cost_center": {
            "description": "The unique identifier of the cost center associated with this payment.",
            "type": [
              "string",
              "null"
            ]
          },
          "created_ts": {
            "description": "The timestamp in UTC when the payment was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "credit_note_payments": {
            "description": "A list of objects to represent credit note payments. Required if applying credit notes.",
            "items": {
              "$ref": "#/components/schemas/CreditNotePayment"
            },
            "type": "array"
          },
          "credit_notes": {
            "description": "A list with a single object to record a customer advance (money received before any invoice exists). A matching credit note is auto-generated.",
            "items": {
              "$ref": "#/components/schemas/AdvanceCreditNote"
            },
            "type": "array"
          },
          "currency": {
            "allOf": [
              {
                "$ref": "#/components/schemas/CurrencyEnum"
              }
            ],
            "description": "The currency code of the payment.\n\n* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `AZN` - AZN ман.\n* `BAM` - BAM KM\n* `BDT` - BDT ৳\n* `BGN` - BGN лв.\n* `BHD` - BHD د.ب.‏\n* `BIF` - BIF FBu\n* `BND` - BND $\n* `BOB` - BOB Bs\n* `BRL` - BRL R$\n* `BWP` - BWP P\n* `BYN` - BYN BYN\n* `BZD` - BZD $\n* `CDF` - CDF FrCD\n* `CHF` - CHF CHF\n* `CLP` - CLP $\n* `CNY` - CNY CN¥\n* `COP` - COP $\n* `CRC` - CRC ₡\n* `CVE` - CVE CV$\n* `CZK` - CZK Kč\n* `DJF` - DJF Fdj\n* `DKK` - DKK kr\n* `DOP` - DOP RD$\n* `DZD` - DZD د.ج.‏\n* `EGP` - EGP ج.م.‏\n* `ERN` - ERN Nfk\n* `ETB` - ETB Br\n* `GBP` - GBP £\n* `GEL` - GEL GEL\n* `GHS` - GHS GH₵\n* `GNF` - GNF FG\n* `GTQ` - GTQ Q\n* `HKD` - HKD $\n* `HNL` - HNL L\n* `HRK` - HRK kn\n* `HUF` - HUF Ft\n* `IDR` - IDR Rp\n* `ILS` - ILS ₪\n* `INR` - INR ₹\n* `IQD` - IQD د.ع.‏\n* `IRR` - IRR ﷼\n* `ISK` - ISK kr\n* `JMD` - JMD $\n* `JOD` - JOD د.أ.‏\n* `JPY` - JPY ￥\n* `KES` - KES Ksh\n* `KHR` - KHR ៛\n* `KMF` - KMF FC\n* `KRW` - KRW ₩\n* `KWD` - KWD د.ك.‏\n* `KZT` - KZT тңг.\n* `LBP` - LBP ل.ل.‏\n* `LKR` - LKR SL Re\n* `LYD` - LYD د.ل.‏\n* `MAD` - MAD د.م.‏\n* `MDL` - MDL MDL\n* `MGA` - MGA MGA\n* `MKD` - MKD MKD\n* `MMK` - MMK K\n* `MOP` - MOP MOP$\n* `MUR` - MUR MURs\n* `MXN` - MXN $\n* `MYR` - MYR RM\n* `MZN` - MZN MTn\n* `NAD` - NAD N$\n* `NGN` - NGN ₦\n* `NIO` - NIO C$\n* `NOK` - NOK kr\n* `NPR` - NPR नेरू\n* `NZD` - NZD $\n* `OMR` - OMR ر.ع.‏\n* `PAB` - PAB B/.\n* `PEN` - PEN S/.\n* `PHP` - PHP ₱\n* `PKR` - PKR ₨\n* `PLN` - PLN zł\n* `PYG` - PYG ₲\n* `QAR` - QAR ر.ق.‏\n* `RON` - RON RON\n* `RSD` - RSD дин.\n* `RUB` - RUB руб.\n* `RWF` - RWF FR\n* `SDG` - SDG SDG\n* `SEK` - SEK kr\n* `SGD` - SGD $\n* `SOS` - SOS Ssh\n* `SYP` - SYP ل.س.‏\n* `THB` - THB ฿\n* `TND` - TND د.ت.‏\n* `TOP` - TOP T$\n* `TRY` - TRY TL\n* `TTD` - TTD $\n* `TWD` - TWD NT$\n* `TZS` - TZS TSh\n* `UAH` - UAH ₴\n* `UGX` - UGX USh\n* `UYU` - UYU $\n* `UZS` - UZS UZS\n* `VES` - VES Bs.S.\n* `VND` - VND ₫\n* `XAF` - XAF FCFA\n* `XOF` - XOF CFA\n* `YER` - YER ر.ي.‏\n* `ZAR` - ZAR R\n* `ZMW` - ZMW ZK"
          },
          "date": {
            "description": "The date when the payment was made or received.",
            "format": "date",
            "type": "string"
          },
          "debit_note_payments": {
            "description": "A list of objects to represent debit note payments. Required if paying debit notes.",
            "items": {
              "$ref": "#/components/schemas/DebitNotePayment"
            },
            "type": "array"
          },
          "debit_notes": {
            "description": "A list with a single object to record a supplier advance (money paid before any bill exists). A matching debit note is auto-generated.",
            "items": {
              "$ref": "#/components/schemas/AdvanceDebitNote"
            },
            "type": "array"
          },
          "employee": {
            "description": "The unique identifier of the employee associated with this payment. Required for payslip payments.",
            "type": "string"
          },
          "exchange_rate": {
            "description": "The exchange rate to the organization base currency at the time of the payment.",
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
            "description": "External identifier for the payment.",
            "maxLength": 255,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the payment. Read-only field.",
            "readOnly": true,
            "type": "string"
          },
          "invoice_payments": {
            "description": "A list of objects to represent invoice payments. Required if paying invoices.",
            "items": {
              "$ref": "#/components/schemas/InvoicePayment"
            },
            "type": "array"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the payment.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the payment was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "paid_through_account": {
            "description": "The account used for this payment. Must be a valid payment account.",
            "type": "string"
          },
          "payment_fees": {
            "description": "Bank charges, or the residual left over when the lines do not add up to `amount` — typically the rounding and exchange-rate difference on a payment settling documents held in another currency. May be negative, and what that means depends on the direction: on a money-out payment a negative value means the lines convert to more than the cash actually paid, while on a money-in payment it means more was received than the lines convert to. Must not be zero; omit the field instead.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "payment_fees_account": {
            "description": "The account to categorize `payment_fees`. Required if `payment_fees` is set, and cannot be a bank account. Use the Exchange Gain or Loss account when the residual is an exchange-rate difference.",
            "type": [
              "string",
              "null"
            ]
          },
          "payment_request": {
            "description": "The unique identifier of the associated payment request. Read-only field.",
            "readOnly": true,
            "type": "string"
          },
          "payment_type": {
            "description": "The derived type of the payment (e.g. SUPPLIER_ADVANCE, CUSTOMER_ADVANCE, INVOICE, BILL). Read-only field.",
            "readOnly": true,
            "type": "string"
          },
          "payslip_payments": {
            "description": "A list of objects to represent payslip payments. Required if paying payslips.",
            "items": {
              "$ref": "#/components/schemas/PayslipPayment"
            },
            "type": "array"
          },
          "project": {
            "description": "The unique identifier of the project associated with this payment.",
            "type": [
              "string",
              "null"
            ]
          },
          "reference": {
            "type": "string"
          }
        },
        "required": [
          "amount",
          "created_ts",
          "currency",
          "date",
          "id",
          "legacy_id",
          "modified_ts",
          "paid_through_account",
          "payment_request",
          "payment_type"
        ],
        "type": "object"
      },
      "PayslipPayment": {
        "properties": {
          "amount": {
            "description": "The amount to pay off in the payslip currency. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "amount_to_pcy": {
            "description": "The same amount expressed in the payment currency. When the payslip and the payment share a currency this equals `amount`; otherwise it is the converted value. The two are never subtracted from each other directly — each is valued in the organization base currency, `amount` at the payslip exchange rate and `amount_to_pcy` at the payment exchange rate, and the difference between those two base-currency values is posted as an exchange gain or loss. Must be greater than zero.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the payment was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the payment was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "payslip": {
            "description": "The unique identifier of the payslip to be paid.",
            "type": "string"
          }
        },
        "required": [
          "amount",
          "amount_to_pcy",
          "created_ts",
          "modified_ts",
          "payslip"
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
    "/payments/": {
      "get": {
        "description": "Endpoint for retrieving a list of payments.",
        "operationId": "payments_list",
        "parameters": [
          {
            "description": "The unique identifier of the contact.",
            "in": "query",
            "name": "contact",
            "schema": {
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the payment was created",
            "in": "query",
            "name": "created_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the payment was created",
            "in": "query",
            "name": "created_ts_before",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "Date",
            "in": "query",
            "name": "date",
            "schema": {
              "format": "date",
              "type": "string"
            }
          },
          {
            "description": "External identifier",
            "in": "query",
            "name": "external_id",
            "schema": {
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the payment was last modified",
            "in": "query",
            "name": "modified_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the payment was last modified",
            "in": "query",
            "name": "modified_ts_before",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "A page number within the paginated result set.",
            "in": "query",
            "name": "page",
            "required": false,
            "schema": {
              "type": "integer"
            }
          },
          {
            "description": "Number of results to return per page.",
            "in": "query",
            "name": "page_size",
            "required": false,
            "schema": {
              "type": "integer"
            }
          },
          {
            "description": "The unique identifier of the paid through account.",
            "in": "query",
            "name": "paid_through_account",
            "schema": {
              "type": "string"
            }
          },
          {
            "description": "The unique identifier of the payment fees account.",
            "in": "query",
            "name": "payment_fees_account",
            "schema": {
              "type": "string"
            }
          },
          {
            "description": "The unique identifier of the project.",
            "in": "query",
            "name": "project",
            "schema": {
              "type": "string"
            }
          },
          {
            "description": "Reference",
            "in": "query",
            "name": "reference",
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
                  "$ref": "#/components/schemas/PaginatedPaymentList"
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
        "summary": "List payments",
        "tags": [
          "Payments"
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