<?php
/**
* Match a Request object uri with the right action to do.
* The match is a top down approch, so be careful when defining your routes.
*
* @version 0.1
*/
class PraizedRouter {
	var $_routes = array();
	
	function PraizedRouter() {}
	/**
	* add();
	* Add a route object to the mapper.
	* First match is out (top down)
	*
	* @params PraizedRoute $route a route object
	* @since 0.1
	*/
	function add(&$route) {
		array_push($this->_routes, $route);
	}
	
	/**
	* compile();
	*
	* Loop through the routes and find the first match.
	*
	* @param mixed $request return AbstractPraizedAction  or false if not found
	* @since 0.1
	*/
	function compile($request) {
		foreach($this->_routes as $route) {
			if(true == $route->match($request))
				return $route->getAction();
		}
		
		return false;
	}
}
?>