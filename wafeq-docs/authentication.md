---
updatedAt: 2025-09-15T06:23:26.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Authentication

Wafeq supports authentication via two methods,

* Private Key (recommended for accessing your own organization by your application)
* OAuth Flow (recommended for building public third party integrations with Wafeq)

# Authenticating API calls via API Key (Private Key)

To use private key authentication you will need to [Get your API Key](https://developer.wafeq.com/reference/get-your-api-key) from your [Wafeq Developer console](https://app.wafeq.com/c/api-keys).

When making an API call to a Wafeq endpoint, you must use an `Authorization` header with `Api-Key` prefix followed by your API key.

Example,

```Text curl
curl --location \
--request GET 'https://api.wafeq.com/v1/organization/' \
--header 'Authorization: Api-Key <api_key>' \
...
```

# Authenticating API calls via Access Token (OAuth2 Flow)

The OAuth2 flow allows you to create public apps that anyone can use.

To use OAuth2 flow authentication, you'll need to create an app by reaching out to our support. Once we create the app, we will share a `client_id` and `client_secret` that you will need for the authorization flow.

When making an API call to a Wafeq endpoint, you must use an `Authorization` header with `Bearer` prefix followed by the access token obtained by the OAuth flow.

Example,

```
curl --location \
--request GET 'https://api.wafeq.com/v1/organization/' \
--header 'Authorization: Bearer <access_token>' \
...
```

or you can visit [oauth2-client-examples](https://gitlab.com/wafeq-com/oauth2-client-examples) repository for demo apps implementing oauth flow with Wafeq.