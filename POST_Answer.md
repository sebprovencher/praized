# Adding an answer to a specific question #

## Request Format / requires [OAuth HTTP Authorization Headers](OAuth_Headers.md) ##

```
	http://api.praized.com/{community_slug}/questions/{question_pid}/answers.{format}?&api_key={your api key}	
```


## POST Body ##

### POST Text Format ###

The content of the answer
format : string
ex: The best places to find figurines of pirates

The pids of the merchant
format : comma separated string or pids
ex: 642b7b7b0487607f738547444489d9896c,92696487d595b966fda311fa77e2d6d598

### POST XML Format ###

```
<?xml version="1.0" encoding="UTF-8"?>
<answer>
	<content>The best places to find figurines of pirates</content>
	<merchants>
	<merchant><pid>642b7b7b0487607f738547444489d9896c</pid></merchant>
	<merchant><pid>92696487d595b966fda311fa77e2d6d598</pid></merchant>
	</merchants>
</answer>
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
	<answer>
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
	  <permalink>http://praized.com/answers/1bc0a59475afa2fef315c8c419725ea1</permalink>
	  <pid>1bc0a59475afa2fef315c8c419725ea1</pid>
	  <updated_at>2009-08-26T17:34:28Z</updated_at>
	  <merchants/>
	  <question>
	    <where nil="true"></where>
	    <pid>a0000000000000000000000000000001</pid>
	    <permalink>http://praized.com/questions/answer-to-the-ultimate-question-of-life-the-universe-and-everything</permalink>
	    <user>
	      <pid>8e9bd71fdfdad64fdb3d366ff2b67f77</pid>
	      <permalink>http://praized.com/users/francois</permalink>
	      <activated_at>2007-10-26T13:18:51Z</activated_at>
	      <postal_code nil="true"></postal_code>
	      <favorite_count>1</favorite_count>
	      <updated_at>2007-10-26T13:18:51Z</updated_at>
	      <comment_count>0</comment_count>
	      <gender nil="true"></gender>
	      <about nil="true"></about>
	      <friend_count>0</friend_count>
	      <avatar>
	        <small>http://praized.com/images/generic/default_avatar_40x40.png</small>
	        <medium>http://praized.com/images/generic/default_avatar_70x70.png</medium>
	        <large>http://praized.com/images/generic/default_avatar.png</large>
	      </avatar>
	      <vote_count>2</vote_count>
	      <first_name nil="true"></first_name>
	      <display_name>francois</display_name>
	      <date_of_birth nil="true"></date_of_birth>
	      <last_name nil="true"></last_name>
	      <claim_to_fame nil="true"></claim_to_fame>
	      <login>francois</login>
	      <created_at>2007-10-26T13:18:51Z</created_at>
	    </user>
	    <notify_by_twitter>false</notify_by_twitter>
	    <updated_at>2009-08-25T19:37:44Z</updated_at>
	    <adjective nil="true"></adjective>
	    <answer_count>4</answer_count>
	    <content>Answer to the Ultimate Question of Life, the Universe, and Everything.</content>
	    <what nil="true"></what>
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
	  <content>mon super commentaire avec des structured merchants</content>
	  <community>
	    <name>praized</name>
	    <slug>local-praized</slug>
	    <type>Hub</type>
	    <base_url>http://praized.com/</base_url>
	    <home_url>http://praized.com/</home_url>
	  </community>
	  <merchants_pids>642b7b7b0487607f738547444489d9896c,92696487d595b966fda311fa77e2d6d598</merchants_pids>
	  <created_at>2009-08-26T17:34:28Z</created_at>
	</answer>
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
	        "answer": {
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
	            "permalink": "http://praized.com/answers/af618fdddc454d55895214764bfb0e26",
	            "pid": "af618fdddc454d55895214764bfb0e26",
	            "updated_at": "2009/08/26 17:35:41 +0000",
	            "merchants": [],
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
	                "answer_count": "5",
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
	            },
	            "content": "mon super commentaire avec des structured merchants",
	            "community": {
	                "name": "praized",
	                "slug": "local-praized",
	                "type": "Hub",
	                "base_url": "http://praized.com/",
	                "home_url": "http://praized.com/"
	            },
	            "merchants_pids": "642b7b7b0487607f738547444489d9896c,92696487d595b966fda311fa77e2d6d598",
	            "created_at": "2009/08/26 17:35:41 +0000"
	        }
	    }
	}	
```