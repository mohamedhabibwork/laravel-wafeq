---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# List files

Endpoint for retrieving a list of files.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "Paginatedapi-v1-external-file-readList": {
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
              "$ref": "#/components/schemas/api-v1-external-file-read"
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
      "api-v1-external-file-read": {
        "properties": {
          "created_ts": {
            "description": "The timestamp in UTC when the file created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "file": {
            "description": "The actual file content.",
            "format": "uri",
            "type": [
              "string",
              "null"
            ]
          },
          "file_size": {
            "description": "The size of the file in bytes.",
            "maximum": 2147483647,
            "minimum": -2147483648,
            "type": [
              "integer",
              "null"
            ]
          },
          "id": {
            "description": "The unique identifier of the file object.",
            "readOnly": true,
            "type": "string"
          },
          "mime_type": {
            "description": "The MIME type of the file.",
            "maxLength": 100,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the file was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "original_filename": {
            "description": "The original filename of the uploaded file.",
            "maxLength": 200,
            "type": "string"
          }
        },
        "required": [
          "created_ts",
          "id",
          "mime_type",
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
    "/files/": {
      "get": {
        "description": "Endpoint for retrieving a list of files.",
        "operationId": "files_list",
        "parameters": [
          {
            "description": "The timestamp in UTC when the file was created",
            "in": "query",
            "name": "created_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the file was created",
            "in": "query",
            "name": "created_ts_before",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "in": "query",
            "name": "file_size_max",
            "schema": {
              "maximum": 2147483647,
              "minimum": -2147483648,
              "type": [
                "integer",
                "null"
              ]
            }
          },
          {
            "in": "query",
            "name": "file_size_min",
            "schema": {
              "maximum": 2147483647,
              "minimum": -2147483648,
              "type": [
                "integer",
                "null"
              ]
            }
          },
          {
            "in": "query",
            "name": "mime_type",
            "schema": {
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the file was last modified",
            "in": "query",
            "name": "modified_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the file was last modified",
            "in": "query",
            "name": "modified_ts_before",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "in": "query",
            "name": "original_filename",
            "schema": {
              "type": "string"
            }
          },
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
                  "$ref": "#/components/schemas/Paginatedapi-v1-external-file-readList"
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
        "summary": "List files",
        "tags": [
          "Files"
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