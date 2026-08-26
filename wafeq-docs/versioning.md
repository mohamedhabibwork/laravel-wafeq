---
updatedAt: 2025-09-11T23:41:02.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Versioning

Wafeq uses a path prefix `https://api.wafeq.com/<version>` to determine which version of our API you are requesting.\
The request will return an error if no version is specified.

The current API version is `v1`.

#### Example

The below request will use the `v1` version of the API.

```shell
curl --location \
--request GET 'https://api.wafeq.com/v1/tax-rates/' \
--header 'Authorization: Api-Key <api_key>'
```