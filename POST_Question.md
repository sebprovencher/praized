# Adding a question #

## Request Format / requires [OAuth HTTP Authorization Headers](OAuth_Headers.md) ##

```
	http://api.praized.com/{community_slug}/questions.{format}?api_key={your api key}	
```

## POST Body ##

The POST body can be in a text format or an XML format.

### POST Text Format ###

The content is the question

format : string

ex : How to get more ninja?

The switch\_toggle\_status is what kind of question is send.

format : string

ex: complex or simple it influence the format of the request.


The where is the city (only for complex question)
format : string
ex: Louiseville

The what is what you need (only for complex question)
format : string
ex: Pirate

The adjective of the request (only for complex question)
format : string
ex: good

The broadcast service is where you want to publish your question
format : array
ex: TwitterService, LaconicaService, FriendFeedService, FacebookService, PingFmService

The third is type of the method used (HTTP verb)

format : string value : post

### POST XML Format ###

Simple question format
```
	<?xml version="1.0" encoding="UTF-8"?>
	<question>
		<content>Where are my keys ?? Seriously I looked everywhere</content>
		<switch_toggle_status>simple</switch_toggle_status>
	</question>
```

Strutured question format
```
	<?xml version="1.0" encoding="UTF-8"?>
	<question>
		<where>Montreal</where>
		<what>Rails ninja</what>
		<adjective>good</adjective>
		<switch_toggle_status>complex</switch_toggle_status>
	</question>
```

Simple question format with broadcast services (should be set in the profile)
```
	<?xml version="1.0" encoding="UTF-8"?>
	<question>
		<content>Where can I find the best poutine in Montreal?</content>
		<switch_toggle_status>simple</switch_toggle_status>
		<broadcast_services>
		<broadcast_service>
			<service_type>TwitterService</service_type>
			<service_type>LaconicaService</service_type>
			<service_type>FriendFeedService</service_type>
			<service_type>FacebookService</service_type>
			<service_type>PingFmService</service_type>
		</broadcast_service>
		</broadcast_services>
	</question>
```

## Response Format ##

### XML ###

```
	<?xml version="1.0" encoding="UTF-8"?>
	<praized>
	  <community>
	    <type>Hub</type>
	    <home_url>http://praized.com/</home_url>
	    <slug>local-praized</slug>
	    <name>praized</name>
	    <base_url>http://localhost</base_url>
	  </community>
	  <pagination>
	    <current_page>1</current_page>
	    <per_page>10</per_page>
	    <page_count>1</page_count>
	    <total_entries>6</total_entries>
	  </pagination>
	<question>
	  <switch_toggle_status>simple</switch_toggle_status>
	  <user>
	    <pid>04c4c649b8a8ee7e56644163a1a58d85</pid>
	    <permalink>http://praized.com/users/php</permalink>
	    <activated_at>2007-01-07T14:29:45Z</activated_at>
	    <postal_code nil="true"></postal_code>
	    <favorite_count>0</favorite_count>
	    <updated_at>2007-01-07T14:29:30Z</updated_at>
	    <comment_count>0</comment_count>
	    <gender nil="true"></gender>
	    <about nil="true"></about>
	    <friend_count>0</friend_count>
	    <avatar>
	      <small>http://praized.com/images/generic/default_avatar_40x40.png</small>
	      <medium>http://praized.com/images/generic/default_avatar_70x70.png</medium>
	      <large>http://praized.com/images/generic/default_avatar.png</large>
	    </avatar>
	    <vote_count>0</vote_count>
	    <first_name>Pier-Hugues</first_name>
	    <display_name>php</display_name>
	    <date_of_birth nil="true"></date_of_birth>
	    <last_name>Pellerin</last_name>
	    <claim_to_fame nil="true"></claim_to_fame>
	    <login>php</login>
	    <created_at>2007-01-07T14:29:30Z</created_at>
	  </user>
	  <permalink>http://praized.com/questions/find-best-poutine-montreal</permalink>
	  <pid>1e0ef819f9bc2853c3afe7c55e081579</pid>
	  <where nil="true"></where>
	  <updated_at>2009-08-26T16:51:52Z</updated_at>
	  <notify_by_twitter>false</notify_by_twitter>
	  <adjective nil="true"></adjective>
	  <answer_count>0</answer_count>
	  <content>Where can I find the best poutine in Montreal?</content>
	  <what nil="true"></what>
	  <community>
	    <name>praized</name>
	    <slug>local-praized</slug>
	    <type>Hub</type>
	    <base_url>http://localhost</base_url>
	    <home_url>http://praized.com/</home_url>
	  </community>
	  <created_at>2009-08-26T16:51:52Z</created_at>
	  <notify_by_email>true</notify_by_email>
	</question>
	</praized>
```

### JSON ###

```
	{
	    "praized": {
	        "community": {
	            "type": "Hub",
	            "home_url": "http://praized.com/",
	            "slug": "local-praized",
	            "name": "praized",
	            "base_url": "http://localhost"
	        },
	        "question": {
	            "switch_toggle_status": "simple",
	            "user": {
	                "pid": "04c4c649b8a8ee7e56644163a1a58d85",
	                "permalink": "http://praized.com/users/php",
	                "activated_at": "2007/01/07 14:29:45 +0000",
	                "postal_code": null,
	                "favorite_count": "0",
	                "updated_at": "2007/01/07 14:29:30 +0000",
	                "comment_count": "0",
	                "gender": null,
	                "about": null,
	                "friend_count": "0",
	                "avatar": {
	                    "small": "http://praized.com/images/generic/default_avatar_40x40.png",
	                    "medium": "http://praized.com/images/generic/default_avatar_70x70.png",
	                    "large": "http://praized.com/images/generic/default_avatar.png"
	                },
	                "vote_count": "0",
	                "first_name": "Pier-Hugues",
	                "display_name": "php",
	                "date_of_birth": null,
	                "last_name": "Pellerin",
	                "claim_to_fame": null,
	                "login": "php",
	                "created_at": "2007/01/07 14:29:30 +0000"
	            },
	            "permalink": "http://praized.com/questions/find-best-poutine-montreal-2",
	            "pid": "7eb2e437967269781dab0bdc506cadc4",
	            "where": null,
	            "updated_at": "2009/08/26 16:52:59 +0000",
	            "notify_by_twitter": false,
	            "adjective": null,
	            "answer_count": "0",
	            "content": "Where can I find the best poutine in Montreal?",
	            "what": null,
	            "community": {
	                "name": "praized",
	                "slug": "local-praized",
	                "type": "Hub",
	                "base_url": "http://localhost",
	                "home_url": "http://praized.com/"
	            },
	            "created_at": "2009/08/26 16:52:59 +0000",
	            "notify_by_email": true
	        },
	    }
	}
```