# Getting users comments #
## Request Format ##
```
http://api.praized.com/{community_slug}/users/{user_login}/comments.{format}?api_key={your api key}
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
    <base_url>http://praized.com/</base_url>
    <slug>praized-com-hub</slug>
    <name>praized.com hub</name>
    <home_url>http://praized.com/</home_url>
  </community>

  <pagination>
    <per_page>10</per_page>
    <page_count>1</page_count>
    <total_entries>1</total_entries>
    <current_page>1</current_page>
  </pagination>
<comments>

  <comment>
    <user>
      <login>fprefect</login>
    </user>
    <merchant>
      <permalink>http://praized.com/places/ca/quebec/montreal/restaurant</permalink>
      <pid>4babe6d18a7354cd9d0c652996b683e9</pid>

      <name>Restaurant</name>
      <favorite_count>1</favorite_count>
      <updated_at>2008-08-24T19:44:42Z</updated_at>
      <sponsored_links>
        <sponsored_link>
          <order>0</order>
          <url>http://www.yellowpages.ca/bus/Quebec/Montreal/Restaurant/2446710.html?AFC-2BI478746688</url>

          <label>See more information about this merchant in YellowPages.ca</label>
        </sponsored_link>
        <sponsored_link>
          <order>1</order>
          <url>http://yellowpages.ca/search/si/1/outings/montreal?AFC-2BI4789876688</url>
          <label>Find outings in Montreal in YellowPages.ca</label>
        </sponsored_link>

      </sponsored_links>
      <votes>
        <neg_count>0</neg_count>
        <score>100</score>
        <pos_count>2</pos_count>
        <count>2</count>
      </votes>

      <tag_count>6</tag_count>
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
      <stat_links>
        <stat_link>

          <url>http://ca.stats.praized.com/ping?t=1219980112.96175</url>
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
        <latitude>42.50802</latitude>

        <regions>
          <province>Quebec</province>
        </regions>
        <country>
          <name>Canada</name>
          <code>CA</code>
          <name_fr>Canada</name_fr>

        </country>
        <street_address>42, rue nnnnn</street_address>
        <longitude>-71.570559</longitude>
      </location>
      <created_at>2008-08-24T19:42:11Z</created_at>
      <email nil="true"></email>
    </merchant>

    <comment>Definitly one of my favorite Sushi places. They also have beef Teriaki and karaage.</comment>
    <created_at>2008-08-26T21:43:31Z</created_at>
  </comment>

  ....

</comments>
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
      "comments":[
         {
            "user":{
               "login":"fprefect"
            },
            "merchant":{
               "permalink":"http://praized.com/places/ca/quebec/montreal/restaurant",
               "pid":"4babe6d18a7354cd9d0c652996b683e9",
               "name":"Restaurant",
               "favorite_count":"1",
               "updated_at":"2008/08/24 19:44:42 +0000",
               "sponsored_links":[
                  {
                     "order":"0",
                     "url":"http://www.yellowpages.ca/bus/Quebec/Montreal/ORestaurant/2446710.html?AFC-2BI478746688",
                     "label":"See more information about this merchant in YellowPages.ca"
                  },
                  {
                     "order":"1",
                     "url":"http://yellowpages.ca/search/si/1/outings/montreal?AFC-2BI47ert688",
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
               "stat_links":[
                  {
                     "url":"http://ca.stats.praized.com/ping?t=1219980215.33844"
                  }
               ],
               "url":null,
               "comment_count":"1",
               "business_hours":null,
               "description":null,
               "fax":null,
               "phone":"(514)8493438",
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
                  "postal_code":"H0H 0H0",
                  "latitude":42.50802,
                  "regions":{
                     "province":"Quebec"
                  },
                  "country":{
                     "name":"Canada",
                     "code":"CA",
                     "name_fr":"Canada"
                  },
                  "street_address":"42, rue de nnnnnn",
                  "longitude":-73.570559
               },
               "created_at":"2008/08/24 19:42:11 +0000",
               "email":null
            },
            "comment":"Definitly one of my favorite Sushi places. They also have beef Teriaki and karaage.",
            "created_at":"2008/08/26 21:43:31 +0000"
         }
      ],
      "community":{
         "base_url":"http://praized.com/",
         "slug":"praized-com-hub",
         "name":"praized.com hub",
         "home_url":"http://praized.com/"
      }
   }
}

```



---


Continue to [Getting users favorites](GET_User_Favorites.md)

Back to [Getting users information](GET_User.md)

Up to [Our Index](API.md)