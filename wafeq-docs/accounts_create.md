---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Create account

Endpoint for creating a new account.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "Account": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "account_code": {
            "description": "The unique code identifying this account.",
            "maxLength": 30,
            "type": "string"
          },
          "account_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/AccountTypeEnum"
              }
            ],
            "description": "The type of the account.\n\n* `ACCOUNTS_RECEIVABLE` - Accounts Receivable\n* `CASH_ADVANCES` - Cash Advances\n* `CASH_EQUIVALENTS` - Cash and Cash Equivalents\n* `EMPLOYEE_ADVANCE` - Employee Advance\n* `INVENTORY` - Inventory\n* `OTHER_CURRENT_ASSETS` - Other Current Assets\n* `PREPAID_EXPENSES` - Prepaid Expenses\n* `ACCUMULATED_DEPRECIATION` - Accumulated Depreciation\n* `INTANGIBLE_ASSETS` - Intangible Assets\n* `OTHER_NON_CURRENT_ASSETS` - Other Non-Current Assets\n* `PROPERTY_PLANT_AND_EQUIPMENT` - Property, Plant and Equipment\n* `ACCOUNTS_PAYABLE` - Accounts Payable\n* `ACCRUED_EXPENSES` - Accrued Expenses\n* `OTHER_CURRENT_LIABILITIES` - Other Current Liabilities\n* `PAYROLL_PAYABLE` - Payroll Payable\n* `SHORT_TERM_LOANS_PAYABLE` - Short-Term Loans Payable\n* `TAX_PAYABLE` - Tax Payable\n* `UNEARNED_REVENUE` - Unearned Revenue\n* `VAT` - VAT\n* `END_OF_SERVICE_BENEFITS` - End of Service Benefits\n* `LONG_TERM_LOANS_PAYABLE` - Long-Term Loans Payable\n* `OTHER_NON_CURRENT_LIABILITIES` - Other Non-Current Liabilities\n* `ISSUED_CAPITAL` - Issued Capital\n* `OTHER_OWNERS_EQUITY` - Other Owners' Equity\n* `PAID_IN_CAPITAL` - Paid-in Capital\n* `SHARE_CAPITAL` - Share Capital\n* `TREASURY_STOCK` - Treasury Stock\n* `RETAINED_EARNINGS` - Retained Earnings\n* `OPENING_BALANCE_EQUITY` - Opening Balance Equity\n* `OTHER_COMPREHENSIVE_INCOME` - Other Comprehensive Income\n* `INTEREST_INCOME` - Interest Income\n* `OTHER_INCOME` - Other Income\n* `GENERAL_AND_ADMINISTRATIVE_EXPENSES` - General and Administrative Expenses\n* `MARKETING_EXPENSES` - Marketing Expenses\n* `OTHER_OPERATING_EXPENSES` - Other Operating Expenses\n* `RESEARCH_AND_DEVELOPMENT` - Research and Development\n* `DEPRECIATION_AND_AMORTIZATION` - Depreciation and Amortization\n* `INTEREST_EXPENSE` - Interest Expense\n* `OTHER_NON_OPERATING_EXPENSES` - Other Non-Operating Expenses\n* `REALIZED_EXCHANGE_GAIN_OR_LOSS` - Realized Exchange Gain or Loss\n* `TAX` - Tax\n* `UNREALIZED_EXCHANGE_GAIN_OR_LOSS` - Unrealized Exchange Gain or Loss\n* `ZAKAT` - Zakat"
          },
          "classification": {
            "allOf": [
              {
                "$ref": "#/components/schemas/ClassificationEnum"
              }
            ],
            "description": "The primary classification of the account (e.g. Asset, Liability, Equity, Income, Expense).\n\n* `REVENUE` - Revenue\n* `EXPENSE` - Expense\n* `ASSET` - Asset\n* `LIABILITY` - Liability\n* `EQUITY` - Equity"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the account was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "external_id": {
            "default": "",
            "description": "External identifier for the account.",
            "maxLength": 255,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the account.",
            "readOnly": true,
            "type": "string"
          },
          "is_locked": {
            "description": "Indicates whether the account is locked and cannot be modified.",
            "readOnly": true,
            "type": "boolean"
          },
          "is_payment_enabled": {
            "description": "Indicates whether the account can be used for payments.",
            "type": "boolean"
          },
          "is_posting": {
            "description": "Indicates whether the account can be used for posting.",
            "type": "boolean"
          },
          "is_system": {
            "description": "Indicates whether this is a system-generated account that cannot be deleted.",
            "readOnly": true,
            "type": "boolean"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the account.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the account was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name_ar": {
            "default": "",
            "description": "The name of the account in Arabic.",
            "maxLength": 200,
            "type": "string"
          },
          "name_en": {
            "description": "The name of the account in English.",
            "type": "string"
          },
          "parent": {
            "description": "The parent account, if this is a sub-account.",
            "type": [
              "string",
              "null"
            ]
          },
          "sub_classification": {
            "allOf": [
              {
                "$ref": "#/components/schemas/AccountSubClassificationEnum"
              }
            ],
            "description": "The secondary classification of the account, providing more specific categorization.\n\n* `INCOME` - Income\n* `COGS` - Cost of Sales\n* `OPERATING_EXPENSE` - Operating Expenses\n* `OTHER_INCOME` - Other Income\n* `NON_OPERATING_EXPENSE` - Non-Operating Expenses\n* `CASH_EQUIVALENTS` - Cash and Cash Equivalents\n* `CURRENT_ASSET` - Current Assets\n* `NON_CURRENT_ASSET` - Non-Current Assets\n* `FIXED_ASSET` - Fixed Asset\n* `CURRENT_LIABILITY` - Current Liabilities\n* `NON_CURRENT_LIABILITY` - Non-Current Liabilities\n* `PAID_IN_CAPITAL` - Paid-in Capital\n* `RETAINED_EARNINGS` - Retained Earnings\n* `ACCUMULATED_OTHER_COMPREHENSIVE_INCOME` - Acc. Other Comprehensive Income\n* `TREASURY_STOCK` - Treasury Stock\n* `OWNERS_EQUITY` - Owner's Equity\n* `OPENING_BALANCE_EQUITY` - Opening Balance Equity"
          }
        },
        "required": [
          "account_code",
          "classification",
          "created_ts",
          "id",
          "is_locked",
          "is_payment_enabled",
          "is_system",
          "legacy_id",
          "modified_ts",
          "name_en",
          "sub_classification"
        ],
        "type": "object"
      },
      "AccountSubClassificationEnum": {
        "description": "* `INCOME` - Income\n* `COGS` - Cost of Sales\n* `OPERATING_EXPENSE` - Operating Expenses\n* `OTHER_INCOME` - Other Income\n* `NON_OPERATING_EXPENSE` - Non-Operating Expenses\n* `CASH_EQUIVALENTS` - Cash and Cash Equivalents\n* `CURRENT_ASSET` - Current Assets\n* `NON_CURRENT_ASSET` - Non-Current Assets\n* `FIXED_ASSET` - Fixed Asset\n* `CURRENT_LIABILITY` - Current Liabilities\n* `...`\n\nFull information for [AccountSubClassificationEnum](accountsubclassificationenum)",
        "enum": [
          "INCOME",
          "COGS",
          "OPERATING_EXPENSE",
          "OTHER_INCOME",
          "NON_OPERATING_EXPENSE",
          "CASH_EQUIVALENTS",
          "CURRENT_ASSET",
          "NON_CURRENT_ASSET",
          "FIXED_ASSET",
          "CURRENT_LIABILITY",
          "NON_CURRENT_LIABILITY",
          "PAID_IN_CAPITAL",
          "RETAINED_EARNINGS",
          "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME",
          "TREASURY_STOCK",
          "OWNERS_EQUITY",
          "OPENING_BALANCE_EQUITY"
        ],
        "type": "string"
      },
      "AccountTypeEnum": {
        "description": "* `ACCOUNTS_RECEIVABLE` - Accounts Receivable\n* `CASH_ADVANCES` - Cash Advances\n* `CASH_EQUIVALENTS` - Cash and Cash Equivalents\n* `EMPLOYEE_ADVANCE` - Employee Advance\n* `INVENTORY` - Inventory\n* `OTHER_CURRENT_ASSETS` - Other Current Assets\n* `PREPAID_EXPENSES` - Prepaid Expenses\n* `ACCUMULATED_DEPRECIATION` - Accumulated Depreciation\n* `INTANGIBLE_ASSETS` - Intangible Assets\n* `OTHER_NON_CURRENT_ASSETS` - Other Non-Current Assets\n* `...`\n\nFull information for [AccountTypeEnum](accounttypeenum)",
        "enum": [
          "ACCOUNTS_RECEIVABLE",
          "CASH_ADVANCES",
          "CASH_EQUIVALENTS",
          "EMPLOYEE_ADVANCE",
          "INVENTORY",
          "OTHER_CURRENT_ASSETS",
          "PREPAID_EXPENSES",
          "ACCUMULATED_DEPRECIATION",
          "INTANGIBLE_ASSETS",
          "OTHER_NON_CURRENT_ASSETS",
          "PROPERTY_PLANT_AND_EQUIPMENT",
          "ACCOUNTS_PAYABLE",
          "ACCRUED_EXPENSES",
          "OTHER_CURRENT_LIABILITIES",
          "PAYROLL_PAYABLE",
          "SHORT_TERM_LOANS_PAYABLE",
          "TAX_PAYABLE",
          "UNEARNED_REVENUE",
          "VAT",
          "END_OF_SERVICE_BENEFITS",
          "LONG_TERM_LOANS_PAYABLE",
          "OTHER_NON_CURRENT_LIABILITIES",
          "ISSUED_CAPITAL",
          "OTHER_OWNERS_EQUITY",
          "PAID_IN_CAPITAL",
          "SHARE_CAPITAL",
          "TREASURY_STOCK",
          "RETAINED_EARNINGS",
          "OPENING_BALANCE_EQUITY",
          "OTHER_COMPREHENSIVE_INCOME",
          "INTEREST_INCOME",
          "OTHER_INCOME",
          "GENERAL_AND_ADMINISTRATIVE_EXPENSES",
          "MARKETING_EXPENSES",
          "OTHER_OPERATING_EXPENSES",
          "RESEARCH_AND_DEVELOPMENT",
          "DEPRECIATION_AND_AMORTIZATION",
          "INTEREST_EXPENSE",
          "OTHER_NON_OPERATING_EXPENSES",
          "REALIZED_EXCHANGE_GAIN_OR_LOSS",
          "TAX",
          "UNREALIZED_EXCHANGE_GAIN_OR_LOSS",
          "ZAKAT"
        ],
        "type": "string"
      },
      "ClassificationEnum": {
        "description": "* `REVENUE` - Revenue\n* `EXPENSE` - Expense\n* `ASSET` - Asset\n* `LIABILITY` - Liability\n* `EQUITY` - Equity\n\nFull information for [ClassificationEnum](classificationenum)",
        "enum": [
          "REVENUE",
          "EXPENSE",
          "ASSET",
          "LIABILITY",
          "EQUITY"
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
    "/accounts/": {
      "post": {
        "description": "Endpoint for creating a new account.",
        "operationId": "accounts_create",
        "parameters": [
          {
            "description": "Client-provided UUID to uniquely identify a request",
            "in": "header",
            "name": "X-Wafeq-Idempotency-Key",
            "schema": {
              "type": "string"
            }
          }
        ],
        "requestBody": {
          "content": {
            "application/json": {
              "schema": {
                "$ref": "#/components/schemas/Account"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/Account"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/Account"
              }
            }
          },
          "required": true
        },
        "responses": {
          "201": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/Account"
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
        "summary": "Create account",
        "tags": [
          "Accounts"
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