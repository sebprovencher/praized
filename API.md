# Praized API Documentation #

This is documentation is for the Praized API version 1.0

Information in this document is valid but some specific calls are not documented (yet).

## Goals of the Praized API ##

The goal of the Praized API is to make it easier for developers to build services using data about merchants.

## How to use the API ##

  * [Before You Start](Before_You_Start.md)
  * [Praized API Concepts and Definitions](Praized_API_Concepts_and_definitions.md)

In the case you simply cannot wait : the requests are in the form of
```
http://api.praized.com/{community_slug}/{resource_name}?api_key={your_api_key}
```
(ex: http://api.praized.com/apitribe/merchants.xml?api_key=a0d3b09f9dcc50db5803306886510641)

### Tutorials ###

  * [Praized'Hello World](First_tutorial_Hello_World.md)
  * [A Second tutorial : The Search for Outstanding Sushi](A_Second_Tutorial_Search.md)
  * [A Third Tutorial : Understanding OAuth with Praized](A_Third_Tutorial_OAuth.md)

## Data and Request Formats ##

  * [HTTP Request Format](HTTP_Request_Response.md)
  * [XML Format : Details](XML_Documentation.md)
  * [JSON Format : Details](JSON_Documentation.md)

## API Reference ##

### General documentation ###

  * [Common parameters and endpoint url parts](Common_Parameters.md)
  * [OAuth HTTP Headers](OAuth_Headers.md)
  * [OAuth Endpoints](OAuth_EndPoints.md)
  * [Error Messages](Error_Messages.md)

### Merchants / Places Endpoints ###

  * [Getting the top merchants for a community](GET_Top_Merchants.md)
  * [Searching for merchants within a community](GET_Merchant_Search.md)
  * [Getting a merchant page](GET_Merchant_Info.md)
  * [Getting votes for a merchant](GET_Merchant_Votes.md)
  * [Getting comments for a merchant](GET_Merchant_Comments.md)
  * [Getting users that bookmarked a merchant](GET_Merchant_Favorites_Users.md)
  * [Getting tags for a merchant](GET_Merchant_Tags.md)
  * [Voting for a merchant](POST_Merchant_Vote.md)
  * [Commenting on a merchant](POST_Merchant_Comment.md)
  * [Adding a merchant to the currently logged user's favorites](POST_Merchant_User_Favorite.md)
  * [Removing a merchant to the currently logged user's favorites](DELETE_Merchant_User_Favorite.md)
  * [Adding a tag to a merchant](POST_Merchant_Tag.md)


### Users Endpoints ###
  * [Getting users information](GET_User.md)
  * [Getting users comments](GET_User_Comments.md)
  * [Getting users favorites](GET_User_Favorites.md)
  * [Getting users votes](GET_User_Votes.md)
  * [Getting users friends](GET_User_Friends.md)
  * [Adding / Removing a user as a friend of the currently logged user](POST_User_Friends.md)

### Feed Endpoints ###

  * [Getting a Praized Buzz Feed NEW!](GET_Buzz_Feed.md)
  * [Getting a User feed NEW!](GET_User_Feed.md)

### Questions Endpoints ###

  * [Getting the top questions for a community](GET_Top_Questions.md)
  * [Getting a question page](GET_Question_Info.md)
  * [Getting the answers for the question](GET_Answers_FOR_Question.md)
  * [Adding a question](POST_Question.md)
  * [Adding an answer to a question](POST_Answer.md)

## Complete examples ##

### Steps to build a Praized community ###

  * [API-tribe](APITribe.md)

### Steps to build a Praized application ###

  * [Our next meeting place chooser - PHP Edition](Application_Ex1.md)

### Testing the api ###
  * [How to work with OAuth for testing api calls from the command line](Testing_cli.md)

Copyright Praized Media 2008 Some rights reserved