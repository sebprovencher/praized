# Getting users votes #

Votes are by users and by community. A single user can vote differently in different communities.

## Request Format ##
```
http://api.praized.com/{community_slug}/users/{user_login}/votes.{format}?api_key={your api key}
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
    <total_entries>9</total_entries>
    <current_page>1</current_page>
  </pagination>
<votes>

  <vote>
    <rating>pos</rating>

    <user>
      <login>fprefect</login>
    </user>
    <merchant>
      <permalink>http://praized.com/places/ca/quebec/montreal/centre-de-recherche-informatique-de-montreal</permalink>

      <pid>a133ee3f7b7219f0a7797cd079221f60</pid>
      <name>Centre de Recherche Informatique de Montr&#233;al</name>
      <updated_at>2008-06-30T17:36:04Z</updated_at>
      <favorite_count>2</favorite_count>
      <sponsored_links>
        <sponsored_link>

          <order>0</order>
          <url>http://www.yellowpages.ca/bus/Quebec/Montreal/Centre-de-Recherche-Informatique-de-Montreal/334711.html?AFC-2BI478746688</url>
          <label>See more information about this merchant in YellowPages.ca</label>
        </sponsored_link>
        <sponsored_link>
          <order>1</order>
          <url>http://yellowpages.ca/search/si/1/computer/montreal?AFC-2BI478746688</url>

          <label>Find computer in Montreal in YellowPages.ca</label>
        </sponsored_link>
      </sponsored_links>
      <votes>
        <neg_count>0</neg_count>
        <score>100</score>
        <pos_count>5</pos_count>

        <count>5</count>
      </votes>
      <tag_count>9</tag_count>
      <stat_links>
        <stat_link>
          <url>http://ca.stats.praized.com/ping?t=1219981500.42266</url>
        </stat_link>

      </stat_links>
      <tags>
        <tag>
          <name>computer</name>
        </tag>
        <tag>
          <name>training</name>
        </tag>

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
          <name>laboratories</name>
        </tag>
        <tag>
          <name>research</name>
        </tag>
        <tag>

          <name>development</name>
        </tag>
        <tag>
          <name>crim</name>
        </tag>
      </tags>
      <url nil="true"></url>
      <comment_count>1</comment_count>

      <business_hours nil="true"></business_hours>
      <description nil="true"></description>
      <phone>(514)8401234</phone>
      <fax nil="true"></fax>
      <target>
        <favorite>false</favorite>
      </target>
      <location>

        <city>
          <name>Montreal</name>
          <code>MTL</code>
          <name_fr>Montreal</name_fr>
        </city>
        <latitude>45.506051</latitude>
        <postal_code>H3A 1B9</postal_code>

        <regions>
          <province>Quebec</province>
        </regions>
        <country>
          <name>Canada</name>
          <code>CA</code>
          <name_fr>Canada</name_fr>

        </country>
        <street_address>550 Sherbrooke O Bur.100</street_address>
        <longitude>-73.572552</longitude>
      </location>
      <created_at>2008-06-30T17:35:48Z</created_at>
      <email nil="true"></email>
    </merchant>

  </vote>

  <vote>
    <rating>pos</rating>
    <user>
      <login>fprefect</login>
    </user>

    <merchant>
      <permalink>http://praized.com/places/ca/quebec/montreal/restaurant</permalink>
      <pid>4babe6d18a7354cd9d0c652996b683e9</pid>
      <name>Osaka Restaurant</name>
      <updated_at>2008-08-24T19:44:42Z</updated_at>
      <favorite_count>1</favorite_count>

      <sponsored_links>
        <sponsored_link>
          <order>0</order>
          <url>http://www.yellowpages.ca/bus/Quebec/Montreal/Restaurant/0000000.html?AFC-2BI478746688</url>
          <label>See more information about this merchant in YellowPages.ca</label>
        </sponsored_link>

        <sponsored_link>

          <order>1</order>
          <url>http://yellowpages.ca/search/si/1/outings/montreal?0000000000</url>
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
      <stat_links>
        <stat_link>

          <url>http://ca.stats.praized.com/ping?t=000000000</url>
        </stat_link>
      </stat_links>
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

      <url nil="true"></url>
      <comment_count>1</comment_count>
      <business_hours nil="true"></business_hours>
      <description nil="true"></description>
      <phone>(514)8493438</phone>
      <fax nil="true"></fax>
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
        <latitude>42.50802</latitude>
        <postal_code>HOH OHO</postal_code>
        <regions>
          <province>Quebec</province>
        </regions>
        <country>

          <name>Canada</name>
          <code>CA</code>
          <name_fr>Canada</name_fr>
        </country>
        <street_address>2137, rue de xxxxxx</street_address>
        <longitude>-73.00000</longitude>

      </location>
      <created_at>2008-08-24T19:42:11Z</created_at>
      <email nil="true"></email>
    </merchant>
  </vote>

 ...

  <vote>
    <rating>pos</rating>
    <user>
      <login>fprefect</login>
    </user>

    <merchant>
      <permalink>http://praized.com/places/ca/quebec/montreal/restaurant</permalink>
      <pid>4babe6d18a7354cd9d0c652996b683e9</pid>
      <name>Restaurant</name>
      <updated_at>2008-08-24T19:44:42Z</updated_at>
      <favorite_count>1</favorite_count>

      <sponsored_links>
        <sponsored_link>
          <order>0</order>
          <url>http://www.yellowpages.ca/bus/Quebec/Montreal/Restaurant/2446710.html?AFC-2BI478746688</url>
          <label>See more information about this merchant in YellowPages.ca</label>
        </sponsored_link>
        <sponsored_link>

          <order>1</order>
          <url>http://yellowpages.ca/search/si/1/outings/montreal?AFC-2BI478746688</url>
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
      <stat_links>
        <stat_link>

          <url>http://ca.stats.praized.com/ping?t=1219981501.07330</url>
        </stat_link>
      </stat_links>
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

      <url nil="true"></url>
      <comment_count>1</comment_count>
      <business_hours nil="true"></business_hours>
      <description nil="true"></description>
      <phone>(514)8493438</phone>
      <fax nil="true"></fax>
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
        <latitude>45.50802</latitude>
        <postal_code>HOH OHO</postal_code>
        <regions>
          <province>Quebec</province>
        </regions>
        <country>

          <name>Canada</name>
          <code>CA</code>
          <name_fr>Canada</name_fr>
        </country>
        <street_address>2137, rue de xxxxxx</street_address>
        <longitude>-73.570559</longitude>

      </location>
      <created_at>2008-08-24T19:42:11Z</created_at>
      <email nil="true"></email>
    </merchant>
  </vote>
</votes>
</praized>


```

### JSON ###

```

{
   "praized":{
      "pagination":{
         "per_page":"10",
         "page_count":"1",
         "total_entries":"9",
         "current_page":"1"
      },
      "votes":[
         {
            "rating":"pos",
            "user":{
               "login":"fprefect"
            },
            "merchant":{
               "permalink":"http://praized.com/places/ca/quebec/montreal/centre-de-recherche-informatique-de-montreal",
               "pid":"a133ee3f7b7219f0a7797cd079221f60",
               "name":"Centre de Recherche Informatique de Montr\u00e9al",
               "updated_at":"2008/06/30 17:36:04 +0000",
               "favorite_count":"2",
               "sponsored_links":[
                  {
                     "order":"0",
                     "url":"http://www.yellowpages.ca/bus/Quebec/Montreal/Centre-de-Recherche-Informatique-de-Montreal/334711.html?AFC-2BI478746688",
                     "label":"See more information about this merchant in YellowPages.ca"
                  },
                  {
                     "order":"1",
                     "url":"http://yellowpages.ca/search/si/1/computer/montreal?AFC-2BI478746688",
                     "label":"Find computer in Montreal in YellowPages.ca"
                  }
               ],
               "votes":{
                  "neg_count":"0",
                  "score":"100",
                  "pos_count":"5",
                  "count":"5"
               },
               "tag_count":"9",
               "stat_links":[
                  {
                     "url":"http://ca.stats.praized.com/ping?t=1219982633.69689"
                  }
               ],
               "tags":[
                  {
                     "name":"computer"
                  },
                  {
                     "name":"training"
                  },
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
                     "name":"laboratories"
                  },
                  {
                     "name":"research"
                  },
                  {
                     "name":"development"
                  },
                  {
                     "name":"crim"
                  }
               ],
               "url":null,
               "comment_count":"1",
               "business_hours":null,
               "description":null,
               "phone":"(514)8401234",
               "fax":null,
               "target":{
                  "favorite":"false"
               },
               "location":{
                  "city":{
                     "name":"Montreal",
                     "code":"MTL",
                     "name_fr":"Montreal"
                  },
                  "latitude":45.506051,
                  "postal_code":"H3A 1B9",
                  "regions":{
                     "province":"Quebec"
                  },
                  "country":{
                     "name":"Canada",
                     "code":"CA",
                     "name_fr":"Canada"
                  },
                  "street_address":"550 Sherbrooke O Bur.100",
                  "longitude":-73.572552
               },
               "created_at":"2008/06/30 17:35:48 +0000",
               "email":null
            }
         },
         {
            "rating":"pos",
            "user":{
               "login":"fprefect"
            },
            "merchant":{
               "permalink":"http://praized.com/places/ca/quebec/montreal/auberge-du-dragon-rouge",
               "pid":"8b01b2d591de4fe7b515ad338ff90389",
               "name":"Auberge Du Dragon Rouge",
               "updated_at":"2008/07/01 00:31:34 +0000",
               "favorite_count":"0",
               "sponsored_links":[
                  {
                     "order":"0",
                     "url":"http://www.yellowpages.ca/bus/Quebec/Montreal/Auberge-Du-Dragon-Rouge/2103257.html?AFC-2BI478746688",
                     "label":"See more information about this merchant in YellowPages.ca"
                  },
                  {
                     "order":"1",
                     "url":"http://yellowpages.ca/search/si/1/restaurants/montreal?AFC-2BI478746688",
                     "label":"Find restaurants in Montreal in YellowPages.ca"
                  }
               ],
               "votes":{
                  "neg_count":"1",
                  "score":"93",
                  "pos_count":"15",
                  "count":"16"
               },
               "tag_count":"5",
               "stat_links":[
                  {
                     "url":"http://ca.stats.praized.com/ping?t=1219982633.74095"
                  }
               ],
               "tags":[
                  {
                     "name":"restaurants"
                  },
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
                     "name":"caterers"
                  }
               ],
               "url":null,
               "comment_count":"1",
               "business_hours":null,
               "description":null,
               "phone":"(514)8585711",
               "fax":null,
               "target":{
                  "favorite":"false"
               },
               "location":{
                  "city":{
                     "name":"Montreal",
                     "code":"MTL",
                     "name_fr":"Montreal"
                  },
                  "latitude":45.547664,
                  "postal_code":"H2M 1R6",
                  "regions":{
                     "province":"Quebec"
                  },
                  "country":{
                     "name":"Canada",
                     "code":"CA",
                     "name_fr":"Canada"
                  },
                  "street_address":"8870, rue Lajeunesse",
                  "longitude":-73.642183
               },
               "created_at":"2008/07/01 00:31:34 +0000",
               "email":null
            }
         },

         {
            "rating":"pos",
            "user":{
               "login":"fprefect"
            },
            "merchant":{
               "permalink":"http://praized.com/places/ca/quebec/montreal/societe-des-arts-technologiques-sat",
               "pid":"96423266cd5145552decb67454b13e4e",
               "name":"Societe Des Arts Technologiques (SAT)",
               "updated_at":"2008/06/27 19:25:55 +0000",
               "favorite_count":"15",
               "sponsored_links":[
                  {
                     "order":"0",
                     "url":"http://www.yellowpages.ca/bus/Quebec/Montreal/Societe-Des-Arts-Technologiques-SAT-/2542153.html?AFC-2BI478746688",
                     "label":"See more information about this merchant in YellowPages.ca"
                  },
                  {
                     "order":"1",
                     "url":"http://yellowpages.ca/search/si/1/arts/montreal?AFC-2BI478746688",
                     "label":"Find arts in Montreal in YellowPages.ca"
                  }
               ],
               "votes":{
                  "neg_count":"1",
                  "score":"98",
                  "pos_count":"89",
                  "count":"90"
               },
               "tag_count":"9",
               "stat_links":[
                  {
                     "url":"http://ca.stats.praized.com/ping?t=1219982634.03809"
                  }
               ],
               "tags":[
                  {
                     "name":"arts"
                  },
                  {
                     "name":"cultural"
                  },
                  {
                     "name":"organizations"
                  },
                  {
                     "name":"culture"
                  },
                  {
                     "name":"web"
                  },
                  {
                     "name":"technology"
                  },
                  {
                     "name":"internet"
                  },
                  {
                     "name":"dj"
                  },
                  {
                     "name":"vj"
                  }
               ],
               "url":null,
               "comment_count":"7",
               "business_hours":null,
               "description":null,
               "phone":"(514)8442033",
               "fax":null,
               "target":{
                  "rating":"pos",
                  "favorite":"false"
               },
               "location":{
                  "city":{
                     "name":"Montreal",
                     "code":"MTL",
                     "name_fr":"Montreal"
                  },
                  "latitude":45.509334,
                  "postal_code":"H2X 2S6",
                  "regions":{
                     "province":"Quebec"
                  },
                  "country":{
                     "name":"Canada",
                     "code":"CA",
                     "name_fr":"Canada"
                  },
                  "street_address":"1195, boulevard Saint-Laurent",
                  "longitude":-73.562672
               },
               "created_at":"2008/04/04 18:13:46 +0000",
               "email":null
            }
         },

...

         
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


Continue to [Getting users friends](GET_User_Friends.md)

Back to [Getting users favorites](GET_User_Favorites.md)

Up to [Our Index](API.md)