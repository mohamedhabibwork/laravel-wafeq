---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# List invoices (bulk)

Endpoint for retrieving a list of invoices (bulk).

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "APIEntityContact": {
        "properties": {
          "address": {
            "default": "",
            "type": "string"
          },
          "city": {
            "default": "",
            "type": "string"
          },
          "country": {
            "default": "",
            "type": "string"
          },
          "email": {
            "type": "string"
          },
          "name": {
            "type": "string"
          },
          "tax_registration_number": {
            "default": "",
            "type": "string"
          }
        },
        "required": [
          "name"
        ],
        "type": "object"
      },
      "APIEntityDiscount": {
        "properties": {
          "type": {
            "$ref": "#/components/schemas/APIEntityDiscountTypeEnum"
          },
          "value": {
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          }
        },
        "required": [
          "type",
          "value"
        ],
        "type": "object"
      },
      "APIEntityDiscountTypeEnum": {
        "description": "* `percent` - %\n* `amount` - amount\n\nFull information for [APIEntityDiscountTypeEnum](apientitydiscounttypeenum)",
        "enum": [
          "percent",
          "amount"
        ],
        "type": "string"
      },
      "APIEntityTaxRateFlat": {
        "properties": {
          "name": {
            "type": "string"
          },
          "rate": {
            "exclusiveMaximum": 100000000000000,
            "exclusiveMinimum": -100000000000000,
            "format": "double",
            "type": "number"
          },
          "suid": {
            "type": "string"
          }
        },
        "required": [
          "name",
          "rate"
        ],
        "type": "object"
      },
      "APIInvoice": {
        "properties": {
          "amount": {
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "contact": {
            "$ref": "#/components/schemas/APIEntityContact"
          },
          "created_at": {
            "format": "date-time",
            "type": "string"
          },
          "currency": {
            "$ref": "#/components/schemas/CurrencyEnum"
          },
          "id": {
            "type": "string"
          },
          "invoice_date": {
            "format": "date-time",
            "type": "string"
          },
          "invoice_number": {
            "type": "string"
          },
          "language": {
            "$ref": "#/components/schemas/LanguageEnum"
          },
          "line_items": {
            "items": {
              "$ref": "#/components/schemas/APIInvoiceLineItem"
            },
            "maxItems": 100,
            "minItems": 1,
            "type": "array"
          },
          "notes": {
            "default": "",
            "type": "string"
          },
          "paid_through_account": {
            "type": "string"
          },
          "reference": {
            "default": "",
            "type": "string"
          },
          "status": {
            "type": "string"
          },
          "tax_amount_type": {
            "$ref": "#/components/schemas/TaxAmountTypeEnum"
          }
        },
        "required": [
          "amount",
          "contact",
          "created_at",
          "currency",
          "id",
          "invoice_date",
          "invoice_number",
          "language",
          "line_items",
          "status",
          "tax_amount_type"
        ],
        "type": "object"
      },
      "APIInvoiceLineItem": {
        "properties": {
          "account": {
            "type": "string"
          },
          "description": {
            "type": "string"
          },
          "discount": {
            "$ref": "#/components/schemas/APIEntityDiscount"
          },
          "name": {
            "type": "string"
          },
          "price": {
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "quantity": {
            "description": "The quantity for the item.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "tax_rate": {
            "$ref": "#/components/schemas/APIEntityTaxRateFlat"
          }
        },
        "required": [
          "description",
          "name",
          "price",
          "quantity"
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
      "LanguageEnum": {
        "description": "* `ar` - Arabic\n* `en` - English\n\nFull information for [LanguageEnum](languageenum)",
        "enum": [
          "ar",
          "en"
        ],
        "type": "string"
      },
      "PaginatedAPIInvoiceList": {
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
              "$ref": "#/components/schemas/APIInvoice"
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
    "/api-invoices/": {
      "get": {
        "description": "Endpoint for retrieving a list of invoices (bulk).",
        "operationId": "api_invoices_list",
        "parameters": [
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
          }
        ],
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/PaginatedAPIInvoiceList"
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
        "summary": "List invoices (bulk)",
        "tags": [
          "Invoices (Bulk)"
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