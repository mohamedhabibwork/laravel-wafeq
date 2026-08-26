---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Update bank account

Endpoint for updating an existing bank account.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "BankAccount": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "account": {
            "description": "The associated account for this bank account.",
            "readOnly": true,
            "type": "string"
          },
          "classification": {
            "description": "The classification of the bank account (e.g., Asset).",
            "readOnly": true,
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the bank account was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "currency": {
            "description": "The currency used for this bank account.",
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the bank account.",
            "readOnly": true,
            "type": "string"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the bank account.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the bank account was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "description": "The name of the bank account.",
            "type": "string"
          },
          "sub_classification": {
            "allOf": [
              {
                "$ref": "#/components/schemas/BankAccountSubClassificationEnum"
              }
            ],
            "description": "The specific type of bank account (Bank, Petty Cash, or Credit Card).\n\n* `BANK` - BANK\n* `PETTY_CASH` - PETTY_CASH\n* `CREDIT_CARD` - CREDIT_CARD"
          }
        },
        "required": [
          "account",
          "classification",
          "created_ts",
          "currency",
          "id",
          "legacy_id",
          "modified_ts",
          "name",
          "sub_classification"
        ],
        "type": "object"
      },
      "BankAccountSubClassificationEnum": {
        "description": "* `BANK` - BANK\n* `PETTY_CASH` - PETTY_CASH\n* `CREDIT_CARD` - CREDIT_CARD\n\nFull information for [BankAccountSubClassificationEnum](bankaccountsubclassificationenum)",
        "enum": [
          "BANK",
          "PETTY_CASH",
          "CREDIT_CARD"
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
    "/bank-accounts/{id}/": {
      "put": {
        "description": "Endpoint for updating an existing bank account.",
        "operationId": "bank_accounts_update",
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
                "$ref": "#/components/schemas/BankAccount"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/BankAccount"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/BankAccount"
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
                  "$ref": "#/components/schemas/BankAccount"
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
        "summary": "Update bank account",
        "tags": [
          "Bank Accounts"
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