# GET\_Answers\_FOR\_Question #
Getting the answers for the question

## Request Format ##

```
	http://api.praized.com/{community_slug}/questions/{question_pid}/answers.{format}?page={page number}&per_page={number}&api_key={your api key}	
```


## Arguments ##
## {question\_pid} ##

The unique identifier for a question.

format : string

ex : 96423266cd5145552decb67454b13e4e

page

No of the requested page

format : unsigned integer
per\_page

Number of request per page

format : unsigned integer

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
	<pagination>
		<current_page>1</current_page>
		<per_page>10</per_page>
		<page_count>1</page_count>
		<total_entries>3</total_entries>
	</pagination>
	<question>
		<where nil="true"/>
		<pid>a0000000000000000000000000000001</pid>
		<permalink>http://praized.com/questions/answer-to-the-ultimate-question-of-life-the-universe-and-everything</permalink>
		<user>
			<pid>8e9bd71fdfdad64fdb3d366ff2b67f77</pid>
			<permalink>http://praized.com/users/francois</permalink>
			<activated_at type="datetime">2007-10-26T13:18:51Z</activated_at>
			<postal_code nil="true"/>
			<favorite_count>1</favorite_count>
			<updated_at type="datetime">2007-10-26T13:18:51Z</updated_at>
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
			<created_at type="datetime">2007-10-26T13:18:51Z</created_at>
		</user>
		<notify_by_twitter type="boolean">false</notify_by_twitter>
		<updated_at type="datetime">2009-08-25T19:37:44Z</updated_at>
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
		<notify_by_email type="boolean">true</notify_by_email>
		<created_at type="datetime">2009-08-25T15:37:44Z</created_at>
	</question>
	<answers>
		<answer>
			<pid>a0000000000000000000000000000002</pid>
			<permalink>http://praized.com/answers/a0000000000000000000000000000002</permalink>
			<user>
				<pid>04c4c649b8a8ee7e56644163a1a58d85</pid>
				<permalink>http://praized.com/users/php</permalink>
				<activated_at>2007-01-07T14:29:45Z</activated_at>
				<postal_code nil="true"/>
				<favorite_count>0</favorite_count>
				<updated_at>2007-01-07T14:29:30Z</updated_at>
				<comment_count>0</comment_count>
				<gender nil="true"/>
				<about nil="true"/>
				<friend_count>0</friend_count>
				<avatar>
					<small>http://praized.com/images/generic/default_avatar_40x40.png</small>
					<medium>http://praized.com/images/generic/default_avatar_70x70.png</medium>
					<large>http://praized.com/images/generic/default_avatar.png</large>
				</avatar>
				<vote_count>0</vote_count>
				<first_name>Pier-Hugues</first_name>
				<display_name>php</display_name>
				<date_of_birth nil="true"/>
				<last_name>Pellerin</last_name>
				<claim_to_fame nil="true"/>
				<login>php</login>
				<created_at>2007-01-07T14:29:30Z</created_at>
			</user>
			<updated_at>2009-08-25T19:37:43Z</updated_at>
			<merchants>
				<merchant>
					<pid>a0000000000000000000000000000001</pid>
					<permalink>http://praized.com/places/ca/quebec/montreal/restaurant-chez-ty-coq</permalink>
					<name>Restaurant Chez Ty-Coq</name>
					<sponsored_links/>
					<short_url>http://localhost:3000/hash_maps/u28amN-uHn</short_url>
					<favorite_count>6</favorite_count>
					<updated_at>2009-08-25T19:37:44Z</updated_at>
					<votes>
						<neg_count>0</neg_count>
						<score>100</score>
						<pos_count>4</pos_count>
						<count>4</count>
					</votes>
					<tag_count>6</tag_count>
					<stat_links>
						<stat_link>
							<url>http://ca.stats.praized.com/ping?t=1251297989.22714</url>
						</stat_link>
					</stat_links>
					<tags>
						<tag>
							<name>restaurant</name>
						</tag>
						<tag>
							<name>rotisserie</name>
						</tag>
						<tag>
							<name>poulet</name>
						</tag>
						<tag>
							<name>mont-royal</name>
						</tag>
						<tag>
							<name>montreal</name>
						</tag>
						<tag>
							<name>ninja</name>
						</tag>
					</tags>
					<comment_count>3</comment_count>
					<url nil="true"/>
					<business_hours nil="true"/>
					<description>Le meilleur restaurant dejeuner du Plateau Mont-Royal</description>
					<phone>(514)5224131</phone>
					<fax nil="true"/>
					<sponsored_images/>
					<email nil="true"/>
					<location>
						<city>
							<name>Montreal</name>
							<code>MTL</code>
						</city>
						<latitude>45.534</latitude>
						<postal_code>H2H 1J3</postal_code>
						<regions>
							<province>Quebec</province>
						</regions>
						<country>
							<name>Canada</name>
							<code>CA</code>
						</country>
						<street_address>1875, Avenue Du Mont-Royal Est</street_address>
						<longitude>-73.57354</longitude>
					</location>
					<created_at>2009-08-25T15:37:44Z</created_at>
				</merchant>
				<merchant>
					<pid>a0000000000000000000000000000002</pid>
					<permalink>http://praized.com/places/librairie-millenium</permalink>
					<name>Librairie Millenium</name>
					<sponsored_links/>
					<short_url>http://localhost:3000/hash_maps/a34bdf-uHn</short_url>
					<favorite_count>0</favorite_count>
					<updated_at>2009-08-25T19:37:44Z</updated_at>
					<votes>
						<neg_count>0</neg_count>
						<score>0</score>
						<pos_count>0</pos_count>
						<count>0</count>
					</votes>
					<tag_count>1</tag_count>
					<stat_links>
						<stat_link>
							<url>http://ca.stats.praized.com/ping?t=1251297989.24154</url>
						</stat_link>
					</stat_links>
					<tags>
						<tag>
							<name>mont-royal</name>
						</tag>
					</tags>
					<comment_count>0</comment_count>
					<url>http://www.libmillenium.com/</url>
					<business_hours nil="true"/>
					<description>La place pour la BD americaine sur le Plateau.</description>
					<phone>(514)2840358</phone>
					<fax nil="true"/>
					<sponsored_images/>
					<email nil="true"/>
					<location>
						<city>
							<name>Montreal</name>
							<code>MTL</code>
						</city>
						<latitude>45.52383</latitude>
						<postal_code>H2J 2A2</postal_code>
						<regions nil="true"/>
						<country>
							<name>Canada</name>
							<code>CA</code>
						</country>
						<street_address>451, Rue Marie-Anne Est</street_address>
						<longitude>-73.5797</longitude>
					</location>
					<created_at>2009-08-25T15:37:44Z</created_at>
				</merchant>
			</merchants>
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
			<content nil="true"/>
			<community>
				<name>praized</name>
				<slug>local-praized</slug>
				<type>Hub</type>
				<base_url>http://praized.com/</base_url>
				<home_url>http://praized.com/</home_url>
			</community>
			<created_at>2009-08-25T19:37:43Z</created_at>
		</answer>
		<answer>
			<pid>a0000000000000000000000000000001</pid>
			<permalink>http://praized.com/answers/a0000000000000000000000000000001</permalink>
			<user>
				<pid>04c4c649b8a8ee7e56644163a1a58d85</pid>
				<permalink>http://praized.com/users/php</permalink>
				<activated_at>2007-01-07T14:29:45Z</activated_at>
				<postal_code nil="true"/>
				<favorite_count>0</favorite_count>
				<updated_at>2007-01-07T14:29:30Z</updated_at>
				<comment_count>0</comment_count>
				<gender nil="true"/>
				<about nil="true"/>
				<friend_count>0</friend_count>
				<avatar>
					<small>http://praized.com/images/generic/default_avatar_40x40.png</small>
					<medium>http://praized.com/images/generic/default_avatar_70x70.png</medium>
					<large>http://praized.com/images/generic/default_avatar.png</large>
				</avatar>
				<vote_count>0</vote_count>
				<first_name>Pier-Hugues</first_name>
				<display_name>php</display_name>
				<date_of_birth nil="true"/>
				<last_name>Pellerin</last_name>
				<claim_to_fame nil="true"/>
				<login>php</login>
				<created_at>2007-01-07T14:29:30Z</created_at>
			</user>
			<updated_at>2009-08-25T19:37:43Z</updated_at>
			<merchants/>
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
					<base_url>http://localhost</base_url>
					<home_url>http://praized.com/</home_url>
				</community>
				<notify_by_email>true</notify_by_email>
				<created_at>2009-08-25T15:37:44Z</created_at>
			</question>
			<content>It's 42!</content>
			<community>
				<name>praized</name>
				<slug>local-praized</slug>
				<type>Hub</type>
				<base_url>http://localhost</base_url>
				<home_url>http://praized.com/</home_url>
			</community>
			<created_at>2009-08-25T19:37:43Z</created_at>
		</answer>
		<answer>
			<pid>a0000000000000000000000000000003</pid>
			<permalink>http://praized.com/answers/a0000000000000000000000000000003</permalink>
			<user>
				<pid>04c4c649b8a8ee7e56644163a1a58d85</pid>
				<permalink>http://praized.com/users/php</permalink>
				<activated_at>2007-01-07T14:29:45Z</activated_at>
				<postal_code nil="true"/>
				<favorite_count>0</favorite_count>
				<updated_at>2007-01-07T14:29:30Z</updated_at>
				<comment_count>0</comment_count>
				<gender nil="true"/>
				<about nil="true"/>
				<friend_count>0</friend_count>
				<avatar>
					<small>http://praized.com/images/generic/default_avatar_40x40.png</small>
					<medium>http://praized.com/images/generic/default_avatar_70x70.png</medium>
					<large>http://praized.com/images/generic/default_avatar.png</large>
				</avatar>
				<vote_count>0</vote_count>
				<first_name>Pier-Hugues</first_name>
				<display_name>php</display_name>
				<date_of_birth nil="true"/>
				<last_name>Pellerin</last_name>
				<claim_to_fame nil="true"/>
				<login>php</login>
				<created_at>2007-01-07T14:29:30Z</created_at>
			</user>
			<updated_at>2009-08-25T19:37:43Z</updated_at>
			<merchants>
				<merchant>
					<pid>a0000000000000000000000000000001</pid>
					<permalink>http://praized.com/places/ca/quebec/montreal/restaurant-chez-ty-coq</permalink>
					<name>Restaurant Chez Ty-Coq</name>
					<sponsored_links/>
					<short_url>http://localhost:3000/hash_maps/u28amN-uHn</short_url>
					<favorite_count>6</favorite_count>
					<updated_at>2009-08-25T19:37:44Z</updated_at>
					<votes>
						<neg_count>0</neg_count>
						<score>100</score>
						<pos_count>4</pos_count>
						<count>4</count>
					</votes>
					<tag_count>6</tag_count>
					<stat_links>
						<stat_link>
							<url>http://ca.stats.praized.com/ping?t=1251297989.29864</url>
						</stat_link>
					</stat_links>
					<tags>
						<tag>
							<name>restaurant</name>
						</tag>
						<tag>
							<name>rotisserie</name>
						</tag>
						<tag>
							<name>poulet</name>
						</tag>
						<tag>
							<name>mont-royal</name>
						</tag>
						<tag>
							<name>montreal</name>
						</tag>
						<tag>
							<name>ninja</name>
						</tag>
					</tags>
					<comment_count>3</comment_count>
					<url nil="true"/>
					<business_hours nil="true"/>
					<description>Le meilleur restaurant dejeuner du Plateau Mont-Royal</description>
					<phone>(514)5224131</phone>
					<fax nil="true"/>
					<sponsored_images/>
					<email nil="true"/>
					<location>
						<city>
							<name>Montreal</name>
							<code>MTL</code>
						</city>
						<latitude>45.534</latitude>
						<postal_code>H2H 1J3</postal_code>
						<regions>
							<province>Quebec</province>
						</regions>
						<country>
							<name>Canada</name>
							<code>CA</code>
						</country>
						<street_address>1875, Avenue Du Mont-Royal Est</street_address>
						<longitude>-73.57354</longitude>
					</location>
					<created_at>2009-08-25T15:37:44Z</created_at>
				</merchant>
			</merchants>
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
					<base_url>http://localhost</base_url>
					<home_url>http://praized.com/</home_url>
				</community>
				<notify_by_email>true</notify_by_email>
				<created_at>2009-08-25T15:37:44Z</created_at>
			</question>
			<content>It's a movie!</content>
			<community>
				<name>praized</name>
				<slug>local-praized</slug>
				<type>Hub</type>
				<base_url>http://localhost</base_url>
				<home_url>http://praized.com/</home_url>
			</community>
			<created_at>2009-08-25T19:37:43Z</created_at>
		</answer>
	</answers>
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
	        },
	        "pagination": {
	            "current_page": "1",
	            "per_page": "10",
	            "page_count": "1",
	            "total_entries": "3"
	        },
	        "answers": [{
	            "pid": "a0000000000000000000000000000002",
	            "permalink": "http://praized.com/answers/a0000000000000000000000000000002",
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
	            "updated_at": "2009/08/25 19:37:43 +0000",
	            "merchants": [{
	                "pid": "a0000000000000000000000000000001",
	                "permalink": "http://praized.com/places/ca/quebec/montreal/restaurant-chez-ty-coq",
	                "name": "Restaurant Chez Ty-Coq",
	                "sponsored_links": [],
	                "short_url": "http://localhost:3000/hash_maps/u28amN-uHn",
	                "favorite_count": "6",
	                "updated_at": "2009/08/25 19:37:44 +0000",
	                "votes": {
	                    "neg_count": "0",
	                    "score": "100",
	                    "pos_count": "4",
	                    "count": "4"
	                },
	                "tag_count": "6",
	                "stat_links": [{
	                    "url": "http://ca.stats.praized.com/ping?t=1251300178.24271"
	                }],
	                "tags": [{
	                    "name": "restaurant"
	                },
	                {
	                    "name": "rotisserie"
	                },
	                {
	                    "name": "poulet"
	                },
	                {
	                    "name": "mont-royal"
	                },
	                {
	                    "name": "montreal"
	                },
	                {
	                    "name": "ninja"
	                }],
	                "comment_count": "3",
	                "url": null,
	                "business_hours": null,
	                "description": "Le meilleur restaurant dejeuner du Plateau Mont-Royal",
	                "phone": "(514)5224131",
	                "fax": null,
	                "sponsored_images": [],
	                "email": null,
	                "location": {
	                    "city": {
	                        "name": "Montreal",
	                        "code": "MTL"
	                    },
	                    "latitude": 45.534,
	                    "postal_code": "H2H 1J3",
	                    "regions": {
	                        "province": "Quebec"
	                    },
	                    "country": {
	                        "name": "Canada",
	                        "code": "CA"
	                    },
	                    "street_address": "1875, Avenue Du Mont-Royal Est",
	                    "longitude": -73.57354
	                },
	                "created_at": "2009/08/25 15:37:44 +0000"
	            },
	            {
	                "pid": "a0000000000000000000000000000002",
	                "permalink": "http://praized.com/places/librairie-millenium",
	                "name": "Librairie Millenium",
	                "sponsored_links": [],
	                "short_url": "http://localhost:3000/hash_maps/a34bdf-uHn",
	                "favorite_count": "0",
	                "updated_at": "2009/08/25 19:37:44 +0000",
	                "votes": {
	                    "neg_count": "0",
	                    "score": "0",
	                    "pos_count": "0",
	                    "count": "0"
	                },
	                "tag_count": "1",
	                "stat_links": [{
	                    "url": "http://ca.stats.praized.com/ping?t=1251300178.25602"
	                }],
	                "tags": [{
	                    "name": "mont-royal"
	                }],
	                "comment_count": "0",
	                "url": "http://www.libmillenium.com/",
	                "business_hours": null,
	                "description": "La place pour la BD amu0026eacute;ricaine sur le Plateau.",
	                "phone": "(514)2840358",
	                "fax": null,
	                "sponsored_images": [],
	                "email": null,
	                "location": {
	                    "city": {
	                        "name": "Montreal",
	                        "code": "MTL"
	                    },
	                    "latitude": 45.52383,
	                    "postal_code": "H2J 2A2",
	                    "regions": null,
	                    "country": {
	                        "name": "Canada",
	                        "code": "CA"
	                    },
	                    "street_address": "451, Rue Marie-Anne Est",
	                    "longitude": -73.5797
	                },
	                "created_at": "2009/08/25 15:37:44 +0000"
	            }],
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
	            },
	            "content": null,
	            "community": {
	                "name": "praized",
	                "slug": "local-praized",
	                "type": "Hub",
	                "base_url": "http://praized.com/",
	                "home_url": "http://praized.com/"
	            },
	            "created_at": "2009/08/25 19:37:43 +0000"
	        },
	        {
	            "pid": "a0000000000000000000000000000001",
	            "permalink": "http://praized.com/answers/a0000000000000000000000000000001",
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
	            "updated_at": "2009/08/25 19:37:43 +0000",
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
	                "answer_count": "3",
	                "content": "Answer to the Ultimate Question of Life, the Universe, and Everything.",
	                "what": null,
	                "community": {
	                    "name": "praized",
	                    "slug": "local-praized",
	                    "type": "Hub",
	                    "base_url": "http://localhost",
	                    "home_url": "http://praized.com/"
	                },
	                "notify_by_email": true,
	                "created_at": "2009/08/25 15:37:44 +0000"
	            },
	            "content": "It's 42!",
	            "community": {
	                "name": "praized",
	                "slug": "local-praized",
	                "type": "Hub",
	                "base_url": "http://localhost",
	                "home_url": "http://praized.com/"
	            },
	            "created_at": "2009/08/25 19:37:43 +0000"
	        },
	        {
	            "pid": "a0000000000000000000000000000003",
	            "permalink": "http://praized.com/answers/a0000000000000000000000000000003",
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
	            "updated_at": "2009/08/25 19:37:43 +0000",
	            "merchants": [{
	                "pid": "a0000000000000000000000000000001",
	                "permalink": "http://praized.com/places/ca/quebec/montreal/restaurant-chez-ty-coq",
	                "name": "Restaurant Chez Ty-Coq",
	                "sponsored_links": [],
	                "short_url": "http://localhost:3000/hash_maps/u28amN-uHn",
	                "favorite_count": "6",
	                "updated_at": "2009/08/25 19:37:44 +0000",
	                "votes": {
	                    "neg_count": "0",
	                    "score": "100",
	                    "pos_count": "4",
	                    "count": "4"
	                },
	                "tag_count": "6",
	                "stat_links": [{
	                    "url": "http://ca.stats.praized.com/ping?t=1251300178.30664"
	                }],
	                "tags": [{
	                    "name": "restaurant"
	                },
	                {
	                    "name": "rotisserie"
	                },
	                {
	                    "name": "poulet"
	                },
	                {
	                    "name": "mont-royal"
	                },
	                {
	                    "name": "montreal"
	                },
	                {
	                    "name": "ninja"
	                }],
	                "comment_count": "3",
	                "url": null,
	                "business_hours": null,
	                "description": "Le meilleur restaurant dejeuner du Plateau Mont-Royal",
	                "phone": "(514)5224131",
	                "fax": null,
	                "sponsored_images": [],
	                "email": null,
	                "location": {
	                    "city": {
	                        "name": "Montreal",
	                        "code": "MTL"
	                    },
	                    "latitude": 45.534,
	                    "postal_code": "H2H 1J3",
	                    "regions": {
	                        "province": "Quebec"
	                    },
	                    "country": {
	                        "name": "Canada",
	                        "code": "CA"
	                    },
	                    "street_address": "1875, Avenue Du Mont-Royal Est",
	                    "longitude": -73.57354
	                },
	                "created_at": "2009/08/25 15:37:44 +0000"
	            }],
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
	                    "base_url": "http://localhost",
	                    "home_url": "http://praized.com/"
	                },
	                "notify_by_email": true,
	                "created_at": "2009/08/25 15:37:44 +0000"
	            },
	            "content": "It's a movie!",
	            "community": {
	                "name": "praized",
	                "slug": "local-praized",
	                "type": "Hub",
	                "base_url": "http://localhost",
	                "home_url": "http://praized.com/"
	            },
	            "created_at": "2009/08/25 19:37:43 +0000"
	        }]
	    }
	}
```