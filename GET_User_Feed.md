# Getting a User Feed #

## Request format ##
```
http://api.praized.com/{community_slug}/users/{user_login}/actions.{format}?page={page number}&per_page={number}&api_key={your api key}
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

Note that this format is not an RSS or Atom format, you must transform it to get the proper feed format.

### XML ###

```

<?xml version="1.0" encoding="UTF-8"?>
<praized>
  <community>
    <name>Api Tribe</name>
    <base_url>http://api-tribe.com/praized/</base_url>
    <home_url>http://api-tribe.com/</home_url>
    <slug>apitribe</slug>
  </community>

  <pagination>
    <page_count>2</page_count>
    <per_page>10</per_page>
    <total_entries>11</total_entries>
    <current_page>1</current_page>
  </pagination>
<actions>

  <action>
    <targets>
      <target>
        <comment>
          <user>
            <login>fprefect</login>
          </user>
          <comment>This is another comment</comment>

          <created_at>2008-09-17T21:36:16Z</created_at>
        </comment>
      </target>
    </targets>
    <summary>&lt;span class="buzz-icon commented"&gt;Commenter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://api-tribe.com/praized/users/fprefect"&gt;Ford Prefect&lt;/a&gt; commented on &lt;a href="http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0"&gt;Sushi Restaurant&lt;/a&gt; in Montreal, Quebec.&lt;/span&gt;</summary>

    <action_type>
      <type_name>comment</type_name>
    </action_type>
    <created_at>2008-09-17T21:36:18Z</created_at>
  </action>
  <action>
    <targets>
      <target>

        <comment>
          <user>
            <login>fprefect</login>
          </user>
          <comment>This is another comment</comment>
          <created_at>2008-09-17T21:36:13Z</created_at>
        </comment>

      </target>
    </targets>
    <summary>&lt;span class="buzz-icon commented"&gt;Commenter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://api-tribe.com/praized/users/fprefect"&gt;Ford Prefect&lt;/a&gt; commented on &lt;a href="http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0"&gt;Sushi Restaurant&lt;/a&gt; in Montreal, Quebec.&lt;/span&gt;</summary>

    <action_type>
      <type_name>comment</type_name>
    </action_type>
    <created_at>2008-09-17T21:36:15Z</created_at>
  </action>
  <action>
    <targets>
      <target>

        <vote>
          <user>
            <login>fprefect</login>
          </user>
          <vote>false</vote>
        </vote>
      </target>
    </targets>

    <summary>&lt;span class="buzz-icon voted-against"&gt;Voter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://api-tribe.com/praized/users/fprefect"&gt;Ford Prefect&lt;/a&gt; razed &lt;a href="http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0"&gt;Sushi Restaurant&lt;/a&gt; in Montreal, Quebec.&lt;/span&gt;</summary>

    <action_type>
      <type_name>razed</type_name>
    </action_type>
    <created_at>2008-09-17T21:31:18Z</created_at>
  </action>
  <action>
    <targets>
      <target>

        <vote>
          <user>
            <login>fprefect</login>
          </user>
          <vote>false</vote>
        </vote>
      </target>
    </targets>

    <summary>&lt;span class="buzz-icon voted-for"&gt;Voter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://api-tribe.com/praized/users/fprefect"&gt;Ford Prefect&lt;/a&gt; praized &lt;a href="http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0"&gt;Sushi Restaurant&lt;/a&gt; in Montreal, Quebec.&lt;/span&gt;</summary>

    <action_type>
      <type_name>praized</type_name>
    </action_type>
    <created_at>2008-09-17T21:29:31Z</created_at>
  </action>
  <action>
    <targets>
      <target>

        <vote>
          <user>
            <login>fprefect</login>
          </user>
          <vote>false</vote>
        </vote>
      </target>
    </targets>

    <summary>&lt;span class="buzz-icon voted-against"&gt;Voter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://api-tribe.com/praized/users/fprefect"&gt;Ford Prefect&lt;/a&gt; razed &lt;a href="http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-srestaurant/h0h0h0"&gt;Sushi Restaurant&lt;/a&gt; in Montreal, Quebec.&lt;/span&gt;</summary>

    <action_type>
      <type_name>razed</type_name>
    </action_type>
    <created_at>2008-09-17T21:25:32Z</created_at>
  </action>
  <action>
    <targets>
      <target>

        <vote>
          <user>
            <login>fprefect</login>
          </user>
          <vote>false</vote>
        </vote>
      </target>
    </targets>

    <summary>&lt;span class="buzz-icon voted-for"&gt;Voter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://api-tribe.com/praized/users/fprefect"&gt;Ford Prefect&lt;/a&gt; praized &lt;a href="http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0"&gt;Sushi restaurant&lt;/a&gt; in Montreal, Quebec.&lt;/span&gt;</summary>

    <action_type>
      <type_name>praized</type_name>
    </action_type>
    <created_at>2008-09-17T21:19:12Z</created_at>
  </action>
  <action>
    <targets>
      <target>

        <comment>
          <user>
            <login>fprefect</login>
          </user>
          <comment> &#233; Silence is foo</comment>
          <created_at>2008-09-11T20:52:43Z</created_at>

        </comment>
      </target>
    </targets>
    <summary>&lt;span class="buzz-icon commented"&gt;Commenter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://api-tribe.com/praized/users/fprefect"&gt;Ford Prefect&lt;/a&gt; commented on &lt;a href="http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0"&gt;Sushi Restaurant&lt;/a&gt; in Montreal, Quebec.&lt;/span&gt;</summary>

    <action_type>
      <type_name>comment</type_name>
    </action_type>
    <created_at>2008-09-11T20:52:45Z</created_at>
  </action>
  <action>
    <targets>
      <target>

        <comment>
          <user>
            <login>fprefect</login>
          </user>
          <comment> &#233; Silence is foo</comment>
          <created_at>2008-09-11T20:52:40Z</created_at>

        </comment>
      </target>
    </targets>
    <summary>&lt;span class="buzz-icon commented"&gt;Commenter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://api-tribe.com/praized/users/fprefect"&gt;Ford Prefect&lt;/a&gt; commented on &lt;a href="http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0"&gt;Sushi Restaurant&lt;/a&gt; in Montreal, Quebec.&lt;/span&gt;</summary>

    <action_type>
      <type_name>comment</type_name>
    </action_type>
    <created_at>2008-09-11T20:52:42Z</created_at>
  </action>
  <action>
    <targets>
      <target>

        <comment>
          <user>
            <login>fprefect</login>
          </user>
          <comment>The sushi is mostly harmless</comment>
          <created_at>2008-09-11T20:47:41Z</created_at>
        </comment>

      </target>
    </targets>
    <summary>&lt;span class="buzz-icon commented"&gt;Commenter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://api-tribe.com/praized/users/fprefect"&gt;Ford Prefect&lt;/a&gt; commented on &lt;a href="http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0"&gt;Sushi Restaurant&lt;/a&gt; in Montreal, Quebec.&lt;/span&gt;</summary>

    <action_type>
      <type_name>comment</type_name>
    </action_type>
    <created_at>2008-09-11T20:47:44Z</created_at>
  </action>
  <action>
    <targets>
      <target>

        <comment>
          <user>
            <login>fprefect</login>
          </user>
          <comment>The sushi is mostly harmless</comment>
          <created_at>2008-09-11T20:47:38Z</created_at>
        </comment>

      </target>
    </targets>
    <summary>&lt;span class="buzz-icon commented"&gt;Commenter&lt;/span&gt;&lt;span class="buzz-action"&gt; &lt;a href="http://api-tribe.com/praized/users/fprefect"&gt;Ford Prefect&lt;/a&gt; commented on &lt;a href="http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0"&gt;Sushi Restaurant&lt;/a&gt; in Montreal, Quebec.&lt;/span&gt;</summary>

    <action_type>
      <type_name>comment</type_name>
    </action_type>
    <created_at>2008-09-11T20:47:40Z</created_at>
  </action>
</actions>
</praized>


```

### JSON ###

```

{
   "praized":{
      "actions":[
         {
            "targets":[
               {
                  "comment":{
                     "user":{
                        "login":"fprefect"
                     },
                     "comment":"This is another comment",
                     "created_at":"2008/09/17 21:36:16 +0000"
                  }
               }
            ],
            "summary":"\u003Cspan class=\"buzz-icon commented\"\u003ECommenter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://api-tribe.com/praized/users/fprefect\"\u003EFord Prefect\u003C/a\u003E commented on \u003Ca href=\"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0\"\u003ESushi Restaurant\u003C/a\u003E in Montreal, Quebec.\u003C/span\u003E",
            "action_type":{
               "type_name":"comment"
            },
            "created_at":"2008/09/17 21:36:18 +0000"
         },
         {
            "targets":[
               {
                  "comment":{
                     "user":{
                        "login":"fprefect"
                     },
                     "comment":"This is another comment",
                     "created_at":"2008/09/17 21:36:13 +0000"
                  }
               }
            ],
            "summary":"\u003Cspan class=\"buzz-icon commented\"\u003ECommenter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://api-tribe.com/praized/users/fprefect\"\u003EFord Prefect\u003C/a\u003E commented on \u003Ca href=\"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0\"\u003ESushi Restaurant\u003C/a\u003E in Montreal, Quebec.\u003C/span\u003E",
            "action_type":{
               "type_name":"comment"
            },
            "created_at":"2008/09/17 21:36:15 +0000"
         },
         {
            "targets":[
               {
                  "vote":{
                     "user":{
                        "login":"fprefect"
                     },
                     "vote":false
                  }
               }
            ],
            "summary":"\u003Cspan class=\"buzz-icon voted-against\"\u003EVoter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://api-tribe.com/praized/users/fprefect\"\u003EFord Prefect\u003C/a\u003E razed \u003Ca href=\"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0\"\u003ESushi Restaurant\u003C/a\u003E in Montreal, Quebec.\u003C/span\u003E",
            "action_type":{
               "type_name":"razed"
            },
            "created_at":"2008/09/17 21:31:18 +0000"
         },
         {
            "targets":[
               {
                  "vote":{
                     "user":{
                        "login":"fprefect"
                     },
                     "vote":false
                  }
               }
            ],
            "summary":"\u003Cspan class=\"buzz-icon voted-for\"\u003EVoter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://api-tribe.com/praized/users/fprefect\"\u003EFord Prefect\u003C/a\u003E praized \u003Ca href=\"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0\"\u003ESushi Restaurant\u003C/a\u003E in Montreal, Quebec.\u003C/span\u003E",
            "action_type":{
               "type_name":"praized"
            },
            "created_at":"2008/09/17 21:29:31 +0000"
         },
         {
            "targets":[
               {
                  "vote":{
                     "user":{
                        "login":"fprefect"
                     },
                     "vote":false
                  }
               }
            ],
            "summary":"\u003Cspan class=\"buzz-icon voted-against\"\u003EVoter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://api-tribe.com/praized/users/fprefect\"\u003EFord Prefect\u003C/a\u003E razed \u003Ca href=\"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0\"\u003ESushi Restaurant\u003C/a\u003E in Montreal, Quebec.\u003C/span\u003E",
            "action_type":{
               "type_name":"razed"
            },
            "created_at":"2008/09/17 21:25:32 +0000"
         },
         {
            "targets":[
               {
                  "vote":{
                     "user":{
                        "login":"fprefect"
                     },
                     "vote":false
                  }
               }
            ],
            "summary":"\u003Cspan class=\"buzz-icon voted-for\"\u003EVoter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://api-tribe.com/praized/users/fprefect\"\u003EFord Prefect\u003C/a\u003E praized \u003Ca href=\"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0\"\u003ESushi Restaurant\u003C/a\u003E in Montreal, Quebec.\u003C/span\u003E",
            "action_type":{
               "type_name":"praized"
            },
            "created_at":"2008/09/17 21:19:12 +0000"
         },
         {
            "targets":[
               {
                  "comment":{
                     "user":{
                        "login":"fprefect"
                     },
                     "comment":"\u00e9 Silence is foo",
                     "created_at":"2008/09/11 20:52:43 +0000"
                  }
               }
            ],
            "summary":"\u003Cspan class=\"buzz-icon commented\"\u003ECommenter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://api-tribe.com/praized/users/fprefect\"\u003EFord Prefect\u003C/a\u003E commented on \u003Ca href=\"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0\"\u003ESushi Restaurant\u003C/a\u003E in Montreal, Quebec.\u003C/span\u003E",
            "action_type":{
               "type_name":"comment"
            },
            "created_at":"2008/09/11 20:52:45 +0000"
         },
         {
            "targets":[
               {
                  "comment":{
                     "user":{
                        "login":"fprefect"
                     },
                     "comment":"\u00e9 Silence is foo",
                     "created_at":"2008/09/11 20:52:40 +0000"
                  }
               }
            ],
            "summary":"\u003Cspan class=\"buzz-icon commented\"\u003ECommenter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://api-tribe.com/praized/users/fprefect\"\u003EFord Prefect\u003C/a\u003E commented on \u003Ca href=\"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0\"\u003ESushi Restaurant\u003C/a\u003E in Montreal, Quebec.\u003C/span\u003E",
            "action_type":{
               "type_name":"comment"
            },
            "created_at":"2008/09/11 20:52:42 +0000"
         },
         {
            "targets":[
               {
                  "comment":{
                     "user":{
                        "login":"fprefect"
                     },
                     "comment":"The sushi is mostly harmless",
                     "created_at":"2008/09/11 20:47:41 +0000"
                  }
               }
            ],
            "summary":"\u003Cspan class=\"buzz-icon commented\"\u003ECommenter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://api-tribe.com/praized/users/fprefect\"\u003EFord Prefect\u003C/a\u003E commented on \u003Ca href=\"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0\"\u003ESushi Restaurant\u003C/a\u003E in Montreal, Quebec.\u003C/span\u003E",
            "action_type":{
               "type_name":"comment"
            },
            "created_at":"2008/09/11 20:47:44 +0000"
         },
         {
            "targets":[
               {
                  "comment":{
                     "user":{
                        "login":"fprefect"
                     },
                     "comment":"The sushi is mostly harmless",
                     "created_at":"2008/09/11 20:47:38 +0000"
                  }
               }
            ],
            "summary":"\u003Cspan class=\"buzz-icon commented\"\u003ECommenter\u003C/span\u003E\u003Cspan class=\"buzz-action\"\u003E \u003Ca href=\"http://api-tribe.com/praized/users/fprefect\"\u003EFord Prefect\u003C/a\u003E commented on \u003Ca href=\"http://api-tribe.com/praized/places/ca/quebec/montreal/sushi-restaurant/h0h0h0\"\u003ESushi Restaurant\u003C/a\u003E in Montreal, Quebec.\u003C/span\u003E",
            "action_type":{
               "type_name":"comment"
            },
            "created_at":"2008/09/11 20:47:40 +0000"
         }
      ],
      "pagination":{
         "page_count":"2",
         "per_page":"10",
         "total_entries":"11",
         "current_page":"1"
      },
      "community":{
         "name":"Api Tribe",
         "base_url":"http://api-tribe.com/praized/",
         "home_url":"http://api-tribe.com/",
         "slug":"apitribe"
      }
   }
}

```



---


Continue to [API-tribe](APITribe.md)

Back to [Getting a Praized Buzz Feed](GET_Buzz_Feed.md)

Up to [Our Index](API.md)