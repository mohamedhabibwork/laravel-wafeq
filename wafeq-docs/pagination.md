---
updatedAt: 2025-09-11T23:41:00.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Pagination

# Paginating API calls

All `list` endpoints responses will include the following keys:

```
{
    "count": 123,
    "next": "<next_url>",
    "previous": "<previous_url>",
    "results": [...]
}
```

The `results` array contains the first 50 results.\
To retrieve the next page of results, simply call the `next` url:

```
curl --location \
--request GET '<next_url>'
--header 'Authorization: Api-Key <api_key>'
```