<?php
/**
 * Praized Portable PHP Library: Question
 * 
 * Note: Using the OAuth functionalities will make this library PHP5+ only
 *
 * @version 2.0
 * @package Praized
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedQuestion') ) {
    require_once(dirname(realpath(__FILE__)).'/Core.php');
    
    /**
     * Praized Portable PHP Library: Question: Class
     * 
     * Note: Using the OAuth functionalities will make this library PHP5+ only
     * 
     * @package Praized
     * @since 1.6
     */
    class PraizedQuestion extends PraizedCore {
    	/**
    	 * Constructor
    	 *
    	 * @param string $community [required] Praized community permalink
    	 * @param string $apiKey [required] Praized API key
    	 * @param mixed obj|null $oAuth PraizedOauth (../PraizedOauth.php) instance, as reference. Pass NULL for read-only (PHP4-compat) mode
    	 * @param string $consumerKey oAuth consumer key for write access
    	 * @param string $consumerSecret oAuth consumer secret for write access
    	 * @return PraizedQuestion
    	 * @since 1.6
    	 */
        function PraizedQuestion($community, $apiKey, &$oAuth, $consumerKey = null, $consumerSecret = null) {
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
    	 * Returns an individual question object, optionally based on the submitted query
    	 *
         * @param string $pid Question PID
         * @param array  $query Associative array matching the query string keys supported by the Praized API.
         * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
         * @since 1.6
    	 */
    	function get($pid, $query = array(), $rawJson = false) {
			if ( $json = $this->_get('/questions/' . $pid . '.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
        }
    	
    	/**
    	 * Returns an individual question's attribute value, optionally based on the submitted query
    	 *
         * @param string $pid Question PID
    	 * @param string $attribute Question attribute (permalink, name)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false or mixed value as returned by the Praized API
    	 * @since 1.6
    	 */
    	function attribute($pid, $attribute, $query = array()) {
    		if ($json = $this->_get('/questions/'.$pid.'/'.$attribute.'.json', $query)) {
    			$obj = $this->_parseApi($json);
    			return ( is_object($obj) && isset($obj->question->$attribute) )
    	            ? $obj->question->$attribute
    	            : false;
    		} else {
    			return false;
    		}
    	}
    	
    	/**
    	 * Add a new question
    	 *
         * @param array  $post Post vars key/value pairs (equiv of $_POST)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 1.6
    	 */
    	function add($post = array(), $query = array(), $rawJson = false) {
    		/**
    		 * We currently have to do the following to bypass a php to
    		 * rails conflict with the meaning of [] in form field names.
    		 * With the following, we only need to name our fields "content",
    		 * but "question[content]" is also supported
    		 */
    	    $fields = array('what', 'where', 'adjective', 'content');
    	    foreach ( $post as $key => $value ) {
            	if ( is_string($value) )
            		$value = stripslashes(rawurldecode($value));
    	        if ( in_array($key, $fields) && ! isset($post["question[$key]"]) ) {
    	        	unset($post[$key]);
    	        	$post["question[$key]"] = $value;
    	        }
    	    }
    		if ( $json = $this->_post('/questions.json', $post, 'post', $query, true) )
    		    return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Returns a list of potentially related merchants for the current question
    	 *
         * @param string $pid Question PID
         * @param array  $query Associative array matching the query string keys supported by the Praized API.
         * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
         * @since 1.6
    	 */
    	function relatedMerchants($pid, $query = array(), $rawJson = false) {
			if ( $json = $this->_get('/questions/' . $pid . '/related_merchants.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
        }
    	
    	/**
    	 * Returns an individual question's associated answers list, optionally based on the submitted query
    	 *
         * @param string $pid Question PID
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 1.6
    	 */
    	function answers($pid, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/questions/'.$pid.'/answers.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Returns an individual answer, optionally based on the submitted query
    	 *
         * @param string $pid Answer PID
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 1.6
    	 */
    	function answer($pid, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/answers/'.$pid.'.json', $query) ) {
    			if ( $data = $this->_parseApi($json, $rawJson) ) {
	    			if ( isset($data->answer->deleted_at) ) {
	    				if ( isset($data->answer->merchants) )
	    					unset($data->answer->merchants);
	    				$data->answer->content = 'This answer has been deleted.';
	    			}
    			}
    			return $data;
    		} else {
    			return false;
    		}
    	}
    	
    	/**
    	 * Add a new answer
    	 *
         * @param string $pid Question PID
    	 * @param array  $post Post vars key/value pairs (equiv of $_POST)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 1.6
    	 */
    	function answerAdd($pid, $post = array(), $query = array(), $rawJson = false) {
    		/**
    		 * We currently have to do the following to bypass a php to
    		 * rails conflict with the meaning of [] in form field names.
    		 * With the following, we only need to name our fields "content",
    		 * but "answer[content]" is also supported
    		 */
    	    $fields = array('content', 'pids');
    	    foreach ( $post as $key => $value ) {
            	if ( is_string($value) )
            		$value = stripslashes(rawurldecode($value));
    	        if ( in_array($key, $fields) && ! isset($post["answer[$key]"]) ) {
    	        	unset($post[$key]);
    	        	$post["answer[$key]"] = $value;
    	        }
    	    }
    		if ( $json = $this->_post('/questions/'.$pid.'/answers.json', $post, 'post', $query, true) )
    		    return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Delete an answer
    	 *
         * @param string $pid Answer PID
    	 * @param array  $post Post vars key/value pairs (equiv of $_POST)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 1.6
    	 */
    	function answerDelete($pid, $post = array(), $query = array(), $rawJson = false) {
    		if ( $currentUser = $this->currentUserLogin() ) {
        	    if ( $json = $this->_post('/answers/'.$pid.'.json', $post, 'delete', $query, true) )
        		    return $this->_parseApi($json, $rawJson);
        		else
        			return false;
    		} else {
    		    return false;
    		}
    	}
    }
}
?>