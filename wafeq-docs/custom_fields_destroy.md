---
updatedAt: 2026-04-21T07:06:05.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Delete custom field

Endpoint for deleting an existing custom field. The custom field must not be in use on any documents.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "CodeEnum": {
        "description": "* `permission_denied` - Permission Denied\n\nFull information for [CodeEnum](codeenum)",
        "enum": [
          "permission_denied"
        ],
        "type": "string"
      },
      "Error403": {
        "properties": {
          "attr": {
            "type": [
              "string",
              "null"
            ]
          },
          "code": {
            "$ref": "#/components/schemas/CodeEnum"
          },
          "detail": {
            "type": "string"
          }
        },
        "required": [
          "attr",
          "code",
          "detail"
        ],
        "type": "object"
      },
      "ValidationError": {
        "properties": {
          "attr": {
            "type": "string"
          },
          "code": {
            "type": "string"
          },
          "detail": {
            "type": "string"
          }
        },
        "required": [
          "attr",
          "code",
          "detail"
        ],
        "type": "object"
      },
      "ValidationErrorResponse": {
        "properties": {
          "errors": {
            "items": {
              "$ref": "#/components/schemas/ValidationError"
            },
            "type": "array"
          },
          "type": {
            "$ref": "#/components/schemas/ValidationErrorResponseTypeEnum"
          }
        },
        "required": [
          "errors",
          "type"
        ],
        "type": "object"
      },
      "ValidationErrorResponseTypeEnum": {
        "description": "* `validation_error` - Validation Error\n\nFull information for [ValidationErrorResponseTypeEnum](validationerrorresponsetypeenum)",
        "enum": [
          "validation_error"
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
    "/custom-fields/{id}/": {
      "delete": {
        "description": "Endpoint for deleting an existing custom field. The custom field must not be in use on any documents.",
        "operationId": "custom_fields_destroy",
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
            "description": "A unique value identifying this custom field.",
            "in": "path",
            "name": "id",
            "required": true,
            "schema": {
              "type": "string"
            }
          }
        ],
        "responses": {
          "204": {
            "description": "No response body",
            "headers": {
              "X-Wafeq-Idempotent-Replayed": {
                "description": "Indicates whether response was served from cache",
                "schema": {
                  "type": "string"
                }
              }
            }
          },
          "400": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/ValidationErrorResponse"
                }
              }
            },
            "description": "Validation error (e.g., invalid config, field type change while in use, or choice removal while in use).",
            "headers": {
              "X-Wafeq-Idempotent-Replayed": {
                "description": "Indicates whether response was served from cache",
                "schema": {
                  "type": "string"
                }
              }
            }
          },
          "403": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/Error403"
                }
              }
            },
            "description": "Permission denied or addon limit reached.",
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
        "summary": "Delete custom field",
        "tags": [
          "Custom Fields"
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