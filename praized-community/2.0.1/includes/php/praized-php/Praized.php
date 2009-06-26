<?php
/**
 * Praized Portable PHP Library
 * 
 * Complete integration library to interact with the Praized API, OAuth process, etc.
 * 
 * @note Using the OAuth functionalities will make this library PHP5+ only
 *
 * @version 2.0
 * @package Praized
 * @author Stephane Daury for Praized Media, Inc.
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
    	 * Merchants object instance holder
    	 * @var object
    	 * @since 0.1
    	 */
    	var $_merchantsInst;
    	
    	/**
    	 * Merchant object instance holder
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
    	 * Actions object instance holder
    	 * @var object
    	 * @since 1.6
    	 */
    	var $_actionsInst;
    
    	/**
    	 * Questions object instance holder
    	 * @var object
    	 * @since 1.6
    	 */
    	var $_questionsInst;
    	
    	/**
    	 * Question object instance holder
    	 * @var object
    	 * @since 1.6
    	 */
    	var $_questionInst;
    	
    	/**
    	 * Actions object instance holder
    	 * @var object
    	 * @since 2.0
    	 */
    	var $_communitiesInst;
    	
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
    	    // .json on community slug directly
    	    if ( $json = $this->_get('.json') ) {
    	        if ( $community = $this->_parseApi($json) ) {
    	            if ( isset($community->errors) )
    		            $this->errors = $community->errors;
    		        else
    		            return $community;
    	        }
    	    }
    	    return false;
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
    	
    	/**
    	 * Convenience PraizedActions instantiator (for PHP4 compat)
    	 *
    	 * @return object PraizedActions
    	 * @since 1.5
    	 */
    	function actions() {
    		if (is_object($this->_actionsInst))
    			return $this->_actionsInst;
    		$this->_loadClass('Actions');
    		$this->_actionsInst = new PraizedActions($this->_community, $this->_apiKey, $this->_oAuthInst);
    		if ( isset($this->_actionsInst->errors) )
    		    $this->errors = $this->_actionsInst->errors;
    		return $this->_actionsInst;
    	}
    	
    	/**
    	 * Convenience PraizedQuestions instantiator (for PHP4 compat)
    	 *
    	 * @return object PraizedQuestions
    	 * @since 1.6
    	 */
    	function questions() {
    		if (is_object($this->_questionsInst))
    			return $this->_questionsInst;
    		$this->_loadClass('Questions');
    		$this->_questionsInst = new PraizedQuestions($this->_community, $this->_apiKey, $this->_oAuthInst);
    		if ( isset($this->_questionsInst->errors) )
    		    $this->errors = $this->_questionsInst->errors;
    		return $this->_questionsInst;
    	}
    	
    	/**
    	 * Convenience PraizedQuestion instantiator (for PHP4 compat)
    	 *
    	 * @return object PraizedQuestion
    	 * @since 1.6
    	 */
    	function question() {
    		if (is_object($this->_questionInst))
    			return $this->_questionInst;
    		$this->_loadClass('Question');
    		$this->_questionInst = new PraizedQuestion($this->_community, $this->_apiKey, $this->_oAuthInst);
    		if ( isset($this->_questionInst->errors) )
    		    $this->errors = $this->_questionInst->errors;
    		return $this->_questionInst;
    	}
    	
    	/**
    	 * Convenience PraizedCommunities instantiator (for PHP4 compat)
    	 *
    	 * @return object PraizedActions
    	 * @since 2.0
    	 */
    	function communities() {
    		if (is_object($this->_communitiesInst))
    			return $this->_communitiesInst;
    		$this->_loadClass('Communities');
    		$this->_communitiesInst = new PraizedCommunities($this->_community, $this->_apiKey, $this->_oAuthInst);
    		if ( isset($this->_communitiesInst->errors) )
    		    $this->errors = $this->_communitiesInst->errors;
    		return $this->_communitiesInst;
    	}
    }
}
?>