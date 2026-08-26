---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Retrieve bank statement transaction

Endpoint for retrieving a single bank statement transaction.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "BankStatementTransaction": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "amount": {
            "description": "The statement amount in the transaction.",
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
          "bank_reference": {
            "type": "string"
          },
          "calculated_balance": {
            "description": "The balance computed from all statements, including this transaction.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "cost_center": {
            "description": "The cost center associated with this transaction, if any.",
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
            "format": "date",
            "type": "string"
          },
          "description": {
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the bank statement transaction.",
            "readOnly": true,
            "type": "string"
          },
          "is_posted": {
            "description": "Indicates whether the transaction has been posted to the ledger.",
            "readOnly": true,
            "type": "boolean"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the bank statement transaction.",
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
            "type": "string"
          },
          "statement_balance": {
            "description": "The balance reported by the bank after this transaction.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          }
        },
        "required": [
          "amount",
          "bank_account",
          "calculated_balance",
          "created_ts",
          "date",
          "id",
          "is_posted",
          "legacy_id",
          "modified_ts",
          "statement_balance"
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
    "/bank-accounts/{bank_account_id}/statement-transactions/{id}/": {
      "get": {
        "description": "Endpoint for retrieving a single bank statement transaction.",
        "operationId": "bank_accounts_statement_transactions_retrieve",
        "parameters": [
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
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/BankStatementTransaction"
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
        "summary": "Retrieve bank statement transaction",
        "tags": [
          "Bank Statement Transactions"
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