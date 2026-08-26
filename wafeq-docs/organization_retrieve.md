---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Retrieve organization

Endpoint for retrieving a single organization.

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
      "CompanyIdentificationSupplierType": {
        "enum": [
          "CRN",
          "MLS",
          "SAG",
          "MOM",
          "700",
          "OTH",
          "TRD"
        ],
        "title": "CompanyIdentificationSupplierType",
        "type": "string"
      },
      "CountryEnum": {
        "description": "* `SA` - Kingdom of Saudi Arabia\n* `AE` - United Arab Emirates\n* `QA` - Qatar\n* `BH` - Bahrain\n* `KW` - Kuwait\n* `OM` - Oman\n* `EG` - Egypt\n* `US` - United States of America\n* `AF` - Afghanistan\n* `AX` - Åland Islands\n* `...`\n\nFull information for [CountryEnum](countryenum)",
        "enum": [
          "SA",
          "AE",
          "QA",
          "BH",
          "KW",
          "OM",
          "EG",
          "US",
          "AF",
          "AX",
          "AL",
          "DZ",
          "AS",
          "AD",
          "AO",
          "AI",
          "AQ",
          "AG",
          "AR",
          "AM",
          "AW",
          "AU",
          "AT",
          "AZ",
          "BS",
          "BD",
          "BB",
          "BY",
          "BE",
          "BZ",
          "BJ",
          "BM",
          "BT",
          "BO",
          "BQ",
          "BA",
          "BW",
          "BV",
          "BR",
          "IO",
          "BN",
          "BG",
          "BF",
          "BI",
          "CV",
          "KH",
          "CM",
          "CA",
          "KY",
          "CF",
          "TD",
          "CL",
          "CN",
          "CX",
          "CC",
          "CO",
          "KM",
          "CG",
          "CK",
          "CR",
          "CI",
          "HR",
          "CU",
          "CW",
          "CY",
          "CZ",
          "CD",
          "DK",
          "DJ",
          "DM",
          "DO",
          "EC",
          "SV",
          "GQ",
          "ER",
          "EE",
          "SZ",
          "ET",
          "FK",
          "FO",
          "FJ",
          "FI",
          "FR",
          "GF",
          "PF",
          "TF",
          "GA",
          "GM",
          "GE",
          "DE",
          "GH",
          "GI",
          "GR",
          "GL",
          "GD",
          "GP",
          "GU",
          "GT",
          "GG",
          "GN",
          "GW",
          "GY",
          "HT",
          "HM",
          "HN",
          "HK",
          "HU",
          "IS",
          "IN",
          "ID",
          "IR",
          "IQ",
          "IE",
          "IM",
          "IL",
          "IT",
          "JM",
          "JP",
          "JE",
          "JO",
          "KZ",
          "KE",
          "KI",
          "KG",
          "LA",
          "LV",
          "LB",
          "LS",
          "LR",
          "LY",
          "LI",
          "LT",
          "LU",
          "MO",
          "MG",
          "MW",
          "MY",
          "MV",
          "ML",
          "MT",
          "MH",
          "MQ",
          "MR",
          "MU",
          "YT",
          "MX",
          "FM",
          "MD",
          "MC",
          "MN",
          "ME",
          "MS",
          "MA",
          "MZ",
          "MM",
          "NA",
          "NR",
          "NP",
          "NL",
          "NC",
          "NZ",
          "NI",
          "NE",
          "NG",
          "NU",
          "NF",
          "KP",
          "MK",
          "MP",
          "NO",
          "PK",
          "PW",
          "PS",
          "PA",
          "PG",
          "PY",
          "PE",
          "PH",
          "PN",
          "PL",
          "PT",
          "PR",
          "RE",
          "RO",
          "RU",
          "RW",
          "BL",
          "SH",
          "KN",
          "LC",
          "MF",
          "PM",
          "VC",
          "WS",
          "SM",
          "ST",
          "SN",
          "RS",
          "SC",
          "SL",
          "SG",
          "SX",
          "SK",
          "SI",
          "SB",
          "SO",
          "ZA",
          "GS",
          "KR",
          "SS",
          "ES",
          "LK",
          "SD",
          "SR",
          "SJ",
          "SE",
          "CH",
          "SY",
          "TW",
          "TJ",
          "TZ",
          "TH",
          "TL",
          "TG",
          "TK",
          "TO",
          "TT",
          "TN",
          "TR",
          "TM",
          "TC",
          "TV",
          "UG",
          "UA",
          "GB",
          "UM",
          "UY",
          "UZ",
          "VU",
          "VA",
          "VE",
          "VN",
          "VG",
          "VI",
          "WF",
          "EH",
          "YE",
          "ZM",
          "ZW"
        ],
        "type": "string"
      },
      "Organization": {
        "properties": {
          "branches": {
            "description": "The list of branches associated with the organization.",
            "items": {
              "$ref": "#/components/schemas/Branch"
            },
            "readOnly": true,
            "type": "array"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the organization was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "financial_settings": {
            "allOf": [
              {
                "$ref": "#/components/schemas/OrganizationFinancialSettings"
              }
            ],
            "description": "The financial settings associated with the organization.",
            "readOnly": true
          },
          "id": {
            "description": "The unique identifier of the organization.",
            "readOnly": true,
            "type": "string"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the organization.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the organization was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "The name of the organization in both languages.",
            "readOnly": true
          },
          "users": {
            "description": "The list of users associated with the organization.",
            "items": {
              "$ref": "#/components/schemas/OrganizationUser"
            },
            "readOnly": true,
            "type": "array"
          },
          "warehouses": {
            "description": "The list of warehouses associated with the organization.",
            "items": {
              "$ref": "#/components/schemas/Warehouse"
            },
            "readOnly": true,
            "type": "array"
          }
        },
        "required": [
          "branches",
          "created_ts",
          "financial_settings",
          "id",
          "legacy_id",
          "modified_ts",
          "name",
          "users",
          "warehouses"
        ],
        "type": "object"
      },
      "OrganizationFinancialSettings": {
        "properties": {
          "address": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "The physical address of the organization in both languages.",
            "readOnly": true
          },
          "base_currency": {
            "maxLength": 3,
            "type": "string"
          },
          "city": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "The city where the organization is located in both languages.",
            "readOnly": true
          },
          "company_identification": {
            "items": {
              "$ref": "#/components/schemas/_CompanyIdentificationSupplierSchema"
            },
            "title": "CompanyIdentificationSupplierSchema",
            "type": "array"
          },
          "country": {
            "allOf": [
              {
                "$ref": "#/components/schemas/CountryEnum"
              }
            ],
            "description": "The country code of the organization's location.\n\n* `SA` - Kingdom of Saudi Arabia\n* `AE` - United Arab Emirates\n* `QA` - Qatar\n* `BH` - Bahrain\n* `KW` - Kuwait\n* `OM` - Oman\n* `EG` - Egypt\n* `US` - United States of America\n* `AF` - Afghanistan\n* `AX` - Åland Islands\n* `AL` - Albania\n* `DZ` - Algeria\n* `AS` - American Samoa\n* `AD` - Andorra\n* `AO` - Angola\n* `AI` - Anguilla\n* `AQ` - Antarctica\n* `AG` - Antigua and Barbuda\n* `AR` - Argentina\n* `AM` - Armenia\n* `AW` - Aruba\n* `AU` - Australia\n* `AT` - Austria\n* `AZ` - Azerbaijan\n* `BS` - Bahamas (The)\n* `BD` - Bangladesh\n* `BB` - Barbados\n* `BY` - Belarus\n* `BE` - Belgium\n* `BZ` - Belize\n* `BJ` - Benin\n* `BM` - Bermuda\n* `BT` - Bhutan\n* `BO` - Bolivia\n* `BQ` - Bonaire, Sint Eustatius and Saba\n* `BA` - Bosnia and Herzegovina\n* `BW` - Botswana\n* `BV` - Bouvet Island\n* `BR` - Brazil\n* `IO` - British Indian Ocean Territory\n* `BN` - Brunei\n* `BG` - Bulgaria\n* `BF` - Burkina Faso\n* `BI` - Burundi\n* `CV` - Cabo Verde\n* `KH` - Cambodia\n* `CM` - Cameroon\n* `CA` - Canada\n* `KY` - Cayman Islands\n* `CF` - Central African Republic\n* `TD` - Chad\n* `CL` - Chile\n* `CN` - China\n* `CX` - Christmas Island\n* `CC` - Cocos (Keeling) Islands\n* `CO` - Colombia\n* `KM` - Comoros\n* `CG` - Congo\n* `CK` - Cook Islands\n* `CR` - Costa Rica\n* `CI` - Côte d'Ivoire\n* `HR` - Croatia\n* `CU` - Cuba\n* `CW` - Curaçao\n* `CY` - Cyprus\n* `CZ` - Czechia\n* `CD` - Democratic Republic of the Congo\n* `DK` - Denmark\n* `DJ` - Djibouti\n* `DM` - Dominica\n* `DO` - Dominican Republic\n* `EC` - Ecuador\n* `SV` - El Salvador\n* `GQ` - Equatorial Guinea\n* `ER` - Eritrea\n* `EE` - Estonia\n* `SZ` - Eswatini\n* `ET` - Ethiopia\n* `FK` - Falkland Islands (Malvinas)\n* `FO` - Faroe Islands\n* `FJ` - Fiji\n* `FI` - Finland\n* `FR` - France\n* `GF` - French Guiana\n* `PF` - French Polynesia\n* `TF` - French Southern Territories\n* `GA` - Gabon\n* `GM` - Gambia\n* `GE` - Georgia\n* `DE` - Germany\n* `GH` - Ghana\n* `GI` - Gibraltar\n* `GR` - Greece\n* `GL` - Greenland\n* `GD` - Grenada\n* `GP` - Guadeloupe\n* `GU` - Guam\n* `GT` - Guatemala\n* `GG` - Guernsey\n* `GN` - Guinea\n* `GW` - Guinea-Bissau\n* `GY` - Guyana\n* `HT` - Haiti\n* `HM` - Heard Island and McDonald Islands\n* `HN` - Honduras\n* `HK` - Hong Kong\n* `HU` - Hungary\n* `IS` - Iceland\n* `IN` - India\n* `ID` - Indonesia\n* `IR` - Iran\n* `IQ` - Iraq\n* `IE` - Ireland\n* `IM` - Isle of Man\n* `IL` - Israel\n* `IT` - Italy\n* `JM` - Jamaica\n* `JP` - Japan\n* `JE` - Jersey\n* `JO` - Jordan\n* `KZ` - Kazakhstan\n* `KE` - Kenya\n* `KI` - Kiribati\n* `KG` - Kyrgyzstan\n* `LA` - Laos\n* `LV` - Latvia\n* `LB` - Lebanon\n* `LS` - Lesotho\n* `LR` - Liberia\n* `LY` - Libya\n* `LI` - Liechtenstein\n* `LT` - Lithuania\n* `LU` - Luxembourg\n* `MO` - Macao\n* `MG` - Madagascar\n* `MW` - Malawi\n* `MY` - Malaysia\n* `MV` - Maldives\n* `ML` - Mali\n* `MT` - Malta\n* `MH` - Marshall Islands\n* `MQ` - Martinique\n* `MR` - Mauritania\n* `MU` - Mauritius\n* `YT` - Mayotte\n* `MX` - Mexico\n* `FM` - Micronesia\n* `MD` - Moldova\n* `MC` - Monaco\n* `MN` - Mongolia\n* `ME` - Montenegro\n* `MS` - Montserrat\n* `MA` - Morocco\n* `MZ` - Mozambique\n* `MM` - Myanmar\n* `NA` - Namibia\n* `NR` - Nauru\n* `NP` - Nepal\n* `NL` - Netherlands\n* `NC` - New Caledonia\n* `NZ` - New Zealand\n* `NI` - Nicaragua\n* `NE` - Niger\n* `NG` - Nigeria\n* `NU` - Niue\n* `NF` - Norfolk Island\n* `KP` - North Korea\n* `MK` - North Macedonia\n* `MP` - Northern Mariana Islands\n* `NO` - Norway\n* `PK` - Pakistan\n* `PW` - Palau\n* `PS` - Palestine\n* `PA` - Panama\n* `PG` - Papua New Guinea\n* `PY` - Paraguay\n* `PE` - Peru\n* `PH` - Philippines\n* `PN` - Pitcairn\n* `PL` - Poland\n* `PT` - Portugal\n* `PR` - Puerto Rico\n* `RE` - Réunion\n* `RO` - Romania\n* `RU` - Russia\n* `RW` - Rwanda\n* `BL` - Saint Barthélemy\n* `SH` - Saint Helena\n* `KN` - Saint Kitts and Nevis\n* `LC` - Saint Lucia\n* `MF` - Saint Martin (French part)\n* `PM` - Saint Pierre and Miquelon\n* `VC` - Saint Vincent and the Grenadines\n* `WS` - Samoa\n* `SM` - San Marino\n* `ST` - Sao Tome and Principe\n* `SN` - Senegal\n* `RS` - Serbia\n* `SC` - Seychelles\n* `SL` - Sierra Leone\n* `SG` - Singapore\n* `SX` - Sint Maarten (Dutch part)\n* `SK` - Slovakia\n* `SI` - Slovenia\n* `SB` - Solomon Islands\n* `SO` - Somalia\n* `ZA` - South Africa\n* `GS` - South Georgia\n* `KR` - South Korea\n* `SS` - South Sudan\n* `ES` - Spain\n* `LK` - Sri Lanka\n* `SD` - Sudan\n* `SR` - Suriname\n* `SJ` - Svalbard and Jan Mayen\n* `SE` - Sweden\n* `CH` - Switzerland\n* `SY` - Syria\n* `TW` - Taiwan\n* `TJ` - Tajikistan\n* `TZ` - Tanzania\n* `TH` - Thailand\n* `TL` - Timor-Leste\n* `TG` - Togo\n* `TK` - Tokelau\n* `TO` - Tonga\n* `TT` - Trinidad and Tobago\n* `TN` - Tunisia\n* `TR` - Türkiye\n* `TM` - Turkmenistan\n* `TC` - Turks and Caicos Islands\n* `TV` - Tuvalu\n* `UG` - Uganda\n* `UA` - Ukraine\n* `GB` - United Kingdom\n* `UM` - United States Minor Outlying Islands\n* `UY` - Uruguay\n* `UZ` - Uzbekistan\n* `VU` - Vanuatu\n* `VA` - Vatican City\n* `VE` - Venezuela\n* `VN` - Vietnam\n* `VG` - Virgin Islands (British)\n* `VI` - Virgin Islands (U.S.)\n* `WF` - Wallis and Futuna\n* `EH` - Western Sahara\n* `YE` - Yemen\n* `ZM` - Zambia\n* `ZW` - Zimbabwe",
            "readOnly": true
          },
          "district": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "The district where the organization is located in both languages.",
            "readOnly": true
          },
          "phone": {
            "maxLength": 200,
            "type": "string"
          },
          "state": {
            "description": "The emirate of the organization if located in UAE.",
            "readOnly": true,
            "type": "string"
          },
          "tax_identification_number": {
            "maxLength": 64,
            "type": "string"
          },
          "tax_registration_number": {
            "maxLength": 100,
            "type": "string"
          }
        },
        "required": [
          "address",
          "city",
          "country",
          "district",
          "state"
        ],
        "type": "object"
      },
      "OrganizationUser": {
        "properties": {
          "email": {
            "description": "The email address of the user.",
            "format": "email",
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the user.",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "email",
          "id"
        ],
        "type": "object"
      },
      "Warehouse": {
        "description": "A ModelSerializer that takes additional arguments for\n\"fields\", \"omit\" and \"expand\" in order to\ncontrol which fields are displayed, and whether to replace simple\nvalues with complex, nested serializations",
        "properties": {
          "account": {
            "description": "The account associated with this warehouse.",
            "type": "string"
          },
          "address": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "Full address of the warehouse in both languages."
          },
          "building_number": {
            "description": "Building number or identifier of the warehouse.",
            "type": "string"
          },
          "city": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "City where the warehouse is located, in both languages."
          },
          "code": {
            "description": "Unique code identifier for the warehouse.",
            "type": "string"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the warehouse was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "district": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "District or area where the warehouse is located, in both languages."
          },
          "id": {
            "description": "The unique identifier of the warehouse.",
            "readOnly": true,
            "type": "string"
          },
          "is_active": {
            "default": true,
            "description": "Indicates whether the warehouse is currently active and operational.",
            "type": "boolean"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the warehouse.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the warehouse was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "allOf": [
              {
                "$ref": "#/components/schemas/common-dual-lang-model"
              }
            ],
            "description": "The name of the warehouse in both languages."
          },
          "phone": {
            "description": "Contact phone number for the warehouse.",
            "type": "string"
          },
          "postal_code": {
            "description": "Postal or ZIP code of the warehouse location.",
            "type": "string"
          },
          "state": {
            "description": "Emirate for UAE organizations. Read-only field.",
            "readOnly": true,
            "type": "string"
          }
        },
        "required": [
          "account",
          "address",
          "building_number",
          "city",
          "code",
          "created_ts",
          "district",
          "id",
          "legacy_id",
          "modified_ts",
          "name",
          "phone",
          "postal_code",
          "state"
        ],
        "type": "object"
      },
      "_CompanyIdentificationSupplierSchema": {
        "additionalProperties": false,
        "properties": {
          "type": {
            "$ref": "#/components/schemas/CompanyIdentificationSupplierType",
            "description": "The identification type.",
            "examples": [
              "CRN"
            ]
          },
          "value": {
            "description": "The identification value.",
            "examples": [
              "1234567890"
            ],
            "minLength": 1,
            "title": "Value",
            "type": "string"
          }
        },
        "required": [
          "value",
          "type"
        ],
        "title": "_CompanyIdentificationSupplierSchema",
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
    "/organization/": {
      "get": {
        "description": "Endpoint for retrieving a single organization.",
        "operationId": "organization_retrieve",
        "responses": {
          "200": {
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/Organization"
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
        "summary": "Retrieve organization",
        "tags": [
          "Organizations"
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