---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Trial Balance


Generate trial balance report from `from_date` to `to_date` optionally with PNL openings `with_pnl_openings` and accounts with zero balances `include_zero_balances`.


# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "_TrialBalanceTotalsRead": {
        "properties": {
          "credit_to_bcy": {
            "description": "Credits in base currency",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "debit_to_bcy": {
            "description": "Debits in base currency",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "opening_balance_to_bcy": {
            "description": "Opening balance in base currency",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          },
          "running_balance_to_bcy": {
            "description": "Running balance in base currency",
            "exclusiveMaximum": 10000000000000000,
            "exclusiveMinimum": -10000000000000000,
            "format": "double",
            "type": "number"
          }
        },
        "required": [
          "credit_to_bcy",
          "debit_to_bcy",
          "opening_balance_to_bcy",
          "running_balance_to_bcy"
        ],
        "type": "object"
      },
      "api-v1-external-reports-trial-balance-grouped-read": {
        "properties": {
          "overview": {
            "allOf": [
              {
                "$ref": "#/components/schemas/api-v1-external-reports-trial-balance-overview-read"
              }
            ],
            "description": "The overview of the report"
          },
          "rows": {
            "description": "The rows of the report",
            "items": {
              "$ref": "#/components/schemas/api-v1-external-reports-trial-balance-section-read"
            },
            "type": "array"
          },
          "summary": {
            "allOf": [
              {
                "$ref": "#/components/schemas/api-v1-external-reports-trial-balance-summary-read"
              }
            ],
            "description": "The totals of the report"
          }
        },
        "required": [
          "overview",
          "rows",
          "summary"
        ],
        "type": "object"
      },
      "api-v1-external-reports-trial-balance-overview-read": {
        "properties": {
          "count": {
            "default": 0,
            "description": "The total number of accounts",
            "readOnly": true,
            "type": "integer"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the report was created",
            "format": "date-time",
            "readOnly": true,
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
          "from_date": {
            "description": "The start date of the report",
            "format": "date",
            "type": "string"
          },
          "id": {
            "default": "trial_balance",
            "description": "The id of the report",
            "readOnly": true,
            "type": "string"
          },
          "include_zero_balances": {
            "description": "Whether the report includes the accounts with zero balances",
            "type": "boolean"
          },
          "label": {
            "default": "Trial Balance Report",
            "description": "The title of the report",
            "readOnly": true,
            "type": "string"
          },
          "to_date": {
            "description": "The end date of the report",
            "format": "date",
            "type": "string"
          },
          "with_pnl_openings": {
            "description": "Whether the report includes the Profit and Loss openings",
            "type": "boolean"
          }
        },
        "required": [
          "count",
          "created_ts",
          "filters",
          "from_date",
          "id",
          "include_zero_balances",
          "label",
          "to_date",
          "with_pnl_openings"
        ],
        "type": "object"
      },
      "api-v1-external-reports-trial-balance-section-read": {
        "properties": {
          "children": {
            "description": "The children of the section",
            "items": {
              "additionalProperties": {},
              "type": "object"
            },
            "readOnly": true,
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
                "$ref": "#/components/schemas/api-v1-external-reports-trial-balance-section-summary-read"
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
      "api-v1-external-reports-trial-balance-section-summary-read": {
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
            "default": {},
            "description": "The metadata of the summary",
            "type": "object"
          },
          "sub_totals": {
            "allOf": [
              {
                "$ref": "#/components/schemas/_TrialBalanceTotalsRead"
              }
            ],
            "description": "The sub totals of the section"
          }
        },
        "required": [
          "id",
          "label",
          "sub_totals"
        ],
        "type": "object"
      },
      "api-v1-external-reports-trial-balance-summary-read": {
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
            "default": {},
            "description": "The metadata of the summary",
            "type": "object"
          },
          "totals": {
            "allOf": [
              {
                "$ref": "#/components/schemas/_TrialBalanceTotalsRead"
              }
            ],
            "description": "The totals of report"
          }
        },
        "required": [
          "id",
          "label",
          "totals"
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
    "/reports/trial-balance/": {
      "get": {
        "description": "Generate trial balance report from `from_date` to `to_date` optionally with PNL openings `with_pnl_openings` and accounts with zero balances `include_zero_balances`.\n",
        "operationId": "reports_trial_balance_list",
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
            "description": "The starting date of the report.",
            "in": "query",
            "name": "from_date",
            "schema": {
              "format": "date",
              "type": "string"
            }
          },
          {
            "description": "Whether the report should include accounts with zero balances.",
            "in": "query",
            "name": "include_zero_balances",
            "schema": {
              "default": false,
              "type": "boolean"
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
          },
          {
            "description": "The ending date of the report.",
            "in": "query",
            "name": "to_date",
            "schema": {
              "format": "date",
              "type": "string"
            }
          },
          {
            "description": "Whether the report should include PNL openings.",
            "in": "query",
            "name": "with_pnl_openings",
            "schema": {
              "default": false,
              "type": "boolean"
            }
          }
        ],
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "examples": {
                  "Default": {
                    "description": "The default report without modifiers or filters",
                    "summary": "Default report",
                    "value": [
                      {
                        "overview": {
                          "count": 24,
                          "created_ts": "2025-05-06T14:03:33.977283Z",
                          "filters": {},
                          "from_date": "2025-01-01",
                          "id": "trial_balance",
                          "label": "Trial Balance Report",
                          "to_date": "2025-05-06"
                        },
                        "rows": [
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "code": "101",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Q6aUYP5bThNnEvRWq86jG6",
                                    "label": "101 Accounts Receivable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Q6aUYP5bThNnEvRWq86jG6"
                                      ]
                                    },
                                    "name": "Accounts Receivable",
                                    "opening_balance_to_bcy": 303404.87,
                                    "running_balance_to_bcy": 303404.87
                                  },
                                  {
                                    "code": "106",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_hVBXZk8gA46NHGdauXDvuG",
                                    "label": "106 Prepaid Expenses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_hVBXZk8gA46NHGdauXDvuG"
                                      ]
                                    },
                                    "name": "Prepaid Expenses",
                                    "opening_balance_to_bcy": -4000,
                                    "running_balance_to_bcy": -4000
                                  },
                                  {
                                    "code": "108",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_GS2kVL2ELznQfhsspxMxsF",
                                    "label": "108 Loan receivable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_GS2kVL2ELznQfhsspxMxsF"
                                      ]
                                    },
                                    "name": "Loan receivable",
                                    "opening_balance_to_bcy": 14764.08,
                                    "running_balance_to_bcy": 14764.08
                                  },
                                  {
                                    "code": "108",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_EA8Jj3q9eiSyb4rKehjyhL",
                                    "label": "108 ENBD account *3202",
                                    "metadata": {
                                      "accounts": [
                                        "acc_EA8Jj3q9eiSyb4rKehjyhL"
                                      ]
                                    },
                                    "name": "ENBD account *3202",
                                    "opening_balance_to_bcy": 90755.12,
                                    "running_balance_to_bcy": 90755.12
                                  },
                                  {
                                    "code": "304",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_NCXhgdtrda6WSUDvS7peFJ",
                                    "label": "304 Inventory Asset",
                                    "metadata": {
                                      "accounts": [
                                        "acc_NCXhgdtrda6WSUDvS7peFJ"
                                      ]
                                    },
                                    "name": "Inventory Asset",
                                    "opening_balance_to_bcy": 370.17,
                                    "running_balance_to_bcy": 370.17
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": 405294.24,
                                    "running_balance_to_bcy": 405294.24
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "105",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_78bQwooJVx9sA7VogHMQyT",
                                    "label": "105 Bank Account",
                                    "metadata": {
                                      "accounts": [
                                        "acc_78bQwooJVx9sA7VogHMQyT"
                                      ]
                                    },
                                    "name": "Bank Account",
                                    "opening_balance_to_bcy": 92823.78,
                                    "running_balance_to_bcy": 92823.78
                                  },
                                  {
                                    "code": "108",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_JXJPgQh2nigjR4YSrFnKcp",
                                    "label": "108 ENBD account xxxxxxxxxxxxx*3201 AED",
                                    "metadata": {
                                      "accounts": [
                                        "acc_JXJPgQh2nigjR4YSrFnKcp"
                                      ]
                                    },
                                    "name": "ENBD account xxxxxxxxxxxxx*3201 AED",
                                    "opening_balance_to_bcy": 8643770.63,
                                    "running_balance_to_bcy": 8643770.63
                                  },
                                  {
                                    "code": "109",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Kb7DCXLUQpKAuCMyaT5PUL",
                                    "label": "109 SABB SAR",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Kb7DCXLUQpKAuCMyaT5PUL"
                                      ]
                                    },
                                    "name": "SABB SAR",
                                    "opening_balance_to_bcy": -11084.16,
                                    "running_balance_to_bcy": -11084.16
                                  },
                                  {
                                    "code": "199",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_TRBH3h6DGGyje7v2UaZesc",
                                    "label": "199 WeKeep Pay",
                                    "metadata": {
                                      "accounts": [
                                        "acc_TRBH3h6DGGyje7v2UaZesc"
                                      ]
                                    },
                                    "name": "WeKeep Pay",
                                    "opening_balance_to_bcy": 2,
                                    "running_balance_to_bcy": 2
                                  }
                                ],
                                "group": "CASH_EQUIVALENTS",
                                "id": "CASH_EQUIVALENTS",
                                "label": "Cash and Cash Equivalents",
                                "metadata": {
                                  "sub_classification": [
                                    "CASH_EQUIVALENTS"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_cash_equivalents",
                                  "label": "Total Cash and Cash Equivalents",
                                  "metadata": {},
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": 8725512.25,
                                    "running_balance_to_bcy": 8725512.25
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "132",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_KXuAt99tagheSXSmmrd8uq",
                                    "label": "132 Accumulated Depreciation",
                                    "metadata": {
                                      "accounts": [
                                        "acc_KXuAt99tagheSXSmmrd8uq"
                                      ]
                                    },
                                    "name": "Accumulated Depreciation",
                                    "opening_balance_to_bcy": -89180,
                                    "running_balance_to_bcy": -89180
                                  }
                                ],
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -89180,
                                    "running_balance_to_bcy": -89180
                                  }
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
                              "sub_totals": {
                                "credit_to_bcy": 0,
                                "debit_to_bcy": 0,
                                "opening_balance_to_bcy": 9041626.49,
                                "running_balance_to_bcy": 9041626.49
                              }
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "code": "201",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_ACFNYGsDvhvRXjxdvjhWEE",
                                    "label": "201 Accounts Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_ACFNYGsDvhvRXjxdvjhWEE"
                                      ]
                                    },
                                    "name": "Accounts Payable",
                                    "opening_balance_to_bcy": -1623.43,
                                    "running_balance_to_bcy": -1623.43
                                  },
                                  {
                                    "code": "204",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_kDyy2BkrsJpH4PfqvTkN4W",
                                    "label": "204 Payroll Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_kDyy2BkrsJpH4PfqvTkN4W"
                                      ]
                                    },
                                    "name": "Payroll Payable",
                                    "opening_balance_to_bcy": -65005.17,
                                    "running_balance_to_bcy": -65005.17
                                  },
                                  {
                                    "code": "206",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_HJB4ogyCYHpu2rSA8kMwTW",
                                    "label": "206 Loan from Owner",
                                    "metadata": {
                                      "accounts": [
                                        "acc_HJB4ogyCYHpu2rSA8kMwTW"
                                      ]
                                    },
                                    "name": "Loan from Owner",
                                    "opening_balance_to_bcy": 533.5,
                                    "running_balance_to_bcy": 533.5
                                  },
                                  {
                                    "code": "208",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_7bxFxKA9fGx32pFuTGb8iq",
                                    "label": "208 VAT",
                                    "metadata": {
                                      "accounts": [
                                        "acc_7bxFxKA9fGx32pFuTGb8iq"
                                      ]
                                    },
                                    "name": "VAT",
                                    "opening_balance_to_bcy": -18797.11,
                                    "running_balance_to_bcy": -18797.11
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_kC6Kvxwp958hTRJXzVhJn9",
                                    "label": "211 Credit Card 7228",
                                    "metadata": {
                                      "accounts": [
                                        "acc_kC6Kvxwp958hTRJXzVhJn9"
                                      ]
                                    },
                                    "name": "Credit Card 7228",
                                    "opening_balance_to_bcy": -210,
                                    "running_balance_to_bcy": -210
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_md8UFnAxg9EYyBGSJRmeSA",
                                    "label": " Alex W. Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_md8UFnAxg9EYyBGSJRmeSA"
                                      ]
                                    },
                                    "name": "Alex W. Reimbursements",
                                    "opening_balance_to_bcy": 44224.08,
                                    "running_balance_to_bcy": 44224.08
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_hS6r4zz9XsExkthh8TSLWN",
                                    "label": " Valerie P. Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_hS6r4zz9XsExkthh8TSLWN"
                                      ]
                                    },
                                    "name": "Valerie P. Reimbursements",
                                    "opening_balance_to_bcy": -0.01,
                                    "running_balance_to_bcy": -0.01
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_EsN3SDPQHzKmsandTmrtAn",
                                    "label": " Abdul S. Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_EsN3SDPQHzKmsandTmrtAn"
                                      ]
                                    },
                                    "name": "Abdul S. Reimbursements",
                                    "opening_balance_to_bcy": -59778.05,
                                    "running_balance_to_bcy": -59778.05
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_WNqCknNnpFrQyKCWbLNz4W",
                                    "label": "211 Daniil Barkalov Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_WNqCknNnpFrQyKCWbLNz4W"
                                      ]
                                    },
                                    "name": "Daniil Barkalov Reimbursements",
                                    "opening_balance_to_bcy": 100,
                                    "running_balance_to_bcy": 100
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_UgjrDFMCt4G5Yq5oM8D4Bg",
                                    "label": "211 Don Pablito Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_UgjrDFMCt4G5Yq5oM8D4Bg"
                                      ]
                                    },
                                    "name": "Don Pablito Reimbursements",
                                    "opening_balance_to_bcy": 7,
                                    "running_balance_to_bcy": 7
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_fEBqhVTjp2V8B6he37RDVj",
                                    "label": "211 Boochie Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_fEBqhVTjp2V8B6he37RDVj"
                                      ]
                                    },
                                    "name": "Boochie Reimbursements",
                                    "opening_balance_to_bcy": 4079.77,
                                    "running_balance_to_bcy": 4079.77
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_LCbV9eBQbZczb2ocYNS5Xa",
                                    "label": "211 Nadim Alameddine Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_LCbV9eBQbZczb2ocYNS5Xa"
                                      ]
                                    },
                                    "name": "Nadim Alameddine Reimbursements",
                                    "opening_balance_to_bcy": -1023,
                                    "running_balance_to_bcy": -1023
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -97492.42,
                                    "running_balance_to_bcy": -97492.42
                                  }
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
                              "sub_totals": {
                                "credit_to_bcy": 0,
                                "debit_to_bcy": 0,
                                "opening_balance_to_bcy": -97492.42,
                                "running_balance_to_bcy": -97492.42
                              }
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "code": "301",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_XNsveGWLXmuZXJ7VmXmzUV",
                                    "label": "301 Retained Earnings",
                                    "metadata": {
                                      "accounts": [
                                        "acc_XNsveGWLXmuZXJ7VmXmzUV"
                                      ]
                                    },
                                    "name": "Retained Earnings",
                                    "opening_balance_to_bcy": -8852867.21,
                                    "running_balance_to_bcy": -8852867.21
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -8852867.21,
                                    "running_balance_to_bcy": -8852867.21
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "302",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_FR5vCbAJdDG6CLMGECFWSa",
                                    "label": "302 Owner's Equity",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FR5vCbAJdDG6CLMGECFWSa"
                                      ]
                                    },
                                    "name": "Owner's Equity",
                                    "opening_balance_to_bcy": -91266.86,
                                    "running_balance_to_bcy": -91266.86
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -91266.86,
                                    "running_balance_to_bcy": -91266.86
                                  }
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
                              "sub_totals": {
                                "credit_to_bcy": 0,
                                "debit_to_bcy": 0,
                                "opening_balance_to_bcy": -8944134.07,
                                "running_balance_to_bcy": -8944134.07
                              }
                            }
                          }
                        ],
                        "summary": {
                          "id": "totals",
                          "label": "Totals",
                          "metadata": {},
                          "totals": {
                            "credit_to_bcy": 0,
                            "debit_to_bcy": 0,
                            "opening_balance_to_bcy": 0,
                            "running_balance_to_bcy": 0
                          }
                        }
                      }
                    ]
                  },
                  "IncludeZeroBalances": {
                    "description": "Report includes accounts with zero balances",
                    "summary": "Include zero balances",
                    "value": [
                      {
                        "overview": {
                          "count": 99,
                          "created_ts": "2025-05-06T14:14:04.840245Z",
                          "filters": {},
                          "from_date": "2025-01-01",
                          "id": "trial_balance",
                          "include_zero_balances": true,
                          "label": "Trial Balance Report",
                          "to_date": "2025-05-06",
                          "with_pnl_openings": false
                        },
                        "rows": [
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "code": " ",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_GaU6RNdYgPt9FbjMi2j2mU",
                                    "label": "  Inventory",
                                    "metadata": {
                                      "accounts": [
                                        "acc_GaU6RNdYgPt9FbjMi2j2mU"
                                      ]
                                    },
                                    "name": "Inventory",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "101",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Q6aUYP5bThNnEvRWq86jG6",
                                    "label": "101 Accounts Receivable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Q6aUYP5bThNnEvRWq86jG6"
                                      ]
                                    },
                                    "name": "Accounts Receivable",
                                    "opening_balance_to_bcy": 303404.87,
                                    "running_balance_to_bcy": 303404.87
                                  },
                                  {
                                    "code": "102",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_TRspDbYUtdJqWAMrCK9LYi",
                                    "label": "102 Furniture and Equipment",
                                    "metadata": {
                                      "accounts": [
                                        "acc_TRspDbYUtdJqWAMrCK9LYi"
                                      ]
                                    },
                                    "name": "Furniture and Equipment",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "104",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_4q2FayBDe4WKhPiDJejcv2",
                                    "label": "104 Employee Advance",
                                    "metadata": {
                                      "accounts": [
                                        "acc_4q2FayBDe4WKhPiDJejcv2"
                                      ]
                                    },
                                    "name": "Employee Advance",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "106",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_hVBXZk8gA46NHGdauXDvuG",
                                    "label": "106 Prepaid Expenses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_hVBXZk8gA46NHGdauXDvuG"
                                      ]
                                    },
                                    "name": "Prepaid Expenses",
                                    "opening_balance_to_bcy": -4000,
                                    "running_balance_to_bcy": -4000
                                  },
                                  {
                                    "code": "107",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_4nMFBTH5TuBidFsvsFTfwb",
                                    "label": "107 Advance Tax",
                                    "metadata": {
                                      "accounts": [
                                        "acc_4nMFBTH5TuBidFsvsFTfwb"
                                      ]
                                    },
                                    "name": "Advance Tax",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "108",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_GS2kVL2ELznQfhsspxMxsF",
                                    "label": "108 Loan receivable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_GS2kVL2ELznQfhsspxMxsF"
                                      ]
                                    },
                                    "name": "Loan receivable",
                                    "opening_balance_to_bcy": 14764.08,
                                    "running_balance_to_bcy": 14764.08
                                  },
                                  {
                                    "code": "108",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_EA8Jj3q9eiSyb4rKehjyhL",
                                    "label": "108 ENBD account *3202",
                                    "metadata": {
                                      "accounts": [
                                        "acc_EA8Jj3q9eiSyb4rKehjyhL"
                                      ]
                                    },
                                    "name": "ENBD account *3202",
                                    "opening_balance_to_bcy": 90755.12,
                                    "running_balance_to_bcy": 90755.12
                                  },
                                  {
                                    "code": "304",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_NCXhgdtrda6WSUDvS7peFJ",
                                    "label": "304 Inventory Asset",
                                    "metadata": {
                                      "accounts": [
                                        "acc_NCXhgdtrda6WSUDvS7peFJ"
                                      ]
                                    },
                                    "name": "Inventory Asset",
                                    "opening_balance_to_bcy": 370.17,
                                    "running_balance_to_bcy": 370.17
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": 405294.24,
                                    "running_balance_to_bcy": 405294.24
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "100",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_geXDQKCtGdJBBpGaJhQ7nk",
                                    "label": "100 Undeposited Funds",
                                    "metadata": {
                                      "accounts": [
                                        "acc_geXDQKCtGdJBBpGaJhQ7nk"
                                      ]
                                    },
                                    "name": "Undeposited Funds",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "103",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_kMmHKo6BYJtSaWaJjAa9aQ",
                                    "label": "103 Petty Cash",
                                    "metadata": {
                                      "accounts": [
                                        "acc_kMmHKo6BYJtSaWaJjAa9aQ"
                                      ]
                                    },
                                    "name": "Petty Cash",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "105",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_78bQwooJVx9sA7VogHMQyT",
                                    "label": "105 Bank Account",
                                    "metadata": {
                                      "accounts": [
                                        "acc_78bQwooJVx9sA7VogHMQyT"
                                      ]
                                    },
                                    "name": "Bank Account",
                                    "opening_balance_to_bcy": 92823.78,
                                    "running_balance_to_bcy": 92823.78
                                  },
                                  {
                                    "code": "108",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_JXJPgQh2nigjR4YSrFnKcp",
                                    "label": "108 ENBD account xxxxxxxxxxxxx*3201 AED",
                                    "metadata": {
                                      "accounts": [
                                        "acc_JXJPgQh2nigjR4YSrFnKcp"
                                      ]
                                    },
                                    "name": "ENBD account xxxxxxxxxxxxx*3201 AED",
                                    "opening_balance_to_bcy": 8643770.63,
                                    "running_balance_to_bcy": 8643770.63
                                  },
                                  {
                                    "code": "109",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Kb7DCXLUQpKAuCMyaT5PUL",
                                    "label": "109 SABB SAR",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Kb7DCXLUQpKAuCMyaT5PUL"
                                      ]
                                    },
                                    "name": "SABB SAR",
                                    "opening_balance_to_bcy": -11084.16,
                                    "running_balance_to_bcy": -11084.16
                                  },
                                  {
                                    "code": "110",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_52EqUydwsGwndohx2YteMX",
                                    "label": "110 qwe",
                                    "metadata": {
                                      "accounts": [
                                        "acc_52EqUydwsGwndohx2YteMX"
                                      ]
                                    },
                                    "name": "qwe",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "199",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_TRBH3h6DGGyje7v2UaZesc",
                                    "label": "199 WeKeep Pay",
                                    "metadata": {
                                      "accounts": [
                                        "acc_TRBH3h6DGGyje7v2UaZesc"
                                      ]
                                    },
                                    "name": "WeKeep Pay",
                                    "opening_balance_to_bcy": 2,
                                    "running_balance_to_bcy": 2
                                  },
                                  {
                                    "code": "200",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_mGxqm6DGYawUDxCVbCwQMj",
                                    "label": "200 ANB primary account",
                                    "metadata": {
                                      "accounts": [
                                        "acc_mGxqm6DGYawUDxCVbCwQMj"
                                      ]
                                    },
                                    "name": "ANB primary account",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "201",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_FArVKzz4EzrAMzckyg4MUk",
                                    "label": "201 HSBC Payments Test",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FArVKzz4EzrAMzckyg4MUk"
                                      ]
                                    },
                                    "name": "HSBC Payments Test",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  }
                                ],
                                "group": "CASH_EQUIVALENTS",
                                "id": "CASH_EQUIVALENTS",
                                "label": "Cash and Cash Equivalents",
                                "metadata": {
                                  "sub_classification": [
                                    "CASH_EQUIVALENTS"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_cash_equivalents",
                                  "label": "Total Cash and Cash Equivalents",
                                  "metadata": {},
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": 8725512.25,
                                    "running_balance_to_bcy": 8725512.25
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "107",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_8NiyEAPXoBds3r2pQu9nUv",
                                    "label": "107 Accumulated depreciation",
                                    "metadata": {
                                      "accounts": [
                                        "acc_8NiyEAPXoBds3r2pQu9nUv"
                                      ]
                                    },
                                    "name": "Accumulated depreciation",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "131",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_fFWSgQxcuRdYcYWYa8wXiJ",
                                    "label": "131 Laptops",
                                    "metadata": {
                                      "accounts": [
                                        "acc_fFWSgQxcuRdYcYWYa8wXiJ"
                                      ]
                                    },
                                    "name": "Laptops",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "132",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_KXuAt99tagheSXSmmrd8uq",
                                    "label": "132 Accumulated Depreciation",
                                    "metadata": {
                                      "accounts": [
                                        "acc_KXuAt99tagheSXSmmrd8uq"
                                      ]
                                    },
                                    "name": "Accumulated Depreciation",
                                    "opening_balance_to_bcy": -89180,
                                    "running_balance_to_bcy": -89180
                                  }
                                ],
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -89180,
                                    "running_balance_to_bcy": -89180
                                  }
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
                              "sub_totals": {
                                "credit_to_bcy": 0,
                                "debit_to_bcy": 0,
                                "opening_balance_to_bcy": 9041626.49,
                                "running_balance_to_bcy": 9041626.49
                              }
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "code": "201",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_ACFNYGsDvhvRXjxdvjhWEE",
                                    "label": "201 Accounts Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_ACFNYGsDvhvRXjxdvjhWEE"
                                      ]
                                    },
                                    "name": "Accounts Payable",
                                    "opening_balance_to_bcy": -1623.43,
                                    "running_balance_to_bcy": -1623.43
                                  },
                                  {
                                    "code": "202",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_kVVs6iapCZ3WHE2k2NjCS3",
                                    "label": "202 Unearned Revenue",
                                    "metadata": {
                                      "accounts": [
                                        "acc_kVVs6iapCZ3WHE2k2NjCS3"
                                      ]
                                    },
                                    "name": "Unearned Revenue",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "203",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_KK9RK2xQKt7o29q62dNYzs",
                                    "label": "203 Opening Balance Adjustments",
                                    "metadata": {
                                      "accounts": [
                                        "acc_KK9RK2xQKt7o29q62dNYzs"
                                      ]
                                    },
                                    "name": "Opening Balance Adjustments",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "204",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_kDyy2BkrsJpH4PfqvTkN4W",
                                    "label": "204 Payroll Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_kDyy2BkrsJpH4PfqvTkN4W"
                                      ]
                                    },
                                    "name": "Payroll Payable",
                                    "opening_balance_to_bcy": -65005.17,
                                    "running_balance_to_bcy": -65005.17
                                  },
                                  {
                                    "code": "205",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_o9dxNPTUZqLX7Fi7ZYJrar",
                                    "label": "205 Tag Adjustments",
                                    "metadata": {
                                      "accounts": [
                                        "acc_o9dxNPTUZqLX7Fi7ZYJrar"
                                      ]
                                    },
                                    "name": "Tag Adjustments",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "206",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_HJB4ogyCYHpu2rSA8kMwTW",
                                    "label": "206 Loan from Owner",
                                    "metadata": {
                                      "accounts": [
                                        "acc_HJB4ogyCYHpu2rSA8kMwTW"
                                      ]
                                    },
                                    "name": "Loan from Owner",
                                    "opening_balance_to_bcy": 533.5,
                                    "running_balance_to_bcy": 533.5
                                  },
                                  {
                                    "code": "207",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_axL7uGuhKZhmunEGumUCwb",
                                    "label": "207 Employee Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_axL7uGuhKZhmunEGumUCwb"
                                      ]
                                    },
                                    "name": "Employee Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "208",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_7bxFxKA9fGx32pFuTGb8iq",
                                    "label": "208 VAT",
                                    "metadata": {
                                      "accounts": [
                                        "acc_7bxFxKA9fGx32pFuTGb8iq"
                                      ]
                                    },
                                    "name": "VAT",
                                    "opening_balance_to_bcy": -18797.11,
                                    "running_balance_to_bcy": -18797.11
                                  },
                                  {
                                    "code": "209",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_KWcTjn2hJjhyu5u3ZV4XLM",
                                    "label": "209 Excise Tax Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_KWcTjn2hJjhyu5u3ZV4XLM"
                                      ]
                                    },
                                    "name": "Excise Tax Payable",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "210",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_SSZ97xMX9ZM66XmhgPKFMX",
                                    "label": "210 VAT Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_SSZ97xMX9ZM66XmhgPKFMX"
                                      ]
                                    },
                                    "name": "VAT Payable",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_kC6Kvxwp958hTRJXzVhJn9",
                                    "label": "211 Credit Card 7228",
                                    "metadata": {
                                      "accounts": [
                                        "acc_kC6Kvxwp958hTRJXzVhJn9"
                                      ]
                                    },
                                    "name": "Credit Card 7228",
                                    "opening_balance_to_bcy": -210,
                                    "running_balance_to_bcy": -210
                                  },
                                  {
                                    "code": "280",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_AhPQJ8RJE2WXMNgfFuboHZ",
                                    "label": "280 Rounding",
                                    "metadata": {
                                      "accounts": [
                                        "acc_AhPQJ8RJE2WXMNgfFuboHZ"
                                      ]
                                    },
                                    "name": "Rounding",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_md8UFnAxg9EYyBGSJRmeSA",
                                    "label": " Alex W. Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_md8UFnAxg9EYyBGSJRmeSA"
                                      ]
                                    },
                                    "name": "Alex W. Reimbursements",
                                    "opening_balance_to_bcy": 44224.08,
                                    "running_balance_to_bcy": 44224.08
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_hS6r4zz9XsExkthh8TSLWN",
                                    "label": " Valerie P. Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_hS6r4zz9XsExkthh8TSLWN"
                                      ]
                                    },
                                    "name": "Valerie P. Reimbursements",
                                    "opening_balance_to_bcy": -0.01,
                                    "running_balance_to_bcy": -0.01
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Wk6Radp9X4Q5DXJ5i7wWv8",
                                    "label": " H.A Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Wk6Radp9X4Q5DXJ5i7wWv8"
                                      ]
                                    },
                                    "name": "H.A Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_NbWyGRLu3RnhLuxbTt2b8a",
                                    "label": " H.A Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_NbWyGRLu3RnhLuxbTt2b8a"
                                      ]
                                    },
                                    "name": "H.A Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_EsN3SDPQHzKmsandTmrtAn",
                                    "label": " Abdul S. Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_EsN3SDPQHzKmsandTmrtAn"
                                      ]
                                    },
                                    "name": "Abdul S. Reimbursements",
                                    "opening_balance_to_bcy": -59778.05,
                                    "running_balance_to_bcy": -59778.05
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_gexixVAKc8AG5vHXMRhJMa",
                                    "label": " Dany B. Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_gexixVAKc8AG5vHXMRhJMa"
                                      ]
                                    },
                                    "name": "Dany B. Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_En4FTzTstnpUUxWJoEr4Xm",
                                    "label": " Goncharova Yuliya Aleksandrov Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_En4FTzTstnpUUxWJoEr4Xm"
                                      ]
                                    },
                                    "name": "Goncharova Yuliya Aleksandrov Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_5QnAhyoz8K3z7yvXkkFdhk",
                                    "label": " Zain A. Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_5QnAhyoz8K3z7yvXkkFdhk"
                                      ]
                                    },
                                    "name": "Zain A. Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_79azKAjwEvubdtfSZAC2zR",
                                    "label": " Nadz Employeexx Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_79azKAjwEvubdtfSZAC2zR"
                                      ]
                                    },
                                    "name": "Nadz Employeexx Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_WNqCknNnpFrQyKCWbLNz4W",
                                    "label": "211 Daniil Barkalov Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_WNqCknNnpFrQyKCWbLNz4W"
                                      ]
                                    },
                                    "name": "Daniil Barkalov Reimbursements",
                                    "opening_balance_to_bcy": 100,
                                    "running_balance_to_bcy": 100
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_X5zoutijscQzjUzpVhA6we",
                                    "label": "211 Hosam Arab Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_X5zoutijscQzjUzpVhA6we"
                                      ]
                                    },
                                    "name": "Hosam Arab Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_oEyXZZ63fYYMwUYSH9WtL4",
                                    "label": "211 Nadzimo Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_oEyXZZ63fYYMwUYSH9WtL4"
                                      ]
                                    },
                                    "name": "Nadzimo Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_6KuQt3vmr8L9kEZ32zxg3S",
                                    "label": "211 Pessa Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_6KuQt3vmr8L9kEZ32zxg3S"
                                      ]
                                    },
                                    "name": "Pessa Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_UgjrDFMCt4G5Yq5oM8D4Bg",
                                    "label": "211 Don Pablito Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_UgjrDFMCt4G5Yq5oM8D4Bg"
                                      ]
                                    },
                                    "name": "Don Pablito Reimbursements",
                                    "opening_balance_to_bcy": 7,
                                    "running_balance_to_bcy": 7
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_fEBqhVTjp2V8B6he37RDVj",
                                    "label": "211 Boochie Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_fEBqhVTjp2V8B6he37RDVj"
                                      ]
                                    },
                                    "name": "Boochie Reimbursements",
                                    "opening_balance_to_bcy": 4079.77,
                                    "running_balance_to_bcy": 4079.77
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_HQ3EnVNZhKZCxj7az9q2g4",
                                    "label": "211 asdasd Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_HQ3EnVNZhKZCxj7az9q2g4"
                                      ]
                                    },
                                    "name": "asdasd Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_RnMxoYWG7rjABLmYjY6tpc",
                                    "label": "211 azzzzzz Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_RnMxoYWG7rjABLmYjY6tpc"
                                      ]
                                    },
                                    "name": "azzzzzz Reimbursements",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_LCbV9eBQbZczb2ocYNS5Xa",
                                    "label": "211 Nadim Alameddine Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_LCbV9eBQbZczb2ocYNS5Xa"
                                      ]
                                    },
                                    "name": "Nadim Alameddine Reimbursements",
                                    "opening_balance_to_bcy": -1023,
                                    "running_balance_to_bcy": -1023
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -97492.42,
                                    "running_balance_to_bcy": -97492.42
                                  }
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
                              "sub_totals": {
                                "credit_to_bcy": 0,
                                "debit_to_bcy": 0,
                                "opening_balance_to_bcy": -97492.42,
                                "running_balance_to_bcy": -97492.42
                              }
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "code": "301",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_XNsveGWLXmuZXJ7VmXmzUV",
                                    "label": "301 Retained Earnings",
                                    "metadata": {
                                      "accounts": [
                                        "acc_XNsveGWLXmuZXJ7VmXmzUV"
                                      ]
                                    },
                                    "name": "Retained Earnings",
                                    "opening_balance_to_bcy": -8852867.21,
                                    "running_balance_to_bcy": -8852867.21
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -8852867.21,
                                    "running_balance_to_bcy": -8852867.21
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "302",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_FR5vCbAJdDG6CLMGECFWSa",
                                    "label": "302 Owner's Equity",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FR5vCbAJdDG6CLMGECFWSa"
                                      ]
                                    },
                                    "name": "Owner's Equity",
                                    "opening_balance_to_bcy": -91266.86,
                                    "running_balance_to_bcy": -91266.86
                                  },
                                  {
                                    "code": "305",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_NoA3S33x4sV2LZSkAzbmb5",
                                    "label": "305 Drawings",
                                    "metadata": {
                                      "accounts": [
                                        "acc_NoA3S33x4sV2LZSkAzbmb5"
                                      ]
                                    },
                                    "name": "Drawings",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -91266.86,
                                    "running_balance_to_bcy": -91266.86
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "303",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Y9dXBVyPALvN9s35XuMJKF",
                                    "label": "303 Opening Balance Offset",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Y9dXBVyPALvN9s35XuMJKF"
                                      ]
                                    },
                                    "name": "Opening Balance Offset",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  }
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
                              "sub_totals": {
                                "credit_to_bcy": 0,
                                "debit_to_bcy": 0,
                                "opening_balance_to_bcy": -8944134.07,
                                "running_balance_to_bcy": -8944134.07
                              }
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "code": "401",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_4WzaocwWcbtw3YzjaAswRk",
                                    "label": "401 Other Charges",
                                    "metadata": {
                                      "accounts": [
                                        "acc_4WzaocwWcbtw3YzjaAswRk"
                                      ]
                                    },
                                    "name": "Other Charges",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "402",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_h2Pd7VB2F8Kw2NYSEQiiU4",
                                    "label": "402 Sales",
                                    "metadata": {
                                      "accounts": [
                                        "acc_h2Pd7VB2F8Kw2NYSEQiiU4"
                                      ]
                                    },
                                    "name": "Sales",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "403",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_63QPKGtE9wDaB6QScoggBK",
                                    "label": "403 General Income",
                                    "metadata": {
                                      "accounts": [
                                        "acc_63QPKGtE9wDaB6QScoggBK"
                                      ]
                                    },
                                    "name": "General Income",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "404",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_oLa8MKxJMsJBZz67eK8D2d",
                                    "label": "404 Interest Income",
                                    "metadata": {
                                      "accounts": [
                                        "acc_oLa8MKxJMsJBZz67eK8D2d"
                                      ]
                                    },
                                    "name": "Interest Income",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "405",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Z9RiVEMKpw6odrkupFu9Qc",
                                    "label": "405 Late Fee Income",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Z9RiVEMKpw6odrkupFu9Qc"
                                      ]
                                    },
                                    "name": "Late Fee Income",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "407",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_4cjVDdMJ3c3TyEk3e2zz9W",
                                    "label": "407 Shipping Charge",
                                    "metadata": {
                                      "accounts": [
                                        "acc_4cjVDdMJ3c3TyEk3e2zz9W"
                                      ]
                                    },
                                    "name": "Shipping Charge",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "410",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_iMJReJwbdT7QQEceT2vo2i",
                                    "label": "410 Discount",
                                    "metadata": {
                                      "accounts": [
                                        "acc_iMJReJwbdT7QQEceT2vo2i"
                                      ]
                                    },
                                    "name": "Discount",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "411",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_UfZzgSo69b3Hg3NtJ23Nh4",
                                    "label": "411 Test discount",
                                    "metadata": {
                                      "accounts": [
                                        "acc_UfZzgSo69b3Hg3NtJ23Nh4"
                                      ]
                                    },
                                    "name": "Test discount",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_mwoBDxVdmtCRMpidEVJpmJ",
                                    "label": " Test",
                                    "metadata": {
                                      "accounts": [
                                        "acc_mwoBDxVdmtCRMpidEVJpmJ"
                                      ]
                                    },
                                    "name": "Test",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  }
                                ],
                                "group": "INCOME",
                                "id": "INCOME",
                                "label": "Income",
                                "metadata": {
                                  "sub_classification": [
                                    "INCOME"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_income",
                                  "label": "Total Income",
                                  "metadata": {},
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  }
                                }
                              }
                            ],
                            "group": "REVENUE",
                            "id": "REVENUE",
                            "label": "Revenue",
                            "metadata": {
                              "classification": [
                                "REVENUE"
                              ]
                            },
                            "summary": {
                              "id": "summary_revenue",
                              "label": "Total Revenue",
                              "metadata": {},
                              "sub_totals": {
                                "credit_to_bcy": 0,
                                "debit_to_bcy": 0,
                                "opening_balance_to_bcy": 0,
                                "running_balance_to_bcy": 0
                              }
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "code": "406",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_aBtxRBJHyNiD2TktCaZXaB",
                                    "label": "406 Office Supplies",
                                    "metadata": {
                                      "accounts": [
                                        "acc_aBtxRBJHyNiD2TktCaZXaB"
                                      ]
                                    },
                                    "name": "Office Supplies",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "601",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_KaXf4htwscb5FStwpVKRr3",
                                    "label": "601 Lodging",
                                    "metadata": {
                                      "accounts": [
                                        "acc_KaXf4htwscb5FStwpVKRr3"
                                      ]
                                    },
                                    "name": "Lodging",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "602",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_GrCJLmLmLfh6jTgQMeKNeP",
                                    "label": "602 Advertising And Marketing",
                                    "metadata": {
                                      "accounts": [
                                        "acc_GrCJLmLmLfh6jTgQMeKNeP"
                                      ]
                                    },
                                    "name": "Advertising And Marketing",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "603",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Q7HFtAvrf8No4kkUyxFMwZ",
                                    "label": "603 Bank Fees and Charges",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Q7HFtAvrf8No4kkUyxFMwZ"
                                      ]
                                    },
                                    "name": "Bank Fees and Charges",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "604",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_hiCkWjFdvthG4CffCtKYwb",
                                    "label": "604 Credit Card Charges",
                                    "metadata": {
                                      "accounts": [
                                        "acc_hiCkWjFdvthG4CffCtKYwb"
                                      ]
                                    },
                                    "name": "Credit Card Charges",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "606",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_TNR2VUNoWnip7Ng9w9zSRk",
                                    "label": "606 Travel Expense",
                                    "metadata": {
                                      "accounts": [
                                        "acc_TNR2VUNoWnip7Ng9w9zSRk"
                                      ]
                                    },
                                    "name": "Travel Expense",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "607",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_e5MarTHV3vV7XcyYV4nPZJ",
                                    "label": "607 Telephone Expense",
                                    "metadata": {
                                      "accounts": [
                                        "acc_e5MarTHV3vV7XcyYV4nPZJ"
                                      ]
                                    },
                                    "name": "Telephone Expense",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "608",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_cmFMXRfvvDLKmakeQu3bet",
                                    "label": "608 Automobile Expense",
                                    "metadata": {
                                      "accounts": [
                                        "acc_cmFMXRfvvDLKmakeQu3bet"
                                      ]
                                    },
                                    "name": "Automobile Expense",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "609",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_g4qxzLQ7d7uvnsSxkj3zsz",
                                    "label": "609 IT and Internet Expenses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_g4qxzLQ7d7uvnsSxkj3zsz"
                                      ]
                                    },
                                    "name": "IT and Internet Expenses",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "610",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_C6GWTGPBR4McXVXqGoStS9",
                                    "label": "610 Rent Expense",
                                    "metadata": {
                                      "accounts": [
                                        "acc_C6GWTGPBR4McXVXqGoStS9"
                                      ]
                                    },
                                    "name": "Rent Expense",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "611",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_U3USxmqZcTGPDUu54K5JQM",
                                    "label": "611 Janitorial Expense",
                                    "metadata": {
                                      "accounts": [
                                        "acc_U3USxmqZcTGPDUu54K5JQM"
                                      ]
                                    },
                                    "name": "Janitorial Expense",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "612",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Gb72t28K4aHyMXExu6E7bw",
                                    "label": "612 Postage",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Gb72t28K4aHyMXExu6E7bw"
                                      ]
                                    },
                                    "name": "Postage",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "613",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_mGKZGbxApPfNYnWUoHiT2n",
                                    "label": "613 Bad Debt",
                                    "metadata": {
                                      "accounts": [
                                        "acc_mGKZGbxApPfNYnWUoHiT2n"
                                      ]
                                    },
                                    "name": "Bad Debt",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "614",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_5Ynf4bwedRPshJsYb8fy2G",
                                    "label": "614 Printing and Stationery",
                                    "metadata": {
                                      "accounts": [
                                        "acc_5Ynf4bwedRPshJsYb8fy2G"
                                      ]
                                    },
                                    "name": "Printing and Stationery",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "615",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_E8JxvTVpSYFcuAUJhTnWKK",
                                    "label": "615 Salaries and Employee Wages",
                                    "metadata": {
                                      "accounts": [
                                        "acc_E8JxvTVpSYFcuAUJhTnWKK"
                                      ]
                                    },
                                    "name": "Salaries and Employee Wages",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "617",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_AaTTkgWgcNzJfR6Xr5YYP2",
                                    "label": "617 Meals and Entertainment",
                                    "metadata": {
                                      "accounts": [
                                        "acc_AaTTkgWgcNzJfR6Xr5YYP2"
                                      ]
                                    },
                                    "name": "Meals and Entertainment",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "619",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_AzESuzs88uaaY2oont8gq5",
                                    "label": "619 Consultant Expense",
                                    "metadata": {
                                      "accounts": [
                                        "acc_AzESuzs88uaaY2oont8gq5"
                                      ]
                                    },
                                    "name": "Consultant Expense",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "620",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_EkRcU7DLAM9GXiQsuzgb3K",
                                    "label": "620 Repairs and Maintenance",
                                    "metadata": {
                                      "accounts": [
                                        "acc_EkRcU7DLAM9GXiQsuzgb3K"
                                      ]
                                    },
                                    "name": "Repairs and Maintenance",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "621",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_4m3yEHEvfDZ3B7eq9pj6b6",
                                    "label": "621 Refund expense",
                                    "metadata": {
                                      "accounts": [
                                        "acc_4m3yEHEvfDZ3B7eq9pj6b6"
                                      ]
                                    },
                                    "name": "Refund expense",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "621",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_g6jmxHYdLnavwM2LYRxRDb",
                                    "label": "621 qweqwe1",
                                    "metadata": {
                                      "accounts": [
                                        "acc_g6jmxHYdLnavwM2LYRxRDb"
                                      ]
                                    },
                                    "name": "qweqwe1",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "621",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_MprPxUNZN4frBqFsP63g4t",
                                    "label": "621 Unknown expenses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_MprPxUNZN4frBqFsP63g4t"
                                      ]
                                    },
                                    "name": "Unknown expenses",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "621",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_L4rGigKki2geUVcXypcfgv",
                                    "label": "621 Random expense",
                                    "metadata": {
                                      "accounts": [
                                        "acc_L4rGigKki2geUVcXypcfgv"
                                      ]
                                    },
                                    "name": "Random expense",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "621",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_ELwxXyqVt8dUkHR8Cq5P9Y",
                                    "label": "621 Legal Fees",
                                    "metadata": {
                                      "accounts": [
                                        "acc_ELwxXyqVt8dUkHR8Cq5P9Y"
                                      ]
                                    },
                                    "name": "Legal Fees",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "621",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_XygGFUNNnodu9KHFazptqt",
                                    "label": "621 Technology Infrastructure",
                                    "metadata": {
                                      "accounts": [
                                        "acc_XygGFUNNnodu9KHFazptqt"
                                      ]
                                    },
                                    "name": "Technology Infrastructure",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "621",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_UamHTWcQ9d776fj4uZGQJP",
                                    "label": "621 Other Employee Expenses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_UamHTWcQ9d776fj4uZGQJP"
                                      ]
                                    },
                                    "name": "Other Employee Expenses",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "621",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_CC6QBCsijoKfuFN3cSY7JM",
                                    "label": "621 Data Sources",
                                    "metadata": {
                                      "accounts": [
                                        "acc_CC6QBCsijoKfuFN3cSY7JM"
                                      ]
                                    },
                                    "name": "Data Sources",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "621",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_g4kWKAUF7KZViqufHGHQnU",
                                    "label": "621 Research",
                                    "metadata": {
                                      "accounts": [
                                        "acc_g4kWKAUF7KZViqufHGHQnU"
                                      ]
                                    },
                                    "name": "Research",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "621",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_ERTfJB43deJAz6CEuUJCMB",
                                    "label": "621 Software and Tools",
                                    "metadata": {
                                      "accounts": [
                                        "acc_ERTfJB43deJAz6CEuUJCMB"
                                      ]
                                    },
                                    "name": "Software and Tools",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Ap8Ke5YeL2iiNE73jGWRq5",
                                    "label": " wrong cogs account",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Ap8Ke5YeL2iiNE73jGWRq5"
                                      ]
                                    },
                                    "name": "wrong cogs account",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_GpMTseDKJZX3HXFZ2tLLdJ",
                                    "label": " New account",
                                    "metadata": {
                                      "accounts": [
                                        "acc_GpMTseDKJZX3HXFZ2tLLdJ"
                                      ]
                                    },
                                    "name": "New account",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  }
                                ],
                                "group": "OPERATING_EXPENSE",
                                "id": "OPERATING_EXPENSE",
                                "label": "Operating Expenses",
                                "metadata": {
                                  "sub_classification": [
                                    "OPERATING_EXPENSE"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_operating_expense",
                                  "label": "Total Operating Expenses",
                                  "metadata": {},
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "500",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Vs6vTrgV7vd3c3j7SwQfAV",
                                    "label": "500 Cost of Goods Sold",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Vs6vTrgV7vd3c3j7SwQfAV"
                                      ]
                                    },
                                    "name": "Cost of Goods Sold",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  }
                                ],
                                "group": "COGS",
                                "id": "COGS",
                                "label": "Cost of Sales",
                                "metadata": {
                                  "sub_classification": [
                                    "COGS"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_cogs",
                                  "label": "Total Cost of Sales",
                                  "metadata": {},
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "605",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_iAfbX73V7kVCQB2qQPwJuC",
                                    "label": "605 Exchange Gain or Loss",
                                    "metadata": {
                                      "accounts": [
                                        "acc_iAfbX73V7kVCQB2qQPwJuC"
                                      ]
                                    },
                                    "name": "Exchange Gain or Loss",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "616",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_S6Ef4zrULfRpNPwzAjbZ84",
                                    "label": "616 Uncategorized",
                                    "metadata": {
                                      "accounts": [
                                        "acc_S6Ef4zrULfRpNPwzAjbZ84"
                                      ]
                                    },
                                    "name": "Uncategorized",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "618",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_VGxn74ryQbpBJrpw8yxfe3",
                                    "label": "618 Depreciation Expense",
                                    "metadata": {
                                      "accounts": [
                                        "acc_VGxn74ryQbpBJrpw8yxfe3"
                                      ]
                                    },
                                    "name": "Depreciation Expense",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  },
                                  {
                                    "code": "621",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_73p88sJjahuYoay6yf6azg",
                                    "label": "621 Other Expenses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_73p88sJjahuYoay6yf6azg"
                                      ]
                                    },
                                    "name": "Other Expenses",
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  }
                                ],
                                "group": "NON_OPERATING_EXPENSE",
                                "id": "NON_OPERATING_EXPENSE",
                                "label": "Non-Operating Expenses",
                                "metadata": {
                                  "sub_classification": [
                                    "NON_OPERATING_EXPENSE"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_non_operating_expense",
                                  "label": "Total Non-Operating Expenses",
                                  "metadata": {},
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": 0,
                                    "running_balance_to_bcy": 0
                                  }
                                }
                              }
                            ],
                            "group": "EXPENSE",
                            "id": "EXPENSE",
                            "label": "Expense",
                            "metadata": {
                              "classification": [
                                "EXPENSE"
                              ]
                            },
                            "summary": {
                              "id": "summary_expense",
                              "label": "Total Expense",
                              "metadata": {},
                              "sub_totals": {
                                "credit_to_bcy": 0,
                                "debit_to_bcy": 0,
                                "opening_balance_to_bcy": 0,
                                "running_balance_to_bcy": 0
                              }
                            }
                          }
                        ],
                        "summary": {
                          "id": "totals",
                          "label": "Totals",
                          "metadata": {},
                          "totals": {
                            "credit_to_bcy": 0,
                            "debit_to_bcy": 0,
                            "opening_balance_to_bcy": 0,
                            "running_balance_to_bcy": 0
                          }
                        }
                      }
                    ]
                  },
                  "WithPnlOpenings": {
                    "description": "Report includes PNL openings",
                    "summary": "With PNL openings",
                    "value": [
                      {
                        "overview": {
                          "count": 24,
                          "created_ts": "2025-05-06T14:13:21.153609Z",
                          "filters": {},
                          "from_date": "2025-01-01",
                          "id": "trial_balance",
                          "include_zero_balances": false,
                          "label": "Trial Balance Report",
                          "to_date": "2025-05-06",
                          "with_pnl_openings": true
                        },
                        "rows": [
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "code": "101",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Q6aUYP5bThNnEvRWq86jG6",
                                    "label": "101 Accounts Receivable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Q6aUYP5bThNnEvRWq86jG6"
                                      ]
                                    },
                                    "name": "Accounts Receivable",
                                    "opening_balance_to_bcy": 303404.87,
                                    "running_balance_to_bcy": 303404.87
                                  },
                                  {
                                    "code": "106",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_hVBXZk8gA46NHGdauXDvuG",
                                    "label": "106 Prepaid Expenses",
                                    "metadata": {
                                      "accounts": [
                                        "acc_hVBXZk8gA46NHGdauXDvuG"
                                      ]
                                    },
                                    "name": "Prepaid Expenses",
                                    "opening_balance_to_bcy": -4000,
                                    "running_balance_to_bcy": -4000
                                  },
                                  {
                                    "code": "108",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_GS2kVL2ELznQfhsspxMxsF",
                                    "label": "108 Loan receivable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_GS2kVL2ELznQfhsspxMxsF"
                                      ]
                                    },
                                    "name": "Loan receivable",
                                    "opening_balance_to_bcy": 14764.08,
                                    "running_balance_to_bcy": 14764.08
                                  },
                                  {
                                    "code": "108",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_EA8Jj3q9eiSyb4rKehjyhL",
                                    "label": "108 ENBD account *3202",
                                    "metadata": {
                                      "accounts": [
                                        "acc_EA8Jj3q9eiSyb4rKehjyhL"
                                      ]
                                    },
                                    "name": "ENBD account *3202",
                                    "opening_balance_to_bcy": 90755.12,
                                    "running_balance_to_bcy": 90755.12
                                  },
                                  {
                                    "code": "304",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_NCXhgdtrda6WSUDvS7peFJ",
                                    "label": "304 Inventory Asset",
                                    "metadata": {
                                      "accounts": [
                                        "acc_NCXhgdtrda6WSUDvS7peFJ"
                                      ]
                                    },
                                    "name": "Inventory Asset",
                                    "opening_balance_to_bcy": 370.17,
                                    "running_balance_to_bcy": 370.17
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": 405294.24,
                                    "running_balance_to_bcy": 405294.24
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "105",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_78bQwooJVx9sA7VogHMQyT",
                                    "label": "105 Bank Account",
                                    "metadata": {
                                      "accounts": [
                                        "acc_78bQwooJVx9sA7VogHMQyT"
                                      ]
                                    },
                                    "name": "Bank Account",
                                    "opening_balance_to_bcy": 92823.78,
                                    "running_balance_to_bcy": 92823.78
                                  },
                                  {
                                    "code": "108",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_JXJPgQh2nigjR4YSrFnKcp",
                                    "label": "108 ENBD account xxxxxxxxxxxxx*3201 AED",
                                    "metadata": {
                                      "accounts": [
                                        "acc_JXJPgQh2nigjR4YSrFnKcp"
                                      ]
                                    },
                                    "name": "ENBD account xxxxxxxxxxxxx*3201 AED",
                                    "opening_balance_to_bcy": 8643770.63,
                                    "running_balance_to_bcy": 8643770.63
                                  },
                                  {
                                    "code": "109",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_Kb7DCXLUQpKAuCMyaT5PUL",
                                    "label": "109 SABB SAR",
                                    "metadata": {
                                      "accounts": [
                                        "acc_Kb7DCXLUQpKAuCMyaT5PUL"
                                      ]
                                    },
                                    "name": "SABB SAR",
                                    "opening_balance_to_bcy": -11084.16,
                                    "running_balance_to_bcy": -11084.16
                                  },
                                  {
                                    "code": "199",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_TRBH3h6DGGyje7v2UaZesc",
                                    "label": "199 WeKeep Pay",
                                    "metadata": {
                                      "accounts": [
                                        "acc_TRBH3h6DGGyje7v2UaZesc"
                                      ]
                                    },
                                    "name": "WeKeep Pay",
                                    "opening_balance_to_bcy": 2,
                                    "running_balance_to_bcy": 2
                                  }
                                ],
                                "group": "CASH_EQUIVALENTS",
                                "id": "CASH_EQUIVALENTS",
                                "label": "Cash and Cash Equivalents",
                                "metadata": {
                                  "sub_classification": [
                                    "CASH_EQUIVALENTS"
                                  ]
                                },
                                "summary": {
                                  "id": "summary_cash_equivalents",
                                  "label": "Total Cash and Cash Equivalents",
                                  "metadata": {},
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": 8725512.25,
                                    "running_balance_to_bcy": 8725512.25
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "132",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_KXuAt99tagheSXSmmrd8uq",
                                    "label": "132 Accumulated Depreciation",
                                    "metadata": {
                                      "accounts": [
                                        "acc_KXuAt99tagheSXSmmrd8uq"
                                      ]
                                    },
                                    "name": "Accumulated Depreciation",
                                    "opening_balance_to_bcy": -89180,
                                    "running_balance_to_bcy": -89180
                                  }
                                ],
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -89180,
                                    "running_balance_to_bcy": -89180
                                  }
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
                              "sub_totals": {
                                "credit_to_bcy": 0,
                                "debit_to_bcy": 0,
                                "opening_balance_to_bcy": 9041626.49,
                                "running_balance_to_bcy": 9041626.49
                              }
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "code": "201",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_ACFNYGsDvhvRXjxdvjhWEE",
                                    "label": "201 Accounts Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_ACFNYGsDvhvRXjxdvjhWEE"
                                      ]
                                    },
                                    "name": "Accounts Payable",
                                    "opening_balance_to_bcy": -1623.43,
                                    "running_balance_to_bcy": -1623.43
                                  },
                                  {
                                    "code": "204",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_kDyy2BkrsJpH4PfqvTkN4W",
                                    "label": "204 Payroll Payable",
                                    "metadata": {
                                      "accounts": [
                                        "acc_kDyy2BkrsJpH4PfqvTkN4W"
                                      ]
                                    },
                                    "name": "Payroll Payable",
                                    "opening_balance_to_bcy": -65005.17,
                                    "running_balance_to_bcy": -65005.17
                                  },
                                  {
                                    "code": "206",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_HJB4ogyCYHpu2rSA8kMwTW",
                                    "label": "206 Loan from Owner",
                                    "metadata": {
                                      "accounts": [
                                        "acc_HJB4ogyCYHpu2rSA8kMwTW"
                                      ]
                                    },
                                    "name": "Loan from Owner",
                                    "opening_balance_to_bcy": 533.5,
                                    "running_balance_to_bcy": 533.5
                                  },
                                  {
                                    "code": "208",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_7bxFxKA9fGx32pFuTGb8iq",
                                    "label": "208 VAT",
                                    "metadata": {
                                      "accounts": [
                                        "acc_7bxFxKA9fGx32pFuTGb8iq"
                                      ]
                                    },
                                    "name": "VAT",
                                    "opening_balance_to_bcy": -18797.11,
                                    "running_balance_to_bcy": -18797.11
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_kC6Kvxwp958hTRJXzVhJn9",
                                    "label": "211 Credit Card 7228",
                                    "metadata": {
                                      "accounts": [
                                        "acc_kC6Kvxwp958hTRJXzVhJn9"
                                      ]
                                    },
                                    "name": "Credit Card 7228",
                                    "opening_balance_to_bcy": -210,
                                    "running_balance_to_bcy": -210
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_md8UFnAxg9EYyBGSJRmeSA",
                                    "label": " Alex W. Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_md8UFnAxg9EYyBGSJRmeSA"
                                      ]
                                    },
                                    "name": "Alex W. Reimbursements",
                                    "opening_balance_to_bcy": 44224.08,
                                    "running_balance_to_bcy": 44224.08
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_hS6r4zz9XsExkthh8TSLWN",
                                    "label": " Valerie P. Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_hS6r4zz9XsExkthh8TSLWN"
                                      ]
                                    },
                                    "name": "Valerie P. Reimbursements",
                                    "opening_balance_to_bcy": -0.01,
                                    "running_balance_to_bcy": -0.01
                                  },
                                  {
                                    "code": "",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_EsN3SDPQHzKmsandTmrtAn",
                                    "label": " Abdul S. Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_EsN3SDPQHzKmsandTmrtAn"
                                      ]
                                    },
                                    "name": "Abdul S. Reimbursements",
                                    "opening_balance_to_bcy": -59778.05,
                                    "running_balance_to_bcy": -59778.05
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_WNqCknNnpFrQyKCWbLNz4W",
                                    "label": "211 Daniil Barkalov Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_WNqCknNnpFrQyKCWbLNz4W"
                                      ]
                                    },
                                    "name": "Daniil Barkalov Reimbursements",
                                    "opening_balance_to_bcy": 100,
                                    "running_balance_to_bcy": 100
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_UgjrDFMCt4G5Yq5oM8D4Bg",
                                    "label": "211 Don Pablito Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_UgjrDFMCt4G5Yq5oM8D4Bg"
                                      ]
                                    },
                                    "name": "Don Pablito Reimbursements",
                                    "opening_balance_to_bcy": 7,
                                    "running_balance_to_bcy": 7
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_fEBqhVTjp2V8B6he37RDVj",
                                    "label": "211 Boochie Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_fEBqhVTjp2V8B6he37RDVj"
                                      ]
                                    },
                                    "name": "Boochie Reimbursements",
                                    "opening_balance_to_bcy": 4079.77,
                                    "running_balance_to_bcy": 4079.77
                                  },
                                  {
                                    "code": "211",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_LCbV9eBQbZczb2ocYNS5Xa",
                                    "label": "211 Nadim Alameddine Reimbursements",
                                    "metadata": {
                                      "accounts": [
                                        "acc_LCbV9eBQbZczb2ocYNS5Xa"
                                      ]
                                    },
                                    "name": "Nadim Alameddine Reimbursements",
                                    "opening_balance_to_bcy": -1023,
                                    "running_balance_to_bcy": -1023
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -97492.42,
                                    "running_balance_to_bcy": -97492.42
                                  }
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
                              "sub_totals": {
                                "credit_to_bcy": 0,
                                "debit_to_bcy": 0,
                                "opening_balance_to_bcy": -97492.42,
                                "running_balance_to_bcy": -97492.42
                              }
                            }
                          },
                          {
                            "children": [
                              {
                                "children": [
                                  {
                                    "code": "301",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_XNsveGWLXmuZXJ7VmXmzUV",
                                    "label": "301 Retained Earnings",
                                    "metadata": {
                                      "accounts": [
                                        "acc_XNsveGWLXmuZXJ7VmXmzUV"
                                      ]
                                    },
                                    "name": "Retained Earnings",
                                    "opening_balance_to_bcy": -8852867.21,
                                    "running_balance_to_bcy": -8852867.21
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -8852867.21,
                                    "running_balance_to_bcy": -8852867.21
                                  }
                                }
                              },
                              {
                                "children": [
                                  {
                                    "code": "302",
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "id": "acc_FR5vCbAJdDG6CLMGECFWSa",
                                    "label": "302 Owner's Equity",
                                    "metadata": {
                                      "accounts": [
                                        "acc_FR5vCbAJdDG6CLMGECFWSa"
                                      ]
                                    },
                                    "name": "Owner's Equity",
                                    "opening_balance_to_bcy": -91266.86,
                                    "running_balance_to_bcy": -91266.86
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
                                  "sub_totals": {
                                    "credit_to_bcy": 0,
                                    "debit_to_bcy": 0,
                                    "opening_balance_to_bcy": -91266.86,
                                    "running_balance_to_bcy": -91266.86
                                  }
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
                              "sub_totals": {
                                "credit_to_bcy": 0,
                                "debit_to_bcy": 0,
                                "opening_balance_to_bcy": -8944134.07,
                                "running_balance_to_bcy": -8944134.07
                              }
                            }
                          }
                        ],
                        "summary": {
                          "id": "totals",
                          "label": "Totals",
                          "metadata": {},
                          "totals": {
                            "credit_to_bcy": 0,
                            "debit_to_bcy": 0,
                            "opening_balance_to_bcy": 0,
                            "running_balance_to_bcy": 0
                          }
                        }
                      }
                    ]
                  }
                },
                "schema": {
                  "items": {
                    "$ref": "#/components/schemas/api-v1-external-reports-trial-balance-grouped-read"
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
        "summary": "Trial Balance\n",
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