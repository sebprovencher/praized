# Commenting on a merchant #

## Request Format / requires [OAuth HTTP Authorization Headers](OAuth_Headers.md) ##

This is a POST request (PUT is also supported)
```
http://api.praized.com/{community_slug}/merchants/{merchant_pid}/comments.{format}?api_key={your api key}
```
## Arguments ##

### {merchant\_pid} ###

The unique identifier for a merchant.

format : string

ex : 96423266cd5145552decb67454b13e4e
## POST Body ##

The POST body can be in a text format or an XML format

### POST Text Format ###

The comment itself

format : string

ex : this is a comment

### POST XML Format ###

```

<?xml version="1.0" encoding="UTF-8"?><comment><comment>api comment with quotes and accents '</comment></comment>

```

## Response Format ##

### XML ###

```

<?xml version="1.0" encoding="UTF-8"?>
<praized>
 <community>
   <home_url>http://api-tribe.com/</home_url>
   <slug>apitribe</slug>
   <name>Api Tribe</name>
   <base_url>http://api-tribe.com/praized/</base_url>
 </community>
 <pagination>
   <current_page>1</current_page>
   <per_page>5</per_page>
   <page_count>1</page_count>
   <total_entries>4</total_entries>
 </pagination>
<comments>
 <comment>
   <user>
     <self>
       <friend>false</friend>
     </self>
     <login>fprefect</login>
   </user>
   <comment>The sushi is mostly harmless</comment>
   <created_at>2008-09-11T20:47:41Z</created_at>
 </comment>
 <comment>
   <user>
     <self>
       <friend>false</friend>
     </self>
     <login>fprefect</login>
   </user>
   <comment>The sushi is mostly harmless</comment>
   <created_at>2008-09-11T20:47:38Z</created_at>
 </comment>
 <comment>
   <user>
     <self>
       <friend>false</friend>
     </self>
     <login>fprefect</login>
   </user>
   <comment>Adding another comment</comment>
   <created_at>2008-09-08T00:01:49Z</created_at>
 </comment>
 <comment>
   <user>
     <self>
       <friend>false</friend>
     </self>
     <login>fprefect</login>
   </user>
   <comment>Adding a comment</comment>
   <created_at>2008-09-08T00:00:22Z</created_at>
 </comment>
</comments>
</praized>
```
### JSON ###

```

{
   "praized":{
      "merchant":{
         "permalink":"http://api-tribe.com/praized/places/ca/quebec/montreal/fast-sushi-restaurant/h0h0h0",
         "pid":"3140580f18afeea8e7665f5bf4e1191d",
         "name":"The Fast Sushi Restaurant",
         "updated_at":"2008/08/05 20:01:58 +0000",
         "short_url":"http://przd.com/naaaa-93",
         "favorite_count":"0",
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
               "url":"http://ca.stats.praized.com/ping?t=1220832112.41843"
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
            "latitude":45.506555,
            "postal_code":"H0H 0H0",
            "regions":{
               "province":"Quebec"
            },
            "country":{
               "name":"Canada",
               "code":"CA",
               "name_fr":"Canada"
            },
            "street_address":"4555 du abcdef",
            "longitude":-75.50000
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


Continue to [Adding a merchant to the currently logged user's favorites](POST_Merchant_User_Favorite.md)

Back to [Voting for a merchant](POST_Merchant_Vote.md)

Up to [Our Index](API.md)