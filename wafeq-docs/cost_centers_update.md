---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Update cost center

Endpoint for updating an existing cost center.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "CostCenter": {
        "properties": {
          "created_ts": {
            "description": "The timestamp in UTC when the cost center was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the cost center.",
            "readOnly": true,
            "type": "string"
          },
          "is_active": {
            "description": "Indicates whether the cost center is currently active or inactive.",
            "type": "boolean"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the cost center.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the cost center was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name_ar": {
            "description": "The name of the cost center in Arabic, limited to 200 characters.",
            "maxLength": 200,
            "type": "string"
          },
          "name_en": {
            "description": "The name of the cost center in English, limited to 200 characters.",
            "maxLength": 200,
            "type": "string"
          }
        },
        "required": [
          "created_ts",
          "id",
          "is_active",
          "legacy_id",
          "modified_ts",
          "name_ar",
          "name_en"
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
    "/cost-centers/{id}/": {
      "put": {
        "description": "Endpoint for updating an existing cost center.",
        "operationId": "cost_centers_update",
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
                "$ref": "#/components/schemas/CostCenter"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/CostCenter"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/CostCenter"
              }
            }
          },
          "required": true
        },
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/CostCenter"
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
        "summary": "Update cost center",
        "tags": [
          "Cost Centers"
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