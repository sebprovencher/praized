<?php
/**
* PraizedMTApi
* This is a specific mt wrapper for the Praized's API
* Every call to the praized api is cache into a specific MT database.
* 
* @version 0.1
*/
class PraizedMTApi {
	/**
	* 
	* @var 
	* @since 0.1
	*/  
	var $Praized;
	
	/**
	* Reference to the cache object 
	*
	* @var MTCachedApi 
	* @since 0.1
	*/
	var $_cache;
	
	/**
	* Default time for caching.
	* @var int
	* @since 0.1
	*/  
	var $_cacheTime;
	
	/**
	* Links relation
	* @var 
	* @since 0.1
	*/
	    

	/**
	* PraizedMTApi();
	* 
	* Constructor.
	* @since 0.1
	*/
	function PraizedMTApi() {
		$configs = PraizedMTConfigs::getInstance();
		
		$this->Praized = new Praized($configs->getPraizedCommunitySlug(), 
									 $configs->getPraizedApiKey(), 
									 $configs->getPraizedConsumerKey(), 
									 $configs->getPraizedConsumerSecret());
									
		$this->_cache = PraizedMTCachedApiDB::getInstance();
		
		$this->_cacheTime = $configs->getPraizedTimeCacheApi();
	}
	
	/**
	* merchant_get();
	*
	* Make a standard json request to the Praized Platform.
	*
	* @param string $identifier Identifiant du marchant
	* @param array extra query parameters
	* @return object Return a php object.
	* @since 0.1
	*/
	function merchant_get($identifier, $query = array()) {
		$key = "merchant_get:$identifier";
		
		if(($results = $this->_cache->get($key)) == null) {
			$results = $this->Praized->merchant()->get($identifier, $query);
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}
		
		return $results;
	}

	/**
	* merchant_get_xhtml();
	*
	* make a xhtml fragment request to the praized api.
	*
	* @param string $identifier identifiant
	* @param array $extra_query Extra parameters to add to the query
	* @return string xhtml fragment of a merchant.
	* @since 0.1
	*/
	function merchant_get_xhtml($identifier, $query = array()) {
		$key = "merchant_get_xhtml:$identifier";

		if(($results = $this->_cache->get($key)) == null) {
			$results = $this->Praized->merchant()->xhtml($identifier, $query);

			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		} 
		return $results;
	}

	/**
	* merchant_search_xhtml();
	*
	* Make a search call to the praized api.
	*
	* @param string $term Query words
	* @param string $location The city.
	* @param string $limit How many items to fetch
	* @param array $extra_query Extra parameters to add to the query
	* @return string xhtml fragment of many merchants
	*/
	function merchant_search_xhtml($term = '', $location = '', $limit = 10, $extra_query = array()) {
		$key = "merchant_search_xhtml:$term:$location:$limit:" . 
										$this->md5Hash($extra_query);
		
		if(($results = $this->_cache->get($key)) == null) {
			
			$results = $this->Praized->merchants()->xhtml(
														$term, 
														$location, 
														$limit, 
														$extra_query);
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}

		return $results;
	}
	
	/**
	* Do a search with the API and return a JSon object.
	*
	* @param string $term Search terms.
	* @param string $location Location.
	* @param integer $limit Limit the scope of the query
	* @param hash $extra_query Extra parameters like paging options.
	* @return object Return a collection of merchant
	* @since 0.1
	*/
	function merchant_search($term = '', $location = '', $limit = 10, $extra_query = array()) {
		$key = "merchant_search:$term:$location:$limit:" . 
										$this->md5Hash($extra_query);
		
		if(($results = $this->_cache->get($key)) == null) {
			
			$results = $this->Praized->merchants()->search(
														$term, 
														$location, 
														$limit, 
														$extra_query);
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}

		return $results;
	}
	
	/**
	* Fetch the merchants top for the current community.
	* TODO: remove this this is deprecated
	*
	* @param string $term Search terms.
	* @param string $location Location.
	* @param integer $limit Limit the scope of the query
	* @param hash $extra_query Extra parameters like paging options.
	* @return object Return a collection of merchant
	* @since 0.1
	*/
	function merchants_top($term = '', $location = '', $limit = 10, $extra_query = array()) {
		$key = "merchants_top:$term:$location:$limit:" . 
										$this->md5Hash($extra_query);
		
		if(($results = $this->_cache->get($key)) == null) {
			
			$results = $this->Praized->merchants()->search(
														$term, 
														$location, 
														$limit, 
														$extra_query);
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}

		return $results;
	}
		
	/**
	* merchant_comments();
	* 
	* Get the comments for the current merchant.
	*
	* @param string $pid Merchant's PID
	* @param array $query Extra parameters.
	* @return Object Collection of Comments
	* @since 0.1
	*/
	function merchant_comments($pid, $query = array()) {
		$key = "merchant_comments:$pid:" . $this->md5Hash($query);

		if(($results = $this->_cache->get($key)) == null) {
			$results = $this->Praized->merchant()->comments($pid, $query);
			
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}
		
		return $results;
	}
	
	/**
	* Add comment to a merchant
	*
	* @param string $pid Merchant's pid
	* @param hash Comment to add.
	* @param string $callback callback url
	* @return object Return the JSON object for the current request.
	* @since 0.1
	*/
	function merchant_comment_add($pid, $data, $callback = null) {
		return $this->Praized->merchant()->commentAdd($pid, $data, $callback);
	}
	
	/**
	* Add merchant to favorites
	*
	* @param string $pid Merchant's pid
	* @param hash Additionnal data
	* @param string $callback callback url
	* @return object Return the JSON object for the current request.
	* @since 0.1
	*/	
	function merchant_favorite_add($pid, $data, $callback = null) {
		return $this->Praized->merchant()->favoriteAdd($pid, $data, $callback);
	}

	/**
	* Delete this merchant from the user favorites.
	*
	* TODO: Not yet implemented in the api.
	*
	* @param string $pid Merchant's pid
	* @param hash Comment to add.
	* @param string $callback callback url
	* @return object Return the JSON object for the current request.
	* @since 0.1
	*/	
	function merchant_favorite_delete($pid, $data, $callback = null) {
		return $this->Praized->merchant()->favoriteDelete($pid, $data, $callback);
	}
	
	/**
	* add a vote for the current user for a specified merchant
	*
	* @param string $pid Merchant's pid
	* @param hash Comment to add.
	* @param string $callback callback url
	* @return object Return the JSON object for the current request.
	* @since 0.1
	*/
	function merchant_vote_add($pid, $data, $callback = null) {
		return $this->Praized->merchant()->voteAdd($pid, $data, $callback);
	}
	
	
	/**
	* Add tags on the merchant
	*
	* @param string $pid Merchant's pid
	* @param hash Comment to add.
	* @param string $callback callback url
	* @return object Return the JSON object for the current request.
	* @since 0.1
	*/
	function merchant_tag_add($pid, $data, $callback = null) {
		$call  = $this->Praized->merchant()->tagAdd($pid, $data, $callback);		
		return $call;
	}
	
	/**
	* Check if the current user is authenticated.
	*
	* @return Boolean True is the user is authenticated.
	* @since 0.1
	*/
	function user_is_authorized() {
		return $this->Praized->isAuthorized();
	}
	
	/**
	* Retreive the merchant praizers
	*
	* @param string $pid the merchant pid
	* @param hash $query specific query
	* @return object Return the JSON object  for the current request
	* @since 0.1
	*/
	function merchant_praizers($pid, $query = array()) {
		$key = "merchants_praizers:$pid:" . $this->md5Hash($query);
		if(($results = $this->_cache->get($key)) == null) {
			$results = $this->Praized->merchant()->votes($pid, $query);
			
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}
		
		return $results;
	}
	
	/**
	* Retreive the merchant favorers
	*
	* @param string $pid the merchant pid
	* @param hash $query specific query
	* @return object collection of user objects
	* @since 0.1
	*/
	function merchant_favorers($pid, $query = array()) {
		$key = "merchants_favorites:$pid:" . $this->md5Hash($query);

		if(($results = $this->_cache->get($key)) == null) {
			$results = $this->Praized->merchant()->favorites($pid, $query);
			
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}
		
		return $results;
	}
	
	/**
	* user_get();
	* 
	* Get the Specific user
	* @param string $pid username
	* @param array $query Extra parameters
	* @return object User object
	* @since 0.1
	*/
	function user_get($pid, $query = array()) {
		$key = "user_get:$pid:" . $this->md5Hash($query);
		
		if(($results = $this->_cache->get($key)) == null) {
			$results = $this->Praized->user()->get($pid);
			
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}
		return $results;
	}
	
	/**
	* Return the user favorites
	*
	* @param string $pid the merchant pid
	* @param hash $query specific query
	* @return object collection of user objects
	* @since 0.1
	*/
	function user_favorites($pid, $query = array()) {
		$key = "user_favorites:$pid:" . $this->md5Hash($query);

		if(($results = $this->_cache->get($key)) == null) {
			$results = $this->Praized->user()->favorites($pid, $query);
			
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}
		
		return $results;
	}

	/**
	* Get the friends user
	*
	* @param string $pid username
	* @param hash $query specific
	* @return object collection of user object
	* @since 0.1
	*/
	function user_friends($pid, $query = array()) {
		$key = "user_friends:$pid:" . $this->md5Hash($query);

		if(($results = $this->_cache->get($key)) == null) {
			$results = $this->Praized->user()->friends($pid, $query);
			
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}
		
		return $results;
	}

	/**
	* Votes for a specific user
	* 
	* @param string $pid username
	* @param hash $query
	* @return object collection of user object
	* @since 0.1
	*/
	function user_votes($pid, $query = array()) {
		$key = "user_votes:$pid:" . $this->md5Hash($query);

		if(($results = $this->_cache->get($key)) == null) {
			$results = $this->Praized->user()->votes($pid, $query);
			
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}
		
		return $results;
	}

	/**
	* Get the comments for the current user
	*
	* @param string $pid username
	* @param hash $query extra parameters
	* @return object collection of comments
	* @since 0.1
	*/
	function user_comments($pid, $query = array()) {
		$key = "user_comments:$pid:" . $this->md5Hash($query);
		
		if(($results = $this->_cache->get($key)) == null) {
			$results = $this->Praized->user()->comments($pid, $query);
			
			if($results) $this->_cache->set($key, $results, $this->_getCacheTime());
		}
		
		return $results;
	}
	
	/**
	* Add a friend to a specific user.
	* We use the oauth session to add the user to the current user.
	*
	* @param string $user to add to the current logged user.
	* @param hash $data custom data to add.
	* @return object JSON object of the user added.
	* @since 0.1
	*/
	function user_friend_add($user, $data = array(), $callback = null) {
		return $this->Praized->user()->friendAdd($user, $data, $callback);
	}
	
	
	/**
	* Delete a friend for the current user.
	*
	* TODO, not yet implemented
	*
	* @param string $user user to delete from the friends list
	* @param hash $data extra parameters for the call.
	* @param string $callback url to go after the action
	* @return object JSON object of the user removed
	* @since 0.1
	*/
	function user_friend_delete($user, $data = array(), $callback = null) {
		return $this->Praized->user()->friendDelete($user, $data, $callback);
	}
	
	/**
	* Add a favorite for the current logged user
	*
	* @param string $pid Merchant pid
	* @param hash $data extra parameters for the call
	* @param string $callback url to go after the action
	* @return object JSON object of the merchant added.
	* @since 0.1
	*/
	function user_favorite_add($pid, $data = array(), $callback = null) {
		return $this->Praized->merchant()->favoriteAdd($pid);
	}
	
	/**
	 * Login or logout the current user
	 *
	 * @param string $url url to go after action
	 * @since 0.1
	 */
	function session($url) {
		$this->Praized->session($url);
	}
	
	/**
	 * login the user
	 *
	 * @param string $url user to go after login.
	 * @since 0.1
	 */
	function login($url) {
		$this->Praized->_oAuth->startAuthorization($url);
	}
	
	/**
	* Return the login of the current logged 
	* user or false if not logged
	*
	*
	* @return mixed false if not logged or the user login. 
	* @since 0.1
	*/
	function current_user_login() {
	    return ( is_object($this->Praized) ) ? $this->Praized->currentUserLogin() : FALSE;
	}
	
	/**
	 * Google Static Map integration, returns image tag
	 * See see http://code.google.com/apis/maps/documentation/staticmaps/
	 *
	 * @param float  $latitude
	 * @param float  $longitude
	 * @param array  $rawParams Optional static map url parameters overwrites (except api key)
	 * @return mixed Boolean false or String Map image tag
	 * @since 0.1
	 */
	function google_map($latitude, $longitude, $rawParams = array()) {
	    $key = PraizedMTConfigs::getInstance()->getGoogleMapsApiKey();
	    if ( empty($key) )
	        return FALSE;
	    if ( $img = $this->Praized->googleMap($key, $latitude, $longitude, $rawParams) )
	        return $img;
	    else
	        return FALSE;
	}

	/**
     * Returns the desired common Praized links from $this->Praized->praizedLinks
     *
     * @param string Key in PraizedCommunity::Praized->praizedLinks
     * @return mixed Boolean FALSE or String link
     * @since 0.1
     */
    function praized_link($link) {
        if ( is_object($this->Praized) ) {
            return ( ! empty($this->Praized->praizedLinks[$link]) )
                ? $this->Praized->praizedLinks[$link]
                : FALSE;
        } else {
            return FALSE;
        }
    }
	
	/**
	* expiration time
	* 
	* @return int Cache time
	*/
	function _getCacheTime() {
		return $this->_cacheTime;
	}


	/**
	* getInstance();
	* This is a Singleton class.
	* Return the current instance or initialize it.
	*
	* @return PraizedMTCachedApiDB
	* @since 0.1
	*/
	function &getInstance($mt = null) {
		static $current_instance;
		
		if(!isset($current_instance)) {
			$current_instance = array(new PraizedMTApi($mt));
		}
		return $current_instance[0];
	}
	
	function linkHelper($location, $raw = false) {
		
	}

	/**
	* md5Hash();
	*
	* Take the contents of a hash and run md5 on the joined elements.
	* 
	* @param Hash $h Hash to md5
	* @since 0.1
	*/
	function md5Hash($h) {
		return md5(join(":", $h));
	}
}
?>