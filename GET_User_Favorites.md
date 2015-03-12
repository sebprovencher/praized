# Getting user favorites #

## Request Format ##
```
http://api.praized.com/{community_slug}/users/{user_login}/favorites.{format}?api_key={your api key}
```
## Arguments ##

### {user\_login} ###

The login of the user

format : string

ex : fprefect
### page ###

No of the requested page

format : unsigned integer

### per\_page ###

Number of request per page

format : unsigned integer

## Response Format ##

### XML ###

```

<?xml version="1.0" encoding="UTF-8"?>
<praized>
  <community>
    <slug>praized-com-hub</slug>
    <name>praized.com hub</name>
    <home_url>http://praized.com/</home_url>
    <base_url>http://praized.com/</base_url>
  </community>

  <pagination>
    <per_page>10</per_page>
    <page_count>1</page_count>
    <total_entries>1</total_entries>
    <current_page>1</current_page>
  </pagination>
<merchants>

  <merchant>
    <pid>4babe6d18a7354cd9d0c652996b683e9</pid>
    <permalink>http://praized.com/places/ca/quebec/montreal/restaurant</permalink>
    <name>Sushi Restaurant</name>
    <favorite_count>1</favorite_count>
    <sponsored_links>
      <sponsored_link>

        <order>0</order>
        <url>http://www.yellowpages.ca/bus/Quebec/Montreal/Restaurant/2446710.html?AFC-2BI4e6er688</url>
        <label>See more information about this merchant in YellowPages.ca</label>
      </sponsored_link>
      <sponsored_link>
        <order>1</order>
        <url>http://yellowpages.ca/search/si/1/outings/montreal?AFC-2BI46746688</url>

        <label>Find outings in Montreal in YellowPages.ca</label>
      </sponsored_link>
    </sponsored_links>
    <updated_at>2008-08-24T19:44:42Z</updated_at>
    <votes>
      <neg_count>0</neg_count>
      <score>100</score>

      <pos_count>2</pos_count>
      <count>2</count>
    </votes>
    <tags>
      <tag>
        <name>outings</name>
      </tag>

      <tag>
        <name>meals</name>
      </tag>
      <tag>
        <name>entertainment</name>
      </tag>
      <tag>
        <name>restaurants</name>

      </tag>
      <tag>
        <name>caterers</name>
      </tag>
      <tag>
        <name>sushi</name>
      </tag>
    </tags>

    <tag_count>6</tag_count>
    <stat_links>
      <stat_link>
        <url>http://ca.stats.praized.com/ping?t=1219980993.91171</url>
      </stat_link>
    </stat_links>
    <url nil="true"></url>
    <comment_count>1</comment_count>

    <business_hours nil="true"></business_hours>
    <description nil="true"></description>
    <fax nil="true"></fax>
    <phone>(514)5555555</phone>
    <target>
      <rating>pos</rating>
      <favorite>true</favorite>

    </target>
    <location>
      <city>
        <name>Montreal</name>
        <code>MTL</code>
        <name_fr>Montreal</name_fr>
      </city>

      <postal_code>H0H 0H0</postal_code>
      <latitude>41.50802</latitude>
      <regions>
        <province>Quebec</province>
      </regions>
      <country>
        <name>Canada</name>

        <code>CA</code>
        <name_fr>Canada</name_fr>
      </country>
      <street_address>42, rue de xxxxx</street_address>
      <longitude>-74.570559</longitude>
    </location>
    <email nil="true"></email>


    <created_at>2008-08-24T19:42:11Z</created_at>
  </merchant>
</merchants>
</praized>
```

### JSON ###

```

{
   "praized":{
      "pagination":{
         "per_page":"10",
         "page_count":"1",
         "total_entries":"1",
         "current_page":"1"
      },
      "community":{
         "base_url":"http://praized.com/",
         "slug":"praized-com-hub",
         "name":"praized.com hub",
         "home_url":"http://praized.com/"
      },
      "merchants":[
         {
            "permalink":"http://praized.com/places/ca/quebec/montreal/restaurant",
            "pid":"4babe6d18a7354cd9d0c652996b683e9",
            "name":"Restaurant",
            "updated_at":"2008/08/24 19:44:42 +0000",
            "favorite_count":"1",
            "sponsored_links":[
               {
                  "order":"0",
                  "url":"http://www.yellowpages.ca/bus/Quebec/Montreal/Restaurant/2446710.html?AFC-2BI478746688",
                  "label":"See more information about this merchant in YellowPages.ca"
               },
               {
                  "order":"1",
                  "url":"http://yellowpages.ca/search/si/1/outings/montreal?AFC-2BI47874567688",
                  "label":"Find outings in Montreal in YellowPages.ca"
               }
            ],
            "votes":{
               "neg_count":"0",
               "score":"100",
               "pos_count":"2",
               "count":"2"
            },
            "tag_count":"6",
            "stat_links":[
               {
                  "url":"http://ca.stats.praized.com/ping?t=1219981059.15338"
               }
            ],
            "tags":[
               {
                  "name":"outings"
               },
               {
                  "name":"meals"
               },
               {
                  "name":"entertainment"
               },
               {
                  "name":"restaurants"
               },
               {
                  "name":"caterers"
               },
               {
                  "name":"sushi"
               }
            ],
            "url":null,
            "comment_count":"1",
            "business_hours":null,
            "description":null,
            "phone":"(514)5555555",
            "fax":null,
            "target":{
               "rating":"pos",
               "favorite":"true"
            },
            "location":{
               "city":{
                  "name":"Montreal",
                  "code":"MTL",
                  "name_fr":"Montreal"
               },
               "postal_code":"H3A 2K2",
               "latitude":45.50802,
               "regions":{
                  "province":"Quebec"
               },
               "country":{
                  "name":"Canada",
                  "code":"CA",
                  "name_fr":"Canada"
               },
               "street_address":"42, rue de xxxxxxx",
               "longitude":-71.570559
            },
            "created_at":"2008/08/24 19:42:11 +0000",
            "email":null
         }
      ]
   }
}

```



---


Continue to [Getting users votes](GET_User_Votes.md)

Back to [Getting users comments](GET_User_Comments.md)

Up to [Our Index](API.md)