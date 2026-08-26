---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Retrieve invoice line item

Endpoint for retrieving a single invoice line item.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "DurationEnum": {
        "description": "* `3_MONTHS` - 3 Months\n* `4_MONTHS` - 4 Months\n* `6_MONTHS` - 6 Months\n* `12_MONTHS` - 12 Months\n* `24_MONTHS` - 24 Months\n* `CUSTOM` - Custom\n\nFull information for [DurationEnum](durationenum)",
        "enum": [
          "3_MONTHS",
          "4_MONTHS",
          "6_MONTHS",
          "12_MONTHS",
          "24_MONTHS",
          "CUSTOM"
        ],
        "type": "string"
      },
      "InvoiceLineItem": {
        "description": "Augment ``custom_fields`` in the output with computed CALCULATED field values.\n\nApply to any line-item serializer whose model has ``get_resolved_custom_fields``.",
        "properties": {
          "account": {
            "description": "The account associated with this line item.",
            "type": "string"
          },
          "cost_center": {
            "description": "The cost center associated with this line item.",
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the line item was created.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "custom_fields": {
            "additionalProperties": {},
            "description": "A mapping of custom field IDs to their values.",
            "type": "object"
          },
          "description": {
            "description": "The detailed description of the line item.",
            "type": "string"
          },
          "discount": {
            "description": "The discount as the percentage.",
            "exclusiveMaximum": 10000000000000000,
            "format": "double",
            "minimum": 0,
            "type": [
              "number",
              "null"
            ]
          },
          "id": {
            "description": "The unique identifier of the line item.",
            "readOnly": true,
            "type": "string"
          },
          "item": {
            "description": "The item associated with this line item.",
            "type": "string"
          },
          "item_unit_of_measure": {
            "description": "The item unit of measure for this line item.",
            "type": [
              "string",
              "null"
            ]
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the line item.",
            "readOnly": true,
            "type": "string"
          },
          "line_amount": {
            "description": "The total amount for this line item (quantity * unit_amount).",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the line item was last modified.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "order": {
            "type": "integer",
            "writeOnly": true
          },
          "quantity": {
            "description": "The quantity of the item or service.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "revenue_recognition": {
            "description": "Optional revenue recognition configuration. When provided, a revenue recognition is created for this line item.",
            "oneOf": [
              {
                "$ref": "#/components/schemas/RevenueRecognitionInput"
              },
              {
                "type": "null"
              }
            ],
            "writeOnly": true
          },
          "revenue_recognition_id": {
            "description": "The unique identifier of the revenue recognition linked to this line item, if any.",
            "readOnly": true,
            "type": [
              "string",
              "null"
            ]
          },
          "tax_amount": {
            "description": "The total tax amount for this line item.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "tax_rate": {
            "description": "The tax rate applied to this line item.",
            "type": "string"
          },
          "unit_amount": {
            "description": "The price per unit of the item or service.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          }
        },
        "required": [
          "account",
          "created_ts",
          "description",
          "id",
          "legacy_id",
          "line_amount",
          "modified_ts",
          "quantity",
          "revenue_recognition_id",
          "tax_amount",
          "unit_amount"
        ],
        "type": "object"
      },
      "RecognitionTypeEnum": {
        "description": "* `DAILY` - Daily\n* `MONTHLY` - Monthly\n\nFull information for [RecognitionTypeEnum](recognitiontypeenum)",
        "enum": [
          "DAILY",
          "MONTHLY"
        ],
        "type": "string"
      },
      "RevenueRecognitionInput": {
        "properties": {
          "account": {
            "description": "The revenue account used for revenue recognition.",
            "type": "string"
          },
          "amount": {
            "description": "The total amount to recognize.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "description": {
            "description": "The description of the revenue recognition.",
            "type": "string"
          },
          "duration": {
            "allOf": [
              {
                "$ref": "#/components/schemas/DurationEnum"
              }
            ],
            "description": "The recognition duration.\n\n* `3_MONTHS` - 3 Months\n* `4_MONTHS` - 4 Months\n* `6_MONTHS` - 6 Months\n* `12_MONTHS` - 12 Months\n* `24_MONTHS` - 24 Months\n* `CUSTOM` - Custom"
          },
          "end_date": {
            "description": "The end date of the revenue recognition schedule.",
            "format": "date",
            "type": "string"
          },
          "recognition_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/RecognitionTypeEnum"
              }
            ],
            "description": "How the revenue recognition is recognized (DAILY or MONTHLY).\n\n* `DAILY` - Daily\n* `MONTHLY` - Monthly"
          },
          "start_date": {
            "description": "The start date of the revenue recognition schedule.",
            "format": "date",
            "type": "string"
          },
          "use_entity_date": {
            "description": "Whether the revenue recognition start date follows the invoice date.",
            "type": "boolean"
          }
        },
        "required": [
          "account",
          "amount",
          "description",
          "duration",
          "end_date",
          "recognition_type",
          "start_date",
          "use_entity_date"
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
    "/invoices/{invoice_id}/line-items/{id}/": {
      "get": {
        "description": "Endpoint for retrieving a single invoice line item.",
        "operationId": "invoices_line_items_retrieve",
        "parameters": [
          {
            "in": "path",
            "name": "invoice_id",
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
                  "$ref": "#/components/schemas/InvoiceLineItem"
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
        "summary": "Retrieve invoice line item",
        "tags": [
          "Invoice Line Items"
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