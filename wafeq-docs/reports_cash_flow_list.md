---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Cash Flow


Generate cash flow report in `currency` from `date_after` to `date_before` range and group it by `group_by` parameter.


# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "api-v1-external-reports-cash-flow-data-read": {
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
                "$ref": "#/components/schemas/api-v1-external-reports-cash-flow-row-summary-read"
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
      "api-v1-external-reports-cash-flow-overview-read": {
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
            "default": "cash_flow",
            "description": "The id of the report",
            "readOnly": true,
            "type": "string"
          },
          "label": {
            "default": "Cash Flow Report",
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
      "api-v1-external-reports-cash-flow-read": {
        "properties": {
          "columns": {
            "description": "The columns of the report",
            "items": {
              "$ref": "#/components/schemas/api-v1-external-reports-cash-flow-row-column-read"
            },
            "type": "array"
          },
          "overview": {
            "allOf": [
              {
                "$ref": "#/components/schemas/api-v1-external-reports-cash-flow-overview-read"
              }
            ],
            "description": "The overview of the report"
          },
          "rows": {
            "description": "The rows of the report",
            "items": {
              "$ref": "#/components/schemas/api-v1-external-reports-cash-flow-section-read"
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
      "api-v1-external-reports-cash-flow-row-column-read": {
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
      "api-v1-external-reports-cash-flow-row-summary-read": {
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
      "api-v1-external-reports-cash-flow-section-read": {
        "properties": {
          "children": {
            "description": "The children of the section",
            "items": {
              "$ref": "#/components/schemas/api-v1-external-reports-cash-flow-data-read"
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
                "$ref": "#/components/schemas/api-v1-external-reports-cash-flow-row-summary-read"
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
    "/reports/cash-flow/": {
      "get": {
        "description": "Generate cash flow report in `currency` from `date_after` to `date_before` range and group it by `group_by` parameter.\n",
        "operationId": "reports_cash_flow_list",
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
                          "id": "cash_flow",
                          "label": "التدفق النقدي"
                        },
                        "rows": [
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
                                    -3.6,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -3.6
                                  ]
                                },
                                "values": [
                                  -3.6,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -3.6
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
                                    0,
                                    -7573.89,
                                    -852.01,
                                    1777.51,
                                    0,
                                    0,
                                    -6648.39
                                  ]
                                },
                                "values": [
                                  0,
                                  -7573.89,
                                  -852.01,
                                  1777.51,
                                  0,
                                  0,
                                  -6648.39
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
                                    -96.17,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -96.17
                                  ]
                                },
                                "values": [
                                  -96.17,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -96.17
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
                                    -32.25,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -32.25
                                  ]
                                },
                                "values": [
                                  -32.25,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -32.25
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
                                    0,
                                    -8259.7,
                                    0,
                                    0,
                                    4479.53,
                                    4356.6,
                                    576.43
                                  ]
                                },
                                "values": [
                                  0,
                                  -8259.7,
                                  0,
                                  0,
                                  4479.53,
                                  4356.6,
                                  576.43
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
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -235.94,
                                    -235.94
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -235.94,
                                  -235.94
                                ]
                              }
                            ],
                            "group": "CFO",
                            "id": "CFO",
                            "label": "التشغيلات",
                            "metadata": {
                              "activity": [
                                "CFO"
                              ]
                            },
                            "summary": {
                              "id": "summary_cfo",
                              "label": "إجمالي التشغيلات",
                              "metadata": {},
                              "sub_totals": [
                                -132.02,
                                -15833.59,
                                -852.01,
                                1777.51,
                                4479.53,
                                4120.66,
                                -6439.92
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "CFI",
                            "id": "CFI",
                            "label": "الاستثمارات",
                            "metadata": {
                              "activity": [
                                "CFI"
                              ]
                            },
                            "summary": {
                              "id": "summary_cfi",
                              "label": "إجمالي الاستثمارات",
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
                            "children": [],
                            "group": "CFF",
                            "id": "CFF",
                            "label": "التمويلات",
                            "metadata": {
                              "activity": [
                                "CFF"
                              ]
                            },
                            "summary": {
                              "id": "summary_cff",
                              "label": "إجمالي التمويلات",
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
                            "children": [],
                            "group": "FREE_CASH_FLOW",
                            "id": "FREE_CASH_FLOW",
                            "label": "التدفق النقدي الصافي",
                            "metadata": {
                              "activity": [
                                "CFO",
                                "CFI",
                                "CFF"
                              ]
                            },
                            "summary": {
                              "id": "summary_free_cash_flow",
                              "label": "التدفق النقدي الصافي",
                              "metadata": {},
                              "sub_totals": [
                                -132.02,
                                -15833.59,
                                -852.01,
                                1777.51,
                                4479.53,
                                4120.66,
                                -6439.92
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
                          "id": "cash_flow",
                          "label": "Cash Flow Report"
                        },
                        "rows": [
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
                                    12.52,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    12.52
                                  ]
                                },
                                "values": [
                                  12.52,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  12.52
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
                                    -7261.06,
                                    0,
                                    0,
                                    0,
                                    -7261.06
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  -7261.06,
                                  0,
                                  0,
                                  0,
                                  -7261.06
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
                                    -32.25,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -32.25
                                  ]
                                },
                                "values": [
                                  -32.25,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -32.25
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
                                    0,
                                    -8355.7,
                                    0,
                                    0,
                                    0,
                                    -1.8,
                                    -8357.5
                                  ]
                                },
                                "values": [
                                  0,
                                  -8355.7,
                                  0,
                                  0,
                                  0,
                                  -1.8,
                                  -8357.5
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
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -360.33,
                                    -360.33
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -360.33,
                                  -360.33
                                ]
                              }
                            ],
                            "group": "CFO",
                            "id": "CFO",
                            "label": "Operating",
                            "metadata": {
                              "activity": [
                                "CFO"
                              ]
                            },
                            "summary": {
                              "id": "summary_cfo",
                              "label": "Total Operating",
                              "metadata": {},
                              "sub_totals": [
                                -19.73,
                                -8355.7,
                                -7261.06,
                                0,
                                0,
                                -362.13,
                                -15998.62
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "CFI",
                            "id": "CFI",
                            "label": "Investing",
                            "metadata": {
                              "activity": [
                                "CFI"
                              ]
                            },
                            "summary": {
                              "id": "summary_cfi",
                              "label": "Total Investing",
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
                            "children": [],
                            "group": "CFF",
                            "id": "CFF",
                            "label": "Financing",
                            "metadata": {
                              "activity": [
                                "CFF"
                              ]
                            },
                            "summary": {
                              "id": "summary_cff",
                              "label": "Total Financing",
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
                            "children": [],
                            "group": "FREE_CASH_FLOW",
                            "id": "FREE_CASH_FLOW",
                            "label": "Free Cash Flow",
                            "metadata": {
                              "activity": [
                                "CFO",
                                "CFI",
                                "CFF"
                              ]
                            },
                            "summary": {
                              "id": "summary_free_cash_flow",
                              "label": "Free Cash Flow",
                              "metadata": {},
                              "sub_totals": [
                                -19.73,
                                -8355.7,
                                -7261.06,
                                0,
                                0,
                                -362.13,
                                -15998.62
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
                          "id": "cash_flow",
                          "label": "Cash Flow Report"
                        },
                        "rows": [
                          {
                            "children": [
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
                                    946.05,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -2511.6,
                                    0,
                                    0,
                                    -1565.55
                                  ]
                                },
                                "values": [
                                  0,
                                  946.05,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -2511.6,
                                  0,
                                  0,
                                  -1565.55
                                ]
                              },
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
                                    0,
                                    -3.6,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    2871,
                                    2867.4
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  0,
                                  -3.6,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  2871,
                                  2867.4
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
                                    419,
                                    0,
                                    0,
                                    0,
                                    -7573.89,
                                    -852.01,
                                    1777.51,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -6229.39
                                  ]
                                },
                                "values": [
                                  419,
                                  0,
                                  0,
                                  0,
                                  -7573.89,
                                  -852.01,
                                  1777.51,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -6229.39
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
                                    187.5,
                                    -96.17,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -1997.25,
                                    5688.02,
                                    3782.1
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  187.5,
                                  -96.17,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -1997.25,
                                  5688.02,
                                  3782.1
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
                                    -5592.96,
                                    -1341.31,
                                    -32.25,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -6966.52
                                  ]
                                },
                                "values": [
                                  0,
                                  -5592.96,
                                  -1341.31,
                                  -32.25,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -6966.52
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
                                    0,
                                    0,
                                    0,
                                    0,
                                    -8259.7,
                                    0,
                                    0,
                                    4479.53,
                                    4356.6,
                                    0,
                                    0,
                                    -8972.92,
                                    -8396.49
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  0,
                                  0,
                                  -8259.7,
                                  0,
                                  0,
                                  4479.53,
                                  4356.6,
                                  0,
                                  0,
                                  -8972.92,
                                  -8396.49
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
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -85.36,
                                    0.31,
                                    0,
                                    -85.05
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -85.36,
                                  0.31,
                                  0,
                                  -85.05
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
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    -235.94,
                                    0,
                                    0,
                                    0,
                                    -235.94
                                  ]
                                },
                                "values": [
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  0,
                                  -235.94,
                                  0,
                                  0,
                                  0,
                                  -235.94
                                ]
                              }
                            ],
                            "group": "CFO",
                            "id": "CFO",
                            "label": "Operating",
                            "metadata": {
                              "activity": [
                                "CFO"
                              ]
                            },
                            "summary": {
                              "id": "summary_cfo",
                              "label": "Total Operating",
                              "metadata": {},
                              "sub_totals": [
                                419,
                                -4646.91,
                                -1153.81,
                                -132.02,
                                -15833.59,
                                -852.01,
                                1777.51,
                                4479.53,
                                4120.66,
                                -2596.96,
                                -1996.94,
                                -413.9,
                                -16829.44
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "CFI",
                            "id": "CFI",
                            "label": "Investing",
                            "metadata": {
                              "activity": [
                                "CFI"
                              ]
                            },
                            "summary": {
                              "id": "summary_cfi",
                              "label": "Total Investing",
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
                                0,
                                0
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "CFF",
                            "id": "CFF",
                            "label": "Financing",
                            "metadata": {
                              "activity": [
                                "CFF"
                              ]
                            },
                            "summary": {
                              "id": "summary_cff",
                              "label": "Total Financing",
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
                                0,
                                0
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "FREE_CASH_FLOW",
                            "id": "FREE_CASH_FLOW",
                            "label": "Free Cash Flow",
                            "metadata": {
                              "activity": [
                                "CFO",
                                "CFI",
                                "CFF"
                              ]
                            },
                            "summary": {
                              "id": "summary_free_cash_flow",
                              "label": "Free Cash Flow",
                              "metadata": {},
                              "sub_totals": [
                                419,
                                -4646.91,
                                -1153.81,
                                -132.02,
                                -15833.59,
                                -852.01,
                                1777.51,
                                4479.53,
                                4120.66,
                                -2596.96,
                                -1996.94,
                                -413.9,
                                -16829.44
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
                          "id": "cash_flow",
                          "label": "Cash Flow Report"
                        },
                        "rows": [
                          {
                            "children": [
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
                                    -2230.4,
                                    -1565.55,
                                    -1712.2,
                                    -5508.15
                                  ]
                                },
                                "values": [
                                  -2230.4,
                                  -1565.55,
                                  -1712.2,
                                  -5508.15
                                ]
                              },
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
                                    960.7,
                                    2867.4,
                                    -10171.46,
                                    -6343.36
                                  ]
                                },
                                "values": [
                                  960.7,
                                  2867.4,
                                  -10171.46,
                                  -6343.36
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
                                    -10104.95,
                                    -6229.39,
                                    -238.07,
                                    -16572.41
                                  ]
                                },
                                "values": [
                                  -10104.95,
                                  -6229.39,
                                  -238.07,
                                  -16572.41
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
                                    1450.54,
                                    3782.1,
                                    11087.08,
                                    16319.72
                                  ]
                                },
                                "values": [
                                  1450.54,
                                  3782.1,
                                  11087.08,
                                  16319.72
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
                                    -32421,
                                    -6966.52,
                                    -14.44,
                                    -39401.96
                                  ]
                                },
                                "values": [
                                  -32421,
                                  -6966.52,
                                  -14.44,
                                  -39401.96
                                ]
                              },
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
                                    -1029.29,
                                    0,
                                    6865.09,
                                    5835.8
                                  ]
                                },
                                "values": [
                                  -1029.29,
                                  0,
                                  6865.09,
                                  5835.8
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
                                    317.17,
                                    -8396.49,
                                    -23323.65,
                                    -31402.97
                                  ]
                                },
                                "values": [
                                  317.17,
                                  -8396.49,
                                  -23323.65,
                                  -31402.97
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
                                    21378.93,
                                    -85.05,
                                    -42.2,
                                    21251.68
                                  ]
                                },
                                "values": [
                                  21378.93,
                                  -85.05,
                                  -42.2,
                                  21251.68
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
                                    1951.98,
                                    -235.94,
                                    31900.61,
                                    33616.65
                                  ]
                                },
                                "values": [
                                  1951.98,
                                  -235.94,
                                  31900.61,
                                  33616.65
                                ]
                              }
                            ],
                            "group": "CFO",
                            "id": "CFO",
                            "label": "Operating",
                            "metadata": {
                              "activity": [
                                "CFO"
                              ]
                            },
                            "summary": {
                              "id": "summary_cfo",
                              "label": "Total Operating",
                              "metadata": {},
                              "sub_totals": [
                                -19726.32,
                                -16829.44,
                                14350.76,
                                -22205
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "CFI",
                            "id": "CFI",
                            "label": "Investing",
                            "metadata": {
                              "activity": [
                                "CFI"
                              ]
                            },
                            "summary": {
                              "id": "summary_cfi",
                              "label": "Total Investing",
                              "metadata": {},
                              "sub_totals": [
                                0,
                                0,
                                0,
                                0
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "CFF",
                            "id": "CFF",
                            "label": "Financing",
                            "metadata": {
                              "activity": [
                                "CFF"
                              ]
                            },
                            "summary": {
                              "id": "summary_cff",
                              "label": "Total Financing",
                              "metadata": {},
                              "sub_totals": [
                                0,
                                0,
                                0,
                                0
                              ]
                            }
                          },
                          {
                            "children": [],
                            "group": "FREE_CASH_FLOW",
                            "id": "FREE_CASH_FLOW",
                            "label": "Free Cash Flow",
                            "metadata": {
                              "activity": [
                                "CFO",
                                "CFI",
                                "CFF"
                              ]
                            },
                            "summary": {
                              "id": "summary_free_cash_flow",
                              "label": "Free Cash Flow",
                              "metadata": {},
                              "sub_totals": [
                                -19726.32,
                                -16829.44,
                                14350.76,
                                -22205
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
                    "$ref": "#/components/schemas/api-v1-external-reports-cash-flow-read"
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
        "summary": "Cash Flow\n",
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