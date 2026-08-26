---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Partial update branch

Endpoint for partially updating an existing branch.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "Branch": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "address": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "Full address of the branch in both primary and secondary languages."
          },
          "building_number": {
            "description": "Building number or identifier of the branch location.",
            "type": "string"
          },
          "city": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "City where the branch is located in both primary and secondary languages."
          },
          "district": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "District or area where the branch is located in both primary and secondary languages."
          },
          "id": {
            "description": "The unique identifier of the branch.",
            "readOnly": true,
            "type": "string"
          },
          "is_active": {
            "default": true,
            "description": "Indicates whether the branch is currently active (True) or inactive (False).",
            "type": "boolean"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the branch.",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "The name of the branch in both primary and secondary languages."
          },
          "phone": {
            "description": "Contact phone number for the branch.",
            "type": "string"
          },
          "postal_code": {
            "description": "Postal code or ZIP code of the branch location.",
            "type": "string"
          },
          "state": {
            "description": "Emirate for UAE organizations. Read-only field.",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "address",
          "building_number",
          "city",
          "district",
          "id",
          "legacy_id",
          "name",
          "phone",
          "postal_code",
          "state"
        ],
        "type": "object"
      },
      "PatchedBranch": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "address": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "Full address of the branch in both primary and secondary languages."
          },
          "building_number": {
            "description": "Building number or identifier of the branch location.",
            "type": "string"
          },
          "city": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "City where the branch is located in both primary and secondary languages."
          },
          "district": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "District or area where the branch is located in both primary and secondary languages."
          },
          "id": {
            "description": "The unique identifier of the branch.",
            "readOnly": true,
            "type": "string"
          },
          "is_active": {
            "default": true,
            "description": "Indicates whether the branch is currently active (True) or inactive (False).",
            "type": "boolean"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the branch.",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "The name of the branch in both primary and secondary languages."
          },
          "phone": {
            "description": "Contact phone number for the branch.",
            "type": "string"
          },
          "postal_code": {
            "description": "Postal code or ZIP code of the branch location.",
            "type": "string"
          },
          "state": {
            "description": "Emirate for UAE organizations. Read-only field.",
            "readOnly": true,
            "type": "string"
          }
        },
        "type": "object"
      },
      "common-dual-lang-model": {
        "properties": {
          "ar": {
            "description": "The value in the Arabic language.",
            "type": "string"
          },
          "en": {
            "description": "The value in the English language.",
            "type": "string"
          }
        },
        "required": [
          "en"
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
    "/branches/{id}/": {
      "patch": {
        "description": "Endpoint for partially updating an existing branch.",
        "operationId": "branches_partial_update",
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
                "$ref": "#/components/schemas/PatchedBranch"
              }
            },
            "application/x-www-form-urlencoded": {
              "schema": {
                "$ref": "#/components/schemas/PatchedBranch"
              }
            },
            "multipart/form-data": {
              "schema": {
                "$ref": "#/components/schemas/PatchedBranch"
              }
            }
          }
        },
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/Branch"
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
        "summary": "Partial update branch",
        "tags": [
          "Branches"
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