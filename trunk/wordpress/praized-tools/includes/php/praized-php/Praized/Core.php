<?php
/**
 * Praized Portable PHP Library: Core
 * 
 * Note: Using the OAuth functionalities will make this library PHP5+ only
 *
 * @version 1.0.2
 * @package Praized
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedCore') ) {
    /**
     * Praized Portable PHP Library: Core: Class
     * 
     * Note: Using the OAuth functionalities will make this library PHP5+ only
     * 
     * @package Praized
     * @since 0.1
     */
    class PraizedCore {
    	/**
    	 * Library version
    	 * @var string
    	 * @since 0.1
    	 */
        var $version = '1.0.2';
        
        /**
         * Library errors
         * @var array
         * @since 0.1
         */
    	var $errors = array();

        /**
         * Collection of standard Praized.com links (home, oauth endpoints, etc)
         * @var array
         * @since 0.1
         */
    	var $praizedLinks = array();
    	
    	/**
    	 * Common variable holding the URL to return to when interacting with
    	 * the Praized hub, OAuth handshake, etc.
    	 * @var string
    	 * @since 0.1
    	 */
    	var $returnTo = '';
    	
    	/**
    	 * Praized Mothership URL
    	 * @var string
    	 * @since 0.1
    	 */
        var $_praizedHosts = array(
            'api'       => 'http://api.praized.com',
            'auth'      => 'http://auth.praized.com',
            'hub'       => 'http://praized.com',
            'searchlet' => 'http://s.praized.com',
            'corporate' => 'http://praizedmedia.com',
            'static'    => 'http://static.praized.com'
        );
    	
    	/**
         * Community permalink/key/id
         * @var string
         * @since 0.1
         */
        var $_community;
    	
        /**
         * Praized API key
         * @var string
         * @since 0.1
         */
        var $_apiKey;
    	
        /**
         * PraizedOAuth class instance
         * @var object
         * @since 0.1
         */
        var $_oAuth;
        
        /**
         * Json class instance
         * @var object
         * @since 0.1
         */
        var $_Json;
        
        /**
         * Safe script uri
         * @var string
         * @since 0.1
         */
         var $_scriptUri;
    	
    	/**
    	 * Constructor
    	 *
    	 * @param string $community [required] Praized community permalink
    	 * @param string $apiKey [required] Praized API key
    	 * @param mixed obj|null $oAuth PraizedOauth (../PraizedOauth.php) instance, as reference. Pass NULL for read-only (PHP4-compat) mode
    	 * @return PraizedCore
    	 * @since 0.1
    	 */
        function PraizedCore($community, $apiKey, &$oAuth) {
    		$devInc = dirname(realpath(__FILE__)).'/Dev.php';
            if ( file_exists($devInc) ) {
                require_once($devInc);
                $this->_praizedHosts = PraizedDev::praizedHosts();
            }
            
            $this->_community = trim($community);
    		$this->_apiKey    = trim($apiKey);
    		
    		$this->_loadVendors();
    		$this->_Json = new Services_JSON;

    	    if ( ! isset($_SERVER['SCRIPT_URI']) ) {
    	        $this->_scriptUri = sprintf(
    	            '%s://%s%s',
    	            ( isset($_SERVER['HTTPS']) ) ? 'https' : 'http',
    	            $_SERVER['HTTP_HOST'],
    	            $path
    	        );
    	    } else {
    	        $this->_scriptUri = $_SERVER['SCRIPT_URI'];
    	    }
    		
    		$this->returnTo = $returnTo = urlencode($this->_scriptUri . '?' . $_SERVER["QUERY_STRING"]);

    		$this->praizedLinks = array_merge(
    		    $this->_praizedHosts,
    		    array(
        		    'join'         => $this->_praizedHosts['auth']       . '/users/new?return_to=' . $returnTo,
        		    'login'        => $this->_praizedHosts['auth']       . '/sessions/new?return_to=' . $returnTo,
        		    'logout'       => $this->_praizedHosts['auth']       . '/sessions/destroy?return_to=' . $returnTo,
        		    'add_place'    => $this->_praizedHosts['hub']        . '/merchants/new?return_to=' . $returnTo,
        		    'communities'  => $this->_praizedHosts['hub']        . '/communities?return_to=' . $returnTo,
        		    'api_request'  => $this->_praizedHosts['corporate']  . '/en/api?return_to=' . $returnTo
        		)
        	);
    		
    		if ( is_object($oAuth) ) {
    		    $this->_oAuth = $oAuth;
    		    if ( $oAuth->hasToken() )
    				$oAuth->completeAuthorization();
    		} else {
    		    $this->_oAuth = null;
    		}
    		
    		if ( ! $this->_oAuth )
    		    $this->praizedLinks['user_profile'] = NULL;
    		else
    		    $this->praizedLinks['user_profile'] = $this->_praizedHosts['hub']
    		                                        . '/users/'
    		                                        . $this->currentUserLogin()
    		                                        . '?return_to='
    		                                        . $returnTo;
        }
    	
    	/**
    	 * Instantiates and returns a preset Snoopy HTTP client object
    	 *
    	 * @return object Snoopy instance
    	 * @since 0.1
    	 */
    	function newHttp() {
    		$snoopy = new Snoopy;
    		$snoopy->agent = 'Praized PHP Library v'.$this->version;
    		return $snoopy;
    	}
    	
        /**
         * Gets the content of an http/https url
         *
         * @param string $url http/https url
         * @return mixed string on success, boolean false on error
         * @since 0.1
         */
    	function getHttp($url) {
    		$http = $this->newHttp();
    	    $http->fetch($url);
    		if ( ! strstr($http->response_code, '200')) {
    			if ( preg_match('/(\d{3,4})/', $http->response_code, $matches) )
    			    $errorCode = $matches[1];
    			else
    			    $errorCode = '500';
    			$this->errors[$errorCode] = 'HTTP: '.$http->response_code;
    			return false;
    		}
    		return $http->results;
    	}
    	
    	/**
    	 * Convenience JSON decode method that integrates with $this->errors, etc
    	 *
    	 * @param string $json JSON data
    	 * @return mixed Boolean FALSE or Object PHP representation of the passed JSON data
    	 * @since 0.1
    	 */
    	function jsonDecode($json) {
	        if ( ! ( $obj = $this->_Json->decode($json) ) ) {
			    $this->errors['500'] = "JSON: Decode error.";
			    return false;
	        }
	        return $obj;
    	}
    	
    	/**
    	 * Convenience method for $this->_oAuth->isAuthorized()
    	 *
    	 * @return boolean
    	 * @since 0.1
    	 */
    	function isAuthorized() {
    	    if ( ! is_object($this->_oAuth) )
    	        return false;
    	    else
    	        return $this->_oAuth->isAuthorized(); 
    	}
    	
    	/**
    	 * OAuth *login/logout*
    	 *
    	 * @param string $callbackUrl URL to be returned to
    	 * @since 0.1
    	 */
    	function session($callbackUrl = null) {
		 	if($callbackUrl == null)
    	    	$callbackUrl = preg_replace('|/oauth[/]?.*$|', '/', $this->_scriptUri);
    	    if ( $this->isAuthorized() ) {
    	        // logout
    	        $this->_oAuth->clear();
        	    header('Location:' . $callbackUrl);
				exit;
    	    } else {
    	        // login
    	        $this->_oAuth->startAuthorization($callbackUrl);
    	    }
    	}
    	
    	/**
    	 * Return the login (username) of the currently auth'ed user if available
    	 *
    	 * @return mixed Boolean false or String username
    	 * @since 0.1
    	 */
    	function currentUserLogin() {
    	    return ( isset($this->_oAuth->currentUser['login']) ) ? $this->_oAuth->currentUser['login'] : FALSE;
    	}
         
        /**
         * Fetch geo coordinates in the Google Maps API
         * @see http://code.google.com/apis/maps/documentation/services.html
         *
         * @param string $apiKey Google Maps API key
         * @param string $query Usually as complete a postal address as you can provide
         * @return mixed boolean FALSE or associative array with 3 keys: longitude, latitude and altitude
         * @since 0.1
         */
        function googleGeoLookup($mapApiKey, $query) {
    	    $parseError = false;
            
    	    $url = sprintf(
                'http://maps.google.com/maps/geo?key=%s&q=%s&oe=utf-8&output=json',
                $mapApiKey,
                urlencode($query)
            );
            
            if ( ! ( $jsonObj = $this->getHttp($url) ) )
                return false;
    		
            if ( ! ( $phpObj = $this->jsonDecode($jsonObj) ) )
    			return false;

    	    if ( ! isset($phpObj->Placemark[0]->Point->coordinates) )
                $parseError = true;
            
            $geo = $phpObj->Placemark[0]->Point->coordinates;
            
            if ( ! is_array($geo) )
                $parseError = true;
    	    
            if ( empty($geo[0]) || empty($geo[1]) )
    	        $parseError = true;

    	    if ( $parseError )  {
    	        $this->errors['500'] = "Google Maps Coordinates: Decode error.";
                return false;
            }
    	    
    	    return array(
    	        'longitude' => $geo[0],
    	        'latitude'  => $geo[1],
    	        'altitude'  => $geo[2]
    	    );
        }
    	
    	/**
    	 * Google Static Map integration, returns image tag
    	 * See see http://code.google.com/apis/maps/documentation/staticmaps/
    	 *
    	 * @param string $mapApiKey
    	 * @param float  $latitude
    	 * @param float  $longitude
    	 * @param array  $rawParams Optional static map url parameters overwrites (except api key)
    	 * @param string $caption Optional caption for the bubble displayed when going to the GMap site (eg: merchant name)
    	 * @return mixed Boolean false or String Map image tag
    	 * @since 0.1
    	 */
    	function googleMap($mapApiKey, $latitude, $longitude, $rawParams = array(), $caption = '') {
    	    if ( empty($mapApiKey) || empty($latitude) || empty($longitude) )
    	        return false;
    	    
          $markers = ( isset($rawParams['markers']) ) ? $rawParams['markers'] : "$latitude,$longitude";

    	    $size = ( isset($rawParams['size']) ) ? $rawParams['size'] : '470x200';
    	    list($width, $height) = explode('x', strtolower($size));

    	    $zoom = ( isset($rawParams['zoom']) ) ? intval($rawParams['zoom']) : 15;

    	    $url = sprintf(
    	        'http://maps.google.com/staticmap?markers=%s,green&size=%s&zoom=%s&key=%s',
    	        $markers, $size, $zoom, $mapApiKey
    	    );
    	    
    	    if( ! empty($caption) ) 
    	        $markers .= '+(' . urlencode($caption) . ')';
    	      
            $mapAccessbileUrl = sprintf(
                'http://maps.google.com/maps?f=q&hl=en&geocode=&q=%s',
                $markers
            );
            
    	    $gooMapScript = <<<__________EOS
    	      <div id="praized-google-map-dynamic-wrapper" style="width:{$width}px;height:{$height}px;display:none;"></div>
    	      <script type="text/javascript">
    	      var Praized = function()
    	       {
    	         google.load("maps", "2.x");
               return {
                      gooDynamicMapInit: function () {
                        var przdmap = new google.maps.Map2(document.getElementById("praized-google-map-dynamic-wrapper"));
                        przdmap.addControl(new GSmallMapControl());
                        przdmap.setCenter(new google.maps.LatLng({$latitude}, {$longitude}), {$zoom});
                        var przdTinyIcon = new GIcon();
                        przdTinyIcon.image = "http://labs.google.com/ridefinder/images/mm_20_green.png";
                        przdTinyIcon.shadow = "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
                        przdTinyIcon.iconSize = new GSize(12, 20);
                        przdTinyIcon.shadowSize = new GSize(22, 20);
                        przdTinyIcon.iconAnchor = new GPoint(6, 20);
                        przdTinyIcon.infoWindowAnchor = new GPoint(5, 1);
                        przdMarkerOptions = { icon:przdTinyIcon };
                        var przdpoint = new GLatLng({$latitude}, {$longitude});
                        przdmap.addOverlay(new GMarker(przdpoint,przdMarkerOptions));
                      },
                      dynamize: function(){
                        document.getElementById("praized-google-map-dynamic-wrapper").style.display='block';
                        document.getElementById("praized-google-map-static").style.display='none';                        
                        Praized.gooDynamicMapInit();
                        return false;
                      }
                };
    	      }();
            </script>
__________EOS;

         $gooLibScript = sprintf(
              '<script type="text/javascript" src="http://www.google.com/jsapi?key=%s"></script>%s',
              $mapApiKey,$gooMapScript
          );
  
          return sprintf(
              '<a rel="nofollow" href="%s" id="praized-google-map-static" onclick="return Praized.dynamize();"><img title="click the map for a dynamic version" src="%s" alt="Google Map" width="%s" height="%s" border="0" /></a>%s',
              $mapAccessbileUrl,$url, $width, $height,$gooLibScript
          );
    	}
    	
    	/**
    	 * Straight PHP port of the Ruby/Rails will_paginate.
    	 *
    	 * @param object $pagination Pagination object as returned by the Praized API
    	 * @param array $optOverwrite Misc. pagination option overwrites (see source).
    	 * @return string
    	 * @since 0.1
    	 */
    	function paginate(&$pagination, $optOverwrite = array()) {

    		if( is_object($pagination) && intval($pagination->page_count) > 1) {
    			$current_page   = $pagination->current_page;
    			$per_page 	    = $pagination->per_page;
    			$total_entries  = $pagination->total_entries;
    			$total_pages    = ceil($total_entries / $per_page);
    
    			$url = preg_replace("/\?.+$/", "", $_SERVER["REQUEST_URI"]);
    					
    			$opt = array(
    				"class"		   => "praized-pagination",
    				"prev_label"   => 'Previous',
    				"next_label"   => 'Next',
    				"inner_window" => 4,
    				"outer_window" => 1,
    				"gap_marker"   => "..."
    			);
    			
    			$opt = array_merge($opt, $optOverwrite);
    		
    			$css_class      = $opt["class"];
    			$inner_window   = $opt["inner_window"];
    			$outer_window   = $opt["outer_window"];
    			$gap_marker     = $opt["gap_marker"];
    			$next_label     = $opt["next_label"];
    			$previous_label = $opt["prev_label"];
    		
    
    			$window_from = $current_page - $inner_window;
    			$window_to   = $current_page + $inner_window;
    
    			if($window_to > $total_pages) {
    				$window_from -= $window_to - $total_pages;
    				$window_to 	  = $total_pages;
    			} else if($window_from < 1) {
    				$window_to  += 1 - $window_from;
    				$window_from = 1;
    			}
    
    			$visible    = range(1, $total_pages);
    			$left_gap   = range(2 + $outer_window, $window_from); 
    			$right_gap  = range($window_to + 1, ($total_pages - $outer_window));
    
    			if(($left_gap[sizeof($left_gap) - 1] - $last_gap[0]) > 1)
    				$visible = array_diff($visible, $left_gap);
    	
    			if(($right_gap[sizeof($right_gap) - 1] - $right_gap[0]) > 1)
    				$visible = array_diff($visible, $right_gap);
    	
    			// page to show
    			$links = array();
    			$prev  = null;
    		
    			$search_query = "";
    			if($_GET["q"])
    				$search_query .= "q=" . $_GET["q"] . "&";
    				
    			if($_GET["l"])
    				$search_query .= "l=" . $_GET["l"] . "&";
    				
    			// building the html.
    			$str = "<ul class=\"" . $css_class . "\">";
    			if($current_page == 1)
    				$str .= "<li class=\"praized-pagination-disabled\">" . $previous_label . "</li>";
    			else
    				$str .= "<li><a href=\"" . $url . "?" . $search_query . "page=" . ($current_page - 1) . "\">" . $previous_label . "</a></li>";
    
    		
    			foreach($visible as $item) {
    				if($prev != null && $item > $prev + 1)
    					$str .= "<li>...</li>";
    				
    				if($current_page == $item) 
    					$str .= "<li class=\"praized-pagination-current\">" . $item . "</li>";
    				else
    					$str .= "<li><a href=\"" . $url ."?" . $search_query . "page=" . $item . "\">" . $item . "</a></li>";	
    
    		    	$prev = $item;
    		    }
    			if($current_page == $total_pages)
    				$str .= "<li class=\"praized-pagination-disabled\">" . $next_label . "</li>";
    			else
    				$str .= "<li><a href=\"" . $url . "?" . $search_query . "page=" . ($current_page + 1) . "\">" . $next_label . "</a></li>";
    
    	
    			$str .= "</ul>";
    		
    			return $str;
    		} else {
    			return "";
    		}
    	}
    	
    	/**
    	 * Praized credits line helper.
    	 *
    	 * @return string
    	 * @since 0.1
    	 */
    	function credits() {
    	    return 'Powered by <a href="http://praizedmedia.com/">Praized Media</a>. US data provided by Localeze. Canadian business listings distributed by <a href="http://www.yellowpages.ca">YellowPages.ca™</a>.';
    	}
    	
    	/**
    	 * Convenience method to load sister classes
    	 *
    	 * @param string $fileName Filename, without the .php extension
    	 * @since 0.1
    	 */
        function _loadClass($fileName) {
    		$incPath = dirname(realpath(__FILE__));
    		if (file_exists($incPath.'/Praized.php')) $incPath .= '/Praized';
    		$filePath = $incPath.'/'.$fileName.'.php';
    		require_once($filePath);
    	}
    	
    	/**
    	 * Loads the required 3rd party libraries
    	 * @since 0.1
    	 */
    	function _loadVendors() {
    		if ( ! class_exists('Snoopy') )        $this->_loadClass('../vendor/Snoopy');
    		if ( ! class_exists('Services_JSON') ) $this->_loadClass('../vendor/JSON');
    	}
    	
    	/**
    	 * Rebuilds the requested API route with the community permalink
    	 *
    	 * @param string $str Praized API route (EG: /merchants.json)
    	 * @return string Modified API route (EG: /my-community/merchants.json)
    	 * @since 0.1
    	 */
    	function _reroute($str) {
    		if (substr($str, 0, 1) != '/') $str = "/$str";
    		return '/' . $this->_community . $str;
    	}
    	
    	/**
    	 * Builds a query string from a hash and includes the required data to
    	 * connect to the Praized API (API key, optional dev key).
    	 *
    	 * @param array $query Query key/value pairs
    	 * @return string Query string (?key1=value1&...)
    	 * @since 0.1
    	 */
    	function _queryString($query) {
    		if ( ! is_array($query))
    			$query = array();
    		$query['api_key'] = $this->_apiKey;
    		$qs = '?';
    		foreach ($query as $key => $val)
    			$qs .= urlencode($key).'='.urlencode(stripslashes(urldecode($val))).'&';
    		return rtrim($qs, '&');
    	}
    	
    	/**
    	 * Fetches a Praized API resource/endpoint
    	 *
    	 * @param string $route Praized API route (EG: /merchants.json)
    	 * @param array $query Query string key/value pairs (equiv of $_GET)
    	 * @param array $post Post vars key/value pairs (equiv of $_POST)
    	 * @param boolean $protected Requires OAuth handling
    	 * @return mixed Boolean FALSE or fetched content as string
    	 * @since 0.1
    	 */
    	function _get($route, $query = array(), $post = array(), $protected = false) {
    		$route = $this->_reroute($route);
    		
    		$url  = $this->_praizedHosts['api'] . $route . $this->_queryString($query);
    		$http = $this->newHttp();

    		if ( is_object($this->_oAuth) ) { 
				if( $this->isAuthorized() ) {
		            if ( $accessHeaders = $this->_oAuth->getAccessHeader() )
    		            $http->rawheaders['Authorization'] = 'OAuth realm="",' . $accessHeaders;
    		    } elseif( $protected == true ) {
					$this->_oAuthHandling();
				}
			}
    		
    		if ( is_array($post) && count($post) > 0 ) {
    		    $http->submit($url, $post);
    		} else {
    		    $http->fetch($url);
    		}
    		
    		if ( $http->status != '200' ) {
    			$this->errors[$http->status] = 'HTTP: '.$http->response_code;
    			return false;
    		} else {
    			return $http->results;
    		}
    	}
    	
    	/**
    	 * Posts to a Praized API resource/endpoint
    	 *
    	 * @param string $route Praized API route (EG: /merchants.json)
    	 * @param array $post Post vars key/value pairs (equiv of $_POST)
    	 * @param string $method One of 'post', 'put' or 'delete'
    	 * @param array $query Query string key/value pairs (equiv of $_GET)
    	 * @param boolean $protected Requires OAuth handling
    	 * @return mixed Boolean FALSE or fetched content as string
    	 * @since 0.1
    	 */
    	function _post($route, $post = array(), $method = 'post', $query = array(), $protected = false) {
    	    $method = strtolower($method);
    	    
    	    if ( ! in_array($method, array('post', 'put', 'delete')) )
    	        $method = 'post';
    	    
    	    if ( ! is_array($post) )
    	        $post = array();
    	    
    	    if ( ! isset($post['_method']) )
    	        $post['_method'] = $method;
    	    
    	    return $this->_get($route, $query, $post, $protected);
    	}
    	
    	/**
    	 * Decodes the Praized API from JSON to PHP, with proper namespacing
    	 * ($obj = <praized> in API) and integration with $this->errors.
    	 *
    	 * @param string $json JSON data as returned by the Praized API
    	 * @return mixed Boolean FALSE or Object  (praized namespace as obj root)
    	 * @since 0.1
    	 */
    	function _parseApi($json, $rawJson = false) {
	        $json = trim($json);
	        $nsMissingError = 'JSON: Praized namespace missing.';
    	    if ( ! $rawJson ) { 
        	    if ( ! ( $obj = $this->jsonDecode($json) ) ) {
    			    return false;
    	        } elseif ( ! isset($obj->praized) ) {
    			    $this->errors['500'] = $nsMissingError;
    			    return false;
    	        } elseif ( isset($obj->praized->errors) ) {
    	            $this->errors = $obj->praized->errors;
    			    return false;
    	        } else {
    	            $obj = $obj->praized;
    	            // @TODO rm temp formatting once API formats properly
    	            $obj = $this->_tempInspect($obj);
    	            return $obj;
    	        }
	        } else {
	            $nsRegex = '/^{\s*?"praized":/';
	            if ( ! preg_match('/^{.*?}$/', $json) ) {
	                $this->errors['500'] = 'JSON: The content returned by the API does not look like valid JSON.';
    			    return false;
    			} elseif ( ! preg_match($nsRegex, $json) ) {
	                $this->errors['500'] = $nsMissingError;
    			    return false;
	            } else {
	                return preg_replace($nsRegex, '', rtrim($json, '}'));
	            }
	        }
    	}
    	
    	/**
    	 * Inspects the sent object for some properties post-process formatting [should be temporary until the API does so itself]
    	 *
    	 * @param object $obj
    	 * @return object
    	 * @since 0.1
    	 */
    	function _tempInspect($obj) {
    	    if ( isset($obj->merchant) && is_object($obj->merchant) ) {
    	        $obj->merchant = $this->_tempFormat($obj->merchant);
    	    } elseif ( isset($obj->merchants) && is_array($obj->merchants) ) {
    	        foreach ($obj->merchants as $index => $merchant)
    	             $obj->merchants[$index] = $this->_tempFormat($merchant);
            } elseif ( isset($obj->votes[0]->merchant) && is_object($obj->votes[0]->merchant) ) {
    	        foreach ($obj->votes as $index => $vote)
    	             $obj->votes[$index]->merchant = $this->_tempFormat($vote->merchant);
            } elseif ( isset($obj->comments[0]->merchant) && is_object($obj->comments[0]->merchant) ) {
    	        foreach ($obj->comments as $index => $comment)
    	             $obj->comments[$index]->merchant = $this->_tempFormat($comment->merchant);
            }
    	    return $obj;
    	}
    	
    	/**
    	 * Inspects the sent merchant object for some properties post-process formatting [should be temporary until the API does so itself]
    	 *
    	 * @param object $obj
    	 * @return object
    	 * @since 0.1
    	 */
    	function _tempFormat($obj) {
    	    if ( isset($obj->location) ) {
    	        if ( isset($obj->location->city->name) )
    	            $obj->location->city->name = $this->_tempColinize($obj->location->city->name);
    	        if ( isset($obj->location->street_address) )
    	            $obj->location->street_address = $this->_tempColinize($obj->location->street_address);
    	        if ( isset($obj->location->postal_code) )
    	            $obj->location->postal_code = $this->_tempCanadianPostalCode($obj->location->postal_code);
    	    }
    	    if ( isset($obj->phone) )
    	        $obj->phone = $this->_tempPhone($obj->phone);
    	    if ( isset($obj->fax) )
    	        $obj->fax = $this->_tempPhone($obj->fax);
    	    return $obj;
    	}
    	
    	/**
    	 * Title case formatting [should be temporary until the API does so itself]
    	 *
    	 * @param string $str
    	 * @return string
    	 * @since 0.1
    	 */
    	function _tempColinize($str) {
    	    return preg_replace('/([^\w\xC0-\xD6\xD8-\xF6\xF8-\xFF]*)([\w\xC0-\xD6\xD8-\xF6\xF8-\xFF]+)/eu', "'\\1'.( ( '\\1' == \"'\" ) ? '\\2' : ucfirst(strtolower('\\2')) )", $str);
    	}
    	
    	/**
    	 * Phone number formatting [should be temporary until the API does so itself]
    	 *
    	 * @param string $str
    	 * @return string
    	 * @since 0.1
    	 */
    	function _tempPhone($str) {
    	    return preg_replace( '/(\d{3})(\d{4})$/', '\1-\2', str_replace(')', ') ', $str) );
    	}
    	
    	/**
    	 * Canadian postal code formatting [should be temporary until the API does so itself]
    	 *
    	 * @param string $str
    	 * @return string
    	 * @since 0.1
    	 */
    	function _tempCanadianPostalCode($str) {
    	    return preg_replace( '/^([A-Z]{1}[0-9]{1}[A-Z]{1})([0-9]{1}[A-Z]{1}[0-9]{1})$/', '\1 \2', strtoupper(trim($str)) );
    	}
    	
    	/**
    	 * Negociates the OAuth session based on the current state
    	 * 
    	 * @since 0.1
    	 */
    	function _oAuthHandling() {
           	if ( is_object($this->_oAuth) ) {
        	    if ( $this->_oAuth->hasToken() ) {
               		if($this->_oAuth->completeAuthorization())
               			$this->_oAuth->returnTo();
               	} else {
               	    $this->_oAuth->startAuthorization();
            		$this->_oAuth->returnTo();
               	}
           	}
    	}
    }
}
?>