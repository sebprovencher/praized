<?php
/**
 * Praized Portable PHP Library: Community
 * 
 * Note: Using the OAuth functionalities will make this library PHP5+ only
 *
 * @version 1.0.2
 * @package Praized
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedCommunity') ) {
    require_once(dirname(realpath(__FILE__)).'/Core.php');
    
    /**
     * Praized Portable PHP Library: Community: Class
     * 
     * Note: Using the OAuth functionalities will make this library PHP5+ only
     * 
     * @package Praized
     * @since 0.1
     */
    class PraizedCommunity extends PraizedCore {
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
        function PraizedCommunity($community, $apiKey, &$oAuth, $consumerKey = null, $consumerSecret = null) {
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
    	 * Returns an individual community object
    	 *
         * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
         * @since 0.1
    	 */
    	function get($rawJson = false) {
    		if ($json = $this->_get('.json')) // .json on community slug directly
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    }
}
?>