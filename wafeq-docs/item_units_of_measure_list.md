---
updatedAt: 2026-04-21T07:06:05.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# List item unit of measures

Endpoint for retrieving a list of item unit of measures.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "ItemUnitOfMeasure": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "conversion_factor": {
            "description": "The conversion factor relative to the base unit.",
            "exclusiveMaximum": 10000000000,
            "exclusiveMinimum": -10000000000,
            "format": "double",
            "type": "number"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the item unit of measure was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the item unit of measure.",
            "readOnly": true,
            "type": "string"
          },
          "is_active": {
            "default": true,
            "description": "Whether this unit of measure is active.",
            "type": "boolean"
          },
          "is_base": {
            "default": false,
            "description": "Whether this is the base unit of measure for the item.",
            "type": "boolean"
          },
          "is_default_purchase": {
            "default": false,
            "description": "Whether this is the default unit for purchases.",
            "type": "boolean"
          },
          "is_default_sales": {
            "default": false,
            "description": "Whether this is the default unit for sales.",
            "type": "boolean"
          },
          "item": {
            "description": "The item this unit of measure belongs to.",
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the item unit of measure was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "unit_cost": {
            "description": "The unit cost for this unit of measure.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": [
              "number",
              "null"
            ]
          },
          "unit_of_measure": {
            "description": "The unit of measure.",
            "type": "string"
          },
          "unit_of_measure_name": {
            "description": "The name of the unit of measure.",
            "readOnly": true,
            "type": "string"
          },
          "unit_price": {
            "description": "The unit price for this unit of measure.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": [
              "number",
              "null"
            ]
          }
        },
        "required": [
          "conversion_factor",
          "created_ts",
          "id",
          "item",
          "modified_ts",
          "unit_of_measure",
          "unit_of_measure_name"
        ],
        "type": "object"
      },
      "PaginatedItemUnitOfMeasureList": {
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
              "$ref": "#/components/schemas/ItemUnitOfMeasure"
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
    "/item-units-of-measure/": {
      "get": {
        "description": "Endpoint for retrieving a list of item unit of measures.",
        "operationId": "item_units_of_measure_list",
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
                  "$ref": "#/components/schemas/PaginatedItemUnitOfMeasureList"
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
        "summary": "List item unit of measures",
        "tags": [
          "Item Unit Of Measures"
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