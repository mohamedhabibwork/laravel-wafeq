---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# List items

Endpoint for retrieving a list of items.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "Item": {
        "description": "Shared validation and save logic for item_units_of_measure across v1 and v2 serializers.",
        "properties": {
          "created_ts": {
            "description": "The timestamp in UTC when the item was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "description": {
            "description": "The description of the item.",
            "type": "string"
          },
          "expense_account": {
            "description": "The expense account for this item.",
            "type": [
              "string",
              "null"
            ]
          },
          "external_id": {
            "default": "",
            "description": "External identifier for the item.",
            "maxLength": 255,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the item.",
            "readOnly": true,
            "type": "string"
          },
          "is_active": {
            "default": true,
            "description": "Whether the item is active.",
            "type": "boolean"
          },
          "is_tracked_inventory": {
            "default": false,
            "description": "Whether inventory is tracked for this item.",
            "type": "boolean"
          },
          "item_units_of_measure": {
            "description": "The units of measure for this item.",
            "items": {
              "$ref": "#/components/schemas/_ItemUnitOfMeasureWrite"
            },
            "type": "array"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the item.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the item was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "description": "The name of the item.",
            "maxLength": 200,
            "type": "string"
          },
          "purchase_tax_rate": {
            "description": "The tax rate applied when purchasing this item.",
            "type": [
              "string",
              "null"
            ]
          },
          "quantity_on_hand": {
            "description": "The current quantity on hand. Only relevant for tracked inventory items.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": [
              "number",
              "null"
            ]
          },
          "revenue_account": {
            "description": "The revenue account for this item.",
            "type": [
              "string",
              "null"
            ]
          },
          "revenue_tax_rate": {
            "description": "The tax rate applied when selling this item.",
            "type": [
              "string",
              "null"
            ]
          },
          "sku": {
            "description": "The SKU of the item.",
            "maxLength": 200,
            "type": "string"
          },
          "tax_authority": {
            "oneOf": [
              {
                "$ref": "#/components/schemas/api-v1-document-item-tax-authority"
              },
              {
                "type": "null"
              }
            ]
          },
          "unit_cost": {
            "description": "The default unit cost of the item if no unit of measure is specified.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": [
              "number",
              "null"
            ]
          },
          "unit_price": {
            "description": "The default unit price of the item if no unit of measure is specified.",
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
          "created_ts",
          "id",
          "legacy_id",
          "modified_ts",
          "name",
          "quantity_on_hand"
        ],
        "type": "object"
      },
      "PaginatedItemList": {
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
              "$ref": "#/components/schemas/Item"
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
      "_ItemUnitOfMeasureWrite": {
        "properties": {
          "conversion_factor": {
            "description": "The conversion factor relative to the base unit.",
            "exclusiveMaximum": 10000000000,
            "exclusiveMinimum": -10000000000,
            "format": "double",
            "type": "number"
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
            "description": "The unique identifier of the unit of measure.",
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
          "unit_of_measure"
        ],
        "type": "object"
      },
      "api-v1-document-item-tax-authority": {
        "properties": {
          "metadata": {
            "oneOf": [
              {
                "$ref": "#/components/schemas/api-v1-document-item-tax-authority-metadata"
              },
              {
                "type": "null"
              }
            ]
          }
        },
        "type": "object"
      },
      "api-v1-document-item-tax-authority-metadata": {
        "properties": {
          "default_exemption_reason": {
            "type": [
              "string",
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
    "/items/": {
      "get": {
        "description": "Endpoint for retrieving a list of items.",
        "operationId": "items_list",
        "parameters": [
          {
            "description": "The timestamp in UTC when the item was created",
            "in": "query",
            "name": "created_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the item was created",
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
            "description": "The timestamp in UTC when the item was last modified",
            "in": "query",
            "name": "modified_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the item was last modified",
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
          }
        ],
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/PaginatedItemList"
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
        "summary": "List items",
        "tags": [
          "Items"
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