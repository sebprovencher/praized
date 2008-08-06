<?php
/**
* Simple class to execute the right api request based
* on the URI.
* 
* @version 0.1
*/
class PraizedRoute {
	var $_route_match;
	var $_associated_action;
	
	
	/**
	*  Initialize the route with an associated action.
	* 
	* @param string $match A regexp to match.
	* @param object $action Action to execute on match.
	* 
	* @see PraizedAction
	* @since 0.1
	*/
	function PraizedRoute($match, &$action) {
		$this->_route_match = $match;
		$this->_associated_action = $action;
	}
	
	/**
	* Match the url with the request.
	*
	* @param object $request a Praized request object to match
	* @return boolean
	* @see PraizedRequest
	* @since 0.1
	*/
	function match($request) {
		return preg_match($this->_route_match, $request->getRequest());
	}
	
	/**
	* Return the Associated action.
	* @see PraizedAction
	* @since 0.1
	*/
	function &getAction() {
		return $this->_associated_action;
	}
}
?>