---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Update bank ledger transaction

Endpoint for updating an existing bank ledger transaction.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "BankLedgerTransaction": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "account": {
            "description": "The account associated with this transaction.",
            "type": "string"
          },
          "amount": {
            "description": "The transaction amount.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "bank_account": {
            "description": "The bank account associated with this transaction.",
            "readOnly": true,
            "type": "string"
          },
          "contact": {
            "description": "The contact (customer or supplier) associated with this transaction, if any.",
            "type": [
              "string",
              "null"
            ]
          },
          "created_ts": {
            "description": "The timestamp in UTC when the transaction was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "date": {
            "description": "The transaction date.",
            "format": "date",
            "type": "string"
          },
          "description": {
            "default": "",
            "description": "The transaction description.",
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the transaction.",
            "readOnly": true,
            "type": "string"
          },
          "is_manual": {
            "description": "Indicates whether the transaction was manually entered.",
            "readOnly": true,
            "type": "boolean"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the transaction.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the transaction was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "project": {
            "description": "The project associated with this transaction, if any.",
            "type": [
              "string",
              "null"
            ]
          },
          "reference": {
            "default": "",
            "description": "The transaction reference or identifier.",
            "type": "string"
          },
          "tax_rate": {
            "description": "The tax rate to apply to this transaction, if any.",
            "type": [
              "string",
              "null"
            ]
          }
        },
        "required": [
          "account",
          "amount",
          "bank_account",
          "created_ts",
          "date",
          "id",
          "is_manual",
          "legacy_id",
          "modified_ts"
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
    "/bank-accounts/{bank_account_id}/ledger-transactions/{id}/": {
      "put": {
        "description": "Endpoint for updating an existing bank ledger transaction.",
        "operationId": "bank_accounts_ledger_transactions_update",
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
            "name": "bank_account_id",
            "required": true,
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
                "$ref": "#/components/schemas/BankLedgerTransaction"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/BankLedgerTransaction"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/BankLedgerTransaction"
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
                  "$ref": "#/components/schemas/BankLedgerTransaction"
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
        "summary": "Update bank ledger transaction",
        "tags": [
          "Bank Ledger Transactions"
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