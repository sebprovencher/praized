# OAuth HTTP Authorization Headers #

For authenticated API requests, OAuth HTTP Authorization headers must be sent. **These headers are usually created by your OAuth client library**.

For testing purposes, it is possible to setup a simple OAuth proxy to send authenticated requests using tools like curl, see [Testing authenticated API calls from the command line using a OAuth proxy](Testing_cli.md)

Authorization is not required for read requests, but in some cases, if they are sent with the read request, more information specific to the currently logged in user will be available.

Here is an exemple of correctly sent HTTP Headers for a POST request :
```
OAuth realm="",
oauth_version="1.0",
oauth_nonce="ae8704c739e3bf6121e40b170583733c",
oauth_timestamp="1220655178",
oauth_consumer_key="DwDSfr1fGfAxfxodqajVA",
oauth_token="9LkIvyTFgm8HtBIWvztNg",
oauth_signature_method="HMAC-SHA1",
oauth_signature="efwVM%2FYAQemNEZyVbfLFFqlnWPE%3D"
```
## OAuth Realm ##

Not used in this version of the API. Send an empty string

## oauth\_version ##

"1.0"

## oauth\_nonce ##

The nonce is a random string that must be unique to the timestamp sent with this request

## oauth\_timestamp ##

The number of seconds since January 1, 1970 00:00:00 GMT at the time of the request

## oauth\_consumer\_key ##

The consumer key is provided by Praized with the API key

## oauth\_token ##

The access token for this request

## oauth\_signature\_method ##

The name of the algorithm used to sign the request

## oauth\_signature ##

The signature itself



---


Continue to [OAuth Endpoints](OAuth_EndPoints.md)

Back to [Common parameters and endpoint url parts](Common_Parameters.md)

Up to [Our Index](API.md)