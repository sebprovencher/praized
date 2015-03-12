# Getting comments for a merchant #

## Request Format ##

```
http://api.praized.com/{community_slug}/merchants/{merchant_pid}/comments.{format}?api_key={your api key}
```
## Arguments ##

### {merchant\_pid} ###

The unique identifier for a merchant.

format : string

ex : 96423266cd5145552decb67454b13e4e

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
    <total_entries>7</total_entries>
    <current_page>1</current_page>
  </pagination>
<comments>

  <comment>
    <user>
      <login>AtHomewithKimVallee</login>
    </user>
    <comment>An excellent place to host a multimedia event or an average size business conference. The bar makes it more fun and relaxed than the typical conference place.</comment>
    <created_at>2008-07-13T19:57:53Z</created_at>
  </comment>

  <comment>
    <user>
      <login>RobMtl007</login>
    </user>
    <comment>The sound at the SAT is exceptional, very clear.I love to attend the Technology events at the SAT, you meet so many people.The food is great too.</comment>
    <created_at>2008-07-13T19:21:18Z</created_at>
  </comment>

  <comment>
    <user>
      <address>
        <city nil="true"></city>
        <regions nil="true"></regions>
      </address>
      <login>spro</login>
    </user>

    <comment>Pecha Kucha #6 - Summer edition - &#201;dition estivale, Wednesday, July 9, 8:00pm - 10:30pm, http://www.facebook.com/profile.php?id=710767190</comment>
    <created_at>2008-07-04T19:46:58Z</created_at>
  </comment>
  <comment>
    <user>
      <login>coolfusion</login>
    </user>

    <comment>Startup Camp Montreal is also held at la SAT.</comment>
    <created_at>2008-07-03T22:56:35Z</created_at>
  </comment>
  <comment>
    <user>
      <address>
        <city nil="true"></city>
        <regions nil="true"></regions>

      </address>
      <login>francois</login>
    </user>
    <comment>They have "rave" nights there too.</comment>
    <created_at>2008-06-30T18:06:19Z</created_at>
  </comment>
  <comment>

    <user>
      <address>
        <city nil="true"></city>
        <regions nil="true"></regions>
      </address>
      <login>scarle</login>
    </user>
    <comment>Barcamp Montreal is usually there too.</comment>

    <created_at>2008-06-28T04:26:26Z</created_at>
  </comment>
  <comment>
    <user>
      <address>
        <city nil="true"></city>
        <regions nil="true"></regions>
      </address>

      <login>spro</login>
    </user>
    <comment>We held the FacebookCamp Montreal there.</comment>
    <created_at>2008-06-27T22:50:32Z</created_at>
  </comment>
</comments>
</praized>

```

### JSON ###

```

{"praized": 
	{"comments": [{"user": 
					{"login": "AtHomewithKimVallee"}, 
				  "comment": "An excellent place to host a multimedia event or an average size business conference. The bar makes it more fun and relaxed than the typical conference place.",
				  "created_at": 
				  "2008/07/13 19:57:53 +0000"}, 
				  {"user": 
				     {"login": "RobMtl007"},
				   "comment": "The sound at the SAT is exceptional, very clear.I love to attend the Technology events at the SAT, you meet so many people.The food is great too.", 
				   "created_at": "2008/07/13 19:21:18 +0000"}, 
				  {"user": 
				      {"address": {"city": null, "regions": null}, 
				       "login": "spro"}, 
				   "comment": "Pecha Kucha #6 - Summer edition - \u00c9dition estivale, Wednesday, July 9, 8:00pm - 10:30pm,, 
				   "created_at": "2008/07/04 19:46:58 +0000"},
				  {"user": {"login": "coolfusion"}, 
				   "comment": "Startup Camp Montreal is also held at la SAT.", 
				   "created_at": "2008/07/03 22:56:35 +0000"}, 
				   
				   ....
				   
				   ],
	 "community": {"slug": "praized-com-hub", 
	               "name": "praized.com hub", 
	               "home_url": "http://praized.com/", 
	               "base_url": "http://praized.com/"}, 
	 "pagination": {"per_page": "10", 
	                 "page_count": "1",
	                 "total_entries": "7", 
	                 "current_page": "1"
	                }
	   }
}

```



---


Continue to [Getting users that bookmarked a merchant](GET_Merchant_Favorites_Users.md)

Back to [Getting votes for a merchant](GET_Merchant_Votes.md)

Up to [Our Index](API.md)