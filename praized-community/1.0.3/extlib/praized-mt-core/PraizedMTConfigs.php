<?php
/**
* Small wrapper for defaults configuration
* for the MTConfigs.
*/
class PraizedMTConfigs {
	/**
	* Minimun Time to cache
	* TODO, this is not used.
	* @var int
	* @since 0.1
	*/
	static $MINIMUM_TIME_TO_CACHE = 10; // seconds.
	
	/**
	* Singleton reference
	* 
	* @var PraizedMTConfigs
	* @since 0.1
	*/  
	static $current_instance;
	
	/**
	 * We save the configuration in this hash
	 * after initialization
	 *
	 * @var hash
	 */
	 var $_configs = array();
	
	/**
	* Constructor
	*
	* @param MTViewer MT object 
	* @since 0.1
	*/
	function PraizedMTConfigs(&$ref_mt = null, $blog_id = null) {
		// we use the global $mt object to fetch the related
		// configs data from the db.
		
		if(is_null($ref_mt)) {
			global $mt;
			$db 		   = $mt->db();
		} else {
			$mt = $ref_mt; 
			$db = $ref_mt->db();
		}

		
		if(is_null($blog_id))
			$blog_id = $mt->blog_id;
		
				
		// fetch all the configs for this plugin
		$results = $db->fetch_plugin_config("Praized Community", "blog:" . $blog_id);

		if($results)
			$this->_configs = $results;
			
	}

	/**
	* Praized Community slug
	*
	* @return string Praized Community slug
	* @since 0.1
	*/
	function getPraizedCommunitySlug(){
		return $this->_configs["praized_community_slug"];
	}
	
	/**
	* Praized api key
	*
	* @return string praized api key
	* @since 0.1
	*/
	function getPraizedApiKey() {
		return $this->_configs["praized_api_key"];
	}
	
	/**
	* Return Praized Cached time
	*
	* TODO, this is not ye implemented.
	*
	* @return int time in seconds
	* @since 0.1
	*/
	function getPraizedTimeCacheApi() {
		if($this->_configs["praized_time_cache_api"] < $MINIMUM_TIME_TO_CACHE)
			$this->_configs["praized_time_cache_api"] = $MINIMUM_TIME_TO_CACHE;
		return $this->_configs["praized_time_cache_api"];
	}

	/**
	* Praized consumer key for oauth authentification
	*
	* @return string praized consumer key
	* @since 0.1
	*/
	function getPraizedConsumerKey() {
		return $this->_configs["praized_consumer_key"];
	}

	/**
	* Praized consumer secret for oauth authentification
	*
	* @return string praized consumer secret
	* @since 0.1
	*/
	function getPraizedConsumerSecret() {
		return $this->_configs["praized_consumer_secret"];
	}
	
	/**
	* Praized trigger is used to bootstrap api call to the praized's platform.
	* 
	* 
	* @return string return the praized trigger
	* @since 0.1
	*/
	function getPraizedTrigger() {
		$t = $this->_configs["praized_trigger"];

		if( ! preg_match("/^\//", $t) )
			$t = "/" . $t;

		if( ! preg_match("/\/$/", $t) )
			$t .= "/";
			
		return $t;
	}
	
	/**
	* Return an regexp friendly trigger..
	*
	* @return string A trigger regexp 
	* @since 0.1
	*/
	function getPraizedTriggerRegexp() {
		$re = str_replace("/", "\/", $this->getPraizedTrigger());
		return $re;
	}
	
	/**
	* Google maps api key
	*
	* @return string google maps api key
	* @since 0.1
	*/
	function getGoogleMapsApiKey() {
		return $this->_configs["praized_google_maps_api_key"];
	}
	
	/**
	* Google maps width
	*
	* @return integer google maps image width
	* @since 0.1
	*/
	function getGoogleMapsWidth() {
		return intval($this->_configs["praized_google_maps_width"]);
	}
	
	/**
	* Google maps height
	*
	* @return integer google maps image height
	* @since 0.1
	*/
	function getGoogleMapsHeight() {
		return intval($this->_configs["praized_google_maps_height"]);
	}
	
	/**
	* Google maps zoom level
	*
	* @return integer google maps image zoom level
	* @since 0.1
	*/
	function getGoogleMapsZoomLevel() {
		return intval($this->_configs["praized_google_maps_zoom_level"]);
	}
	
	/**
	* Current blog url
	*
	* @return string blog url
	* @since 0.1
	*/
	function getSiteUrl() {
		return $this->_mt_url;
	}
	
	/**
	* getInstance();
	* This is a Singleton class.
	* Return the current instance or initialize it.
	* TODO fix this singleton.s
	*
	* @return PraizedMTCachedApiDB
	* @since 0.1
	*/
	function getInstance($mt = null) {
		if(!isset($current_instance)) {			
			$object = __CLASS__;
			$current_instance =& new $object($mt);
		}
		return $current_instance;
	}
}
?>