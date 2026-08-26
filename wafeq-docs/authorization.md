---
updatedAt: 2025-09-15T06:25:27.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Authorization

Wafeq implements the OAuth 2.0 authorization framework.

# Endpoints

```
GET https://app.wafeq.com/oauth/authorize/
POST https://app.wafeq.com/oauth/token/
POST https://app.wafeq.com/oauth/token/revoke/
```

# Authorization Code Flow

## Prerequisites

This guide assumes that you already have created an app.

## Examples

You can find example apps implementing the authorization code flow in the [oauth2-client-examples](https://gitlab.com/wafeq-com/oauth2-client-examples) repository.

## List of scopes

| Scope                     | Description                                     |
| ------------------------- | ----------------------------------------------- |
| basic                     | Basic access to organization info               |
| users                     | Access to organization list of users            |
| bulk\_invoices            | Bulk sending invoices api                       |
| chart\_of\_accounts.read  | Read-only access to chart of accounts data      |
| chart\_of\_accounts.write | Read and Write access to chart of accounts data |
| bank\_accounts.read       | Read-only access to bank\_accounts data         |
| bank\_accounts.write      | Read and Write access to bank accounts data     |
| beneficiaries.read        | Read-only access to beneficiaries data          |
| beneficiaries.write       | Read and Write access to beneficiaries data     |
| contacts.read             | Read-only access to contacts data               |
| contacts.write            | Read and Write access to contacts data          |
| employees.read            | Read-only access to employees data              |
| employees.write           | Read and Write access to employees data         |
| tax\_rates.read           | Read-only access to tax\_rates data             |
| tax\_rates.write          | Read and Write access to tax\_rates data        |
| invoices.read             | Read-only access to invoices data               |
| invoices.write            | Read and Write access to invoices data          |
| expenses.read             | Read-only access to expenses data               |
| expenses.write            | Read and Write access to expenses data          |
| bills.read                | Read-only access to bills data                  |
| bills.write               | Read and Write access to bills data             |
| journals.read             | Read-only access to journals data               |
| journals.write            | Read and Write access to journals data          |
| reports                   | Read-only access to reports                     |
| payroll.read              | Read-only access to payroll data                |
| payroll.write             | Read and Write access to payroll data           |
| payments.read             | Read-only access to payments data               |
| payments.write            | Read and Write access to payments data          |

## Request User Authorization

The first step is to request authorization from the user, so your app can access the Wafeq resources in behalf that user.
To do so, your application must build and send a GET request to the `/oauth/authorize/` endpoint with the following parameters:

| Query Param    | Value                                                                                                                                                                                                                                                                                                                                                                                         |
| -------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| client\_id     | *Required*: The Client ID generated after registering your application.                                                                                                                                                                                                                                                                                                                       |
| response\_type | *Required*: Set to `code`.                                                                                                                                                                                                                                                                                                                                                                    |
| redirect\_uri  | *Required*: The URI to redirect to after the user grants or denies permission. This URI needs to have been entered in the Redirect URI allowlist that you specified when you registered your application. The value of redirect\_uri here must exactly match one of the values you entered when you registered your application, including upper or lowercase, terminating slashes, and such. |
| scope          | *Required*: A space-separated list of [scopes](#list-of-scopes).                                                                                                                                                                                                                                                                                                                              |
| state          | *Optional, but strongly recommended*: This provides protection against attacks such as cross-site request forgery. See RFC-6749.                                                                                                                                                                                                                                                              |

If you're implementing the PKCE extension, you must include these additional parameters.

| Query Param             | Value                                                           |
| ----------------------- | --------------------------------------------------------------- |
| code\_challenge\_method | *Required*: Set to `S256`                                       |
| code\_challenge         | *Required*: Set to the code challenge that your app calculated. |

In order to generate the code\_challenge, your app should hash the code verifier using the SHA256 algorithm.
The code verifier is a random string between 43 and 128 characters in length. It can contain letters, digits,
underscores, periods, hyphens, or tildes.

### Response

**User accepts**

| Query Params | Value                                                                                                        |
| ------------ | ------------------------------------------------------------------------------------------------------------ |
| code         | An authorization code that can be exchanged for an Access Token. The authorization code is valid for 1 hour. |
| state        | The value of the `state` parameter supplied in the request.                                                  |

Example,

```
https://your-domain.com/callback?code=NApCCg..BkWtQ&state=34fFs29kd09
```

**User denies**

| Query Params | Value                                                          |
| ------------ | -------------------------------------------------------------- |
| error        | The reason authorization failed, for example: `access_denied`. |
| state        | The value of the state parameter supplied in the request.      |

Example,

```
https://your-domain.com/callback?error=access_denied&state=34fFs29kd09
```

## Request Access Token

If the user accepted your request, then your app is ready to exchange the authorization code for an Access Token.
It can do this by making a `POST` request to the `/token/` endpoint.

The body of this POST request must contain the following parameters encoded in `application/x-www-form-urlencoded`:

| Request Body Parameter | Value                                                                  |
| ---------------------- | ---------------------------------------------------------------------- |
| grant\_type            | *Required*: This field must contain the value `authorization_code`.    |
| code                   | *Required*: The authorization code returned from the previous request. |

If you're implementing the PKCE extension, you must include these additional parameters.

| Request Body Parameter | Value                                                                                                                            |
| ---------------------- | -------------------------------------------------------------------------------------------------------------------------------- |
| client\_id             | *Required*: The Client ID generated after registering your application.                                                          |
| code\_verifier         | *Required*: The value of this parameter must match the value of the code\_verifier that your app generated in the previous step. |

The request must also include the following HTTP headers:

| Header Parameters | Value                                                                                                                                                                                 |
| ----------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Authorization     | *Required*: Base 64 encoded string that contains the Client ID and Client Secret Key. The field must have the format: `Authorization: Basic <base64 encoded client_id:client_secret>` |
| Content-Type      | *Required*: Always set to `application/x-www-form-urlencoded`.                                                                                                                        |

### Response

| Key            | Value Type | Value Description                                                                                                                                        |
| -------------- | ---------- | -------------------------------------------------------------------------------------------------------------------------------------------------------- |
| access\_token  | string     | An Access Token that can be provided in subsequent calls. The access token is valid for 30 days.                                                         |
| refresh\_token | string     | An Refresh token which is used to fetch a new `access_token` to be then used in making authenticated API calls. The refresh token is valid for 6 months. |
| token\_type    | string     | How the Access Token may be used: always `Bearer`.                                                                                                       |
| expires\_in    | int        | The time period (in seconds) for which the Access Token is valid.                                                                                        |

Example:

```
curl --location \
    --request POST https://app.wafeq.com/oauth/token/ \
    --header 'Authorization: Basic NTMwO...3MWJi' \
    --header 'Content-Type: application/x-www-form-urlencoded' \
    --data-urlencode 'redirect_uri=https://your-domain.com/callback' \
    --data-urlencode 'grant_type=authorization_code' \
    --data-urlencode 'code=83YqX...mlezV'
```

The response will be similar to this:

```
{
   "access_token": "NgA6ZcYI...ixn8bUQ",
   "refresh_token": "NgAagA...Um_SHo",
   "token_type": "Bearer",
   "expires_in": 3600
}
```

## Request a refreshed Access Token

Access tokens are deliberately set to expire after a short time, after which new tokens may be granted by supplying the refresh token originally obtained during the authorization code exchange.
In order to refresh the token, a POST request must be sent with the following body parameters encoded in `application/x-www-form-urlencoded`:

| Request Body Parameter | Value                                                                        |
| ---------------------- | ---------------------------------------------------------------------------- |
| grant\_type            | *Required*: Set it to `refresh_token`.                                       |
| refresh\_token         | *Required*: The refresh token returned from the authorization code exchange. |

If you're implementing the PKCE extension, you must include these additional parameters.

| Request Body Parameter | Value                                                                   |
| ---------------------- | ----------------------------------------------------------------------- |
| client\_id             | *Required*: The Client ID generated after registering your application. |

The request must also include the following HTTP headers:

| Header Parameters | Value                                                                                                                                                                                 |
| ----------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Authorization     | *Required*: Base 64 encoded string that contains the Client ID and Client Secret Key. The field must have the format: `Authorization: Basic <base64 encoded client_id:client_secret>` |
| Content-Type      | *Required*: Always set to `application/x-www-form-urlencoded`.                                                                                                                        |

Example:

```
curl --location \
    --request POST https://app.wafeq.com/oauth/token/ \
    --header 'Authorization: Basic NTMwO...3MWJi' \
    --header 'Content-Type: application/x-www-form-urlencoded' \
    --data-urlencode 'grant_type=refresh_token' \
    --data-urlencode 'refresh_token=0uOmz...GNu77'
```

The response will be similar to this:

```
{
   "access_token": "NgA6ZcYI...ixn8bUQ",
   "token_type": "Bearer",
   "expires_in": 3600
}
```

## Revoking a Token

To enhance security and allow users to revoke access to their data, Wafeq provides a token revocation endpoint. This allows clients to invalidate both access tokens and refresh tokens.

To revoke a token, send a POST request to the token revocation endpoint:

```
POST https://app.wafeq.com/oauth/token/revoke/
```

### Request Parameters

The request must include the following parameters in the body, encoded as `application/x-www-form-urlencoded`:

| Parameter         | Description                                                                                                |
| ----------------- | ---------------------------------------------------------------------------------------------------------- |
| client\_id        | *Required*: Your OAuth 2.0 client ID.                                                                      |
| client\_secret    | *Required*: Your OAuth 2.0 client secret.                                                                  |
| token             | *Required*: The token to be revoked. This can be either an access token or a refresh token.                |
| token\_type\_hint | *Required*: A hint about the type of token being revoked. Can be either `access_token` or `refresh_token`. |

### Headers

The request must include the following HTTP header:

| Header       | Value                                                          |
| ------------ | -------------------------------------------------------------- |
| Content-Type | *Required*: Always set to `application/x-www-form-urlencoded`. |

### Example Request

Here's an example using cURL:

```bash
curl --location \
    --request POST https://app.wafeq.com/oauth/token/revoke/ \
    --header 'Content-Type: application/x-www-form-urlencoded' \
    --data-urlencode "client_id=$CLIENT_ID" \
    --data-urlencode "client_secret=$CLIENT_SECRET" \
    --data-urlencode "token=NgA6ZcYI...ixn8bUQ" \
    --data-urlencode "token_type_hint=access_token"
```