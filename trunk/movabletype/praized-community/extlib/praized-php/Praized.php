<?php
/**
 * Praized Portable PHP Library
 * 
 * Complete integration library to interact with the Praized API, OAuth process, etc.
 * 
 * @note Using the OAuth functionalities will make this library PHP5+ only
 *
 * @version 1.0.2
 * @package Praized
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('Praized') ) {
    require_once(dirname(realpath(__FILE__)).'/Praized/Core.php');
    require_once(dirname(realpath(__FILE__)).'/PraizedLogger.php');

    /**
     * Praized Portable PHP Library: Class
     * 
     * @package Praized
     * @since 0.1
     */
    class Praized extends PraizedCore {
    	/**
         * PraizedOAuth class instance
         * @var object
         * @since 0.1
         */
        var $_oAuthInst;
        
        /**
    	 * Community object instance holder
    	 * @var object
    	 * @since 0.1
    	 */
    	var $_communityInst;
    
    	/**
    	 * Merchants object instance holder
    	 * @var object
    	 * @since 0.1
    	 */
    	var $_merchantsInst;
    	
    	/**
    	 * Merchants object instance holder
    	 * @var object
    	 * @since 0.1
    	 */
    	var $_merchantInst;
    	
    	/**
    	 * User object instance holder
    	 * @var object
    	 * @since 0.1
    	 */
    	var $_userInst;
    	
    	/**
    	 * Constructor.
    	 * 
    	 * @param string $community [required] Praized community slug
    	 * @param string $apiKey [required] Praized API key
    	 * @param string $consumerKey oAuth consumer key for write access
    	 * @param string $consumerSecret oAuth consumer secret for write access
    	 * @return Praized
    	 * @since 0.1
    	 */
    	function Praized($community, $apiKey, $consumerKey = null, $consumerSecret = null) {
    		if ( $consumerKey && $consumerSecret ) {
        	    include_once dirname(realpath(__FILE__)) . "/PraizedOAuth.php";
        	    $this->_oAuthInst = new PraizedOAuth($consumerKey, $consumerSecret, $this->_praizedHosts['auth']);
    		} else {
    		    $this->_oAuthInst = null;
    		}
    	    
    		parent::PraizedCore($community, $apiKey, $this->_oAuthInst);
    	}
    	
    	/**
    	 * API connectivity and configuration test
    	 *
    	 * @return boolean
    	 * @since 0.1
    	 */
    	function test() {
    	    // $obj = $this->community(); // API not ready
    	    $tmp = $this->merchant();
    	    $obj = $tmp->attribute(1, 'pid');
    	    if ( ! $obj || isset($obj->errors) ) {
    	        if ( is_object($obj) )
    	            $this->errors = $obj->errors;
    	        return false;
    	    } else {
    	        return true;
    	    }
    	}
    	
    	/**
    	 * Convenience PraizedCommunity instantiator (for PHP4 compat)
    	 *
    	 * @return object PraizedCommunity
    	 * @since 0.1
    	 */
    	function community() {
    		if (is_object($this->_communityInst))
    			return $this->_communityInst;
    		$this->_loadClass('Community');
    		$this->_communityInst = new PraizedCommunity($this->_community, $this->_apiKey, $this->_oAuthInst);
    		if ( isset($this->_communityInst->errors) )
    		    $this->errors = $this->_communityInst->errors;
    		return $this->_communityInst;
    	}
    	
    	/**
    	 * Convenience PraizedMerchants instantiator (for PHP4 compat)
    	 *
    	 * @return object PraizedMerchants
    	 * @since 0.1
    	 */
    	function merchants() {
    		if (is_object($this->_merchantsInst))
    			return $this->_merchantsInst;
    		$this->_loadClass('Merchants');
    		$this->_merchantsInst = new PraizedMerchants($this->_community, $this->_apiKey, $this->_oAuthInst);
    		if ( isset($this->_merchantsInst->errors) )
    		    $this->errors = $this->_merchantsInst->errors;
    		return $this->_merchantsInst;
    	}
    	
    	/**
    	 * Convenience PraizedMerchant instantiator (for PHP4 compat)
    	 *
    	 * @return object PraizedMerchant
    	 * @since 0.1
    	 */
    	function merchant() {
    		if (is_object($this->_merchantInst))
    			return $this->_merchantInst;
    		$this->_loadClass('Merchant');
    		$this->_merchantInst = new PraizedMerchant($this->_community, $this->_apiKey, $this->_oAuthInst);
    		if ( isset($this->_merchantInst->errors) )
    		    $this->errors = $this->_merchantInst->errors;
    		return $this->_merchantInst;
    	}
    	
    	/**
    	 * Convenience PraizedUser instantiator (for PHP4 compat)
    	 *
    	 * @return object PraizedUser
    	 * @since 0.1
    	 */
    	function user() {
    		if (is_object($this->_userInst))
    			return $this->_userInst;
    		$this->_loadClass('User');
    		$this->_userInst = new PraizedUser($this->_community, $this->_apiKey, $this->_oAuthInst);
    		if ( isset($this->_userInst->errors) )
    		    $this->errors = $this->_userInst->errors;
    		return $this->_userInst;
    	}
    }
}
?>