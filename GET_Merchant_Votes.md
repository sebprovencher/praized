# Getting votes for a merchant #
## Request Format ##
```
http://api.praized.com/{community_slug}/merchants/{merchant_pid}/votes.{format}?api_key={your api key}
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
    <page_count>9</page_count>
    <total_entries>90</total_entries>
    <current_page>1</current_page>
  </pagination>
<votes>

  <vote>
    <rating>pos</rating>
    <user>
      <login>fprefect</login>
    </user>
  </vote>
  <vote>
    <rating>pos</rating>

    <user>
      <login>sammyQc</login>
    </user>
  </vote>
  <vote>
    <rating>pos</rating>
    <user>
      <login>cguy</login>

    </user>
  </vote>
  <vote>
    <rating>pos</rating>
    <user>
      <login>ileanagv</login>
    </user>
  </vote>

  <vote>
    <rating>pos</rating>
    <user>
      <login>portalis</login>
    </user>
  </vote>
  <vote>
    <rating>pos</rating>

    <user>
      <address>
        <city nil="true"></city>
        <regions nil="true"></regions>
      </address>
      <login>dadysson</login>
    </user>
  </vote>

  <vote>
    <rating>pos</rating>
    <user>
      <address>
        <city nil="true"></city>
        <regions nil="true"></regions>
      </address>
      <login>quickredfox</login>

    </user>
  </vote>
  <vote>
    <rating>pos</rating>
    <user>
      <address>
        <city nil="true"></city>
        <regions nil="true"></regions>

      </address>
      <login>tmcg</login>
    </user>
  </vote>
  <vote>
    <rating>pos</rating>
    <user>
      <login>crsh1976</login>

    </user>
  </vote>
  <vote>
    <rating>pos</rating>
    <user>
      <login>Godot</login>
    </user>
  </vote>

</votes>
</praized>
```

### JSON ###

```

{"praized": 
	{"votes": [{"rating": "pos", 
				"user": {"login": "fprefect"}
			   }, 
			   {"rating": "pos", 
			    "user": {"login": "sammyQc"}}, 
				.... ] ,
	 "community": {"slug": "praized-com-hub", 
	               "name": "praized.com hub", 
	               "home_url": "http://praized.com/", 
	               "base_url": "http://praized.com/"},
	 "pagination": {"per_page": "10", 
	                "page_count": "9", 
	                "total_entries": "90", 
	                "current_page": "1"}
	 }
}

```



---


Continue to [Getting comments for a merchant](GET_Merchant_Comments.md)

Back to  [Getting a merchant page](GET_Merchant_Info.md)

Up to [Our Index](API.md)