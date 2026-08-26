---
updatedAt: 2026-05-27T00:55:13.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# List contacts

Endpoint for retrieving a list of contacts.

# OpenAPI definition

```json
{
  "components": {
    "schemas": {
      "CompanyIdentificationCustomerType": {
        "enum": [
          "CRN",
          "GCC",
          "IQA",
          "MLS",
          "SAG",
          "MOM",
          "NAT",
          "700",
          "OTH",
          "PAS",
          "TIN",
          "TRD"
        ],
        "title": "CompanyIdentificationCustomerType",
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
      "Paginatedapi-v1-external-contact-read-writeList": {
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
              "$ref": "#/components/schemas/api-v1-external-contact-read-write"
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
      "_CompanyIdentificationCustomer": {
        "additionalProperties": false,
        "properties": {
          "type": {
            "$ref": "#/components/schemas/CompanyIdentificationCustomerType",
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
        "title": "_CompanyIdentificationCustomer",
        "type": "object"
      },
      "api-v1-external-contact-read-write": {
        "description": "An entity that can have attachments.",
        "properties": {
          "additional_number": {
            "default": "",
            "description": "Additional number for the address, if applicable.",
            "type": "string"
          },
          "address": {
            "default": "",
            "description": "The street address of the contact.",
            "type": "string"
          },
          "attachments": {
            "description": "A list of attachments associated with this contact.",
            "items": {
              "type": "string"
            },
            "type": "array"
          },
          "beneficiaries": {
            "description": "The Beneficiaries associated with Contacts",
            "items": {
              "type": "string"
            },
            "readOnly": true,
            "type": "array"
          },
          "building_number": {
            "default": "",
            "description": "The building number. Should be 4 digits for KSA addresses. For other countries, follow local conventions.",
            "type": "string"
          },
          "city": {
            "default": "",
            "description": "The city where the contact is located.",
            "type": "string"
          },
          "code": {
            "default": "",
            "description": "The unique contact code used for identification purposes.",
            "type": "string"
          },
          "company_identification": {
            "description": "The company identification of the contact.",
            "items": {
              "$ref": "#/components/schemas/_CompanyIdentificationCustomer"
            },
            "title": "CompanyIdentificationCustomerSchema",
            "type": "array"
          },
          "country": {
            "allOf": [
              {
                "$ref": "#/components/schemas/CountryEnum"
              }
            ],
            "description": "ISO 3166 two-letter country code representing the country of the contact.\n\n* `SA` - Kingdom of Saudi Arabia\n* `AE` - United Arab Emirates\n* `QA` - Qatar\n* `BH` - Bahrain\n* `KW` - Kuwait\n* `OM` - Oman\n* `EG` - Egypt\n* `US` - United States of America\n* `AF` - Afghanistan\n* `AX` - Åland Islands\n* `AL` - Albania\n* `DZ` - Algeria\n* `AS` - American Samoa\n* `AD` - Andorra\n* `AO` - Angola\n* `AI` - Anguilla\n* `AQ` - Antarctica\n* `AG` - Antigua and Barbuda\n* `AR` - Argentina\n* `AM` - Armenia\n* `AW` - Aruba\n* `AU` - Australia\n* `AT` - Austria\n* `AZ` - Azerbaijan\n* `BS` - Bahamas (The)\n* `BD` - Bangladesh\n* `BB` - Barbados\n* `BY` - Belarus\n* `BE` - Belgium\n* `BZ` - Belize\n* `BJ` - Benin\n* `BM` - Bermuda\n* `BT` - Bhutan\n* `BO` - Bolivia\n* `BQ` - Bonaire, Sint Eustatius and Saba\n* `BA` - Bosnia and Herzegovina\n* `BW` - Botswana\n* `BV` - Bouvet Island\n* `BR` - Brazil\n* `IO` - British Indian Ocean Territory\n* `BN` - Brunei\n* `BG` - Bulgaria\n* `BF` - Burkina Faso\n* `BI` - Burundi\n* `CV` - Cabo Verde\n* `KH` - Cambodia\n* `CM` - Cameroon\n* `CA` - Canada\n* `KY` - Cayman Islands\n* `CF` - Central African Republic\n* `TD` - Chad\n* `CL` - Chile\n* `CN` - China\n* `CX` - Christmas Island\n* `CC` - Cocos (Keeling) Islands\n* `CO` - Colombia\n* `KM` - Comoros\n* `CG` - Congo\n* `CK` - Cook Islands\n* `CR` - Costa Rica\n* `CI` - Côte d'Ivoire\n* `HR` - Croatia\n* `CU` - Cuba\n* `CW` - Curaçao\n* `CY` - Cyprus\n* `CZ` - Czechia\n* `CD` - Democratic Republic of the Congo\n* `DK` - Denmark\n* `DJ` - Djibouti\n* `DM` - Dominica\n* `DO` - Dominican Republic\n* `EC` - Ecuador\n* `SV` - El Salvador\n* `GQ` - Equatorial Guinea\n* `ER` - Eritrea\n* `EE` - Estonia\n* `SZ` - Eswatini\n* `ET` - Ethiopia\n* `FK` - Falkland Islands (Malvinas)\n* `FO` - Faroe Islands\n* `FJ` - Fiji\n* `FI` - Finland\n* `FR` - France\n* `GF` - French Guiana\n* `PF` - French Polynesia\n* `TF` - French Southern Territories\n* `GA` - Gabon\n* `GM` - Gambia\n* `GE` - Georgia\n* `DE` - Germany\n* `GH` - Ghana\n* `GI` - Gibraltar\n* `GR` - Greece\n* `GL` - Greenland\n* `GD` - Grenada\n* `GP` - Guadeloupe\n* `GU` - Guam\n* `GT` - Guatemala\n* `GG` - Guernsey\n* `GN` - Guinea\n* `GW` - Guinea-Bissau\n* `GY` - Guyana\n* `HT` - Haiti\n* `HM` - Heard Island and McDonald Islands\n* `HN` - Honduras\n* `HK` - Hong Kong\n* `HU` - Hungary\n* `IS` - Iceland\n* `IN` - India\n* `ID` - Indonesia\n* `IR` - Iran\n* `IQ` - Iraq\n* `IE` - Ireland\n* `IM` - Isle of Man\n* `IL` - Israel\n* `IT` - Italy\n* `JM` - Jamaica\n* `JP` - Japan\n* `JE` - Jersey\n* `JO` - Jordan\n* `KZ` - Kazakhstan\n* `KE` - Kenya\n* `KI` - Kiribati\n* `KG` - Kyrgyzstan\n* `LA` - Laos\n* `LV` - Latvia\n* `LB` - Lebanon\n* `LS` - Lesotho\n* `LR` - Liberia\n* `LY` - Libya\n* `LI` - Liechtenstein\n* `LT` - Lithuania\n* `LU` - Luxembourg\n* `MO` - Macao\n* `MG` - Madagascar\n* `MW` - Malawi\n* `MY` - Malaysia\n* `MV` - Maldives\n* `ML` - Mali\n* `MT` - Malta\n* `MH` - Marshall Islands\n* `MQ` - Martinique\n* `MR` - Mauritania\n* `MU` - Mauritius\n* `YT` - Mayotte\n* `MX` - Mexico\n* `FM` - Micronesia\n* `MD` - Moldova\n* `MC` - Monaco\n* `MN` - Mongolia\n* `ME` - Montenegro\n* `MS` - Montserrat\n* `MA` - Morocco\n* `MZ` - Mozambique\n* `MM` - Myanmar\n* `NA` - Namibia\n* `NR` - Nauru\n* `NP` - Nepal\n* `NL` - Netherlands\n* `NC` - New Caledonia\n* `NZ` - New Zealand\n* `NI` - Nicaragua\n* `NE` - Niger\n* `NG` - Nigeria\n* `NU` - Niue\n* `NF` - Norfolk Island\n* `KP` - North Korea\n* `MK` - North Macedonia\n* `MP` - Northern Mariana Islands\n* `NO` - Norway\n* `PK` - Pakistan\n* `PW` - Palau\n* `PS` - Palestine\n* `PA` - Panama\n* `PG` - Papua New Guinea\n* `PY` - Paraguay\n* `PE` - Peru\n* `PH` - Philippines\n* `PN` - Pitcairn\n* `PL` - Poland\n* `PT` - Portugal\n* `PR` - Puerto Rico\n* `RE` - Réunion\n* `RO` - Romania\n* `RU` - Russia\n* `RW` - Rwanda\n* `BL` - Saint Barthélemy\n* `SH` - Saint Helena\n* `KN` - Saint Kitts and Nevis\n* `LC` - Saint Lucia\n* `MF` - Saint Martin (French part)\n* `PM` - Saint Pierre and Miquelon\n* `VC` - Saint Vincent and the Grenadines\n* `WS` - Samoa\n* `SM` - San Marino\n* `ST` - Sao Tome and Principe\n* `SN` - Senegal\n* `RS` - Serbia\n* `SC` - Seychelles\n* `SL` - Sierra Leone\n* `SG` - Singapore\n* `SX` - Sint Maarten (Dutch part)\n* `SK` - Slovakia\n* `SI` - Slovenia\n* `SB` - Solomon Islands\n* `SO` - Somalia\n* `ZA` - South Africa\n* `GS` - South Georgia\n* `KR` - South Korea\n* `SS` - South Sudan\n* `ES` - Spain\n* `LK` - Sri Lanka\n* `SD` - Sudan\n* `SR` - Suriname\n* `SJ` - Svalbard and Jan Mayen\n* `SE` - Sweden\n* `CH` - Switzerland\n* `SY` - Syria\n* `TW` - Taiwan\n* `TJ` - Tajikistan\n* `TZ` - Tanzania\n* `TH` - Thailand\n* `TL` - Timor-Leste\n* `TG` - Togo\n* `TK` - Tokelau\n* `TO` - Tonga\n* `TT` - Trinidad and Tobago\n* `TN` - Tunisia\n* `TR` - Türkiye\n* `TM` - Turkmenistan\n* `TC` - Turks and Caicos Islands\n* `TV` - Tuvalu\n* `UG` - Uganda\n* `UA` - Ukraine\n* `GB` - United Kingdom\n* `UM` - United States Minor Outlying Islands\n* `UY` - Uruguay\n* `UZ` - Uzbekistan\n* `VU` - Vanuatu\n* `VA` - Vatican City\n* `VE` - Venezuela\n* `VN` - Vietnam\n* `VG` - Virgin Islands (British)\n* `VI` - Virgin Islands (U.S.)\n* `WF` - Wallis and Futuna\n* `EH` - Western Sahara\n* `YE` - Yemen\n* `ZM` - Zambia\n* `ZW` - Zimbabwe"
          },
          "created_ts": {
            "description": "The timestamp in UTC when the contact was created",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "custom_fields": {
            "description": "The custom fields of the contact."
          },
          "district": {
            "default": "",
            "description": "The district or neighborhood within the city where the contact is located.",
            "type": "string"
          },
          "email": {
            "default": "",
            "description": "The primary email address for contacting the contact.",
            "format": "email",
            "type": "string"
          },
          "external_id": {
            "default": "",
            "description": "External identifier for the contact.",
            "maxLength": 255,
            "type": "string"
          },
          "id": {
            "description": "The unique identifier of the contact object. This field is read-only.",
            "readOnly": true,
            "type": "string"
          },
          "legacy_id": {
            "description": "[Deprecated] The legacy identifier of the contact.",
            "readOnly": true,
            "type": "string"
          },
          "modified_ts": {
            "description": "The timestamp in UTC when the contact was last modified",
            "format": "date-time",
            "readOnly": true,
            "type": "string"
          },
          "name": {
            "description": "The full name or business name of the contact.",
            "type": "string"
          },
          "persons": {
            "description": "The associated persons for the contact.",
            "items": {
              "type": "string"
            },
            "readOnly": true,
            "type": "array"
          },
          "phone": {
            "default": "",
            "description": "The primary phone number for contacting the contact.",
            "type": "string"
          },
          "postal_code": {
            "default": "",
            "description": "The postal code or ZIP code. Should be 5 digits for KSA addresses. For other countries, follow local postal code formats.",
            "type": "string"
          },
          "relationship": {
            "description": "A list of tags describing the relationship with the contact. Can be Customer, Supplier, Investor, Partner, Other.",
            "items": {},
            "type": "array"
          },
          "tax_registration_number": {
            "default": "",
            "description": "The tax registration number of the contact, if applicable.",
            "type": "string"
          }
        },
        "required": [
          "beneficiaries",
          "created_ts",
          "id",
          "legacy_id",
          "modified_ts",
          "name",
          "persons"
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
    "/contacts/": {
      "get": {
        "description": "Endpoint for retrieving a list of contacts.",
        "operationId": "contacts_list",
        "parameters": [
          {
            "description": "* `SA` - Kingdom of Saudi Arabia\n* `AE` - United Arab Emirates\n* `QA` - Qatar\n* `BH` - Bahrain\n* `KW` - Kuwait\n* `OM` - Oman\n* `EG` - Egypt\n* `US` - United States of America\n* `AF` - Afghanistan\n* `AX` - Åland Islands\n* `AL` - Albania\n* `DZ` - Algeria\n* `AS` - American Samoa\n* `AD` - Andorra\n* `AO` - Angola\n* `AI` - Anguilla\n* `AQ` - Antarctica\n* `AG` - Antigua and Barbuda\n* `AR` - Argentina\n* `AM` - Armenia\n* `AW` - Aruba\n* `AU` - Australia\n* `AT` - Austria\n* `AZ` - Azerbaijan\n* `BS` - Bahamas (The)\n* `BD` - Bangladesh\n* `BB` - Barbados\n* `BY` - Belarus\n* `BE` - Belgium\n* `BZ` - Belize\n* `BJ` - Benin\n* `BM` - Bermuda\n* `BT` - Bhutan\n* `BO` - Bolivia\n* `BQ` - Bonaire, Sint Eustatius and Saba\n* `BA` - Bosnia and Herzegovina\n* `BW` - Botswana\n* `BV` - Bouvet Island\n* `BR` - Brazil\n* `IO` - British Indian Ocean Territory\n* `BN` - Brunei\n* `BG` - Bulgaria\n* `BF` - Burkina Faso\n* `BI` - Burundi\n* `CV` - Cabo Verde\n* `KH` - Cambodia\n* `CM` - Cameroon\n* `CA` - Canada\n* `KY` - Cayman Islands\n* `CF` - Central African Republic\n* `TD` - Chad\n* `CL` - Chile\n* `CN` - China\n* `CX` - Christmas Island\n* `CC` - Cocos (Keeling) Islands\n* `CO` - Colombia\n* `KM` - Comoros\n* `CG` - Congo\n* `CK` - Cook Islands\n* `CR` - Costa Rica\n* `CI` - Côte d'Ivoire\n* `HR` - Croatia\n* `CU` - Cuba\n* `CW` - Curaçao\n* `CY` - Cyprus\n* `CZ` - Czechia\n* `CD` - Democratic Republic of the Congo\n* `DK` - Denmark\n* `DJ` - Djibouti\n* `DM` - Dominica\n* `DO` - Dominican Republic\n* `EC` - Ecuador\n* `SV` - El Salvador\n* `GQ` - Equatorial Guinea\n* `ER` - Eritrea\n* `EE` - Estonia\n* `SZ` - Eswatini\n* `ET` - Ethiopia\n* `FK` - Falkland Islands (Malvinas)\n* `FO` - Faroe Islands\n* `FJ` - Fiji\n* `FI` - Finland\n* `FR` - France\n* `GF` - French Guiana\n* `PF` - French Polynesia\n* `TF` - French Southern Territories\n* `GA` - Gabon\n* `GM` - Gambia\n* `GE` - Georgia\n* `DE` - Germany\n* `GH` - Ghana\n* `GI` - Gibraltar\n* `GR` - Greece\n* `GL` - Greenland\n* `GD` - Grenada\n* `GP` - Guadeloupe\n* `GU` - Guam\n* `GT` - Guatemala\n* `GG` - Guernsey\n* `GN` - Guinea\n* `GW` - Guinea-Bissau\n* `GY` - Guyana\n* `HT` - Haiti\n* `HM` - Heard Island and McDonald Islands\n* `HN` - Honduras\n* `HK` - Hong Kong\n* `HU` - Hungary\n* `IS` - Iceland\n* `IN` - India\n* `ID` - Indonesia\n* `IR` - Iran\n* `IQ` - Iraq\n* `IE` - Ireland\n* `IM` - Isle of Man\n* `IL` - Israel\n* `IT` - Italy\n* `JM` - Jamaica\n* `JP` - Japan\n* `JE` - Jersey\n* `JO` - Jordan\n* `KZ` - Kazakhstan\n* `KE` - Kenya\n* `KI` - Kiribati\n* `KG` - Kyrgyzstan\n* `LA` - Laos\n* `LV` - Latvia\n* `LB` - Lebanon\n* `LS` - Lesotho\n* `LR` - Liberia\n* `LY` - Libya\n* `LI` - Liechtenstein\n* `LT` - Lithuania\n* `LU` - Luxembourg\n* `MO` - Macao\n* `MG` - Madagascar\n* `MW` - Malawi\n* `MY` - Malaysia\n* `MV` - Maldives\n* `ML` - Mali\n* `MT` - Malta\n* `MH` - Marshall Islands\n* `MQ` - Martinique\n* `MR` - Mauritania\n* `MU` - Mauritius\n* `YT` - Mayotte\n* `MX` - Mexico\n* `FM` - Micronesia\n* `MD` - Moldova\n* `MC` - Monaco\n* `MN` - Mongolia\n* `ME` - Montenegro\n* `MS` - Montserrat\n* `MA` - Morocco\n* `MZ` - Mozambique\n* `MM` - Myanmar\n* `NA` - Namibia\n* `NR` - Nauru\n* `NP` - Nepal\n* `NL` - Netherlands\n* `NC` - New Caledonia\n* `NZ` - New Zealand\n* `NI` - Nicaragua\n* `NE` - Niger\n* `NG` - Nigeria\n* `NU` - Niue\n* `NF` - Norfolk Island\n* `KP` - North Korea\n* `MK` - North Macedonia\n* `MP` - Northern Mariana Islands\n* `NO` - Norway\n* `PK` - Pakistan\n* `PW` - Palau\n* `PS` - Palestine\n* `PA` - Panama\n* `PG` - Papua New Guinea\n* `PY` - Paraguay\n* `PE` - Peru\n* `PH` - Philippines\n* `PN` - Pitcairn\n* `PL` - Poland\n* `PT` - Portugal\n* `PR` - Puerto Rico\n* `RE` - Réunion\n* `RO` - Romania\n* `RU` - Russia\n* `RW` - Rwanda\n* `BL` - Saint Barthélemy\n* `SH` - Saint Helena\n* `KN` - Saint Kitts and Nevis\n* `LC` - Saint Lucia\n* `MF` - Saint Martin (French part)\n* `PM` - Saint Pierre and Miquelon\n* `VC` - Saint Vincent and the Grenadines\n* `WS` - Samoa\n* `SM` - San Marino\n* `ST` - Sao Tome and Principe\n* `SN` - Senegal\n* `RS` - Serbia\n* `SC` - Seychelles\n* `SL` - Sierra Leone\n* `SG` - Singapore\n* `SX` - Sint Maarten (Dutch part)\n* `SK` - Slovakia\n* `SI` - Slovenia\n* `SB` - Solomon Islands\n* `SO` - Somalia\n* `ZA` - South Africa\n* `GS` - South Georgia\n* `KR` - South Korea\n* `SS` - South Sudan\n* `ES` - Spain\n* `LK` - Sri Lanka\n* `SD` - Sudan\n* `SR` - Suriname\n* `SJ` - Svalbard and Jan Mayen\n* `SE` - Sweden\n* `CH` - Switzerland\n* `SY` - Syria\n* `TW` - Taiwan\n* `TJ` - Tajikistan\n* `TZ` - Tanzania\n* `TH` - Thailand\n* `TL` - Timor-Leste\n* `TG` - Togo\n* `TK` - Tokelau\n* `TO` - Tonga\n* `TT` - Trinidad and Tobago\n* `TN` - Tunisia\n* `TR` - Türkiye\n* `TM` - Turkmenistan\n* `TC` - Turks and Caicos Islands\n* `TV` - Tuvalu\n* `UG` - Uganda\n* `UA` - Ukraine\n* `GB` - United Kingdom\n* `UM` - United States Minor Outlying Islands\n* `UY` - Uruguay\n* `UZ` - Uzbekistan\n* `VU` - Vanuatu\n* `VA` - Vatican City\n* `VE` - Venezuela\n* `VN` - Vietnam\n* `VG` - Virgin Islands (British)\n* `VI` - Virgin Islands (U.S.)\n* `WF` - Wallis and Futuna\n* `EH` - Western Sahara\n* `YE` - Yemen\n* `ZM` - Zambia\n* `ZW` - Zimbabwe",
            "in": "query",
            "name": "country",
            "schema": {
              "enum": [
                "AD",
                "AE",
                "AF",
                "AG",
                "AI",
                "AL",
                "AM",
                "AO",
                "AQ",
                "AR",
                "AS",
                "AT",
                "AU",
                "AW",
                "AX",
                "AZ",
                "BA",
                "BB",
                "BD",
                "BE",
                "BF",
                "BG",
                "BH",
                "BI",
                "BJ",
                "BL",
                "BM",
                "BN",
                "BO",
                "BQ",
                "BR",
                "BS",
                "BT",
                "BV",
                "BW",
                "BY",
                "BZ",
                "CA",
                "CC",
                "CD",
                "CF",
                "CG",
                "CH",
                "CI",
                "CK",
                "CL",
                "CM",
                "CN",
                "CO",
                "CR",
                "CU",
                "CV",
                "CW",
                "CX",
                "CY",
                "CZ",
                "DE",
                "DJ",
                "DK",
                "DM",
                "DO",
                "DZ",
                "EC",
                "EE",
                "EG",
                "EH",
                "ER",
                "ES",
                "ET",
                "FI",
                "FJ",
                "FK",
                "FM",
                "FO",
                "FR",
                "GA",
                "GB",
                "GD",
                "GE",
                "GF",
                "GG",
                "GH",
                "GI",
                "GL",
                "GM",
                "GN",
                "GP",
                "GQ",
                "GR",
                "GS",
                "GT",
                "GU",
                "GW",
                "GY",
                "HK",
                "HM",
                "HN",
                "HR",
                "HT",
                "HU",
                "ID",
                "IE",
                "IL",
                "IM",
                "IN",
                "IO",
                "IQ",
                "IR",
                "IS",
                "IT",
                "JE",
                "JM",
                "JO",
                "JP",
                "KE",
                "KG",
                "KH",
                "KI",
                "KM",
                "KN",
                "KP",
                "KR",
                "KW",
                "KY",
                "KZ",
                "LA",
                "LB",
                "LC",
                "LI",
                "LK",
                "LR",
                "LS",
                "LT",
                "LU",
                "LV",
                "LY",
                "MA",
                "MC",
                "MD",
                "ME",
                "MF",
                "MG",
                "MH",
                "MK",
                "ML",
                "MM",
                "MN",
                "MO",
                "MP",
                "MQ",
                "MR",
                "MS",
                "MT",
                "MU",
                "MV",
                "MW",
                "MX",
                "MY",
                "MZ",
                "NA",
                "NC",
                "NE",
                "NF",
                "NG",
                "NI",
                "NL",
                "NO",
                "NP",
                "NR",
                "NU",
                "NZ",
                "OM",
                "PA",
                "PE",
                "PF",
                "PG",
                "PH",
                "PK",
                "PL",
                "PM",
                "PN",
                "PR",
                "PS",
                "PT",
                "PW",
                "PY",
                "QA",
                "RE",
                "RO",
                "RS",
                "RU",
                "RW",
                "SA",
                "SB",
                "SC",
                "SD",
                "SE",
                "SG",
                "SH",
                "SI",
                "SJ",
                "SK",
                "SL",
                "SM",
                "SN",
                "SO",
                "SR",
                "SS",
                "ST",
                "SV",
                "SX",
                "SY",
                "SZ",
                "TC",
                "TD",
                "TF",
                "TG",
                "TH",
                "TJ",
                "TK",
                "TL",
                "TM",
                "TN",
                "TO",
                "TR",
                "TT",
                "TV",
                "TW",
                "TZ",
                "UA",
                "UG",
                "UM",
                "US",
                "UY",
                "UZ",
                "VA",
                "VC",
                "VE",
                "VG",
                "VI",
                "VN",
                "VU",
                "WF",
                "WS",
                "YE",
                "YT",
                "ZA",
                "ZM",
                "ZW",
                "__null__"
              ],
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the bill was created",
            "in": "query",
            "name": "created_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the bill was created",
            "in": "query",
            "name": "created_ts_before",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "External identifier",
            "in": "query",
            "name": "external_id",
            "schema": {
              "type": "string"
            }
          },
          {
            "description": "A search term.",
            "in": "query",
            "name": "keyword",
            "required": false,
            "schema": {
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the bill was last modified",
            "in": "query",
            "name": "modified_ts_after",
            "schema": {
              "format": "date-time",
              "type": "string"
            }
          },
          {
            "description": "The timestamp in UTC when the bill was last modified",
            "in": "query",
            "name": "modified_ts_before",
            "schema": {
              "format": "date-time",
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
          },
          {
            "description": "Multiple values may be separated by commas.",
            "explode": false,
            "in": "query",
            "name": "relationship",
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
                "schema": {
                  "$ref": "#/components/schemas/Paginatedapi-v1-external-contact-read-writeList"
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
        "summary": "List contacts",
        "tags": [
          "Contacts"
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