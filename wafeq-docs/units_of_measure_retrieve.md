---
updatedAt: 2026-04-21T07:06:05.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Retrieve unit of measure

Endpoint for retrieving a single unit of measure.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "UnitOfMeasure": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "created_ts": {
            "description": "The timestamp in UTC when the unit of measure was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the unit of measure.",
            "readOnly": true,
            "type": "string"
          },
          "is_active": {
            "default": true,
            "description": "Whether the unit of measure is active.",
            "type": "boolean"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the unit of measure was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "description": "The name of the unit of measure.",
            "maxLength": 200,
            "type": "string"
          },
          "name_ar": {
            "description": "The Arabic name of the unit of measure.",
            "maxLength": 200,
            "type": "string"
          }
        },
        "required": [
          "created_ts",
          "id",
          "modified_ts",
          "name"
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
    "/units-of-measure/{id}/": {
      "get": {
        "description": "Endpoint for retrieving a single unit of measure.",
        "operationId": "units_of_measure_retrieve",
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
                  "$ref": "#/components/schemas/UnitOfMeasure"
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
        "summary": "Retrieve unit of measure",
        "tags": [
          "Unit Of Measures"
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