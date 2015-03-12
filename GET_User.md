# Getting user information #

## Request Format ##
```
http://api.praized.com/{community_slug}/users/{user_login}.{format}?api_key={your api key}
```
## Arguments ##

### {user\_login} ###

The login of the user

format : string

ex : fprefect

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

<user>
  <updated_at>2008-08-07T20:57:32Z</updated_at>
  <favorite_count>1</favorite_count>
  <comment_count>1</comment_count>
  <gender nil="true"></gender>
  <about nil="true"></about>
  <friend_count>0</friend_count>

  <first_name>Ford</first_name>
  <vote_count>9</vote_count>
  <date_of_birth nil="true"></date_of_birth>
  <last_name>Prefect</last_name>
  <claim_to_fame nil="true"></claim_to_fame>
  <login>fprefect</login>
  <created_at>2008-06-29T03:26:29Z</created_at>

</user>
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
	 "user": 
	 	{"favorite_count": "1", 
	 	 "updated_at": "2008/08/07 20:57:32 +0000", 
	 	 "comment_count": "1", 
	 	 "gender": null, 
	 	 "about": null, 
	 	 "friend_count": "0", 
	 	 "first_name": "Ford", 
	 	 "date_of_birth": null, 
	 	 "vote_count": "9", 
	 	 "last_name": "Prefect", 
	 	 "claim_to_fame": api tribe admin, 
	 	 "login": "fprefect", 
	 	 "created_at": "2008/06/29 03:26:29 +0000"}
	 }
}

```



---


Continue to [Getting users comments](GET_User_Comments.md)

Back to [Adding a tag to a merchant](POST_Merchant_Tag.md)

Up to [Our Index](API.md)