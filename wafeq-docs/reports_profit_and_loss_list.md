---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Profit and Loss


Generate profit and loss report in `currency` from `date_after` to `date_before` range and group it by `group_by` parameter.


# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "api-v1-external-reports-profit-and-loss-data-read": {
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
                "$ref": "#/components/schemas/api-v1-external-reports-profit-and-loss-row-summary-read"
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
      "api-v1-external-reports-profit-and-loss-overview-read": {
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
          "date_from": {
            "description": "The start date of the report",
            "format": "date",
            "type": "string"
          },
          "date_to": {
            "description": "The end date of the report",
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
            "default": "profit_and_loss",
            "description": "The id of the report",
            "readOnly": true,
            "type": "string"
          },
          "label": {
            "default": "Profit and Loss Report",
            "description": "The title of the report",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "created_ts",
          "currency",
          "date_from",
          "date_to",
          "filters",
          "group_by",
          "id",
          "label"
        ],
        "type": "object"
      },
      "api-v1-external-reports-profit-and-loss-read": {
        "properties": {
          "columns": {
            "description": "The columns of the report",
            "items": {
              "$ref": "#/components/schemas/api-v1-external-reports-profit-and-loss-row-column-read"
            },
            "type": "array"
          },
          "overview": {
            "allOf": [
              {
                "$ref": "#/components/schemas/api-v1-external-reports-profit-and-loss-overview-read"
              }
            ],
            "description": "The overview of the report"
          },
          "rows": {
            "description": "The rows of the report",
            "items": {
              "$ref": "#/components/schemas/api-v1-external-reports-profit-and-loss-section-read"
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
      "api-v1-external-reports-profit-and-loss-row-column-read": {
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
      "api-v1-external-reports-profit-and-loss-row-summary-read": {
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
      "api-v1-external-reports-profit-and-loss-section-read": {
        "properties": {
          "children": {
            "description": "The children of the section",
            "items": {
              "$ref": "#/components/schemas/api-v1-external-reports-profit-and-loss-data-read"
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
                "$ref": "#/components/schemas/api-v1-external-reports-profit-and-loss-row-summary-read"
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
    "/reports/profit-and-loss/": {
      "get": {
        "description": "Generate profit and loss report in `currency` from `date_after` to `date_before` range and group it by `group_by` parameter.\n",
        "operationId": "reports_profit_and_loss_list",
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
            "description": "The unique identifier of the cost center. Multiple values may be provided. The special value '__null__' may be provided to filter for null values.",
            "explode": false,
            "in": "query",
            "name": "cost_center__in",
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
            "description": "The period start date of the report. Must be the first day of the month/year.",
            "in": "query",
            "name": "date_after",
            "required": true,
            "schema": {
              "format": "date",
              "type": "string"
            }
          },
          {
            "description": "The period end date of the report. Must be the last day of the month/year.",
            "in": "query",
            "name": "date_before",
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
                            "id": "2022-04-01",
                            "label": "Apr 2022",
                            "metadata": {
                              "from_date": "2022-04-01",
                              "to_date": "2022-04-30"
                            }
                          },
                          {
                            "id": "2022-05-01",
                            "label": "May 2022",
                            "metadata": {
                              "from_date": "2022-05-01",
                              "to_date": "2022-05-31"
                            }
                          },
                          {
                            "id": "2022-06-01",
                            "label": "Jun 2022",
                            "metadata": {
                              "from_date": "2022-06-01",
                              "to_date": "2022-06-30"
                            }
                          },
                          {
                            "id": "2022-07-01",
                            "label": "Jul 2022",
                            "metadata": {
                              "from_date": "2022-07-01",
                              "to_date": "2022-07-31"
                            }
                          },
                          {
                            "id": "2022-08-01",
                            "label": "Aug 2022",
                            "metadata": {
                              "from_date": "2022-08-01",
                              "to_date": "2022-08-31"
                            }
                          },
                          {
                            "id": "2022-09-01",
                            "label": "Sep 2022",
                            "metadata": {
                              "from_date": "2022-09-01",
                              "to_date": "2022-09-30"
                            }
                          },
                          {
                            "id": "row_totals",
                            "label": "الإجمالي",
                            "metadata": {
                              "from_date": "2022-04-01",
                              "to_date": "2022-09-30"
                            }
                          }
                        ],
                        "overview": {
                          "created_ts": "2024-01-05T00:00:00Z",
                          "currency": "SAR",
                          "date_from": "2022-04-01",
                          "date_to": "2022-09-30",
                          "filters": {},
                          "group_by": "month",
                          "id": "profit_and_loss",
                          "label": "تقرير قائمة الدخل"
                        },
                        "rows": [
                          {
                            "children": [
                              {
                                "children": [],
                                "id": "acc_GwwXGSvDi2nHKCecyxXexo",
                                "label": "2663 GB31PYKS95133433234680",
                                "metadata": {
                                  "accounts": [
                                    "acc_GwwXGSvDi2nHKCecyxXexo"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_GwwXGSvDi2nHKCecyxXexo",
                                  "label": "إجمالي 2663 GB31PYKS95133433234680",
                                  "metadata": {
                                    "accounts": [
                                      "acc_GwwXGSvDi2nHKCecyxXexo"
                                    ]
                                  },
                                  "sub_totals": [
                                    -1461.78,
                                    -1091648.66,
                                    -3451.62,
                                    629.41,
                                    0,
                                    -356028.9,
                                    -1451961.55
                                  ]
                                },
                                "values": [
                                  -1461.78,
                                  -1091648.66,
                                  -3451.62,
                                  629.41,
                                  0,
                                  -356028.9,
                                  -1451961.55
                                ]
                              },
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_h3mudXDb52V9naLfh9DVBi",
                                            "label": "2191 الوعري Ltd",
                                            "metadata": {
                                              "accounts": [
                                                "acc_h3mudXDb52V9naLfh9DVBi"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_h3mudXDb52V9naLfh9DVBi",
                                              "label": "إجمالي 2191 الوعري Ltd",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_h3mudXDb52V9naLfh9DVBi"
                                                ]
                                              },
                                              "sub_totals": [
                                                -3426.08,
                                                0,
                                                23213.59,
                                                -7306.34,
                                                -195521.05,
                                                -11997.51,
                                                -195037.39
                                              ]
                                            },
                                            "values": [
                                              -3426.08,
                                              0,
                                              23213.59,
                                              -7306.34,
                                              -195521.05,
                                              -11997.51,
                                              -195037.39
                                            ]
                                          }
                                        ],
                                        "id": "acc_8dXpkHH9yHGwpfKmiNx8HA",
                                        "label": "6883 قريش and Sons",
                                        "metadata": {
                                          "accounts": [
                                            "acc_8dXpkHH9yHGwpfKmiNx8HA"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_8dXpkHH9yHGwpfKmiNx8HA",
                                          "label": "إجمالي 6883 قريش and Sons",
                                          "metadata": {
                                            "accounts": [
                                              "acc_8dXpkHH9yHGwpfKmiNx8HA",
                                              "acc_h3mudXDb52V9naLfh9DVBi"
                                            ]
                                          },
                                          "sub_totals": [
                                            -1510254.41,
                                            37533.15,
                                            22503.38,
                                            681.34,
                                            -210632.53,
                                            -9083.53,
                                            -1669252.6
                                          ]
                                        },
                                        "values": [
                                          -1506828.33,
                                          37533.15,
                                          -710.21,
                                          7987.68,
                                          -15111.48,
                                          2913.98,
                                          -1474215.21
                                        ]
                                      }
                                    ],
                                    "id": "acc_SUpT3JjnPj44pXGyVLM2T9",
                                    "label": "3232 متني, العسلي and الحكم بن سعد العشيرة",
                                    "metadata": {
                                      "accounts": [
                                        "acc_SUpT3JjnPj44pXGyVLM2T9"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_SUpT3JjnPj44pXGyVLM2T9",
                                      "label": "إجمالي 3232 متني, العسلي and الحكم بن سعد العشيرة",
                                      "metadata": {
                                        "accounts": [
                                          "acc_SUpT3JjnPj44pXGyVLM2T9",
                                          "acc_8dXpkHH9yHGwpfKmiNx8HA"
                                        ]
                                      },
                                      "sub_totals": [
                                        -1509290.33,
                                        44266.21,
                                        22503.38,
                                        68078.16,
                                        -210632.53,
                                        -5519.04,
                                        -1590594.15
                                      ]
                                    },
                                    "values": [
                                      964.08,
                                      6733.06,
                                      0,
                                      67396.82,
                                      0,
                                      3564.49,
                                      78658.45
                                    ]
                                  }
                                ],
                                "id": "acc_3aMMeaGLXEj2nkBBkTAXCh",
                                "label": "7066 أكلب Ltd",
                                "metadata": {
                                  "accounts": [
                                    "acc_3aMMeaGLXEj2nkBBkTAXCh"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_3aMMeaGLXEj2nkBBkTAXCh",
                                  "label": "إجمالي 7066 أكلب Ltd",
                                  "metadata": {
                                    "accounts": [
                                      "acc_3aMMeaGLXEj2nkBBkTAXCh",
                                      "acc_SUpT3JjnPj44pXGyVLM2T9"
                                    ]
                                  },
                                  "sub_totals": [
                                    -1563515.98,
                                    50918.05,
                                    63173.18,
                                    66687.9,
                                    -211290.96,
                                    -5519.04,
                                    -1599546.85
                                  ]
                                },
                                "values": [
                                  -54225.65,
                                  6651.84,
                                  40669.8,
                                  -1390.26,
                                  -658.43,
                                  0,
                                  -8952.7
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Bv3z5sii7aXDhxXZV8Sqrb",
                                "label": "8899 GB42DLQG70743971530332",
                                "metadata": {
                                  "accounts": [
                                    "acc_Bv3z5sii7aXDhxXZV8Sqrb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Bv3z5sii7aXDhxXZV8Sqrb",
                                  "label": "إجمالي 8899 GB42DLQG70743971530332",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Bv3z5sii7aXDhxXZV8Sqrb"
                                    ]
                                  },
                                  "sub_totals": [
                                    -506.74,
                                    -193.63,
                                    -15801.16,
                                    475.95,
                                    -4909.64,
                                    -1009.61,
                                    -21944.83
                                  ]
                                },
                                "values": [
                                  -506.74,
                                  -193.63,
                                  -15801.16,
                                  475.95,
                                  -4909.64,
                                  -1009.61,
                                  -21944.83
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_EVeNzPbZXnnCiidM4mGcbf",
                                "label": "9694 GB43IVCI82994294137386",
                                "metadata": {
                                  "accounts": [
                                    "acc_EVeNzPbZXnnCiidM4mGcbf"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_EVeNzPbZXnnCiidM4mGcbf",
                                  "label": "إجمالي 9694 GB43IVCI82994294137386",
                                  "metadata": {
                                    "accounts": [
                                      "acc_EVeNzPbZXnnCiidM4mGcbf"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    -77868.52,
                                    -2688.61,
                                    0,
                                    -613.45,
                                    -4178.2,
                                    -85348.78
                                  ]
                                },
                                "values": [
                                  0,
                                  -77868.52,
                                  -2688.61,
                                  0,
                                  -613.45,
                                  -4178.2,
                                  -85348.78
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_fGZ5RrRSas7k46FFk3U5rb",
                                "label": "411 مبيعات",
                                "metadata": {
                                  "accounts": [
                                    "acc_fGZ5RrRSas7k46FFk3U5rb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fGZ5RrRSas7k46FFk3U5rb",
                                  "label": "إجمالي 411 مبيعات",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fGZ5RrRSas7k46FFk3U5rb"
                                    ]
                                  },
                                  "sub_totals": [
                                    -2581.15,
                                    -48284.91,
                                    799.49,
                                    -8848.63,
                                    4342.74,
                                    -2274.52,
                                    -56846.98
                                  ]
                                },
                                "values": [
                                  -2581.15,
                                  -48284.91,
                                  799.49,
                                  -8848.63,
                                  4342.74,
                                  -2274.52,
                                  -56846.98
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_nGFXazi6c3BBLg6Rs8564P",
                                "label": "412 الايرادات من الفائدة",
                                "metadata": {
                                  "accounts": [
                                    "acc_nGFXazi6c3BBLg6Rs8564P"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_nGFXazi6c3BBLg6Rs8564P",
                                  "label": "إجمالي 412 الايرادات من الفائدة",
                                  "metadata": {
                                    "accounts": [
                                      "acc_nGFXazi6c3BBLg6Rs8564P"
                                    ]
                                  },
                                  "sub_totals": [
                                    58670.18,
                                    0,
                                    0,
                                    3795621.24,
                                    151522.75,
                                    734.85,
                                    4006549.02
                                  ]
                                },
                                "values": [
                                  58670.18,
                                  0,
                                  0,
                                  3795621.24,
                                  151522.75,
                                  734.85,
                                  4006549.02
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_n8DgFgrhEP6qPkVEb8meu3",
                                "label": "413 دخل الرسوم المتأخرة",
                                "metadata": {
                                  "accounts": [
                                    "acc_n8DgFgrhEP6qPkVEb8meu3"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_n8DgFgrhEP6qPkVEb8meu3",
                                  "label": "إجمالي 413 دخل الرسوم المتأخرة",
                                  "metadata": {
                                    "accounts": [
                                      "acc_n8DgFgrhEP6qPkVEb8meu3"
                                    ]
                                  },
                                  "sub_totals": [
                                    569.16,
                                    992.34,
                                    -4996.8,
                                    1313.9,
                                    156.48,
                                    -169490.55,
                                    -171455.47
                                  ]
                                },
                                "values": [
                                  569.16,
                                  992.34,
                                  -4996.8,
                                  1313.9,
                                  156.48,
                                  -169490.55,
                                  -171455.47
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_AkTASCAaMJtamv9NY8Qys5",
                                "label": "414 رسوم الشحن",
                                "metadata": {
                                  "accounts": [
                                    "acc_AkTASCAaMJtamv9NY8Qys5"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_AkTASCAaMJtamv9NY8Qys5",
                                  "label": "إجمالي 414 رسوم الشحن",
                                  "metadata": {
                                    "accounts": [
                                      "acc_AkTASCAaMJtamv9NY8Qys5"
                                    ]
                                  },
                                  "sub_totals": [
                                    -49.83,
                                    0,
                                    -2325.81,
                                    0,
                                    -94868.61,
                                    1120.67,
                                    -96123.58
                                  ]
                                },
                                "values": [
                                  -49.83,
                                  0,
                                  -2325.81,
                                  0,
                                  -94868.61,
                                  1120.67,
                                  -96123.58
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_WCU3XXtzqSVs9AVwmbv3Ro",
                                "label": "415 رسوم أخرى",
                                "metadata": {
                                  "accounts": [
                                    "acc_WCU3XXtzqSVs9AVwmbv3Ro"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_WCU3XXtzqSVs9AVwmbv3Ro",
                                  "label": "إجمالي 415 رسوم أخرى",
                                  "metadata": {
                                    "accounts": [
                                      "acc_WCU3XXtzqSVs9AVwmbv3Ro"
                                    ]
                                  },
                                  "sub_totals": [
                                    1057.12,
                                    -908252.51,
                                    1857.26,
                                    -776.35,
                                    -5706.54,
                                    -6742.1,
                                    -918563.12
                                  ]
                                },
                                "values": [
                                  1057.12,
                                  -908252.51,
                                  1857.26,
                                  -776.35,
                                  -5706.54,
                                  -6742.1,
                                  -918563.12
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_A86ZVhuCEZU7bCgJ3pAhZR",
                                "label": "416 خصم",
                                "metadata": {
                                  "accounts": [
                                    "acc_A86ZVhuCEZU7bCgJ3pAhZR"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_A86ZVhuCEZU7bCgJ3pAhZR",
                                  "label": "إجمالي 416 خصم",
                                  "metadata": {
                                    "accounts": [
                                      "acc_A86ZVhuCEZU7bCgJ3pAhZR"
                                    ]
                                  },
                                  "sub_totals": [
                                    -26625.23,
                                    0,
                                    -23960.35,
                                    -68.41,
                                    -35541.53,
                                    -49.94,
                                    -86245.46
                                  ]
                                },
                                "values": [
                                  -26625.23,
                                  0,
                                  -23960.35,
                                  -68.41,
                                  -35541.53,
                                  -49.94,
                                  -86245.46
                                ]
                              }
                            ],
                            "group": "INCOME",
                            "id": "INCOME",
                            "label": "دخل",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME"
                              ]
                            },
                            "summary": {
                              "id": "summary_income",
                              "label": "إجمالي دخل",
                              "metadata": {},
                              "sub_totals": [
                                -1479214.16,
                                -918011.93,
                                -6122.83,
                                3787923.09,
                                -190727.24,
                                -185785.12,
                                1008061.81
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [
                                              {
                                                "children": [],
                                                "id": "acc_hV2CkyYXmZXvy2iKQz2yei",
                                                "label": "1624 الموركة-الدليم",
                                                "metadata": {
                                                  "accounts": [
                                                    "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                  ]
                                                },
                                                "summary": {
                                                  "id": "summary_acc_hV2CkyYXmZXvy2iKQz2yei",
                                                  "label": "إجمالي 1624 الموركة-الدليم",
                                                  "metadata": {
                                                    "accounts": [
                                                      "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                    ]
                                                  },
                                                  "sub_totals": [
                                                    -120.49,
                                                    0,
                                                    0,
                                                    6943.37,
                                                    -1383.16,
                                                    88088.55,
                                                    93528.27
                                                  ]
                                                },
                                                "values": [
                                                  -120.49,
                                                  0,
                                                  0,
                                                  6943.37,
                                                  -1383.16,
                                                  88088.55,
                                                  93528.27
                                                ]
                                              }
                                            ],
                                            "id": "acc_2mxViQpX3regpQSrcWqCM2",
                                            "label": "5430 زلاطيمو, الكثيري and بنو زيد",
                                            "metadata": {
                                              "accounts": [
                                                "acc_2mxViQpX3regpQSrcWqCM2"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_2mxViQpX3regpQSrcWqCM2",
                                              "label": "إجمالي 5430 زلاطيمو, الكثيري and بنو زيد",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_2mxViQpX3regpQSrcWqCM2",
                                                  "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                ]
                                              },
                                              "sub_totals": [
                                                6848.49,
                                                0,
                                                0,
                                                -29190.4,
                                                -1227.09,
                                                87546.8,
                                                63977.8
                                              ]
                                            },
                                            "values": [
                                              6968.98,
                                              0,
                                              0,
                                              -36133.77,
                                              156.07,
                                              -541.75,
                                              -29550.47
                                            ]
                                          }
                                        ],
                                        "id": "acc_hEGoCD9ffFhQepj3srzDVs",
                                        "label": "1245 جبيلي, بني بيات and الكواهلة",
                                        "metadata": {
                                          "accounts": [
                                            "acc_hEGoCD9ffFhQepj3srzDVs"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_hEGoCD9ffFhQepj3srzDVs",
                                          "label": "إجمالي 1245 جبيلي, بني بيات and الكواهلة",
                                          "metadata": {
                                            "accounts": [
                                              "acc_hEGoCD9ffFhQepj3srzDVs",
                                              "acc_2mxViQpX3regpQSrcWqCM2"
                                            ]
                                          },
                                          "sub_totals": [
                                            6848.49,
                                            3340.39,
                                            0,
                                            -30060.46,
                                            7783.6,
                                            88165.49,
                                            76077.51
                                          ]
                                        },
                                        "values": [
                                          0,
                                          3340.39,
                                          0,
                                          -870.06,
                                          9010.69,
                                          618.69,
                                          12099.71
                                        ]
                                      }
                                    ],
                                    "id": "acc_ULicU8jieyR9UuqiM9ovoL",
                                    "label": "6576 الهدمي LLC",
                                    "metadata": {
                                      "accounts": [
                                        "acc_ULicU8jieyR9UuqiM9ovoL"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_ULicU8jieyR9UuqiM9ovoL",
                                      "label": "إجمالي 6576 الهدمي LLC",
                                      "metadata": {
                                        "accounts": [
                                          "acc_ULicU8jieyR9UuqiM9ovoL",
                                          "acc_hEGoCD9ffFhQepj3srzDVs"
                                        ]
                                      },
                                      "sub_totals": [
                                        6419.56,
                                        -5239.98,
                                        -8666.89,
                                        18438.41,
                                        -2868831.78,
                                        88869.74,
                                        -2769010.94
                                      ]
                                    },
                                    "values": [
                                      -428.93,
                                      -8580.37,
                                      -8666.89,
                                      48498.87,
                                      -2876615.38,
                                      704.25,
                                      -2845088.45
                                    ]
                                  }
                                ],
                                "id": "acc_9YNpqmbHjrZN6oFL2SX7jm",
                                "label": "2721 الخلفاوي, يافع and قيس عيلان",
                                "metadata": {
                                  "accounts": [
                                    "acc_9YNpqmbHjrZN6oFL2SX7jm"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_9YNpqmbHjrZN6oFL2SX7jm",
                                  "label": "إجمالي 2721 الخلفاوي, يافع and قيس عيلان",
                                  "metadata": {
                                    "accounts": [
                                      "acc_9YNpqmbHjrZN6oFL2SX7jm",
                                      "acc_ULicU8jieyR9UuqiM9ovoL"
                                    ]
                                  },
                                  "sub_totals": [
                                    6419.56,
                                    -4499.64,
                                    -797.33,
                                    22038.22,
                                    -2858615.87,
                                    122229.29,
                                    -2713225.77
                                  ]
                                },
                                "values": [
                                  0,
                                  740.34,
                                  7869.56,
                                  3599.81,
                                  10215.91,
                                  33359.55,
                                  55785.17
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_dqNwix5yRwuQgB9pzQCjXb",
                                "label": "511 تكلفة البضائع المباعة",
                                "metadata": {
                                  "accounts": [
                                    "acc_dqNwix5yRwuQgB9pzQCjXb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_dqNwix5yRwuQgB9pzQCjXb",
                                  "label": "إجمالي 511 تكلفة البضائع المباعة",
                                  "metadata": {
                                    "accounts": [
                                      "acc_dqNwix5yRwuQgB9pzQCjXb"
                                    ]
                                  },
                                  "sub_totals": [
                                    2777.42,
                                    35169.25,
                                    28066.03,
                                    437621.34,
                                    192605.26,
                                    -588819.6,
                                    107419.7
                                  ]
                                },
                                "values": [
                                  2777.42,
                                  35169.25,
                                  28066.03,
                                  437621.34,
                                  192605.26,
                                  -588819.6,
                                  107419.7
                                ]
                              }
                            ],
                            "group": "COGS",
                            "id": "COGS",
                            "label": "تكاليف المبيعات",
                            "metadata": {
                              "sub_classifications": [
                                "COST_OF_SALES"
                              ]
                            },
                            "summary": {
                              "id": "summary_cogs",
                              "label": "إجمالي تكاليف المبيعات",
                              "metadata": {},
                              "sub_totals": [
                                9625.91,
                                38509.64,
                                28066.03,
                                407560.88,
                                200388.86,
                                -500654.11,
                                183497.21
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "GROSS_MARGIN",
                            "id": "GROSS_MARGIN",
                            "label": "مجمل الربح",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES"
                              ]
                            },
                            "summary": {
                              "id": "summary_gross_margin",
                              "label": "مجمل الربح",
                              "metadata": {},
                              "sub_totals": [
                                -1469588.25,
                                -879502.29,
                                21943.2,
                                4195483.97,
                                9661.62,
                                -686439.23,
                                1191559.02
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_XKZ4X8LGL3CfZGBrMjBsf3",
                                            "label": "8963 صيام-طرابلسي",
                                            "metadata": {
                                              "accounts": [
                                                "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_XKZ4X8LGL3CfZGBrMjBsf3",
                                              "label": "إجمالي 8963 صيام-طرابلسي",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                                ]
                                              },
                                              "sub_totals": [
                                                0,
                                                -2552.59,
                                                -34849.93,
                                                131.02,
                                                -3990847.61,
                                                773.79,
                                                -4027345.32
                                              ]
                                            },
                                            "values": [
                                              0,
                                              -2552.59,
                                              -34849.93,
                                              131.02,
                                              -3990847.61,
                                              773.79,
                                              -4027345.32
                                            ]
                                          }
                                        ],
                                        "id": "acc_ahzp6b9vysnVSND7ezSnbc",
                                        "label": "7810 الداودي-بنو ضمرة",
                                        "metadata": {
                                          "accounts": [
                                            "acc_ahzp6b9vysnVSND7ezSnbc"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_ahzp6b9vysnVSND7ezSnbc",
                                          "label": "إجمالي 7810 الداودي-بنو ضمرة",
                                          "metadata": {
                                            "accounts": [
                                              "acc_ahzp6b9vysnVSND7ezSnbc",
                                              "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                            ]
                                          },
                                          "sub_totals": [
                                            -37.15,
                                            -2422.75,
                                            -176401.38,
                                            -6113.78,
                                            -3988163.45,
                                            58907.1,
                                            -4114231.41
                                          ]
                                        },
                                        "values": [
                                          -37.15,
                                          129.84,
                                          -141551.45,
                                          -6244.8,
                                          2684.16,
                                          58133.31,
                                          -86886.09
                                        ]
                                      }
                                    ],
                                    "id": "acc_54S8UKUaLC7Qz26YxtabHf",
                                    "label": "7545 بنو مهدي, رصاص and شتية",
                                    "metadata": {
                                      "accounts": [
                                        "acc_54S8UKUaLC7Qz26YxtabHf"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_54S8UKUaLC7Qz26YxtabHf",
                                      "label": "إجمالي 7545 بنو مهدي, رصاص and شتية",
                                      "metadata": {
                                        "accounts": [
                                          "acc_54S8UKUaLC7Qz26YxtabHf",
                                          "acc_ahzp6b9vysnVSND7ezSnbc"
                                        ]
                                      },
                                      "sub_totals": [
                                        45832.6,
                                        -2422.75,
                                        -254658.69,
                                        861.51,
                                        -3988849.86,
                                        57961.79,
                                        -4141275.4
                                      ]
                                    },
                                    "values": [
                                      45869.75,
                                      0,
                                      -78257.31,
                                      6975.29,
                                      -686.41,
                                      -945.31,
                                      -27043.99
                                    ]
                                  }
                                ],
                                "id": "acc_W4GP34aBqv9NpwPVPP9Toe",
                                "label": "7049 أشجع, طوطح and طيء",
                                "metadata": {
                                  "accounts": [
                                    "acc_W4GP34aBqv9NpwPVPP9Toe"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_W4GP34aBqv9NpwPVPP9Toe",
                                  "label": "إجمالي 7049 أشجع, طوطح and طيء",
                                  "metadata": {
                                    "accounts": [
                                      "acc_W4GP34aBqv9NpwPVPP9Toe",
                                      "acc_54S8UKUaLC7Qz26YxtabHf"
                                    ]
                                  },
                                  "sub_totals": [
                                    49883.51,
                                    -3629.31,
                                    -246517.79,
                                    832.33,
                                    -4098747.22,
                                    55266.28,
                                    -4242912.2
                                  ]
                                },
                                "values": [
                                  4050.91,
                                  -1206.56,
                                  8140.9,
                                  -29.18,
                                  -109897.36,
                                  -2695.51,
                                  -101636.8
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_GVHuwPnwyLpDUKfLTZm5FL",
                                "label": "521 اللوازم المكتبية",
                                "metadata": {
                                  "accounts": [
                                    "acc_GVHuwPnwyLpDUKfLTZm5FL"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_GVHuwPnwyLpDUKfLTZm5FL",
                                  "label": "إجمالي 521 اللوازم المكتبية",
                                  "metadata": {
                                    "accounts": [
                                      "acc_GVHuwPnwyLpDUKfLTZm5FL"
                                    ]
                                  },
                                  "sub_totals": [
                                    4162.44,
                                    -3255.27,
                                    167877.72,
                                    6009.74,
                                    0,
                                    1010.62,
                                    175805.25
                                  ]
                                },
                                "values": [
                                  4162.44,
                                  -3255.27,
                                  167877.72,
                                  6009.74,
                                  0,
                                  1010.62,
                                  175805.25
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_baw6nBvKaovg6LCwHC3MBV",
                                "label": "5210 مصروف الإيجار",
                                "metadata": {
                                  "accounts": [
                                    "acc_baw6nBvKaovg6LCwHC3MBV"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_baw6nBvKaovg6LCwHC3MBV",
                                  "label": "إجمالي 5210 مصروف الإيجار",
                                  "metadata": {
                                    "accounts": [
                                      "acc_baw6nBvKaovg6LCwHC3MBV"
                                    ]
                                  },
                                  "sub_totals": [
                                    398.6,
                                    -50883.28,
                                    0,
                                    6129.27,
                                    5940.38,
                                    89,
                                    -38326.03
                                  ]
                                },
                                "values": [
                                  398.6,
                                  -50883.28,
                                  0,
                                  6129.27,
                                  5940.38,
                                  89,
                                  -38326.03
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_iVA6wA5eZ3kdCdeRhX8sDA",
                                "label": "5211 مصروفات متعلقة بنظافة المباني",
                                "metadata": {
                                  "accounts": [
                                    "acc_iVA6wA5eZ3kdCdeRhX8sDA"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_iVA6wA5eZ3kdCdeRhX8sDA",
                                  "label": "إجمالي 5211 مصروفات متعلقة بنظافة المباني",
                                  "metadata": {
                                    "accounts": [
                                      "acc_iVA6wA5eZ3kdCdeRhX8sDA"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    43405.5,
                                    -8732.54,
                                    -231.07,
                                    -149798.5,
                                    79840.54,
                                    -35516.07
                                  ]
                                },
                                "values": [
                                  0,
                                  43405.5,
                                  -8732.54,
                                  -231.07,
                                  -149798.5,
                                  79840.54,
                                  -35516.07
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_4g58kJWsPB5RE8khF8yciM",
                                "label": "5212 أجرة البريد",
                                "metadata": {
                                  "accounts": [
                                    "acc_4g58kJWsPB5RE8khF8yciM"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_4g58kJWsPB5RE8khF8yciM",
                                  "label": "إجمالي 5212 أجرة البريد",
                                  "metadata": {
                                    "accounts": [
                                      "acc_4g58kJWsPB5RE8khF8yciM"
                                    ]
                                  },
                                  "sub_totals": [
                                    552.38,
                                    1059769.87,
                                    245475.87,
                                    10152.1,
                                    -30104.09,
                                    254545.39,
                                    1540391.52
                                  ]
                                },
                                "values": [
                                  552.38,
                                  1059769.87,
                                  245475.87,
                                  10152.1,
                                  -30104.09,
                                  254545.39,
                                  1540391.52
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_7FcRGhfmBJH6RrYRJt22yg",
                                "label": "5213 دين معدوم",
                                "metadata": {
                                  "accounts": [
                                    "acc_7FcRGhfmBJH6RrYRJt22yg"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_7FcRGhfmBJH6RrYRJt22yg",
                                  "label": "إجمالي 5213 دين معدوم",
                                  "metadata": {
                                    "accounts": [
                                      "acc_7FcRGhfmBJH6RrYRJt22yg"
                                    ]
                                  },
                                  "sub_totals": [
                                    -1211614.65,
                                    0,
                                    -732.95,
                                    -7412.8,
                                    -23315.47,
                                    -8447.78,
                                    -1251523.65
                                  ]
                                },
                                "values": [
                                  -1211614.65,
                                  0,
                                  -732.95,
                                  -7412.8,
                                  -23315.47,
                                  -8447.78,
                                  -1251523.65
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_4Kv6SsyMC3kNrALkM9qdnr",
                                "label": "5214 الطباعة والقرطاسية",
                                "metadata": {
                                  "accounts": [
                                    "acc_4Kv6SsyMC3kNrALkM9qdnr"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_4Kv6SsyMC3kNrALkM9qdnr",
                                  "label": "إجمالي 5214 الطباعة والقرطاسية",
                                  "metadata": {
                                    "accounts": [
                                      "acc_4Kv6SsyMC3kNrALkM9qdnr"
                                    ]
                                  },
                                  "sub_totals": [
                                    2102.9,
                                    0,
                                    -35.03,
                                    1305.53,
                                    -8884.06,
                                    1869.86,
                                    -3640.8
                                  ]
                                },
                                "values": [
                                  2102.9,
                                  0,
                                  -35.03,
                                  1305.53,
                                  -8884.06,
                                  1869.86,
                                  -3640.8
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_52YCm8dAdMBRkMJj6QRBuW",
                                "label": "5215 رواتب وأجور الموظفين",
                                "metadata": {
                                  "accounts": [
                                    "acc_52YCm8dAdMBRkMJj6QRBuW"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_52YCm8dAdMBRkMJj6QRBuW",
                                  "label": "إجمالي 5215 رواتب وأجور الموظفين",
                                  "metadata": {
                                    "accounts": [
                                      "acc_52YCm8dAdMBRkMJj6QRBuW"
                                    ]
                                  },
                                  "sub_totals": [
                                    130.36,
                                    -575.78,
                                    4528.07,
                                    1089.1,
                                    -456.6,
                                    29200.05,
                                    33915.2
                                  ]
                                },
                                "values": [
                                  130.36,
                                  -575.78,
                                  4528.07,
                                  1089.1,
                                  -456.6,
                                  29200.05,
                                  33915.2
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_9xfmGZghqc2jWTVJ8oVpaE",
                                "label": "5216 مصاريف مستشارية",
                                "metadata": {
                                  "accounts": [
                                    "acc_9xfmGZghqc2jWTVJ8oVpaE"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_9xfmGZghqc2jWTVJ8oVpaE",
                                  "label": "إجمالي 5216 مصاريف مستشارية",
                                  "metadata": {
                                    "accounts": [
                                      "acc_9xfmGZghqc2jWTVJ8oVpaE"
                                    ]
                                  },
                                  "sub_totals": [
                                    -1587.77,
                                    62392.05,
                                    89.09,
                                    6822.39,
                                    3449.68,
                                    -487.88,
                                    70677.56
                                  ]
                                },
                                "values": [
                                  -1587.77,
                                  62392.05,
                                  89.09,
                                  6822.39,
                                  3449.68,
                                  -487.88,
                                  70677.56
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_7v3RharPkEc6YdPy9tXpXP",
                                "label": "5217 الإصلاحات والصيانة",
                                "metadata": {
                                  "accounts": [
                                    "acc_7v3RharPkEc6YdPy9tXpXP"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_7v3RharPkEc6YdPy9tXpXP",
                                  "label": "إجمالي 5217 الإصلاحات والصيانة",
                                  "metadata": {
                                    "accounts": [
                                      "acc_7v3RharPkEc6YdPy9tXpXP"
                                    ]
                                  },
                                  "sub_totals": [
                                    134.66,
                                    -24493.62,
                                    -5852.25,
                                    3864.14,
                                    0,
                                    4495.53,
                                    -21851.54
                                  ]
                                },
                                "values": [
                                  134.66,
                                  -24493.62,
                                  -5852.25,
                                  3864.14,
                                  0,
                                  4495.53,
                                  -21851.54
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_fMrHBpnBAt82XU4JLPnAZD",
                                "label": "522 السكن",
                                "metadata": {
                                  "accounts": [
                                    "acc_fMrHBpnBAt82XU4JLPnAZD"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fMrHBpnBAt82XU4JLPnAZD",
                                  "label": "إجمالي 522 السكن",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fMrHBpnBAt82XU4JLPnAZD"
                                    ]
                                  },
                                  "sub_totals": [
                                    1806.4,
                                    -20896.56,
                                    0,
                                    -2569.05,
                                    9717.53,
                                    12.54,
                                    -11929.14
                                  ]
                                },
                                "values": [
                                  1806.4,
                                  -20896.56,
                                  0,
                                  -2569.05,
                                  9717.53,
                                  12.54,
                                  -11929.14
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_aRQYS3qwV4JBZyUbMcWof8",
                                "label": "523 الإعلان والتسويق",
                                "metadata": {
                                  "accounts": [
                                    "acc_aRQYS3qwV4JBZyUbMcWof8"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_aRQYS3qwV4JBZyUbMcWof8",
                                  "label": "إجمالي 523 الإعلان والتسويق",
                                  "metadata": {
                                    "accounts": [
                                      "acc_aRQYS3qwV4JBZyUbMcWof8"
                                    ]
                                  },
                                  "sub_totals": [
                                    235.91,
                                    -255.87,
                                    0,
                                    40.31,
                                    46920.15,
                                    5636.24,
                                    52576.74
                                  ]
                                },
                                "values": [
                                  235.91,
                                  -255.87,
                                  0,
                                  40.31,
                                  46920.15,
                                  5636.24,
                                  52576.74
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Wkr3kRUkL6f5HVyfekN7YC",
                                "label": "524 الرسوم الإضافية البنكية والمصاريف",
                                "metadata": {
                                  "accounts": [
                                    "acc_Wkr3kRUkL6f5HVyfekN7YC"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Wkr3kRUkL6f5HVyfekN7YC",
                                  "label": "إجمالي 524 الرسوم الإضافية البنكية والمصاريف",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Wkr3kRUkL6f5HVyfekN7YC"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    -2297.88,
                                    0,
                                    12078.27,
                                    41282.01,
                                    -90447.06,
                                    -39384.66
                                  ]
                                },
                                "values": [
                                  0,
                                  -2297.88,
                                  0,
                                  12078.27,
                                  41282.01,
                                  -90447.06,
                                  -39384.66
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Y3Dknxe5CtePp4cDLEfM3H",
                                "label": "525 رسوم بطاقات الائتمان",
                                "metadata": {
                                  "accounts": [
                                    "acc_Y3Dknxe5CtePp4cDLEfM3H"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Y3Dknxe5CtePp4cDLEfM3H",
                                  "label": "إجمالي 525 رسوم بطاقات الائتمان",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Y3Dknxe5CtePp4cDLEfM3H"
                                    ]
                                  },
                                  "sub_totals": [
                                    -356853.19,
                                    0,
                                    -7004.75,
                                    6247.18,
                                    -55464.06,
                                    -135382.72,
                                    -548457.54
                                  ]
                                },
                                "values": [
                                  -356853.19,
                                  0,
                                  -7004.75,
                                  6247.18,
                                  -55464.06,
                                  -135382.72,
                                  -548457.54
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_XP7KMbDzi7rGZQDefcYu9r",
                                "label": "526 تكاليف السفر",
                                "metadata": {
                                  "accounts": [
                                    "acc_XP7KMbDzi7rGZQDefcYu9r"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_XP7KMbDzi7rGZQDefcYu9r",
                                  "label": "إجمالي 526 تكاليف السفر",
                                  "metadata": {
                                    "accounts": [
                                      "acc_XP7KMbDzi7rGZQDefcYu9r"
                                    ]
                                  },
                                  "sub_totals": [
                                    -58879.52,
                                    51184.84,
                                    -136.68,
                                    -2504.68,
                                    -315.72,
                                    8673,
                                    -1978.76
                                  ]
                                },
                                "values": [
                                  -58879.52,
                                  51184.84,
                                  -136.68,
                                  -2504.68,
                                  -315.72,
                                  8673,
                                  -1978.76
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_mzX3EmggUxHc65qqvpo8m9",
                                "label": "527 مصروفات الهاتف",
                                "metadata": {
                                  "accounts": [
                                    "acc_mzX3EmggUxHc65qqvpo8m9"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_mzX3EmggUxHc65qqvpo8m9",
                                  "label": "إجمالي 527 مصروفات الهاتف",
                                  "metadata": {
                                    "accounts": [
                                      "acc_mzX3EmggUxHc65qqvpo8m9"
                                    ]
                                  },
                                  "sub_totals": [
                                    -35868.57,
                                    -3928.73,
                                    980.38,
                                    0,
                                    -16951.76,
                                    0,
                                    -55768.68
                                  ]
                                },
                                "values": [
                                  -35868.57,
                                  -3928.73,
                                  980.38,
                                  0,
                                  -16951.76,
                                  0,
                                  -55768.68
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_nf89ZwyS56JdJG23CHoH36",
                                "label": "528 مصروفات المركبات",
                                "metadata": {
                                  "accounts": [
                                    "acc_nf89ZwyS56JdJG23CHoH36"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_nf89ZwyS56JdJG23CHoH36",
                                  "label": "إجمالي 528 مصروفات المركبات",
                                  "metadata": {
                                    "accounts": [
                                      "acc_nf89ZwyS56JdJG23CHoH36"
                                    ]
                                  },
                                  "sub_totals": [
                                    3307.96,
                                    -9192.25,
                                    -64.44,
                                    380.18,
                                    36.27,
                                    85424.03,
                                    79891.75
                                  ]
                                },
                                "values": [
                                  3307.96,
                                  -9192.25,
                                  -64.44,
                                  380.18,
                                  36.27,
                                  85424.03,
                                  79891.75
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_np2Vi9S7mse3UnzEhs86Wj",
                                "label": "529 البرامج والأدوات",
                                "metadata": {
                                  "accounts": [
                                    "acc_np2Vi9S7mse3UnzEhs86Wj"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_np2Vi9S7mse3UnzEhs86Wj",
                                  "label": "إجمالي 529 البرامج والأدوات",
                                  "metadata": {
                                    "accounts": [
                                      "acc_np2Vi9S7mse3UnzEhs86Wj"
                                    ]
                                  },
                                  "sub_totals": [
                                    383606.79,
                                    0,
                                    245638.16,
                                    0,
                                    0,
                                    -224994.82,
                                    404250.13
                                  ]
                                },
                                "values": [
                                  383606.79,
                                  0,
                                  245638.16,
                                  0,
                                  0,
                                  -224994.82,
                                  404250.13
                                ]
                              }
                            ],
                            "group": "OPERATING_EXPENSE",
                            "id": "OPERATING_EXPENSE",
                            "label": "المصروفات التشغيلية",
                            "metadata": {
                              "sub_classifications": [
                                "OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_operating_expense",
                              "label": "إجمالي المصروفات التشغيلية",
                              "metadata": {},
                              "sub_totals": [
                                -1268402.45,
                                1098550.27,
                                465629.27,
                                35286.83,
                                -4166107.69,
                                69943.64,
                                -3765100.13
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "OPERATING_PROFIT",
                            "id": "OPERATING_PROFIT",
                            "label": "الربح من الأعمال",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES",
                                "OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_operating_profit",
                              "label": "الربح من الأعمال",
                              "metadata": {},
                              "sub_totals": [
                                -2737990.7,
                                219047.98,
                                487572.47,
                                4230770.8,
                                -4156446.07,
                                -616495.59,
                                -2573541.11
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_K8D9SrmdvbYqJCmUuweRce",
                                            "label": "2879 الفتياني, بني عطية and بيرقدار",
                                            "metadata": {
                                              "accounts": [
                                                "acc_K8D9SrmdvbYqJCmUuweRce"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_K8D9SrmdvbYqJCmUuweRce",
                                              "label": "إجمالي 2879 الفتياني, بني عطية and بيرقدار",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_K8D9SrmdvbYqJCmUuweRce"
                                                ]
                                              },
                                              "sub_totals": [
                                                -1175.64,
                                                225517.48,
                                                0,
                                                -2174.04,
                                                0,
                                                -8753.76,
                                                213414.04
                                              ]
                                            },
                                            "values": [
                                              -1175.64,
                                              225517.48,
                                              0,
                                              -2174.04,
                                              0,
                                              -8753.76,
                                              213414.04
                                            ]
                                          }
                                        ],
                                        "id": "acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                        "label": "0196 نجيب-المنتفق",
                                        "metadata": {
                                          "accounts": [
                                            "acc_kjxnhcvAHUCZ9BW8FgPDFk"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                          "label": "إجمالي 0196 نجيب-المنتفق",
                                          "metadata": {
                                            "accounts": [
                                              "acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                              "acc_K8D9SrmdvbYqJCmUuweRce"
                                            ]
                                          },
                                          "sub_totals": [
                                            -1175.64,
                                            183973.51,
                                            1625.31,
                                            -531000.09,
                                            0,
                                            -22502.09,
                                            -369079
                                          ]
                                        },
                                        "values": [
                                          0,
                                          -41543.97,
                                          1625.31,
                                          -528826.05,
                                          0,
                                          -13748.33,
                                          -582493.04
                                        ]
                                      }
                                    ],
                                    "id": "acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                    "label": "1170 الهدمي-شمران",
                                    "metadata": {
                                      "accounts": [
                                        "acc_k7ZD5hrbMmoBBwFVe9ZaNj"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                      "label": "إجمالي 1170 الهدمي-شمران",
                                      "metadata": {
                                        "accounts": [
                                          "acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                          "acc_kjxnhcvAHUCZ9BW8FgPDFk"
                                        ]
                                      },
                                      "sub_totals": [
                                        -12617.1,
                                        105719.3,
                                        -1403.66,
                                        -531028.35,
                                        -353.54,
                                        -22502.69,
                                        -462186.04
                                      ]
                                    },
                                    "values": [
                                      -11441.46,
                                      -78254.21,
                                      -3028.97,
                                      -28.26,
                                      -353.54,
                                      -0.6,
                                      -93107.04
                                    ]
                                  }
                                ],
                                "id": "acc_aVBWoEGdrKhFX57dTuB3v2",
                                "label": "4654 عبيد Group",
                                "metadata": {
                                  "accounts": [
                                    "acc_aVBWoEGdrKhFX57dTuB3v2"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_aVBWoEGdrKhFX57dTuB3v2",
                                  "label": "إجمالي 4654 عبيد Group",
                                  "metadata": {
                                    "accounts": [
                                      "acc_aVBWoEGdrKhFX57dTuB3v2",
                                      "acc_k7ZD5hrbMmoBBwFVe9ZaNj"
                                    ]
                                  },
                                  "sub_totals": [
                                    -12617.1,
                                    139651.49,
                                    -5581.84,
                                    -531028.35,
                                    -353.54,
                                    -19016.53,
                                    -428945.87
                                  ]
                                },
                                "values": [
                                  0,
                                  33932.19,
                                  -4178.18,
                                  0,
                                  0,
                                  3486.16,
                                  33240.17
                                ]
                              }
                            ],
                            "group": "OTHER_INCOME",
                            "id": "OTHER_INCOME",
                            "label": "إيرادات أخرى",
                            "metadata": {
                              "sub_classifications": [
                                "OTHER_INCOME"
                              ]
                            },
                            "summary": {
                              "id": "summary_other_income",
                              "label": "إجمالي إيرادات أخرى",
                              "metadata": {},
                              "sub_totals": [
                                -1175.64,
                                183973.51,
                                1625.31,
                                -531000.09,
                                0,
                                -22502.09,
                                -369079
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [
                                              {
                                                "children": [],
                                                "id": "acc_gpjJY9Crkpdzi49ELUQF6u",
                                                "label": "9558 درويش-أكلب",
                                                "metadata": {
                                                  "accounts": [
                                                    "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                  ]
                                                },
                                                "summary": {
                                                  "id": "summary_acc_gpjJY9Crkpdzi49ELUQF6u",
                                                  "label": "إجمالي 9558 درويش-أكلب",
                                                  "metadata": {
                                                    "accounts": [
                                                      "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                    ]
                                                  },
                                                  "sub_totals": [
                                                    3.22,
                                                    -163283.42,
                                                    -13804.04,
                                                    -2860,
                                                    -1750366.49,
                                                    0,
                                                    -1930310.73
                                                  ]
                                                },
                                                "values": [
                                                  3.22,
                                                  -163283.42,
                                                  -13804.04,
                                                  -2860,
                                                  -1750366.49,
                                                  0,
                                                  -1930310.73
                                                ]
                                              }
                                            ],
                                            "id": "acc_XCry4baixEx2bRfVFDVDDs",
                                            "label": "9065 بنو ضمرة-دوبلال",
                                            "metadata": {
                                              "accounts": [
                                                "acc_XCry4baixEx2bRfVFDVDDs"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_XCry4baixEx2bRfVFDVDDs",
                                              "label": "إجمالي 9065 بنو ضمرة-دوبلال",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_XCry4baixEx2bRfVFDVDDs",
                                                  "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                ]
                                              },
                                              "sub_totals": [
                                                61919.03,
                                                -163080.06,
                                                -13804.04,
                                                -513.67,
                                                -1742127.85,
                                                106502.4,
                                                -1751104.19
                                              ]
                                            },
                                            "values": [
                                              61915.81,
                                              203.36,
                                              0,
                                              2346.33,
                                              8238.64,
                                              106502.4,
                                              179206.54
                                            ]
                                          }
                                        ],
                                        "id": "acc_cFKHf5xHV5VFfj9zWeWK92",
                                        "label": "4192 حرب LLC",
                                        "metadata": {
                                          "accounts": [
                                            "acc_cFKHf5xHV5VFfj9zWeWK92"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_cFKHf5xHV5VFfj9zWeWK92",
                                          "label": "إجمالي 4192 حرب LLC",
                                          "metadata": {
                                            "accounts": [
                                              "acc_cFKHf5xHV5VFfj9zWeWK92",
                                              "acc_XCry4baixEx2bRfVFDVDDs"
                                            ]
                                          },
                                          "sub_totals": [
                                            64680.64,
                                            -163616.98,
                                            -13421.2,
                                            -42654.55,
                                            -1742627.05,
                                            123266.36,
                                            -1774372.78
                                          ]
                                        },
                                        "values": [
                                          2761.61,
                                          -536.92,
                                          382.84,
                                          -42140.88,
                                          -499.2,
                                          16763.96,
                                          -23268.59
                                        ]
                                      }
                                    ],
                                    "id": "acc_dNqQEL5MXEhwcGmrsrdsoU",
                                    "label": "5978 عرموني, شويفاتي and جبيلي",
                                    "metadata": {
                                      "accounts": [
                                        "acc_dNqQEL5MXEhwcGmrsrdsoU"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_dNqQEL5MXEhwcGmrsrdsoU",
                                      "label": "إجمالي 5978 عرموني, شويفاتي and جبيلي",
                                      "metadata": {
                                        "accounts": [
                                          "acc_dNqQEL5MXEhwcGmrsrdsoU",
                                          "acc_cFKHf5xHV5VFfj9zWeWK92"
                                        ]
                                      },
                                      "sub_totals": [
                                        64680.64,
                                        -116943.37,
                                        -17300.88,
                                        -142137.27,
                                        -1723929.32,
                                        123526.08,
                                        -1812104.12
                                      ]
                                    },
                                    "values": [
                                      0,
                                      46673.61,
                                      -3879.68,
                                      -99482.72,
                                      18697.73,
                                      259.72,
                                      -37731.34
                                    ]
                                  }
                                ],
                                "id": "acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                "label": "9677 بنو عمرو, الداودي and غنيم",
                                "metadata": {
                                  "accounts": [
                                    "acc_fo8cC2Q8FT3fWwjyZ8qJZD"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                  "label": "إجمالي 9677 بنو عمرو, الداودي and غنيم",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                      "acc_dNqQEL5MXEhwcGmrsrdsoU"
                                    ]
                                  },
                                  "sub_totals": [
                                    69133.8,
                                    -46108.66,
                                    -16821.46,
                                    -142137.27,
                                    -1710446.84,
                                    123526.08,
                                    -1722854.35
                                  ]
                                },
                                "values": [
                                  4453.16,
                                  70834.71,
                                  479.42,
                                  0,
                                  13482.48,
                                  0,
                                  89249.77
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_A2TGPLs2ghKMGtaSPSV8JF",
                                "label": "531 خسارة أو ربح في صرف العملات",
                                "metadata": {
                                  "accounts": [
                                    "acc_A2TGPLs2ghKMGtaSPSV8JF"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_A2TGPLs2ghKMGtaSPSV8JF",
                                  "label": "إجمالي 531 خسارة أو ربح في صرف العملات",
                                  "metadata": {
                                    "accounts": [
                                      "acc_A2TGPLs2ghKMGtaSPSV8JF"
                                    ]
                                  },
                                  "sub_totals": [
                                    -11701.03,
                                    -9642.3,
                                    10908.12,
                                    -33942.56,
                                    -1393.58,
                                    -12664.92,
                                    -58436.27
                                  ]
                                },
                                "values": [
                                  -11701.03,
                                  -9642.3,
                                  10908.12,
                                  -33942.56,
                                  -1393.58,
                                  -12664.92,
                                  -58436.27
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_MjKsTpSfrvasBfWACxkukW",
                                "label": "532 أرباح وخسائر غير محققة",
                                "metadata": {
                                  "accounts": [
                                    "acc_MjKsTpSfrvasBfWACxkukW"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_MjKsTpSfrvasBfWACxkukW",
                                  "label": "إجمالي 532 أرباح وخسائر غير محققة",
                                  "metadata": {
                                    "accounts": [
                                      "acc_MjKsTpSfrvasBfWACxkukW"
                                    ]
                                  },
                                  "sub_totals": [
                                    -177.42,
                                    2956.03,
                                    -18922.69,
                                    991.43,
                                    1529.64,
                                    0,
                                    -13623.01
                                  ]
                                },
                                "values": [
                                  -177.42,
                                  2956.03,
                                  -18922.69,
                                  991.43,
                                  1529.64,
                                  0,
                                  -13623.01
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_jUKNwNM5bpdJU7QGgbttYR",
                                "label": "533 غير مصنف",
                                "metadata": {
                                  "accounts": [
                                    "acc_jUKNwNM5bpdJU7QGgbttYR"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_jUKNwNM5bpdJU7QGgbttYR",
                                  "label": "إجمالي 533 غير مصنف",
                                  "metadata": {
                                    "accounts": [
                                      "acc_jUKNwNM5bpdJU7QGgbttYR"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    2864.55,
                                    -3363903.64,
                                    0,
                                    9496.89,
                                    138309.89,
                                    -3213232.31
                                  ]
                                },
                                "values": [
                                  0,
                                  2864.55,
                                  -3363903.64,
                                  0,
                                  9496.89,
                                  138309.89,
                                  -3213232.31
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_WF8msFwMAczS7mQk3ViRMs",
                                "label": "534 الوجبات والترفيه",
                                "metadata": {
                                  "accounts": [
                                    "acc_WF8msFwMAczS7mQk3ViRMs"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_WF8msFwMAczS7mQk3ViRMs",
                                  "label": "إجمالي 534 الوجبات والترفيه",
                                  "metadata": {
                                    "accounts": [
                                      "acc_WF8msFwMAczS7mQk3ViRMs"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    3628.17,
                                    15662.04,
                                    237341.08,
                                    9877.91,
                                    12345.99,
                                    278855.19
                                  ]
                                },
                                "values": [
                                  0,
                                  3628.17,
                                  15662.04,
                                  237341.08,
                                  9877.91,
                                  12345.99,
                                  278855.19
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Hu8bjiaAfm6sCUaTnmAjcq",
                                "label": "535 مصاريف الإهلاك",
                                "metadata": {
                                  "accounts": [
                                    "acc_Hu8bjiaAfm6sCUaTnmAjcq"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Hu8bjiaAfm6sCUaTnmAjcq",
                                  "label": "إجمالي 535 مصاريف الإهلاك",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Hu8bjiaAfm6sCUaTnmAjcq"
                                    ]
                                  },
                                  "sub_totals": [
                                    30073.04,
                                    333.48,
                                    -1643.26,
                                    -1688.26,
                                    12355.59,
                                    -44501.17,
                                    -5070.58
                                  ]
                                },
                                "values": [
                                  30073.04,
                                  333.48,
                                  -1643.26,
                                  -1688.26,
                                  12355.59,
                                  -44501.17,
                                  -5070.58
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_kNYTyrAk4ER98h3XEktfuH",
                                "label": "536 المصاريف الآخرى",
                                "metadata": {
                                  "accounts": [
                                    "acc_kNYTyrAk4ER98h3XEktfuH"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_kNYTyrAk4ER98h3XEktfuH",
                                  "label": "إجمالي 536 المصاريف الآخرى",
                                  "metadata": {
                                    "accounts": [
                                      "acc_kNYTyrAk4ER98h3XEktfuH"
                                    ]
                                  },
                                  "sub_totals": [
                                    1731305.75,
                                    2277,
                                    -27.75,
                                    508806.48,
                                    -914.1,
                                    -66259.03,
                                    2175188.35
                                  ]
                                },
                                "values": [
                                  1731305.75,
                                  2277,
                                  -27.75,
                                  508806.48,
                                  -914.1,
                                  -66259.03,
                                  2175188.35
                                ]
                              }
                            ],
                            "group": "NON_OPERATING_EXPENSE",
                            "id": "NON_OPERATING_EXPENSE",
                            "label": "المصروفات الغير التشغيلية",
                            "metadata": {
                              "sub_classifications": [
                                "NON_OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_non_operating_expense",
                              "label": "إجمالي المصروفات الغير التشغيلية",
                              "metadata": {},
                              "sub_totals": [
                                1814180.98,
                                -161200.05,
                                -3371348.38,
                                668853.62,
                                -1711674.7,
                                150497.12,
                                -2610691.41
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "NET_PROFIT",
                            "id": "NET_PROFIT",
                            "label": "الربح الصافي",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES",
                                "OPERATING_EXPENSES",
                                "OTHER_INCOME",
                                "NON_OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_net_profit",
                              "label": "الربح الصافي",
                              "metadata": {},
                              "sub_totals": [
                                -924985.36,
                                241821.44,
                                -2882150.6,
                                4368624.33,
                                -5868120.77,
                                -488500.56,
                                -5553311.52
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
                            "id": "2022-04-01",
                            "label": "Apr 2022",
                            "metadata": {
                              "from_date": "2022-04-01",
                              "to_date": "2022-04-30"
                            }
                          },
                          {
                            "id": "2022-05-01",
                            "label": "May 2022",
                            "metadata": {
                              "from_date": "2022-05-01",
                              "to_date": "2022-05-31"
                            }
                          },
                          {
                            "id": "2022-06-01",
                            "label": "Jun 2022",
                            "metadata": {
                              "from_date": "2022-06-01",
                              "to_date": "2022-06-30"
                            }
                          },
                          {
                            "id": "2022-07-01",
                            "label": "Jul 2022",
                            "metadata": {
                              "from_date": "2022-07-01",
                              "to_date": "2022-07-31"
                            }
                          },
                          {
                            "id": "2022-08-01",
                            "label": "Aug 2022",
                            "metadata": {
                              "from_date": "2022-08-01",
                              "to_date": "2022-08-31"
                            }
                          },
                          {
                            "id": "2022-09-01",
                            "label": "Sep 2022",
                            "metadata": {
                              "from_date": "2022-09-01",
                              "to_date": "2022-09-30"
                            }
                          },
                          {
                            "id": "row_totals",
                            "label": "Totals",
                            "metadata": {
                              "from_date": "2022-04-01",
                              "to_date": "2022-09-30"
                            }
                          }
                        ],
                        "overview": {
                          "created_ts": "2024-01-05T00:00:00Z",
                          "currency": "SAR",
                          "date_from": "2022-04-01",
                          "date_to": "2022-09-30",
                          "filters": {
                            "contact__in": [
                              "co_BguCJYcbqCgn4jRPctaGLA",
                              "co_Lcnfy7KdZyMWR9X4S3hPSq"
                            ]
                          },
                          "group_by": "month",
                          "id": "profit_and_loss",
                          "label": "Profit and Loss Report"
                        },
                        "rows": [
                          {
                            "children": [
                              {
                                "children": [],
                                "id": "acc_GwwXGSvDi2nHKCecyxXexo",
                                "label": "2663 GB31PYKS95133433234680",
                                "metadata": {
                                  "accounts": [
                                    "acc_GwwXGSvDi2nHKCecyxXexo"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_GwwXGSvDi2nHKCecyxXexo",
                                  "label": "Total 2663 GB31PYKS95133433234680",
                                  "metadata": {
                                    "accounts": [
                                      "acc_GwwXGSvDi2nHKCecyxXexo"
                                    ]
                                  },
                                  "sub_totals": [
                                    -15.08,
                                    0,
                                    -5260.4,
                                    629.41,
                                    0,
                                    -355997.51,
                                    -360643.58
                                  ]
                                },
                                "values": [
                                  -15.08,
                                  0,
                                  -5260.4,
                                  629.41,
                                  0,
                                  -355997.51,
                                  -360643.58
                                ]
                              },
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_h3mudXDb52V9naLfh9DVBi",
                                            "label": "2191 Hanna Group",
                                            "metadata": {
                                              "accounts": [
                                                "acc_h3mudXDb52V9naLfh9DVBi"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_h3mudXDb52V9naLfh9DVBi",
                                              "label": "Total 2191 Hanna Group",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_h3mudXDb52V9naLfh9DVBi"
                                                ]
                                              },
                                              "sub_totals": [
                                                -4316.92,
                                                0,
                                                26.04,
                                                27.21,
                                                -195521.05,
                                                63.82,
                                                -199720.9
                                              ]
                                            },
                                            "values": [
                                              -4316.92,
                                              0,
                                              26.04,
                                              27.21,
                                              -195521.05,
                                              63.82,
                                              -199720.9
                                            ]
                                          }
                                        ],
                                        "id": "acc_8dXpkHH9yHGwpfKmiNx8HA",
                                        "label": "6883 Goodwin-Harper",
                                        "metadata": {
                                          "accounts": [
                                            "acc_8dXpkHH9yHGwpfKmiNx8HA"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_8dXpkHH9yHGwpfKmiNx8HA",
                                          "label": "Total 6883 Goodwin-Harper",
                                          "metadata": {
                                            "accounts": [
                                              "acc_8dXpkHH9yHGwpfKmiNx8HA",
                                              "acc_h3mudXDb52V9naLfh9DVBi"
                                            ]
                                          },
                                          "sub_totals": [
                                            16003.78,
                                            -3265.38,
                                            26.04,
                                            27.21,
                                            -195520.85,
                                            1502.32,
                                            -181226.88
                                          ]
                                        },
                                        "values": [
                                          20320.7,
                                          -3265.38,
                                          0,
                                          0,
                                          0.2,
                                          1438.5,
                                          18494.02
                                        ]
                                      }
                                    ],
                                    "id": "acc_SUpT3JjnPj44pXGyVLM2T9",
                                    "label": "3232 Thompson Inc",
                                    "metadata": {
                                      "accounts": [
                                        "acc_SUpT3JjnPj44pXGyVLM2T9"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_SUpT3JjnPj44pXGyVLM2T9",
                                      "label": "Total 3232 Thompson Inc",
                                      "metadata": {
                                        "accounts": [
                                          "acc_SUpT3JjnPj44pXGyVLM2T9",
                                          "acc_8dXpkHH9yHGwpfKmiNx8HA"
                                        ]
                                      },
                                      "sub_totals": [
                                        16989.99,
                                        -6145.4,
                                        26.04,
                                        -885.04,
                                        -195520.85,
                                        2371.93,
                                        -183163.33
                                      ]
                                    },
                                    "values": [
                                      986.21,
                                      -2880.02,
                                      0,
                                      -912.25,
                                      0,
                                      869.61,
                                      -1936.45
                                    ]
                                  }
                                ],
                                "id": "acc_3aMMeaGLXEj2nkBBkTAXCh",
                                "label": "7066 Medina-Santos",
                                "metadata": {
                                  "accounts": [
                                    "acc_3aMMeaGLXEj2nkBBkTAXCh"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_3aMMeaGLXEj2nkBBkTAXCh",
                                  "label": "Total 7066 Medina-Santos",
                                  "metadata": {
                                    "accounts": [
                                      "acc_3aMMeaGLXEj2nkBBkTAXCh",
                                      "acc_SUpT3JjnPj44pXGyVLM2T9"
                                    ]
                                  },
                                  "sub_totals": [
                                    -37231.2,
                                    -5774.85,
                                    40808.4,
                                    -885.04,
                                    -195520.85,
                                    2371.93,
                                    -196231.61
                                  ]
                                },
                                "values": [
                                  -54221.19,
                                  370.55,
                                  40782.36,
                                  0,
                                  0,
                                  0,
                                  -13068.28
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Bv3z5sii7aXDhxXZV8Sqrb",
                                "label": "8899 GB42DLQG70743971530332",
                                "metadata": {
                                  "accounts": [
                                    "acc_Bv3z5sii7aXDhxXZV8Sqrb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Bv3z5sii7aXDhxXZV8Sqrb",
                                  "label": "Total 8899 GB42DLQG70743971530332",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Bv3z5sii7aXDhxXZV8Sqrb"
                                    ]
                                  },
                                  "sub_totals": [
                                    -11.55,
                                    0,
                                    -52.1,
                                    475.95,
                                    -26.14,
                                    0,
                                    386.16
                                  ]
                                },
                                "values": [
                                  -11.55,
                                  0,
                                  -52.1,
                                  475.95,
                                  -26.14,
                                  0,
                                  386.16
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_EVeNzPbZXnnCiidM4mGcbf",
                                "label": "9694 GB43IVCI82994294137386",
                                "metadata": {
                                  "accounts": [
                                    "acc_EVeNzPbZXnnCiidM4mGcbf"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_EVeNzPbZXnnCiidM4mGcbf",
                                  "label": "Total 9694 GB43IVCI82994294137386",
                                  "metadata": {
                                    "accounts": [
                                      "acc_EVeNzPbZXnnCiidM4mGcbf"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    -77868.76,
                                    -579.14,
                                    0,
                                    -429.85,
                                    6.7,
                                    -78871.05
                                  ]
                                },
                                "values": [
                                  0,
                                  -77868.76,
                                  -579.14,
                                  0,
                                  -429.85,
                                  6.7,
                                  -78871.05
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_fGZ5RrRSas7k46FFk3U5rb",
                                "label": "411 Sales",
                                "metadata": {
                                  "accounts": [
                                    "acc_fGZ5RrRSas7k46FFk3U5rb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fGZ5RrRSas7k46FFk3U5rb",
                                  "label": "Total 411 Sales",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fGZ5RrRSas7k46FFk3U5rb"
                                    ]
                                  },
                                  "sub_totals": [
                                    -4238.85,
                                    -10998.96,
                                    -7674.62,
                                    -8316.05,
                                    21837.93,
                                    1528.84,
                                    -7861.71
                                  ]
                                },
                                "values": [
                                  -4238.85,
                                  -10998.96,
                                  -7674.62,
                                  -8316.05,
                                  21837.93,
                                  1528.84,
                                  -7861.71
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_nGFXazi6c3BBLg6Rs8564P",
                                "label": "412 Interest Income",
                                "metadata": {
                                  "accounts": [
                                    "acc_nGFXazi6c3BBLg6Rs8564P"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_nGFXazi6c3BBLg6Rs8564P",
                                  "label": "Total 412 Interest Income",
                                  "metadata": {
                                    "accounts": [
                                      "acc_nGFXazi6c3BBLg6Rs8564P"
                                    ]
                                  },
                                  "sub_totals": [
                                    54387.74,
                                    0,
                                    0,
                                    552.55,
                                    0,
                                    815.13,
                                    55755.42
                                  ]
                                },
                                "values": [
                                  54387.74,
                                  0,
                                  0,
                                  552.55,
                                  0,
                                  815.13,
                                  55755.42
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_n8DgFgrhEP6qPkVEb8meu3",
                                "label": "413 Late Fee Income",
                                "metadata": {
                                  "accounts": [
                                    "acc_n8DgFgrhEP6qPkVEb8meu3"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_n8DgFgrhEP6qPkVEb8meu3",
                                  "label": "Total 413 Late Fee Income",
                                  "metadata": {
                                    "accounts": [
                                      "acc_n8DgFgrhEP6qPkVEb8meu3"
                                    ]
                                  },
                                  "sub_totals": [
                                    569.16,
                                    0,
                                    0,
                                    0,
                                    -20.11,
                                    -4.13,
                                    544.92
                                  ]
                                },
                                "values": [
                                  569.16,
                                  0,
                                  0,
                                  0,
                                  -20.11,
                                  -4.13,
                                  544.92
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_AkTASCAaMJtamv9NY8Qys5",
                                "label": "414 Shipping Charge",
                                "metadata": {
                                  "accounts": [
                                    "acc_AkTASCAaMJtamv9NY8Qys5"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_AkTASCAaMJtamv9NY8Qys5",
                                  "label": "Total 414 Shipping Charge",
                                  "metadata": {
                                    "accounts": [
                                      "acc_AkTASCAaMJtamv9NY8Qys5"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    0,
                                    -94888.57,
                                    -7.51,
                                    -94896.08
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  0,
                                  0,
                                  -94888.57,
                                  -7.51,
                                  -94896.08
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_WCU3XXtzqSVs9AVwmbv3Ro",
                                "label": "415 Other Charges",
                                "metadata": {
                                  "accounts": [
                                    "acc_WCU3XXtzqSVs9AVwmbv3Ro"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_WCU3XXtzqSVs9AVwmbv3Ro",
                                  "label": "Total 415 Other Charges",
                                  "metadata": {
                                    "accounts": [
                                      "acc_WCU3XXtzqSVs9AVwmbv3Ro"
                                    ]
                                  },
                                  "sub_totals": [
                                    1814.62,
                                    -916209.22,
                                    1857.26,
                                    638.77,
                                    -5181.61,
                                    0,
                                    -917080.18
                                  ]
                                },
                                "values": [
                                  1814.62,
                                  -916209.22,
                                  1857.26,
                                  638.77,
                                  -5181.61,
                                  0,
                                  -917080.18
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_A86ZVhuCEZU7bCgJ3pAhZR",
                                "label": "416 Discount",
                                "metadata": {
                                  "accounts": [
                                    "acc_A86ZVhuCEZU7bCgJ3pAhZR"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_A86ZVhuCEZU7bCgJ3pAhZR",
                                  "label": "Total 416 Discount",
                                  "metadata": {
                                    "accounts": [
                                      "acc_A86ZVhuCEZU7bCgJ3pAhZR"
                                    ]
                                  },
                                  "sub_totals": [
                                    69.28,
                                    0,
                                    -24004.45,
                                    0,
                                    -35363.78,
                                    0,
                                    -59298.95
                                  ]
                                },
                                "values": [
                                  69.28,
                                  0,
                                  -24004.45,
                                  0,
                                  -35363.78,
                                  0,
                                  -59298.95
                                ]
                              }
                            ],
                            "group": "INCOME",
                            "id": "INCOME",
                            "label": "Income",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME"
                              ]
                            },
                            "summary": {
                              "id": "summary_income",
                              "label": "Total Income",
                              "metadata": {},
                              "sub_totals": [
                                68605.73,
                                -930473.56,
                                -29795.77,
                                -7097.52,
                                -309136.99,
                                3834.65,
                                -1204063.46
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [
                                              {
                                                "children": [],
                                                "id": "acc_hV2CkyYXmZXvy2iKQz2yei",
                                                "label": "1624 Bell, Campbell and Joseph",
                                                "metadata": {
                                                  "accounts": [
                                                    "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                  ]
                                                },
                                                "summary": {
                                                  "id": "summary_acc_hV2CkyYXmZXvy2iKQz2yei",
                                                  "label": "Total 1624 Bell, Campbell and Joseph",
                                                  "metadata": {
                                                    "accounts": [
                                                      "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                    ]
                                                  },
                                                  "sub_totals": [
                                                    0,
                                                    0,
                                                    0,
                                                    7260.43,
                                                    129.03,
                                                    0,
                                                    7389.46
                                                  ]
                                                },
                                                "values": [
                                                  0,
                                                  0,
                                                  0,
                                                  7260.43,
                                                  129.03,
                                                  0,
                                                  7389.46
                                                ]
                                              }
                                            ],
                                            "id": "acc_2mxViQpX3regpQSrcWqCM2",
                                            "label": "5430 Clark-Robertson",
                                            "metadata": {
                                              "accounts": [
                                                "acc_2mxViQpX3regpQSrcWqCM2"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_2mxViQpX3regpQSrcWqCM2",
                                              "label": "Total 5430 Clark-Robertson",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_2mxViQpX3regpQSrcWqCM2",
                                                  "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                ]
                                              },
                                              "sub_totals": [
                                                6968.98,
                                                0,
                                                0,
                                                -28873.34,
                                                129.03,
                                                -129.6,
                                                -21904.93
                                              ]
                                            },
                                            "values": [
                                              6968.98,
                                              0,
                                              0,
                                              -36133.77,
                                              0,
                                              -129.6,
                                              -29294.39
                                            ]
                                          }
                                        ],
                                        "id": "acc_hEGoCD9ffFhQepj3srzDVs",
                                        "label": "1245 Washington-Clayton",
                                        "metadata": {
                                          "accounts": [
                                            "acc_hEGoCD9ffFhQepj3srzDVs"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_hEGoCD9ffFhQepj3srzDVs",
                                          "label": "Total 1245 Washington-Clayton",
                                          "metadata": {
                                            "accounts": [
                                              "acc_hEGoCD9ffFhQepj3srzDVs",
                                              "acc_2mxViQpX3regpQSrcWqCM2"
                                            ]
                                          },
                                          "sub_totals": [
                                            6968.98,
                                            -557.32,
                                            0,
                                            -29219.73,
                                            210.53,
                                            1053.48,
                                            -21544.06
                                          ]
                                        },
                                        "values": [
                                          0,
                                          -557.32,
                                          0,
                                          -346.39,
                                          81.5,
                                          1183.08,
                                          360.87
                                        ]
                                      }
                                    ],
                                    "id": "acc_ULicU8jieyR9UuqiM9ovoL",
                                    "label": "6576 Holloway, Strong and Hicks",
                                    "metadata": {
                                      "accounts": [
                                        "acc_ULicU8jieyR9UuqiM9ovoL"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_ULicU8jieyR9UuqiM9ovoL",
                                      "label": "Total 6576 Holloway, Strong and Hicks",
                                      "metadata": {
                                        "accounts": [
                                          "acc_ULicU8jieyR9UuqiM9ovoL",
                                          "acc_hEGoCD9ffFhQepj3srzDVs"
                                        ]
                                      },
                                      "sub_totals": [
                                        6540.05,
                                        -557.32,
                                        4.47,
                                        -29202.67,
                                        -2875399.68,
                                        1053.48,
                                        -2897561.67
                                      ]
                                    },
                                    "values": [
                                      -428.93,
                                      0,
                                      4.47,
                                      17.06,
                                      -2875610.21,
                                      0,
                                      -2876017.61
                                    ]
                                  }
                                ],
                                "id": "acc_9YNpqmbHjrZN6oFL2SX7jm",
                                "label": "2721 Sheppard and Sons",
                                "metadata": {
                                  "accounts": [
                                    "acc_9YNpqmbHjrZN6oFL2SX7jm"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_9YNpqmbHjrZN6oFL2SX7jm",
                                  "label": "Total 2721 Sheppard and Sons",
                                  "metadata": {
                                    "accounts": [
                                      "acc_9YNpqmbHjrZN6oFL2SX7jm",
                                      "acc_ULicU8jieyR9UuqiM9ovoL"
                                    ]
                                  },
                                  "sub_totals": [
                                    6540.05,
                                    -557.32,
                                    4.47,
                                    -29208.67,
                                    -2878863.77,
                                    38527.36,
                                    -2863557.88
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  0,
                                  -6,
                                  -3464.09,
                                  37473.88,
                                  34003.79
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_dqNwix5yRwuQgB9pzQCjXb",
                                "label": "511 Cost of Goods Sold",
                                "metadata": {
                                  "accounts": [
                                    "acc_dqNwix5yRwuQgB9pzQCjXb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_dqNwix5yRwuQgB9pzQCjXb",
                                  "label": "Total 511 Cost of Goods Sold",
                                  "metadata": {
                                    "accounts": [
                                      "acc_dqNwix5yRwuQgB9pzQCjXb"
                                    ]
                                  },
                                  "sub_totals": [
                                    7313.55,
                                    5148.23,
                                    22385.21,
                                    404982.97,
                                    237849.52,
                                    8481.42,
                                    686160.9
                                  ]
                                },
                                "values": [
                                  7313.55,
                                  5148.23,
                                  22385.21,
                                  404982.97,
                                  237849.52,
                                  8481.42,
                                  686160.9
                                ]
                              }
                            ],
                            "group": "COGS",
                            "id": "COGS",
                            "label": "Cost of Sales",
                            "metadata": {
                              "sub_classifications": [
                                "COST_OF_SALES"
                              ]
                            },
                            "summary": {
                              "id": "summary_cogs",
                              "label": "Total Cost of Sales",
                              "metadata": {},
                              "sub_totals": [
                                14282.53,
                                4590.91,
                                22385.21,
                                375763.24,
                                238060.05,
                                9534.9,
                                664616.84
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "GROSS_MARGIN",
                            "id": "GROSS_MARGIN",
                            "label": "Gross Profit",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES"
                              ]
                            },
                            "summary": {
                              "id": "summary_gross_margin",
                              "label": "Gross Profit",
                              "metadata": {},
                              "sub_totals": [
                                82888.26,
                                -925882.65,
                                -7410.56,
                                368665.72,
                                -71076.94,
                                13369.55,
                                -539446.62
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_XKZ4X8LGL3CfZGBrMjBsf3",
                                            "label": "8963 Vasquez, Bradley and Novak",
                                            "metadata": {
                                              "accounts": [
                                                "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_XKZ4X8LGL3CfZGBrMjBsf3",
                                              "label": "Total 8963 Vasquez, Bradley and Novak",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                                ]
                                              },
                                              "sub_totals": [
                                                0,
                                                0,
                                                0,
                                                76.05,
                                                0,
                                                -91.08,
                                                -15.03
                                              ]
                                            },
                                            "values": [
                                              0,
                                              0,
                                              0,
                                              76.05,
                                              0,
                                              -91.08,
                                              -15.03
                                            ]
                                          }
                                        ],
                                        "id": "acc_ahzp6b9vysnVSND7ezSnbc",
                                        "label": "7810 Mullins-Mendoza",
                                        "metadata": {
                                          "accounts": [
                                            "acc_ahzp6b9vysnVSND7ezSnbc"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_ahzp6b9vysnVSND7ezSnbc",
                                          "label": "Total 7810 Mullins-Mendoza",
                                          "metadata": {
                                            "accounts": [
                                              "acc_ahzp6b9vysnVSND7ezSnbc",
                                              "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                            ]
                                          },
                                          "sub_totals": [
                                            0,
                                            129.84,
                                            0,
                                            2339.85,
                                            2757.24,
                                            -756.01,
                                            4470.92
                                          ]
                                        },
                                        "values": [
                                          0,
                                          129.84,
                                          0,
                                          2263.8,
                                          2757.24,
                                          -664.93,
                                          4485.95
                                        ]
                                      }
                                    ],
                                    "id": "acc_54S8UKUaLC7Qz26YxtabHf",
                                    "label": "7545 Johnson Ltd",
                                    "metadata": {
                                      "accounts": [
                                        "acc_54S8UKUaLC7Qz26YxtabHf"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_54S8UKUaLC7Qz26YxtabHf",
                                      "label": "Total 7545 Johnson Ltd",
                                      "metadata": {
                                        "accounts": [
                                          "acc_54S8UKUaLC7Qz26YxtabHf",
                                          "acc_ahzp6b9vysnVSND7ezSnbc"
                                        ]
                                      },
                                      "sub_totals": [
                                        -565.05,
                                        129.84,
                                        31.55,
                                        2339.85,
                                        2757.24,
                                        -756.01,
                                        3937.42
                                      ]
                                    },
                                    "values": [
                                      -565.05,
                                      0,
                                      31.55,
                                      0,
                                      0,
                                      0,
                                      -533.5
                                    ]
                                  }
                                ],
                                "id": "acc_W4GP34aBqv9NpwPVPP9Toe",
                                "label": "7049 Gallegos-Jones",
                                "metadata": {
                                  "accounts": [
                                    "acc_W4GP34aBqv9NpwPVPP9Toe"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_W4GP34aBqv9NpwPVPP9Toe",
                                  "label": "Total 7049 Gallegos-Jones",
                                  "metadata": {
                                    "accounts": [
                                      "acc_W4GP34aBqv9NpwPVPP9Toe",
                                      "acc_54S8UKUaLC7Qz26YxtabHf"
                                    ]
                                  },
                                  "sub_totals": [
                                    -573.5,
                                    129.84,
                                    31.55,
                                    2362.14,
                                    2757.24,
                                    -822.01,
                                    3885.26
                                  ]
                                },
                                "values": [
                                  -8.45,
                                  0,
                                  0,
                                  22.29,
                                  0,
                                  -66,
                                  -52.16
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_GVHuwPnwyLpDUKfLTZm5FL",
                                "label": "521 Office Supplies",
                                "metadata": {
                                  "accounts": [
                                    "acc_GVHuwPnwyLpDUKfLTZm5FL"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_GVHuwPnwyLpDUKfLTZm5FL",
                                  "label": "Total 521 Office Supplies",
                                  "metadata": {
                                    "accounts": [
                                      "acc_GVHuwPnwyLpDUKfLTZm5FL"
                                    ]
                                  },
                                  "sub_totals": [
                                    4162.44,
                                    0,
                                    167877.72,
                                    6009.74,
                                    0,
                                    1010.62,
                                    179060.52
                                  ]
                                },
                                "values": [
                                  4162.44,
                                  0,
                                  167877.72,
                                  6009.74,
                                  0,
                                  1010.62,
                                  179060.52
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_baw6nBvKaovg6LCwHC3MBV",
                                "label": "5210 Rent Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_baw6nBvKaovg6LCwHC3MBV"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_baw6nBvKaovg6LCwHC3MBV",
                                  "label": "Total 5210 Rent Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_baw6nBvKaovg6LCwHC3MBV"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    0,
                                    0,
                                    6129.27,
                                    6226.88,
                                    89,
                                    12445.15
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  0,
                                  6129.27,
                                  6226.88,
                                  89,
                                  12445.15
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_iVA6wA5eZ3kdCdeRhX8sDA",
                                "label": "5211 Janitorial Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_iVA6wA5eZ3kdCdeRhX8sDA"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_iVA6wA5eZ3kdCdeRhX8sDA",
                                  "label": "Total 5211 Janitorial Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_iVA6wA5eZ3kdCdeRhX8sDA"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    43581.86,
                                    596.25,
                                    20.18,
                                    0,
                                    0,
                                    44198.29
                                  ]
                                },
                                "values": [
                                  0,
                                  43581.86,
                                  596.25,
                                  20.18,
                                  0,
                                  0,
                                  44198.29
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_4g58kJWsPB5RE8khF8yciM",
                                "label": "5212 Postage",
                                "metadata": {
                                  "accounts": [
                                    "acc_4g58kJWsPB5RE8khF8yciM"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_4g58kJWsPB5RE8khF8yciM",
                                  "label": "Total 5212 Postage",
                                  "metadata": {
                                    "accounts": [
                                      "acc_4g58kJWsPB5RE8khF8yciM"
                                    ]
                                  },
                                  "sub_totals": [
                                    552.38,
                                    -27161.88,
                                    245475.87,
                                    10390.5,
                                    -181.27,
                                    -2181.39,
                                    226894.21
                                  ]
                                },
                                "values": [
                                  552.38,
                                  -27161.88,
                                  245475.87,
                                  10390.5,
                                  -181.27,
                                  -2181.39,
                                  226894.21
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_7FcRGhfmBJH6RrYRJt22yg",
                                "label": "5213 Bad Debt",
                                "metadata": {
                                  "accounts": [
                                    "acc_7FcRGhfmBJH6RrYRJt22yg"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_7FcRGhfmBJH6RrYRJt22yg",
                                  "label": "Total 5213 Bad Debt",
                                  "metadata": {
                                    "accounts": [
                                      "acc_7FcRGhfmBJH6RrYRJt22yg"
                                    ]
                                  },
                                  "sub_totals": [
                                    -1225048.88,
                                    0,
                                    2.04,
                                    -3026.25,
                                    -1372.22,
                                    -350.4,
                                    -1229795.71
                                  ]
                                },
                                "values": [
                                  -1225048.88,
                                  0,
                                  2.04,
                                  -3026.25,
                                  -1372.22,
                                  -350.4,
                                  -1229795.71
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_4Kv6SsyMC3kNrALkM9qdnr",
                                "label": "5214 Printing and Stationery",
                                "metadata": {
                                  "accounts": [
                                    "acc_4Kv6SsyMC3kNrALkM9qdnr"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_4Kv6SsyMC3kNrALkM9qdnr",
                                  "label": "Total 5214 Printing and Stationery",
                                  "metadata": {
                                    "accounts": [
                                      "acc_4Kv6SsyMC3kNrALkM9qdnr"
                                    ]
                                  },
                                  "sub_totals": [
                                    2102.9,
                                    0,
                                    0,
                                    1325.31,
                                    -1987.76,
                                    -1749.75,
                                    -309.3
                                  ]
                                },
                                "values": [
                                  2102.9,
                                  0,
                                  0,
                                  1325.31,
                                  -1987.76,
                                  -1749.75,
                                  -309.3
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_52YCm8dAdMBRkMJj6QRBuW",
                                "label": "5215 Salaries and Employee Wages",
                                "metadata": {
                                  "accounts": [
                                    "acc_52YCm8dAdMBRkMJj6QRBuW"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_52YCm8dAdMBRkMJj6QRBuW",
                                  "label": "Total 5215 Salaries and Employee Wages",
                                  "metadata": {
                                    "accounts": [
                                      "acc_52YCm8dAdMBRkMJj6QRBuW"
                                    ]
                                  },
                                  "sub_totals": [
                                    466.4,
                                    -575.78,
                                    -3.58,
                                    1089.1,
                                    -63.24,
                                    29200.05,
                                    30112.95
                                  ]
                                },
                                "values": [
                                  466.4,
                                  -575.78,
                                  -3.58,
                                  1089.1,
                                  -63.24,
                                  29200.05,
                                  30112.95
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_9xfmGZghqc2jWTVJ8oVpaE",
                                "label": "5216 Consultant Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_9xfmGZghqc2jWTVJ8oVpaE"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_9xfmGZghqc2jWTVJ8oVpaE",
                                  "label": "Total 5216 Consultant Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_9xfmGZghqc2jWTVJ8oVpaE"
                                    ]
                                  },
                                  "sub_totals": [
                                    14449.3,
                                    0,
                                    89.09,
                                    6822.39,
                                    0,
                                    -487.88,
                                    20872.9
                                  ]
                                },
                                "values": [
                                  14449.3,
                                  0,
                                  89.09,
                                  6822.39,
                                  0,
                                  -487.88,
                                  20872.9
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_7v3RharPkEc6YdPy9tXpXP",
                                "label": "5217 Repairs and Maintenance",
                                "metadata": {
                                  "accounts": [
                                    "acc_7v3RharPkEc6YdPy9tXpXP"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_7v3RharPkEc6YdPy9tXpXP",
                                  "label": "Total 5217 Repairs and Maintenance",
                                  "metadata": {
                                    "accounts": [
                                      "acc_7v3RharPkEc6YdPy9tXpXP"
                                    ]
                                  },
                                  "sub_totals": [
                                    134.66,
                                    2776.86,
                                    -5856.33,
                                    0,
                                    0,
                                    4495.53,
                                    1550.72
                                  ]
                                },
                                "values": [
                                  134.66,
                                  2776.86,
                                  -5856.33,
                                  0,
                                  0,
                                  4495.53,
                                  1550.72
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_fMrHBpnBAt82XU4JLPnAZD",
                                "label": "522 Lodging",
                                "metadata": {
                                  "accounts": [
                                    "acc_fMrHBpnBAt82XU4JLPnAZD"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fMrHBpnBAt82XU4JLPnAZD",
                                  "label": "Total 522 Lodging",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fMrHBpnBAt82XU4JLPnAZD"
                                    ]
                                  },
                                  "sub_totals": [
                                    -688,
                                    40.16,
                                    0,
                                    -2569.05,
                                    9717.53,
                                    0,
                                    6500.64
                                  ]
                                },
                                "values": [
                                  -688,
                                  40.16,
                                  0,
                                  -2569.05,
                                  9717.53,
                                  0,
                                  6500.64
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_aRQYS3qwV4JBZyUbMcWof8",
                                "label": "523 Advertising And Marketing",
                                "metadata": {
                                  "accounts": [
                                    "acc_aRQYS3qwV4JBZyUbMcWof8"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_aRQYS3qwV4JBZyUbMcWof8",
                                  "label": "Total 523 Advertising And Marketing",
                                  "metadata": {
                                    "accounts": [
                                      "acc_aRQYS3qwV4JBZyUbMcWof8"
                                    ]
                                  },
                                  "sub_totals": [
                                    -17.21,
                                    0,
                                    0,
                                    -23.06,
                                    0,
                                    1.26,
                                    -39.01
                                  ]
                                },
                                "values": [
                                  -17.21,
                                  0,
                                  0,
                                  -23.06,
                                  0,
                                  1.26,
                                  -39.01
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Wkr3kRUkL6f5HVyfekN7YC",
                                "label": "524 Bank Fees and Charges",
                                "metadata": {
                                  "accounts": [
                                    "acc_Wkr3kRUkL6f5HVyfekN7YC"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Wkr3kRUkL6f5HVyfekN7YC",
                                  "label": "Total 524 Bank Fees and Charges",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Wkr3kRUkL6f5HVyfekN7YC"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    7358.12,
                                    0,
                                    0,
                                    25482.75,
                                    -67.23,
                                    32773.64
                                  ]
                                },
                                "values": [
                                  0,
                                  7358.12,
                                  0,
                                  0,
                                  25482.75,
                                  -67.23,
                                  32773.64
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Y3Dknxe5CtePp4cDLEfM3H",
                                "label": "525 Credit Card Charges",
                                "metadata": {
                                  "accounts": [
                                    "acc_Y3Dknxe5CtePp4cDLEfM3H"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Y3Dknxe5CtePp4cDLEfM3H",
                                  "label": "Total 525 Credit Card Charges",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Y3Dknxe5CtePp4cDLEfM3H"
                                    ]
                                  },
                                  "sub_totals": [
                                    -356792.46,
                                    0,
                                    0,
                                    5557.53,
                                    0,
                                    -143292.04,
                                    -494526.97
                                  ]
                                },
                                "values": [
                                  -356792.46,
                                  0,
                                  0,
                                  5557.53,
                                  0,
                                  -143292.04,
                                  -494526.97
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_XP7KMbDzi7rGZQDefcYu9r",
                                "label": "526 Travel Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_XP7KMbDzi7rGZQDefcYu9r"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_XP7KMbDzi7rGZQDefcYu9r",
                                  "label": "Total 526 Travel Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_XP7KMbDzi7rGZQDefcYu9r"
                                    ]
                                  },
                                  "sub_totals": [
                                    -8561.8,
                                    0,
                                    13.41,
                                    -9379.49,
                                    -315.72,
                                    0,
                                    -18243.6
                                  ]
                                },
                                "values": [
                                  -8561.8,
                                  0,
                                  13.41,
                                  -9379.49,
                                  -315.72,
                                  0,
                                  -18243.6
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_mzX3EmggUxHc65qqvpo8m9",
                                "label": "527 Telephone Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_mzX3EmggUxHc65qqvpo8m9"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_mzX3EmggUxHc65qqvpo8m9",
                                  "label": "Total 527 Telephone Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_mzX3EmggUxHc65qqvpo8m9"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    -3928.73,
                                    980.38,
                                    0,
                                    0,
                                    0,
                                    -2948.35
                                  ]
                                },
                                "values": [
                                  0,
                                  -3928.73,
                                  980.38,
                                  0,
                                  0,
                                  0,
                                  -2948.35
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_nf89ZwyS56JdJG23CHoH36",
                                "label": "528 Vehicle Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_nf89ZwyS56JdJG23CHoH36"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_nf89ZwyS56JdJG23CHoH36",
                                  "label": "Total 528 Vehicle Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_nf89ZwyS56JdJG23CHoH36"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    0,
                                    1.63,
                                    0,
                                    -48.73,
                                    -31.65,
                                    -78.75
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  1.63,
                                  0,
                                  -48.73,
                                  -31.65,
                                  -78.75
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_np2Vi9S7mse3UnzEhs86Wj",
                                "label": "529 Software and Tools",
                                "metadata": {
                                  "accounts": [
                                    "acc_np2Vi9S7mse3UnzEhs86Wj"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_np2Vi9S7mse3UnzEhs86Wj",
                                  "label": "Total 529 Software and Tools",
                                  "metadata": {
                                    "accounts": [
                                      "acc_np2Vi9S7mse3UnzEhs86Wj"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    0,
                                    811.87,
                                    0,
                                    0,
                                    2819.78,
                                    3631.65
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  811.87,
                                  0,
                                  0,
                                  2819.78,
                                  3631.65
                                ]
                              }
                            ],
                            "group": "OPERATING_EXPENSE",
                            "id": "OPERATING_EXPENSE",
                            "label": "Operating Expenses",
                            "metadata": {
                              "sub_classifications": [
                                "OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_operating_expense",
                              "label": "Total Operating Expenses",
                              "metadata": {},
                              "sub_totals": [
                                -1569240.27,
                                22220.45,
                                409988.35,
                                24686.02,
                                40215.46,
                                -111300.11,
                                -1183430.1
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "OPERATING_PROFIT",
                            "id": "OPERATING_PROFIT",
                            "label": "Operating Profit",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES",
                                "OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_operating_profit",
                              "label": "Operating Profit",
                              "metadata": {},
                              "sub_totals": [
                                -1486352.01,
                                -903662.2,
                                402577.79,
                                393351.74,
                                -30861.48,
                                -97930.56,
                                -1722876.72
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_K8D9SrmdvbYqJCmUuweRce",
                                            "label": "2879 Higgins, Coleman and Romero",
                                            "metadata": {
                                              "accounts": [
                                                "acc_K8D9SrmdvbYqJCmUuweRce"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_K8D9SrmdvbYqJCmUuweRce",
                                              "label": "Total 2879 Higgins, Coleman and Romero",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_K8D9SrmdvbYqJCmUuweRce"
                                                ]
                                              },
                                              "sub_totals": [
                                                0,
                                                353642.35,
                                                0,
                                                -7,
                                                0,
                                                -2809.24,
                                                350826.11
                                              ]
                                            },
                                            "values": [
                                              0,
                                              353642.35,
                                              0,
                                              -7,
                                              0,
                                              -2809.24,
                                              350826.11
                                            ]
                                          }
                                        ],
                                        "id": "acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                        "label": "0196 Martinez, Boyd and Vargas",
                                        "metadata": {
                                          "accounts": [
                                            "acc_kjxnhcvAHUCZ9BW8FgPDFk"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                          "label": "Total 0196 Martinez, Boyd and Vargas",
                                          "metadata": {
                                            "accounts": [
                                              "acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                              "acc_K8D9SrmdvbYqJCmUuweRce"
                                            ]
                                          },
                                          "sub_totals": [
                                            0,
                                            295154.68,
                                            286.26,
                                            -29740.75,
                                            0,
                                            -2809.24,
                                            262890.95
                                          ]
                                        },
                                        "values": [
                                          0,
                                          -58487.67,
                                          286.26,
                                          -29733.75,
                                          0,
                                          0,
                                          -87935.16
                                        ]
                                      }
                                    ],
                                    "id": "acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                    "label": "1170 Dickson-Walker",
                                    "metadata": {
                                      "accounts": [
                                        "acc_k7ZD5hrbMmoBBwFVe9ZaNj"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                      "label": "Total 1170 Dickson-Walker",
                                      "metadata": {
                                        "accounts": [
                                          "acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                          "acc_kjxnhcvAHUCZ9BW8FgPDFk"
                                        ]
                                      },
                                      "sub_totals": [
                                        -11441.46,
                                        216900.47,
                                        721.25,
                                        -30583.75,
                                        18.85,
                                        -2809.24,
                                        172806.12
                                      ]
                                    },
                                    "values": [
                                      -11441.46,
                                      -78254.21,
                                      434.99,
                                      -843,
                                      18.85,
                                      0,
                                      -90084.83
                                    ]
                                  }
                                ],
                                "id": "acc_aVBWoEGdrKhFX57dTuB3v2",
                                "label": "4654 Glass and Sons",
                                "metadata": {
                                  "accounts": [
                                    "acc_aVBWoEGdrKhFX57dTuB3v2"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_aVBWoEGdrKhFX57dTuB3v2",
                                  "label": "Total 4654 Glass and Sons",
                                  "metadata": {
                                    "accounts": [
                                      "acc_aVBWoEGdrKhFX57dTuB3v2",
                                      "acc_k7ZD5hrbMmoBBwFVe9ZaNj"
                                    ]
                                  },
                                  "sub_totals": [
                                    -11441.46,
                                    250854.64,
                                    738.88,
                                    -30583.75,
                                    18.85,
                                    -2809.24,
                                    206777.92
                                  ]
                                },
                                "values": [
                                  0,
                                  33954.17,
                                  17.63,
                                  0,
                                  0,
                                  0,
                                  33971.8
                                ]
                              }
                            ],
                            "group": "OTHER_INCOME",
                            "id": "OTHER_INCOME",
                            "label": "Other Income",
                            "metadata": {
                              "sub_classifications": [
                                "OTHER_INCOME"
                              ]
                            },
                            "summary": {
                              "id": "summary_other_income",
                              "label": "Total Other Income",
                              "metadata": {},
                              "sub_totals": [
                                0,
                                295154.68,
                                286.26,
                                -29740.75,
                                0,
                                -2809.24,
                                262890.95
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [
                                              {
                                                "children": [],
                                                "id": "acc_gpjJY9Crkpdzi49ELUQF6u",
                                                "label": "9558 Porter Group",
                                                "metadata": {
                                                  "accounts": [
                                                    "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                  ]
                                                },
                                                "summary": {
                                                  "id": "summary_acc_gpjJY9Crkpdzi49ELUQF6u",
                                                  "label": "Total 9558 Porter Group",
                                                  "metadata": {
                                                    "accounts": [
                                                      "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                    ]
                                                  },
                                                  "sub_totals": [
                                                    0,
                                                    0,
                                                    168.8,
                                                    9.26,
                                                    -1757850.26,
                                                    0,
                                                    -1757672.2
                                                  ]
                                                },
                                                "values": [
                                                  0,
                                                  0,
                                                  168.8,
                                                  9.26,
                                                  -1757850.26,
                                                  0,
                                                  -1757672.2
                                                ]
                                              }
                                            ],
                                            "id": "acc_XCry4baixEx2bRfVFDVDDs",
                                            "label": "9065 Johnson-Bell",
                                            "metadata": {
                                              "accounts": [
                                                "acc_XCry4baixEx2bRfVFDVDDs"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_XCry4baixEx2bRfVFDVDDs",
                                              "label": "Total 9065 Johnson-Bell",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_XCry4baixEx2bRfVFDVDDs",
                                                  "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                ]
                                              },
                                              "sub_totals": [
                                                -191,
                                                0,
                                                168.8,
                                                1689.44,
                                                -1749397.87,
                                                96358.58,
                                                -1651372.05
                                              ]
                                            },
                                            "values": [
                                              -191,
                                              0,
                                              0,
                                              1680.18,
                                              8452.39,
                                              96358.58,
                                              106300.15
                                            ]
                                          }
                                        ],
                                        "id": "acc_cFKHf5xHV5VFfj9zWeWK92",
                                        "label": "4192 Roberts-Chapman",
                                        "metadata": {
                                          "accounts": [
                                            "acc_cFKHf5xHV5VFfj9zWeWK92"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_cFKHf5xHV5VFfj9zWeWK92",
                                          "label": "Total 4192 Roberts-Chapman",
                                          "metadata": {
                                            "accounts": [
                                              "acc_cFKHf5xHV5VFfj9zWeWK92",
                                              "acc_XCry4baixEx2bRfVFDVDDs"
                                            ]
                                          },
                                          "sub_totals": [
                                            -712.93,
                                            0,
                                            56.54,
                                            481.4,
                                            -1749397.87,
                                            112831.39,
                                            -1636741.47
                                          ]
                                        },
                                        "values": [
                                          -521.93,
                                          0,
                                          -112.26,
                                          -1208.04,
                                          0,
                                          16472.81,
                                          14630.58
                                        ]
                                      }
                                    ],
                                    "id": "acc_dNqQEL5MXEhwcGmrsrdsoU",
                                    "label": "5978 Richardson, Bauer and Reed",
                                    "metadata": {
                                      "accounts": [
                                        "acc_dNqQEL5MXEhwcGmrsrdsoU"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_dNqQEL5MXEhwcGmrsrdsoU",
                                      "label": "Total 5978 Richardson, Bauer and Reed",
                                      "metadata": {
                                        "accounts": [
                                          "acc_dNqQEL5MXEhwcGmrsrdsoU",
                                          "acc_cFKHf5xHV5VFfj9zWeWK92"
                                        ]
                                      },
                                      "sub_totals": [
                                        -712.93,
                                        46673.61,
                                        56.54,
                                        2685.46,
                                        -1749402.21,
                                        113091.11,
                                        -1587608.42
                                      ]
                                    },
                                    "values": [
                                      0,
                                      46673.61,
                                      0,
                                      2204.06,
                                      -4.34,
                                      259.72,
                                      49133.05
                                    ]
                                  }
                                ],
                                "id": "acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                "label": "9677 Evans-Trujillo",
                                "metadata": {
                                  "accounts": [
                                    "acc_fo8cC2Q8FT3fWwjyZ8qJZD"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                  "label": "Total 9677 Evans-Trujillo",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                      "acc_dNqQEL5MXEhwcGmrsrdsoU"
                                    ]
                                  },
                                  "sub_totals": [
                                    3674.46,
                                    46673.61,
                                    535.96,
                                    2685.46,
                                    -1736183.08,
                                    113091.11,
                                    -1569522.48
                                  ]
                                },
                                "values": [
                                  4387.39,
                                  0,
                                  479.42,
                                  0,
                                  13219.13,
                                  0,
                                  18085.94
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_A2TGPLs2ghKMGtaSPSV8JF",
                                "label": "531 Exchange Gain or Loss",
                                "metadata": {
                                  "accounts": [
                                    "acc_A2TGPLs2ghKMGtaSPSV8JF"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_A2TGPLs2ghKMGtaSPSV8JF",
                                  "label": "Total 531 Exchange Gain or Loss",
                                  "metadata": {
                                    "accounts": [
                                      "acc_A2TGPLs2ghKMGtaSPSV8JF"
                                    ]
                                  },
                                  "sub_totals": [
                                    9944.14,
                                    -4780.47,
                                    11176.65,
                                    1187.37,
                                    9935.85,
                                    -11291.33,
                                    16172.21
                                  ]
                                },
                                "values": [
                                  9944.14,
                                  -4780.47,
                                  11176.65,
                                  1187.37,
                                  9935.85,
                                  -11291.33,
                                  16172.21
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_MjKsTpSfrvasBfWACxkukW",
                                "label": "532 Unrealized Gains and Losses",
                                "metadata": {
                                  "accounts": [
                                    "acc_MjKsTpSfrvasBfWACxkukW"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_MjKsTpSfrvasBfWACxkukW",
                                  "label": "Total 532 Unrealized Gains and Losses",
                                  "metadata": {
                                    "accounts": [
                                      "acc_MjKsTpSfrvasBfWACxkukW"
                                    ]
                                  },
                                  "sub_totals": [
                                    -871.76,
                                    0,
                                    0,
                                    1.1,
                                    2270.68,
                                    0,
                                    1400.02
                                  ]
                                },
                                "values": [
                                  -871.76,
                                  0,
                                  0,
                                  1.1,
                                  2270.68,
                                  0,
                                  1400.02
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_jUKNwNM5bpdJU7QGgbttYR",
                                "label": "533 Uncategorized",
                                "metadata": {
                                  "accounts": [
                                    "acc_jUKNwNM5bpdJU7QGgbttYR"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_jUKNwNM5bpdJU7QGgbttYR",
                                  "label": "Total 533 Uncategorized",
                                  "metadata": {
                                    "accounts": [
                                      "acc_jUKNwNM5bpdJU7QGgbttYR"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    2864.55,
                                    -345.45,
                                    0,
                                    -135.19,
                                    7450.94,
                                    9834.85
                                  ]
                                },
                                "values": [
                                  0,
                                  2864.55,
                                  -345.45,
                                  0,
                                  -135.19,
                                  7450.94,
                                  9834.85
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_WF8msFwMAczS7mQk3ViRMs",
                                "label": "534 Meals and Entertainment",
                                "metadata": {
                                  "accounts": [
                                    "acc_WF8msFwMAczS7mQk3ViRMs"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_WF8msFwMAczS7mQk3ViRMs",
                                  "label": "Total 534 Meals and Entertainment",
                                  "metadata": {
                                    "accounts": [
                                      "acc_WF8msFwMAczS7mQk3ViRMs"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    3620.38,
                                    0,
                                    237346.38,
                                    -1996.09,
                                    -116.86,
                                    238853.81
                                  ]
                                },
                                "values": [
                                  0,
                                  3620.38,
                                  0,
                                  237346.38,
                                  -1996.09,
                                  -116.86,
                                  238853.81
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Hu8bjiaAfm6sCUaTnmAjcq",
                                "label": "535 Depreciation Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_Hu8bjiaAfm6sCUaTnmAjcq"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Hu8bjiaAfm6sCUaTnmAjcq",
                                  "label": "Total 535 Depreciation Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Hu8bjiaAfm6sCUaTnmAjcq"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    333.48,
                                    -1644.26,
                                    -432.51,
                                    8939.39,
                                    18.09,
                                    7214.19
                                  ]
                                },
                                "values": [
                                  0,
                                  333.48,
                                  -1644.26,
                                  -432.51,
                                  8939.39,
                                  18.09,
                                  7214.19
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_kNYTyrAk4ER98h3XEktfuH",
                                "label": "536 Other Expenses",
                                "metadata": {
                                  "accounts": [
                                    "acc_kNYTyrAk4ER98h3XEktfuH"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_kNYTyrAk4ER98h3XEktfuH",
                                  "label": "Total 536 Other Expenses",
                                  "metadata": {
                                    "accounts": [
                                      "acc_kNYTyrAk4ER98h3XEktfuH"
                                    ]
                                  },
                                  "sub_totals": [
                                    1731889.83,
                                    48.43,
                                    -27.75,
                                    -11732.63,
                                    -325.55,
                                    5675.47,
                                    1725527.8
                                  ]
                                },
                                "values": [
                                  1731889.83,
                                  48.43,
                                  -27.75,
                                  -11732.63,
                                  -325.55,
                                  5675.47,
                                  1725527.8
                                ]
                              }
                            ],
                            "group": "NON_OPERATING_EXPENSE",
                            "id": "NON_OPERATING_EXPENSE",
                            "label": "Non-Operating Expenses",
                            "metadata": {
                              "sub_classifications": [
                                "NON_OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_non_operating_expense",
                              "label": "Total Non-Operating Expenses",
                              "metadata": {},
                              "sub_totals": [
                                1740249.28,
                                2086.37,
                                9215.73,
                                226851.11,
                                -1730708.78,
                                114567.7,
                                362261.41
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "NET_PROFIT",
                            "id": "NET_PROFIT",
                            "label": "Net Profit",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES",
                                "OPERATING_EXPENSES",
                                "OTHER_INCOME",
                                "NON_OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_net_profit",
                              "label": "Net Profit",
                              "metadata": {},
                              "sub_totals": [
                                253897.27,
                                -606421.15,
                                412079.78,
                                590462.1,
                                -1761570.26,
                                13827.9,
                                -1097724.36
                              ]
                            }
                          }
                        ]
                      }
                    ]
                  },
                  "Month": {
                    "description": "Response grouped by month from Jan 2024 and 6 months back",
                    "summary": "Group by month",
                    "value": [
                      {
                        "columns": [
                          {
                            "id": "2022-01-01",
                            "label": "Jan 2022",
                            "metadata": {
                              "from_date": "2022-01-01",
                              "to_date": "2022-01-31"
                            }
                          },
                          {
                            "id": "2022-02-01",
                            "label": "Feb 2022",
                            "metadata": {
                              "from_date": "2022-02-01",
                              "to_date": "2022-02-28"
                            }
                          },
                          {
                            "id": "2022-03-01",
                            "label": "Mar 2022",
                            "metadata": {
                              "from_date": "2022-03-01",
                              "to_date": "2022-03-31"
                            }
                          },
                          {
                            "id": "2022-04-01",
                            "label": "Apr 2022",
                            "metadata": {
                              "from_date": "2022-04-01",
                              "to_date": "2022-04-30"
                            }
                          },
                          {
                            "id": "2022-05-01",
                            "label": "May 2022",
                            "metadata": {
                              "from_date": "2022-05-01",
                              "to_date": "2022-05-31"
                            }
                          },
                          {
                            "id": "2022-06-01",
                            "label": "Jun 2022",
                            "metadata": {
                              "from_date": "2022-06-01",
                              "to_date": "2022-06-30"
                            }
                          },
                          {
                            "id": "2022-07-01",
                            "label": "Jul 2022",
                            "metadata": {
                              "from_date": "2022-07-01",
                              "to_date": "2022-07-31"
                            }
                          },
                          {
                            "id": "2022-08-01",
                            "label": "Aug 2022",
                            "metadata": {
                              "from_date": "2022-08-01",
                              "to_date": "2022-08-31"
                            }
                          },
                          {
                            "id": "2022-09-01",
                            "label": "Sep 2022",
                            "metadata": {
                              "from_date": "2022-09-01",
                              "to_date": "2022-09-30"
                            }
                          },
                          {
                            "id": "2022-10-01",
                            "label": "Oct 2022",
                            "metadata": {
                              "from_date": "2022-10-01",
                              "to_date": "2022-10-31"
                            }
                          },
                          {
                            "id": "2022-11-01",
                            "label": "Nov 2022",
                            "metadata": {
                              "from_date": "2022-11-01",
                              "to_date": "2022-11-30"
                            }
                          },
                          {
                            "id": "2022-12-01",
                            "label": "Dec 2022",
                            "metadata": {
                              "from_date": "2022-12-01",
                              "to_date": "2022-12-31"
                            }
                          },
                          {
                            "id": "row_totals",
                            "label": "Totals",
                            "metadata": {
                              "from_date": "2022-01-01",
                              "to_date": "2022-12-31"
                            }
                          }
                        ],
                        "overview": {
                          "created_ts": "2024-01-05T00:00:00Z",
                          "currency": "SAR",
                          "date_from": "2022-01-01",
                          "date_to": "2022-12-31",
                          "filters": {},
                          "group_by": "month",
                          "id": "profit_and_loss",
                          "label": "Profit and Loss Report"
                        },
                        "rows": [
                          {
                            "children": [
                              {
                                "children": [],
                                "id": "acc_GwwXGSvDi2nHKCecyxXexo",
                                "label": "2663 GB31PYKS95133433234680",
                                "metadata": {
                                  "accounts": [
                                    "acc_GwwXGSvDi2nHKCecyxXexo"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_GwwXGSvDi2nHKCecyxXexo",
                                  "label": "Total 2663 GB31PYKS95133433234680",
                                  "metadata": {
                                    "accounts": [
                                      "acc_GwwXGSvDi2nHKCecyxXexo"
                                    ]
                                  },
                                  "sub_totals": [
                                    -165.32,
                                    0,
                                    3580.5,
                                    -1461.78,
                                    -1091648.66,
                                    -3451.62,
                                    629.41,
                                    0,
                                    -356028.9,
                                    5726.63,
                                    9413.55,
                                    296127.86,
                                    -1137278.33
                                  ]
                                },
                                "values": [
                                  -165.32,
                                  0,
                                  3580.5,
                                  -1461.78,
                                  -1091648.66,
                                  -3451.62,
                                  629.41,
                                  0,
                                  -356028.9,
                                  5726.63,
                                  9413.55,
                                  296127.86,
                                  -1137278.33
                                ]
                              },
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_h3mudXDb52V9naLfh9DVBi",
                                            "label": "2191 Hanna Group",
                                            "metadata": {
                                              "accounts": [
                                                "acc_h3mudXDb52V9naLfh9DVBi"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_h3mudXDb52V9naLfh9DVBi",
                                              "label": "Total 2191 Hanna Group",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_h3mudXDb52V9naLfh9DVBi"
                                                ]
                                              },
                                              "sub_totals": [
                                                0,
                                                758776.72,
                                                -6157.39,
                                                -3426.08,
                                                0,
                                                23213.59,
                                                -7306.34,
                                                -195521.05,
                                                -11997.51,
                                                0,
                                                -549.07,
                                                0,
                                                557032.87
                                              ]
                                            },
                                            "values": [
                                              0,
                                              758776.72,
                                              -6157.39,
                                              -3426.08,
                                              0,
                                              23213.59,
                                              -7306.34,
                                              -195521.05,
                                              -11997.51,
                                              0,
                                              -549.07,
                                              0,
                                              557032.87
                                            ]
                                          }
                                        ],
                                        "id": "acc_8dXpkHH9yHGwpfKmiNx8HA",
                                        "label": "6883 Goodwin-Harper",
                                        "metadata": {
                                          "accounts": [
                                            "acc_8dXpkHH9yHGwpfKmiNx8HA"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_8dXpkHH9yHGwpfKmiNx8HA",
                                          "label": "Total 6883 Goodwin-Harper",
                                          "metadata": {
                                            "accounts": [
                                              "acc_8dXpkHH9yHGwpfKmiNx8HA",
                                              "acc_h3mudXDb52V9naLfh9DVBi"
                                            ]
                                          },
                                          "sub_totals": [
                                            4683.59,
                                            853287.75,
                                            6723.86,
                                            -1510254.41,
                                            37533.15,
                                            22503.38,
                                            681.34,
                                            -210632.53,
                                            -9083.53,
                                            -152.58,
                                            -549.07,
                                            2379.08,
                                            -802879.97
                                          ]
                                        },
                                        "values": [
                                          4683.59,
                                          94511.03,
                                          12881.25,
                                          -1506828.33,
                                          37533.15,
                                          -710.21,
                                          7987.68,
                                          -15111.48,
                                          2913.98,
                                          -152.58,
                                          0,
                                          2379.08,
                                          -1359912.84
                                        ]
                                      }
                                    ],
                                    "id": "acc_SUpT3JjnPj44pXGyVLM2T9",
                                    "label": "3232 Thompson Inc",
                                    "metadata": {
                                      "accounts": [
                                        "acc_SUpT3JjnPj44pXGyVLM2T9"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_SUpT3JjnPj44pXGyVLM2T9",
                                      "label": "Total 3232 Thompson Inc",
                                      "metadata": {
                                        "accounts": [
                                          "acc_SUpT3JjnPj44pXGyVLM2T9",
                                          "acc_8dXpkHH9yHGwpfKmiNx8HA"
                                        ]
                                      },
                                      "sub_totals": [
                                        4683.59,
                                        853287.75,
                                        -57519.12,
                                        -1509290.33,
                                        44266.21,
                                        22503.38,
                                        68078.16,
                                        -210632.53,
                                        -5519.04,
                                        -152.58,
                                        -3355.79,
                                        2495.67,
                                        -791154.63
                                      ]
                                    },
                                    "values": [
                                      0,
                                      0,
                                      -64242.98,
                                      964.08,
                                      6733.06,
                                      0,
                                      67396.82,
                                      0,
                                      3564.49,
                                      0,
                                      -2806.72,
                                      116.59,
                                      11725.34
                                    ]
                                  }
                                ],
                                "id": "acc_3aMMeaGLXEj2nkBBkTAXCh",
                                "label": "7066 Medina-Santos",
                                "metadata": {
                                  "accounts": [
                                    "acc_3aMMeaGLXEj2nkBBkTAXCh"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_3aMMeaGLXEj2nkBBkTAXCh",
                                  "label": "Total 7066 Medina-Santos",
                                  "metadata": {
                                    "accounts": [
                                      "acc_3aMMeaGLXEj2nkBBkTAXCh",
                                      "acc_SUpT3JjnPj44pXGyVLM2T9"
                                    ]
                                  },
                                  "sub_totals": [
                                    2814.04,
                                    872537.21,
                                    -57487.16,
                                    -1563515.98,
                                    50918.05,
                                    63173.18,
                                    66687.9,
                                    -211290.96,
                                    -5519.04,
                                    -88695.77,
                                    -3281.62,
                                    -560.1,
                                    -874220.25
                                  ]
                                },
                                "values": [
                                  -1869.55,
                                  19249.46,
                                  31.96,
                                  -54225.65,
                                  6651.84,
                                  40669.8,
                                  -1390.26,
                                  -658.43,
                                  0,
                                  -88543.19,
                                  74.17,
                                  -3055.77,
                                  -83065.62
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Bv3z5sii7aXDhxXZV8Sqrb",
                                "label": "8899 GB42DLQG70743971530332",
                                "metadata": {
                                  "accounts": [
                                    "acc_Bv3z5sii7aXDhxXZV8Sqrb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Bv3z5sii7aXDhxXZV8Sqrb",
                                  "label": "Total 8899 GB42DLQG70743971530332",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Bv3z5sii7aXDhxXZV8Sqrb"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    -2927.43,
                                    716.08,
                                    -506.74,
                                    -193.63,
                                    -15801.16,
                                    475.95,
                                    -4909.64,
                                    -1009.61,
                                    3437.86,
                                    0,
                                    0,
                                    -20718.32
                                  ]
                                },
                                "values": [
                                  0,
                                  -2927.43,
                                  716.08,
                                  -506.74,
                                  -193.63,
                                  -15801.16,
                                  475.95,
                                  -4909.64,
                                  -1009.61,
                                  3437.86,
                                  0,
                                  0,
                                  -20718.32
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_EVeNzPbZXnnCiidM4mGcbf",
                                "label": "9694 GB43IVCI82994294137386",
                                "metadata": {
                                  "accounts": [
                                    "acc_EVeNzPbZXnnCiidM4mGcbf"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_EVeNzPbZXnnCiidM4mGcbf",
                                  "label": "Total 9694 GB43IVCI82994294137386",
                                  "metadata": {
                                    "accounts": [
                                      "acc_EVeNzPbZXnnCiidM4mGcbf"
                                    ]
                                  },
                                  "sub_totals": [
                                    3753.07,
                                    -12023.97,
                                    -4.4,
                                    0,
                                    -77868.52,
                                    -2688.61,
                                    0,
                                    -613.45,
                                    -4178.2,
                                    530.8,
                                    -459.17,
                                    -1279.72,
                                    -94832.17
                                  ]
                                },
                                "values": [
                                  3753.07,
                                  -12023.97,
                                  -4.4,
                                  0,
                                  -77868.52,
                                  -2688.61,
                                  0,
                                  -613.45,
                                  -4178.2,
                                  530.8,
                                  -459.17,
                                  -1279.72,
                                  -94832.17
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_fGZ5RrRSas7k46FFk3U5rb",
                                "label": "411 Sales",
                                "metadata": {
                                  "accounts": [
                                    "acc_fGZ5RrRSas7k46FFk3U5rb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fGZ5RrRSas7k46FFk3U5rb",
                                  "label": "Total 411 Sales",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fGZ5RrRSas7k46FFk3U5rb"
                                    ]
                                  },
                                  "sub_totals": [
                                    20463.76,
                                    31893.02,
                                    20587.45,
                                    -2581.15,
                                    -48284.91,
                                    799.49,
                                    -8848.63,
                                    4342.74,
                                    -2274.52,
                                    -2156.8,
                                    18369.82,
                                    -14395.37,
                                    17914.9
                                  ]
                                },
                                "values": [
                                  20463.76,
                                  31893.02,
                                  20587.45,
                                  -2581.15,
                                  -48284.91,
                                  799.49,
                                  -8848.63,
                                  4342.74,
                                  -2274.52,
                                  -2156.8,
                                  18369.82,
                                  -14395.37,
                                  17914.9
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_nGFXazi6c3BBLg6Rs8564P",
                                "label": "412 Interest Income",
                                "metadata": {
                                  "accounts": [
                                    "acc_nGFXazi6c3BBLg6Rs8564P"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_nGFXazi6c3BBLg6Rs8564P",
                                  "label": "Total 412 Interest Income",
                                  "metadata": {
                                    "accounts": [
                                      "acc_nGFXazi6c3BBLg6Rs8564P"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    22480.04,
                                    821326.71,
                                    58670.18,
                                    0,
                                    0,
                                    3795621.24,
                                    151522.75,
                                    734.85,
                                    -12763257.23,
                                    0,
                                    23286.08,
                                    -7889615.38
                                  ]
                                },
                                "values": [
                                  0,
                                  22480.04,
                                  821326.71,
                                  58670.18,
                                  0,
                                  0,
                                  3795621.24,
                                  151522.75,
                                  734.85,
                                  -12763257.23,
                                  0,
                                  23286.08,
                                  -7889615.38
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_n8DgFgrhEP6qPkVEb8meu3",
                                "label": "413 Late Fee Income",
                                "metadata": {
                                  "accounts": [
                                    "acc_n8DgFgrhEP6qPkVEb8meu3"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_n8DgFgrhEP6qPkVEb8meu3",
                                  "label": "Total 413 Late Fee Income",
                                  "metadata": {
                                    "accounts": [
                                      "acc_n8DgFgrhEP6qPkVEb8meu3"
                                    ]
                                  },
                                  "sub_totals": [
                                    19052.25,
                                    -5569.51,
                                    -6.92,
                                    569.16,
                                    992.34,
                                    -4996.8,
                                    1313.9,
                                    156.48,
                                    -169490.55,
                                    0,
                                    1821.85,
                                    -3000.02,
                                    -159157.82
                                  ]
                                },
                                "values": [
                                  19052.25,
                                  -5569.51,
                                  -6.92,
                                  569.16,
                                  992.34,
                                  -4996.8,
                                  1313.9,
                                  156.48,
                                  -169490.55,
                                  0,
                                  1821.85,
                                  -3000.02,
                                  -159157.82
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_AkTASCAaMJtamv9NY8Qys5",
                                "label": "414 Shipping Charge",
                                "metadata": {
                                  "accounts": [
                                    "acc_AkTASCAaMJtamv9NY8Qys5"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_AkTASCAaMJtamv9NY8Qys5",
                                  "label": "Total 414 Shipping Charge",
                                  "metadata": {
                                    "accounts": [
                                      "acc_AkTASCAaMJtamv9NY8Qys5"
                                    ]
                                  },
                                  "sub_totals": [
                                    39725.13,
                                    -70.48,
                                    25183.88,
                                    -49.83,
                                    0,
                                    -2325.81,
                                    0,
                                    -94868.61,
                                    1120.67,
                                    5082.7,
                                    7268099.49,
                                    2747.96,
                                    7244645.1
                                  ]
                                },
                                "values": [
                                  39725.13,
                                  -70.48,
                                  25183.88,
                                  -49.83,
                                  0,
                                  -2325.81,
                                  0,
                                  -94868.61,
                                  1120.67,
                                  5082.7,
                                  7268099.49,
                                  2747.96,
                                  7244645.1
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_WCU3XXtzqSVs9AVwmbv3Ro",
                                "label": "415 Other Charges",
                                "metadata": {
                                  "accounts": [
                                    "acc_WCU3XXtzqSVs9AVwmbv3Ro"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_WCU3XXtzqSVs9AVwmbv3Ro",
                                  "label": "Total 415 Other Charges",
                                  "metadata": {
                                    "accounts": [
                                      "acc_WCU3XXtzqSVs9AVwmbv3Ro"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    0,
                                    376.48,
                                    1057.12,
                                    -908252.51,
                                    1857.26,
                                    -776.35,
                                    -5706.54,
                                    -6742.1,
                                    16905.94,
                                    -4437420.54,
                                    51.04,
                                    -5338650.2
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  376.48,
                                  1057.12,
                                  -908252.51,
                                  1857.26,
                                  -776.35,
                                  -5706.54,
                                  -6742.1,
                                  16905.94,
                                  -4437420.54,
                                  51.04,
                                  -5338650.2
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_A86ZVhuCEZU7bCgJ3pAhZR",
                                "label": "416 Discount",
                                "metadata": {
                                  "accounts": [
                                    "acc_A86ZVhuCEZU7bCgJ3pAhZR"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_A86ZVhuCEZU7bCgJ3pAhZR",
                                  "label": "Total 416 Discount",
                                  "metadata": {
                                    "accounts": [
                                      "acc_A86ZVhuCEZU7bCgJ3pAhZR"
                                    ]
                                  },
                                  "sub_totals": [
                                    -5955.67,
                                    0,
                                    0,
                                    -26625.23,
                                    0,
                                    -23960.35,
                                    -68.41,
                                    -35541.53,
                                    -49.94,
                                    805708.3,
                                    15459.06,
                                    -107.54,
                                    728858.69
                                  ]
                                },
                                "values": [
                                  -5955.67,
                                  0,
                                  0,
                                  -26625.23,
                                  0,
                                  -23960.35,
                                  -68.41,
                                  -35541.53,
                                  -49.94,
                                  805708.3,
                                  15459.06,
                                  -107.54,
                                  728858.69
                                ]
                              }
                            ],
                            "group": "INCOME",
                            "id": "INCOME",
                            "label": "Income",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME"
                              ]
                            },
                            "summary": {
                              "id": "summary_income",
                              "label": "Total Income",
                              "metadata": {},
                              "sub_totals": [
                                77969.06,
                                902020.82,
                                874191.46,
                                -1479214.16,
                                -918011.93,
                                -6122.83,
                                3787923.09,
                                -190727.24,
                                -185785.12,
                                -11937869.67,
                                2865780.61,
                                10961.23,
                                -6198884.68
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [
                                              {
                                                "children": [],
                                                "id": "acc_hV2CkyYXmZXvy2iKQz2yei",
                                                "label": "1624 Bell, Campbell and Joseph",
                                                "metadata": {
                                                  "accounts": [
                                                    "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                  ]
                                                },
                                                "summary": {
                                                  "id": "summary_acc_hV2CkyYXmZXvy2iKQz2yei",
                                                  "label": "Total 1624 Bell, Campbell and Joseph",
                                                  "metadata": {
                                                    "accounts": [
                                                      "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                    ]
                                                  },
                                                  "sub_totals": [
                                                    19.55,
                                                    1809.43,
                                                    9639.96,
                                                    -120.49,
                                                    0,
                                                    0,
                                                    6943.37,
                                                    -1383.16,
                                                    88088.55,
                                                    -11114.47,
                                                    422.31,
                                                    -67.85,
                                                    94237.2
                                                  ]
                                                },
                                                "values": [
                                                  19.55,
                                                  1809.43,
                                                  9639.96,
                                                  -120.49,
                                                  0,
                                                  0,
                                                  6943.37,
                                                  -1383.16,
                                                  88088.55,
                                                  -11114.47,
                                                  422.31,
                                                  -67.85,
                                                  94237.2
                                                ]
                                              }
                                            ],
                                            "id": "acc_2mxViQpX3regpQSrcWqCM2",
                                            "label": "5430 Clark-Robertson",
                                            "metadata": {
                                              "accounts": [
                                                "acc_2mxViQpX3regpQSrcWqCM2"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_2mxViQpX3regpQSrcWqCM2",
                                              "label": "Total 5430 Clark-Robertson",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_2mxViQpX3regpQSrcWqCM2",
                                                  "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                ]
                                              },
                                              "sub_totals": [
                                                -5166.28,
                                                13999.8,
                                                9639.96,
                                                6848.49,
                                                0,
                                                0,
                                                -29190.4,
                                                -1227.09,
                                                87546.8,
                                                -10101.04,
                                                -39149.57,
                                                2319.16,
                                                35519.83
                                              ]
                                            },
                                            "values": [
                                              -5185.83,
                                              12190.37,
                                              0,
                                              6968.98,
                                              0,
                                              0,
                                              -36133.77,
                                              156.07,
                                              -541.75,
                                              1013.43,
                                              -39571.88,
                                              2387.01,
                                              -58717.37
                                            ]
                                          }
                                        ],
                                        "id": "acc_hEGoCD9ffFhQepj3srzDVs",
                                        "label": "1245 Washington-Clayton",
                                        "metadata": {
                                          "accounts": [
                                            "acc_hEGoCD9ffFhQepj3srzDVs"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_hEGoCD9ffFhQepj3srzDVs",
                                          "label": "Total 1245 Washington-Clayton",
                                          "metadata": {
                                            "accounts": [
                                              "acc_hEGoCD9ffFhQepj3srzDVs",
                                              "acc_2mxViQpX3regpQSrcWqCM2"
                                            ]
                                          },
                                          "sub_totals": [
                                            -77551.14,
                                            -113.8,
                                            9258.57,
                                            6848.49,
                                            3340.39,
                                            0,
                                            -30060.46,
                                            7783.6,
                                            88165.49,
                                            -9693.76,
                                            -39149.57,
                                            -37807.33,
                                            -78979.52
                                          ]
                                        },
                                        "values": [
                                          -72384.86,
                                          -14113.6,
                                          -381.39,
                                          0,
                                          3340.39,
                                          0,
                                          -870.06,
                                          9010.69,
                                          618.69,
                                          407.28,
                                          0,
                                          -40126.49,
                                          -114499.35
                                        ]
                                      }
                                    ],
                                    "id": "acc_ULicU8jieyR9UuqiM9ovoL",
                                    "label": "6576 Holloway, Strong and Hicks",
                                    "metadata": {
                                      "accounts": [
                                        "acc_ULicU8jieyR9UuqiM9ovoL"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_ULicU8jieyR9UuqiM9ovoL",
                                      "label": "Total 6576 Holloway, Strong and Hicks",
                                      "metadata": {
                                        "accounts": [
                                          "acc_ULicU8jieyR9UuqiM9ovoL",
                                          "acc_hEGoCD9ffFhQepj3srzDVs"
                                        ]
                                      },
                                      "sub_totals": [
                                        -5052313.43,
                                        -113.8,
                                        9290.23,
                                        6419.56,
                                        -5239.98,
                                        -8666.89,
                                        18438.41,
                                        -2868831.78,
                                        88869.74,
                                        -277129.85,
                                        -38910.88,
                                        -37795.84,
                                        -8165984.51
                                      ]
                                    },
                                    "values": [
                                      -4974762.29,
                                      0,
                                      31.66,
                                      -428.93,
                                      -8580.37,
                                      -8666.89,
                                      48498.87,
                                      -2876615.38,
                                      704.25,
                                      -267436.09,
                                      238.69,
                                      11.49,
                                      -8087004.99
                                    ]
                                  }
                                ],
                                "id": "acc_9YNpqmbHjrZN6oFL2SX7jm",
                                "label": "2721 Sheppard and Sons",
                                "metadata": {
                                  "accounts": [
                                    "acc_9YNpqmbHjrZN6oFL2SX7jm"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_9YNpqmbHjrZN6oFL2SX7jm",
                                  "label": "Total 2721 Sheppard and Sons",
                                  "metadata": {
                                    "accounts": [
                                      "acc_9YNpqmbHjrZN6oFL2SX7jm",
                                      "acc_ULicU8jieyR9UuqiM9ovoL"
                                    ]
                                  },
                                  "sub_totals": [
                                    -5051557.43,
                                    22747.43,
                                    14396.53,
                                    6419.56,
                                    -4499.64,
                                    -797.33,
                                    22038.22,
                                    -2858615.87,
                                    122229.29,
                                    -256047.8,
                                    -38800.35,
                                    -37795.84,
                                    -8060283.23
                                  ]
                                },
                                "values": [
                                  756,
                                  22861.23,
                                  5106.3,
                                  0,
                                  740.34,
                                  7869.56,
                                  3599.81,
                                  10215.91,
                                  33359.55,
                                  21082.05,
                                  110.53,
                                  0,
                                  105701.28
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_dqNwix5yRwuQgB9pzQCjXb",
                                "label": "511 Cost of Goods Sold",
                                "metadata": {
                                  "accounts": [
                                    "acc_dqNwix5yRwuQgB9pzQCjXb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_dqNwix5yRwuQgB9pzQCjXb",
                                  "label": "Total 511 Cost of Goods Sold",
                                  "metadata": {
                                    "accounts": [
                                      "acc_dqNwix5yRwuQgB9pzQCjXb"
                                    ]
                                  },
                                  "sub_totals": [
                                    -14038.94,
                                    -8646.19,
                                    -23962.93,
                                    2777.42,
                                    35169.25,
                                    28066.03,
                                    437621.34,
                                    192605.26,
                                    -588819.6,
                                    -963.83,
                                    -8670.33,
                                    -5986.02,
                                    45151.46
                                  ]
                                },
                                "values": [
                                  -14038.94,
                                  -8646.19,
                                  -23962.93,
                                  2777.42,
                                  35169.25,
                                  28066.03,
                                  437621.34,
                                  192605.26,
                                  -588819.6,
                                  -963.83,
                                  -8670.33,
                                  -5986.02,
                                  45151.46
                                ]
                              }
                            ],
                            "group": "COGS",
                            "id": "COGS",
                            "label": "Cost of Sales",
                            "metadata": {
                              "sub_classifications": [
                                "COST_OF_SALES"
                              ]
                            },
                            "summary": {
                              "id": "summary_cogs",
                              "label": "Total Cost of Sales",
                              "metadata": {},
                              "sub_totals": [
                                -91590.08,
                                -8759.99,
                                -14704.36,
                                9625.91,
                                38509.64,
                                28066.03,
                                407560.88,
                                200388.86,
                                -500654.11,
                                -10657.59,
                                -47819.9,
                                -43793.35,
                                -33828.06
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "GROSS_MARGIN",
                            "id": "GROSS_MARGIN",
                            "label": "Gross Profit",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES"
                              ]
                            },
                            "summary": {
                              "id": "summary_gross_margin",
                              "label": "Gross Profit",
                              "metadata": {},
                              "sub_totals": [
                                -13621.02,
                                893260.83,
                                859487.1,
                                -1469588.25,
                                -879502.29,
                                21943.2,
                                4195483.97,
                                9661.62,
                                -686439.23,
                                -11948527.26,
                                2817960.71,
                                -32832.12,
                                -6232712.74
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_XKZ4X8LGL3CfZGBrMjBsf3",
                                            "label": "8963 Vasquez, Bradley and Novak",
                                            "metadata": {
                                              "accounts": [
                                                "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_XKZ4X8LGL3CfZGBrMjBsf3",
                                              "label": "Total 8963 Vasquez, Bradley and Novak",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                                ]
                                              },
                                              "sub_totals": [
                                                16.84,
                                                -1427.55,
                                                -212024.37,
                                                0,
                                                -2552.59,
                                                -34849.93,
                                                131.02,
                                                -3990847.61,
                                                773.79,
                                                5826.9,
                                                -16075.02,
                                                -16136.37,
                                                -4267164.89
                                              ]
                                            },
                                            "values": [
                                              16.84,
                                              -1427.55,
                                              -212024.37,
                                              0,
                                              -2552.59,
                                              -34849.93,
                                              131.02,
                                              -3990847.61,
                                              773.79,
                                              5826.9,
                                              -16075.02,
                                              -16136.37,
                                              -4267164.89
                                            ]
                                          }
                                        ],
                                        "id": "acc_ahzp6b9vysnVSND7ezSnbc",
                                        "label": "7810 Mullins-Mendoza",
                                        "metadata": {
                                          "accounts": [
                                            "acc_ahzp6b9vysnVSND7ezSnbc"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_ahzp6b9vysnVSND7ezSnbc",
                                          "label": "Total 7810 Mullins-Mendoza",
                                          "metadata": {
                                            "accounts": [
                                              "acc_ahzp6b9vysnVSND7ezSnbc",
                                              "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                            ]
                                          },
                                          "sub_totals": [
                                            673.41,
                                            -2013.3,
                                            -207695.86,
                                            -37.15,
                                            -2422.75,
                                            -176401.38,
                                            -6113.78,
                                            -3988163.45,
                                            58907.1,
                                            5866.01,
                                            -16075.02,
                                            -447667.97,
                                            -4781144.14
                                          ]
                                        },
                                        "values": [
                                          656.57,
                                          -585.75,
                                          4328.51,
                                          -37.15,
                                          129.84,
                                          -141551.45,
                                          -6244.8,
                                          2684.16,
                                          58133.31,
                                          39.11,
                                          0,
                                          -431531.6,
                                          -513979.25
                                        ]
                                      }
                                    ],
                                    "id": "acc_54S8UKUaLC7Qz26YxtabHf",
                                    "label": "7545 Johnson Ltd",
                                    "metadata": {
                                      "accounts": [
                                        "acc_54S8UKUaLC7Qz26YxtabHf"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_54S8UKUaLC7Qz26YxtabHf",
                                      "label": "Total 7545 Johnson Ltd",
                                      "metadata": {
                                        "accounts": [
                                          "acc_54S8UKUaLC7Qz26YxtabHf",
                                          "acc_ahzp6b9vysnVSND7ezSnbc"
                                        ]
                                      },
                                      "sub_totals": [
                                        673.41,
                                        1110.36,
                                        -207683.61,
                                        45832.6,
                                        -2422.75,
                                        -254658.69,
                                        861.51,
                                        -3988849.86,
                                        57961.79,
                                        5658.86,
                                        801714.16,
                                        -448898.76,
                                        -3988700.98
                                      ]
                                    },
                                    "values": [
                                      0,
                                      3123.66,
                                      12.25,
                                      45869.75,
                                      0,
                                      -78257.31,
                                      6975.29,
                                      -686.41,
                                      -945.31,
                                      -207.15,
                                      817789.18,
                                      -1230.79,
                                      792443.16
                                    ]
                                  }
                                ],
                                "id": "acc_W4GP34aBqv9NpwPVPP9Toe",
                                "label": "7049 Gallegos-Jones",
                                "metadata": {
                                  "accounts": [
                                    "acc_W4GP34aBqv9NpwPVPP9Toe"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_W4GP34aBqv9NpwPVPP9Toe",
                                  "label": "Total 7049 Gallegos-Jones",
                                  "metadata": {
                                    "accounts": [
                                      "acc_W4GP34aBqv9NpwPVPP9Toe",
                                      "acc_54S8UKUaLC7Qz26YxtabHf"
                                    ]
                                  },
                                  "sub_totals": [
                                    -320.88,
                                    1110.36,
                                    -204248.19,
                                    49883.51,
                                    -3629.31,
                                    -246517.79,
                                    832.33,
                                    -4098747.22,
                                    55266.28,
                                    317085.96,
                                    802413.41,
                                    -448896.92,
                                    -3775768.46
                                  ]
                                },
                                "values": [
                                  -994.29,
                                  0,
                                  3435.42,
                                  4050.91,
                                  -1206.56,
                                  8140.9,
                                  -29.18,
                                  -109897.36,
                                  -2695.51,
                                  311427.1,
                                  699.25,
                                  1.84,
                                  212932.52
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_GVHuwPnwyLpDUKfLTZm5FL",
                                "label": "521 Office Supplies",
                                "metadata": {
                                  "accounts": [
                                    "acc_GVHuwPnwyLpDUKfLTZm5FL"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_GVHuwPnwyLpDUKfLTZm5FL",
                                  "label": "Total 521 Office Supplies",
                                  "metadata": {
                                    "accounts": [
                                      "acc_GVHuwPnwyLpDUKfLTZm5FL"
                                    ]
                                  },
                                  "sub_totals": [
                                    -6574.13,
                                    -8367.5,
                                    -47.3,
                                    4162.44,
                                    -3255.27,
                                    167877.72,
                                    6009.74,
                                    0,
                                    1010.62,
                                    8829903,
                                    -16379.3,
                                    0,
                                    8974340.02
                                  ]
                                },
                                "values": [
                                  -6574.13,
                                  -8367.5,
                                  -47.3,
                                  4162.44,
                                  -3255.27,
                                  167877.72,
                                  6009.74,
                                  0,
                                  1010.62,
                                  8829903,
                                  -16379.3,
                                  0,
                                  8974340.02
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_baw6nBvKaovg6LCwHC3MBV",
                                "label": "5210 Rent Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_baw6nBvKaovg6LCwHC3MBV"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_baw6nBvKaovg6LCwHC3MBV",
                                  "label": "Total 5210 Rent Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_baw6nBvKaovg6LCwHC3MBV"
                                    ]
                                  },
                                  "sub_totals": [
                                    -9894.64,
                                    -11156.54,
                                    51853.09,
                                    398.6,
                                    -50883.28,
                                    0,
                                    6129.27,
                                    5940.38,
                                    89,
                                    -6282.79,
                                    -148458.73,
                                    -277.98,
                                    -162543.62
                                  ]
                                },
                                "values": [
                                  -9894.64,
                                  -11156.54,
                                  51853.09,
                                  398.6,
                                  -50883.28,
                                  0,
                                  6129.27,
                                  5940.38,
                                  89,
                                  -6282.79,
                                  -148458.73,
                                  -277.98,
                                  -162543.62
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_iVA6wA5eZ3kdCdeRhX8sDA",
                                "label": "5211 Janitorial Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_iVA6wA5eZ3kdCdeRhX8sDA"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_iVA6wA5eZ3kdCdeRhX8sDA",
                                  "label": "Total 5211 Janitorial Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_iVA6wA5eZ3kdCdeRhX8sDA"
                                    ]
                                  },
                                  "sub_totals": [
                                    809,
                                    2361.11,
                                    -185.94,
                                    0,
                                    43405.5,
                                    -8732.54,
                                    -231.07,
                                    -149798.5,
                                    79840.54,
                                    33155.25,
                                    0,
                                    14852.97,
                                    15476.32
                                  ]
                                },
                                "values": [
                                  809,
                                  2361.11,
                                  -185.94,
                                  0,
                                  43405.5,
                                  -8732.54,
                                  -231.07,
                                  -149798.5,
                                  79840.54,
                                  33155.25,
                                  0,
                                  14852.97,
                                  15476.32
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_4g58kJWsPB5RE8khF8yciM",
                                "label": "5212 Postage",
                                "metadata": {
                                  "accounts": [
                                    "acc_4g58kJWsPB5RE8khF8yciM"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_4g58kJWsPB5RE8khF8yciM",
                                  "label": "Total 5212 Postage",
                                  "metadata": {
                                    "accounts": [
                                      "acc_4g58kJWsPB5RE8khF8yciM"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    -2.59,
                                    0,
                                    552.38,
                                    1059769.87,
                                    245475.87,
                                    10152.1,
                                    -30104.09,
                                    254545.39,
                                    -1971.66,
                                    -865.36,
                                    -1769.55,
                                    1535782.36
                                  ]
                                },
                                "values": [
                                  0,
                                  -2.59,
                                  0,
                                  552.38,
                                  1059769.87,
                                  245475.87,
                                  10152.1,
                                  -30104.09,
                                  254545.39,
                                  -1971.66,
                                  -865.36,
                                  -1769.55,
                                  1535782.36
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_7FcRGhfmBJH6RrYRJt22yg",
                                "label": "5213 Bad Debt",
                                "metadata": {
                                  "accounts": [
                                    "acc_7FcRGhfmBJH6RrYRJt22yg"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_7FcRGhfmBJH6RrYRJt22yg",
                                  "label": "Total 5213 Bad Debt",
                                  "metadata": {
                                    "accounts": [
                                      "acc_7FcRGhfmBJH6RrYRJt22yg"
                                    ]
                                  },
                                  "sub_totals": [
                                    6020.25,
                                    -5084.99,
                                    0,
                                    -1211614.65,
                                    0,
                                    -732.95,
                                    -7412.8,
                                    -23315.47,
                                    -8447.78,
                                    -391447.75,
                                    288,
                                    0,
                                    -1641748.14
                                  ]
                                },
                                "values": [
                                  6020.25,
                                  -5084.99,
                                  0,
                                  -1211614.65,
                                  0,
                                  -732.95,
                                  -7412.8,
                                  -23315.47,
                                  -8447.78,
                                  -391447.75,
                                  288,
                                  0,
                                  -1641748.14
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_4Kv6SsyMC3kNrALkM9qdnr",
                                "label": "5214 Printing and Stationery",
                                "metadata": {
                                  "accounts": [
                                    "acc_4Kv6SsyMC3kNrALkM9qdnr"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_4Kv6SsyMC3kNrALkM9qdnr",
                                  "label": "Total 5214 Printing and Stationery",
                                  "metadata": {
                                    "accounts": [
                                      "acc_4Kv6SsyMC3kNrALkM9qdnr"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    466.25,
                                    88.51,
                                    2102.9,
                                    0,
                                    -35.03,
                                    1305.53,
                                    -8884.06,
                                    1869.86,
                                    -1088934.65,
                                    -0.2,
                                    -71995.64,
                                    -1164016.53
                                  ]
                                },
                                "values": [
                                  0,
                                  466.25,
                                  88.51,
                                  2102.9,
                                  0,
                                  -35.03,
                                  1305.53,
                                  -8884.06,
                                  1869.86,
                                  -1088934.65,
                                  -0.2,
                                  -71995.64,
                                  -1164016.53
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_52YCm8dAdMBRkMJj6QRBuW",
                                "label": "5215 Salaries and Employee Wages",
                                "metadata": {
                                  "accounts": [
                                    "acc_52YCm8dAdMBRkMJj6QRBuW"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_52YCm8dAdMBRkMJj6QRBuW",
                                  "label": "Total 5215 Salaries and Employee Wages",
                                  "metadata": {
                                    "accounts": [
                                      "acc_52YCm8dAdMBRkMJj6QRBuW"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    22598.63,
                                    4740.79,
                                    130.36,
                                    -575.78,
                                    4528.07,
                                    1089.1,
                                    -456.6,
                                    29200.05,
                                    -157.58,
                                    -369.4,
                                    -181704.13,
                                    -120976.49
                                  ]
                                },
                                "values": [
                                  0,
                                  22598.63,
                                  4740.79,
                                  130.36,
                                  -575.78,
                                  4528.07,
                                  1089.1,
                                  -456.6,
                                  29200.05,
                                  -157.58,
                                  -369.4,
                                  -181704.13,
                                  -120976.49
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_9xfmGZghqc2jWTVJ8oVpaE",
                                "label": "5216 Consultant Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_9xfmGZghqc2jWTVJ8oVpaE"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_9xfmGZghqc2jWTVJ8oVpaE",
                                  "label": "Total 5216 Consultant Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_9xfmGZghqc2jWTVJ8oVpaE"
                                    ]
                                  },
                                  "sub_totals": [
                                    -24209.84,
                                    122617.56,
                                    3966.05,
                                    -1587.77,
                                    62392.05,
                                    89.09,
                                    6822.39,
                                    3449.68,
                                    -487.88,
                                    -534249.44,
                                    -16929,
                                    683.09,
                                    -377444.02
                                  ]
                                },
                                "values": [
                                  -24209.84,
                                  122617.56,
                                  3966.05,
                                  -1587.77,
                                  62392.05,
                                  89.09,
                                  6822.39,
                                  3449.68,
                                  -487.88,
                                  -534249.44,
                                  -16929,
                                  683.09,
                                  -377444.02
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_7v3RharPkEc6YdPy9tXpXP",
                                "label": "5217 Repairs and Maintenance",
                                "metadata": {
                                  "accounts": [
                                    "acc_7v3RharPkEc6YdPy9tXpXP"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_7v3RharPkEc6YdPy9tXpXP",
                                  "label": "Total 5217 Repairs and Maintenance",
                                  "metadata": {
                                    "accounts": [
                                      "acc_7v3RharPkEc6YdPy9tXpXP"
                                    ]
                                  },
                                  "sub_totals": [
                                    -3863.28,
                                    -1511207.85,
                                    -667563.11,
                                    134.66,
                                    -24493.62,
                                    -5852.25,
                                    3864.14,
                                    0,
                                    4495.53,
                                    87.4,
                                    -5851.46,
                                    1068.28,
                                    -2209181.56
                                  ]
                                },
                                "values": [
                                  -3863.28,
                                  -1511207.85,
                                  -667563.11,
                                  134.66,
                                  -24493.62,
                                  -5852.25,
                                  3864.14,
                                  0,
                                  4495.53,
                                  87.4,
                                  -5851.46,
                                  1068.28,
                                  -2209181.56
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_fMrHBpnBAt82XU4JLPnAZD",
                                "label": "522 Lodging",
                                "metadata": {
                                  "accounts": [
                                    "acc_fMrHBpnBAt82XU4JLPnAZD"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fMrHBpnBAt82XU4JLPnAZD",
                                  "label": "Total 522 Lodging",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fMrHBpnBAt82XU4JLPnAZD"
                                    ]
                                  },
                                  "sub_totals": [
                                    -92.86,
                                    0,
                                    0,
                                    1806.4,
                                    -20896.56,
                                    0,
                                    -2569.05,
                                    9717.53,
                                    12.54,
                                    3330.08,
                                    3463.62,
                                    571249.88,
                                    566021.58
                                  ]
                                },
                                "values": [
                                  -92.86,
                                  0,
                                  0,
                                  1806.4,
                                  -20896.56,
                                  0,
                                  -2569.05,
                                  9717.53,
                                  12.54,
                                  3330.08,
                                  3463.62,
                                  571249.88,
                                  566021.58
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_aRQYS3qwV4JBZyUbMcWof8",
                                "label": "523 Advertising And Marketing",
                                "metadata": {
                                  "accounts": [
                                    "acc_aRQYS3qwV4JBZyUbMcWof8"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_aRQYS3qwV4JBZyUbMcWof8",
                                  "label": "Total 523 Advertising And Marketing",
                                  "metadata": {
                                    "accounts": [
                                      "acc_aRQYS3qwV4JBZyUbMcWof8"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    7.89,
                                    -53016.84,
                                    235.91,
                                    -255.87,
                                    0,
                                    40.31,
                                    46920.15,
                                    5636.24,
                                    -1031.71,
                                    -326.95,
                                    -1346.95,
                                    -3137.82
                                  ]
                                },
                                "values": [
                                  0,
                                  7.89,
                                  -53016.84,
                                  235.91,
                                  -255.87,
                                  0,
                                  40.31,
                                  46920.15,
                                  5636.24,
                                  -1031.71,
                                  -326.95,
                                  -1346.95,
                                  -3137.82
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Wkr3kRUkL6f5HVyfekN7YC",
                                "label": "524 Bank Fees and Charges",
                                "metadata": {
                                  "accounts": [
                                    "acc_Wkr3kRUkL6f5HVyfekN7YC"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Wkr3kRUkL6f5HVyfekN7YC",
                                  "label": "Total 524 Bank Fees and Charges",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Wkr3kRUkL6f5HVyfekN7YC"
                                    ]
                                  },
                                  "sub_totals": [
                                    -1300.4,
                                    -5530191.37,
                                    219122.6,
                                    0,
                                    -2297.88,
                                    0,
                                    12078.27,
                                    41282.01,
                                    -90447.06,
                                    3546299.75,
                                    11664.54,
                                    -268.28,
                                    -1794057.82
                                  ]
                                },
                                "values": [
                                  -1300.4,
                                  -5530191.37,
                                  219122.6,
                                  0,
                                  -2297.88,
                                  0,
                                  12078.27,
                                  41282.01,
                                  -90447.06,
                                  3546299.75,
                                  11664.54,
                                  -268.28,
                                  -1794057.82
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Y3Dknxe5CtePp4cDLEfM3H",
                                "label": "525 Credit Card Charges",
                                "metadata": {
                                  "accounts": [
                                    "acc_Y3Dknxe5CtePp4cDLEfM3H"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Y3Dknxe5CtePp4cDLEfM3H",
                                  "label": "Total 525 Credit Card Charges",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Y3Dknxe5CtePp4cDLEfM3H"
                                    ]
                                  },
                                  "sub_totals": [
                                    -74297.07,
                                    -515.21,
                                    -77.19,
                                    -356853.19,
                                    0,
                                    -7004.75,
                                    6247.18,
                                    -55464.06,
                                    -135382.72,
                                    1827.86,
                                    -1.16,
                                    1113.15,
                                    -620407.16
                                  ]
                                },
                                "values": [
                                  -74297.07,
                                  -515.21,
                                  -77.19,
                                  -356853.19,
                                  0,
                                  -7004.75,
                                  6247.18,
                                  -55464.06,
                                  -135382.72,
                                  1827.86,
                                  -1.16,
                                  1113.15,
                                  -620407.16
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_XP7KMbDzi7rGZQDefcYu9r",
                                "label": "526 Travel Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_XP7KMbDzi7rGZQDefcYu9r"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_XP7KMbDzi7rGZQDefcYu9r",
                                  "label": "Total 526 Travel Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_XP7KMbDzi7rGZQDefcYu9r"
                                    ]
                                  },
                                  "sub_totals": [
                                    -20437.48,
                                    6696.43,
                                    -33093.75,
                                    -58879.52,
                                    51184.84,
                                    -136.68,
                                    -2504.68,
                                    -315.72,
                                    8673,
                                    -79.86,
                                    -114604.88,
                                    1263.65,
                                    -162234.65
                                  ]
                                },
                                "values": [
                                  -20437.48,
                                  6696.43,
                                  -33093.75,
                                  -58879.52,
                                  51184.84,
                                  -136.68,
                                  -2504.68,
                                  -315.72,
                                  8673,
                                  -79.86,
                                  -114604.88,
                                  1263.65,
                                  -162234.65
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_mzX3EmggUxHc65qqvpo8m9",
                                "label": "527 Telephone Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_mzX3EmggUxHc65qqvpo8m9"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_mzX3EmggUxHc65qqvpo8m9",
                                  "label": "Total 527 Telephone Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_mzX3EmggUxHc65qqvpo8m9"
                                    ]
                                  },
                                  "sub_totals": [
                                    -14275.1,
                                    -764.17,
                                    -3013.51,
                                    -35868.57,
                                    -3928.73,
                                    980.38,
                                    0,
                                    -16951.76,
                                    0,
                                    -161.33,
                                    312.68,
                                    -4631.79,
                                    -78301.9
                                  ]
                                },
                                "values": [
                                  -14275.1,
                                  -764.17,
                                  -3013.51,
                                  -35868.57,
                                  -3928.73,
                                  980.38,
                                  0,
                                  -16951.76,
                                  0,
                                  -161.33,
                                  312.68,
                                  -4631.79,
                                  -78301.9
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_nf89ZwyS56JdJG23CHoH36",
                                "label": "528 Vehicle Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_nf89ZwyS56JdJG23CHoH36"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_nf89ZwyS56JdJG23CHoH36",
                                  "label": "Total 528 Vehicle Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_nf89ZwyS56JdJG23CHoH36"
                                    ]
                                  },
                                  "sub_totals": [
                                    340902.93,
                                    -9479.28,
                                    -721.9,
                                    3307.96,
                                    -9192.25,
                                    -64.44,
                                    380.18,
                                    36.27,
                                    85424.03,
                                    -28124.46,
                                    8.55,
                                    8673.22,
                                    391150.81
                                  ]
                                },
                                "values": [
                                  340902.93,
                                  -9479.28,
                                  -721.9,
                                  3307.96,
                                  -9192.25,
                                  -64.44,
                                  380.18,
                                  36.27,
                                  85424.03,
                                  -28124.46,
                                  8.55,
                                  8673.22,
                                  391150.81
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_np2Vi9S7mse3UnzEhs86Wj",
                                "label": "529 Software and Tools",
                                "metadata": {
                                  "accounts": [
                                    "acc_np2Vi9S7mse3UnzEhs86Wj"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_np2Vi9S7mse3UnzEhs86Wj",
                                  "label": "Total 529 Software and Tools",
                                  "metadata": {
                                    "accounts": [
                                      "acc_np2Vi9S7mse3UnzEhs86Wj"
                                    ]
                                  },
                                  "sub_totals": [
                                    -610672.82,
                                    6928.16,
                                    17879.21,
                                    383606.79,
                                    0,
                                    245638.16,
                                    0,
                                    0,
                                    -224994.82,
                                    -65727.5,
                                    -2159.25,
                                    -5322.23,
                                    -254824.3
                                  ]
                                },
                                "values": [
                                  -610672.82,
                                  6928.16,
                                  17879.21,
                                  383606.79,
                                  0,
                                  245638.16,
                                  0,
                                  0,
                                  -224994.82,
                                  -65727.5,
                                  -2159.25,
                                  -5322.23,
                                  -254824.3
                                ]
                              }
                            ],
                            "group": "OPERATING_EXPENSE",
                            "id": "OPERATING_EXPENSE",
                            "label": "Operating Expenses",
                            "metadata": {
                              "sub_classifications": [
                                "OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_operating_expense",
                              "label": "Total Operating Expenses",
                              "metadata": {},
                              "sub_totals": [
                                -417212.03,
                                -6917106.77,
                                -667765.15,
                                -1268402.45,
                                1098550.27,
                                465629.27,
                                35286.83,
                                -4166107.69,
                                69943.64,
                                10302300.62,
                                -306283.32,
                                -116080.28,
                                -1887247.06
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "OPERATING_PROFIT",
                            "id": "OPERATING_PROFIT",
                            "label": "Operating Profit",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES",
                                "OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_operating_profit",
                              "label": "Operating Profit",
                              "metadata": {},
                              "sub_totals": [
                                -430833.05,
                                -6023845.94,
                                191721.95,
                                -2737990.7,
                                219047.98,
                                487572.47,
                                4230770.8,
                                -4156446.07,
                                -616495.59,
                                -1646226.64,
                                2511677.39,
                                -148912.4,
                                -8119959.8
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_K8D9SrmdvbYqJCmUuweRce",
                                            "label": "2879 Higgins, Coleman and Romero",
                                            "metadata": {
                                              "accounts": [
                                                "acc_K8D9SrmdvbYqJCmUuweRce"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_K8D9SrmdvbYqJCmUuweRce",
                                              "label": "Total 2879 Higgins, Coleman and Romero",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_K8D9SrmdvbYqJCmUuweRce"
                                                ]
                                              },
                                              "sub_totals": [
                                                -177.19,
                                                -417.94,
                                                0,
                                                -1175.64,
                                                225517.48,
                                                0,
                                                -2174.04,
                                                0,
                                                -8753.76,
                                                -9104.74,
                                                -207.54,
                                                0,
                                                203506.63
                                              ]
                                            },
                                            "values": [
                                              -177.19,
                                              -417.94,
                                              0,
                                              -1175.64,
                                              225517.48,
                                              0,
                                              -2174.04,
                                              0,
                                              -8753.76,
                                              -9104.74,
                                              -207.54,
                                              0,
                                              203506.63
                                            ]
                                          }
                                        ],
                                        "id": "acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                        "label": "0196 Martinez, Boyd and Vargas",
                                        "metadata": {
                                          "accounts": [
                                            "acc_kjxnhcvAHUCZ9BW8FgPDFk"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                          "label": "Total 0196 Martinez, Boyd and Vargas",
                                          "metadata": {
                                            "accounts": [
                                              "acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                              "acc_K8D9SrmdvbYqJCmUuweRce"
                                            ]
                                          },
                                          "sub_totals": [
                                            2856.91,
                                            -9670.26,
                                            -32705.13,
                                            -1175.64,
                                            183973.51,
                                            1625.31,
                                            -531000.09,
                                            0,
                                            -22502.09,
                                            -9104.74,
                                            345.06,
                                            0,
                                            -417357.16
                                          ]
                                        },
                                        "values": [
                                          3034.1,
                                          -9252.32,
                                          -32705.13,
                                          0,
                                          -41543.97,
                                          1625.31,
                                          -528826.05,
                                          0,
                                          -13748.33,
                                          0,
                                          552.6,
                                          0,
                                          -620863.79
                                        ]
                                      }
                                    ],
                                    "id": "acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                    "label": "1170 Dickson-Walker",
                                    "metadata": {
                                      "accounts": [
                                        "acc_k7ZD5hrbMmoBBwFVe9ZaNj"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                      "label": "Total 1170 Dickson-Walker",
                                      "metadata": {
                                        "accounts": [
                                          "acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                          "acc_kjxnhcvAHUCZ9BW8FgPDFk"
                                        ]
                                      },
                                      "sub_totals": [
                                        4122.5,
                                        -19330.91,
                                        -32705.13,
                                        -12617.1,
                                        105719.3,
                                        -1403.66,
                                        -531028.35,
                                        -353.54,
                                        -22502.69,
                                        -9112.05,
                                        339.75,
                                        -1250127.21,
                                        -1768999.09
                                      ]
                                    },
                                    "values": [
                                      1265.59,
                                      -9660.65,
                                      0,
                                      -11441.46,
                                      -78254.21,
                                      -3028.97,
                                      -28.26,
                                      -353.54,
                                      -0.6,
                                      -7.31,
                                      -5.31,
                                      -1250127.21,
                                      -1351641.93
                                    ]
                                  }
                                ],
                                "id": "acc_aVBWoEGdrKhFX57dTuB3v2",
                                "label": "4654 Glass and Sons",
                                "metadata": {
                                  "accounts": [
                                    "acc_aVBWoEGdrKhFX57dTuB3v2"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_aVBWoEGdrKhFX57dTuB3v2",
                                  "label": "Total 4654 Glass and Sons",
                                  "metadata": {
                                    "accounts": [
                                      "acc_aVBWoEGdrKhFX57dTuB3v2",
                                      "acc_k7ZD5hrbMmoBBwFVe9ZaNj"
                                    ]
                                  },
                                  "sub_totals": [
                                    6559.33,
                                    -26313.9,
                                    -27428.48,
                                    -12617.1,
                                    139651.49,
                                    -5581.84,
                                    -531028.35,
                                    -353.54,
                                    -19016.53,
                                    -4499.28,
                                    -625.08,
                                    -1257757.4,
                                    -1739010.68
                                  ]
                                },
                                "values": [
                                  2436.83,
                                  -6982.99,
                                  5276.65,
                                  0,
                                  33932.19,
                                  -4178.18,
                                  0,
                                  0,
                                  3486.16,
                                  4612.77,
                                  -964.83,
                                  -7630.19,
                                  29988.41
                                ]
                              }
                            ],
                            "group": "OTHER_INCOME",
                            "id": "OTHER_INCOME",
                            "label": "Other Income",
                            "metadata": {
                              "sub_classifications": [
                                "OTHER_INCOME"
                              ]
                            },
                            "summary": {
                              "id": "summary_other_income",
                              "label": "Total Other Income",
                              "metadata": {},
                              "sub_totals": [
                                2856.91,
                                -9670.26,
                                -32705.13,
                                -1175.64,
                                183973.51,
                                1625.31,
                                -531000.09,
                                0,
                                -22502.09,
                                -9104.74,
                                345.06,
                                0,
                                -417357.16
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [
                                              {
                                                "children": [],
                                                "id": "acc_gpjJY9Crkpdzi49ELUQF6u",
                                                "label": "9558 Porter Group",
                                                "metadata": {
                                                  "accounts": [
                                                    "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                  ]
                                                },
                                                "summary": {
                                                  "id": "summary_acc_gpjJY9Crkpdzi49ELUQF6u",
                                                  "label": "Total 9558 Porter Group",
                                                  "metadata": {
                                                    "accounts": [
                                                      "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                    ]
                                                  },
                                                  "sub_totals": [
                                                    13596754.51,
                                                    16920.91,
                                                    -41677.11,
                                                    3.22,
                                                    -163283.42,
                                                    -13804.04,
                                                    -2860,
                                                    -1750366.49,
                                                    0,
                                                    19035,
                                                    0,
                                                    -57.56,
                                                    11660665.02
                                                  ]
                                                },
                                                "values": [
                                                  13596754.51,
                                                  16920.91,
                                                  -41677.11,
                                                  3.22,
                                                  -163283.42,
                                                  -13804.04,
                                                  -2860,
                                                  -1750366.49,
                                                  0,
                                                  19035,
                                                  0,
                                                  -57.56,
                                                  11660665.02
                                                ]
                                              }
                                            ],
                                            "id": "acc_XCry4baixEx2bRfVFDVDDs",
                                            "label": "9065 Johnson-Bell",
                                            "metadata": {
                                              "accounts": [
                                                "acc_XCry4baixEx2bRfVFDVDDs"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_XCry4baixEx2bRfVFDVDDs",
                                              "label": "Total 9065 Johnson-Bell",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_XCry4baixEx2bRfVFDVDDs",
                                                  "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                ]
                                              },
                                              "sub_totals": [
                                                13596751.59,
                                                16920.91,
                                                -45582.33,
                                                61919.03,
                                                -163080.06,
                                                -13804.04,
                                                -513.67,
                                                -1742127.85,
                                                106502.4,
                                                18598.2,
                                                -8.91,
                                                -54894.39,
                                                11780680.88
                                              ]
                                            },
                                            "values": [
                                              -2.92,
                                              0,
                                              -3905.22,
                                              61915.81,
                                              203.36,
                                              0,
                                              2346.33,
                                              8238.64,
                                              106502.4,
                                              -436.8,
                                              -8.91,
                                              -54836.83,
                                              120015.86
                                            ]
                                          }
                                        ],
                                        "id": "acc_cFKHf5xHV5VFfj9zWeWK92",
                                        "label": "4192 Roberts-Chapman",
                                        "metadata": {
                                          "accounts": [
                                            "acc_cFKHf5xHV5VFfj9zWeWK92"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_cFKHf5xHV5VFfj9zWeWK92",
                                          "label": "Total 4192 Roberts-Chapman",
                                          "metadata": {
                                            "accounts": [
                                              "acc_cFKHf5xHV5VFfj9zWeWK92",
                                              "acc_XCry4baixEx2bRfVFDVDDs"
                                            ]
                                          },
                                          "sub_totals": [
                                            13597097.93,
                                            17185.96,
                                            -45593.93,
                                            64680.64,
                                            -163616.98,
                                            -13421.2,
                                            -42654.55,
                                            -1742627.05,
                                            123266.36,
                                            18598.2,
                                            5101.9,
                                            -56448.37,
                                            11761568.91
                                          ]
                                        },
                                        "values": [
                                          346.34,
                                          265.05,
                                          -11.6,
                                          2761.61,
                                          -536.92,
                                          382.84,
                                          -42140.88,
                                          -499.2,
                                          16763.96,
                                          0,
                                          5110.81,
                                          -1553.98,
                                          -19111.97
                                        ]
                                      }
                                    ],
                                    "id": "acc_dNqQEL5MXEhwcGmrsrdsoU",
                                    "label": "5978 Richardson, Bauer and Reed",
                                    "metadata": {
                                      "accounts": [
                                        "acc_dNqQEL5MXEhwcGmrsrdsoU"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_dNqQEL5MXEhwcGmrsrdsoU",
                                      "label": "Total 5978 Richardson, Bauer and Reed",
                                      "metadata": {
                                        "accounts": [
                                          "acc_dNqQEL5MXEhwcGmrsrdsoU",
                                          "acc_cFKHf5xHV5VFfj9zWeWK92"
                                        ]
                                      },
                                      "sub_totals": [
                                        13602333.55,
                                        6940.58,
                                        -45056.25,
                                        64680.64,
                                        -116943.37,
                                        -17300.88,
                                        -142137.27,
                                        -1723929.32,
                                        123526.08,
                                        20167.72,
                                        2219.57,
                                        -50908.07,
                                        11723592.98
                                      ]
                                    },
                                    "values": [
                                      5235.62,
                                      -10245.38,
                                      537.68,
                                      0,
                                      46673.61,
                                      -3879.68,
                                      -99482.72,
                                      18697.73,
                                      259.72,
                                      1569.52,
                                      -2882.33,
                                      5540.3,
                                      -37975.93
                                    ]
                                  }
                                ],
                                "id": "acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                "label": "9677 Evans-Trujillo",
                                "metadata": {
                                  "accounts": [
                                    "acc_fo8cC2Q8FT3fWwjyZ8qJZD"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                  "label": "Total 9677 Evans-Trujillo",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                      "acc_dNqQEL5MXEhwcGmrsrdsoU"
                                    ]
                                  },
                                  "sub_totals": [
                                    17398234.9,
                                    5959.97,
                                    -45056.25,
                                    69133.8,
                                    -46108.66,
                                    -16821.46,
                                    -142137.27,
                                    -1710446.84,
                                    123526.08,
                                    20848.05,
                                    16190.3,
                                    -53774.99,
                                    15619547.63
                                  ]
                                },
                                "values": [
                                  3795901.35,
                                  -980.61,
                                  0,
                                  4453.16,
                                  70834.71,
                                  479.42,
                                  0,
                                  13482.48,
                                  0,
                                  680.33,
                                  13970.73,
                                  -2866.92,
                                  3895954.65
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_A2TGPLs2ghKMGtaSPSV8JF",
                                "label": "531 Exchange Gain or Loss",
                                "metadata": {
                                  "accounts": [
                                    "acc_A2TGPLs2ghKMGtaSPSV8JF"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_A2TGPLs2ghKMGtaSPSV8JF",
                                  "label": "Total 531 Exchange Gain or Loss",
                                  "metadata": {
                                    "accounts": [
                                      "acc_A2TGPLs2ghKMGtaSPSV8JF"
                                    ]
                                  },
                                  "sub_totals": [
                                    -3065.32,
                                    -34700.66,
                                    -1908.4,
                                    -11701.03,
                                    -9642.3,
                                    10908.12,
                                    -33942.56,
                                    -1393.58,
                                    -12664.92,
                                    529.24,
                                    -11779.2,
                                    -6439.47,
                                    -115800.08
                                  ]
                                },
                                "values": [
                                  -3065.32,
                                  -34700.66,
                                  -1908.4,
                                  -11701.03,
                                  -9642.3,
                                  10908.12,
                                  -33942.56,
                                  -1393.58,
                                  -12664.92,
                                  529.24,
                                  -11779.2,
                                  -6439.47,
                                  -115800.08
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_MjKsTpSfrvasBfWACxkukW",
                                "label": "532 Unrealized Gains and Losses",
                                "metadata": {
                                  "accounts": [
                                    "acc_MjKsTpSfrvasBfWACxkukW"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_MjKsTpSfrvasBfWACxkukW",
                                  "label": "Total 532 Unrealized Gains and Losses",
                                  "metadata": {
                                    "accounts": [
                                      "acc_MjKsTpSfrvasBfWACxkukW"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    -705.11,
                                    0,
                                    -177.42,
                                    2956.03,
                                    -18922.69,
                                    991.43,
                                    1529.64,
                                    0,
                                    0,
                                    0,
                                    -1001.7,
                                    -15329.82
                                  ]
                                },
                                "values": [
                                  0,
                                  -705.11,
                                  0,
                                  -177.42,
                                  2956.03,
                                  -18922.69,
                                  991.43,
                                  1529.64,
                                  0,
                                  0,
                                  0,
                                  -1001.7,
                                  -15329.82
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_jUKNwNM5bpdJU7QGgbttYR",
                                "label": "533 Uncategorized",
                                "metadata": {
                                  "accounts": [
                                    "acc_jUKNwNM5bpdJU7QGgbttYR"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_jUKNwNM5bpdJU7QGgbttYR",
                                  "label": "Total 533 Uncategorized",
                                  "metadata": {
                                    "accounts": [
                                      "acc_jUKNwNM5bpdJU7QGgbttYR"
                                    ]
                                  },
                                  "sub_totals": [
                                    -57.64,
                                    -310.87,
                                    261.15,
                                    0,
                                    2864.55,
                                    -3363903.64,
                                    0,
                                    9496.89,
                                    138309.89,
                                    4894.41,
                                    2071.97,
                                    7301092.27,
                                    4094718.98
                                  ]
                                },
                                "values": [
                                  -57.64,
                                  -310.87,
                                  261.15,
                                  0,
                                  2864.55,
                                  -3363903.64,
                                  0,
                                  9496.89,
                                  138309.89,
                                  4894.41,
                                  2071.97,
                                  7301092.27,
                                  4094718.98
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_WF8msFwMAczS7mQk3ViRMs",
                                "label": "534 Meals and Entertainment",
                                "metadata": {
                                  "accounts": [
                                    "acc_WF8msFwMAczS7mQk3ViRMs"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_WF8msFwMAczS7mQk3ViRMs",
                                  "label": "Total 534 Meals and Entertainment",
                                  "metadata": {
                                    "accounts": [
                                      "acc_WF8msFwMAczS7mQk3ViRMs"
                                    ]
                                  },
                                  "sub_totals": [
                                    -388.54,
                                    678.23,
                                    11589.05,
                                    0,
                                    3628.17,
                                    15662.04,
                                    237341.08,
                                    9877.91,
                                    12345.99,
                                    132.73,
                                    2087.78,
                                    -1584.33,
                                    291370.11
                                  ]
                                },
                                "values": [
                                  -388.54,
                                  678.23,
                                  11589.05,
                                  0,
                                  3628.17,
                                  15662.04,
                                  237341.08,
                                  9877.91,
                                  12345.99,
                                  132.73,
                                  2087.78,
                                  -1584.33,
                                  291370.11
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Hu8bjiaAfm6sCUaTnmAjcq",
                                "label": "535 Depreciation Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_Hu8bjiaAfm6sCUaTnmAjcq"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Hu8bjiaAfm6sCUaTnmAjcq",
                                  "label": "Total 535 Depreciation Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Hu8bjiaAfm6sCUaTnmAjcq"
                                    ]
                                  },
                                  "sub_totals": [
                                    1078.19,
                                    -12.72,
                                    -1756.13,
                                    30073.04,
                                    333.48,
                                    -1643.26,
                                    -1688.26,
                                    12355.59,
                                    -44501.17,
                                    7376.05,
                                    -1819.95,
                                    -9733.54,
                                    -9938.68
                                  ]
                                },
                                "values": [
                                  1078.19,
                                  -12.72,
                                  -1756.13,
                                  30073.04,
                                  333.48,
                                  -1643.26,
                                  -1688.26,
                                  12355.59,
                                  -44501.17,
                                  7376.05,
                                  -1819.95,
                                  -9733.54,
                                  -9938.68
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_kNYTyrAk4ER98h3XEktfuH",
                                "label": "536 Other Expenses",
                                "metadata": {
                                  "accounts": [
                                    "acc_kNYTyrAk4ER98h3XEktfuH"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_kNYTyrAk4ER98h3XEktfuH",
                                  "label": "Total 536 Other Expenses",
                                  "metadata": {
                                    "accounts": [
                                      "acc_kNYTyrAk4ER98h3XEktfuH"
                                    ]
                                  },
                                  "sub_totals": [
                                    0,
                                    22704.68,
                                    215.38,
                                    1731305.75,
                                    2277,
                                    -27.75,
                                    508806.48,
                                    -914.1,
                                    -66259.03,
                                    35758.31,
                                    0,
                                    -634159.35,
                                    1599707.37
                                  ]
                                },
                                "values": [
                                  0,
                                  22704.68,
                                  215.38,
                                  1731305.75,
                                  2277,
                                  -27.75,
                                  508806.48,
                                  -914.1,
                                  -66259.03,
                                  35758.31,
                                  0,
                                  -634159.35,
                                  1599707.37
                                ]
                              }
                            ],
                            "group": "NON_OPERATING_EXPENSE",
                            "id": "NON_OPERATING_EXPENSE",
                            "label": "Non-Operating Expenses",
                            "metadata": {
                              "sub_classifications": [
                                "NON_OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_non_operating_expense",
                              "label": "Total Non-Operating Expenses",
                              "metadata": {},
                              "sub_totals": [
                                13594664.62,
                                4839.51,
                                -37192.88,
                                1814180.98,
                                -161200.05,
                                -3371348.38,
                                668853.62,
                                -1711674.7,
                                150497.12,
                                67288.94,
                                -4337.5,
                                6591725.51,
                                17606296.79
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "NET_PROFIT",
                            "id": "NET_PROFIT",
                            "label": "Net Profit",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES",
                                "OPERATING_EXPENSES",
                                "OTHER_INCOME",
                                "NON_OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_net_profit",
                              "label": "Net Profit",
                              "metadata": {},
                              "sub_totals": [
                                13166688.48,
                                -6028676.69,
                                121823.94,
                                -924985.36,
                                241821.44,
                                -2882150.6,
                                4368624.33,
                                -5868120.77,
                                -488500.56,
                                -1588042.44,
                                2507684.95,
                                6442813.11,
                                9068979.83
                              ]
                            }
                          }
                        ]
                      }
                    ]
                  },
                  "Year": {
                    "description": "Response grouped by year from 2024 and 2 years back",
                    "summary": "Group by year",
                    "value": [
                      {
                        "columns": [
                          {
                            "id": "2021-01-01",
                            "label": "2021",
                            "metadata": {
                              "from_date": "2021-01-01",
                              "to_date": "2021-12-31"
                            }
                          },
                          {
                            "id": "2022-01-01",
                            "label": "2022",
                            "metadata": {
                              "from_date": "2022-01-01",
                              "to_date": "2022-12-31"
                            }
                          },
                          {
                            "id": "2023-01-01",
                            "label": "2023",
                            "metadata": {
                              "from_date": "2023-01-01",
                              "to_date": "2023-12-31"
                            }
                          },
                          {
                            "id": "row_totals",
                            "label": "Totals",
                            "metadata": {
                              "from_date": "2021-01-01",
                              "to_date": "2023-12-31"
                            }
                          }
                        ],
                        "overview": {
                          "created_ts": "2024-01-05T00:00:00Z",
                          "currency": "SAR",
                          "date_from": "2021-01-01",
                          "date_to": "2023-12-31",
                          "filters": {},
                          "group_by": "year",
                          "id": "profit_and_loss",
                          "label": "Profit and Loss Report"
                        },
                        "rows": [
                          {
                            "children": [
                              {
                                "children": [],
                                "id": "acc_GwwXGSvDi2nHKCecyxXexo",
                                "label": "2663 GB31PYKS95133433234680",
                                "metadata": {
                                  "accounts": [
                                    "acc_GwwXGSvDi2nHKCecyxXexo"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_GwwXGSvDi2nHKCecyxXexo",
                                  "label": "Total 2663 GB31PYKS95133433234680",
                                  "metadata": {
                                    "accounts": [
                                      "acc_GwwXGSvDi2nHKCecyxXexo"
                                    ]
                                  },
                                  "sub_totals": [
                                    8610114.49,
                                    -1137278.33,
                                    -96983.62,
                                    7375852.54
                                  ]
                                },
                                "values": [
                                  8610114.49,
                                  -1137278.33,
                                  -96983.62,
                                  7375852.54
                                ]
                              },
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_h3mudXDb52V9naLfh9DVBi",
                                            "label": "2191 Hanna Group",
                                            "metadata": {
                                              "accounts": [
                                                "acc_h3mudXDb52V9naLfh9DVBi"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_h3mudXDb52V9naLfh9DVBi",
                                              "label": "Total 2191 Hanna Group",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_h3mudXDb52V9naLfh9DVBi"
                                                ]
                                              },
                                              "sub_totals": [
                                                123191.09,
                                                557032.87,
                                                33966.07,
                                                714190.03
                                              ]
                                            },
                                            "values": [
                                              123191.09,
                                              557032.87,
                                              33966.07,
                                              714190.03
                                            ]
                                          }
                                        ],
                                        "id": "acc_8dXpkHH9yHGwpfKmiNx8HA",
                                        "label": "6883 Goodwin-Harper",
                                        "metadata": {
                                          "accounts": [
                                            "acc_8dXpkHH9yHGwpfKmiNx8HA"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_8dXpkHH9yHGwpfKmiNx8HA",
                                          "label": "Total 6883 Goodwin-Harper",
                                          "metadata": {
                                            "accounts": [
                                              "acc_8dXpkHH9yHGwpfKmiNx8HA",
                                              "acc_h3mudXDb52V9naLfh9DVBi"
                                            ]
                                          },
                                          "sub_totals": [
                                            24110.96,
                                            -802879.97,
                                            176028.87,
                                            -602740.14
                                          ]
                                        },
                                        "values": [
                                          -99080.13,
                                          -1359912.84,
                                          142062.8,
                                          -1316930.17
                                        ]
                                      }
                                    ],
                                    "id": "acc_SUpT3JjnPj44pXGyVLM2T9",
                                    "label": "3232 Thompson Inc",
                                    "metadata": {
                                      "accounts": [
                                        "acc_SUpT3JjnPj44pXGyVLM2T9"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_SUpT3JjnPj44pXGyVLM2T9",
                                      "label": "Total 3232 Thompson Inc",
                                      "metadata": {
                                        "accounts": [
                                          "acc_SUpT3JjnPj44pXGyVLM2T9",
                                          "acc_8dXpkHH9yHGwpfKmiNx8HA"
                                        ]
                                      },
                                      "sub_totals": [
                                        -1608362.82,
                                        -791154.63,
                                        -651178.05,
                                        -3050695.5
                                      ]
                                    },
                                    "values": [
                                      -1632473.78,
                                      11725.34,
                                      -827206.92,
                                      -2447955.36
                                    ]
                                  }
                                ],
                                "id": "acc_3aMMeaGLXEj2nkBBkTAXCh",
                                "label": "7066 Medina-Santos",
                                "metadata": {
                                  "accounts": [
                                    "acc_3aMMeaGLXEj2nkBBkTAXCh"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_3aMMeaGLXEj2nkBBkTAXCh",
                                  "label": "Total 7066 Medina-Santos",
                                  "metadata": {
                                    "accounts": [
                                      "acc_3aMMeaGLXEj2nkBBkTAXCh",
                                      "acc_SUpT3JjnPj44pXGyVLM2T9"
                                    ]
                                  },
                                  "sub_totals": [
                                    -1140989.19,
                                    -874220.25,
                                    46914.44,
                                    -1968295
                                  ]
                                },
                                "values": [
                                  467373.63,
                                  -83065.62,
                                  698092.49,
                                  1082400.5
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Bv3z5sii7aXDhxXZV8Sqrb",
                                "label": "8899 GB42DLQG70743971530332",
                                "metadata": {
                                  "accounts": [
                                    "acc_Bv3z5sii7aXDhxXZV8Sqrb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Bv3z5sii7aXDhxXZV8Sqrb",
                                  "label": "Total 8899 GB42DLQG70743971530332",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Bv3z5sii7aXDhxXZV8Sqrb"
                                    ]
                                  },
                                  "sub_totals": [
                                    -1798209.7,
                                    -20718.32,
                                    22297.14,
                                    -1796630.88
                                  ]
                                },
                                "values": [
                                  -1798209.7,
                                  -20718.32,
                                  22297.14,
                                  -1796630.88
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_EVeNzPbZXnnCiidM4mGcbf",
                                "label": "9694 GB43IVCI82994294137386",
                                "metadata": {
                                  "accounts": [
                                    "acc_EVeNzPbZXnnCiidM4mGcbf"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_EVeNzPbZXnnCiidM4mGcbf",
                                  "label": "Total 9694 GB43IVCI82994294137386",
                                  "metadata": {
                                    "accounts": [
                                      "acc_EVeNzPbZXnnCiidM4mGcbf"
                                    ]
                                  },
                                  "sub_totals": [
                                    -1416392.95,
                                    -94832.17,
                                    -8033.66,
                                    -1519258.78
                                  ]
                                },
                                "values": [
                                  -1416392.95,
                                  -94832.17,
                                  -8033.66,
                                  -1519258.78
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_fGZ5RrRSas7k46FFk3U5rb",
                                "label": "411 Sales",
                                "metadata": {
                                  "accounts": [
                                    "acc_fGZ5RrRSas7k46FFk3U5rb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fGZ5RrRSas7k46FFk3U5rb",
                                  "label": "Total 411 Sales",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fGZ5RrRSas7k46FFk3U5rb"
                                    ]
                                  },
                                  "sub_totals": [
                                    2910288.57,
                                    17914.9,
                                    -1912681.11,
                                    1015522.36
                                  ]
                                },
                                "values": [
                                  2910288.57,
                                  17914.9,
                                  -1912681.11,
                                  1015522.36
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_nGFXazi6c3BBLg6Rs8564P",
                                "label": "412 Interest Income",
                                "metadata": {
                                  "accounts": [
                                    "acc_nGFXazi6c3BBLg6Rs8564P"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_nGFXazi6c3BBLg6Rs8564P",
                                  "label": "Total 412 Interest Income",
                                  "metadata": {
                                    "accounts": [
                                      "acc_nGFXazi6c3BBLg6Rs8564P"
                                    ]
                                  },
                                  "sub_totals": [
                                    251896.48,
                                    -7889615.38,
                                    -69402.94,
                                    -7707121.84
                                  ]
                                },
                                "values": [
                                  251896.48,
                                  -7889615.38,
                                  -69402.94,
                                  -7707121.84
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_n8DgFgrhEP6qPkVEb8meu3",
                                "label": "413 Late Fee Income",
                                "metadata": {
                                  "accounts": [
                                    "acc_n8DgFgrhEP6qPkVEb8meu3"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_n8DgFgrhEP6qPkVEb8meu3",
                                  "label": "Total 413 Late Fee Income",
                                  "metadata": {
                                    "accounts": [
                                      "acc_n8DgFgrhEP6qPkVEb8meu3"
                                    ]
                                  },
                                  "sub_totals": [
                                    162994.6,
                                    -159157.82,
                                    3215674.87,
                                    3219511.65
                                  ]
                                },
                                "values": [
                                  162994.6,
                                  -159157.82,
                                  3215674.87,
                                  3219511.65
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_AkTASCAaMJtamv9NY8Qys5",
                                "label": "414 Shipping Charge",
                                "metadata": {
                                  "accounts": [
                                    "acc_AkTASCAaMJtamv9NY8Qys5"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_AkTASCAaMJtamv9NY8Qys5",
                                  "label": "Total 414 Shipping Charge",
                                  "metadata": {
                                    "accounts": [
                                      "acc_AkTASCAaMJtamv9NY8Qys5"
                                    ]
                                  },
                                  "sub_totals": [
                                    1494514.54,
                                    7244645.1,
                                    24294.15,
                                    8763453.79
                                  ]
                                },
                                "values": [
                                  1494514.54,
                                  7244645.1,
                                  24294.15,
                                  8763453.79
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_WCU3XXtzqSVs9AVwmbv3Ro",
                                "label": "415 Other Charges",
                                "metadata": {
                                  "accounts": [
                                    "acc_WCU3XXtzqSVs9AVwmbv3Ro"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_WCU3XXtzqSVs9AVwmbv3Ro",
                                  "label": "Total 415 Other Charges",
                                  "metadata": {
                                    "accounts": [
                                      "acc_WCU3XXtzqSVs9AVwmbv3Ro"
                                    ]
                                  },
                                  "sub_totals": [
                                    -20946308.49,
                                    -5338650.2,
                                    -1590617.96,
                                    -27875576.65
                                  ]
                                },
                                "values": [
                                  -20946308.49,
                                  -5338650.2,
                                  -1590617.96,
                                  -27875576.65
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_A86ZVhuCEZU7bCgJ3pAhZR",
                                "label": "416 Discount",
                                "metadata": {
                                  "accounts": [
                                    "acc_A86ZVhuCEZU7bCgJ3pAhZR"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_A86ZVhuCEZU7bCgJ3pAhZR",
                                  "label": "Total 416 Discount",
                                  "metadata": {
                                    "accounts": [
                                      "acc_A86ZVhuCEZU7bCgJ3pAhZR"
                                    ]
                                  },
                                  "sub_totals": [
                                    -1114355.14,
                                    728858.69,
                                    -16896512.47,
                                    -17282008.92
                                  ]
                                },
                                "values": [
                                  -1114355.14,
                                  728858.69,
                                  -16896512.47,
                                  -17282008.92
                                ]
                              }
                            ],
                            "group": "INCOME",
                            "id": "INCOME",
                            "label": "Income",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME"
                              ]
                            },
                            "summary": {
                              "id": "summary_income",
                              "label": "Total Income",
                              "metadata": {},
                              "sub_totals": [
                                -17216858.48,
                                -6198884.68,
                                -17053216.59,
                                -40468959.75
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [
                                              {
                                                "children": [],
                                                "id": "acc_hV2CkyYXmZXvy2iKQz2yei",
                                                "label": "1624 Bell, Campbell and Joseph",
                                                "metadata": {
                                                  "accounts": [
                                                    "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                  ]
                                                },
                                                "summary": {
                                                  "id": "summary_acc_hV2CkyYXmZXvy2iKQz2yei",
                                                  "label": "Total 1624 Bell, Campbell and Joseph",
                                                  "metadata": {
                                                    "accounts": [
                                                      "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                    ]
                                                  },
                                                  "sub_totals": [
                                                    -2371636.27,
                                                    94237.2,
                                                    488178.7,
                                                    -1789220.37
                                                  ]
                                                },
                                                "values": [
                                                  -2371636.27,
                                                  94237.2,
                                                  488178.7,
                                                  -1789220.37
                                                ]
                                              }
                                            ],
                                            "id": "acc_2mxViQpX3regpQSrcWqCM2",
                                            "label": "5430 Clark-Robertson",
                                            "metadata": {
                                              "accounts": [
                                                "acc_2mxViQpX3regpQSrcWqCM2"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_2mxViQpX3regpQSrcWqCM2",
                                              "label": "Total 5430 Clark-Robertson",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_2mxViQpX3regpQSrcWqCM2",
                                                  "acc_hV2CkyYXmZXvy2iKQz2yei"
                                                ]
                                              },
                                              "sub_totals": [
                                                -5245142.84,
                                                35519.83,
                                                320329.31,
                                                -4889293.7
                                              ]
                                            },
                                            "values": [
                                              -2873506.57,
                                              -58717.37,
                                              -167849.39,
                                              -3100073.33
                                            ]
                                          }
                                        ],
                                        "id": "acc_hEGoCD9ffFhQepj3srzDVs",
                                        "label": "1245 Washington-Clayton",
                                        "metadata": {
                                          "accounts": [
                                            "acc_hEGoCD9ffFhQepj3srzDVs"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_hEGoCD9ffFhQepj3srzDVs",
                                          "label": "Total 1245 Washington-Clayton",
                                          "metadata": {
                                            "accounts": [
                                              "acc_hEGoCD9ffFhQepj3srzDVs",
                                              "acc_2mxViQpX3regpQSrcWqCM2"
                                            ]
                                          },
                                          "sub_totals": [
                                            -5821852.62,
                                            -78979.52,
                                            11584.81,
                                            -5889247.33
                                          ]
                                        },
                                        "values": [
                                          -576709.78,
                                          -114499.35,
                                          -308744.5,
                                          -999953.63
                                        ]
                                      }
                                    ],
                                    "id": "acc_ULicU8jieyR9UuqiM9ovoL",
                                    "label": "6576 Holloway, Strong and Hicks",
                                    "metadata": {
                                      "accounts": [
                                        "acc_ULicU8jieyR9UuqiM9ovoL"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_ULicU8jieyR9UuqiM9ovoL",
                                      "label": "Total 6576 Holloway, Strong and Hicks",
                                      "metadata": {
                                        "accounts": [
                                          "acc_ULicU8jieyR9UuqiM9ovoL",
                                          "acc_hEGoCD9ffFhQepj3srzDVs"
                                        ]
                                      },
                                      "sub_totals": [
                                        -5659863.75,
                                        -8165984.51,
                                        7085425.8,
                                        -6740422.46
                                      ]
                                    },
                                    "values": [
                                      161988.87,
                                      -8087004.99,
                                      7073840.99,
                                      -851175.13
                                    ]
                                  }
                                ],
                                "id": "acc_9YNpqmbHjrZN6oFL2SX7jm",
                                "label": "2721 Sheppard and Sons",
                                "metadata": {
                                  "accounts": [
                                    "acc_9YNpqmbHjrZN6oFL2SX7jm"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_9YNpqmbHjrZN6oFL2SX7jm",
                                  "label": "Total 2721 Sheppard and Sons",
                                  "metadata": {
                                    "accounts": [
                                      "acc_9YNpqmbHjrZN6oFL2SX7jm",
                                      "acc_ULicU8jieyR9UuqiM9ovoL"
                                    ]
                                  },
                                  "sub_totals": [
                                    -6068928.36,
                                    -8060283.23,
                                    7124439.9,
                                    -7004771.69
                                  ]
                                },
                                "values": [
                                  -409064.61,
                                  105701.28,
                                  39014.1,
                                  -264349.23
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_dqNwix5yRwuQgB9pzQCjXb",
                                "label": "511 Cost of Goods Sold",
                                "metadata": {
                                  "accounts": [
                                    "acc_dqNwix5yRwuQgB9pzQCjXb"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_dqNwix5yRwuQgB9pzQCjXb",
                                  "label": "Total 511 Cost of Goods Sold",
                                  "metadata": {
                                    "accounts": [
                                      "acc_dqNwix5yRwuQgB9pzQCjXb"
                                    ]
                                  },
                                  "sub_totals": [
                                    -117391.32,
                                    45151.46,
                                    -2115831.57,
                                    -2188071.43
                                  ]
                                },
                                "values": [
                                  -117391.32,
                                  45151.46,
                                  -2115831.57,
                                  -2188071.43
                                ]
                              }
                            ],
                            "group": "COGS",
                            "id": "COGS",
                            "label": "Cost of Sales",
                            "metadata": {
                              "sub_classifications": [
                                "COST_OF_SALES"
                              ]
                            },
                            "summary": {
                              "id": "summary_cogs",
                              "label": "Total Cost of Sales",
                              "metadata": {},
                              "sub_totals": [
                                -5939243.94,
                                -33828.06,
                                -2104246.76,
                                -8077318.76
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "GROSS_MARGIN",
                            "id": "GROSS_MARGIN",
                            "label": "Gross Profit",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES"
                              ]
                            },
                            "summary": {
                              "id": "summary_gross_margin",
                              "label": "Gross Profit",
                              "metadata": {},
                              "sub_totals": [
                                -23156102.42,
                                -6232712.74,
                                -19157463.35,
                                -48546278.51
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_XKZ4X8LGL3CfZGBrMjBsf3",
                                            "label": "8963 Vasquez, Bradley and Novak",
                                            "metadata": {
                                              "accounts": [
                                                "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_XKZ4X8LGL3CfZGBrMjBsf3",
                                              "label": "Total 8963 Vasquez, Bradley and Novak",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                                ]
                                              },
                                              "sub_totals": [
                                                -30962.92,
                                                -4267164.89,
                                                -30500.23,
                                                -4328628.04
                                              ]
                                            },
                                            "values": [
                                              -30962.92,
                                              -4267164.89,
                                              -30500.23,
                                              -4328628.04
                                            ]
                                          }
                                        ],
                                        "id": "acc_ahzp6b9vysnVSND7ezSnbc",
                                        "label": "7810 Mullins-Mendoza",
                                        "metadata": {
                                          "accounts": [
                                            "acc_ahzp6b9vysnVSND7ezSnbc"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_ahzp6b9vysnVSND7ezSnbc",
                                          "label": "Total 7810 Mullins-Mendoza",
                                          "metadata": {
                                            "accounts": [
                                              "acc_ahzp6b9vysnVSND7ezSnbc",
                                              "acc_XKZ4X8LGL3CfZGBrMjBsf3"
                                            ]
                                          },
                                          "sub_totals": [
                                            -219046.07,
                                            -4781144.14,
                                            -756516.39,
                                            -5756706.6
                                          ]
                                        },
                                        "values": [
                                          -188083.15,
                                          -513979.25,
                                          -726016.16,
                                          -1428078.56
                                        ]
                                      }
                                    ],
                                    "id": "acc_54S8UKUaLC7Qz26YxtabHf",
                                    "label": "7545 Johnson Ltd",
                                    "metadata": {
                                      "accounts": [
                                        "acc_54S8UKUaLC7Qz26YxtabHf"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_54S8UKUaLC7Qz26YxtabHf",
                                      "label": "Total 7545 Johnson Ltd",
                                      "metadata": {
                                        "accounts": [
                                          "acc_54S8UKUaLC7Qz26YxtabHf",
                                          "acc_ahzp6b9vysnVSND7ezSnbc"
                                        ]
                                      },
                                      "sub_totals": [
                                        397486.22,
                                        -3988700.98,
                                        3960998.71,
                                        369783.95
                                      ]
                                    },
                                    "values": [
                                      616532.29,
                                      792443.16,
                                      4717515.1,
                                      6126490.55
                                    ]
                                  }
                                ],
                                "id": "acc_W4GP34aBqv9NpwPVPP9Toe",
                                "label": "7049 Gallegos-Jones",
                                "metadata": {
                                  "accounts": [
                                    "acc_W4GP34aBqv9NpwPVPP9Toe"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_W4GP34aBqv9NpwPVPP9Toe",
                                  "label": "Total 7049 Gallegos-Jones",
                                  "metadata": {
                                    "accounts": [
                                      "acc_W4GP34aBqv9NpwPVPP9Toe",
                                      "acc_54S8UKUaLC7Qz26YxtabHf"
                                    ]
                                  },
                                  "sub_totals": [
                                    -5872473.06,
                                    -3775768.46,
                                    3489758.7,
                                    -6158482.82
                                  ]
                                },
                                "values": [
                                  -6269959.28,
                                  212932.52,
                                  -471240.01,
                                  -6528266.77
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_GVHuwPnwyLpDUKfLTZm5FL",
                                "label": "521 Office Supplies",
                                "metadata": {
                                  "accounts": [
                                    "acc_GVHuwPnwyLpDUKfLTZm5FL"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_GVHuwPnwyLpDUKfLTZm5FL",
                                  "label": "Total 521 Office Supplies",
                                  "metadata": {
                                    "accounts": [
                                      "acc_GVHuwPnwyLpDUKfLTZm5FL"
                                    ]
                                  },
                                  "sub_totals": [
                                    677281.87,
                                    8974340.02,
                                    -267128.3,
                                    9384493.59
                                  ]
                                },
                                "values": [
                                  677281.87,
                                  8974340.02,
                                  -267128.3,
                                  9384493.59
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_baw6nBvKaovg6LCwHC3MBV",
                                "label": "5210 Rent Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_baw6nBvKaovg6LCwHC3MBV"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_baw6nBvKaovg6LCwHC3MBV",
                                  "label": "Total 5210 Rent Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_baw6nBvKaovg6LCwHC3MBV"
                                    ]
                                  },
                                  "sub_totals": [
                                    2992364.13,
                                    -162543.62,
                                    6693884.33,
                                    9523704.84
                                  ]
                                },
                                "values": [
                                  2992364.13,
                                  -162543.62,
                                  6693884.33,
                                  9523704.84
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_iVA6wA5eZ3kdCdeRhX8sDA",
                                "label": "5211 Janitorial Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_iVA6wA5eZ3kdCdeRhX8sDA"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_iVA6wA5eZ3kdCdeRhX8sDA",
                                  "label": "Total 5211 Janitorial Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_iVA6wA5eZ3kdCdeRhX8sDA"
                                    ]
                                  },
                                  "sub_totals": [
                                    13056009.06,
                                    15476.32,
                                    443300.39,
                                    13514785.77
                                  ]
                                },
                                "values": [
                                  13056009.06,
                                  15476.32,
                                  443300.39,
                                  13514785.77
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_4g58kJWsPB5RE8khF8yciM",
                                "label": "5212 Postage",
                                "metadata": {
                                  "accounts": [
                                    "acc_4g58kJWsPB5RE8khF8yciM"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_4g58kJWsPB5RE8khF8yciM",
                                  "label": "Total 5212 Postage",
                                  "metadata": {
                                    "accounts": [
                                      "acc_4g58kJWsPB5RE8khF8yciM"
                                    ]
                                  },
                                  "sub_totals": [
                                    414187.95,
                                    1535782.36,
                                    -61714.13,
                                    1888256.18
                                  ]
                                },
                                "values": [
                                  414187.95,
                                  1535782.36,
                                  -61714.13,
                                  1888256.18
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_7FcRGhfmBJH6RrYRJt22yg",
                                "label": "5213 Bad Debt",
                                "metadata": {
                                  "accounts": [
                                    "acc_7FcRGhfmBJH6RrYRJt22yg"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_7FcRGhfmBJH6RrYRJt22yg",
                                  "label": "Total 5213 Bad Debt",
                                  "metadata": {
                                    "accounts": [
                                      "acc_7FcRGhfmBJH6RrYRJt22yg"
                                    ]
                                  },
                                  "sub_totals": [
                                    -503427.84,
                                    -1641748.14,
                                    -4059898.22,
                                    -6205074.2
                                  ]
                                },
                                "values": [
                                  -503427.84,
                                  -1641748.14,
                                  -4059898.22,
                                  -6205074.2
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_4Kv6SsyMC3kNrALkM9qdnr",
                                "label": "5214 Printing and Stationery",
                                "metadata": {
                                  "accounts": [
                                    "acc_4Kv6SsyMC3kNrALkM9qdnr"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_4Kv6SsyMC3kNrALkM9qdnr",
                                  "label": "Total 5214 Printing and Stationery",
                                  "metadata": {
                                    "accounts": [
                                      "acc_4Kv6SsyMC3kNrALkM9qdnr"
                                    ]
                                  },
                                  "sub_totals": [
                                    255797.12,
                                    -1164016.53,
                                    -149432.84,
                                    -1057652.25
                                  ]
                                },
                                "values": [
                                  255797.12,
                                  -1164016.53,
                                  -149432.84,
                                  -1057652.25
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_52YCm8dAdMBRkMJj6QRBuW",
                                "label": "5215 Salaries and Employee Wages",
                                "metadata": {
                                  "accounts": [
                                    "acc_52YCm8dAdMBRkMJj6QRBuW"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_52YCm8dAdMBRkMJj6QRBuW",
                                  "label": "Total 5215 Salaries and Employee Wages",
                                  "metadata": {
                                    "accounts": [
                                      "acc_52YCm8dAdMBRkMJj6QRBuW"
                                    ]
                                  },
                                  "sub_totals": [
                                    -4252899.33,
                                    -120976.49,
                                    -1028174.26,
                                    -5402050.08
                                  ]
                                },
                                "values": [
                                  -4252899.33,
                                  -120976.49,
                                  -1028174.26,
                                  -5402050.08
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_9xfmGZghqc2jWTVJ8oVpaE",
                                "label": "5216 Consultant Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_9xfmGZghqc2jWTVJ8oVpaE"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_9xfmGZghqc2jWTVJ8oVpaE",
                                  "label": "Total 5216 Consultant Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_9xfmGZghqc2jWTVJ8oVpaE"
                                    ]
                                  },
                                  "sub_totals": [
                                    -165885.18,
                                    -377444.02,
                                    -50454.37,
                                    -593783.57
                                  ]
                                },
                                "values": [
                                  -165885.18,
                                  -377444.02,
                                  -50454.37,
                                  -593783.57
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_7v3RharPkEc6YdPy9tXpXP",
                                "label": "5217 Repairs and Maintenance",
                                "metadata": {
                                  "accounts": [
                                    "acc_7v3RharPkEc6YdPy9tXpXP"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_7v3RharPkEc6YdPy9tXpXP",
                                  "label": "Total 5217 Repairs and Maintenance",
                                  "metadata": {
                                    "accounts": [
                                      "acc_7v3RharPkEc6YdPy9tXpXP"
                                    ]
                                  },
                                  "sub_totals": [
                                    2621668.38,
                                    -2209181.56,
                                    -462478.64,
                                    -49991.82
                                  ]
                                },
                                "values": [
                                  2621668.38,
                                  -2209181.56,
                                  -462478.64,
                                  -49991.82
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_fMrHBpnBAt82XU4JLPnAZD",
                                "label": "522 Lodging",
                                "metadata": {
                                  "accounts": [
                                    "acc_fMrHBpnBAt82XU4JLPnAZD"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fMrHBpnBAt82XU4JLPnAZD",
                                  "label": "Total 522 Lodging",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fMrHBpnBAt82XU4JLPnAZD"
                                    ]
                                  },
                                  "sub_totals": [
                                    57312.35,
                                    566021.58,
                                    -351852.51,
                                    271481.42
                                  ]
                                },
                                "values": [
                                  57312.35,
                                  566021.58,
                                  -351852.51,
                                  271481.42
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_aRQYS3qwV4JBZyUbMcWof8",
                                "label": "523 Advertising And Marketing",
                                "metadata": {
                                  "accounts": [
                                    "acc_aRQYS3qwV4JBZyUbMcWof8"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_aRQYS3qwV4JBZyUbMcWof8",
                                  "label": "Total 523 Advertising And Marketing",
                                  "metadata": {
                                    "accounts": [
                                      "acc_aRQYS3qwV4JBZyUbMcWof8"
                                    ]
                                  },
                                  "sub_totals": [
                                    4739058.26,
                                    -3137.82,
                                    -1330632.35,
                                    3405288.09
                                  ]
                                },
                                "values": [
                                  4739058.26,
                                  -3137.82,
                                  -1330632.35,
                                  3405288.09
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Wkr3kRUkL6f5HVyfekN7YC",
                                "label": "524 Bank Fees and Charges",
                                "metadata": {
                                  "accounts": [
                                    "acc_Wkr3kRUkL6f5HVyfekN7YC"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Wkr3kRUkL6f5HVyfekN7YC",
                                  "label": "Total 524 Bank Fees and Charges",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Wkr3kRUkL6f5HVyfekN7YC"
                                    ]
                                  },
                                  "sub_totals": [
                                    -708433.75,
                                    -1794057.82,
                                    629000.92,
                                    -1873490.65
                                  ]
                                },
                                "values": [
                                  -708433.75,
                                  -1794057.82,
                                  629000.92,
                                  -1873490.65
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Y3Dknxe5CtePp4cDLEfM3H",
                                "label": "525 Credit Card Charges",
                                "metadata": {
                                  "accounts": [
                                    "acc_Y3Dknxe5CtePp4cDLEfM3H"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Y3Dknxe5CtePp4cDLEfM3H",
                                  "label": "Total 525 Credit Card Charges",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Y3Dknxe5CtePp4cDLEfM3H"
                                    ]
                                  },
                                  "sub_totals": [
                                    -3583709.59,
                                    -620407.16,
                                    204370.38,
                                    -3999746.37
                                  ]
                                },
                                "values": [
                                  -3583709.59,
                                  -620407.16,
                                  204370.38,
                                  -3999746.37
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_XP7KMbDzi7rGZQDefcYu9r",
                                "label": "526 Travel Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_XP7KMbDzi7rGZQDefcYu9r"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_XP7KMbDzi7rGZQDefcYu9r",
                                  "label": "Total 526 Travel Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_XP7KMbDzi7rGZQDefcYu9r"
                                    ]
                                  },
                                  "sub_totals": [
                                    -629787.28,
                                    -162234.65,
                                    320395.14,
                                    -471626.79
                                  ]
                                },
                                "values": [
                                  -629787.28,
                                  -162234.65,
                                  320395.14,
                                  -471626.79
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_mzX3EmggUxHc65qqvpo8m9",
                                "label": "527 Telephone Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_mzX3EmggUxHc65qqvpo8m9"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_mzX3EmggUxHc65qqvpo8m9",
                                  "label": "Total 527 Telephone Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_mzX3EmggUxHc65qqvpo8m9"
                                    ]
                                  },
                                  "sub_totals": [
                                    -6094781.59,
                                    -78301.9,
                                    -74762.39,
                                    -6247845.88
                                  ]
                                },
                                "values": [
                                  -6094781.59,
                                  -78301.9,
                                  -74762.39,
                                  -6247845.88
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_nf89ZwyS56JdJG23CHoH36",
                                "label": "528 Vehicle Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_nf89ZwyS56JdJG23CHoH36"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_nf89ZwyS56JdJG23CHoH36",
                                  "label": "Total 528 Vehicle Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_nf89ZwyS56JdJG23CHoH36"
                                    ]
                                  },
                                  "sub_totals": [
                                    1140196.7,
                                    391150.81,
                                    -514193.17,
                                    1017154.34
                                  ]
                                },
                                "values": [
                                  1140196.7,
                                  391150.81,
                                  -514193.17,
                                  1017154.34
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_np2Vi9S7mse3UnzEhs86Wj",
                                "label": "529 Software and Tools",
                                "metadata": {
                                  "accounts": [
                                    "acc_np2Vi9S7mse3UnzEhs86Wj"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_np2Vi9S7mse3UnzEhs86Wj",
                                  "label": "Total 529 Software and Tools",
                                  "metadata": {
                                    "accounts": [
                                      "acc_np2Vi9S7mse3UnzEhs86Wj"
                                    ]
                                  },
                                  "sub_totals": [
                                    -128841,
                                    -254824.3,
                                    -244522.5,
                                    -628187.8
                                  ]
                                },
                                "values": [
                                  -128841,
                                  -254824.3,
                                  -244522.5,
                                  -628187.8
                                ]
                              }
                            ],
                            "group": "OPERATING_EXPENSE",
                            "id": "OPERATING_EXPENSE",
                            "label": "Operating Expenses",
                            "metadata": {
                              "sub_classifications": [
                                "OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_operating_expense",
                              "label": "Total Operating Expenses",
                              "metadata": {},
                              "sub_totals": [
                                9667064.19,
                                -1887247.06,
                                -1060808.91,
                                6719008.22
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "OPERATING_PROFIT",
                            "id": "OPERATING_PROFIT",
                            "label": "Operating Profit",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES",
                                "OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_operating_profit",
                              "label": "Operating Profit",
                              "metadata": {},
                              "sub_totals": [
                                -13489038.23,
                                -8119959.8,
                                -20218272.26,
                                -41827270.29
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [],
                                            "id": "acc_K8D9SrmdvbYqJCmUuweRce",
                                            "label": "2879 Higgins, Coleman and Romero",
                                            "metadata": {
                                              "accounts": [
                                                "acc_K8D9SrmdvbYqJCmUuweRce"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_K8D9SrmdvbYqJCmUuweRce",
                                              "label": "Total 2879 Higgins, Coleman and Romero",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_K8D9SrmdvbYqJCmUuweRce"
                                                ]
                                              },
                                              "sub_totals": [
                                                4136375.74,
                                                203506.63,
                                                -2648169.68,
                                                1691712.69
                                              ]
                                            },
                                            "values": [
                                              4136375.74,
                                              203506.63,
                                              -2648169.68,
                                              1691712.69
                                            ]
                                          }
                                        ],
                                        "id": "acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                        "label": "0196 Martinez, Boyd and Vargas",
                                        "metadata": {
                                          "accounts": [
                                            "acc_kjxnhcvAHUCZ9BW8FgPDFk"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                          "label": "Total 0196 Martinez, Boyd and Vargas",
                                          "metadata": {
                                            "accounts": [
                                              "acc_kjxnhcvAHUCZ9BW8FgPDFk",
                                              "acc_K8D9SrmdvbYqJCmUuweRce"
                                            ]
                                          },
                                          "sub_totals": [
                                            5355248.66,
                                            -417357.16,
                                            -1320387.07,
                                            3617504.43
                                          ]
                                        },
                                        "values": [
                                          1218872.92,
                                          -620863.79,
                                          1327782.61,
                                          1925791.74
                                        ]
                                      }
                                    ],
                                    "id": "acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                    "label": "1170 Dickson-Walker",
                                    "metadata": {
                                      "accounts": [
                                        "acc_k7ZD5hrbMmoBBwFVe9ZaNj"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                      "label": "Total 1170 Dickson-Walker",
                                      "metadata": {
                                        "accounts": [
                                          "acc_k7ZD5hrbMmoBBwFVe9ZaNj",
                                          "acc_kjxnhcvAHUCZ9BW8FgPDFk"
                                        ]
                                      },
                                      "sub_totals": [
                                        6469026.98,
                                        -1768999.09,
                                        -823104.56,
                                        3876923.33
                                      ]
                                    },
                                    "values": [
                                      1113778.32,
                                      -1351641.93,
                                      497282.51,
                                      259418.9
                                    ]
                                  }
                                ],
                                "id": "acc_aVBWoEGdrKhFX57dTuB3v2",
                                "label": "4654 Glass and Sons",
                                "metadata": {
                                  "accounts": [
                                    "acc_aVBWoEGdrKhFX57dTuB3v2"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_aVBWoEGdrKhFX57dTuB3v2",
                                  "label": "Total 4654 Glass and Sons",
                                  "metadata": {
                                    "accounts": [
                                      "acc_aVBWoEGdrKhFX57dTuB3v2",
                                      "acc_k7ZD5hrbMmoBBwFVe9ZaNj"
                                    ]
                                  },
                                  "sub_totals": [
                                    6738695.05,
                                    -1739010.68,
                                    -5917945.98,
                                    -918261.61
                                  ]
                                },
                                "values": [
                                  269668.07,
                                  29988.41,
                                  -5094841.42,
                                  -4795184.94
                                ]
                              }
                            ],
                            "group": "OTHER_INCOME",
                            "id": "OTHER_INCOME",
                            "label": "Other Income",
                            "metadata": {
                              "sub_classifications": [
                                "OTHER_INCOME"
                              ]
                            },
                            "summary": {
                              "id": "summary_other_income",
                              "label": "Total Other Income",
                              "metadata": {},
                              "sub_totals": [
                                5355248.66,
                                -417357.16,
                                -1320387.07,
                                3617504.43
                              ]
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "children": [
                                      {
                                        "children": [
                                          {
                                            "children": [
                                              {
                                                "children": [],
                                                "id": "acc_gpjJY9Crkpdzi49ELUQF6u",
                                                "label": "9558 Porter Group",
                                                "metadata": {
                                                  "accounts": [
                                                    "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                  ]
                                                },
                                                "summary": {
                                                  "id": "summary_acc_gpjJY9Crkpdzi49ELUQF6u",
                                                  "label": "Total 9558 Porter Group",
                                                  "metadata": {
                                                    "accounts": [
                                                      "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                    ]
                                                  },
                                                  "sub_totals": [
                                                    696275.83,
                                                    11660665.02,
                                                    145690.84,
                                                    12502631.69
                                                  ]
                                                },
                                                "values": [
                                                  696275.83,
                                                  11660665.02,
                                                  145690.84,
                                                  12502631.69
                                                ]
                                              }
                                            ],
                                            "id": "acc_XCry4baixEx2bRfVFDVDDs",
                                            "label": "9065 Johnson-Bell",
                                            "metadata": {
                                              "accounts": [
                                                "acc_XCry4baixEx2bRfVFDVDDs"
                                              ]
                                            },
                                            "summary": {
                                              "id": "summary_acc_XCry4baixEx2bRfVFDVDDs",
                                              "label": "Total 9065 Johnson-Bell",
                                              "metadata": {
                                                "accounts": [
                                                  "acc_XCry4baixEx2bRfVFDVDDs",
                                                  "acc_gpjJY9Crkpdzi49ELUQF6u"
                                                ]
                                              },
                                              "sub_totals": [
                                                631117.53,
                                                11780680.88,
                                                -6700365.57,
                                                5711432.84
                                              ]
                                            },
                                            "values": [
                                              -65158.3,
                                              120015.86,
                                              -6846056.41,
                                              -6791198.85
                                            ]
                                          }
                                        ],
                                        "id": "acc_cFKHf5xHV5VFfj9zWeWK92",
                                        "label": "4192 Roberts-Chapman",
                                        "metadata": {
                                          "accounts": [
                                            "acc_cFKHf5xHV5VFfj9zWeWK92"
                                          ]
                                        },
                                        "summary": {
                                          "id": "summary_acc_cFKHf5xHV5VFfj9zWeWK92",
                                          "label": "Total 4192 Roberts-Chapman",
                                          "metadata": {
                                            "accounts": [
                                              "acc_cFKHf5xHV5VFfj9zWeWK92",
                                              "acc_XCry4baixEx2bRfVFDVDDs"
                                            ]
                                          },
                                          "sub_totals": [
                                            -8140986.1,
                                            11761568.91,
                                            -6150537.6,
                                            -2529954.79
                                          ]
                                        },
                                        "values": [
                                          -8772103.63,
                                          -19111.97,
                                          549827.97,
                                          -8241387.63
                                        ]
                                      }
                                    ],
                                    "id": "acc_dNqQEL5MXEhwcGmrsrdsoU",
                                    "label": "5978 Richardson, Bauer and Reed",
                                    "metadata": {
                                      "accounts": [
                                        "acc_dNqQEL5MXEhwcGmrsrdsoU"
                                      ]
                                    },
                                    "summary": {
                                      "id": "summary_acc_dNqQEL5MXEhwcGmrsrdsoU",
                                      "label": "Total 5978 Richardson, Bauer and Reed",
                                      "metadata": {
                                        "accounts": [
                                          "acc_dNqQEL5MXEhwcGmrsrdsoU",
                                          "acc_cFKHf5xHV5VFfj9zWeWK92"
                                        ]
                                      },
                                      "sub_totals": [
                                        -7502607.32,
                                        11723592.98,
                                        -5637181.14,
                                        -1416195.48
                                      ]
                                    },
                                    "values": [
                                      638378.78,
                                      -37975.93,
                                      513356.46,
                                      1113759.31
                                    ]
                                  }
                                ],
                                "id": "acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                "label": "9677 Evans-Trujillo",
                                "metadata": {
                                  "accounts": [
                                    "acc_fo8cC2Q8FT3fWwjyZ8qJZD"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                  "label": "Total 9677 Evans-Trujillo",
                                  "metadata": {
                                    "accounts": [
                                      "acc_fo8cC2Q8FT3fWwjyZ8qJZD",
                                      "acc_dNqQEL5MXEhwcGmrsrdsoU"
                                    ]
                                  },
                                  "sub_totals": [
                                    -9656998.27,
                                    15619547.63,
                                    -6285772.27,
                                    -323222.91
                                  ]
                                },
                                "values": [
                                  -2154390.95,
                                  3895954.65,
                                  -648591.13,
                                  1092972.57
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_A2TGPLs2ghKMGtaSPSV8JF",
                                "label": "531 Exchange Gain or Loss",
                                "metadata": {
                                  "accounts": [
                                    "acc_A2TGPLs2ghKMGtaSPSV8JF"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_A2TGPLs2ghKMGtaSPSV8JF",
                                  "label": "Total 531 Exchange Gain or Loss",
                                  "metadata": {
                                    "accounts": [
                                      "acc_A2TGPLs2ghKMGtaSPSV8JF"
                                    ]
                                  },
                                  "sub_totals": [
                                    34910.08,
                                    -115800.08,
                                    31843.23,
                                    -49046.77
                                  ]
                                },
                                "values": [
                                  34910.08,
                                  -115800.08,
                                  31843.23,
                                  -49046.77
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_MjKsTpSfrvasBfWACxkukW",
                                "label": "532 Unrealized Gains and Losses",
                                "metadata": {
                                  "accounts": [
                                    "acc_MjKsTpSfrvasBfWACxkukW"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_MjKsTpSfrvasBfWACxkukW",
                                  "label": "Total 532 Unrealized Gains and Losses",
                                  "metadata": {
                                    "accounts": [
                                      "acc_MjKsTpSfrvasBfWACxkukW"
                                    ]
                                  },
                                  "sub_totals": [
                                    52676.81,
                                    -15329.82,
                                    20561.39,
                                    57908.38
                                  ]
                                },
                                "values": [
                                  52676.81,
                                  -15329.82,
                                  20561.39,
                                  57908.38
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_jUKNwNM5bpdJU7QGgbttYR",
                                "label": "533 Uncategorized",
                                "metadata": {
                                  "accounts": [
                                    "acc_jUKNwNM5bpdJU7QGgbttYR"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_jUKNwNM5bpdJU7QGgbttYR",
                                  "label": "Total 533 Uncategorized",
                                  "metadata": {
                                    "accounts": [
                                      "acc_jUKNwNM5bpdJU7QGgbttYR"
                                    ]
                                  },
                                  "sub_totals": [
                                    -5322274.72,
                                    4094718.98,
                                    1653371.76,
                                    425816.02
                                  ]
                                },
                                "values": [
                                  -5322274.72,
                                  4094718.98,
                                  1653371.76,
                                  425816.02
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_WF8msFwMAczS7mQk3ViRMs",
                                "label": "534 Meals and Entertainment",
                                "metadata": {
                                  "accounts": [
                                    "acc_WF8msFwMAczS7mQk3ViRMs"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_WF8msFwMAczS7mQk3ViRMs",
                                  "label": "Total 534 Meals and Entertainment",
                                  "metadata": {
                                    "accounts": [
                                      "acc_WF8msFwMAczS7mQk3ViRMs"
                                    ]
                                  },
                                  "sub_totals": [
                                    483354.35,
                                    291370.11,
                                    880815.2,
                                    1655539.66
                                  ]
                                },
                                "values": [
                                  483354.35,
                                  291370.11,
                                  880815.2,
                                  1655539.66
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_Hu8bjiaAfm6sCUaTnmAjcq",
                                "label": "535 Depreciation Expense",
                                "metadata": {
                                  "accounts": [
                                    "acc_Hu8bjiaAfm6sCUaTnmAjcq"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_Hu8bjiaAfm6sCUaTnmAjcq",
                                  "label": "Total 535 Depreciation Expense",
                                  "metadata": {
                                    "accounts": [
                                      "acc_Hu8bjiaAfm6sCUaTnmAjcq"
                                    ]
                                  },
                                  "sub_totals": [
                                    6196050.31,
                                    -9938.68,
                                    335981.66,
                                    6522093.29
                                  ]
                                },
                                "values": [
                                  6196050.31,
                                  -9938.68,
                                  335981.66,
                                  6522093.29
                                ]
                              },
                              {
                                "children": [],
                                "id": "acc_kNYTyrAk4ER98h3XEktfuH",
                                "label": "536 Other Expenses",
                                "metadata": {
                                  "accounts": [
                                    "acc_kNYTyrAk4ER98h3XEktfuH"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_acc_kNYTyrAk4ER98h3XEktfuH",
                                  "label": "Total 536 Other Expenses",
                                  "metadata": {
                                    "accounts": [
                                      "acc_kNYTyrAk4ER98h3XEktfuH"
                                    ]
                                  },
                                  "sub_totals": [
                                    -371621.53,
                                    1599707.37,
                                    51255.5,
                                    1279341.34
                                  ]
                                },
                                "values": [
                                  -371621.53,
                                  1599707.37,
                                  51255.5,
                                  1279341.34
                                ]
                              }
                            ],
                            "group": "NON_OPERATING_EXPENSE",
                            "id": "NON_OPERATING_EXPENSE",
                            "label": "Non-Operating Expenses",
                            "metadata": {
                              "sub_classifications": [
                                "NON_OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_non_operating_expense",
                              "label": "Total Non-Operating Expenses",
                              "metadata": {},
                              "sub_totals": [
                                -7067890.8,
                                17606296.79,
                                -3176708.86,
                                7361697.13
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "NET_PROFIT",
                            "id": "NET_PROFIT",
                            "label": "Net Profit",
                            "metadata": {
                              "sub_classifications": [
                                "INCOME",
                                "COST_OF_SALES",
                                "OPERATING_EXPENSES",
                                "OTHER_INCOME",
                                "NON_OPERATING_EXPENSES"
                              ]
                            },
                            "summary": {
                              "id": "summary_net_profit",
                              "label": "Net Profit",
                              "metadata": {},
                              "sub_totals": [
                                -15201680.37,
                                9068979.83,
                                -24715368.19,
                                -30848068.73
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
                    "$ref": "#/components/schemas/api-v1-external-reports-profit-and-loss-read"
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
        "summary": "Profit and Loss\n",
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