# Adding / Removing a user as a friend of the currently logged user #

## Request Format / requires [OAuth HTTP Authorization Headers](OAuth_Headers.md) ##

This is a POST request. (PUT and DELETE are also supported)
```
http://api.praized.com/{community_slug}/users/{user_login}/friendships.{format}?api_key={your api key}
```
## Arguments ##

### {user\_login} ###

The login of the user

format : string

ex : fprefect

## POST Body ##

format : string

value : (add|delete)

## Response Format ##

### XML ###

```

<?xml version="1.0" encoding="UTF-8"?>
<praized>
 <community>
   <base_url>http://api-tribe.com/praized/</base_url>
   <slug>apitribe</slug>
   <name>Api Tribe</name>
   <home_url>http://api-tribe.com/</home_url>
 </community>
<friendship>
 <login>0</login>
</friendship>
</praized>

```

### JSON ###

```

{
   "praized":{
      "community":{
         "base_url":"http://api-tribe.com/praized/",
         "slug":"apitribe",
         "name":"Api Tribe",
         "home_url":"http://api-tribe.com/"
      },
      "friendship":{
         "login":0
      }
   }
}

```



---


Continue to [Getting a Praized Buzz Feed](GET_Buzz_Feed.md)

Back to [Getting users friends](GET_User_Friends.md)

Up to [Our Index](API.md)