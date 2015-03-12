# Getting users friends #

## Request Format ##
```
http://api.praized.com/{community_slug}/users/{user_login}/friends.{format}?api_key={your api key}
```
## Arguments ##

### {user\_login} ###

The login of the user

format : string

ex : fprefect

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
    <per_page></per_page>
    <page_count></page_count>
    <total_entries></total_entries>
    <current_page></current_page>
  </pagination>
<users>

  <user>
    <updated_at>2008-08-28T02:56:17Z</updated_at>

    <gender nil="true"></gender>
    <about nil="true"></about>
    <date_of_birth nil="true"></date_of_birth>
    <first_name>Surname</first_name>
    <claim_to_fame nil="true"></claim_to_fame>
    <last_name>Name</last_name>
    <address>
      <city>

        <name>Montreal</name>
        <code nil="true"></code>
        <name_fr nil="true"></name_fr>
      </city>
      <postal_code nil="true"></postal_code>
      <latitude>99.545447</latitude>
      <regions nil="true"></regions>
      <street_address nil="true"></street_address>

      <longitude>-99.639076</longitude>
    </address>
    <login>nnnnnnn</login>
    <created_at>2007-01-07T19:29:30Z</created_at>
  </user>
  
  ....
 
</users>
</praized>


```

### JSON ###

```

{
   "praized":{
      "pagination":{
         "per_page":null,
         "page_count":null,
         "total_entries":null,
         "current_page":null
      },
      "community":{
         "base_url":"http://praized.com/",
         "slug":"praized-com-hub",
         "name":"praized.com hub",
         "home_url":"http://praized.com/"
      },
      "users":[
         {
            "updated_at":"2008/07/31 10:54:08 +0000",
            "gender":null,
            "about":null,
            "date_of_birth":null,
            "first_name":"name",
            "last_name":"lastname",
            "claim_to_fame":null,
            "login":"cfd",
            "created_at":"2008/04/07 22:01:12 +0000"
         },
         {
            "updated_at":"2008/08/21 14:59:48 +0000",
            "gender":null,
            "about":"Test",
            "date_of_birth":null,
            "first_name":"first name",
            "last_name":"name",
            "claim_to_fame":"-----",
            "address":{
               "city":{
                  "name":"Montreal",
                  "code":null,
                  "name_fr":null
               },
               "latitude":99,
               "postal_code":null,
               "regions":null,
               "street_address":null,
               "longitude":-99
            },
            "login":"nnnnnnnn",
            "created_at":"2008/02/26 17:23:21 +0000"
         },
         .....

      ]
   }
}

```



---


Continue to [Adding / Removing a user as a friend of the currently logged user](POST_User_Friends.md)

Back to [Getting users votes](GET_User_Votes.md)

Up to [Our Index](API.md)