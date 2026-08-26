---
updatedAt: 2026-04-21T07:06:05.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Partial update item unit of measure

Endpoint for partially updating an existing item unit of measure.

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
      "PatchedItemUnitOfMeasure": {
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
    "/item-units-of-measure/{id}/": {
      "patch": {
        "description": "Endpoint for partially updating an existing item unit of measure.",
        "operationId": "item_units_of_measure_partial_update",
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
                "$ref": "#/components/schemas/PatchedItemUnitOfMeasure"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/PatchedItemUnitOfMeasure"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/PatchedItemUnitOfMeasure"
              }
            }
          }
        },
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/ItemUnitOfMeasure"
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
        "summary": "Partial update item unit of measure",
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