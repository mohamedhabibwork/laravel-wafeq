---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Send credit notes (bulk)

This endpoint can be used to send credit notes in large volumes.

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
      "APIEntityTaxRateExpanded": {
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
      "BulkSendAPICreditNote": {
        "properties": {
          "channels": {
            "items": {
              "$ref": "#/components/schemas/Channel"
            },
            "maxItems": 1,
            "minItems": 0,
            "type": "array"
          },
          "contact": {
            "$ref": "#/components/schemas/APIEntityContact"
          },
          "credit_note_date": {
            "format": "date",
            "type": "string"
          },
          "credit_note_number": {
            "type": "string"
          },
          "currency": {
            "$ref": "#/components/schemas/CurrencyEnum"
          },
          "language": {
            "$ref": "#/components/schemas/LanguageEnum"
          },
          "line_items": {
            "items": {
              "$ref": "#/components/schemas/BulkSendAPICreditNoteLineItem"
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
          "tax_amount_type": {
            "$ref": "#/components/schemas/TaxAmountTypeEnum"
          }
        },
        "required": [
          "channels",
          "contact",
          "credit_note_date",
          "credit_note_number",
          "currency",
          "language",
          "line_items",
          "tax_amount_type"
        ],
        "type": "object"
      },
      "BulkSendAPICreditNoteLineItem": {
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
            "$ref": "#/components/schemas/APIEntityTaxRateExpanded"
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
      "Channel": {
        "properties": {
          "data": {
            "$ref": "#/components/schemas/Email"
          },
          "medium": {
            "$ref": "#/components/schemas/MediumEnum"
          }
        },
        "required": [
          "data",
          "medium"
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
      "Email": {
        "properties": {
          "message": {
            "type": "string"
          },
          "recipients": {
            "$ref": "#/components/schemas/EmailRecipients"
          },
          "subject": {
            "type": "string"
          }
        },
        "required": [
          "message",
          "recipients",
          "subject"
        ],
        "type": "object"
      },
      "EmailRecipients": {
        "properties": {
          "bcc": {
            "default": [],
            "items": {
              "format": "email",
              "type": "string"
            },
            "maxItems": 6,
            "type": "array"
          },
          "cc": {
            "default": [],
            "items": {
              "format": "email",
              "type": "string"
            },
            "maxItems": 6,
            "type": "array"
          },
          "to": {
            "items": {
              "format": "email",
              "type": "string"
            },
            "maxItems": 6,
            "type": "array"
          }
        },
        "required": [
          "to"
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
      "MediumEnum": {
        "description": "* `email` - Email\n\nFull information for [MediumEnum](mediumenum)",
        "enum": [
          "email"
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
    "/api-credit-notes/bulk_send/": {
      "post": {
        "description": "This endpoint can be used to send credit notes in large volumes.",
        "operationId": "api_credit_notes_bulk_send_create",
        "requestBody": {
          "content": {
            "application/json": {
              "examples": {
                "Example1": {
                  "summary": "Example 1",
                  "value": [
                    {
                      "channels": [
                        {
                          "data": {
                            "message": "<p>Please find attached your credit note.</p>",
                            "recipients": {
                              "bcc": [],
                              "cc": [],
                              "to": [
                                "ahmed.a@example.com"
                              ]
                            },
                            "subject": "Credit Note X from the Company of Abdullah S. Trading"
                          },
                          "medium": "email"
                        }
                      ],
                      "contact": {
                        "address": "Ahmed A. Building, first floor, Riyadh, Saudi Arabia",
                        "email": "ahmed@example.com",
                        "name": "Ahmed A."
                      },
                      "credit_note_date": "2021-01-01",
                      "credit_note_number": "TEST-CN-1234",
                      "currency": "SAR",
                      "language": "en",
                      "line_items": [
                        {
                          "account": "acc_DTbQSMR374gSSbdPy3mrBr",
                          "description": "Item description 1",
                          "name": "Item 1",
                          "price": 40,
                          "quantity": 2,
                          "tax_rate": "tax_3WgEt9y9BrcnxNAveZPTea"
                        },
                        {
                          "account": "acc_DTbQSMR374gSSbdPy3mrBr",
                          "description": "Item description 2",
                          "name": "Item 2",
                          "price": 20,
                          "quantity": 3,
                          "tax_rate": "tax_3WgEt9y9BrcnxNAveZPTea"
                        }
                      ],
                      "paid_through_account": "acc_7YpiBvkKRkpX9zkwZnXryJ",
                      "reference": "test",
                      "tax_amount_type": "TAX_INCLUSIVE"
                    }
                  ]
                }
              },
              "schema": {
                "$ref": "#/components/schemas/BulkSendAPICreditNote"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/BulkSendAPICreditNote"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/BulkSendAPICreditNote"
              }
            }
          },
          "required": true
        },
        "responses": {
          "200": {
            "description": "No response body"
          }
        },
        "security": [
          {
            "APIKeyAuth": []
          }
        ],
        "summary": "Send credit notes (bulk)",
        "tags": [
          "Credit Notes (Bulk)"
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