---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# List tax rates

Endpoint for retrieving a list of tax rates.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "PaginatedTaxRateList": {
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
              "$ref": "#/components/schemas/TaxRate"
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
      "TaxRate": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "created_ts": {
            "description": "The timestamp in UTC when the tax rate was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "description": {
            "default": "",
            "description": "The tax rate description. This field provides additional details about the tax rate.",
            "type": "string"
          },
          "external_id": {
            "default": "",
            "description": "External identifier for the tax rate.",
            "maxLength": 255,
            "type": "string"
          },
          "friendly_name": {
            "description": "The tax rate friendly name. This is a more user-friendly version of the name, typically used for display purposes.",
            "readOnly": true,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the tax rate object. This field is read-only.",
            "readOnly": true,
            "type": "string"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the tax rate.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the tax rate was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "description": "The tax rate name. This should be a concise identifier for the tax rate.",
            "type": "string"
          },
          "rate": {
            "description": "The numerical value of the tax rate. This is represented as a decimal with up to 6 decimal places.",
            "exclusiveMaximum": 10000,
            "exclusiveMinimum": -10000,
            "format": "double",
            "type": "number"
          },
          "tax_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/TaxTypeEnum"
              }
            ],
            "description": "The type of tax. This field uses predefined choices from the TaxRate model.\n\n* `SALES` - Sales\n* `PURCHASES` - Purchases\n* `REVERSE_CHARGE` - Reverse Charge\n* `OUT_OF_SCOPE` - Out of Scope"
          }
        },
        "required": [
          "created_ts",
          "friendly_name",
          "id",
          "legacy_id",
          "modified_ts",
          "name",
          "rate",
          "tax_type"
        ],
        "type": "object"
      },
      "TaxTypeEnum": {
        "description": "* `SALES` - Sales\n* `PURCHASES` - Purchases\n* `REVERSE_CHARGE` - Reverse Charge\n* `OUT_OF_SCOPE` - Out of Scope\n\nFull information for [TaxTypeEnum](taxtypeenum)",
        "enum": [
          "SALES",
          "PURCHASES",
          "REVERSE_CHARGE",
          "OUT_OF_SCOPE"
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
    "/tax-rates/": {
      "get": {
        "description": "Endpoint for retrieving a list of tax rates.",
        "operationId": "tax_rates_list",
        "parameters": [
          {
            "description": "The timestamp in UTC when the tax rate was created",
            "in": "query",
            "name": "created_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the tax rate was created",
            "in": "query",
            "name": "created_ts_before",
            "schema": {
              "format": "date-time",
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
            "description": "The timestamp in UTC when the tax rate was last modified",
            "in": "query",
            "name": "modified_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the tax rate was last modified",
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
            "description": "Tax type\n\n* `SALES` - Sales\n* `PURCHASES` - Purchases\n* `REVERSE_CHARGE` - Reverse Charge\n* `OUT_OF_SCOPE` - Out of Scope",
            "in": "query",
            "name": "tax_type",
            "schema": {
              "enum": [
                "OUT_OF_SCOPE",
                "PURCHASES",
                "REVERSE_CHARGE",
                "SALES",
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
                  "$ref": "#/components/schemas/PaginatedTaxRateList"
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
        "summary": "List tax rates",
        "tags": [
          "Tax Rates"
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