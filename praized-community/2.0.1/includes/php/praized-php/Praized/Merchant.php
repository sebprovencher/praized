<?php
/**
 * Praized Portable PHP Library: Merchant
 * 
 * Note: Using the OAuth functionalities will make this library PHP5+ only
 *
 * @version 2.0
 * @package Praized
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedMerchant') ) {
    require_once(dirname(realpath(__FILE__)).'/Core.php');
    
    /**
     * Praized Portable PHP Library: Merchant: Class
     * 
     * Note: Using the OAuth functionalities will make this library PHP5+ only
     * 
     * @package Praized
     * @since 0.1
     */
    class PraizedMerchant extends PraizedCore {
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
        function PraizedMerchant($community, $apiKey, &$oAuth, $consumerKey = null, $consumerSecret = null) {
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
    	 * Returns an individual merchant object, optionally based on the submitted query
    	 *
         * @param string $pid Merchant PID
         * @param array  $query Associative array matching the query string keys supported by the Praized API.
         * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
         * @since 0.1
    	 */
    	function get($pid, $query = array(), $rawJson = false) {
			$url = (preg_match("/^\/places/", $pid)) ? $pid : "/merchants/" . $pid;
    		if ( $json = $this->_get($url . '.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
        }
    	
    	/**
    	 * Returns an individual merchant's attribute value, optionally based on the submitted query
    	 *
         * @param string $pid Merchant PID
    	 * @param string $attribute Merchant attribute (permalink, name)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false or mixed value as returned by the Praized API
    	 * @since 0.1
    	 */
    	function attribute($pid, $attribute, $query = array()) {
    		if ($json = $this->_get('/merchants/'.$pid.'/'.$attribute.'.json', $query)) {
    			$obj = $this->_parseApi($json);
    			return ( is_object($obj) && isset($obj->merchant->$attribute) )
    	            ? $obj->merchant->$attribute
    	            : false;
    		} else {
    			return false;
    		}
    	}
    	
    	/**
    	 * Returns an individual merchant's associated comments list, optionally based on the submitted query
    	 *
         * @param string $pid Merchant PID
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function comments($pid, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/merchants/'.$pid.'/comments.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Adds a new comment to the current merchant on behalf of the current authz'ed user
    	 *
         * @param string $pid Merchant PID
    	 * @param array  $post Post vars key/value pairs (equiv of $_POST)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function commentAdd($pid, $post = array('comment' => ''), $query = array(), $rawJson = false) {
    		/**
    		 * We currently have to do the following to bypass a php to
    		 * rails conflict with the meaning of [] in form field names.
    		 * With the following, we only need to name our field "comment",
    		 * but "comment[comment]" is also supported
    		 */
    	    if ( isset($post['comment']) ) {
        	    $tmp = $post['comment'];
    		    unset($post['comment']);
    		    if ( is_array($post['comment']) ) {
        		    foreach ($tmp as $key => $value)
        		        $post["comment[$key]"] = $value;
        		} else {
        		    $post['comment[comment]'] = $tmp;
        		}
    		}
    		
    		$post['comment[comment]'] = stripslashes($post['comment[comment]']);
    		
    		if ( $json = $this->_post('/merchants/'.$pid.'/comments.json', $post, 'post', $query, true) )
    		    return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Returns an individual merchant's associated votes list (ie: list of users having voted on the merchant), optionally based on the submitted query
    	 *
         * @param string $pid Merchant PID
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function votes($pid, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/merchants/'.$pid.'/votes.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Adds a new vote (if possible) on the current merchant as the current authz'ed user
    	 *
         * @param string $pid Merchant PID
    	 * @param array  $post Post vars key/value pairs (equiv of $_POST)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function voteAdd($pid, $post = array('vote' => 0), $query = array(), $rawJson = false) {
    		/**
    		 * We currently have to do the following to bypass a php to
    		 * rails conflict with the meaning of [] in form field names.
    		 * With the following, we only need to name our field "vote",
    		 * but "vote[rating]" is also supported. We can also send
    		 * either 1|pos or 0|neg
    		 */
            if ( isset($post['vote']) ) {
        	    $tmp = $post['vote'];
    		    unset($post['vote']);
    		    if ( is_array($post['vote']) ) {
        		    foreach ($tmp as $key => $value)
        		        $post["vote[$key]"] = $value;
        		} else {
        		    $post['vote[rating]'] = $tmp;
        		}
    		}
    		
    		if ( $post['vote[rating]'] == '1' )
    		    $post['vote[rating]'] = 'pos';
    		
    		if ( $post['vote[rating]'] == '0' )
    		    $post['vote[rating]'] = 'neg';
    		
    		if ( $post['vote[rating]'] != 'pos' )
    		    $post['vote[rating]'] = 'neg';
    		    
    		$post['vote[rating]'] = stripslashes($post['vote[rating]']);
    		    
    		if ( $json = $this->_post('/merchants/'.$pid.'/votes.json', $post, 'post', $query, true) )
    		    return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Returns an individual merchant's associated favorites list (ie: list of users having favorited the merchant), optionally based on the submitted query
    	 *
         * @param string $pid Merchant PID
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function favorites($pid, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/merchants/'.$pid.'/favorites.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
        }
    	
    	/**
    	 * Adds the merchant as a favorite for the current authz'ed user
    	 *
         * @param string $pid Merchant PID
    	 * @param array  $post Post vars key/value pairs (equiv of $_POST)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function favoriteAdd($pid, $post = array(), $query = array(), $rawJson = false) {
    		$post['favorite'] = ''; // Placeholder because Activeresource doesn't like empty posts.
    	    if ( $json = $this->_post('/merchants/'.$pid.'/favorites.json', $post, 'post', $query, true) )
    		    return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Delete the merchant from the current authz'ed user's favorites
    	 *
         * @param string $pid Merchant PID
    	 * @param array  $post Post vars key/value pairs (equiv of $_POST)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function favoriteDelete($pid, $post = array(), $query = array(), $rawJson = false) {
    		if ( $currentUser = $this->currentUserLogin() ) {
        	    if ( $json = $this->_post('/users/'.$currentUser.'/favorites/'.$pid.'.json', $post, 'delete', $query, true) )
        		    return $this->_parseApi($json, $rawJson);
        		else
        			return false;
    		} else {
    		    return false;
    		}
    	}
    	
    	/**
    	 * Returns an individual merchant's associated tags list, optionally based on the submitted query
    	 *
         * @param string $pid Merchant PID
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
        function tags($pid, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/merchants/'.$pid.'/tags.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Adds a new tag to the current merchant on behalf of the current authz'ed user
    	 *
         * @param string $pid Merchant PID
    	 * @param array  $post Post vars key/value pairs (equiv of $_POST)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function tagAdd($pid, $post = array('tag_list' => ''), $query = array(), $rawJson = false) {
    		/**
    		 * We currently have to do the following to bypass a php to
    		 * rails conflict with the meaning of [] in form field names.
    		 * With the following, we only need to name our field "taggable",
    		 * or tag_list, but "taggable[tag_list]" is also supported
    		 */
    	    if ( isset($post['tagging']) ) {
        	    $tmp = $post['tagging'];
    		    unset($post['tagging']);
    		    if ( is_array($post['tagging']) ) {
        		    foreach ($tmp as $key => $value)
        		        $post["tagging[$key]"] = $value;
        		} else {
        		    $post['tagging[tag_list]'] = $tmp;
        		}
    		} elseif ( isset($post['tag_list']) ) {
    		    $tmp = $post['tag_list'];
    		    unset($post['tag_list']);
    		    $post['tagging[tag_list]'] = $tmp;
    		}
    		
    		$post['tagging[tag_list]'] = stripslashes($post['tagging[tag_list]']);
    		
    		if ( $json = $this->_post('/merchants/'.$pid.'/taggings.json', $post, 'post', $query, true) )
    		    return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
        
    	/**
    	 * Returns an individual merchant's associated actions list, optionally based on the submitted query
    	 *
         * @param string $pid Merchant PID
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 1.5
    	 */
        function actions($pid, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/merchants/'.$pid.'/actions.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
        
    	/**
    	 * Returns an individual merchant's associated communities list, optionally based on the submitted query
    	 *
         * @param string $pid Merchant PID
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @param boolean $rawJson set as true to get the raw Json back, or false (default) to get the data as php object
         * @return mixed boolean false (with $this->errors set) or object/string based on $rawJson, as returned by the Praized API (praized namespace as obj root)
    	 * @since 2.0
    	 */
        function communities($pid, $query = array(), $rawJson = false) {
    		if ( $json = $this->_get('/merchants/'.$pid.'/communities.json', $query) )
    			return $this->_parseApi($json, $rawJson);
    		else
    			return false;
    	}
    	
    	/**
    	 * Looks for the stats image url in a merchant's data and returns
    	 * a consistent image tag or NULL.
    	 *
    	 * @param object $merchantData
    	 * @return string
    	 * @since 0.1
    	 */
    	function statsImage($merchantData) {
    	    if ( ! isset($merchantData->stat_links) || ! is_array($merchantData->stat_links) || count($merchantData->stat_links) < 1 )
    	        return '';
    	    
    	    $images = '';
    	    
    	    foreach ( $merchantData->stat_links as $link ) {
    	        if ( isset($link->url) && preg_match('/^http/', $link->url) )
    	            $images .= '<img src="' . $link->url . '" class="praized-merchant-stats-img" width="1" height="1" border="0" alt="Statistics Target" style="margin:0; padding:0; border:none;" />';
    	    }
    	        
    	    return $images;
    	}
    	
    	/**
    	 * Praized.com sharing integration
    	 *
    	 * @param string $pid
    	 * @return string HTML (script and noscript)
    	 * @since 0.1
    	 */
    	function share($pid) {
            if ( isset($_SERVER['HTTPS']) && ( ! empty($_SERVER['HTTPS']) ) )
                $jsHost = str_replace('http:', 'https:', $this->praizedLinks['static']);
            else
                $jsHost = $this->praizedLinks['static'];

            $returnTo = urlencode($this->returnTo);
            
    	    return <<<____________EOS
    	        <script src="{$jsHost}/praized-com/javascripts/widgets/sludge/widget.js?shareurl={$this->praizedLinks['hub']}/{$this->_community}/merchants/{$pid}/shares/new" type="text/javascript" charset="utf-8"></script>
                <noscript><a href="{$this->praizedLinks['hub']}/{$this->_community}/merchants/{$pid}/shares/new?return_to={$returnTo}" class="share-this action" rel="nofollow">share</a></noscript>
____________EOS;
    	}
    	
    	/**
    	 * Praized.com twitter integration
    	 *
    	 * @param object $merchantData
    	 * @return string Twitter URL with merchant data
    	 * @since 1.0.4
    	 */
    	function twitterLink($merchantData) {
    	    if ( !is_object($merchantData) || ! isset($merchantData->name) )
    	        return false;
    	    $str = $merchantData->name;
    	    if ( isset($merchantData->location->city->name))
    	        $str .= ', ' . $merchantData->location->city->name;
    	    if ( isset($merchantData->location->regions->state))
    	        $str .= ', ' . $merchantData->location->regions->state;
    	    if ( isset($merchantData->location->regions->province))
    	        $str .= ', ' . $merchantData->location->regions->province;
    	    if ( isset($merchantData->location->country->name))
    	        $str .= ', ' . $merchantData->location->country->name;
    	    $str .= ', ' . $merchantData->short_url;
    	    return 'http://twitter.com/home?status=' . rawurlencode($str);
    	}
    }
}
?>