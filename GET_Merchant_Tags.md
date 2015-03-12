# Getting tags for a merchant #

## Request Format ##
```
http://api.praized.com/{community_slug}/merchants/{merchant_pid}/tags.{format}?api_key={your api key}
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
</praized>


```

### JSON ###
```
{"praized": 
	{"community": 
		{"slug": "praized-com-hub", 
		 "name": "praized.com hub", 
		 "home_url": "http://praized.com/", 
		 "base_url": "http://praized.com/"},
	  "tags": [{"name": "arts"}, 
	           {"name": "cultural"}, 
	           {"name": "organizations"}, 
	           {"name": "culture"}, 
	           {"name": "web"}, 
	           {"name": "technology"}, 
	           {"name": "internet"}, 
	           {"name": "dj"}, 
	           {"name": "vj"}], 
	  "pagination": 
	  	{"per_page": "10", 
	  	 "page_count": "1", 
	  	 "total_entries": "9", 
	  	 "current_page": "1"}
	 }
}

```



---


Continue to [Voting for a merchant](POST_Merchant_Vote.md)

Back to [Getting users that bookmarked a merchant](GET_Merchant_Favorites_Users.md)

Up to [Our Index](API.md)