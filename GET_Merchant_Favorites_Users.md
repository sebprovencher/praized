# Getting users that bookmarked a merchant #

## Request Format ##
```
http://api.praized.com/{community_slug}/merchants/{merchant_pid}/favorites.{format}?api_key={your api key}
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
    <page_count>2</page_count>
    <total_entries>15</total_entries>
    <current_page>1</current_page>
  </pagination>
<users>

  <user>
    <updated_at>2008-08-26T15:16:10Z</updated_at>
    <gender nil="true"></gender>
    <about>Phrase</about>
    <first_name>Ford</first_name>
    <date_of_birth nil="true"></date_of_birth>
    <last_name>Prefect</last_name>

    <address>
      <city>
        <name>Montreal</name>
        <code>MTL</code>
        <name_fr>Montreal</name_fr>
      </city>
      <postal_code nil="true"></postal_code>

      <latitude>99.99999</latitude>
      <regions nil="true"></regions>
      <street_address nil="true"></street_address>
      <longitude>-99.0000</longitude>
    </address>
    <claim_to_fame>UserID=1</claim_to_fame>
    <login>fprefect</login>

    <created_at>2006-11-22T21:37:30Z</created_at>
  </user>
 .....
</users>
</praized>

```

### JSON ###

```

{"praized": 
	{"pagination": 
		{"per_page": "10", 
		 "page_count": "2", 
		 "total_entries": "15", 
		 "current_page": "1"
		}, 
	  "community": 
	  	{"base_url": "http://praized.com/", 
	  	 "slug": "praized-com-hub",
	  	 "name": "praized.com hub", 
	  	 "home_url": "http://praized.com/"
	  	}, 
	  "users": [{"updated_at": "2008/08/26 15:16:10 +0000", 
	             "gender": null, 
	             "about": "Field researcher for the guide", 
	             "first_name": "Ford", 
	             "date_of_birth": null, 
	             "last_name": "Prefect", 
	             "claim_to_fame": "UserID=1", 
	             "address": {"city": 
	             				{"name": "Montreal", 
	             				 "code": "MTL", 
	             				 "name_fr": 
	             				 "Montreal"
	             				 }, 
	             "postal_code": null, 
	             "latitude": 99.999999, 
	             "regions": null, 
	             "street_address": null, 
	             "longitude": -99.999999}, 
	             "login": "fprefect", 
	             "created_at": "2006/11/22 21:37:30 +0000"}, 
	             
	             ....
	             
				]
	}
}

```



---


Continue to [Getting tags for a merchant](GET_Merchant_Tags.md)

Back to [Getting comments for a merchant](GET_Merchant_Comments.md)

Up to [Our Index](API.md)