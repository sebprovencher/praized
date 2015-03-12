# Testing authenticated API calls from the command line using a OAuth proxy. #

Most of the instructions are from that site with small changes to make them work on praized.com

http://mojodna.net/2009/08/21/exploring-oauth-protected-apis.html

If you are running MacOS Leopard install Twisted Matrix with the mac package from the website and
change your PYTHONPATH environment variable to check in "/Library/Python/2.5/site-packages/" first.

```
	export PYTHONPATH="/Library/Python/2.5/site-packages/:$PYTHONPATH"
```

We are using a 3-legged OAuth for our authorization and delegation system.
You need to get an access token and a request token.

You need to install the oauth gem to generate them.
```
	$ sudo gem install oauth	
```

Generate your tokens with it and follow the instructions on screen

```
	$ oauth \
	    --consumer-key {consumer key} \
	    --consumer-secret {consumer secret} \
	    --access-token-url http://praized.com/oauth/access_token \
	    --authorize-url http://praized.com/oauth/authorize \
	    --request-token-url http://praized.com/oauth/request_token \
	    authorize
```

Copy the link the application give you into your browser and authorize the access token.
Return to the application and hit any key, you should get something like this:

```
Response:
  oauth_token_secret: j8m8lx1d7JV2oUvlxHzxPQzAIhyI
  oauth_token: Q0CsASkHeBCEJBvnffsdAcA
```

Now start the OAuth proxy with your keys and tokens.
You only need to do this once, and the tokens should be valid for two weeks.
```
	$ twistd -n oauth_proxy \
	    --consumer-key {consumer key} \
	    --consumer-secret {consumer secret} \
	    --token {oauth token} \
	    --token-secret {oauth token secret}	
```

Now you can use the proxy with any command that support them. (the default port is 8001)

Keep in mind that when you are using an OAuth token to fetch data on the api you will get more information from the current user.

You can add tags using curl for a specific merchant like this,

```
	curl -x localhost:8001 -d "tagging[tag]=ninja" http://api.praized.com/{community_slug}/merchants/a0000000000000000000000000000001/taggings.xml?api_key={api_key}
```