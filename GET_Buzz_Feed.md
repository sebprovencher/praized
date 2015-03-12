# Getting a Praized Buzz Feed #

## Request format ##
```
http://api.praized.com/{community_slug}/actions.{format}?page={page number}&per_page={number}&api_key={your api key}
```
## Arguments ##

### page ###

No of the requested page

format : unsigned integer

### per\_page ###

Number of request per page

format : unsigned integer

## Response Format ##

Note: this specific call can also be served in ATOM by using the actions.atom format

### XML ###

```

<?xml version="1.0" encoding="UTF-8"?>
<praized>
  <community>
    <home_url>http://dev.praized.com/</home_url>
    <base_url>http://dev.praized.com/</base_url>
    <name>dev.praized.com</name>
    <slug>dev-praized</slug>
  </community>

  <pagination>
    <current_page>1</current_page>
    <page_count>4</page_count>
    <per_page>25</per_page>
    <total_entries>80</total_entries>
  </pagination>
<actions>

  <action>
    <targets>
      <target>
        <vote>
          <user>
            <login>francois</login>
            <address>
              <city nil="true"></city>

              <regions nil="true"></regions>
            </address>
          </user>
          <vote>true</vote>
        </vote>
      </target>
    </targets>
    <summary>&lt;span class="buzz-icon voted-for"&gt;Voter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://dev.praized.com/users/francois"&gt;Francois Lafortune&lt;/a&gt; praized &lt;a href="http://dev.praized.com/places/us/california/san-francisco/bobos-the-steak-the-crab"&gt;Bobos The Steak The Crab&lt;/a&gt; in San Francisco.&lt;/span&gt;</summary>

    <action_type>
      <type_name>praized</type_name>
    </action_type>
    <created_at>2008-09-12T17:43:24Z</created_at>
  </action>
  <action>
    <targets>
      <target>

        <comment>
          <user>
            <login>colin</login>
          </user>
          <comment>test</comment>
          <created_at>2008-09-11T16:04:13Z</created_at>
        </comment>

      </target>
    </targets>
    <summary>&lt;span class="buzz-icon commented"&gt;Commenter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://dev.praized.com/users/colin"&gt;Colin Surprenant&lt;/a&gt; commented on &lt;a href="http://dev.praized.com/places/ca/saskatchewan/leoville/surprenants-general-store"&gt;Surprenant'S General Store&lt;/a&gt; in Leoville.&lt;/span&gt;</summary>

    <action_type>
      <type_name>comment</type_name>
    </action_type>
    <created_at>2008-09-11T16:04:17Z</created_at>
  </action>
  <action>
    <targets>
      <target>

        <comment>
          <user>
            <login>colin</login>
          </user>
          <comment>Yay!</comment>
          <created_at>2008-09-11T16:03:36Z</created_at>
        </comment>

      </target>
    </targets>
    <summary>&lt;span class="buzz-icon commented"&gt;Commenter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://dev.praized.com/users/colin"&gt;Colin Surprenant&lt;/a&gt; commented on &lt;a href="http://dev.praized.com/places/ca/quebec/montreal/depanneur-surprenant"&gt;D&#233;panneur Surprenant&lt;/a&gt; in Montreal.&lt;/span&gt;</summary>

    <action_type>
      <type_name>comment</type_name>
    </action_type>
    <created_at>2008-09-11T16:03:38Z</created_at>
  </action>


...



</praized>

```


### JSON ###

```

{
   "praized":{
      "actions":[
         {
            "summary":"\u003Cspan class=\"buzz-icon voted-for\"\u003EVoter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://dev.praized.com/users/colin\"\u003EColin Surprenant\u003C/a\u003E praized \u003Ca href=\"http://dev.praized.com/places/ca/quebec/chertsey/patate-marco\"\u003EPatate Marco\u003C/a\u003E in Chertsey.\u003C/span\u003E",
            "targets":[
               {
                  "vote":{
                     "user":{
                        "login":"colin"
                     },

                     "vote":true
                  }
               }
            ],
            "action_type":{
               "type_name":"praized"
            },
            "created_at":"2008/09/11 15:30:07 +0000"
         },
         {
            "summary":"\u003Cspan class=\"buzz-icon commented\"\u003ECommenter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://dev.praized.com/users/colin\"\u003EColin Surprenant\u003C/a\u003E commented on \u003Ca href=\"http://dev.praized.com/places/us/michigan/bad-axe/city-of-bad-axe\"\u003ECity Of Bad Axe\u003C/a\u003E in Bad Axe.\u003C/span\u003E",
            "targets":[
               {
                  "comment":{
                     "user":{
                        "login":"colin"
                     },
                     "comment":"test",
                     "created_at":"2008/09/11 15:29:46 +0000"
                  }
               }
            ],
            "action_type":{
               "type_name":"comment"
            },
            "created_at":"2008/09/11 15:29:49 +0000"
         },
         {
            "summary":"\u003Cspan class=\"buzz-icon commented\"\u003ECommenter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://dev.praized.com/users/colin\"\u003EColin Surprenant\u003C/a\u003E commented on \u003Ca href=\"http://dev.praized.com/places/ca/quebec/montreal/w-montreal\"\u003EW Montreal\u003C/a\u003E in Montreal.\u003C/span\u003E",
            "targets":[
               {
                  "comment":{
                     "user":{
                        "login":"colin"
                     },
                     "comment":"test",
                     "created_at":"2008/09/11 15:29:10 +0000"
                  }
               }
            ],
            "action_type":{
               "type_name":"comment"
            },
            "created_at":"2008/09/11 15:29:12 +0000"
         },
         {
            "summary":"\u003Cspan class=\"buzz-icon commented\"\u003ECommenter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://dev.praized.com/users/colin\"\u003EColin Surprenant\u003C/a\u003E commented on \u003Ca href=\"http://dev.praized.com/places/ca/quebec/montreal/inter-continental-hotel-montreal\"\u003EInter-Continental Hotel Montr\u00e9al\u003C/a\u003E in Montreal.\u003C/span\u003E",
            "targets":[
               {
                  "comment":{
                     "user":{
                        "login":"colin"
                     },
                     "comment":"test",
                     "created_at":"2008/09/11 15:28:45 +0000"
                  }
               }
            ],
            "action_type":{
               "type_name":"comment"
            },
            "created_at":"2008/09/11 15:28:50 +0000"
         },


....

   }
}

```



---


Continue to [Getting a user feed](GET_User_Feed.md)

Back to [Adding / Removing a user as a friend of the currently logged user](POST_User_Friends.md)

Up to [Our Index](API.md)