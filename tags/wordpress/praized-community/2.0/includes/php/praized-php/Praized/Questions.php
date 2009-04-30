<?php
/**
 * Praized Portable PHP Library: Questions
 * 
 * Note: Using the OAuth functionalities will make this library PHP5+ only
 *
 * @version 2.0
 * @package Praized
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedQuestions') ) {
    require_once(dirname(realpath(__FILE__)).'/Core.php');
    
    /**
     * Praized Portable PHP Library: Questions: Class
     * 
     * Note: Using the OAuth functionalities will make this library PHP5+ only
     * 
     * @package Praized
     * @since 1.6
     */
    class PraizedQuestions extends PraizedCore {
    	/**
    	 * Constructor
    	 *
    	 * @param string $community [required] Praized community permalink
    	 * @param string $apiKey [required] Praized API key
    	 * @param mixed obj|null $oAuth PraizedOauth (../PraizedOauth.php) instance, as reference. Pass NULL for read-only (PHP4-compat) mode
    	 * @param string $consumerKey oAuth consumer key for write access
    	 * @param string $consumerSecret oAuth consumer secret for write access
    	 * @return PraizedQuestions
    	 * @since 1.6
    	 */
        function PraizedQuestions($community, $apiKey, &$oAuth, $consumerKey = null, $consumerSecret = null) {
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
    	 * Returns a list of questions objects, optionally based on the submitted query
    	 *
         * @param array $query Associative array matching the query string keys supported by the Praized API.
         * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
         * @since 1.6
    	 */
    	function get($query = array(), $rawJson = false) {
    	    if ( $json = $this->_get('/questions.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    }
}
?>