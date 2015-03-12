# Out first tutorial : Praized'Hello World #

Let's go ahead and start doing the Hello World of the Praized API.

Now, there is no such thing as a Hello World in the Praized API (thank God) but there is something
with which we can test that your API key and cummunity slug are valid.

It is simple to call a Praized API method, because those are simple HTTP calls.

Reading functions can be tested inside a modern browser using GET calls.

The Praized API is largely based on REST principles (you should definitly read those)

So let's try to get something similar to the Praized home page which lists (at the time of this writing)
the top Praized merchants in the Praized community, but for your community.

Since your community does not have any Praized or Razed merchants, we should get an empty list.

Open up your favorite browser and copy and paste this in your location bar :

http://api.praized.com/apitribe/merchants.xml?api_key=a0d3b09f9dcc50db5803306886510641

You should get something like this :

```
<?xml version="1.0" encoding="UTF-8"?>
<praized>
  <community>
    <base_url>http://api-tribe.com/praized/</base_url>
    <slug>apitribe</slug>
    <name>Api Tribe</name>
    <home_url>http://api-tribe.com/</home_url>
  </community>

  <pagination>
    <per_page>10</per_page>
    <page_count>0</page_count>
    <total_entries>0</total_entries>
    <current_page>1</current_page>
  </pagination>
  <merchants/>
</praized>
```

It is pretty self explanatory. We have no DTD (yet).

The response gives info on your community (the url, home page, slug and name),
on the request (pagination) and the response itself, a list of merchants that is empty.. for now ;-)

If you get this instead :
```
<praized>
<errors>
  <error>
    <code>401</code>
    <message>Unauthorized Access</message>
  </error>
</errors>
</praized>
```





It probably means you mispelled your community slug like I did the first time I tried.

You can get a good old 403 Forbidden if you make other errors. If you are unable to get
an XML response, you should contact Praized Media themselves (they are a pretty nice bunch
of guys, they will gadly help) or try beta-tribe.com or even better api-tribe.com!

You can also change the format of the response to json by changing the extension of merchants to
json like this : http://api.praized.com/{your community slug}/merchants.json?api\_key={your API key}

The response should be something like this :
```

{"praized": 
	{
	"pagination": 
		{
			"per_page": "10",
			"page_count": "0", 
			"total_entries": "0", 
			"current_page": "1"
		},
	"community": 
		{
			"base_url": "http://api-tribe.com/praized/", 
			"slug": "apitribe", 
			"name": "Api Tribe", 
			"home_url": "http://api-tribe.com/"
		}, 
	"merchants": []
	}
}
```

Response is indented here to be more readable.

Other parameters to the request include :

per\_page : the number of results per page
page : the number of the page you want the result for

Now that we got to our simili-hello-world, we would want to Praize a merchant. But for that we need at least a user, how to find a merchant, and of course how to vote for it.


---


Continue to [A Second tutorial : The Search for Sushi](A_Second_Tutorial_Search.md)

Back to [Praized API Concepts and definitions](Praized_API_Concepts_and_definitions.md)

Up to [Our Index](API.md)