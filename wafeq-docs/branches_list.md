---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# List branches

Endpoint for retrieving a list of branches.

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
      "PaginatedBranchList": {
        "properties": {
          "count": {
            "example": 123,
            "type": "integer"
          },
          "next": {
            "example": "http://api.example.org/accounts/?page=4",
            "format": "uri",
            "nullable": true,
            "type": "string"
          },
          "previous": {
            "example": "http://api.example.org/accounts/?page=2",
            "format": "uri",
            "nullable": true,
            "type": "string"
          },
          "results": {
            "items": {
              "$ref": "#/components/schemas/Branch"
            },
            "type": "array"
          }
        },
        "required": [
          "count",
          "results"
        ],
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
    "/branches/": {
      "get": {
        "description": "Endpoint for retrieving a list of branches.",
        "operationId": "branches_list",
        "parameters": [
          {
            "description": "A page number within the paginated result set.",
            "in": "query",
            "name": "page",
            "required": false,
            "schema": {
              "type": "integer"
            }
          },
          {
            "description": "Number of results to return per page.",
            "in": "query",
            "name": "page_size",
            "required": false,
            "schema": {
              "type": "integer"
            }
          }
        ],
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/PaginatedBranchList"
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
        "summary": "List branches",
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