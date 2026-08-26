---
updatedAt: 2025-09-11T23:41:01.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Filter

`list` endpoints may allow filters.\
Apply one or more filters using query parameters.

### Example

The below request will exclude system accounts and include accounts where payments are enabled.

```shell
curl --location \
--request GET 'https://api.wafeq.com/v1/accounts/?is_system=false&is_payment_enabled=true' \
--header 'Authorization: Api-Key <api_key>'
```