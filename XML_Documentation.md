# XML tag descriptions #

This page describes some of the XML tags that are not self evident just be looking at the XML output, and some of the others too! This page will be updated with more examples.


## 

&lt;self&gt;

 ##

The self xml tag has information about the currently logged user in relation to the parent tag (merchant or user).
(The info on the currently logged user is infered from the authorization token)
It includes if the parent merchant is favorited (or bookmarked) and if the logged
user has voted (negatively,0 or positively 1) on that merchant. For a user, it contains if the targeted user is friend
with the logged user

## 

&lt;target&gt;

 ##

The target xml tag is similar in structure to the self tag but represents the merchants actions
a viewed user as made. For instance, if I query the API for merchant praized / commented or bookmarked
by a specific user (a user page), then I would get that tag for each merchant that the user
as taken an action on.


---


Continue to  [JSON Format : Details](JSON_Documentation.md)

Back to [HTTP Request Format](HTTP_Request_Response.md)

Up to [Our Index](API.md)