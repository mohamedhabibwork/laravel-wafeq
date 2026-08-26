---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Report credit note to tax authority

Report the credit note to the tax authority for processing and validation.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "api-v1-credit-note-tax-authority": {
        "properties": {
          "metadata": {
            "$ref": "#/components/schemas/api-v1-document-tax-authority-metadata"
          },
          "reported_ts": {
            "format": "date-time",
            "type": "string"
          },
          "status": {
            "type": "string"
          }
        },
        "required": [
          "metadata",
          "reported_ts",
          "status"
        ],
        "type": "object"
      },
      "api-v1-document-tax-authority-metadata": {
        "properties": {
          "errors": {
            "items": {
              "additionalProperties": {},
              "type": "object"
            },
            "type": "array"
          },
          "warnings": {
            "items": {
              "additionalProperties": {},
              "type": "object"
            },
            "type": "array"
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
    "/credit-notes/{id}/tax-authority/report/": {
      "post": {
        "description": "Report the credit note to the tax authority for processing and validation.",
        "operationId": "credit_notes_tax_authority_report_create",
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
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/api-v1-credit-note-tax-authority"
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
        "summary": "Report credit note to tax authority",
        "tags": [
          "Credit Notes"
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