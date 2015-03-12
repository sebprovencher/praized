# Getting a question page #
## Request Format ##

```
	http://api.praized.com/{community_slug}/questions/{question_pid}.{format}?api_key={your api key}	
```


## Arguments ##
### {question\_pid} ###

The unique identifier for a question.

format : string

ex : 96423266cd5145552decb67454b13e4e

## Response Format ##


### XML ###
```
<?xml version="1.0"?>
<praized>
	<community>
		<type>Hub</type>
		<home_url>http://praized.com/</home_url>
		<slug>local-praized</slug>
		<name>praized</name>
		<base_url>http://localhost</base_url>
	</community>
	<question>
		<where nil="true"/>
		<pid>a0000000000000000000000000000001</pid>
		<permalink>http://praized.com/questions/answer-to-the-ultimate-question-of-life-the-universe-and-everything</permalink>
		<user>
			<pid>8e9bd71fdfdad64fdb3d366ff2b67f77</pid>
			<permalink>http://praized.com/users/francois</permalink>
			<activated_at>2007-10-26T13:18:51Z</activated_at>
			<postal_code nil="true"/>
			<favorite_count>1</favorite_count>
			<updated_at>2007-10-26T13:18:51Z</updated_at>
			<comment_count>0</comment_count>
			<gender nil="true"/>
			<about nil="true"/>
			<friend_count>0</friend_count>
			<avatar>
				<small>http://praized.com/images/generic/default_avatar_40x40.png</small>
				<medium>http://praized.com/images/generic/default_avatar_70x70.png</medium>
				<large>http://praized.com/images/generic/default_avatar.png</large>
			</avatar>
			<vote_count>2</vote_count>
			<first_name nil="true"/>
			<display_name>francois</display_name>
			<date_of_birth nil="true"/>
			<last_name nil="true"/>
			<claim_to_fame nil="true"/>
			<login>francois</login>
			<created_at>2007-10-26T13:18:51Z</created_at>
		</user>
		<notify_by_twitter>false</notify_by_twitter>
		<updated_at>2009-08-25T19:37:44Z</updated_at>
		<adjective nil="true"/>
		<answer_count>3</answer_count>
		<content>Answer to the Ultimate Question of Life, the Universe, and Everything.</content>
		<what nil="true"/>
		<community>
			<name>praized</name>
			<slug>local-praized</slug>
			<type>Hub</type>
			<base_url>http://praized.com/</base_url>
			<home_url>http://praized.com/</home_url>
		</community>
		<notify_by_email>true</notify_by_email>
		<created_at>2009-08-25T15:37:44Z</created_at>
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
	            "where": null,
	            "pid": "a0000000000000000000000000000001",
	            "permalink": "http://praized.com/questions/answer-to-the-ultimate-question-of-life-the-universe-and-everything",
	            "user": {
	                "pid": "8e9bd71fdfdad64fdb3d366ff2b67f77",
	                "permalink": "http://praized.com/users/francois",
	                "activated_at": "2007/10/26 13:18:51 +0000",
	                "postal_code": null,
	                "favorite_count": "1",
	                "updated_at": "2007/10/26 13:18:51 +0000",
	                "comment_count": "0",
	                "gender": null,
	                "about": null,
	                "friend_count": "0",
	                "avatar": {
	                    "small": "http://praized.com/images/generic/default_avatar_40x40.png",
	                    "medium": "http://praized.com/images/generic/default_avatar_70x70.png",
	                    "large": "http://praized.com/images/generic/default_avatar.png"
	                },
	                "vote_count": "2",
	                "first_name": null,
	                "display_name": "francois",
	                "date_of_birth": null,
	                "last_name": null,
	                "claim_to_fame": null,
	                "login": "francois",
	                "created_at": "2007/10/26 13:18:51 +0000"
	            },
	            "notify_by_twitter": false,
	            "updated_at": "2009/08/25 19:37:44 +0000",
	            "adjective": null,
	            "answer_count": "3",
	            "content": "Answer to the Ultimate Question of Life, the Universe, and Everything.",
	            "what": null,
	            "community": {
	                "name": "praized",
	                "slug": "local-praized",
	                "type": "Hub",
	                "base_url": "http://praized.com/",
	                "home_url": "http://praized.com/"
	            },
	            "notify_by_email": true,
	            "created_at": "2009/08/25 15:37:44 +0000"
	        }
	    }
	}
```