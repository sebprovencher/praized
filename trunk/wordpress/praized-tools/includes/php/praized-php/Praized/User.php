<?php
/**
 * Praized Portable PHP Library: User
 * 
 * Note: Using the OAuth functionalities will make this library PHP5+ only
 *
 * @version 1.6
 * @package Praized
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedUser') ) {
    require_once(dirname(realpath(__FILE__)).'/Core.php');
    
    /**
     * Praized Portable PHP Library: User: Class
     * 
     * Note: Using the OAuth functionalities will make this library PHP5+ only
     * 
     * @package Praized
     * @since 0.1
     */
    class PraizedUser extends PraizedCore {
    	/**
    	 * Constructor
    	 *
    	 * @param string $community [required] Praized community permalink
    	 * @param string $apiKey [required] Praized API key
    	 * @param mixed obj|null $oAuth PraizedOauth (../PraizedOauth.php) instance, as reference. Pass NULL for read-only (PHP4-compat) mode
    	 * @param string $consumerKey oAuth consumer key for write access
    	 * @param string $consumerSecret oAuth consumer secret for write access
    	 * @return PraizedMerchant
    	 * @since 0.1
    	 */
        function PraizedUser($community, $apiKey, &$oAuth, $consumerKey = null, $consumerSecret = null) {
    		if ( ! is_object($oAuth)) {
        		if ($consumerKey && $consumerSecret) {
            	    include_once dirname(__FILE__) . "/OAuth.php";
            	    $oAuth = new PraizedOAuth($consumerKey, $consumerSecret, $this->_praizedHosts['auth']);
        		} else {
        		    $oAuth = null;
        		}
    		}
                	    
    		parent::PraizedCore($community, $apiKey, $oAuth);
    	}
    	
    	/**
    	 * Returns an individual user object, optionally based on the submitted query
    	 *
         * @param string $username Username
         * @param array  $query Associative array matching the query string keys supported by the Praized API.
         * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
         * @since 0.1
    	 */
    	function get($username, $query = array(), $rawJson = false) {
    	    if ( $json = $this->_get('/users/'.$username.'.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Returns an individual user's attribute value, optionally based on the submitted query
    	 *
         * @param string $username Username
    	 * @param string $attribute User attribute (eg: first_name)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @return mixed boolean false or mixed value as returned by the Praized API
    	 * @since 0.1
    	 */
    	function attribute($username, $attribute, $query = array()) {
    		if ($json = $this->_get('/users/'.$username.'/'.$attribute.'.json', $query)) {
    			$obj = $this->_parseApi($json);
    			return ( is_object($obj) && isset($obj->user->$attribute) )
    	            ? $obj->user->$attribute
    	            : false;
    		} else {
    			return false;
    		}
    	}

    	
    	/**
    	 * Returns an individual user's associated comments list, optionally based on the submitted query
    	 *
         * @param string $username Username
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function comments($username, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/users/'.$username.'/comments.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Returns an individual user's associated votes list (ie: list of merchants the user voted on), optionally based on the submitted query
    	 *
         * @param string $username Username
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function votes($username, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/users/'.$username.'/votes.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Returns an individual user's associated favorites list (ie: list of merchants the user has added to her/his favorites), optionally based on the submitted query
    	 *
         * @param string $username Username
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function favorites($username, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/users/'.$username.'/favorites.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
        }
        
    	/**
    	 * Returns an individual user's associated friends list (ie: list of users the user has added as friends), optionally based on the submitted query
    	 *
         * @param string $username Username
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
        function friends($username, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/users/'.$username.'/friends.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Adds the sent user as a friend of the current authz'ed user
    	 *
         * @param string $username Username
    	 * @param array  $post Post vars key/value pairs (equiv of $_POST)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function friendAdd($username, $post = array(), $query = array(), $rawJson = false) {
    		$post['friend'] = ''; // Placeholder because Activeresource doesn't like empty posts.
    	    if ( $json = $this->_post('/users/'.$username.'/friendships.json', $post, 'post', $query, true) )
    		    return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Removes the sent user as a friend of the current authz'ed user
    	 *
         * @param string $username Username of the friend to be deleted
    	 * @param array  $post Post vars key/value pairs (equiv of $_POST)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function friendDelete($username, $post = array(), $query = array(), $rawJson = false) {
    	    if ( $currentUser = $this->currentUserLogin() ) {
        	    if ( $json = $this->_post('/users/'.$currentUser.'/friendships/'.$username.'.json', $post, 'delete', $query, true) )
        		    return $this->_parseApi($json, $rawJson);
        		else
        			return false;
    		} else {
    		    return false;
    		}
    	}
        
    	/**
    	 * Returns an individual user's associated actions list, optionally based on the submitted query
    	 *
         * @param string $username Username
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 1.5
    	 */
        function actions($username, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/users/'.$username.'/actions.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    }
}
?>