---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Balance Sheet


Generate balance sheet report in `currency` at `date` with `period_count` periods to compare and group it by `group_by` parameter.


# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "api-v1-external-reports-balance-sheet-data-read": {
        "properties": {
          "children": {
            "description": "The children of the row. The value is the same as children of the section",
            "items": {
              "additionalProperties": {},
              "type": "object"
            },
            "readOnly": true,
            "type": "array"
          },
          "id": {
            "description": "The id of the row",
            "type": "string"
          },
          "label": {
            "description": "The label of the row",
            "type": "string"
          },
          "metadata": {
            "additionalProperties": {},
            "description": "The metadata of the row",
            "type": "object"
          },
          "summary": {
            "allOf": [
              {
                "$ref": "#/components/schemas/api-v1-external-reports-balance-sheet-row-summary-read"
              }
            ],
            "description": "The summary of the row"
          },
          "values": {
            "description": "The values of the row",
            "items": {
              "exclusiveMaximum": 10000000000000000,
              "exclusiveMinimum": -10000000000000000,
              "format": "double",
              "type": "number"
            },
            "type": "array"
          }
        },
        "required": [
          "children",
          "id",
          "label",
          "metadata",
          "summary",
          "values"
        ],
        "type": "object"
      },
      "api-v1-external-reports-balance-sheet-overview-read": {
        "properties": {
          "created_ts": {
            "description": "The timestamp in UTC when the report was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "currency": {
            "description": "The currency of the report",
            "type": "string"
          },
          "date": {
            "description": "The date of the report",
            "format": "date",
            "type": "string"
          },
          "filters": {
            "additionalProperties": {
              "items": {
                "type": "string"
              },
              "type": "array"
            },
            "description": "The filters of the report",
            "type": "object"
          },
          "group_by": {
            "description": "The grouping of the report",
            "type": "string"
          },
          "id": {
            "default": "balance_sheet",
            "description": "The id of the report",
            "readOnly": true,
            "type": "string"
          },
          "label": {
            "default": "Balance Sheet Report",
            "description": "The title of the report",
            "readOnly": true,
            "type": "string"
          },
          "period_count": {
            "description": "The number of periods to compare in the report",
            "type": "integer"
          }
        },
        "required": [
          "created_ts",
          "currency",
          "date",
          "filters",
          "group_by",
          "id",
          "label",
          "period_count"
        ],
        "type": "object"
      },
      "api-v1-external-reports-balance-sheet-read": {
        "properties": {
          "columns": {
            "description": "The columns of the report",
            "items": {
              "$ref": "#/components/schemas/api-v1-external-reports-balance-sheet-row-column-read"
            },
            "type": "array"
          },
          "overview": {
            "allOf": [
              {
                "$ref": "#/components/schemas/api-v1-external-reports-balance-sheet-overview-read"
              }
            ],
            "description": "The overview of the report"
          },
          "rows": {
            "description": "The rows of the report",
            "items": {
              "$ref": "#/components/schemas/api-v1-external-reports-balance-sheet-section-read"
            },
            "type": "array"
          }
        },
        "required": [
          "columns",
          "overview",
          "rows"
        ],
        "type": "object"
      },
      "api-v1-external-reports-balance-sheet-row-column-read": {
        "properties": {
          "id": {
            "description": "The id of the column",
            "type": "string"
          },
          "label": {
            "description": "The label of the column",
            "type": "string"
          },
          "metadata": {
            "additionalProperties": {
              "type": "string"
            },
            "description": "The metadata of the column",
            "type": "object"
          }
        },
        "required": [
          "id",
          "label",
          "metadata"
        ],
        "type": "object"
      },
      "api-v1-external-reports-balance-sheet-row-summary-read": {
        "properties": {
          "id": {
            "description": "The id of the summary",
            "type": "string"
          },
          "label": {
            "description": "The label of the summary",
            "type": "string"
          },
          "metadata": {
            "additionalProperties": {},
            "description": "The metadata of the summary",
            "type": "object"
          },
          "sub_totals": {
            "description": "The sub totals of the row",
            "items": {
              "exclusiveMaximum": 10000000000000000,
              "exclusiveMinimum": -10000000000000000,
              "format": "double",
              "type": "number"
            },
            "type": "array"
          }
        },
        "required": [
          "id",
          "label",
          "metadata",
          "sub_totals"
        ],
        "type": "object"
      },
      "api-v1-external-reports-balance-sheet-section-read": {
        "properties": {
          "children": {
            "description": "The children of the section",
            "items": {
              "$ref": "#/components/schemas/api-v1-external-reports-balance-sheet-subsection-read"
            },
            "type": "array"
          },
          "group": {
            "description": "The group of the section",
            "type": "string"
          },
          "id": {
            "description": "The id of the section",
            "type": "string"
          },
          "label": {
            "description": "The label of the section",
            "type": "string"
          },
          "metadata": {
            "additionalProperties": {},
            "description": "The metadata of the section",
            "type": "object"
          },
          "summary": {
            "allOf": [
              {
                "$ref": "#/components/schemas/api-v1-external-reports-balance-sheet-row-summary-read"
              }
            ],
            "description": "The summary of the section"
          }
        },
        "required": [
          "children",
          "group",
          "id",
          "label",
          "metadata",
          "summary"
        ],
        "type": "object"
      },
      "api-v1-external-reports-balance-sheet-subsection-read": {
        "properties": {
          "children": {
            "description": "The children of the sub-section",
            "items": {
              "$ref": "#/components/schemas/api-v1-external-reports-balance-sheet-data-read"
            },
            "type": "array"
          },
          "group": {
            "description": "The group of the sub-section",
            "type": "string"
          },
          "id": {
            "description": "The id of the sub-section",
            "type": "string"
          },
          "label": {
            "description": "The label of the sub-section",
            "type": "string"
          },
          "metadata": {
            "additionalProperties": {},
            "description": "The metadata of the sub-section",
            "type": "object"
          },
          "summary": {
            "allOf": [
              {
                "$ref": "#/components/schemas/api-v1-external-reports-balance-sheet-row-summary-read"
              }
            ],
            "description": "The summary of the sub-section"
          }
        },
        "required": [
          "children",
          "group",
          "id",
          "label",
          "metadata",
          "summary"
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
    "/reports/balance-sheet/": {
      "get": {
        "description": "Generate balance sheet report in `currency` at `date` with `period_count` periods to compare and group it by `group_by` parameter.\n",
        "operationId": "reports_balance_sheet_list",
        "parameters": [
          {
            "description": "The unique identifier of the branch. Multiple values may be provided. The special value '__null__' may be provided to filter for null values.",
            "explode": false,
            "in": "query",
            "name": "branch__in",
            "schema": {
              "items": {
                "type": "string"
              },
              "type": "array"
            },
            "style": "form"
          },
          {
            "description": "The unique identifier of the contact. Multiple values may be provided. The special value '__null__' may be provided to filter for null values.",
            "explode": false,
            "in": "query",
            "name": "contact__in",
            "schema": {
              "items": {
                "type": "string"
              },
              "type": "array"
            },
            "style": "form"
          },
          {
            "description": "The currency of the report. Default: base currency of the organization.\n\n* `AED` - AED ⃱\n* `SAR` - SAR ⃁\n* `USD` - USD $\n* `EUR` - EUR €\n* `CAD` - CAD $\n* `AFN` - AFN ؋\n* `ALL` - ALL Lek\n* `AMD` - AMD դր.\n* `ARS` - ARS $\n* `AUD` - AUD $\n* `AZN` - AZN ман.\n* `BAM` - BAM KM\n* `BDT` - BDT ৳\n* `BGN` - BGN лв.\n* `BHD` - BHD د.ب.‏\n* `BIF` - BIF FBu\n* `BND` - BND $\n* `BOB` - BOB Bs\n* `BRL` - BRL R$\n* `BWP` - BWP P\n* `BYN` - BYN BYN\n* `BZD` - BZD $\n* `CDF` - CDF FrCD\n* `CHF` - CHF CHF\n* `CLP` - CLP $\n* `CNY` - CNY CN¥\n* `COP` - COP $\n* `CRC` - CRC ₡\n* `CVE` - CVE CV$\n* `CZK` - CZK Kč\n* `DJF` - DJF Fdj\n* `DKK` - DKK kr\n* `DOP` - DOP RD$\n* `DZD` - DZD د.ج.‏\n* `EGP` - EGP ج.م.‏\n* `ERN` - ERN Nfk\n* `ETB` - ETB Br\n* `GBP` - GBP £\n* `GEL` - GEL GEL\n* `GHS` - GHS GH₵\n* `GNF` - GNF FG\n* `GTQ` - GTQ Q\n* `HKD` - HKD $\n* `HNL` - HNL L\n* `HRK` - HRK kn\n* `HUF` - HUF Ft\n* `IDR` - IDR Rp\n* `ILS` - ILS ₪\n* `INR` - INR ₹\n* `IQD` - IQD د.ع.‏\n* `IRR` - IRR ﷼\n* `ISK` - ISK kr\n* `JMD` - JMD $\n* `JOD` - JOD د.أ.‏\n* `JPY` - JPY ￥\n* `KES` - KES Ksh\n* `KHR` - KHR ៛\n* `KMF` - KMF FC\n* `KRW` - KRW ₩\n* `KWD` - KWD د.ك.‏\n* `KZT` - KZT тңг.\n* `LBP` - LBP ل.ل.‏\n* `LKR` - LKR SL Re\n* `LYD` - LYD د.ل.‏\n* `MAD` - MAD د.م.‏\n* `MDL` - MDL MDL\n* `MGA` - MGA MGA\n* `MKD` - MKD MKD\n* `MMK` - MMK K\n* `MOP` - MOP MOP$\n* `MUR` - MUR MURs\n* `MXN` - MXN $\n* `MYR` - MYR RM\n* `MZN` - MZN MTn\n* `NAD` - NAD N$\n* `NGN` - NGN ₦\n* `NIO` - NIO C$\n* `NOK` - NOK kr\n* `NPR` - NPR नेरू\n* `NZD` - NZD $\n* `OMR` - OMR ر.ع.‏\n* `PAB` - PAB B/.\n* `PEN` - PEN S/.\n* `PHP` - PHP ₱\n* `PKR` - PKR ₨\n* `PLN` - PLN zł\n* `PYG` - PYG ₲\n* `QAR` - QAR ر.ق.‏\n* `RON` - RON RON\n* `RSD` - RSD дин.\n* `RUB` - RUB руб.\n* `RWF` - RWF FR\n* `SDG` - SDG SDG\n* `SEK` - SEK kr\n* `SGD` - SGD $\n* `SOS` - SOS Ssh\n* `SYP` - SYP ل.س.‏\n* `THB` - THB ฿\n* `TND` - TND د.ت.‏\n* `TOP` - TOP T$\n* `TRY` - TRY TL\n* `TTD` - TTD $\n* `TWD` - TWD NT$\n* `TZS` - TZS TSh\n* `UAH` - UAH ₴\n* `UGX` - UGX USh\n* `UYU` - UYU $\n* `UZS` - UZS UZS\n* `VES` - VES Bs.S.\n* `VND` - VND ₫\n* `XAF` - XAF FCFA\n* `XOF` - XOF CFA\n* `YER` - YER ر.ي.‏\n* `ZAR` - ZAR R\n* `ZMW` - ZMW ZK",
            "in": "query",
            "name": "currency",
            "schema": {
              "enum": [
                "AED",
                "SAR",
                "USD",
                "EUR",
                "CAD",
                "AFN",
                "ALL",
                "AMD",
                "ARS",
                "AUD",
                "AZN",
                "BAM",
                "BDT",
                "BGN",
                "BHD",
                "BIF",
                "BND",
                "BOB",
                "BRL",
                "BWP",
                "BYN",
                "BZD",
                "CDF",
                "CHF",
                "CLP",
                "CNY",
                "COP",
                "CRC",
                "CVE",
                "CZK",
                "DJF",
                "DKK",
                "DOP",
                "DZD",
                "EGP",
                "ERN",
                "ETB",
                "GBP",
                "GEL",
                "GHS",
                "GNF",
                "GTQ",
                "HKD",
                "HNL",
                "HRK",
                "HUF",
                "IDR",
                "ILS",
                "INR",
                "IQD",
                "IRR",
                "ISK",
                "JMD",
                "JOD",
                "JPY",
                "KES",
                "KHR",
                "KMF",
                "KRW",
                "KWD",
                "KZT",
                "LBP",
                "LKR",
                "LYD",
                "MAD",
                "MDL",
                "MGA",
                "MKD",
                "MMK",
                "MOP",
                "MUR",
                "MXN",
                "MYR",
                "MZN",
                "NAD",
                "NGN",
                "NIO",
                "NOK",
                "NPR",
                "NZD",
                "OMR",
                "PAB",
                "PEN",
                "PHP",
                "PKR",
                "PLN",
                "PYG",
                "QAR",
                "RON",
                "RSD",
                "RUB",
                "RWF",
                "SDG",
                "SEK",
                "SGD",
                "SOS",
                "SYP",
                "THB",
                "TND",
                "TOP",
                "TRY",
                "TTD",
                "TWD",
                "TZS",
                "UAH",
                "UGX",
                "UYU",
                "UZS",
                "VES",
                "VND",
                "XAF",
                "XOF",
                "YER",
                "ZAR",
                "ZMW"
              ],
              "minLength": 1,
              "type": "string"
            }
          },
          {
            "description": "The 'as of' date of the report.",
            "in": "query",
            "name": "date",
            "required": true,
            "schema": {
              "format": "date",
              "type": "string"
            }
          },
          {
            "description": "Group the report by this value.\n\n* `month` - month\n* `year` - year",
            "in": "query",
            "name": "group_by",
            "schema": {
              "default": "month",
              "enum": [
                "month",
                "year"
              ],
              "minLength": 1,
              "type": "string"
            }
          },
          {
            "description": "The number of periods to include in the report.",
            "in": "query",
            "name": "period_count",
            "required": true,
            "schema": {
              "maximum": 11,
              "minimum": 0,
              "type": "integer"
            }
          },
          {
            "description": "The unique identifier of the project. Multiple values may be provided. The special value '__null__' may be provided to filter for null values.",
            "explode": false,
            "in": "query",
            "name": "project__in",
            "schema": {
              "items": {
                "type": "string"
              },
              "type": "array"
            },
            "style": "form"
          }
        ],
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "examples": {
                  "Arabic": {
                    "description": "Response represented in Arabic language",
                    "summary": "Arabic language",
                    "value": [
                      {
                        "columns": [
                          {
                            "id": "2022-03-31",
                            "label": "31 مارس, 2022",
                            "metadata": {
                              "date": "2022-03-31"
                            }
                          },
                          {
                            "id": "2022-04-30",
                            "label": "30 إبريل, 2022",
                            "metadata": {
                              "date": "2022-04-30"
                            }
                          },
                          {
                            "id": "2022-05-31",
                            "label": "31 مايو, 2022",
                            "metadata": {
                              "date": "2022-05-31"
                            }
                          },
                          {
                            "id": "2022-06-30",
                            "label": "30 يونيو, 2022",
                            "metadata": {
                              "date": "2022-06-30"
                            }
                          },
                          {
                            "id": "2022-07-31",
                            "label": "31 يوليو, 2022",
                            "metadata": {
                              "date": "2022-07-31"
                            }
                          },
                          {
                            "id": "2022-08-31",
                            "label": "31 أغسطس, 2022",
                            "metadata": {
                              "date": "2022-08-31"
                            }
                          },
                          {
                            "id": "2022-09-30",
                            "label": "30 سبتمبر, 2022",
                            "metadata": {
                              "date": "2022-09-30"
                            }
                          }
                        ],
                        "overview": {
                          "created_ts": "2024-01-05T00:00:00Z",
                          "currency": "SAR",
                          "date": "2022-09-30",
                          "filters": {},
                          "group_by": "month",
                          "id": "balance_sheet",
                          "label": "قائمة المركز المالي",
                          "period_count": 6
                        },
                        "rows": [
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [],
                                        "id": "acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                        "label": "1111 الخزينة",
                                        "metadata": {
                                          "accounts": [
                                            "acc_QsYBgp4ZmYXBf6ixVcj5QR"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                          "label": "إجمالي 1111 الخزينة",
                                          "metadata": {
                                            "accounts": [
                                              "acc_QsYBgp4ZmYXBf6ixVcj5QR"
                                            ]
                                          },
                                          "sub_totals": [
                                            7293.95,
                                            7258.1,
                                            7258.1,
                                            7258.1,
                                            7258.1,
                                            14736.6,
                                            19088.71
                                          ]
                                        },
                                        "values": [
                                          7293.95,
                                          7258.1,
                                          7258.1,
                                          7258.1,
                                          7258.1,
                                          14736.6,
                                          19088.71
                                        ]
                                      },
                                      {
                                        "children": [],
                                        "id": "acc_frL4nJEEqJGpFp9LYmMjRn",
                                        "label": "1112 المصروفات النثرية",
                                        "metadata": {
                                          "accounts": [
                                            "acc_frL4nJEEqJGpFp9LYmMjRn"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_frL4nJEEqJGpFp9LYmMjRn",
                                          "label": "إجمالي 1112 المصروفات النثرية",
                                          "metadata": {
                                            "accounts": [
                                              "acc_frL4nJEEqJGpFp9LYmMjRn"
                                            ]
                                          },
                                          "sub_totals": [
                                            -32401.99,
                                            -32498.16,
                                            -48331.75,
                                            -49183.76,
                                            -47406.25,
                                            -50405.22,
                                            -50636.67
                                          ]
                                        },
                                        "values": [
                                          -32401.99,
                                          -32498.16,
                                          -48331.75,
                                          -49183.76,
                                          -47406.25,
                                          -50405.22,
                                          -50636.67
                                        ]
                                      }
                                    ],
                                    "id": "acc_6pZ24ougntxTkvWwfuLjku",
                                    "label": "111 النقد وما يعادله",
                                    "metadata": {
                                      "accounts": [
                                        "acc_6pZ24ougntxTkvWwfuLjku"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_6pZ24ougntxTkvWwfuLjku",
                                      "label": "إجمالي 111 النقد وما يعادله",
                                      "metadata": {
                                        "accounts": [
                                          "acc_6pZ24ougntxTkvWwfuLjku",
                                          "acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                          "acc_frL4nJEEqJGpFp9LYmMjRn"
                                        ]
                                      },
                                      "sub_totals": [
                                        19538.6,
                                        27053.38,
                                        8372.41,
                                        7676.14,
                                        19020.68,
                                        23500.21,
                                        37694.3
                                      ]
                                    },
                                    "values": [
                                      44646.64,
                                      52293.44,
                                      49446.06,
                                      49601.8,
                                      59168.83,
                                      59168.83,
                                      69242.26
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_FSngQmDUnZdczQeimCdiSd",
                                    "label": "112 العملاء",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FSngQmDUnZdczQeimCdiSd"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_FSngQmDUnZdczQeimCdiSd",
                                      "label": "إجمالي 112 العملاء",
                                      "metadata": {
                                        "accounts": [
                                          "acc_FSngQmDUnZdczQeimCdiSd"
                                        ]
                                      },
                                      "sub_totals": [
                                        -4546996.83,
                                        -6159610.2,
                                        -8100666.82,
                                        -7615463.04,
                                        -4288333.23,
                                        -4476943.3,
                                        -5274769.06
                                      ]
                                    },
                                    "values": [
                                      -4546996.83,
                                      -6159610.2,
                                      -8100666.82,
                                      -7615463.04,
                                      -4288333.23,
                                      -4476943.3,
                                      -5274769.06
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_Sc7jtAiH559PEh5faNJQ8v",
                                    "label": "113 سلف الموظفين",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Sc7jtAiH559PEh5faNJQ8v"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Sc7jtAiH559PEh5faNJQ8v",
                                      "label": "إجمالي 113 سلف الموظفين",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Sc7jtAiH559PEh5faNJQ8v"
                                        ]
                                      },
                                      "sub_totals": [
                                        -37972.76,
                                        -37972.76,
                                        -37972.76,
                                        -39082.02,
                                        -31327.69,
                                        -31327.69,
                                        -31327.69
                                      ]
                                    },
                                    "values": [
                                      -37972.76,
                                      -37972.76,
                                      -37972.76,
                                      -39082.02,
                                      -31327.69,
                                      -31327.69,
                                      -31327.69
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_nQqzwTwgf2ms9wfAAConYq",
                                    "label": "114 مصروفات مدفوعة مقدما",
                                    "metadata": {
                                      "accounts": [
                                        "acc_nQqzwTwgf2ms9wfAAConYq"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_nQqzwTwgf2ms9wfAAConYq",
                                      "label": "إجمالي 114 مصروفات مدفوعة مقدما",
                                      "metadata": {
                                        "accounts": [
                                          "acc_nQqzwTwgf2ms9wfAAConYq"
                                        ]
                                      },
                                      "sub_totals": [
                                        20757.39,
                                        20757.15,
                                        19315.07,
                                        37548.52,
                                        47267.9,
                                        47411.51,
                                        47411.51
                                      ]
                                    },
                                    "values": [
                                      20757.39,
                                      20757.15,
                                      19315.07,
                                      37548.52,
                                      47267.9,
                                      47411.51,
                                      47411.51
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_VMqYrgg8AqbLjmEnLQuf4y",
                                    "label": "115 إدارة المخزون",
                                    "metadata": {
                                      "accounts": [
                                        "acc_VMqYrgg8AqbLjmEnLQuf4y"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_VMqYrgg8AqbLjmEnLQuf4y",
                                      "label": "إجمالي 115 إدارة المخزون",
                                      "metadata": {
                                        "accounts": [
                                          "acc_VMqYrgg8AqbLjmEnLQuf4y"
                                        ]
                                      },
                                      "sub_totals": [
                                        7775.5,
                                        7826.79,
                                        34533.95,
                                        34533.95,
                                        34533.95,
                                        10792.7,
                                        10149.5
                                      ]
                                    },
                                    "values": [
                                      7775.5,
                                      7826.79,
                                      34533.95,
                                      34533.95,
                                      34533.95,
                                      10792.7,
                                      10149.5
                                    ]
                                  }
                                ],
                                "group": "CURRENT_ASSET",
                                "id": "CURRENT_ASSET",
                                "label": "الأصول المتداولة",
                                "metadata": {
                                  "sub_classification": [
                                    "CURRENT_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_current_asset",
                                  "label": "إجمالي الأصول المتداولة",
                                  "metadata": {},
                                  "sub_totals": [
                                    -4536898.1,
                                    -6141945.64,
                                    -8076418.15,
                                    -7574786.45,
                                    -4218838.39,
                                    -4426566.57,
                                    -5210841.44
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [],
                                        "id": "acc_J8UNTwrVoTU43WLwfbdjPs",
                                        "label": "1211 أثاث و معدات",
                                        "metadata": {
                                          "accounts": [
                                            "acc_J8UNTwrVoTU43WLwfbdjPs"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_J8UNTwrVoTU43WLwfbdjPs",
                                          "label": "إجمالي 1211 أثاث و معدات",
                                          "metadata": {
                                            "accounts": [
                                              "acc_J8UNTwrVoTU43WLwfbdjPs"
                                            ]
                                          },
                                          "sub_totals": [
                                            24349.24,
                                            24349.24,
                                            24349.24,
                                            20604.04,
                                            19947.33,
                                            19947.33,
                                            8481.74
                                          ]
                                        },
                                        "values": [
                                          24349.24,
                                          24349.24,
                                          24349.24,
                                          20604.04,
                                          19947.33,
                                          19947.33,
                                          8481.74
                                        ]
                                      },
                                      {
                                        "children": [],
                                        "id": "acc_8YNsdkYehwd3VYYidHPH7U",
                                        "label": "1212 مجمع الإهلاك التراكمي",
                                        "metadata": {
                                          "accounts": [
                                            "acc_8YNsdkYehwd3VYYidHPH7U"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_8YNsdkYehwd3VYYidHPH7U",
                                          "label": "إجمالي 1212 مجمع الإهلاك التراكمي",
                                          "metadata": {
                                            "accounts": [
                                              "acc_8YNsdkYehwd3VYYidHPH7U"
                                            ]
                                          },
                                          "sub_totals": [
                                            -1996.9,
                                            -1996.9,
                                            -1996.9,
                                            -1996.9,
                                            -9921.86,
                                            -9921.86,
                                            -9921.86
                                          ]
                                        },
                                        "values": [
                                          -1996.9,
                                          -1996.9,
                                          -1996.9,
                                          -1996.9,
                                          -9921.86,
                                          -9921.86,
                                          -9921.86
                                        ]
                                      }
                                    ],
                                    "id": "acc_U48EC5Q6TyhxgyH6G33D58",
                                    "label": "121 الأصول الثابتة",
                                    "metadata": {
                                      "accounts": [
                                        "acc_U48EC5Q6TyhxgyH6G33D58"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_U48EC5Q6TyhxgyH6G33D58",
                                      "label": "إجمالي 121 الأصول الثابتة",
                                      "metadata": {
                                        "accounts": [
                                          "acc_U48EC5Q6TyhxgyH6G33D58",
                                          "acc_J8UNTwrVoTU43WLwfbdjPs",
                                          "acc_8YNsdkYehwd3VYYidHPH7U"
                                        ]
                                      },
                                      "sub_totals": [
                                        22519.9,
                                        12385.69,
                                        12385.69,
                                        8644.9,
                                        2944.78,
                                        4548.5,
                                        -6126.62
                                      ]
                                    },
                                    "values": [
                                      167.56,
                                      -9966.65,
                                      -9966.65,
                                      -9962.24,
                                      -7080.69,
                                      -5476.97,
                                      -4686.5
                                    ]
                                  }
                                ],
                                "group": "NON_CURRENT_ASSET",
                                "id": "NON_CURRENT_ASSET",
                                "label": "الأصول غير المتداولة",
                                "metadata": {
                                  "sub_classification": [
                                    "NON_CURRENT_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_non_current_asset",
                                  "label": "إجمالي الأصول غير المتداولة",
                                  "metadata": {},
                                  "sub_totals": [
                                    22519.9,
                                    12385.69,
                                    12385.69,
                                    8644.9,
                                    2944.78,
                                    4548.5,
                                    -6126.62
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "FIXED_ASSET",
                                "id": "FIXED_ASSET",
                                "label": "الأصول الثابتة",
                                "metadata": {
                                  "sub_classification": [
                                    "FIXED_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_fixed_asset",
                                  "label": "إجمالي الأصول الثابتة",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              }
                            ],
                            "group": "ASSET",
                            "id": "ASSET",
                            "label": "الأصل",
                            "metadata": {
                              "classification": [
                                "ASSET"
                              ]
                            },
                            "summary": {
                              "id": "summary_asset",
                              "label": "إجمالي الأصل",
                              "metadata": {},
                              "sub_totals": [
                                -4514378.2,
                                -6129559.95,
                                -8064032.46,
                                -7566141.55,
                                -4215893.61,
                                -4422018.07,
                                -5216968.06
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_mKPWnKLxQtFW6Y4PqPUGRj",
                                    "label": "211 الموردين",
                                    "metadata": {
                                      "accounts": [
                                        "acc_mKPWnKLxQtFW6Y4PqPUGRj"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_mKPWnKLxQtFW6Y4PqPUGRj",
                                      "label": "إجمالي 211 الموردين",
                                      "metadata": {
                                        "accounts": [
                                          "acc_mKPWnKLxQtFW6Y4PqPUGRj"
                                        ]
                                      },
                                      "sub_totals": [
                                        3981655.04,
                                        3404697.27,
                                        2281458.95,
                                        5907383.78,
                                        4860733.43,
                                        13506210.39,
                                        13791521.98
                                      ]
                                    },
                                    "values": [
                                      3981655.04,
                                      3404697.27,
                                      2281458.95,
                                      5907383.78,
                                      4860733.43,
                                      13506210.39,
                                      13791521.98
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_Q3fdJQMRW6rMKysBXWEahM",
                                    "label": "2110 ضريبة القيمة المضافة على الحسابات الدائنة",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Q3fdJQMRW6rMKysBXWEahM"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Q3fdJQMRW6rMKysBXWEahM",
                                      "label": "إجمالي 2110 ضريبة القيمة المضافة على الحسابات الدائنة",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Q3fdJQMRW6rMKysBXWEahM"
                                        ]
                                      },
                                      "sub_totals": [
                                        -35884.44,
                                        -35884.44,
                                        -35884.44,
                                        -35865.69,
                                        -35865.69,
                                        -35865.69,
                                        -36238.7
                                      ]
                                    },
                                    "values": [
                                      -35884.44,
                                      -35884.44,
                                      -35884.44,
                                      -35865.69,
                                      -35865.69,
                                      -35865.69,
                                      -36238.7
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_NCWL4ykpHArD3TxyrwNXME",
                                    "label": "2111 زكاة مستحقة الدفع",
                                    "metadata": {
                                      "accounts": [
                                        "acc_NCWL4ykpHArD3TxyrwNXME"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_NCWL4ykpHArD3TxyrwNXME",
                                      "label": "إجمالي 2111 زكاة مستحقة الدفع",
                                      "metadata": {
                                        "accounts": [
                                          "acc_NCWL4ykpHArD3TxyrwNXME"
                                        ]
                                      },
                                      "sub_totals": [
                                        12395.2,
                                        17320.08,
                                        19289.79,
                                        19289.79,
                                        48353.61,
                                        48353.61,
                                        48353.61
                                      ]
                                    },
                                    "values": [
                                      12395.2,
                                      17320.08,
                                      19289.79,
                                      19289.79,
                                      48353.61,
                                      48353.61,
                                      48353.61
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_PLpCz5Su6dEx2yyWFtgbCJ",
                                    "label": "212 إيراد غير مكتسب",
                                    "metadata": {
                                      "accounts": [
                                        "acc_PLpCz5Su6dEx2yyWFtgbCJ"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_PLpCz5Su6dEx2yyWFtgbCJ",
                                      "label": "إجمالي 212 إيراد غير مكتسب",
                                      "metadata": {
                                        "accounts": [
                                          "acc_PLpCz5Su6dEx2yyWFtgbCJ"
                                        ]
                                      },
                                      "sub_totals": [
                                        3479.69,
                                        3479.69,
                                        3479.69,
                                        3479.69,
                                        1558.26,
                                        1542.89,
                                        -114.69
                                      ]
                                    },
                                    "values": [
                                      3479.69,
                                      3479.69,
                                      3479.69,
                                      3479.69,
                                      1558.26,
                                      1542.89,
                                      -114.69
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_QWcAzxLX75xhsteWfJJx2W",
                                    "label": "213 تعديلات الرصيد الافتتاحي",
                                    "metadata": {
                                      "accounts": [
                                        "acc_QWcAzxLX75xhsteWfJJx2W"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_QWcAzxLX75xhsteWfJJx2W",
                                      "label": "إجمالي 213 تعديلات الرصيد الافتتاحي",
                                      "metadata": {
                                        "accounts": [
                                          "acc_QWcAzxLX75xhsteWfJJx2W"
                                        ]
                                      },
                                      "sub_totals": [
                                        9210.89,
                                        9210.89,
                                        9210.89,
                                        9075.49,
                                        9075.49,
                                        9075.49,
                                        9075.49
                                      ]
                                    },
                                    "values": [
                                      9210.89,
                                      9210.89,
                                      9210.89,
                                      9075.49,
                                      9075.49,
                                      9075.49,
                                      9075.49
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_RZ5i6UrgdqjM3vCb6C7Afq",
                                    "label": "214 رواتب مستحقة غير مدفوعة",
                                    "metadata": {
                                      "accounts": [
                                        "acc_RZ5i6UrgdqjM3vCb6C7Afq"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_RZ5i6UrgdqjM3vCb6C7Afq",
                                      "label": "إجمالي 214 رواتب مستحقة غير مدفوعة",
                                      "metadata": {
                                        "accounts": [
                                          "acc_RZ5i6UrgdqjM3vCb6C7Afq"
                                        ]
                                      },
                                      "sub_totals": [
                                        2635.55,
                                        26157.34,
                                        20182.48,
                                        -1049.21,
                                        -33504.49,
                                        -60812.67,
                                        -70648.17
                                      ]
                                    },
                                    "values": [
                                      2635.55,
                                      26157.34,
                                      20182.48,
                                      -1049.21,
                                      -33504.49,
                                      -60812.67,
                                      -70648.17
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_FXVTPCCw7XxaLYZu4bAiFX",
                                    "label": "215 قرض من المالك",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FXVTPCCw7XxaLYZu4bAiFX"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_FXVTPCCw7XxaLYZu4bAiFX",
                                      "label": "إجمالي 215 قرض من المالك",
                                      "metadata": {
                                        "accounts": [
                                          "acc_FXVTPCCw7XxaLYZu4bAiFX"
                                        ]
                                      },
                                      "sub_totals": [
                                        -2446.29,
                                        -4099.93,
                                        -4097.87,
                                        -2902.05,
                                        7780.45,
                                        7780.45,
                                        7641.09
                                      ]
                                    },
                                    "values": [
                                      -2446.29,
                                      -4099.93,
                                      -4097.87,
                                      -2902.05,
                                      7780.45,
                                      7780.45,
                                      7641.09
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_KqJ4Y5RkJJTZD4Yny5wPqM",
                                    "label": "216 تعويضات الموظفين",
                                    "metadata": {
                                      "accounts": [
                                        "acc_KqJ4Y5RkJJTZD4Yny5wPqM"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_KqJ4Y5RkJJTZD4Yny5wPqM",
                                      "label": "إجمالي 216 تعويضات الموظفين",
                                      "metadata": {
                                        "accounts": [
                                          "acc_KqJ4Y5RkJJTZD4Yny5wPqM"
                                        ]
                                      },
                                      "sub_totals": [
                                        185381.24,
                                        191904.8,
                                        189922.77,
                                        195788.62,
                                        172521.2,
                                        159378.35,
                                        182204.68
                                      ]
                                    },
                                    "values": [
                                      185381.24,
                                      191904.8,
                                      189922.77,
                                      195788.62,
                                      172521.2,
                                      159378.35,
                                      182204.68
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_iK82tinMxEHurtaLtxMbxC",
                                    "label": "218 القيمة المضافة",
                                    "metadata": {
                                      "accounts": [
                                        "acc_iK82tinMxEHurtaLtxMbxC"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_iK82tinMxEHurtaLtxMbxC",
                                      "label": "إجمالي 218 القيمة المضافة",
                                      "metadata": {
                                        "accounts": [
                                          "acc_iK82tinMxEHurtaLtxMbxC"
                                        ]
                                      },
                                      "sub_totals": [
                                        -12600.11,
                                        -17434.92,
                                        -22175.54,
                                        -22414.49,
                                        -25164.11,
                                        -31872.37,
                                        -35852.99
                                      ]
                                    },
                                    "values": [
                                      -12600.11,
                                      -17434.92,
                                      -22175.54,
                                      -22414.49,
                                      -25164.11,
                                      -31872.37,
                                      -35852.99
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_eytk8Kh5mcqehRPGyBCu2h",
                                    "label": "219 ضريبة السلع الانتقائية المستحقة",
                                    "metadata": {
                                      "accounts": [
                                        "acc_eytk8Kh5mcqehRPGyBCu2h"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_eytk8Kh5mcqehRPGyBCu2h",
                                      "label": "إجمالي 219 ضريبة السلع الانتقائية المستحقة",
                                      "metadata": {
                                        "accounts": [
                                          "acc_eytk8Kh5mcqehRPGyBCu2h"
                                        ]
                                      },
                                      "sub_totals": [
                                        4954.6,
                                        4954.6,
                                        4946.37,
                                        10378.54,
                                        11032.44,
                                        11058.69,
                                        12967.53
                                      ]
                                    },
                                    "values": [
                                      4954.6,
                                      4954.6,
                                      4946.37,
                                      10378.54,
                                      11032.44,
                                      11058.69,
                                      12967.53
                                    ]
                                  }
                                ],
                                "group": "CURRENT_LIABILITY",
                                "id": "CURRENT_LIABILITY",
                                "label": "الإلتزامات المتداولة",
                                "metadata": {
                                  "sub_classification": [
                                    "CURRENT_LIABILITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_current_liability",
                                  "label": "إجمالي الإلتزامات المتداولة",
                                  "metadata": {},
                                  "sub_totals": [
                                    4148781.37,
                                    3600305.38,
                                    2466333.09,
                                    6083164.47,
                                    5016520.59,
                                    13614849.14,
                                    13908909.83
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "NON_CURRENT_LIABILITY",
                                "id": "NON_CURRENT_LIABILITY",
                                "label": "الإلتزامات غير المتداولة",
                                "metadata": {
                                  "sub_classification": [
                                    "NON_CURRENT_LIABILITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_non_current_liability",
                                  "label": "إجمالي الإلتزامات غير المتداولة",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              }
                            ],
                            "group": "LIABILITY",
                            "id": "LIABILITY",
                            "label": "الإلتزام",
                            "metadata": {
                              "classification": [
                                "LIABILITY"
                              ]
                            },
                            "summary": {
                              "id": "summary_liability",
                              "label": "إجمالي الإلتزام",
                              "metadata": {},
                              "sub_totals": [
                                4148781.37,
                                3600305.38,
                                2466333.09,
                                6083164.47,
                                5016520.59,
                                13614849.14,
                                13908909.83
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [],
                                "group": "PAID_IN_CAPITAL",
                                "id": "PAID_IN_CAPITAL",
                                "label": "رأس المال الإضافي المدفوع",
                                "metadata": {
                                  "sub_classification": [
                                    "PAID_IN_CAPITAL"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_paid_in_capital",
                                  "label": "إجمالي رأس المال الإضافي المدفوع",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_dfsjNx9aVhTiwoDNbd86gD",
                                    "label": "331 الأرباح المحتجزة",
                                    "metadata": {
                                      "accounts": [
                                        "acc_dfsjNx9aVhTiwoDNbd86gD"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_dfsjNx9aVhTiwoDNbd86gD",
                                      "label": "إجمالي 331 الأرباح المحتجزة",
                                      "metadata": {
                                        "accounts": [
                                          "acc_dfsjNx9aVhTiwoDNbd86gD"
                                        ]
                                      },
                                      "sub_totals": [
                                        -8577398.79,
                                        -9656118.11,
                                        -10472782.89,
                                        -13591888.68,
                                        -9215447.28,
                                        -18032569.67,
                                        -19135253.96
                                      ]
                                    },
                                    "values": [
                                      -8577398.79,
                                      -9656118.11,
                                      -10472782.89,
                                      -13591888.68,
                                      -9215447.28,
                                      -18032569.67,
                                      -19135253.96
                                    ]
                                  }
                                ],
                                "group": "RETAINED_EARNINGS",
                                "id": "RETAINED_EARNINGS",
                                "label": "الأرباح المحتجزة",
                                "metadata": {
                                  "sub_classification": [
                                    "RETAINED_EARNINGS"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_retained_earnings",
                                  "label": "إجمالي الأرباح المحتجزة",
                                  "metadata": {},
                                  "sub_totals": [
                                    -8577398.79,
                                    -9656118.11,
                                    -10472782.89,
                                    -13591888.68,
                                    -9215447.28,
                                    -18032569.67,
                                    -19135253.96
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_Em3zUsJywGuHE5rKEsuuKQ",
                                    "label": "341 أرباح وخسائر غير محققة متراكمة",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Em3zUsJywGuHE5rKEsuuKQ"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Em3zUsJywGuHE5rKEsuuKQ",
                                      "label": "إجمالي 341 أرباح وخسائر غير محققة متراكمة",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Em3zUsJywGuHE5rKEsuuKQ"
                                        ]
                                      },
                                      "sub_totals": [
                                        17419.69,
                                        17419.69,
                                        17419.69,
                                        17419.69,
                                        17419.69,
                                        17419.69,
                                        17419.69
                                      ]
                                    },
                                    "values": [
                                      17419.69,
                                      17419.69,
                                      17419.69,
                                      17419.69,
                                      17419.69,
                                      17419.69,
                                      17419.69
                                    ]
                                  }
                                ],
                                "group": "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME",
                                "id": "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME",
                                "label": "الدخل الشامل الآخر المتراكم",
                                "metadata": {
                                  "sub_classification": [
                                    "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_accumulated_other_comprehensive_income",
                                  "label": "إجمالي الدخل الشامل الآخر المتراكم",
                                  "metadata": {},
                                  "sub_totals": [
                                    17419.69,
                                    17419.69,
                                    17419.69,
                                    17419.69,
                                    17419.69,
                                    17419.69,
                                    17419.69
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "TREASURY_STOCK",
                                "id": "TREASURY_STOCK",
                                "label": "أسهم الخزينة",
                                "metadata": {
                                  "sub_classification": [
                                    "TREASURY_STOCK"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_treasury_stock",
                                  "label": "إجمالي أسهم الخزينة",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_fgsheVKKUH4rpnxmrmifx9",
                                    "label": "321 حقوق ملكية المالك",
                                    "metadata": {
                                      "accounts": [
                                        "acc_fgsheVKKUH4rpnxmrmifx9"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_fgsheVKKUH4rpnxmrmifx9",
                                      "label": "إجمالي 321 حقوق ملكية المالك",
                                      "metadata": {
                                        "accounts": [
                                          "acc_fgsheVKKUH4rpnxmrmifx9"
                                        ]
                                      },
                                      "sub_totals": [
                                        10767.52,
                                        10767.52,
                                        9107.03,
                                        8696.26,
                                        15545.42,
                                        25895.92,
                                        25546.38
                                      ]
                                    },
                                    "values": [
                                      10767.52,
                                      10767.52,
                                      9107.03,
                                      8696.26,
                                      15545.42,
                                      25895.92,
                                      25546.38
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_2Jxnxb8wRjXM9BXVuv22rV",
                                    "label": "322 المسحوبات",
                                    "metadata": {
                                      "accounts": [
                                        "acc_2Jxnxb8wRjXM9BXVuv22rV"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_2Jxnxb8wRjXM9BXVuv22rV",
                                      "label": "إجمالي 322 المسحوبات",
                                      "metadata": {
                                        "accounts": [
                                          "acc_2Jxnxb8wRjXM9BXVuv22rV"
                                        ]
                                      },
                                      "sub_totals": [
                                        -21931.04,
                                        -21770.18,
                                        -21770.18,
                                        -22190.23,
                                        -22190.23,
                                        -20781.13,
                                        -16194.39
                                      ]
                                    },
                                    "values": [
                                      -21931.04,
                                      -21770.18,
                                      -21770.18,
                                      -22190.23,
                                      -22190.23,
                                      -20781.13,
                                      -16194.39
                                    ]
                                  }
                                ],
                                "group": "OWNERS_EQUITY",
                                "id": "OWNERS_EQUITY",
                                "label": "حقوق ملكية المالك",
                                "metadata": {
                                  "sub_classification": [
                                    "OWNERS_EQUITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_owners_equity",
                                  "label": "إجمالي حقوق ملكية المالك",
                                  "metadata": {},
                                  "sub_totals": [
                                    -11163.52,
                                    -11002.66,
                                    -12663.15,
                                    -13493.97,
                                    -6644.81,
                                    5114.79,
                                    9351.99
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_izB9fj3oW7X8HYceWFy44Y",
                                    "label": "311 إزاحة الرصيد الافتتاحي",
                                    "metadata": {
                                      "accounts": [
                                        "acc_izB9fj3oW7X8HYceWFy44Y"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_izB9fj3oW7X8HYceWFy44Y",
                                      "label": "إجمالي 311 إزاحة الرصيد الافتتاحي",
                                      "metadata": {
                                        "accounts": [
                                          "acc_izB9fj3oW7X8HYceWFy44Y"
                                        ]
                                      },
                                      "sub_totals": [
                                        -445.61,
                                        128.25,
                                        128.25,
                                        128.25,
                                        -1194.33,
                                        -1366.96,
                                        7012.52
                                      ]
                                    },
                                    "values": [
                                      -445.61,
                                      128.25,
                                      128.25,
                                      128.25,
                                      -1194.33,
                                      -1366.96,
                                      7012.52
                                    ]
                                  }
                                ],
                                "group": "OPENING_BALANCE_EQUITY",
                                "id": "OPENING_BALANCE_EQUITY",
                                "label": "حقوق ملكية من رصيد إفتتاحي",
                                "metadata": {
                                  "sub_classification": [
                                    "OPENING_BALANCE_EQUITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_opening_balance_equity",
                                  "label": "إجمالي حقوق ملكية من رصيد إفتتاحي",
                                  "metadata": {},
                                  "sub_totals": [
                                    -445.61,
                                    128.25,
                                    128.25,
                                    128.25,
                                    -1194.33,
                                    -1366.96,
                                    7012.52
                                  ]
                                }
                              }
                            ],
                            "group": "EQUITY",
                            "id": "EQUITY",
                            "label": "حقوق الملكية",
                            "metadata": {
                              "classification": [
                                "EQUITY"
                              ]
                            },
                            "summary": {
                              "id": "summary_equity",
                              "label": "إجمالي حقوق الملكية",
                              "metadata": {},
                              "sub_totals": [
                                -8571588.23,
                                -9649572.83,
                                -10467898.1,
                                -13587834.71,
                                -9205866.73,
                                -18011402.15,
                                -19101469.76
                              ]
                            }
                          }
                        ]
                      }
                    ]
                  },
                  "Contact": {
                    "description": "Response filtered by multiple contacts",
                    "summary": "Filter by contacts",
                    "value": [
                      {
                        "columns": [
                          {
                            "id": "2022-03-31",
                            "label": "31 Mar, 2022",
                            "metadata": {
                              "date": "2022-03-31"
                            }
                          },
                          {
                            "id": "2022-04-30",
                            "label": "30 Apr, 2022",
                            "metadata": {
                              "date": "2022-04-30"
                            }
                          },
                          {
                            "id": "2022-05-31",
                            "label": "31 May, 2022",
                            "metadata": {
                              "date": "2022-05-31"
                            }
                          },
                          {
                            "id": "2022-06-30",
                            "label": "30 Jun, 2022",
                            "metadata": {
                              "date": "2022-06-30"
                            }
                          },
                          {
                            "id": "2022-07-31",
                            "label": "31 Jul, 2022",
                            "metadata": {
                              "date": "2022-07-31"
                            }
                          },
                          {
                            "id": "2022-08-31",
                            "label": "31 Aug, 2022",
                            "metadata": {
                              "date": "2022-08-31"
                            }
                          },
                          {
                            "id": "2022-09-30",
                            "label": "30 Sep, 2022",
                            "metadata": {
                              "date": "2022-09-30"
                            }
                          }
                        ],
                        "overview": {
                          "created_ts": "2024-01-05T00:00:00Z",
                          "currency": "SAR",
                          "date": "2022-09-30",
                          "filters": {
                            "contact__in": [
                              "co_BguCJYcbqCgn4jRPctaGLA",
                              "co_Lcnfy7KdZyMWR9X4S3hPSq"
                            ]
                          },
                          "group_by": "month",
                          "id": "balance_sheet",
                          "label": "Balance Sheet Report",
                          "period_count": 6
                        },
                        "rows": [
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [],
                                        "id": "acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                        "label": "1111 Undeposited Funds",
                                        "metadata": {
                                          "accounts": [
                                            "acc_QsYBgp4ZmYXBf6ixVcj5QR"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                          "label": "Total 1111 Undeposited Funds",
                                          "metadata": {
                                            "accounts": [
                                              "acc_QsYBgp4ZmYXBf6ixVcj5QR"
                                            ]
                                          },
                                          "sub_totals": [
                                            16829.86,
                                            16797.61,
                                            16797.61,
                                            16797.61,
                                            16797.61,
                                            16797.61,
                                            16802.35
                                          ]
                                        },
                                        "values": [
                                          16829.86,
                                          16797.61,
                                          16797.61,
                                          16797.61,
                                          16797.61,
                                          16797.61,
                                          16802.35
                                        ]
                                      },
                                      {
                                        "children": [],
                                        "id": "acc_frL4nJEEqJGpFp9LYmMjRn",
                                        "label": "1112 Petty Cash",
                                        "metadata": {
                                          "accounts": [
                                            "acc_frL4nJEEqJGpFp9LYmMjRn"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_frL4nJEEqJGpFp9LYmMjRn",
                                          "label": "Total 1112 Petty Cash",
                                          "metadata": {
                                            "accounts": [
                                              "acc_frL4nJEEqJGpFp9LYmMjRn"
                                            ]
                                          },
                                          "sub_totals": [
                                            8686.27,
                                            8686.27,
                                            2497.72,
                                            2497.72,
                                            4349.92,
                                            1350.95,
                                            1479.83
                                          ]
                                        },
                                        "values": [
                                          8686.27,
                                          8686.27,
                                          2497.72,
                                          2497.72,
                                          4349.92,
                                          1350.95,
                                          1479.83
                                        ]
                                      }
                                    ],
                                    "id": "acc_6pZ24ougntxTkvWwfuLjku",
                                    "label": "111 Cash and Cash Equivalents",
                                    "metadata": {
                                      "accounts": [
                                        "acc_6pZ24ougntxTkvWwfuLjku"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_6pZ24ougntxTkvWwfuLjku",
                                      "label": "Total 111 Cash and Cash Equivalents",
                                      "metadata": {
                                        "accounts": [
                                          "acc_6pZ24ougntxTkvWwfuLjku",
                                          "acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                          "acc_frL4nJEEqJGpFp9LYmMjRn"
                                        ]
                                      },
                                      "sub_totals": [
                                        27787.38,
                                        35543.02,
                                        29354.47,
                                        29318.96,
                                        31013.7,
                                        28014.73,
                                        37947.87
                                      ]
                                    },
                                    "values": [
                                      2271.25,
                                      10059.14,
                                      10059.14,
                                      10023.63,
                                      9866.17,
                                      9866.17,
                                      19665.69
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_FSngQmDUnZdczQeimCdiSd",
                                    "label": "112 Accounts Receivable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FSngQmDUnZdczQeimCdiSd"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_FSngQmDUnZdczQeimCdiSd",
                                      "label": "Total 112 Accounts Receivable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_FSngQmDUnZdczQeimCdiSd"
                                        ]
                                      },
                                      "sub_totals": [
                                        -16469799.1,
                                        -16607683.56,
                                        -17353127.79,
                                        -17349464.83,
                                        -17365517.11,
                                        -17693656.21,
                                        -18330221.8
                                      ]
                                    },
                                    "values": [
                                      -16469799.1,
                                      -16607683.56,
                                      -17353127.79,
                                      -17349464.83,
                                      -17365517.11,
                                      -17693656.21,
                                      -18330221.8
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_Sc7jtAiH559PEh5faNJQ8v",
                                    "label": "113 Employee Advance",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Sc7jtAiH559PEh5faNJQ8v"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Sc7jtAiH559PEh5faNJQ8v",
                                      "label": "Total 113 Employee Advance",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Sc7jtAiH559PEh5faNJQ8v"
                                        ]
                                      },
                                      "sub_totals": [
                                        -4437.65,
                                        -4437.65,
                                        -4437.65,
                                        -4434.03,
                                        -1931.2,
                                        -1931.2,
                                        -1931.2
                                      ]
                                    },
                                    "values": [
                                      -4437.65,
                                      -4437.65,
                                      -4437.65,
                                      -4434.03,
                                      -1931.2,
                                      -1931.2,
                                      -1931.2
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_nQqzwTwgf2ms9wfAAConYq",
                                    "label": "114 Prepaid Expenses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_nQqzwTwgf2ms9wfAAConYq"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_nQqzwTwgf2ms9wfAAConYq",
                                      "label": "Total 114 Prepaid Expenses",
                                      "metadata": {
                                        "accounts": [
                                          "acc_nQqzwTwgf2ms9wfAAConYq"
                                        ]
                                      },
                                      "sub_totals": [
                                        -2273.4,
                                        -2273.4,
                                        -7286.97,
                                        -7316.27,
                                        -7316.27,
                                        -7316.27,
                                        -7316.27
                                      ]
                                    },
                                    "values": [
                                      -2273.4,
                                      -2273.4,
                                      -7286.97,
                                      -7316.27,
                                      -7316.27,
                                      -7316.27,
                                      -7316.27
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_VMqYrgg8AqbLjmEnLQuf4y",
                                    "label": "115 Inventory",
                                    "metadata": {
                                      "accounts": [
                                        "acc_VMqYrgg8AqbLjmEnLQuf4y"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_VMqYrgg8AqbLjmEnLQuf4y",
                                      "label": "Total 115 Inventory",
                                      "metadata": {
                                        "accounts": [
                                          "acc_VMqYrgg8AqbLjmEnLQuf4y"
                                        ]
                                      },
                                      "sub_totals": [
                                        8737.33,
                                        8730.41,
                                        35437.57,
                                        35437.57,
                                        35437.57,
                                        35437.57,
                                        34792.37
                                      ]
                                    },
                                    "values": [
                                      8737.33,
                                      8730.41,
                                      35437.57,
                                      35437.57,
                                      35437.57,
                                      35437.57,
                                      34792.37
                                    ]
                                  }
                                ],
                                "group": "CURRENT_ASSET",
                                "id": "CURRENT_ASSET",
                                "label": "Current Assets",
                                "metadata": {
                                  "sub_classification": [
                                    "CURRENT_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_current_asset",
                                  "label": "Total Current Assets",
                                  "metadata": {},
                                  "sub_totals": [
                                    -16439985.44,
                                    -16570121.18,
                                    -17300060.37,
                                    -17296458.6,
                                    -17308313.31,
                                    -17639451.38,
                                    -18266729.03
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [],
                                        "id": "acc_J8UNTwrVoTU43WLwfbdjPs",
                                        "label": "1211 Furniture and Equipment",
                                        "metadata": {
                                          "accounts": [
                                            "acc_J8UNTwrVoTU43WLwfbdjPs"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_J8UNTwrVoTU43WLwfbdjPs",
                                          "label": "Total 1211 Furniture and Equipment",
                                          "metadata": {
                                            "accounts": [
                                              "acc_J8UNTwrVoTU43WLwfbdjPs"
                                            ]
                                          },
                                          "sub_totals": [
                                            9921.23,
                                            9921.23,
                                            9921.23,
                                            9921.23,
                                            9534.93,
                                            9534.93,
                                            12649.68
                                          ]
                                        },
                                        "values": [
                                          9921.23,
                                          9921.23,
                                          9921.23,
                                          9921.23,
                                          9534.93,
                                          9534.93,
                                          12649.68
                                        ]
                                      },
                                      {
                                        "children": [],
                                        "id": "acc_8YNsdkYehwd3VYYidHPH7U",
                                        "label": "1212 Accumulated depreciation",
                                        "metadata": {
                                          "accounts": [
                                            "acc_8YNsdkYehwd3VYYidHPH7U"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_8YNsdkYehwd3VYYidHPH7U",
                                          "label": "Total 1212 Accumulated depreciation",
                                          "metadata": {
                                            "accounts": [
                                              "acc_8YNsdkYehwd3VYYidHPH7U"
                                            ]
                                          },
                                          "sub_totals": [
                                            5801.86,
                                            5801.86,
                                            5801.86,
                                            5801.86,
                                            5801.86,
                                            5801.86,
                                            5801.86
                                          ]
                                        },
                                        "values": [
                                          5801.86,
                                          5801.86,
                                          5801.86,
                                          5801.86,
                                          5801.86,
                                          5801.86,
                                          5801.86
                                        ]
                                      }
                                    ],
                                    "id": "acc_U48EC5Q6TyhxgyH6G33D58",
                                    "label": "121 Fixed Asset",
                                    "metadata": {
                                      "accounts": [
                                        "acc_U48EC5Q6TyhxgyH6G33D58"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_U48EC5Q6TyhxgyH6G33D58",
                                      "label": "Total 121 Fixed Asset",
                                      "metadata": {
                                        "accounts": [
                                          "acc_U48EC5Q6TyhxgyH6G33D58",
                                          "acc_J8UNTwrVoTU43WLwfbdjPs",
                                          "acc_8YNsdkYehwd3VYYidHPH7U"
                                        ]
                                      },
                                      "sub_totals": [
                                        23380.75,
                                        23521.45,
                                        23521.45,
                                        23517.85,
                                        23131.55,
                                        24770.96,
                                        27885.71
                                      ]
                                    },
                                    "values": [
                                      7657.66,
                                      7798.36,
                                      7798.36,
                                      7794.76,
                                      7794.76,
                                      9434.17,
                                      9434.17
                                    ]
                                  }
                                ],
                                "group": "NON_CURRENT_ASSET",
                                "id": "NON_CURRENT_ASSET",
                                "label": "Non-Current Assets",
                                "metadata": {
                                  "sub_classification": [
                                    "NON_CURRENT_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_non_current_asset",
                                  "label": "Total Non-Current Assets",
                                  "metadata": {},
                                  "sub_totals": [
                                    23380.75,
                                    23521.45,
                                    23521.45,
                                    23517.85,
                                    23131.55,
                                    24770.96,
                                    27885.71
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "FIXED_ASSET",
                                "id": "FIXED_ASSET",
                                "label": "Fixed Asset",
                                "metadata": {
                                  "sub_classification": [
                                    "FIXED_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_fixed_asset",
                                  "label": "Total Fixed Asset",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              }
                            ],
                            "group": "ASSET",
                            "id": "ASSET",
                            "label": "Asset",
                            "metadata": {
                              "classification": [
                                "ASSET"
                              ]
                            },
                            "summary": {
                              "id": "summary_asset",
                              "label": "Total Asset",
                              "metadata": {},
                              "sub_totals": [
                                -16416604.69,
                                -16546599.73,
                                -17276538.92,
                                -17272940.75,
                                -17285181.76,
                                -17614680.42,
                                -18238843.32
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_mKPWnKLxQtFW6Y4PqPUGRj",
                                    "label": "211 Accounts Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_mKPWnKLxQtFW6Y4PqPUGRj"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_mKPWnKLxQtFW6Y4PqPUGRj",
                                      "label": "Total 211 Accounts Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_mKPWnKLxQtFW6Y4PqPUGRj"
                                        ]
                                      },
                                      "sub_totals": [
                                        17417138.87,
                                        17231022.53,
                                        17165964.92,
                                        17289307.7,
                                        16685044.33,
                                        21062810.7,
                                        21026002.16
                                      ]
                                    },
                                    "values": [
                                      17417138.87,
                                      17231022.53,
                                      17165964.92,
                                      17289307.7,
                                      16685044.33,
                                      21062810.7,
                                      21026002.16
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_Q3fdJQMRW6rMKysBXWEahM",
                                    "label": "2110 VAT Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Q3fdJQMRW6rMKysBXWEahM"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Q3fdJQMRW6rMKysBXWEahM",
                                      "label": "Total 2110 VAT Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Q3fdJQMRW6rMKysBXWEahM"
                                        ]
                                      },
                                      "sub_totals": [
                                        -30657.44,
                                        -30657.44,
                                        -30657.44,
                                        -30627.44,
                                        -30627.44,
                                        -30627.44,
                                        -31000.45
                                      ]
                                    },
                                    "values": [
                                      -30657.44,
                                      -30657.44,
                                      -30657.44,
                                      -30627.44,
                                      -30627.44,
                                      -30627.44,
                                      -31000.45
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_NCWL4ykpHArD3TxyrwNXME",
                                    "label": "2111 Zakat Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_NCWL4ykpHArD3TxyrwNXME"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_NCWL4ykpHArD3TxyrwNXME",
                                      "label": "Total 2111 Zakat Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_NCWL4ykpHArD3TxyrwNXME"
                                        ]
                                      },
                                      "sub_totals": [
                                        4325.57,
                                        656.24,
                                        -4563.05,
                                        -4563.05,
                                        -4563.05,
                                        -4563.05,
                                        -4563.05
                                      ]
                                    },
                                    "values": [
                                      4325.57,
                                      656.24,
                                      -4563.05,
                                      -4563.05,
                                      -4563.05,
                                      -4563.05,
                                      -4563.05
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_PLpCz5Su6dEx2yyWFtgbCJ",
                                    "label": "212 Unearned Revenue",
                                    "metadata": {
                                      "accounts": [
                                        "acc_PLpCz5Su6dEx2yyWFtgbCJ"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_PLpCz5Su6dEx2yyWFtgbCJ",
                                      "label": "Total 212 Unearned Revenue",
                                      "metadata": {
                                        "accounts": [
                                          "acc_PLpCz5Su6dEx2yyWFtgbCJ"
                                        ]
                                      },
                                      "sub_totals": [
                                        3479.25,
                                        3479.25,
                                        3479.25,
                                        3479.25,
                                        3479.25,
                                        3479.25,
                                        3479.25
                                      ]
                                    },
                                    "values": [
                                      3479.25,
                                      3479.25,
                                      3479.25,
                                      3479.25,
                                      3479.25,
                                      3479.25,
                                      3479.25
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_QWcAzxLX75xhsteWfJJx2W",
                                    "label": "213 Opening Balance Adjustments",
                                    "metadata": {
                                      "accounts": [
                                        "acc_QWcAzxLX75xhsteWfJJx2W"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_QWcAzxLX75xhsteWfJJx2W",
                                      "label": "Total 213 Opening Balance Adjustments",
                                      "metadata": {
                                        "accounts": [
                                          "acc_QWcAzxLX75xhsteWfJJx2W"
                                        ]
                                      },
                                      "sub_totals": [
                                        1007.73,
                                        1007.73,
                                        1007.73,
                                        1007.73,
                                        1007.73,
                                        1007.73,
                                        1007.73
                                      ]
                                    },
                                    "values": [
                                      1007.73,
                                      1007.73,
                                      1007.73,
                                      1007.73,
                                      1007.73,
                                      1007.73,
                                      1007.73
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_RZ5i6UrgdqjM3vCb6C7Afq",
                                    "label": "214 Payroll Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_RZ5i6UrgdqjM3vCb6C7Afq"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_RZ5i6UrgdqjM3vCb6C7Afq",
                                      "label": "Total 214 Payroll Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_RZ5i6UrgdqjM3vCb6C7Afq"
                                        ]
                                      },
                                      "sub_totals": [
                                        -39498.26,
                                        -42201.4,
                                        -43507.56,
                                        -46163.3,
                                        -67488.9,
                                        -81084.26,
                                        -83202.24
                                      ]
                                    },
                                    "values": [
                                      -39498.26,
                                      -42201.4,
                                      -43507.56,
                                      -46163.3,
                                      -67488.9,
                                      -81084.26,
                                      -83202.24
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_FXVTPCCw7XxaLYZu4bAiFX",
                                    "label": "215 Loan from Owner",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FXVTPCCw7XxaLYZu4bAiFX"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_FXVTPCCw7XxaLYZu4bAiFX",
                                      "label": "Total 215 Loan from Owner",
                                      "metadata": {
                                        "accounts": [
                                          "acc_FXVTPCCw7XxaLYZu4bAiFX"
                                        ]
                                      },
                                      "sub_totals": [
                                        -393.47,
                                        -393.47,
                                        -393.47,
                                        -292.38,
                                        -2706.75,
                                        -2706.75,
                                        -2846.11
                                      ]
                                    },
                                    "values": [
                                      -393.47,
                                      -393.47,
                                      -393.47,
                                      -292.38,
                                      -2706.75,
                                      -2706.75,
                                      -2846.11
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_KqJ4Y5RkJJTZD4Yny5wPqM",
                                    "label": "216 Employee Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_KqJ4Y5RkJJTZD4Yny5wPqM"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_KqJ4Y5RkJJTZD4Yny5wPqM",
                                      "label": "Total 216 Employee Reimbursements",
                                      "metadata": {
                                        "accounts": [
                                          "acc_KqJ4Y5RkJJTZD4Yny5wPqM"
                                        ]
                                      },
                                      "sub_totals": [
                                        33338.72,
                                        34030.42,
                                        34230.52,
                                        38261.22,
                                        43795.39,
                                        42945.23,
                                        47053.56
                                      ]
                                    },
                                    "values": [
                                      33338.72,
                                      34030.42,
                                      34230.52,
                                      38261.22,
                                      43795.39,
                                      42945.23,
                                      47053.56
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_iK82tinMxEHurtaLtxMbxC",
                                    "label": "218 VAT",
                                    "metadata": {
                                      "accounts": [
                                        "acc_iK82tinMxEHurtaLtxMbxC"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_iK82tinMxEHurtaLtxMbxC",
                                      "label": "Total 218 VAT",
                                      "metadata": {
                                        "accounts": [
                                          "acc_iK82tinMxEHurtaLtxMbxC"
                                        ]
                                      },
                                      "sub_totals": [
                                        9819.27,
                                        1450.22,
                                        10335.03,
                                        10381.22,
                                        14109.58,
                                        14046,
                                        14046
                                      ]
                                    },
                                    "values": [
                                      9819.27,
                                      1450.22,
                                      10335.03,
                                      10381.22,
                                      14109.58,
                                      14046,
                                      14046
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_eytk8Kh5mcqehRPGyBCu2h",
                                    "label": "219 Excise Tax Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_eytk8Kh5mcqehRPGyBCu2h"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_eytk8Kh5mcqehRPGyBCu2h",
                                      "label": "Total 219 Excise Tax Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_eytk8Kh5mcqehRPGyBCu2h"
                                        ]
                                      },
                                      "sub_totals": [
                                        11942.27,
                                        11942.27,
                                        11941.27,
                                        11410.44,
                                        11410.44,
                                        11410.44,
                                        11410.44
                                      ]
                                    },
                                    "values": [
                                      11942.27,
                                      11942.27,
                                      11941.27,
                                      11410.44,
                                      11410.44,
                                      11410.44,
                                      11410.44
                                    ]
                                  }
                                ],
                                "group": "CURRENT_LIABILITY",
                                "id": "CURRENT_LIABILITY",
                                "label": "Current Liabilities",
                                "metadata": {
                                  "sub_classification": [
                                    "CURRENT_LIABILITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_current_liability",
                                  "label": "Total Current Liabilities",
                                  "metadata": {},
                                  "sub_totals": [
                                    17410502.51,
                                    17210336.35,
                                    17147837.2,
                                    17272201.39,
                                    16653460.58,
                                    21016717.85,
                                    20981387.29
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "NON_CURRENT_LIABILITY",
                                "id": "NON_CURRENT_LIABILITY",
                                "label": "Non-Current Liabilities",
                                "metadata": {
                                  "sub_classification": [
                                    "NON_CURRENT_LIABILITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_non_current_liability",
                                  "label": "Total Non-Current Liabilities",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              }
                            ],
                            "group": "LIABILITY",
                            "id": "LIABILITY",
                            "label": "Liability",
                            "metadata": {
                              "classification": [
                                "LIABILITY"
                              ]
                            },
                            "summary": {
                              "id": "summary_liability",
                              "label": "Total Liability",
                              "metadata": {},
                              "sub_totals": [
                                17410502.51,
                                17210336.35,
                                17147837.2,
                                17272201.39,
                                16653460.58,
                                21016717.85,
                                20981387.29
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [],
                                "group": "PAID_IN_CAPITAL",
                                "id": "PAID_IN_CAPITAL",
                                "label": "Paid-in Capital",
                                "metadata": {
                                  "sub_classification": [
                                    "PAID_IN_CAPITAL"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_paid_in_capital",
                                  "label": "Total Paid-in Capital",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_dfsjNx9aVhTiwoDNbd86gD",
                                    "label": "331 Retained Earnings",
                                    "metadata": {
                                      "accounts": [
                                        "acc_dfsjNx9aVhTiwoDNbd86gD"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_dfsjNx9aVhTiwoDNbd86gD",
                                      "label": "Total 331 Retained Earnings",
                                      "metadata": {
                                        "accounts": [
                                          "acc_dfsjNx9aVhTiwoDNbd86gD"
                                        ]
                                      },
                                      "sub_totals": [
                                        -34074851.39,
                                        -34029201.64,
                                        -34687872.63,
                                        -34802116.52,
                                        -34218935.65,
                                        -38845838.08,
                                        -39458595.25
                                      ]
                                    },
                                    "values": [
                                      -34074851.39,
                                      -34029201.64,
                                      -34687872.63,
                                      -34802116.52,
                                      -34218935.65,
                                      -38845838.08,
                                      -39458595.25
                                    ]
                                  }
                                ],
                                "group": "RETAINED_EARNINGS",
                                "id": "RETAINED_EARNINGS",
                                "label": "Retained Earnings",
                                "metadata": {
                                  "sub_classification": [
                                    "RETAINED_EARNINGS"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_retained_earnings",
                                  "label": "Total Retained Earnings",
                                  "metadata": {},
                                  "sub_totals": [
                                    -34074851.39,
                                    -34029201.64,
                                    -34687872.63,
                                    -34802116.52,
                                    -34218935.65,
                                    -38845838.08,
                                    -39458595.25
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_Em3zUsJywGuHE5rKEsuuKQ",
                                    "label": "341 Accumulated Unrealized Gains and Losses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Em3zUsJywGuHE5rKEsuuKQ"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Em3zUsJywGuHE5rKEsuuKQ",
                                      "label": "Total 341 Accumulated Unrealized Gains and Losses",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Em3zUsJywGuHE5rKEsuuKQ"
                                        ]
                                      },
                                      "sub_totals": [
                                        -7595.36,
                                        -7595.36,
                                        -7595.36,
                                        -7595.36,
                                        -7595.36,
                                        -7595.36,
                                        -7595.36
                                      ]
                                    },
                                    "values": [
                                      -7595.36,
                                      -7595.36,
                                      -7595.36,
                                      -7595.36,
                                      -7595.36,
                                      -7595.36,
                                      -7595.36
                                    ]
                                  }
                                ],
                                "group": "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME",
                                "id": "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME",
                                "label": "Acc. Other Comprehensive Income",
                                "metadata": {
                                  "sub_classification": [
                                    "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_accumulated_other_comprehensive_income",
                                  "label": "Total Acc. Other Comprehensive Income",
                                  "metadata": {},
                                  "sub_totals": [
                                    -7595.36,
                                    -7595.36,
                                    -7595.36,
                                    -7595.36,
                                    -7595.36,
                                    -7595.36,
                                    -7595.36
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "TREASURY_STOCK",
                                "id": "TREASURY_STOCK",
                                "label": "Treasury Stock",
                                "metadata": {
                                  "sub_classification": [
                                    "TREASURY_STOCK"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_treasury_stock",
                                  "label": "Total Treasury Stock",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_fgsheVKKUH4rpnxmrmifx9",
                                    "label": "321 Owner's Equity",
                                    "metadata": {
                                      "accounts": [
                                        "acc_fgsheVKKUH4rpnxmrmifx9"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_fgsheVKKUH4rpnxmrmifx9",
                                      "label": "Total 321 Owner's Equity",
                                      "metadata": {
                                        "accounts": [
                                          "acc_fgsheVKKUH4rpnxmrmifx9"
                                        ]
                                      },
                                      "sub_totals": [
                                        9132.84,
                                        9132.84,
                                        9540.42,
                                        9540.42,
                                        16080.95,
                                        24831.29,
                                        24481.75
                                      ]
                                    },
                                    "values": [
                                      9132.84,
                                      9132.84,
                                      9540.42,
                                      9540.42,
                                      16080.95,
                                      24831.29,
                                      24481.75
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_2Jxnxb8wRjXM9BXVuv22rV",
                                    "label": "322 Drawings",
                                    "metadata": {
                                      "accounts": [
                                        "acc_2Jxnxb8wRjXM9BXVuv22rV"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_2Jxnxb8wRjXM9BXVuv22rV",
                                      "label": "Total 322 Drawings",
                                      "metadata": {
                                        "accounts": [
                                          "acc_2Jxnxb8wRjXM9BXVuv22rV"
                                        ]
                                      },
                                      "sub_totals": [
                                        -9881.55,
                                        -9881.55,
                                        -9881.55,
                                        -9881.55,
                                        -9881.55,
                                        -9950.53,
                                        -11718.53
                                      ]
                                    },
                                    "values": [
                                      -9881.55,
                                      -9881.55,
                                      -9881.55,
                                      -9881.55,
                                      -9881.55,
                                      -9950.53,
                                      -11718.53
                                    ]
                                  }
                                ],
                                "group": "OWNERS_EQUITY",
                                "id": "OWNERS_EQUITY",
                                "label": "Owner's Equity",
                                "metadata": {
                                  "sub_classification": [
                                    "OWNERS_EQUITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_owners_equity",
                                  "label": "Total Owner's Equity",
                                  "metadata": {},
                                  "sub_totals": [
                                    -748.71,
                                    -748.71,
                                    -341.13,
                                    -341.13,
                                    6199.4,
                                    14880.76,
                                    12763.22
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_izB9fj3oW7X8HYceWFy44Y",
                                    "label": "311 Opening Balance Offset",
                                    "metadata": {
                                      "accounts": [
                                        "acc_izB9fj3oW7X8HYceWFy44Y"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_izB9fj3oW7X8HYceWFy44Y",
                                      "label": "Total 311 Opening Balance Offset",
                                      "metadata": {
                                        "accounts": [
                                          "acc_izB9fj3oW7X8HYceWFy44Y"
                                        ]
                                      },
                                      "sub_totals": [
                                        737.6,
                                        1319.63,
                                        1319.63,
                                        1319.63,
                                        1319.63,
                                        1147,
                                        10222.87
                                      ]
                                    },
                                    "values": [
                                      737.6,
                                      1319.63,
                                      1319.63,
                                      1319.63,
                                      1319.63,
                                      1147,
                                      10222.87
                                    ]
                                  }
                                ],
                                "group": "OPENING_BALANCE_EQUITY",
                                "id": "OPENING_BALANCE_EQUITY",
                                "label": "Opening Balance Equity",
                                "metadata": {
                                  "sub_classification": [
                                    "OPENING_BALANCE_EQUITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_opening_balance_equity",
                                  "label": "Total Opening Balance Equity",
                                  "metadata": {},
                                  "sub_totals": [
                                    737.6,
                                    1319.63,
                                    1319.63,
                                    1319.63,
                                    1319.63,
                                    1147,
                                    10222.87
                                  ]
                                }
                              }
                            ],
                            "group": "EQUITY",
                            "id": "EQUITY",
                            "label": "Equity",
                            "metadata": {
                              "classification": [
                                "EQUITY"
                              ]
                            },
                            "summary": {
                              "id": "summary_equity",
                              "label": "Total Equity",
                              "metadata": {},
                              "sub_totals": [
                                -34082457.86,
                                -34036226.08,
                                -34694489.49,
                                -34808733.38,
                                -34219011.98,
                                -38837405.68,
                                -39443204.52
                              ]
                            }
                          }
                        ]
                      }
                    ]
                  },
                  "Month": {
                    "description": "Response grouped by month from Dec 2023 and 11 periods back",
                    "summary": "Group by month",
                    "value": [
                      {
                        "columns": [
                          {
                            "id": "2022-01-31",
                            "label": "31 Jan, 2022",
                            "metadata": {
                              "date": "2022-01-31"
                            }
                          },
                          {
                            "id": "2022-02-28",
                            "label": "28 Feb, 2022",
                            "metadata": {
                              "date": "2022-02-28"
                            }
                          },
                          {
                            "id": "2022-03-31",
                            "label": "31 Mar, 2022",
                            "metadata": {
                              "date": "2022-03-31"
                            }
                          },
                          {
                            "id": "2022-04-30",
                            "label": "30 Apr, 2022",
                            "metadata": {
                              "date": "2022-04-30"
                            }
                          },
                          {
                            "id": "2022-05-31",
                            "label": "31 May, 2022",
                            "metadata": {
                              "date": "2022-05-31"
                            }
                          },
                          {
                            "id": "2022-06-30",
                            "label": "30 Jun, 2022",
                            "metadata": {
                              "date": "2022-06-30"
                            }
                          },
                          {
                            "id": "2022-07-31",
                            "label": "31 Jul, 2022",
                            "metadata": {
                              "date": "2022-07-31"
                            }
                          },
                          {
                            "id": "2022-08-31",
                            "label": "31 Aug, 2022",
                            "metadata": {
                              "date": "2022-08-31"
                            }
                          },
                          {
                            "id": "2022-09-30",
                            "label": "30 Sep, 2022",
                            "metadata": {
                              "date": "2022-09-30"
                            }
                          },
                          {
                            "id": "2022-10-31",
                            "label": "31 Oct, 2022",
                            "metadata": {
                              "date": "2022-10-31"
                            }
                          },
                          {
                            "id": "2022-11-30",
                            "label": "30 Nov, 2022",
                            "metadata": {
                              "date": "2022-11-30"
                            }
                          },
                          {
                            "id": "2022-12-31",
                            "label": "31 Dec, 2022",
                            "metadata": {
                              "date": "2022-12-31"
                            }
                          }
                        ],
                        "overview": {
                          "created_ts": "2024-01-05T00:00:00Z",
                          "currency": "SAR",
                          "date": "2022-12-31",
                          "filters": {},
                          "group_by": "month",
                          "id": "balance_sheet",
                          "label": "Balance Sheet Report",
                          "period_count": 11
                        },
                        "rows": [
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [],
                                        "id": "acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                        "label": "1111 Undeposited Funds",
                                        "metadata": {
                                          "accounts": [
                                            "acc_QsYBgp4ZmYXBf6ixVcj5QR"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                          "label": "Total 1111 Undeposited Funds",
                                          "metadata": {
                                            "accounts": [
                                              "acc_QsYBgp4ZmYXBf6ixVcj5QR"
                                            ]
                                          },
                                          "sub_totals": [
                                            7689.21,
                                            8635.26,
                                            7293.95,
                                            7258.1,
                                            7258.1,
                                            7258.1,
                                            7258.1,
                                            14736.6,
                                            19088.71,
                                            16577.11,
                                            14580.17,
                                            5607.25
                                          ]
                                        },
                                        "values": [
                                          7689.21,
                                          8635.26,
                                          7293.95,
                                          7258.1,
                                          7258.1,
                                          7258.1,
                                          7258.1,
                                          14736.6,
                                          19088.71,
                                          16577.11,
                                          14580.17,
                                          5607.25
                                        ]
                                      },
                                      {
                                        "children": [],
                                        "id": "acc_frL4nJEEqJGpFp9LYmMjRn",
                                        "label": "1112 Petty Cash",
                                        "metadata": {
                                          "accounts": [
                                            "acc_frL4nJEEqJGpFp9LYmMjRn"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_frL4nJEEqJGpFp9LYmMjRn",
                                          "label": "Total 1112 Petty Cash",
                                          "metadata": {
                                            "accounts": [
                                              "acc_frL4nJEEqJGpFp9LYmMjRn"
                                            ]
                                          },
                                          "sub_totals": [
                                            -26996.53,
                                            -32589.49,
                                            -32401.99,
                                            -32498.16,
                                            -48331.75,
                                            -49183.76,
                                            -47406.25,
                                            -50405.22,
                                            -50636.67,
                                            -50722.03,
                                            -50722.03,
                                            -42163.01
                                          ]
                                        },
                                        "values": [
                                          -26996.53,
                                          -32589.49,
                                          -32401.99,
                                          -32498.16,
                                          -48331.75,
                                          -49183.76,
                                          -47406.25,
                                          -50405.22,
                                          -50636.67,
                                          -50722.03,
                                          -50722.03,
                                          -42163.01
                                        ]
                                      }
                                    ],
                                    "id": "acc_6pZ24ougntxTkvWwfuLjku",
                                    "label": "111 Cash and Cash Equivalents",
                                    "metadata": {
                                      "accounts": [
                                        "acc_6pZ24ougntxTkvWwfuLjku"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_6pZ24ougntxTkvWwfuLjku",
                                      "label": "Total 111 Cash and Cash Equivalents",
                                      "metadata": {
                                        "accounts": [
                                          "acc_6pZ24ougntxTkvWwfuLjku",
                                          "acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                          "acc_frL4nJEEqJGpFp9LYmMjRn"
                                        ]
                                      },
                                      "sub_totals": [
                                        25581.52,
                                        19913.72,
                                        19538.6,
                                        27053.38,
                                        8372.41,
                                        7676.14,
                                        19020.68,
                                        23500.21,
                                        37694.3,
                                        35097.34,
                                        38229.07,
                                        38452.17
                                      ]
                                    },
                                    "values": [
                                      44888.84,
                                      43867.95,
                                      44646.64,
                                      52293.44,
                                      49446.06,
                                      49601.8,
                                      59168.83,
                                      59168.83,
                                      69242.26,
                                      69242.26,
                                      74370.93,
                                      75007.93
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_FSngQmDUnZdczQeimCdiSd",
                                    "label": "112 Accounts Receivable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FSngQmDUnZdczQeimCdiSd"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_FSngQmDUnZdczQeimCdiSd",
                                      "label": "Total 112 Accounts Receivable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_FSngQmDUnZdczQeimCdiSd"
                                        ]
                                      },
                                      "sub_totals": [
                                        -6096001.43,
                                        -5261468,
                                        -4546996.83,
                                        -6159610.2,
                                        -8100666.82,
                                        -7615463.04,
                                        -4288333.23,
                                        -4476943.3,
                                        -5274769.06,
                                        -17290494.12,
                                        -14424528.66,
                                        -15905333.87
                                      ]
                                    },
                                    "values": [
                                      -6096001.43,
                                      -5261468,
                                      -4546996.83,
                                      -6159610.2,
                                      -8100666.82,
                                      -7615463.04,
                                      -4288333.23,
                                      -4476943.3,
                                      -5274769.06,
                                      -17290494.12,
                                      -14424528.66,
                                      -15905333.87
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_Sc7jtAiH559PEh5faNJQ8v",
                                    "label": "113 Employee Advance",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Sc7jtAiH559PEh5faNJQ8v"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Sc7jtAiH559PEh5faNJQ8v",
                                      "label": "Total 113 Employee Advance",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Sc7jtAiH559PEh5faNJQ8v"
                                        ]
                                      },
                                      "sub_totals": [
                                        -10980.87,
                                        -10926.35,
                                        -37972.76,
                                        -37972.76,
                                        -37972.76,
                                        -39082.02,
                                        -31327.69,
                                        -31327.69,
                                        -31327.69,
                                        -31135.3,
                                        -30809.2,
                                        -30809.2
                                      ]
                                    },
                                    "values": [
                                      -10980.87,
                                      -10926.35,
                                      -37972.76,
                                      -37972.76,
                                      -37972.76,
                                      -39082.02,
                                      -31327.69,
                                      -31327.69,
                                      -31327.69,
                                      -31135.3,
                                      -30809.2,
                                      -30809.2
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_nQqzwTwgf2ms9wfAAConYq",
                                    "label": "114 Prepaid Expenses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_nQqzwTwgf2ms9wfAAConYq"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_nQqzwTwgf2ms9wfAAConYq",
                                      "label": "Total 114 Prepaid Expenses",
                                      "metadata": {
                                        "accounts": [
                                          "acc_nQqzwTwgf2ms9wfAAConYq"
                                        ]
                                      },
                                      "sub_totals": [
                                        20441.53,
                                        20353.53,
                                        20757.39,
                                        20757.15,
                                        19315.07,
                                        37548.52,
                                        47267.9,
                                        47411.51,
                                        47411.51,
                                        47582.49,
                                        50688.93,
                                        50688.93
                                      ]
                                    },
                                    "values": [
                                      20441.53,
                                      20353.53,
                                      20757.39,
                                      20757.15,
                                      19315.07,
                                      37548.52,
                                      47267.9,
                                      47411.51,
                                      47411.51,
                                      47582.49,
                                      50688.93,
                                      50688.93
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_VMqYrgg8AqbLjmEnLQuf4y",
                                    "label": "115 Inventory",
                                    "metadata": {
                                      "accounts": [
                                        "acc_VMqYrgg8AqbLjmEnLQuf4y"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_VMqYrgg8AqbLjmEnLQuf4y",
                                      "label": "Total 115 Inventory",
                                      "metadata": {
                                        "accounts": [
                                          "acc_VMqYrgg8AqbLjmEnLQuf4y"
                                        ]
                                      },
                                      "sub_totals": [
                                        8193.29,
                                        10287.96,
                                        7775.5,
                                        7826.79,
                                        34533.95,
                                        34533.95,
                                        34533.95,
                                        10792.7,
                                        10149.5,
                                        11180.45,
                                        11180.45,
                                        14231.22
                                      ]
                                    },
                                    "values": [
                                      8193.29,
                                      10287.96,
                                      7775.5,
                                      7826.79,
                                      34533.95,
                                      34533.95,
                                      34533.95,
                                      10792.7,
                                      10149.5,
                                      11180.45,
                                      11180.45,
                                      14231.22
                                    ]
                                  }
                                ],
                                "group": "CURRENT_ASSET",
                                "id": "CURRENT_ASSET",
                                "label": "Current Assets",
                                "metadata": {
                                  "sub_classification": [
                                    "CURRENT_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_current_asset",
                                  "label": "Total Current Assets",
                                  "metadata": {},
                                  "sub_totals": [
                                    -6052765.96,
                                    -5221839.14,
                                    -4536898.1,
                                    -6141945.64,
                                    -8076418.15,
                                    -7574786.45,
                                    -4218838.39,
                                    -4426566.57,
                                    -5210841.44,
                                    -17227769.14,
                                    -14355239.41,
                                    -15832770.75
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [],
                                        "id": "acc_J8UNTwrVoTU43WLwfbdjPs",
                                        "label": "1211 Furniture and Equipment",
                                        "metadata": {
                                          "accounts": [
                                            "acc_J8UNTwrVoTU43WLwfbdjPs"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_J8UNTwrVoTU43WLwfbdjPs",
                                          "label": "Total 1211 Furniture and Equipment",
                                          "metadata": {
                                            "accounts": [
                                              "acc_J8UNTwrVoTU43WLwfbdjPs"
                                            ]
                                          },
                                          "sub_totals": [
                                            18358.19,
                                            24349.24,
                                            24349.24,
                                            24349.24,
                                            24349.24,
                                            20604.04,
                                            19947.33,
                                            19947.33,
                                            8481.74,
                                            7393.64,
                                            7393.64,
                                            -1031.05
                                          ]
                                        },
                                        "values": [
                                          18358.19,
                                          24349.24,
                                          24349.24,
                                          24349.24,
                                          24349.24,
                                          20604.04,
                                          19947.33,
                                          19947.33,
                                          8481.74,
                                          7393.64,
                                          7393.64,
                                          -1031.05
                                        ]
                                      },
                                      {
                                        "children": [],
                                        "id": "acc_8YNsdkYehwd3VYYidHPH7U",
                                        "label": "1212 Accumulated depreciation",
                                        "metadata": {
                                          "accounts": [
                                            "acc_8YNsdkYehwd3VYYidHPH7U"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_8YNsdkYehwd3VYYidHPH7U",
                                          "label": "Total 1212 Accumulated depreciation",
                                          "metadata": {
                                            "accounts": [
                                              "acc_8YNsdkYehwd3VYYidHPH7U"
                                            ]
                                          },
                                          "sub_totals": [
                                            -1996.9,
                                            -1996.9,
                                            -1996.9,
                                            -1996.9,
                                            -1996.9,
                                            -1996.9,
                                            -9921.86,
                                            -9921.86,
                                            -9921.86,
                                            -9600.72,
                                            -9600.72,
                                            -9600.72
                                          ]
                                        },
                                        "values": [
                                          -1996.9,
                                          -1996.9,
                                          -1996.9,
                                          -1996.9,
                                          -1996.9,
                                          -1996.9,
                                          -9921.86,
                                          -9921.86,
                                          -9921.86,
                                          -9600.72,
                                          -9600.72,
                                          -9600.72
                                        ]
                                      }
                                    ],
                                    "id": "acc_U48EC5Q6TyhxgyH6G33D58",
                                    "label": "121 Fixed Asset",
                                    "metadata": {
                                      "accounts": [
                                        "acc_U48EC5Q6TyhxgyH6G33D58"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_U48EC5Q6TyhxgyH6G33D58",
                                      "label": "Total 121 Fixed Asset",
                                      "metadata": {
                                        "accounts": [
                                          "acc_U48EC5Q6TyhxgyH6G33D58",
                                          "acc_J8UNTwrVoTU43WLwfbdjPs",
                                          "acc_8YNsdkYehwd3VYYidHPH7U"
                                        ]
                                      },
                                      "sub_totals": [
                                        23955.96,
                                        22920.97,
                                        22519.9,
                                        12385.69,
                                        12385.69,
                                        8644.9,
                                        2944.78,
                                        4548.5,
                                        -6126.62,
                                        -6893.58,
                                        -27938.58,
                                        -45286.33
                                      ]
                                    },
                                    "values": [
                                      7594.67,
                                      568.63,
                                      167.56,
                                      -9966.65,
                                      -9966.65,
                                      -9962.24,
                                      -7080.69,
                                      -5476.97,
                                      -4686.5,
                                      -4686.5,
                                      -25731.5,
                                      -34654.56
                                    ]
                                  }
                                ],
                                "group": "NON_CURRENT_ASSET",
                                "id": "NON_CURRENT_ASSET",
                                "label": "Non-Current Assets",
                                "metadata": {
                                  "sub_classification": [
                                    "NON_CURRENT_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_non_current_asset",
                                  "label": "Total Non-Current Assets",
                                  "metadata": {},
                                  "sub_totals": [
                                    23955.96,
                                    22920.97,
                                    22519.9,
                                    12385.69,
                                    12385.69,
                                    8644.9,
                                    2944.78,
                                    4548.5,
                                    -6126.62,
                                    -6893.58,
                                    -27938.58,
                                    -45286.33
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "FIXED_ASSET",
                                "id": "FIXED_ASSET",
                                "label": "Fixed Asset",
                                "metadata": {
                                  "sub_classification": [
                                    "FIXED_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_fixed_asset",
                                  "label": "Total Fixed Asset",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              }
                            ],
                            "group": "ASSET",
                            "id": "ASSET",
                            "label": "Asset",
                            "metadata": {
                              "classification": [
                                "ASSET"
                              ]
                            },
                            "summary": {
                              "id": "summary_asset",
                              "label": "Total Asset",
                              "metadata": {},
                              "sub_totals": [
                                -6028810,
                                -5198918.17,
                                -4514378.2,
                                -6129559.95,
                                -8064032.46,
                                -7566141.55,
                                -4215893.61,
                                -4422018.07,
                                -5216968.06,
                                -17234662.72,
                                -14383177.99,
                                -15878057.08
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_mKPWnKLxQtFW6Y4PqPUGRj",
                                    "label": "211 Accounts Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_mKPWnKLxQtFW6Y4PqPUGRj"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_mKPWnKLxQtFW6Y4PqPUGRj",
                                      "label": "Total 211 Accounts Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_mKPWnKLxQtFW6Y4PqPUGRj"
                                        ]
                                      },
                                      "sub_totals": [
                                        543116.87,
                                        3283926.27,
                                        3981655.04,
                                        3404697.27,
                                        2281458.95,
                                        5907383.78,
                                        4860733.43,
                                        13506210.39,
                                        13791521.98,
                                        3294475.84,
                                        2838494.12,
                                        -410366.36
                                      ]
                                    },
                                    "values": [
                                      543116.87,
                                      3283926.27,
                                      3981655.04,
                                      3404697.27,
                                      2281458.95,
                                      5907383.78,
                                      4860733.43,
                                      13506210.39,
                                      13791521.98,
                                      3294475.84,
                                      2838494.12,
                                      -410366.36
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_Q3fdJQMRW6rMKysBXWEahM",
                                    "label": "2110 VAT Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Q3fdJQMRW6rMKysBXWEahM"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Q3fdJQMRW6rMKysBXWEahM",
                                      "label": "Total 2110 VAT Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Q3fdJQMRW6rMKysBXWEahM"
                                        ]
                                      },
                                      "sub_totals": [
                                        -30879.39,
                                        -33872.5,
                                        -35884.44,
                                        -35884.44,
                                        -35884.44,
                                        -35865.69,
                                        -35865.69,
                                        -35865.69,
                                        -36238.7,
                                        -36238.7,
                                        -36238.7,
                                        -36238.7
                                      ]
                                    },
                                    "values": [
                                      -30879.39,
                                      -33872.5,
                                      -35884.44,
                                      -35884.44,
                                      -35884.44,
                                      -35865.69,
                                      -35865.69,
                                      -35865.69,
                                      -36238.7,
                                      -36238.7,
                                      -36238.7,
                                      -36238.7
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_NCWL4ykpHArD3TxyrwNXME",
                                    "label": "2111 Zakat Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_NCWL4ykpHArD3TxyrwNXME"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_NCWL4ykpHArD3TxyrwNXME",
                                      "label": "Total 2111 Zakat Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_NCWL4ykpHArD3TxyrwNXME"
                                        ]
                                      },
                                      "sub_totals": [
                                        9422.68,
                                        10621.45,
                                        12395.2,
                                        17320.08,
                                        19289.79,
                                        19289.79,
                                        48353.61,
                                        48353.61,
                                        48353.61,
                                        48353.61,
                                        48353.61,
                                        46720.76
                                      ]
                                    },
                                    "values": [
                                      9422.68,
                                      10621.45,
                                      12395.2,
                                      17320.08,
                                      19289.79,
                                      19289.79,
                                      48353.61,
                                      48353.61,
                                      48353.61,
                                      48353.61,
                                      48353.61,
                                      46720.76
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_PLpCz5Su6dEx2yyWFtgbCJ",
                                    "label": "212 Unearned Revenue",
                                    "metadata": {
                                      "accounts": [
                                        "acc_PLpCz5Su6dEx2yyWFtgbCJ"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_PLpCz5Su6dEx2yyWFtgbCJ",
                                      "label": "Total 212 Unearned Revenue",
                                      "metadata": {
                                        "accounts": [
                                          "acc_PLpCz5Su6dEx2yyWFtgbCJ"
                                        ]
                                      },
                                      "sub_totals": [
                                        3461.99,
                                        3461.99,
                                        3479.69,
                                        3479.69,
                                        3479.69,
                                        3479.69,
                                        1558.26,
                                        1542.89,
                                        -114.69,
                                        -172.67,
                                        1043.46,
                                        1046.45
                                      ]
                                    },
                                    "values": [
                                      3461.99,
                                      3461.99,
                                      3479.69,
                                      3479.69,
                                      3479.69,
                                      3479.69,
                                      1558.26,
                                      1542.89,
                                      -114.69,
                                      -172.67,
                                      1043.46,
                                      1046.45
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_QWcAzxLX75xhsteWfJJx2W",
                                    "label": "213 Opening Balance Adjustments",
                                    "metadata": {
                                      "accounts": [
                                        "acc_QWcAzxLX75xhsteWfJJx2W"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_QWcAzxLX75xhsteWfJJx2W",
                                      "label": "Total 213 Opening Balance Adjustments",
                                      "metadata": {
                                        "accounts": [
                                          "acc_QWcAzxLX75xhsteWfJJx2W"
                                        ]
                                      },
                                      "sub_totals": [
                                        24610.54,
                                        24635.06,
                                        9210.89,
                                        9210.89,
                                        9210.89,
                                        9075.49,
                                        9075.49,
                                        9075.49,
                                        9075.49,
                                        8127.76,
                                        8127.76,
                                        6976.66
                                      ]
                                    },
                                    "values": [
                                      24610.54,
                                      24635.06,
                                      9210.89,
                                      9210.89,
                                      9210.89,
                                      9075.49,
                                      9075.49,
                                      9075.49,
                                      9075.49,
                                      8127.76,
                                      8127.76,
                                      6976.66
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_RZ5i6UrgdqjM3vCb6C7Afq",
                                    "label": "214 Payroll Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_RZ5i6UrgdqjM3vCb6C7Afq"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_RZ5i6UrgdqjM3vCb6C7Afq",
                                      "label": "Total 214 Payroll Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_RZ5i6UrgdqjM3vCb6C7Afq"
                                        ]
                                      },
                                      "sub_totals": [
                                        -38138.18,
                                        -44187.95,
                                        2635.55,
                                        26157.34,
                                        20182.48,
                                        -1049.21,
                                        -33504.49,
                                        -60812.67,
                                        -70648.17,
                                        -96535.26,
                                        -89801.2,
                                        -84066.37
                                      ]
                                    },
                                    "values": [
                                      -38138.18,
                                      -44187.95,
                                      2635.55,
                                      26157.34,
                                      20182.48,
                                      -1049.21,
                                      -33504.49,
                                      -60812.67,
                                      -70648.17,
                                      -96535.26,
                                      -89801.2,
                                      -84066.37
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_FXVTPCCw7XxaLYZu4bAiFX",
                                    "label": "215 Loan from Owner",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FXVTPCCw7XxaLYZu4bAiFX"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_FXVTPCCw7XxaLYZu4bAiFX",
                                      "label": "Total 215 Loan from Owner",
                                      "metadata": {
                                        "accounts": [
                                          "acc_FXVTPCCw7XxaLYZu4bAiFX"
                                        ]
                                      },
                                      "sub_totals": [
                                        -2483.89,
                                        -2446.29,
                                        -2446.29,
                                        -4099.93,
                                        -4097.87,
                                        -2902.05,
                                        7780.45,
                                        7780.45,
                                        7641.09,
                                        7641.09,
                                        7641.09,
                                        7431.69
                                      ]
                                    },
                                    "values": [
                                      -2483.89,
                                      -2446.29,
                                      -2446.29,
                                      -4099.93,
                                      -4097.87,
                                      -2902.05,
                                      7780.45,
                                      7780.45,
                                      7641.09,
                                      7641.09,
                                      7641.09,
                                      7431.69
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_KqJ4Y5RkJJTZD4Yny5wPqM",
                                    "label": "216 Employee Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_KqJ4Y5RkJJTZD4Yny5wPqM"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_KqJ4Y5RkJJTZD4Yny5wPqM",
                                      "label": "Total 216 Employee Reimbursements",
                                      "metadata": {
                                        "accounts": [
                                          "acc_KqJ4Y5RkJJTZD4Yny5wPqM"
                                        ]
                                      },
                                      "sub_totals": [
                                        125399.34,
                                        121003.35,
                                        185381.24,
                                        191904.8,
                                        189922.77,
                                        195788.62,
                                        172521.2,
                                        159378.35,
                                        182204.68,
                                        167661.75,
                                        248774.33,
                                        262434.61
                                      ]
                                    },
                                    "values": [
                                      125399.34,
                                      121003.35,
                                      185381.24,
                                      191904.8,
                                      189922.77,
                                      195788.62,
                                      172521.2,
                                      159378.35,
                                      182204.68,
                                      167661.75,
                                      248774.33,
                                      262434.61
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_iK82tinMxEHurtaLtxMbxC",
                                    "label": "218 VAT",
                                    "metadata": {
                                      "accounts": [
                                        "acc_iK82tinMxEHurtaLtxMbxC"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_iK82tinMxEHurtaLtxMbxC",
                                      "label": "Total 218 VAT",
                                      "metadata": {
                                        "accounts": [
                                          "acc_iK82tinMxEHurtaLtxMbxC"
                                        ]
                                      },
                                      "sub_totals": [
                                        19434.43,
                                        2480.71,
                                        -12600.11,
                                        -17434.92,
                                        -22175.54,
                                        -22414.49,
                                        -25164.11,
                                        -31872.37,
                                        -35852.99,
                                        -59176.23,
                                        -63754.34,
                                        -51819.29
                                      ]
                                    },
                                    "values": [
                                      19434.43,
                                      2480.71,
                                      -12600.11,
                                      -17434.92,
                                      -22175.54,
                                      -22414.49,
                                      -25164.11,
                                      -31872.37,
                                      -35852.99,
                                      -59176.23,
                                      -63754.34,
                                      -51819.29
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_eytk8Kh5mcqehRPGyBCu2h",
                                    "label": "219 Excise Tax Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_eytk8Kh5mcqehRPGyBCu2h"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_eytk8Kh5mcqehRPGyBCu2h",
                                      "label": "Total 219 Excise Tax Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_eytk8Kh5mcqehRPGyBCu2h"
                                        ]
                                      },
                                      "sub_totals": [
                                        4954.6,
                                        4954.6,
                                        4954.6,
                                        4954.6,
                                        4946.37,
                                        10378.54,
                                        11032.44,
                                        11058.69,
                                        12967.53,
                                        12967.53,
                                        17282.43,
                                        17282.43
                                      ]
                                    },
                                    "values": [
                                      4954.6,
                                      4954.6,
                                      4954.6,
                                      4954.6,
                                      4946.37,
                                      10378.54,
                                      11032.44,
                                      11058.69,
                                      12967.53,
                                      12967.53,
                                      17282.43,
                                      17282.43
                                    ]
                                  }
                                ],
                                "group": "CURRENT_LIABILITY",
                                "id": "CURRENT_LIABILITY",
                                "label": "Current Liabilities",
                                "metadata": {
                                  "sub_classification": [
                                    "CURRENT_LIABILITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_current_liability",
                                  "label": "Total Current Liabilities",
                                  "metadata": {},
                                  "sub_totals": [
                                    658898.99,
                                    3370576.69,
                                    4148781.37,
                                    3600305.38,
                                    2466333.09,
                                    6083164.47,
                                    5016520.59,
                                    13614849.14,
                                    13908909.83,
                                    3347104.72,
                                    2979922.56,
                                    -240598.12
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "NON_CURRENT_LIABILITY",
                                "id": "NON_CURRENT_LIABILITY",
                                "label": "Non-Current Liabilities",
                                "metadata": {
                                  "sub_classification": [
                                    "NON_CURRENT_LIABILITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_non_current_liability",
                                  "label": "Total Non-Current Liabilities",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              }
                            ],
                            "group": "LIABILITY",
                            "id": "LIABILITY",
                            "label": "Liability",
                            "metadata": {
                              "classification": [
                                "LIABILITY"
                              ]
                            },
                            "summary": {
                              "id": "summary_liability",
                              "label": "Total Liability",
                              "metadata": {},
                              "sub_totals": [
                                658898.99,
                                3370576.69,
                                4148781.37,
                                3600305.38,
                                2466333.09,
                                6083164.47,
                                5016520.59,
                                13614849.14,
                                13908909.83,
                                3347104.72,
                                2979922.56,
                                -240598.12
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [],
                                "group": "PAID_IN_CAPITAL",
                                "id": "PAID_IN_CAPITAL",
                                "label": "Paid-in Capital",
                                "metadata": {
                                  "sub_classification": [
                                    "PAID_IN_CAPITAL"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_paid_in_capital",
                                  "label": "Total Paid-in Capital",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_dfsjNx9aVhTiwoDNbd86gD",
                                    "label": "331 Retained Earnings",
                                    "metadata": {
                                      "accounts": [
                                        "acc_dfsjNx9aVhTiwoDNbd86gD"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_dfsjNx9aVhTiwoDNbd86gD",
                                      "label": "Total 331 Retained Earnings",
                                      "metadata": {
                                        "accounts": [
                                          "acc_dfsjNx9aVhTiwoDNbd86gD"
                                        ]
                                      },
                                      "sub_totals": [
                                        -6663520.26,
                                        -8566253.29,
                                        -8577398.79,
                                        -9656118.11,
                                        -10472782.89,
                                        -13591888.68,
                                        -9215447.28,
                                        -18032569.67,
                                        -19135253.96,
                                        -20595498.24,
                                        -17299374.09,
                                        -15583336.68
                                      ]
                                    },
                                    "values": [
                                      -6663520.26,
                                      -8566253.29,
                                      -8577398.79,
                                      -9656118.11,
                                      -10472782.89,
                                      -13591888.68,
                                      -9215447.28,
                                      -18032569.67,
                                      -19135253.96,
                                      -20595498.24,
                                      -17299374.09,
                                      -15583336.68
                                    ]
                                  }
                                ],
                                "group": "RETAINED_EARNINGS",
                                "id": "RETAINED_EARNINGS",
                                "label": "Retained Earnings",
                                "metadata": {
                                  "sub_classification": [
                                    "RETAINED_EARNINGS"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_retained_earnings",
                                  "label": "Total Retained Earnings",
                                  "metadata": {},
                                  "sub_totals": [
                                    -6663520.26,
                                    -8566253.29,
                                    -8577398.79,
                                    -9656118.11,
                                    -10472782.89,
                                    -13591888.68,
                                    -9215447.28,
                                    -18032569.67,
                                    -19135253.96,
                                    -20595498.24,
                                    -17299374.09,
                                    -15583336.68
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_Em3zUsJywGuHE5rKEsuuKQ",
                                    "label": "341 Accumulated Unrealized Gains and Losses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Em3zUsJywGuHE5rKEsuuKQ"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Em3zUsJywGuHE5rKEsuuKQ",
                                      "label": "Total 341 Accumulated Unrealized Gains and Losses",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Em3zUsJywGuHE5rKEsuuKQ"
                                        ]
                                      },
                                      "sub_totals": [
                                        8847.08,
                                        18751.61,
                                        17419.69,
                                        17419.69,
                                        17419.69,
                                        17419.69,
                                        17419.69,
                                        17419.69,
                                        17419.69,
                                        17419.69,
                                        17419.69,
                                        14974.69
                                      ]
                                    },
                                    "values": [
                                      8847.08,
                                      18751.61,
                                      17419.69,
                                      17419.69,
                                      17419.69,
                                      17419.69,
                                      17419.69,
                                      17419.69,
                                      17419.69,
                                      17419.69,
                                      17419.69,
                                      14974.69
                                    ]
                                  }
                                ],
                                "group": "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME",
                                "id": "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME",
                                "label": "Acc. Other Comprehensive Income",
                                "metadata": {
                                  "sub_classification": [
                                    "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_accumulated_other_comprehensive_income",
                                  "label": "Total Acc. Other Comprehensive Income",
                                  "metadata": {},
                                  "sub_totals": [
                                    8847.08,
                                    18751.61,
                                    17419.69,
                                    17419.69,
                                    17419.69,
                                    17419.69,
                                    17419.69,
                                    17419.69,
                                    17419.69,
                                    17419.69,
                                    17419.69,
                                    14974.69
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "TREASURY_STOCK",
                                "id": "TREASURY_STOCK",
                                "label": "Treasury Stock",
                                "metadata": {
                                  "sub_classification": [
                                    "TREASURY_STOCK"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_treasury_stock",
                                  "label": "Total Treasury Stock",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_fgsheVKKUH4rpnxmrmifx9",
                                    "label": "321 Owner's Equity",
                                    "metadata": {
                                      "accounts": [
                                        "acc_fgsheVKKUH4rpnxmrmifx9"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_fgsheVKKUH4rpnxmrmifx9",
                                      "label": "Total 321 Owner's Equity",
                                      "metadata": {
                                        "accounts": [
                                          "acc_fgsheVKKUH4rpnxmrmifx9"
                                        ]
                                      },
                                      "sub_totals": [
                                        10767.52,
                                        10767.52,
                                        10767.52,
                                        10767.52,
                                        9107.03,
                                        8696.26,
                                        15545.42,
                                        25895.92,
                                        25546.38,
                                        22151.82,
                                        20428.63,
                                        20428.63
                                      ]
                                    },
                                    "values": [
                                      10767.52,
                                      10767.52,
                                      10767.52,
                                      10767.52,
                                      9107.03,
                                      8696.26,
                                      15545.42,
                                      25895.92,
                                      25546.38,
                                      22151.82,
                                      20428.63,
                                      20428.63
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_2Jxnxb8wRjXM9BXVuv22rV",
                                    "label": "322 Drawings",
                                    "metadata": {
                                      "accounts": [
                                        "acc_2Jxnxb8wRjXM9BXVuv22rV"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_2Jxnxb8wRjXM9BXVuv22rV",
                                      "label": "Total 322 Drawings",
                                      "metadata": {
                                        "accounts": [
                                          "acc_2Jxnxb8wRjXM9BXVuv22rV"
                                        ]
                                      },
                                      "sub_totals": [
                                        -19432.86,
                                        -20246.46,
                                        -21931.04,
                                        -21770.18,
                                        -21770.18,
                                        -22190.23,
                                        -22190.23,
                                        -20781.13,
                                        -16194.39,
                                        -15480.82,
                                        -45388.76,
                                        -45388.76
                                      ]
                                    },
                                    "values": [
                                      -19432.86,
                                      -20246.46,
                                      -21931.04,
                                      -21770.18,
                                      -21770.18,
                                      -22190.23,
                                      -22190.23,
                                      -20781.13,
                                      -16194.39,
                                      -15480.82,
                                      -45388.76,
                                      -45388.76
                                    ]
                                  }
                                ],
                                "group": "OWNERS_EQUITY",
                                "id": "OWNERS_EQUITY",
                                "label": "Owner's Equity",
                                "metadata": {
                                  "sub_classification": [
                                    "OWNERS_EQUITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_owners_equity",
                                  "label": "Total Owner's Equity",
                                  "metadata": {},
                                  "sub_totals": [
                                    -8665.34,
                                    -9478.94,
                                    -11163.52,
                                    -11002.66,
                                    -12663.15,
                                    -13493.97,
                                    -6644.81,
                                    5114.79,
                                    9351.99,
                                    6671,
                                    -24960.13,
                                    -24960.13
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_izB9fj3oW7X8HYceWFy44Y",
                                    "label": "311 Opening Balance Offset",
                                    "metadata": {
                                      "accounts": [
                                        "acc_izB9fj3oW7X8HYceWFy44Y"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_izB9fj3oW7X8HYceWFy44Y",
                                      "label": "Total 311 Opening Balance Offset",
                                      "metadata": {
                                        "accounts": [
                                          "acc_izB9fj3oW7X8HYceWFy44Y"
                                        ]
                                      },
                                      "sub_totals": [
                                        -36.86,
                                        -445.61,
                                        -445.61,
                                        128.25,
                                        128.25,
                                        128.25,
                                        -1194.33,
                                        -1366.96,
                                        7012.52,
                                        7012.52,
                                        7012.52,
                                        7012.52
                                      ]
                                    },
                                    "values": [
                                      -36.86,
                                      -445.61,
                                      -445.61,
                                      128.25,
                                      128.25,
                                      128.25,
                                      -1194.33,
                                      -1366.96,
                                      7012.52,
                                      7012.52,
                                      7012.52,
                                      7012.52
                                    ]
                                  }
                                ],
                                "group": "OPENING_BALANCE_EQUITY",
                                "id": "OPENING_BALANCE_EQUITY",
                                "label": "Opening Balance Equity",
                                "metadata": {
                                  "sub_classification": [
                                    "OPENING_BALANCE_EQUITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_opening_balance_equity",
                                  "label": "Total Opening Balance Equity",
                                  "metadata": {},
                                  "sub_totals": [
                                    -36.86,
                                    -445.61,
                                    -445.61,
                                    128.25,
                                    128.25,
                                    128.25,
                                    -1194.33,
                                    -1366.96,
                                    7012.52,
                                    7012.52,
                                    7012.52,
                                    7012.52
                                  ]
                                }
                              }
                            ],
                            "group": "EQUITY",
                            "id": "EQUITY",
                            "label": "Equity",
                            "metadata": {
                              "classification": [
                                "EQUITY"
                              ]
                            },
                            "summary": {
                              "id": "summary_equity",
                              "label": "Total Equity",
                              "metadata": {},
                              "sub_totals": [
                                -6663375.38,
                                -8557426.23,
                                -8571588.23,
                                -9649572.83,
                                -10467898.1,
                                -13587834.71,
                                -9205866.73,
                                -18011402.15,
                                -19101469.76,
                                -20564395.03,
                                -17299902.01,
                                -15586309.6
                              ]
                            }
                          }
                        ]
                      }
                    ]
                  },
                  "Year": {
                    "description": "Response grouped by year from 2024 and 3 periods back",
                    "summary": "Group by year",
                    "value": [
                      {
                        "columns": [
                          {
                            "id": "2019-12-31",
                            "label": "31 Dec, 2019",
                            "metadata": {
                              "date": "2019-12-31"
                            }
                          },
                          {
                            "id": "2020-12-31",
                            "label": "31 Dec, 2020",
                            "metadata": {
                              "date": "2020-12-31"
                            }
                          },
                          {
                            "id": "2021-12-31",
                            "label": "31 Dec, 2021",
                            "metadata": {
                              "date": "2021-12-31"
                            }
                          },
                          {
                            "id": "2022-12-31",
                            "label": "31 Dec, 2022",
                            "metadata": {
                              "date": "2022-12-31"
                            }
                          },
                          {
                            "id": "2023-12-31",
                            "label": "31 Dec, 2023",
                            "metadata": {
                              "date": "2023-12-31"
                            }
                          }
                        ],
                        "overview": {
                          "created_ts": "2024-01-05T00:00:00Z",
                          "currency": "SAR",
                          "date": "2023-12-31",
                          "filters": {},
                          "group_by": "year",
                          "id": "balance_sheet",
                          "label": "Balance Sheet Report",
                          "period_count": 4
                        },
                        "rows": [
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [],
                                        "id": "acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                        "label": "1111 Undeposited Funds",
                                        "metadata": {
                                          "accounts": [
                                            "acc_QsYBgp4ZmYXBf6ixVcj5QR"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                          "label": "Total 1111 Undeposited Funds",
                                          "metadata": {
                                            "accounts": [
                                              "acc_QsYBgp4ZmYXBf6ixVcj5QR"
                                            ]
                                          },
                                          "sub_totals": [
                                            0,
                                            0,
                                            7689.21,
                                            5607.25,
                                            32715.41
                                          ]
                                        },
                                        "values": [
                                          0,
                                          0,
                                          7689.21,
                                          5607.25,
                                          32715.41
                                        ]
                                      },
                                      {
                                        "children": [],
                                        "id": "acc_frL4nJEEqJGpFp9LYmMjRn",
                                        "label": "1112 Petty Cash",
                                        "metadata": {
                                          "accounts": [
                                            "acc_frL4nJEEqJGpFp9LYmMjRn"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_frL4nJEEqJGpFp9LYmMjRn",
                                          "label": "Total 1112 Petty Cash",
                                          "metadata": {
                                            "accounts": [
                                              "acc_frL4nJEEqJGpFp9LYmMjRn"
                                            ]
                                          },
                                          "sub_totals": [
                                            0,
                                            0,
                                            -27415.53,
                                            -42163.01,
                                            -54920.41
                                          ]
                                        },
                                        "values": [
                                          0,
                                          0,
                                          -27415.53,
                                          -42163.01,
                                          -54920.41
                                        ]
                                      }
                                    ],
                                    "id": "acc_6pZ24ougntxTkvWwfuLjku",
                                    "label": "111 Cash and Cash Equivalents",
                                    "metadata": {
                                      "accounts": [
                                        "acc_6pZ24ougntxTkvWwfuLjku"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_6pZ24ougntxTkvWwfuLjku",
                                      "label": "Total 111 Cash and Cash Equivalents",
                                      "metadata": {
                                        "accounts": [
                                          "acc_6pZ24ougntxTkvWwfuLjku",
                                          "acc_QsYBgp4ZmYXBf6ixVcj5QR",
                                          "acc_frL4nJEEqJGpFp9LYmMjRn"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        25162.52,
                                        38452.17,
                                        62751.46
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      44888.84,
                                      75007.93,
                                      84956.46
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_FSngQmDUnZdczQeimCdiSd",
                                    "label": "112 Accounts Receivable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FSngQmDUnZdczQeimCdiSd"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_FSngQmDUnZdczQeimCdiSd",
                                      "label": "Total 112 Accounts Receivable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_FSngQmDUnZdczQeimCdiSd"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        -6138150.33,
                                        -15905333.87,
                                        -40518833.87
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      -6138150.33,
                                      -15905333.87,
                                      -40518833.87
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_Sc7jtAiH559PEh5faNJQ8v",
                                    "label": "113 Employee Advance",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Sc7jtAiH559PEh5faNJQ8v"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Sc7jtAiH559PEh5faNJQ8v",
                                      "label": "Total 113 Employee Advance",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Sc7jtAiH559PEh5faNJQ8v"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        -11215.45,
                                        -30809.2,
                                        -18230.49
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      -11215.45,
                                      -30809.2,
                                      -18230.49
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_nQqzwTwgf2ms9wfAAConYq",
                                    "label": "114 Prepaid Expenses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_nQqzwTwgf2ms9wfAAConYq"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_nQqzwTwgf2ms9wfAAConYq",
                                      "label": "Total 114 Prepaid Expenses",
                                      "metadata": {
                                        "accounts": [
                                          "acc_nQqzwTwgf2ms9wfAAConYq"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        20441.53,
                                        50688.93,
                                        47448.95
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      20441.53,
                                      50688.93,
                                      47448.95
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_VMqYrgg8AqbLjmEnLQuf4y",
                                    "label": "115 Inventory",
                                    "metadata": {
                                      "accounts": [
                                        "acc_VMqYrgg8AqbLjmEnLQuf4y"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_VMqYrgg8AqbLjmEnLQuf4y",
                                      "label": "Total 115 Inventory",
                                      "metadata": {
                                        "accounts": [
                                          "acc_VMqYrgg8AqbLjmEnLQuf4y"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        6042.2,
                                        14231.22,
                                        2474.43
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      6042.2,
                                      14231.22,
                                      2474.43
                                    ]
                                  }
                                ],
                                "group": "CURRENT_ASSET",
                                "id": "CURRENT_ASSET",
                                "label": "Current Assets",
                                "metadata": {
                                  "sub_classification": [
                                    "CURRENT_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_current_asset",
                                  "label": "Total Current Assets",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    -6097719.53,
                                    -15832770.75,
                                    -40424389.52
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [],
                                        "id": "acc_J8UNTwrVoTU43WLwfbdjPs",
                                        "label": "1211 Furniture and Equipment",
                                        "metadata": {
                                          "accounts": [
                                            "acc_J8UNTwrVoTU43WLwfbdjPs"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_J8UNTwrVoTU43WLwfbdjPs",
                                          "label": "Total 1211 Furniture and Equipment",
                                          "metadata": {
                                            "accounts": [
                                              "acc_J8UNTwrVoTU43WLwfbdjPs"
                                            ]
                                          },
                                          "sub_totals": [
                                            0,
                                            0,
                                            18358.19,
                                            -1031.05,
                                            13958.55
                                          ]
                                        },
                                        "values": [
                                          0,
                                          0,
                                          18358.19,
                                          -1031.05,
                                          13958.55
                                        ]
                                      },
                                      {
                                        "children": [],
                                        "id": "acc_8YNsdkYehwd3VYYidHPH7U",
                                        "label": "1212 Accumulated depreciation",
                                        "metadata": {
                                          "accounts": [
                                            "acc_8YNsdkYehwd3VYYidHPH7U"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_8YNsdkYehwd3VYYidHPH7U",
                                          "label": "Total 1212 Accumulated depreciation",
                                          "metadata": {
                                            "accounts": [
                                              "acc_8YNsdkYehwd3VYYidHPH7U"
                                            ]
                                          },
                                          "sub_totals": [
                                            0,
                                            0,
                                            -2586.36,
                                            -9600.72,
                                            -19709.75
                                          ]
                                        },
                                        "values": [
                                          0,
                                          0,
                                          -2586.36,
                                          -9600.72,
                                          -19709.75
                                        ]
                                      }
                                    ],
                                    "id": "acc_U48EC5Q6TyhxgyH6G33D58",
                                    "label": "121 Fixed Asset",
                                    "metadata": {
                                      "accounts": [
                                        "acc_U48EC5Q6TyhxgyH6G33D58"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_U48EC5Q6TyhxgyH6G33D58",
                                      "label": "Total 121 Fixed Asset",
                                      "metadata": {
                                        "accounts": [
                                          "acc_U48EC5Q6TyhxgyH6G33D58",
                                          "acc_J8UNTwrVoTU43WLwfbdjPs",
                                          "acc_8YNsdkYehwd3VYYidHPH7U"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        30409.75,
                                        -45286.33,
                                        -67762.32
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      14637.92,
                                      -34654.56,
                                      -62011.12
                                    ]
                                  }
                                ],
                                "group": "NON_CURRENT_ASSET",
                                "id": "NON_CURRENT_ASSET",
                                "label": "Non-Current Assets",
                                "metadata": {
                                  "sub_classification": [
                                    "NON_CURRENT_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_non_current_asset",
                                  "label": "Total Non-Current Assets",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    30409.75,
                                    -45286.33,
                                    -67762.32
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "FIXED_ASSET",
                                "id": "FIXED_ASSET",
                                "label": "Fixed Asset",
                                "metadata": {
                                  "sub_classification": [
                                    "FIXED_ASSET"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_fixed_asset",
                                  "label": "Total Fixed Asset",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              }
                            ],
                            "group": "ASSET",
                            "id": "ASSET",
                            "label": "Asset",
                            "metadata": {
                              "classification": [
                                "ASSET"
                              ]
                            },
                            "summary": {
                              "id": "summary_asset",
                              "label": "Total Asset",
                              "metadata": {},
                              "sub_totals": [
                                0,
                                0,
                                -6067309.78,
                                -15878057.08,
                                -40492151.84
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_mKPWnKLxQtFW6Y4PqPUGRj",
                                    "label": "211 Accounts Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_mKPWnKLxQtFW6Y4PqPUGRj"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_mKPWnKLxQtFW6Y4PqPUGRj",
                                      "label": "Total 211 Accounts Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_mKPWnKLxQtFW6Y4PqPUGRj"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        12451783.23,
                                        -410366.36,
                                        -6377641.35
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      12451783.23,
                                      -410366.36,
                                      -6377641.35
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_Q3fdJQMRW6rMKysBXWEahM",
                                    "label": "2110 VAT Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Q3fdJQMRW6rMKysBXWEahM"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Q3fdJQMRW6rMKysBXWEahM",
                                      "label": "Total 2110 VAT Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Q3fdJQMRW6rMKysBXWEahM"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        -27442.14,
                                        -36238.7,
                                        -42176.2
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      -27442.14,
                                      -36238.7,
                                      -42176.2
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_NCWL4ykpHArD3TxyrwNXME",
                                    "label": "2111 Zakat Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_NCWL4ykpHArD3TxyrwNXME"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_NCWL4ykpHArD3TxyrwNXME",
                                      "label": "Total 2111 Zakat Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_NCWL4ykpHArD3TxyrwNXME"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        4931.94,
                                        46720.76,
                                        31203.83
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      4931.94,
                                      46720.76,
                                      31203.83
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_PLpCz5Su6dEx2yyWFtgbCJ",
                                    "label": "212 Unearned Revenue",
                                    "metadata": {
                                      "accounts": [
                                        "acc_PLpCz5Su6dEx2yyWFtgbCJ"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_PLpCz5Su6dEx2yyWFtgbCJ",
                                      "label": "Total 212 Unearned Revenue",
                                      "metadata": {
                                        "accounts": [
                                          "acc_PLpCz5Su6dEx2yyWFtgbCJ"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        3461.99,
                                        1046.45,
                                        26482.5
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      3461.99,
                                      1046.45,
                                      26482.5
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_QWcAzxLX75xhsteWfJJx2W",
                                    "label": "213 Opening Balance Adjustments",
                                    "metadata": {
                                      "accounts": [
                                        "acc_QWcAzxLX75xhsteWfJJx2W"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_QWcAzxLX75xhsteWfJJx2W",
                                      "label": "Total 213 Opening Balance Adjustments",
                                      "metadata": {
                                        "accounts": [
                                          "acc_QWcAzxLX75xhsteWfJJx2W"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        24835.77,
                                        6976.66,
                                        -9923.51
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      24835.77,
                                      6976.66,
                                      -9923.51
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_RZ5i6UrgdqjM3vCb6C7Afq",
                                    "label": "214 Payroll Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_RZ5i6UrgdqjM3vCb6C7Afq"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_RZ5i6UrgdqjM3vCb6C7Afq",
                                      "label": "Total 214 Payroll Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_RZ5i6UrgdqjM3vCb6C7Afq"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        -22748.53,
                                        -84066.37,
                                        8137.08
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      -22748.53,
                                      -84066.37,
                                      8137.08
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_FXVTPCCw7XxaLYZu4bAiFX",
                                    "label": "215 Loan from Owner",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FXVTPCCw7XxaLYZu4bAiFX"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_FXVTPCCw7XxaLYZu4bAiFX",
                                      "label": "Total 215 Loan from Owner",
                                      "metadata": {
                                        "accounts": [
                                          "acc_FXVTPCCw7XxaLYZu4bAiFX"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        -2089.45,
                                        7431.69,
                                        1577.24
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      -2089.45,
                                      7431.69,
                                      1577.24
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_KqJ4Y5RkJJTZD4Yny5wPqM",
                                    "label": "216 Employee Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_KqJ4Y5RkJJTZD4Yny5wPqM"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_KqJ4Y5RkJJTZD4Yny5wPqM",
                                      "label": "Total 216 Employee Reimbursements",
                                      "metadata": {
                                        "accounts": [
                                          "acc_KqJ4Y5RkJJTZD4Yny5wPqM"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        135269.28,
                                        262434.61,
                                        211704.69
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      135269.28,
                                      262434.61,
                                      211704.69
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_iK82tinMxEHurtaLtxMbxC",
                                    "label": "218 VAT",
                                    "metadata": {
                                      "accounts": [
                                        "acc_iK82tinMxEHurtaLtxMbxC"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_iK82tinMxEHurtaLtxMbxC",
                                      "label": "Total 218 VAT",
                                      "metadata": {
                                        "accounts": [
                                          "acc_iK82tinMxEHurtaLtxMbxC"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        18860.24,
                                        -51819.29,
                                        92798.47
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      18860.24,
                                      -51819.29,
                                      92798.47
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_eytk8Kh5mcqehRPGyBCu2h",
                                    "label": "219 Excise Tax Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_eytk8Kh5mcqehRPGyBCu2h"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_eytk8Kh5mcqehRPGyBCu2h",
                                      "label": "Total 219 Excise Tax Payable",
                                      "metadata": {
                                        "accounts": [
                                          "acc_eytk8Kh5mcqehRPGyBCu2h"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        4973.73,
                                        17282.43,
                                        2853.02
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      4973.73,
                                      17282.43,
                                      2853.02
                                    ]
                                  }
                                ],
                                "group": "CURRENT_LIABILITY",
                                "id": "CURRENT_LIABILITY",
                                "label": "Current Liabilities",
                                "metadata": {
                                  "sub_classification": [
                                    "CURRENT_LIABILITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_current_liability",
                                  "label": "Total Current Liabilities",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    12591836.06,
                                    -240598.12,
                                    -6054984.23
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "NON_CURRENT_LIABILITY",
                                "id": "NON_CURRENT_LIABILITY",
                                "label": "Non-Current Liabilities",
                                "metadata": {
                                  "sub_classification": [
                                    "NON_CURRENT_LIABILITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_non_current_liability",
                                  "label": "Total Non-Current Liabilities",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              }
                            ],
                            "group": "LIABILITY",
                            "id": "LIABILITY",
                            "label": "Liability",
                            "metadata": {
                              "classification": [
                                "LIABILITY"
                              ]
                            },
                            "summary": {
                              "id": "summary_liability",
                              "label": "Total Liability",
                              "metadata": {},
                              "sub_totals": [
                                0,
                                0,
                                12591836.06,
                                -240598.12,
                                -6054984.23
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [],
                                "group": "PAID_IN_CAPITAL",
                                "id": "PAID_IN_CAPITAL",
                                "label": "Paid-in Capital",
                                "metadata": {
                                  "sub_classification": [
                                    "PAID_IN_CAPITAL"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_paid_in_capital",
                                  "label": "Total Paid-in Capital",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_dfsjNx9aVhTiwoDNbd86gD",
                                    "label": "331 Retained Earnings",
                                    "metadata": {
                                      "accounts": [
                                        "acc_dfsjNx9aVhTiwoDNbd86gD"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_dfsjNx9aVhTiwoDNbd86gD",
                                      "label": "Total 331 Retained Earnings",
                                      "metadata": {
                                        "accounts": [
                                          "acc_dfsjNx9aVhTiwoDNbd86gD"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        -18662406.74,
                                        -15583336.68,
                                        -34293675.17
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      -18662406.74,
                                      -15583336.68,
                                      -34293675.17
                                    ]
                                  }
                                ],
                                "group": "RETAINED_EARNINGS",
                                "id": "RETAINED_EARNINGS",
                                "label": "Retained Earnings",
                                "metadata": {
                                  "sub_classification": [
                                    "RETAINED_EARNINGS"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_retained_earnings",
                                  "label": "Total Retained Earnings",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    -18662406.74,
                                    -15583336.68,
                                    -34293675.17
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_Em3zUsJywGuHE5rKEsuuKQ",
                                    "label": "341 Accumulated Unrealized Gains and Losses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Em3zUsJywGuHE5rKEsuuKQ"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_Em3zUsJywGuHE5rKEsuuKQ",
                                      "label": "Total 341 Accumulated Unrealized Gains and Losses",
                                      "metadata": {
                                        "accounts": [
                                          "acc_Em3zUsJywGuHE5rKEsuuKQ"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        8833.51,
                                        14974.69,
                                        -12334.5
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      8833.51,
                                      14974.69,
                                      -12334.5
                                    ]
                                  }
                                ],
                                "group": "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME",
                                "id": "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME",
                                "label": "Acc. Other Comprehensive Income",
                                "metadata": {
                                  "sub_classification": [
                                    "ACCUMULATED_OTHER_COMPREHENSIVE_INCOME"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_accumulated_other_comprehensive_income",
                                  "label": "Total Acc. Other Comprehensive Income",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    8833.51,
                                    14974.69,
                                    -12334.5
                                  ]
                                }
                              },
                              {
                                "children": [],
                                "group": "TREASURY_STOCK",
                                "id": "TREASURY_STOCK",
                                "label": "Treasury Stock",
                                "metadata": {
                                  "sub_classification": [
                                    "TREASURY_STOCK"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_treasury_stock",
                                  "label": "Total Treasury Stock",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    0
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_fgsheVKKUH4rpnxmrmifx9",
                                    "label": "321 Owner's Equity",
                                    "metadata": {
                                      "accounts": [
                                        "acc_fgsheVKKUH4rpnxmrmifx9"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_fgsheVKKUH4rpnxmrmifx9",
                                      "label": "Total 321 Owner's Equity",
                                      "metadata": {
                                        "accounts": [
                                          "acc_fgsheVKKUH4rpnxmrmifx9"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        10749.36,
                                        20428.63,
                                        32899
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      10749.36,
                                      20428.63,
                                      32899
                                    ]
                                  },
                                  {
                                    "children": [],
                                    "id": "acc_2Jxnxb8wRjXM9BXVuv22rV",
                                    "label": "322 Drawings",
                                    "metadata": {
                                      "accounts": [
                                        "acc_2Jxnxb8wRjXM9BXVuv22rV"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_2Jxnxb8wRjXM9BXVuv22rV",
                                      "label": "Total 322 Drawings",
                                      "metadata": {
                                        "accounts": [
                                          "acc_2Jxnxb8wRjXM9BXVuv22rV"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        -19244.69,
                                        -45388.76,
                                        -63322.84
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      -19244.69,
                                      -45388.76,
                                      -63322.84
                                    ]
                                  }
                                ],
                                "group": "OWNERS_EQUITY",
                                "id": "OWNERS_EQUITY",
                                "label": "Owner's Equity",
                                "metadata": {
                                  "sub_classification": [
                                    "OWNERS_EQUITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_owners_equity",
                                  "label": "Total Owner's Equity",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    -8495.33,
                                    -24960.13,
                                    -30423.84
                                  ]
                                }
                              },
                              {
                                "children": [
                                  {
                                    "children": [],
                                    "id": "acc_izB9fj3oW7X8HYceWFy44Y",
                                    "label": "311 Opening Balance Offset",
                                    "metadata": {
                                      "accounts": [
                                        "acc_izB9fj3oW7X8HYceWFy44Y"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_izB9fj3oW7X8HYceWFy44Y",
                                      "label": "Total 311 Opening Balance Offset",
                                      "metadata": {
                                        "accounts": [
                                          "acc_izB9fj3oW7X8HYceWFy44Y"
                                        ]
                                      },
                                      "sub_totals": [
                                        0,
                                        0,
                                        -15.4,
                                        7012.52,
                                        -12367.47
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      -15.4,
                                      7012.52,
                                      -12367.47
                                    ]
                                  }
                                ],
                                "group": "OPENING_BALANCE_EQUITY",
                                "id": "OPENING_BALANCE_EQUITY",
                                "label": "Opening Balance Equity",
                                "metadata": {
                                  "sub_classification": [
                                    "OPENING_BALANCE_EQUITY"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_opening_balance_equity",
                                  "label": "Total Opening Balance Equity",
                                  "metadata": {},
                                  "sub_totals": [
                                    0,
                                    0,
                                    -15.4,
                                    7012.52,
                                    -12367.47
                                  ]
                                }
                              }
                            ],
                            "group": "EQUITY",
                            "id": "EQUITY",
                            "label": "Equity",
                            "metadata": {
                              "classification": [
                                "EQUITY"
                              ]
                            },
                            "summary": {
                              "id": "summary_equity",
                              "label": "Total Equity",
                              "metadata": {},
                              "sub_totals": [
                                0,
                                0,
                                -18662083.96,
                                -15586309.6,
                                -34348800.98
                              ]
                            }
                          }
                        ]
                      }
                    ]
                  }
                },
                "schema": {
                  "items": {
                    "$ref": "#/components/schemas/api-v1-external-reports-balance-sheet-read"
                  },
                  "type": "array"
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
        "summary": "Balance Sheet\n",
        "tags": [
          "Reports"
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