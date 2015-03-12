# Removing a merchant to the currently logged user's favorites #

## Request Format / requires [OAuth HTTP Authorization Headers](OAuth_Headers.md) ##

This is a POST request (PUT and DELETE are also supported)
```
http://api.praized.com/{community_slug}/merchants/{merchant_pid}/favorites.{format}?api_key={your api key}
```
## Arguments ##

### {merchant\_pid} ###

The unique identifier for a merchant.

format : string

ex : 96423266cd5145552decb67454b13e4e

## POST Body ##

The POST body can be either text or XML

### POST Text Format ###

The POST Body Text has three lines
The first is the unique identifier for the merchant.

format : string

ex : 96423266cd5145552decb67454b13e4e

The second is the type of the method

format : string
value : delete

The third is the name of the method

format : string
value : delete

A complete example :

96423266cd5145552decb67454b13e4e
delete
delete

### POST XML Format ###

```

<?xml version="1.0" encoding="UTF-8"?>
<favorite></favorite>

```


## Response Format ##

TODO :



---


Continue to [Adding a tag to a merchant](POST_Merchant_Tag.md)

Back to  [Adding a merchant to the currently logged user's favorites](POST_Merchant_User_Favorite.md)

Up to [Our Index](API.md)