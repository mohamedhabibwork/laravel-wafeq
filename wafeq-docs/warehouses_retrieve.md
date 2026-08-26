---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Retrieve warehouse

Endpoint for retrieving a single warehouse.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "Warehouse": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "account": {
            "description": "The account associated with this warehouse.",
            "type": "string"
          },
          "address": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "Full address of the warehouse in both languages."
          },
          "building_number": {
            "description": "Building number or identifier of the warehouse.",
            "type": "string"
          },
          "city": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "City where the warehouse is located, in both languages."
          },
          "code": {
            "description": "Unique code identifier for the warehouse.",
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the warehouse was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "district": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "District or area where the warehouse is located, in both languages."
          },
          "id": {
            "description": "The unique identifier of the warehouse.",
            "readOnly": true,
            "type": "string"
          },
          "is_active": {
            "default": true,
            "description": "Indicates whether the warehouse is currently active and operational.",
            "type": "boolean"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the warehouse.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the warehouse was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "The name of the warehouse in both languages."
          },
          "phone": {
            "description": "Contact phone number for the warehouse.",
            "type": "string"
          },
          "postal_code": {
            "description": "Postal or ZIP code of the warehouse location.",
            "type": "string"
          },
          "state": {
            "description": "Emirate for UAE organizations. Read-only field.",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "account",
          "address",
          "building_number",
          "city",
          "code",
          "created_ts",
          "district",
          "id",
          "legacy_id",
          "modified_ts",
          "name",
          "phone",
          "postal_code",
          "state"
        ],
        "type": "object"
      },
      "common-dual-lang-model": {
        "properties": {
          "ar": {
            "description": "The value in the Arabic language.",
            "type": "string"
          },
          "en": {
            "description": "The value in the English language.",
            "type": "string"
          }
        },
        "required": [
          "en"
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
    "/warehouses/{id}/": {
      "get": {
        "description": "Endpoint for retrieving a single warehouse.",
        "operationId": "warehouses_retrieve",
        "parameters": [
          {
            "in": "path",
            "name": "id",
            "required": true,
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
                  "$ref": "#/components/schemas/Warehouse"
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
        "summary": "Retrieve warehouse",
        "tags": [
          "Warehouses"
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