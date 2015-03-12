# Adding a tag to a merchant #

## Request Format / requires [OAuth HTTP Authorization Headers](OAuth_Headers.md) ##

This is a POST request (PUT is also supported)

```
http://api.praized.com/{community_slug}/merchants/{merchant_pid}/taggings.{format}?api_key={your api key}
```
## Arguments ##

### {merchant\_pid} ###

The unique identifier for a merchant.

format : string

ex : 96423266cd5145552decb67454b13e4e

## POST Body ##

### POST Text Format ###

The POST body has three lines

The first is the name of the function :

format : string
value : Add my tag

The second is the tag itself

format : string
ex: fast-food

The third is type of the method used (HTTP verb)

format : string
value : post

### POST XML Format ###

```

<?xml version="1.0" encoding="UTF-8"?>
<tagging><tag>fast food</tag></tagging>


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
<merchant>
 <permalink>http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0</permalink>
 <pid>3140580f18afeea8e7665f5bf4e1191d</pid>
 <name>Sushi Restaurant</name>
 <sponsored_links/>
 <updated_at>2008-09-11T20:57:42Z</updated_at>
 <short_url>http://przd.com/nIadl-93</short_url>
 <favorite_count>2</favorite_count>
 <votes>
   <neg_count>1</neg_count>
   <score>50</score>
   <pos_count>1</pos_count>
   <count>2</count>
 </votes>
 <tag_count>3</tag_count>
 <stat_links>
   <stat_link>
     <url>http://ca.stats.praized.com/ping?t=1221166663.26701</url>
   </stat_link>
 </stat_links>
 <tags>
   <tag>
     <name>sushi</name>
   </tag>
   <tag>
     <name>fast-food</name>
   </tag>
   <tag>
     <name>downtown</name>
- Masquer le texte des messages pr�c�dents -
   </tag>
 </tags>
 <comment_count>6</comment_count>
 <url nil="true"></url>
 <business_hours nil="true"></business_hours>
 <description nil="true"></description>
 <phone>(514)5555555</phone>
 <fax nil="true"></fax>
 <location>
   <city>
     <name>Montreal</name>
     <code>MTL</code>
     <name_fr>Montreal</name_fr>
   </city>
   <postal_code>H0H 0H0</postal_code>
   <latitude>42.506555</latitude>
   <regions>
     <province>Quebec</province>
   </regions>
   <country>
     <name>Canada</name>
     <code>CA</code>
     <name_fr>Canada</name_fr>
   </country>
   <street_address>42 du nnnnnnnnn</street_address>
   <longitude>-71.570433</longitude>
 </location>
 <created_at>2008-08-05T20:01:58Z</created_at>
 <email nil="true"></email>
</merchant>
</praized>

```

### JSON ###

```

{
   "praized":{
      "merchant":{
         "permalink":"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0",
         "pid":"3140580f18afeea8e7665f5bf4e1191d",
         "name":"Sushi Restaurant",
         "short_url":"http://przd.com/nIbl-93",
         "updated_at":"2008/09/08 00:20:38 +0000",
         "favorite_count":"1",
         "sponsored_links":[
         ],
         "votes":{
            "score":"100",
            "neg_count":"0",
            "pos_count":"1",
            "count":"1"
         },
         "stat_links":[
            {
               "url":"http://ca.stats.praized.com/ping?t=1220833239.06230"
            }
         ],
         "tags":[
            {
               "name":"sushi"
            }
         ],
         "tag_count":"2",
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
            "postal_code":"H0H 0H0",
            "regions":{
               "province":"Quebec"
            },
            "country":{
               "name":"Canada",
               "code":"CA",
               "name_fr":"Canada"
            },
            "street_address":"42 du ni",
            "longitude":-71.570433
         },
         "email":null,
         "created_at":"2008/08/05 !
 20:01:58 +0000"
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


Continue to [Getting users information](GET_User.md)

Back to [Removing a merchant to the currently logged user's favorites](DELETE_Merchant_User_Favorite.md)

Up to [Our Index](API.md)