<?php
/**
 * Praized OAuth handling library
 *
 * @version 2.0.1
 * @package Praized
 * @subpackage OAuth
 * @author Pier-Hugures Pellerin for Praized Media, Inc.
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedOAuth') ) {
    if ( ! class_exists('PraizedCipher') )
        include_once dirname(realpath(__FILE__)) . "/PraizedCipher.php";
    if ( ! class_exists('OAuthConsumer') )
        include_once dirname(realpath(__FILE__)) . "/vendor/OAuth.php";
    if ( ! class_exists('Snoopy') )
        include_once dirname(realpath(__FILE__)) . "/vendor/Snoopy.php";

    /**
     * Praized OAuth handling library: Class
     * 
     * @package Praized
	 * @subpackage OAuth
     * @since 0.1
     */
    class PraizedOAuth {
		var $_consumerKey = NULL;
		var $_consumerSecret = NULL;
	
		var $_requestTokenUrl       = "/oauth/request_token";
		var $_requestAccessTokenURL = "/oauth/access_token";
		var $_authorizeURL          = "/oauth/authorize";
	
		var $currentUser = array();
		var $_cookieHash = NULL;
	
		// OAuth System.
		var $_consumer = NULL;
		var $_encoder;

		var $_net;
		var $_version = '2.0.1';
		var $errors = array();
	
		var $_expirationTime = 1209600; // (14 * 24 * 3600);
		                       
		var $_oAuthToken;
	
	    var $_test = 0;
	
		/**
		 * Constructor.
		 * 
		 * @param string $consumerKey Consumer Key
		 * @param string $consumerSecret Consumer Secret
		 * @since 0.1
		 */
		function PraizedOAuth($consumerKey, $consumerSecret, $authHost = 'http://auth.praized.com') {
			$this->_consumerKey    = $consumerKey;
			$this->_consumerSecret = $consumerSecret;
    		
		    $devInc = dirname(realpath(__FILE__)).'/Praized/Dev.php';
            if ( file_exists($devInc) ) {
                require_once($devInc);
                $pHosts = PraizedDev::praizedHosts();
                $this->_requestTokenUrl       = $pHosts['auth'] . '/oauth/request_token';
    			$this->_requestAccessTokenURL = $pHosts['auth'] . '/oauth/access_token';
    			$this->_authorizeURL          = $pHosts['auth'] . '/oauth/authorize';
            } else {
                $this->_requestTokenUrl       = $authHost . $this->_requestTokenUrl;
        		$this->_requestAccessTokenURL = $authHost . $this->_requestAccessTokenURL;
        		$this->_authorizeURL          = $authHost . $this->_authorizeURL;
            }
			
			$this->_consumer = new OAuthConsumer($this->_consumerKey, $this->_consumerSecret);
			$this->_encoder  = new OAuthSignatureMethod_HMAC_SHA1();
		
			// initialize the Snoop Agent.
			$this->_net = new Snoopy();
			$this->_net->agent = "Praized PHP OAuth Request v." . $this->_version;
			
			$this->_oAuthToken = ( ! empty($_GET["oauth_token"]) ) ? $_GET["oauth_token"] : false;

			// Trying to get the user information.
			$this->_load();
		}
		
		/**
		 * Returns the domain that the related cookie(s) should be valid for.
		 *
		 * @return string
		 * @since 0.1
		 */
		function _cookieDomain() {
		    if ( ! isset($_SERVER["SERVER_NAME"]) || empty($_SERVER["SERVER_NAME"]) ) {
		        if (strstr($_SERVER["HTTP_HOST"], ':'))
		            list($host, $port) = explode(':', $_SERVER["HTTP_HOST"]);
		        else
		            $host = $_SERVER["HTTP_HOST"];
		    } elseif ( $_SERVER["SERVER_NAME"] == $_SERVER["SERVER_ADDR"] ) {
		        $host = $_SERVER["SERVER_ADDR"]; 
		    } else {
		        $host = $_SERVER["SERVER_NAME"];
		    }
		    
		    if ( preg_match('/^.*?\.?([^\.]+\.[a-zA-Z]+)$/', $host, $matches) ) {
	            if ( $matches[1] )
	                $domain = '.' . $matches[1];
		    }
		    
		    if ( ! isset($domain) )
		        $domain = $host;
		    
		    return $domain;
		}

		/**
		 * Start the authorization process.
		 * 
		 * @param string $callback Fully qualifed URL, defaults to what is guessed to be the community's top level.
		 * @since 0.1
		 */
  		function startAuthorization($callbackURL = NULL) {
			if ( $callbackURL == NULL ) {
        	    if ( ! isset($_SERVER['SCRIPT_URI']) ) {
        	        $scriptUri = sprintf(
        	            '%s://%s%s%s',
        	            ( isset($_SERVER['HTTPS']) ) ? 'https' : 'http',
        	            ( isset($_SERVER['PHP_AUTH_USER']) ) ? $_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PQ'].'@' : '',
        	            $_SERVER['HTTP_HOST'],
        	            ( isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : $_SERVER['REQUEST_URI'])
        	        );
        	    } else {
        	        $scriptUri = $_SERVER['SCRIPT_URI'];
        	    }
			    $callbackURL = preg_replace('|/oauth[/]?.*$|', '/', $scriptUri);
			}
			    
  		    $requestToken = $this->getRequestToken();
			

			$requestToken->callback = $callbackURL;

			$this->_saveReturnTo($callbackURL);

			$this->_addTokens("requestToken", $requestToken);
			$this->_authorize($requestToken, $callbackURL);
		}

		/**
		 * Checks if the current user is already authorized.
		 * 
		 * @return boolean TRUE if user is seen as currently authorized.
		 * @since 0.1
		 */
		function isAuthorized() {	
			return ($this->_retrieveToken("accessToken")) ? TRUE: FALSE;
		}
	
		/**
		 * Generates a request token before the authorization process is started.
		 * 
		 * @return mixed FALSE if we are not able to get one or an OAuthConsumer object
		 * @since 0.1
		 */
		function getRequestToken() {
			 $method = "GET";
		
			 $req = OAuthRequest::from_consumer_and_token($this->_consumer, 
														  NULL, 
														  $method, 
														  $this->_requestTokenUrl,
														  array());

			 $req->sign_request($this->_encoder, $this->_consumer, NULL);
		  	 $response = $this->_make_http_call($req, $method);

			 if($response) {
				return $this->_parseOAuthToken($response);
		 	 } else {
				return FALSE;
			 }
		}

		/**
		 * Checks the presence and state of a valid looking $this->_oAuthToken
		 *
		 * @return boolean
		 * @since 0.1
		 */
		function hasToken() {
		    return ( $this->_oAuthToken !== false ) ? true : false; 
		}

		/**
		 * If we have an requestToken, try to get an accessToken
		 * 
		 * @param string $OAuthToken The request token to get an access token for.
		 * @return boolean TRUE is the authorization is complete.
		 * @since 0.1
		 */
		function completeAuthorization() {
			if ( $this->hasToken()  && !$this->isAuthorized() ) {
				
    		    $oAuthToken   = $this->_oAuthToken;
    		    $requestToken = $this->_retrieveToken("requestToken");
                if($requestToken != NULL && $requestToken->key === $oAuthToken) {

    				$accessToken  = $this->_getAccessToken($requestToken);
					
					if($accessToken) {
    					$this->currentUser['login'] = trim(urldecode($_GET['login']));
    					$this->currentUser['name']  = ( ! empty($_GET['name']) )
    												? trim(urldecode($_GET['name']))
    												: $this->currentUser['login'];
    				    $this->_addTokens("accessToken", $accessToken);
    					return TRUE;
    				}
    			}
			}
			return FALSE;
		}
		 
		/**
		* Clears the cookie for the current user
		*
		* @since 0.1
		*/
		function clear() {
			setcookie($this->_cookieHash, "", time() - 3600, '/', $this->_cookieDomain());
		}

		/**
		 * Redirects to the initiating site/page.
		 * 
		 * @since 0.1 
		 */
		function returnTo() {
			if(isset($this->currentUser["returnTo"]) && ! empty($this->currentUser["returnTo"]))
				header("Location: " . $this->currentUser["returnTo"]);
		}

		/**
		 * Use a valid $requestToken to request an access token.
		 * 
		 * @param OAuthConsumer A valid request token
		 * @return mixed FALSE if the request is invalid or a OAuthConsumerObject.
		 * @since 0.1
		 */
		function _getAccessToken($requestToken) {
			$method = "GET";
			$req = OAuthRequest::from_consumer_and_token($this->_consumer, 
														 $requestToken, 
														 $method, 
														 $this->_requestAccessTokenURL, 
														 array());
													
			$req->sign_request($this->_encoder, $this->_consumer, $requestToken);			
		  	$response = $this->_make_http_call($req, $method);
			
			 if($response) {
				return $this->_parseOAuthToken($response);
		 	 } else {
				return FALSE;
			 }
		}

		/**
		 * Return the header to make future compatible and authentified calls.
		 * 
		 * @return mixed FALSE if not authorized or header string
		 * @since 0.1
		 */
		function getAccessHeader() {
			$accessToken  = $this->_retrieveToken("accessToken");

			if($accessToken) {
				$method = "GET";
		
				$req = OAuthRequest::from_consumer_and_token($this->_consumer, 
																 $accessToken, 
																 $method, 
																 "http://api.praized.com/", 
																 array());

				$req->sign_request($this->_encoder, $this->_consumer, $accessToken);			
				
				$accessHeaders = $req->to_header();
	            
				// VENDOR OAUTH LIB OUTPUT CLEANUP
				$accessHeaders = preg_replace('/^"?Authorization:\s*(\S*)/', '\1', $accessHeaders);
                $accessHeaders = str_replace('OAuth realm="",', '', $accessHeaders);
                $accessHeaders = preg_replace('/^,(.*)/', '\1', $accessHeaders);
				
                return $accessHeaders;
			}
			return FALSE;
		}
		
		/**
		 * Authorize the current tokens, then redirect the current user to
		 * to the oauth provider (Praized) authorization page.
		 * 
		 * @param OAuthConsumer Request token
		 * @since 0.1
		 */
		function _authorize($requestTokenConsumer, $callbackURL = NULL) {	
			$queryString = "/?oauth_token=" . $requestTokenConsumer->key;
			
			if($callbackURL != NULL)
			 	$queryString .= "&oauth_callback=" . OAuthUtil::urlencode_RFC3986($callbackURL);
			
			$auth_url = $this->_authorizeURL . $queryString;
			
			if ( isset($_GET['i']) )
				$auth_url .= '&i=' . $_GET['i'];

			header("Location: $auth_url", false, 302);
			echo $auth_url;
			exit;
		}		
		
		/**
		* Make HTTP requests to the oauth server
		* 
		* @param OAuthRequest $request Request object
		* @param string $method Method to use for the call
		* @param array $parameters Any more parameters use for this call
		* @return mixed FALSE if not a 200 request or the response content
		* @since 0.1
		*/
		function _make_http_call($request, $method, $parameters = array()) {
			@$this->_net->fetch($request->to_url());
				
			if(! strstr($this->_net->response_code, "200") ) {
				return FALSE;
			} else {
				return $this->_net->results;
			}
		}
	
		/**
		* Parse the string token and return an OAuthConsumer object.
		*
		* @param string $str query string to be parsed
		* @return OAuthConsumer
		* @since 0.1
		*/
		function _parseOAuthToken($str) {
			parse_str($str, $parameters);
			return new OAuthConsumer($parameters["oauth_token"], $parameters["oauth_token_secret"]);
		}
		
		/**
		 * Retrieve a specific token from the cookie.
		 * 
		 * @param string $key the unique key
		 * @return mixed OAuthConsumer for this specific key or FALSE if not found
		 * @since 0.1
		 */
		function _retrieveToken($key) {
			if( isset($this->currentUser[$key]) ) {
				$data = $this->currentUser[$key];
				return new OAuthConsumer($data["key"], $data["secret"], $data["callback"]);
			} else {
				return FALSE;
			}
		}

		/**
		 * Save the a token to the cookie jar.
		 * 
		 * @param string $key the unique key
		 * @param OAuthConsumer $token Tokens to add
		 * @since 0.1
		 */
	    function _addTokens($key, $token) {
			$this->currentUser[$key] = array(
											"key" => $token->key,
											"secret" => $token->secret,
											"callback" => $token->callback
										);
			$this->_saveTokens();
	 	}

		/**
		 * Load the data for the current user
		 * 
		 * @since 0.1
		 */
		function _load() {
			$this->_cookieHash = "praized_user_" . $this->_generateCookieHash();
			if( ! isset($this->currentUser) ) {
				$this->currentUser = array();
			} else {
				$this->currentUser = unserialize(PraizedCipher::decrypt($_COOKIE[$this->_cookieHash], $this->_cookieHash));
			}
		}	
	
		/**
		 * Saves the fully qualified URL to return to
		 * 
		 * @param string $url where to go after authorization?
		 * @since 0.1
		 */
		function _saveReturnTo($url = NULL) {
			if($url != NULL) {
				$this->currentUser["returnTo"] = $url;
				$this->_saveTokens();
			}
		} 
	
		/**
		 * Save the tokens to the cookie jar.
		 * 
		 * @since 0.1
		 */
		function _saveTokens() {
			setcookie($this->_cookieHash, PraizedCipher::encrypt(serialize($this->currentUser), $this->_cookieHash), time() + $this->_expirationTime, "/", $this->_cookieDomain());
		}
		
		/**
		 * Generate the cookie hash for a specific user
		 * this hash is use to get the correct cookie key.
		 * 
		 * @return string the complete hash for the current session.
		 * @since 0.1
		 */
		function _generateCookieHash() {
			$secret = $this->_consumerKey . $this->_consumerSecret . $_SERVER['REMOTE_ADDR'];
		    if ( function_exists('sha1') )
			    return sha1($secret);
			else
			    return md5($secret);
		}
	}
}
?>