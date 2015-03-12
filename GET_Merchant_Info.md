# Getting a merchant page #

## Request Format ##

```
http://api.praized.com/{community_slug}/merchants/{merchant_pid}.{format}?api_key={your api key}
```

## Arguments ##

### {merchant\_pid} ###

The unique identifier for a merchant.

format : string

ex : 96423266cd5145552decb67454b13e4e

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

<merchant>
  <permalink>http://praized.com/places/ca/quebec/montreal/societe-des-arts-technologiques-sat</permalink>
  <pid>96423266cd5145552decb67454b13e4e</pid>
  <name>Societe Des Arts Technologiques (SAT)</name>
  <updated_at>2008-06-27T19:25:55Z</updated_at>
  <favorite_count>15</favorite_count>
  <sponsored_links>

    <sponsored_link>
      <order>0</order>
      <url>http://www.yellowpages.ca/bus/Quebec/Montreal/Societe-Des-Arts-Technologiques-SAT-/2542153.html?AFC-2BI478746688</url>
      <label>See more information about this merchant in YellowPages.ca</label>
    </sponsored_link>
    <sponsored_link>
      <order>1</order>

      <url>http://yellowpages.ca/search/si/1/arts/montreal?AFC-2BI478746688</url>
      <label>Find arts in Montreal in YellowPages.ca</label>
    </sponsored_link>
  </sponsored_links>
  <votes>
    <neg_count>1</neg_count>
    <score>98</score>

    <pos_count>89</pos_count>
    <count>90</count>
  </votes>
  <tag_count>9</tag_count>
  <stat_links>
    <stat_link>
      <url>http://ca.stats.praized.com/ping?t=1219974134.49459</url>

    </stat_link>
  </stat_links>
  <tags>
    <tag>
      <name>arts</name>
    </tag>
    <tag>
      <name>cultural</name>

    </tag>
    <tag>
      <name>organizations</name>
    </tag>
    <tag>
      <name>culture</name>
    </tag>
    <tag>

      <name>web</name>
    </tag>
    <tag>
      <name>technology</name>
    </tag>
    <tag>
      <name>internet</name>

    </tag>
    <tag>
      <name>dj</name>
    </tag>
    <tag>
      <name>vj</name>
    </tag>
  </tags>

  <url nil="true"></url>
  <comment_count>7</comment_count>
  <business_hours nil="true"></business_hours>
  <description nil="true"></description>
  <phone>(514)8442033</phone>
  <fax nil="true"></fax>
  <location>
    <city>

      <name>Montreal</name>
      <code>MTL</code>
      <name_fr>Montreal</name_fr>
    </city>
    <postal_code>H2X 2S6</postal_code>
    <latitude>45.509334</latitude>

    <regions>
      <province>Quebec</province>
    </regions>
    <country>
      <name>Canada</name>
      <code>CA</code>
      <name_fr>Canada</name_fr>

    </country>
    <street_address>1195, boulevard Saint-Laurent</street_address>
    <longitude>-73.562672</longitude>
  </location>
  <created_at>2008-04-04T18:13:46Z</created_at>
  <email nil="true"></email>
</merchant>
</praized>
```

### JSON ###

```
{"praized": 
	{"community": 
				{"base_url": "http://praized.com/",
				 "slug": "praized-com-hub", 
				 "name": "praized.com hub", 
				 "home_url": "http://praized.com/"
				 }, 
	 "merchant": 
	       {"permalink": "http://praized.com/places/ca/quebec/montreal/societe-des-arts-technologiques-sat", 
	        "pid": "96423266cd5145552decb67454b13e4e", 
	        "name": "Societe Des Arts Technologiques (SAT)", 
	        "favorite_count": "15", 
	        "updated_at": "2008/06/27 19:25:55 +0000", 
	        "sponsored_links":
	              [{"order": "0", 
	                "url": "http://www.yellowpages.ca/bus/Quebec/Montreal/Societe-Des-Arts-Technologiques-SAT-/2542153.html?AFC-2BI478746688", 
	                "label": "See more information about this merchant in YellowPages.ca"
	                }, 
	                {"order": "1", 
	                 "url": "http://yellowpages.ca/search/si/1/arts/montreal?AFC-2BI478746688",
	                 "label": "Find arts in Montreal in YellowPages.ca"
	                }
	               ],
	        "votes": 
	             {"neg_count": "1", 
	              "score": "98", 
	              "pos_count": "89", 
	              "count": "90"
	             }, 
	        "tag_count": "9", 
	        "tags": [{"name": "arts"}, 
	                 {"name": "cultural"},
	                 {"name": "organizations"}, 
	                 {"name": "culture"}, 
	                 {"name": "web"}, 
	                 {"name": "technology"}, 
	                 {"name": "internet"}, 
	                 {"name": "dj"}, 
	                 {"name": "vj"
	                 }], 
	        "stat_links": [{"url": "http://ca.stats.praized.com/ping?t=1219874280.23980"}], 
	        "url": null, 
	        "comment_count": "7", 
	        "business_hours": null, 
	        "description": null, 
	        "fax": null, 
	        "phone": "(514)8442033", 
	        "location": {"city": {"name": "Montreal", 
	                              "code": "MTL", 
	                              "name_fr": "Montreal"
	                              }, 
	        "postal_code": "H2X 2S6", 
	        "latitude": 45.509334, 
	        "regions": {"province": "Quebec"},
	        "country": {"name": "Canada", "code": "CA", "name_fr": "Canada"},
	        "street_address": "1195, boulevard Saint-Laurent", 
	        "longitude": -73.562672}, 
	        "created_at": "2008/04/04 18:13:46 +0000", 
	        "email": null
	        }
	  }
}

```



---


Continue to [Getting votes for a merchant](GET_Merchant_Votes.md)

Back to [Searching for merchants within a community](GET_Merchant_Search.md)

Up to [Our Index](API.md)