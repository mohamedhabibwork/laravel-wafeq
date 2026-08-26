---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# List bank accounts

Endpoint for retrieving a list of bank accounts.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "BankAccount": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "account": {
            "description": "The associated account for this bank account.",
            "readOnly": true,
            "type": "string"
          },
          "classification": {
            "description": "The classification of the bank account (e.g., Asset).",
            "readOnly": true,
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the bank account was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "currency": {
            "description": "The currency used for this bank account.",
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the bank account.",
            "readOnly": true,
            "type": "string"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the bank account.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the bank account was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "description": "The name of the bank account.",
            "type": "string"
          },
          "sub_classification": {
            "allOf": [
              {
                "$ref": "#/components/schemas/BankAccountSubClassificationEnum"
              }
            ],
            "description": "The specific type of bank account (Bank, Petty Cash, or Credit Card).\n\n* `BANK` - BANK\n* `PETTY_CASH` - PETTY_CASH\n* `CREDIT_CARD` - CREDIT_CARD"
          }
        },
        "required": [
          "account",
          "classification",
          "created_ts",
          "currency",
          "id",
          "legacy_id",
          "modified_ts",
          "name",
          "sub_classification"
        ],
        "type": "object"
      },
      "BankAccountSubClassificationEnum": {
        "description": "* `BANK` - BANK\n* `PETTY_CASH` - PETTY_CASH\n* `CREDIT_CARD` - CREDIT_CARD\n\nFull information for [BankAccountSubClassificationEnum](bankaccountsubclassificationenum)",
        "enum": [
          "BANK",
          "PETTY_CASH",
          "CREDIT_CARD"
        ],
        "type": "string"
      },
      "PaginatedBankAccountList": {
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
              "$ref": "#/components/schemas/BankAccount"
            },
            "type": "array"
          }
        },
        "required": [
          "count",
          "results"
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
    "/bank-accounts/": {
      "get": {
        "description": "Endpoint for retrieving a list of bank accounts.",
        "operationId": "bank_accounts_list",
        "parameters": [
          {
            "description": "Classification\n\n* `ASSET` - Asset\n* `LIABILITY` - Liability\n* `EQUITY` - Equity\n* `REVENUE` - Revenue\n* `EXPENSE` - Expense",
            "in": "query",
            "name": "classification",
            "schema": {
              "enum": [
                "ASSET",
                "EQUITY",
                "EXPENSE",
                "LIABILITY",
                "REVENUE",
                "__null__"
              ],
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the bank account was created",
            "in": "query",
            "name": "created_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the bank account was created",
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
            "description": "The timestamp in UTC when the bank account was last modified",
            "in": "query",
            "name": "modified_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the bank account was last modified",
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
            "description": "Sub-classification\n\n* `BANK` - Bank\n* `CREDIT_CARD` - Credit Card\n* `PETTY_CASH` - Petty Cash",
            "in": "query",
            "name": "sub_classification",
            "schema": {
              "enum": [
                "BANK",
                "CREDIT_CARD",
                "PETTY_CASH",
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
                  "$ref": "#/components/schemas/PaginatedBankAccountList"
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
        "summary": "List bank accounts",
        "tags": [
          "Bank Accounts"
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