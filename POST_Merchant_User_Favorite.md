# Adding a merchant to the currently logged user's favorites #

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

The unique identifier for the merchant.

format : string

ex : 96423266cd5145552decb67454b13e4e


### POST XML Format ###

```

<?xml version="1.0" encoding="UTF-8"?>
<favorite></favorite>

```


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
 <pagination>
   <total_entries></total_entries>
   <per_page></per_page>
   <current_page></current_page>
   <page_count></page_count>
 </pagination>
<friends/>
</praized>

```

### JSON ###

```

{
   "praized":{
      "merchant":{
         "permalink":"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0",
         "pid":"3140580f18afeea8e7665f5bf4e1191d",
         "name":"Sushi Shop",
         "updated_at":"2008/08/05 20:01:58 +0000",
         "short_url":"http://przd.com/nada-93",
         "favorite_count":"1",
         "sponsored_links":[
         ],
         "votes":{
            "neg_count":"0",
            "score":"100",
            "pos_count":"1",
            "count":"1"
         },
         "tag_count":"1",
         "tags":[
            {
               "name":"sushi"
            }
         ],
         "stat_links":[
            {
               "url":"http://ca.stats.praized.com/ping?t=1220832836.57574"
            }
         ],
         "url":null,
         "comment_count":"2",
         "business_hours":null,
         "description":null,
         "fax":null,
         "phone":"(514)5555555",
         "location":{
            "city":{
               "name":"Montreal",
               "code":"MTL",
               "name_fr":"Montreal"
            },
            "latitude":42.506555,
            "postal_code":"H3A 1J7",
            "regions":{
               "province":"Quebec"
            },
            "country":{
               "name":"Canada",
               "code":"CA",
               "name_fr":"Canada"
            },
            "street_address":"42 nnnnnnnn",
            "longitude":-73.570433
         },
         "created_at":"2008/08/05 20:01:58 +0000"!,
         "email":null
      },
      "community":{
         "base_url":"http://api-tribe.com/praized/",
         "slug":"apitribe",
         "name":"Api Tribe",
         "home_url":"http://api-tribe.com/"
      }
   }
}

```



---


Continue to [Removing a merchant to the currently logged user's favorites](DELETE_Merchant_User_Favorite.md)

Back to [Commenting on a merchant](POST_Merchant_Comment.md)

Up to [Our Index](API.md)