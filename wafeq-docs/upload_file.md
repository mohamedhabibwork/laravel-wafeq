---
updatedAt: 2026-04-21T07:06:05.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Create file

Endpoint for creating a new file. Upload a file using multipart/form-data.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
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
      "post": {
        "description": "Endpoint for creating a new file. Upload a file using multipart/form-data.",
        "operationId": "upload_file",
        "requestBody": {
          "content": {
            "multipart/form-data": {
              "schema": {
                "properties": {
                  "file": {
                    "format": "binary",
                    "type": "string"
                  }
                },
                "type": "object"
              }
            }
          }
        },
        "responses": {
          "201": {
            "content": {
              "application/json": {
                "examples": {
                  "FileUploadResponse": {
                    "summary": "File upload response",
                    "value": {
                      "created_ts": "2024-01-15T10:30:00Z",
                      "file": "https://cdn.wafeq.com/static/docs/attachments/invoice_2024_01.pdf",
                      "file_size": 45678,
                      "id": "att_MB8QxUoUQtFKYLjVShWfpC",
                      "mime_type": "application/pdf",
                      "modified_ts": "2024-01-15T10:30:00Z",
                      "original_filename": "invoice_2024_01.pdf"
                    }
                  }
                },
                "schema": {
                  "$ref": "#/components/schemas/api-v1-external-file-read"
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
        "summary": "Create file",
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