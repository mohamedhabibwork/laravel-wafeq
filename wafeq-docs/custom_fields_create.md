---
updatedAt: 2026-04-21T07:06:05.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Create custom field

Endpoint for creating a new custom field.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "ApplyToEnum": {
        "description": "* `SALES` - SALES\n* `PURCHASES` - PURCHASES\n* `CONTACTS` - CONTACTS\n\nFull information for [ApplyToEnum](applytoenum)",
        "enum": [
          "SALES",
          "PURCHASES",
          "CONTACTS"
        ],
        "type": "string"
      },
      "CalculatedFieldOperator": {
        "enum": [
          "MULTIPLY"
        ],
        "title": "CalculatedFieldOperator",
        "type": "string"
      },
      "ChoiceModel": {
        "additionalProperties": false,
        "properties": {
          "label": {
            "title": "Label",
            "type": "string"
          },
          "value": {
            "title": "Value",
            "type": "string"
          }
        },
        "required": [
          "label"
        ],
        "title": "ChoiceModel",
        "type": "object"
      },
      "CodeEnum": {
        "description": "* `permission_denied` - Permission Denied\n\nFull information for [CodeEnum](codeenum)",
        "enum": [
          "permission_denied"
        ],
        "type": "string"
      },
      "CustomFieldCalculatedMetadataModel": {
        "additionalProperties": false,
        "properties": {
          "operands": {
            "items": {
              "type": "string"
            },
            "minItems": 2,
            "title": "Operands",
            "type": "array"
          },
          "operator": {
            "$ref": "#/components/schemas/CalculatedFieldOperator"
          }
        },
        "required": [
          "operator",
          "operands"
        ],
        "title": "CustomFieldCalculatedMetadataModel",
        "type": "object"
      },
      "CustomFieldCalculatedModel": {
        "additionalProperties": false,
        "properties": {
          "field_type": {
            "const": "CALCULATED",
            "title": "Field Type",
            "type": "string"
          },
          "metadata": {
            "$ref": "#/components/schemas/CustomFieldCalculatedMetadataModel"
          }
        },
        "required": [
          "field_type",
          "metadata"
        ],
        "title": "CustomFieldCalculatedModel",
        "type": "object"
      },
      "CustomFieldDateMetadataModel": {
        "additionalProperties": false,
        "properties": {},
        "title": "CustomFieldDateMetadataModel",
        "type": "object"
      },
      "CustomFieldDateModel": {
        "additionalProperties": false,
        "properties": {
          "field_type": {
            "const": "DATE",
            "title": "Field Type",
            "type": "string"
          },
          "metadata": {
            "$ref": "#/components/schemas/CustomFieldDateMetadataModel"
          }
        },
        "required": [
          "field_type"
        ],
        "title": "CustomFieldDateModel",
        "type": "object"
      },
      "CustomFieldLongTextMetadataModel": {
        "additionalProperties": false,
        "properties": {},
        "title": "CustomFieldLongTextMetadataModel",
        "type": "object"
      },
      "CustomFieldLongTextModel": {
        "additionalProperties": false,
        "properties": {
          "field_type": {
            "const": "LONG_TEXT",
            "title": "Field Type",
            "type": "string"
          },
          "metadata": {
            "$ref": "#/components/schemas/CustomFieldLongTextMetadataModel"
          }
        },
        "required": [
          "field_type"
        ],
        "title": "CustomFieldLongTextModel",
        "type": "object"
      },
      "CustomFieldLookupEntityType": {
        "enum": [
          "EMPLOYEE",
          "USER"
        ],
        "title": "CustomFieldLookupEntityType",
        "type": "string"
      },
      "CustomFieldLookupMetadataModel": {
        "additionalProperties": false,
        "properties": {
          "entity_type": {
            "$ref": "#/components/schemas/CustomFieldLookupEntityType"
          }
        },
        "required": [
          "entity_type"
        ],
        "title": "CustomFieldLookupMetadataModel",
        "type": "object"
      },
      "CustomFieldLookupModel": {
        "additionalProperties": false,
        "properties": {
          "field_type": {
            "const": "LOOKUP",
            "title": "Field Type",
            "type": "string"
          },
          "metadata": {
            "$ref": "#/components/schemas/CustomFieldLookupMetadataModel"
          }
        },
        "required": [
          "field_type",
          "metadata"
        ],
        "title": "CustomFieldLookupModel",
        "type": "object"
      },
      "CustomFieldNumberMetadataModel": {
        "additionalProperties": false,
        "properties": {},
        "title": "CustomFieldNumberMetadataModel",
        "type": "object"
      },
      "CustomFieldNumberModel": {
        "additionalProperties": false,
        "properties": {
          "field_type": {
            "const": "NUMBER",
            "title": "Field Type",
            "type": "string"
          },
          "metadata": {
            "$ref": "#/components/schemas/CustomFieldNumberMetadataModel"
          }
        },
        "required": [
          "field_type"
        ],
        "title": "CustomFieldNumberModel",
        "type": "object"
      },
      "CustomFieldSelectMetadataModel": {
        "additionalProperties": false,
        "properties": {
          "choices": {
            "items": {
              "$ref": "#/components/schemas/ChoiceModel"
            },
            "title": "Choices",
            "type": "array"
          }
        },
        "required": [
          "choices"
        ],
        "title": "CustomFieldSelectMetadataModel",
        "type": "object"
      },
      "CustomFieldSelectModel": {
        "additionalProperties": false,
        "properties": {
          "field_type": {
            "const": "SELECT",
            "title": "Field Type",
            "type": "string"
          },
          "metadata": {
            "$ref": "#/components/schemas/CustomFieldSelectMetadataModel"
          }
        },
        "required": [
          "field_type",
          "metadata"
        ],
        "title": "CustomFieldSelectModel",
        "type": "object"
      },
      "CustomFieldTextMetadataModel": {
        "additionalProperties": false,
        "properties": {},
        "title": "CustomFieldTextMetadataModel",
        "type": "object"
      },
      "CustomFieldTextModel": {
        "additionalProperties": false,
        "properties": {
          "field_type": {
            "const": "TEXT",
            "title": "Field Type",
            "type": "string"
          },
          "metadata": {
            "$ref": "#/components/schemas/CustomFieldTextMetadataModel"
          }
        },
        "required": [
          "field_type"
        ],
        "title": "CustomFieldTextModel",
        "type": "object"
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
      "FieldTypeEnum": {
        "description": "* `TEXT` - TEXT\n* `LONG_TEXT` - LONG_TEXT\n* `NUMBER` - NUMBER\n* `DATE` - DATE\n* `SELECT` - SELECT\n* `LOOKUP` - LOOKUP\n* `CALCULATED` - CALCULATED\n\nFull information for [FieldTypeEnum](fieldtypeenum)",
        "enum": [
          "TEXT",
          "LONG_TEXT",
          "NUMBER",
          "DATE",
          "SELECT",
          "LOOKUP",
          "CALCULATED"
        ],
        "type": "string"
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
      },
      "api-v1-external-custom-field-read": {
        "properties": {
          "apply_to": {
            "description": "The groups this custom field applies to.",
            "items": {
              "$ref": "#/components/schemas/ApplyToEnum"
            },
            "readOnly": true,
            "type": "array"
          },
          "config": {
            "description": "The configuration of the custom field, containing field_type and metadata. The metadata structure depends on field_type: SELECT fields include a choices array, LOOKUP fields include an entity_type, and other types have empty metadata.",
            "discriminator": {
              "mapping": {
                "CALCULATED": "#/components/schemas/CustomFieldCalculatedModel",
                "DATE": "#/components/schemas/CustomFieldDateModel",
                "LONG_TEXT": "#/components/schemas/CustomFieldLongTextModel",
                "LOOKUP": "#/components/schemas/CustomFieldLookupModel",
                "NUMBER": "#/components/schemas/CustomFieldNumberModel",
                "SELECT": "#/components/schemas/CustomFieldSelectModel",
                "TEXT": "#/components/schemas/CustomFieldTextModel"
              },
              "propertyName": "field_type"
            },
            "oneOf": [
              {
                "$ref": "#/components/schemas/CustomFieldSelectModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldNumberModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldTextModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldLongTextModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldDateModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldLookupModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldCalculatedModel"
              }
            ],
            "title": "CustomFieldConfigModel"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the custom field was created.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "field_type": {
            "allOf": [
              {
                "$ref": "#/components/schemas/FieldTypeEnum"
              }
            ],
            "description": "The type of the custom field.\n\n* `TEXT` - TEXT\n* `LONG_TEXT` - LONG_TEXT\n* `NUMBER` - NUMBER\n* `DATE` - DATE\n* `SELECT` - SELECT\n* `LOOKUP` - LOOKUP\n* `CALCULATED` - CALCULATED",
            "readOnly": true
          },
          "id": {
            "description": "The unique identifier of the custom field.",
            "readOnly": true,
            "type": "string"
          },
          "is_active": {
            "type": "boolean"
          },
          "is_line_item_field": {
            "type": "boolean"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the custom field was last modified.",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "maxLength": 100,
            "type": "string"
          },
          "name_ar": {
            "maxLength": 100,
            "type": "string"
          }
        },
        "required": [
          "apply_to",
          "config",
          "created_ts",
          "field_type",
          "id",
          "modified_ts"
        ],
        "type": "object"
      },
      "api-v1-external-custom-field-write": {
        "properties": {
          "apply_to": {
            "description": "The groups this custom field applies to.",
            "items": {
              "$ref": "#/components/schemas/ApplyToEnum"
            },
            "type": "array"
          },
          "config": {
            "description": "The configuration of the custom field, containing field_type and metadata. The metadata structure depends on field_type: SELECT fields include a choices array, LOOKUP fields include an entity_type, and other types have empty metadata.",
            "discriminator": {
              "mapping": {
                "CALCULATED": "#/components/schemas/CustomFieldCalculatedModel",
                "DATE": "#/components/schemas/CustomFieldDateModel",
                "LONG_TEXT": "#/components/schemas/CustomFieldLongTextModel",
                "LOOKUP": "#/components/schemas/CustomFieldLookupModel",
                "NUMBER": "#/components/schemas/CustomFieldNumberModel",
                "SELECT": "#/components/schemas/CustomFieldSelectModel",
                "TEXT": "#/components/schemas/CustomFieldTextModel"
              },
              "propertyName": "field_type"
            },
            "oneOf": [
              {
                "$ref": "#/components/schemas/CustomFieldSelectModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldNumberModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldTextModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldLongTextModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldDateModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldLookupModel"
              },
              {
                "$ref": "#/components/schemas/CustomFieldCalculatedModel"
              }
            ],
            "title": "CustomFieldConfigModel"
          },
          "is_active": {
            "type": "boolean"
          },
          "is_line_item_field": {
            "type": "boolean"
          },
          "is_visible": {
            "type": "boolean"
          },
          "name": {
            "description": "The english name of the custom field.",
            "maxLength": 100,
            "type": "string"
          },
          "name_ar": {
            "description": "The arabic name of the custom field.",
            "maxLength": 100,
            "type": "string"
          }
        },
        "required": [
          "apply_to",
          "config"
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
    "/custom-fields/": {
      "post": {
        "description": "Endpoint for creating a new custom field.",
        "operationId": "custom_fields_create",
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
                "$ref": "#/components/schemas/api-v1-external-custom-field-write"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/api-v1-external-custom-field-write"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/api-v1-external-custom-field-write"
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
                  "$ref": "#/components/schemas/api-v1-external-custom-field-read"
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
        "summary": "Create custom field",
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