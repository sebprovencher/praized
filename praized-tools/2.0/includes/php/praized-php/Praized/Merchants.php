<?php
/**
 * Praized Portable PHP Library: Merchants
 * 
 * Note: Using the OAuth functionalities will make this library PHP5+ only
 *
 * @version 2.0
 * @package Praized
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedMerchants') ) {
    require_once(dirname(realpath(__FILE__)).'/Core.php');
    
    /**
     * Praized Portable PHP Library: Merchants: Class
     * 
     * Note: Using the OAuth functionalities will make this library PHP5+ only
     * 
     * @package Praized
     * @since 0.1
     */
    class PraizedMerchants extends PraizedCore {
    	/**
    	 * Constructor
    	 *
    	 * @param string $community [required] Praized community permalink
    	 * @param string $apiKey [required] Praized API key
    	 * @param mixed obj|null $oAuth PraizedOauth (../PraizedOauth.php) instance, as reference. Pass NULL for read-only (PHP4-compat) mode
    	 * @param string $consumerKey oAuth consumer key for write access
    	 * @param string $consumerSecret oAuth consumer secret for write access
    	 * @return PraizedMerchants
    	 * @since 0.1
    	 */
        function PraizedMerchants($community, $apiKey, &$oAuth, $consumerKey = null, $consumerSecret = null) {
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
    	 * Returns a list of merchants objects, optionally based on the submitted query
    	 *
         * @param array $query Associative array matching the query string keys supported by the Praized API.
         * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
         * @since 0.1
    	 */
    	function get($query = array(), $rawJson = false) {
    	    if ( $json = $this->_get('/merchants.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Returns a list of merchants objects, optionally based on the submitted parameters
    	 *
         * @param string $term Search term
         * @param string $location City/location
         * @param integer $limit Resultset limit
         * @param array $extra_query Supplemental query parameters (page, details, etc)
         * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
         * @since 0.1
    	 */
    	function search($term = '', $location = '', $limit = 10, $extra_query = array(), $rawJson = false) {
    	    if ( ! $term )     $term     = '';
    	    if ( ! $location ) $location = '';
    	    if ( ! $limit )    $limit    = 10;
    	    	    
    	    $query = array(
    	        'q'        => $term,
    	        'l'        => $location,
    	        'per_page' => $limit,
    	        'page'     => 1
    	    );
    	    
    	    if ( is_array($extra_query) && count($extra_query) > 0 )
    	        $query = array_merge($query, $extra_query);
    	        
    	    return $this->get($query, $rawJson);
    	}
    	
    	/*
    	 * Returns a list of merchants objects, based on the submitted pids, permalinks or short urls
    	 * 
    	 * @param array $list List of strings to be matched, in the form of $list = array('pids' => array(), 'permalinks' => array(), 'short_urls' => array())
         * @param integer $limit Resultset limit
         * @param array $extra_query Supplemental query parameters (page, details, etc)
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
    	 * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 */
    	function resolve($list, $limit = 10, $extra_query = array(), $rawJson = false) {
    	    if ( ! is_array($list) )
    	        return false;
    	    	    
    	    $query = array(
    	        'per_page' => $limit,
    	        'page'     => 1
    	    );
    	    
    	    if ( is_array($extra_query) && count($extra_query) > 0 )
    	        $query = array_merge($query, $extra_query);
    	    
    	    if ( $json = $this->_post('/merchants/search.json', $list, 'post', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    }
}
?>