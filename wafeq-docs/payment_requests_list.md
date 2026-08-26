---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# List payment requests

Endpoint for retrieving a list of payment requests.

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
      "PaginatedPaymentRequestList": {
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
              "$ref": "#/components/schemas/PaymentRequest"
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
      "PaymentRequest": {
        "description": "An entity that can have attachments.",
        "properties": {
          "amount": {
            "description": "The amount to transfer to the beneficiary. Must be a non-negative value.",
            "exclusiveMaximum": 10000000000000000,
            "format": "double",
            "minimum": 0,
            "type": [
              "number",
              "null"
            ]
          },
          "attachments": {
            "description": "The attachments linked to this payment request.",
            "items": {
              "type": "string"
            },
            "type": "array"
          },
          "bank_account": {
            "description": "The bank account associated with this payment request.",
            "type": "string"
          },
          "beneficiary": {
            "description": "The beneficiary associated with this payment request.",
            "type": "string"
          },
          "beneficiary_address": {
            "description": "The full address of the beneficiary.",
            "readOnly": true,
            "type": "string"
          },
          "beneficiary_name": {
            "description": "The full name of the beneficiary.",
            "readOnly": true,
            "type": "string"
          },
          "bills": {
            "description": "The bills associated with this payment request. Only one bill can be assigned.",
            "items": {
              "type": "string"
            },
            "type": "array"
          },
          "charge_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/ChargeTypeEnum"
              }
            ],
            "description": "How transfer charges are allocated between sender and receiver.\n\n* `OUR` - Ours\n* `BEN` - Beneficiary\n* `SHA` - Shared"
          },
          "contact": {
            "description": "The contact associated with this payment request.",
            "type": "string"
          },
          "cost_center": {
            "description": "The cost center associated with this payment request.",
            "type": [
              "string",
              "null"
            ]
          },
          "created_ts": {
            "description": "The timestamp in UTC when the payment request was created",
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
            "description": "The currency (ISO 4217 code) of the payment. Cannot be blank.\n\n* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `AZN` - AZN ман.\n* `BAM` - BAM KM\n* `BDT` - BDT ৳\n* `BGN` - BGN лв.\n* `BHD` - BHD د.ب.‏\n* `BIF` - BIF FBu\n* `BND` - BND $\n* `BOB` - BOB Bs\n* `BRL` - BRL R$\n* `BWP` - BWP P\n* `BYN` - BYN BYN\n* `BZD` - BZD $\n* `CDF` - CDF FrCD\n* `CHF` - CHF CHF\n* `CLP` - CLP $\n* `CNY` - CNY CN¥\n* `COP` - COP $\n* `CRC` - CRC ₡\n* `CVE` - CVE CV$\n* `CZK` - CZK Kč\n* `DJF` - DJF Fdj\n* `DKK` - DKK kr\n* `DOP` - DOP RD$\n* `DZD` - DZD د.ج.‏\n* `EGP` - EGP ج.م.‏\n* `ERN` - ERN Nfk\n* `ETB` - ETB Br\n* `GBP` - GBP £\n* `GEL` - GEL GEL\n* `GHS` - GHS GH₵\n* `GNF` - GNF FG\n* `GTQ` - GTQ Q\n* `HKD` - HKD $\n* `HNL` - HNL L\n* `HRK` - HRK kn\n* `HUF` - HUF Ft\n* `IDR` - IDR Rp\n* `ILS` - ILS ₪\n* `INR` - INR ₹\n* `IQD` - IQD د.ع.‏\n* `IRR` - IRR ﷼\n* `ISK` - ISK kr\n* `JMD` - JMD $\n* `JOD` - JOD د.أ.‏\n* `JPY` - JPY ￥\n* `KES` - KES Ksh\n* `KHR` - KHR ៛\n* `KMF` - KMF FC\n* `KRW` - KRW ₩\n* `KWD` - KWD د.ك.‏\n* `KZT` - KZT тңг.\n* `LBP` - LBP ل.ل.‏\n* `LKR` - LKR SL Re\n* `LYD` - LYD د.ل.‏\n* `MAD` - MAD د.م.‏\n* `MDL` - MDL MDL\n* `MGA` - MGA MGA\n* `MKD` - MKD MKD\n* `MMK` - MMK K\n* `MOP` - MOP MOP$\n* `MUR` - MUR MURs\n* `MXN` - MXN $\n* `MYR` - MYR RM\n* `MZN` - MZN MTn\n* `NAD` - NAD N$\n* `NGN` - NGN ₦\n* `NIO` - NIO C$\n* `NOK` - NOK kr\n* `NPR` - NPR नेरू\n* `NZD` - NZD $\n* `OMR` - OMR ر.ع.‏\n* `PAB` - PAB B/.\n* `PEN` - PEN S/.\n* `PHP` - PHP ₱\n* `PKR` - PKR ₨\n* `PLN` - PLN zł\n* `PYG` - PYG ₲\n* `QAR` - QAR ر.ق.‏\n* `RON` - RON RON\n* `RSD` - RSD дин.\n* `RUB` - RUB руб.\n* `RWF` - RWF FR\n* `SDG` - SDG SDG\n* `SEK` - SEK kr\n* `SGD` - SGD $\n* `SOS` - SOS Ssh\n* `SYP` - SYP ل.س.‏\n* `THB` - THB ฿\n* `TND` - TND د.ت.‏\n* `TOP` - TOP T$\n* `TRY` - TRY TL\n* `TTD` - TTD $\n* `TWD` - TWD NT$\n* `TZS` - TZS TSh\n* `UAH` - UAH ₴\n* `UGX` - UGX USh\n* `UYU` - UYU $\n* `UZS` - UZS UZS\n* `VES` - VES Bs.S.\n* `VND` - VND ₫\n* `XAF` - XAF FCFA\n* `XOF` - XOF CFA\n* `YER` - YER ر.ي.‏\n* `ZAR` - ZAR R\n* `ZMW` - ZMW ZK"
          },
          "date": {
            "description": "The date when the Payment Request was created. Automatically set and read-only.",
            "format": "date",
            "readOnly": true,
            "type": "string"
          },
          "details_of_payment": {
            "description": "The details of the payment to be displayed. Provide a clear description of the payment purpose.",
            "maxLength": 200,
            "type": "string"
          },
          "iban": {
            "description": "The International Bank Account Number (IBAN) for the transfer.",
            "readOnly": true,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the payment request.",
            "readOnly": true,
            "type": "string"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the payment request.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the payment request was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "reference": {
            "description": "The unique reference of the payment request. Used for tracking and identification.",
            "type": "string"
          },
          "send_payment_advice": {
            "description": "Boolean indicating whether to send a payment advice by email or not.",
            "type": "boolean"
          },
          "status": {
            "allOf": [
              {
                "$ref": "#/components/schemas/PaymentRequestStatusEnum"
              }
            ],
            "description": "The current status of the payment request. Automatically updated and read-only.\n\n* `DELETED` - Deleted\n* `DRAFT` - Draft\n* `ERROR` - Error\n* `FETCHING_STATUS` - Fetching status\n* `NOT_FOUND` - Not found\n* `PENDING_APPROVAL` - Pending approval\n* `PENDING_RELEASE` - Pending release\n* `PROCESSED` - Processed\n* `PROCESSING` - Processing\n* `QUEUED` - Queued\n* `REJECTED` - Rejected\n* `RELEASED` - Released\n* `VALIDATED` - Validated",
            "readOnly": true
          },
          "swift": {
            "description": "SWIFT/BIC code of the destination bank account for international transfers.",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "amount",
          "bank_account",
          "beneficiary",
          "beneficiary_address",
          "beneficiary_name",
          "charge_type",
          "contact",
          "created_ts",
          "currency",
          "date",
          "details_of_payment",
          "iban",
          "id",
          "legacy_id",
          "modified_ts",
          "reference",
          "send_payment_advice",
          "status",
          "swift"
        ],
        "type": "object"
      },
      "PaymentRequestStatusEnum": {
        "description": "* `DELETED` - Deleted\n* `DRAFT` - Draft\n* `ERROR` - Error\n* `FETCHING_STATUS` - Fetching status\n* `NOT_FOUND` - Not found\n* `PENDING_APPROVAL` - Pending approval\n* `PENDING_RELEASE` - Pending release\n* `PROCESSED` - Processed\n* `PROCESSING` - Processing\n* `QUEUED` - Queued\n* `...`\n\nFull information for [PaymentRequestStatusEnum](paymentrequeststatusenum)",
        "enum": [
          "DELETED",
          "DRAFT",
          "ERROR",
          "FETCHING_STATUS",
          "NOT_FOUND",
          "PENDING_APPROVAL",
          "PENDING_RELEASE",
          "PROCESSED",
          "PROCESSING",
          "QUEUED",
          "REJECTED",
          "RELEASED",
          "VALIDATED"
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
    "/payment_requests/": {
      "get": {
        "description": "Endpoint for retrieving a list of payment requests.",
        "operationId": "payment_requests_list",
        "parameters": [
          {
            "description": "Amount",
            "in": "query",
            "name": "amount_max",
            "schema": {
              "exclusiveMaximum": 10000000000000000,
              "exclusiveMinimum": -10000000000000000,
              "format": "double",
              "type": [
                "number",
                "null"
              ]
            }
          },
          {
            "description": "Amount",
            "in": "query",
            "name": "amount_min",
            "schema": {
              "exclusiveMaximum": 10000000000000000,
              "exclusiveMinimum": -10000000000000000,
              "format": "double",
              "type": [
                "number",
                "null"
              ]
            }
          },
          {
            "description": "The timestamp in UTC when the payment request was created",
            "in": "query",
            "name": "created_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the payment request was created",
            "in": "query",
            "name": "created_ts_before",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "Currency\n\n* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `AZN` - AZN ман.\n* `BAM` - BAM KM\n* `BDT` - BDT ৳\n* `BGN` - BGN лв.\n* `BHD` - BHD د.ب.‏\n* `BIF` - BIF FBu\n* `BND` - BND $\n* `BOB` - BOB Bs\n* `BRL` - BRL R$\n* `BWP` - BWP P\n* `BYN` - BYN BYN\n* `BZD` - BZD $\n* `CDF` - CDF FrCD\n* `CHF` - CHF CHF\n* `CLP` - CLP $\n* `CNY` - CNY CN¥\n* `COP` - COP $\n* `CRC` - CRC ₡\n* `CVE` - CVE CV$\n* `CZK` - CZK Kč\n* `DJF` - DJF Fdj\n* `DKK` - DKK kr\n* `DOP` - DOP RD$\n* `DZD` - DZD د.ج.‏\n* `EGP` - EGP ج.م.‏\n* `ERN` - ERN Nfk\n* `ETB` - ETB Br\n* `GBP` - GBP £\n* `GEL` - GEL GEL\n* `GHS` - GHS GH₵\n* `GNF` - GNF FG\n* `GTQ` - GTQ Q\n* `HKD` - HKD $\n* `HNL` - HNL L\n* `HRK` - HRK kn\n* `HUF` - HUF Ft\n* `IDR` - IDR Rp\n* `ILS` - ILS ₪\n* `INR` - INR ₹\n* `IQD` - IQD د.ع.‏\n* `IRR` - IRR ﷼\n* `ISK` - ISK kr\n* `JMD` - JMD $\n* `JOD` - JOD د.أ.‏\n* `JPY` - JPY ￥\n* `KES` - KES Ksh\n* `KHR` - KHR ៛\n* `KMF` - KMF FC\n* `KRW` - KRW ₩\n* `KWD` - KWD د.ك.‏\n* `KZT` - KZT тңг.\n* `LBP` - LBP ل.ل.‏\n* `LKR` - LKR SL Re\n* `LYD` - LYD د.ل.‏\n* `MAD` - MAD د.م.‏\n* `MDL` - MDL MDL\n* `MGA` - MGA MGA\n* `MKD` - MKD MKD\n* `MMK` - MMK K\n* `MOP` - MOP MOP$\n* `MUR` - MUR MURs\n* `MXN` - MXN $\n* `MYR` - MYR RM\n* `MZN` - MZN MTn\n* `NAD` - NAD N$\n* `NGN` - NGN ₦\n* `NIO` - NIO C$\n* `NOK` - NOK kr\n* `NPR` - NPR नेरू\n* `NZD` - NZD $\n* `OMR` - OMR ر.ع.‏\n* `PAB` - PAB B/.\n* `PEN` - PEN S/.\n* `PHP` - PHP ₱\n* `PKR` - PKR ₨\n* `PLN` - PLN zł\n* `PYG` - PYG ₲\n* `QAR` - QAR ر.ق.‏\n* `RON` - RON RON\n* `RSD` - RSD дин.\n* `RUB` - RUB руб.\n* `RWF` - RWF FR\n* `SDG` - SDG SDG\n* `SEK` - SEK kr\n* `SGD` - SGD $\n* `SOS` - SOS Ssh\n* `SYP` - SYP ل.س.‏\n* `THB` - THB ฿\n* `TND` - TND د.ت.‏\n* `TOP` - TOP T$\n* `TRY` - TRY TL\n* `TTD` - TTD $\n* `TWD` - TWD NT$\n* `TZS` - TZS TSh\n* `UAH` - UAH ₴\n* `UGX` - UGX USh\n* `UYU` - UYU $\n* `UZS` - UZS UZS\n* `VES` - VES Bs.S.\n* `VND` - VND ₫\n* `XAF` - XAF FCFA\n* `XOF` - XOF CFA\n* `YER` - YER ر.ي.‏\n* `ZAR` - ZAR R\n* `ZMW` - ZMW ZK",
            "in": "query",
            "name": "currency",
            "schema": {
              "enum": [
                "AED",
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
                "CAD",
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
                "EUR",
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
                "SAR",
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
                "USD",
                "UYU",
                "UZS",
                "VES",
                "VND",
                "XAF",
                "XOF",
                "YER",
                "ZAR",
                "ZMW",
                "__null__"
              ],
              "type": "string"
            }
          },
          {
            "description": "Date",
            "in": "query",
            "name": "date_after",
            "schema": {
              "format": "date",
              "type": "string"
            }
          },
          {
            "description": "Date",
            "in": "query",
            "name": "date_before",
            "schema": {
              "format": "date",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the payment request was last modified",
            "in": "query",
            "name": "modified_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the payment request was last modified",
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
            "description": "Status\n\n* `DELETED` - Deleted\n* `DRAFT` - Draft\n* `ERROR` - Error\n* `FETCHING_STATUS` - Fetching status\n* `NOT_FOUND` - Not found\n* `PENDING_APPROVAL` - Pending approval\n* `PENDING_RELEASE` - Pending release\n* `PROCESSED` - Processed\n* `PROCESSING` - Processing\n* `QUEUED` - Queued\n* `REJECTED` - Rejected\n* `RELEASED` - Released\n* `VALIDATED` - Validated",
            "in": "query",
            "name": "status",
            "schema": {
              "enum": [
                "DELETED",
                "DRAFT",
                "ERROR",
                "FETCHING_STATUS",
                "NOT_FOUND",
                "PENDING_APPROVAL",
                "PENDING_RELEASE",
                "PROCESSED",
                "PROCESSING",
                "QUEUED",
                "REJECTED",
                "RELEASED",
                "VALIDATED",
                "__null__"
              ],
              "type": "string"
            }
          }
        ],
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/PaginatedPaymentRequestList"
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
        "summary": "List payment requests",
        "tags": [
          "Payment Requests"
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