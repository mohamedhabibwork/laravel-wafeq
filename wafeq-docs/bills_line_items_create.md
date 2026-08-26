---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Create bill line item

Endpoint for creating a new bill line item.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "AmortizationInput": {
        "properties": {
          "account": {
            "description": "The expense account used for amortization recognition.",
            "type": "string"
          },
          "amount": {
            "description": "The total amount to amortize.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "description": {
            "description": "The description of the amortization.",
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
            "description": "The end date of the amortization schedule.",
            "format": "date",
            "type": "string"
          },
          "recognition_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/RecognitionTypeEnum"
              }
            ],
            "description": "How the amortization is recognized (DAILY or MONTHLY).\n\n* `DAILY` - Daily\n* `MONTHLY` - Monthly"
          },
          "start_date": {
            "description": "The start date of the amortization schedule.",
            "format": "date",
            "type": "string"
          },
          "use_entity_date": {
            "description": "Whether the amortization start date follows the bill date.",
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
      },
      "BillLineItem": {
        "description": "Augment ``custom_fields`` in the output with computed CALCULATED field values.\n\nApply to any line-item serializer whose model has ``get_resolved_custom_fields``.",
        "properties": {
          "account": {
            "description": "The account associated with this line item.",
            "type": "string"
          },
          "amortization": {
            "description": "Optional amortization configuration. When provided, an amortization is created for this line item.",
            "oneOf": [
              {
                "$ref": "#/components/schemas/AmortizationInput"
              },
              {
                "type": "null"
              }
            ],
            "writeOnly": true
          },
          "amortization_id": {
            "description": "The unique identifier of the amortization linked to this line item, if any.",
            "readOnly": true,
            "type": [
              "string",
              "null"
            ]
          },
          "cost_center": {
            "description": "The cost center associated with this line item, if any.",
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
            "description": "The total amount for this line item, calculated as quantity * unit_amount - discount.",
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
          "tax_amount": {
            "description": "The total tax amount for this line item.",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "readOnly": true,
            "type": "number"
          },
          "tax_rate": {
            "description": "The tax rate applied to this line item, if any.",
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
          "amortization_id",
          "created_ts",
          "description",
          "id",
          "legacy_id",
          "line_amount",
          "modified_ts",
          "quantity",
          "tax_amount",
          "unit_amount"
        ],
        "type": "object"
      },
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
      "RecognitionTypeEnum": {
        "description": "* `DAILY` - Daily\n* `MONTHLY` - Monthly\n\nFull information for [RecognitionTypeEnum](recognitiontypeenum)",
        "enum": [
          "DAILY",
          "MONTHLY"
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
    "/bills/{bill_id}/line-items/": {
      "post": {
        "description": "Endpoint for creating a new bill line item.",
        "operationId": "bills_line_items_create",
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
            "name": "bill_id",
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
                "$ref": "#/components/schemas/BillLineItem"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/BillLineItem"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/BillLineItem"
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
                  "$ref": "#/components/schemas/BillLineItem"
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
        "summary": "Create bill line item",
        "tags": [
          "Bill Line Items"
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