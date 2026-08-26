---
updatedAt: 2025-09-11T23:41:02.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Idempotency

Wafeq support idempotent requests via headers to ensure that the same operation is not processed multiple times,\
even if the same request is sent multiple times.

## Usage

To make an idempotent request:

1. Add the `X-Wafeq-Idempotency-Key` header to your request
2. Use a valid UUID v4 as the header value
3. Use this header for POST, PUT, PATCH, or DELETE requests

## Behavior

* If the same idempotency key is reused for identical requests within 1 hour, the original response will be returned
* The response will include an `X-Wafeq-Idempotent-Replayed` header set to 'true' if it's a cached response
* Invalid UUID formats will result in a 400 Bad Request response
* The idempotency key is scoped to the specific HTTP method and endpoint

## Best Practices

* Generate a new UUID for each unique operation
* Store the idempotency key with your request records for tracking
* Reuse the same idempotency key when retrying failed requests