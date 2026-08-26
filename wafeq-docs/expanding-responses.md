---
updatedAt: 2025-09-11T23:40:59.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Expanding responses

# Expanding API response objects

Related objects that are referenced by their id can be expanded in the response using the `expand` query parameter. This\
parameter is a comma-separated list of objects to expand, and supports nesting using the `.` notation.

As an example, an unexpanded bank ledger:

```json
{
    "id": "bt_KabEvYZwpUQCevDJycmVWu",
    "bank_account": "ba_9t79bCG2Q6SxPxQBqva8z9",
    "account": "acc_x908asdlmn298123lnm",
    "date": "2022-01-01",
    "amount": 1000.0,
    "description": "Test transaction",
    "reference": "REF-TEST-123",
    "is_manual": true
}
```

Once you pass `?expand=account,bank_account,bank_account.account` as query parameter, the response\
would look like this:

```json
{
    "id": "bt_KabEvYZwpUQCevDJycmVWu",
    "bank_account": {
        "id": "ba_9t79bCG2Q6SxPxQBqva8z9",
        "name": "Test bank account",
        "currency": "SAR",
        "classification": "ASSET",
        "sub_classification": "PETTY_CASH",
        "account": {
            "id": "acc_2nqzog3ZRXegUgvLWEVJ84",
            "account_code": "200",
            "name_en": "Test bank account",
            "name_ar": "Test bank account",
            "is_system": false,
            "classification": "ASSET",
            "sub_classification": "CASH_EQUIVALENTS",
            "is_payment_enabled": true
        }
    },
    "account": {
        "id": "acc_x908asdlmn298123lnm",
        "account_code": "200",
        "name_en": "Sales",
        "name_ar": "مبيعات",
        "is_system": false,
        "classification": "REVENUE",
        "sub_classification": "INCOME",
        "is_payment_enabled": true
    },
    "date": "2019-12-29",
    "amount": 1000.0,
    "description": "Test transaction",
    "reference": "REF-TEST-123",
    "is_manual": true
}
```