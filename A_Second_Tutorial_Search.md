# The Search for Sushi : A real story #

Let's start with searching for merchants. Let's say we are looking for sushi in downtown Montreal, we all love sushi yes ?

Let's build the request for those sushi restaurants.

Our last request from the Hello World exemple was http://api.praized.com/apitribe/merchants.xml?api_key=a0d3b09f9dcc50db5803306886510641

That request gives us the top merchants for the community. To do a search on merchants (or places), we use the same endpoint, but add new parameters. "q" : the query, "l", the location and or "t" for tags. For more precise locations, we can use latitude : "lat", longitude : "long" and radius : "radius" (in kilometers).

So to get our sushi we would do this : http://api.praized.com/apitribe/merchants.xml?api_key=a0d3b09f9dcc50db5803306886510641&q=sushi&l=montreal

And we would get something like this :

```


<?xml version="1.0" encoding="UTF-8"?>
<praized>
  <community>
    <slug>apitribe</slug>
    <name>Api Tribe</name>
    <base_url>http://api-tribe.com/praized/</base_url>
    <home_url>http://api-tribe.com/</home_url>
  </community>

  <pagination>
    <page_count>12</page_count>
    <per_page>10</per_page>
    <total_entries>114</total_entries>
    <current_page>1</current_page>
  </pagination>
<merchants>

  <merchant>
    <pid>13aa5889d466fb04c4ffd8dec1615529</pid>
    <permalink>http://api-tribe.com/praized/places/ca/quebec/montreal/restaurant-sushi-mou-shi?l=montreal&amp;q=sushi</permalink>
    <name>Restaurant Sushi Mou-Shi</name>
    <favorite_count>0</favorite_count>
    <sponsored_links/>

    <updated_at>2008-07-04T13:28:31Z</updated_at>
    <short_url>http://przd.com/stA-93</short_url>
    <votes>
      <neg_count>0</neg_count>
      <score>100</score>
      <pos_count>1</pos_count>

      <count>1</count>
    </votes>

...


```

Pagination parameters here are useful, because we are gette 114 entries. "per\_page" : the number of entries per page and "page", the page number, are used for this. The order of results are bazed on the number of praizes the merchants / places gets.

Let's add a couple of tags to get more interestings results. Tags are (you probably know, but where are in a tutorial after all) community metadata added to a merchant / place.

Here is our updated query :

http://api.praized.com/apitribe/merchants.xml?api_key=a0d3b09f9dcc50db5803306886510641&q=sushi&l=montreal&t=fastfood

And we would get a more limited number of places.

Same with :

http://api.praized.com/apitribe/merchants.xml?api_key=a0d3b09f9dcc50db5803306886510641&q=sushi&l=montreal&t=downtown

You can also restrict the search to your communities using the r=communities parameter.

Or if you visit Praized headquaters, let's find a sushi restaurant at a walking distance (1.5 km)

http://api.praized.com/apitribe/merchants.xml?api_key=a0d3b09f9dcc50db5803306886510641&q=sushi&lat=45.505159&long=-73.567934&radius=1.5

You can play with the search endpoint and get the most out of it!



---


Continue to [A Third Tutorial : Understanding OAauth with Praized](A_Third_Tutorial_OAuth.md)

Back to [Praized'Hello World](First_tutorial_Hello_World.md)

Up to [Our Index](API.md)