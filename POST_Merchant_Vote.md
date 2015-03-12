# Voting for a merchant #

## Request Format / requires [OAuth HTTP Authorization Headers](OAuth_Headers.md) ##

This is a http POST Request

```

http://api.praized.com/{community_slug}/merchants/{merchant_pid}/votes.{format}?api_key={your api key}

```
## Arguments ##

### {merchant\_pid} ###

The unique identifier for a merchant.

format : string

ex : 96423266cd5145552decb67454b13e4e

## POST Body ##

#### POST Text Format ####

  * format : string (neg | pos)

neg for a negative vote and pos for a positive vote

#### POST XML Format ####

Negative Vote :

```

<?xml version="1.0" encoding="UTF-8"?>
<vote>
  <rating>neg</rating>
</vote>

```

Positive Vote :

```

<?xml version="1.0" encoding="UTF-8"?>
<vote>
  <rating>pos</rating>
</vote>

```

## Response Format ##

The response is very similar to a GET request

### XML Format ###

```

<?xml version="1.0" encoding="UTF-8"?>
<praized>
 <community>
   <base_url>http://api-tribe.com/praized/</base_url>
   <slug>apitribe</slug>
   <name>Api Tribe</name>
   <home_url>http://api-tribe.com/</home_url>
 </community>
<vote>
 <user>
   <login>fprefect</login>
 </user>
 <rating>neg</rating>
 <merchant>
   <permalink>http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0</permalink>
   <pid>3140580f18afeea8e7665f5bf4e1191d</pid>
   <name>Sushi restaurant</name>
   <sponsored_links/>
   <updated_at>2008-09-08T00:29:01Z</updated_at>
   <short_url>http://przd.com/nIsdf-93</short_url>
   <favorite_count>1</favorite_count>
   <votes>
     <neg_count>1</neg_count>
     <score>0</score>
     <pos_count>0</pos_count>
     <count>1</count>
   </votes>
   <tag_count>2</tag_count>
   <stat_links>
     <stat_link>
       <url>http://ca.stats.praized.com/ping?t=1221085463.36841</url>
     </stat_link>
   </stat_links>
   <tags>
     <tag>
       <name>sushi</name>
     </tag>
     <tag>
       <name>fast-food</name>
     </tag>
   </tags>
   <comment_count>2</comment_count>
   <url nil="true"></url>
   <business_hours nil="true"></business_hours>
   <description nil="true"></description>
   <fax nil="true"></fax>
   <phone>(514)5555555</phone>
   <location>
     <city>
       <name>Montreal</name>
       <code>MTL</code>
       <name_fr>Montreal</name_fr>
     </city>
     <postal_code>H0H0H0</postal_code>
     <latitude>43.506555</latitude>
     <regions>
       <province>Quebec</province>
     </regions>
     <country>
       <name>Canada</name>
       <code>CA</code>
       <name_fr>Canada</name_fr>
     </country>
     <street_address>42 du xxxxxxxx</street_address>
     <longitude>-71.570433</longitude>
   </location>
   <email nil="true"></email>
   <created_at>2008-08-05T20:01:58Z</created_at>
 </merchant>
</vote>
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
      "vote":{
         "user":{
            "login":"fprefect"
         },



         "rating":"pos",
         "merchant":{
            "permalink":"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0",
            "pid":"3140580f18afeea8e7665f5bf4e1191d",
            "name":"Sushi restaurant",
            "updated_at":"2008/08/05 20:01:58 +0000",
            "short_url":"http://przd.com/nIasdl-93",
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
                  "url":"http://ca.stats.praized.com/ping?t=1220831140.37964"
               }
            ],
            "url":null,
            "comment_count":"0",
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
               "street_address":"42 du xxxxxxxx",
               "longitude":-71.570433
            },
            "created_at":"2008/08/05 20:01:58 +0000",
            "email":null
         }
      }
   }
}


```



---


Continue to [Commenting on a merchant](POST_Merchant_Comment.md)

Back to [Getting tags for a merchant](GET_Merchant_Tags.md)

Up to [Our Index](API.md)