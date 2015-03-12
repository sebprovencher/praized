# Searching for merchants within a community #

## Request format ##

```
http://api.praized.com/{community_slug}/merchants.{format}?
     q={terms}&l={cityname, state/province}&page={page number}&per_page={number}&api_key={your api key}
```

## Arguments ##

### page ###

No of the requested page

format : unsigned integer

### per\_page ###

Number of request per page

format : unsigned integer

### q ###

Search query for terms in the form of the [Sphinx Extended Query Syntax](http://www.sphinxsearch.com/doc.html#extended-syntax)

format : string

ex : q=restaurant|bar

### l or location ###

Search query for the location it can include the city or the city with the state or province

format : string

ex : l=montreal
> location=montreal/QC

### t or tag ###


Search query by using tags

format : string

ex : t=sushi

### lat ###

Latitude (location north or south of the equator in degrees) which is the center of the search. Used with long (longitude) and radius

format : float

ex : lat=45.505159


### long ###

Longitude (east / west coordinate) which is the center of the search. Used with lat (latitude) and radius

format : float

ex : long=45.505159

### radius ###

Radius in kilometers for the search. Used with lat (latitude) and long (longitude)

## Response Format ##

The response format is the same as "[Getting the top merchants for a community](GET_Top_Merchants.md)"


---


Continue to [Getting a merchant page](GET_Merchant_Info.md)

Back to [Getting the top merchants for a community](GET_Top_Merchants.md)

Up to [Our Index](API.md)