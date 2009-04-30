<?php
/**
 * Praized Core WordPress Lib
 * 
 * Common codebase used by the Praized WordPress plugins.
 *
 * @version 2.0
 * @package PraizedWP
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedWP')) {
    /**
     * Praized Core WordPress Lib
     * 
     * Common codebase used by the Praized WordPress plugins.
     * 
     * @package PraizedWP
     * @since 0.1
     */
    class PraizedWP {
        /**
         * PraizedWP version
         * @var string
         * @since 0.1
         */
        var $version = '2.0';
        
        /**
         * Plugin errors
         * @var array
         * @since 0.1
         */
    	var $errors  = array();
        
        /**
         * Public plugin admin notices
         * @var array
         * @since 0.1
         */
    	var $notices = array();
    
    	/**
    	 * Public instance of the loaded Praized Portable PHP Library class
    	 * @var mixed Boolean FALSE or object
    	 * @since 0.1
    	 */
    	var $Praized = FALSE;
    
    	/**
    	 * Public instance of the loaded PraizedXHTML Library class
    	 * @var mixed Boolean FALSE or object
    	 * @since 0.1
    	 */
    	var $PraizedXHTML = FALSE;
    
    	/**
    	 * Safe script uri
    	 * @var string
    	 * @since 0.1
    	 */
    	var $_script_uri;
    
    	/**
    	 * Fully qualified URL to the root of the WP install (WP's get_bloginfo('wpurl'))
    	 * @var string
    	 * @since 0.1
    	 */
    	var $_site_url;
    	
    	/**
    	 * Fully qualified URL to the blog WP blog (WP's get_option('home'))
    	 * @var string
    	 * @since 0.1
    	 */
    	var $_blog_url;
    	
    	/**
    	 * Plugin identifier (should also be the WP plugin's directory and file name). 
    	 * EG: praized-tools for wp-content/plugins/praized-tools/praized-tools.php 
    	 * @see self::PraizedWP($plugin_name)
    	 * @var string
    	 * @since 0.1
    	 */
    	var $_plugin_name;
    
    	/**
    	 * Relative path from WP install root to extending WP plugin's directory. 
    	 * EG: wp-content/plugins/praized-tools
    	 * @var string
    	 * @since 0.1
    	 */
    	var $_plugin_dir;
    	
    	/**
    	 * Fully qualified URL to extending WP plugin's directory
    	 * @var string
    	 * @since 0.1
    	 */
    	var $_plugin_dir_url;
    	
    	/**
    	 * Fully qualified URL to the root of the WP admin
    	 * @var string
    	 * @since 0.1
    	 */
    	var $_admin_url;
    	
    	/**
    	 * Absolute FS path to the extending WP plugin's include directory
    	 * @var string
    	 * @since 0.1
    	 */
    	var $_includes;
    	
    	/**
    	 * Absolute FS path to the extending WP plugin's bundled Praized PHP 4 lib's include directory
    	 * @var string
    	 * @since 0.1
    	 */
    	var $_praized_inc_dir;
    	
    	/**
    	 * Current Wordpress install version
    	 * @var float
    	 * @since 0.1
    	 */
    	var $_wp_version;
    	
    	/**
    	 * Unique cache key identifier based on self::_plugin_name
    	 * @var string
    	 * @since 0.1
    	 */
    	var $_cache_key;
    	
    	/**
    	 * Unique widget identifier based on self::_plugin_name
    	 * @var string
    	 * @since 0.1
    	 */
    	var $_wdgt_key;
    	
    	/**
    	 * Placeholder for the form data sent by the extending WP plugin's config form
    	 * @var array
    	 * @since 0.1
    	 */
    	var $_config_form;
    	
    	/**
    	 * Plugin configuration (WP options)
    	 * @var array
    	 * @since 0.1
    	 */
    	var $_config;
    	
    	/**
    	 * Constructor
    	 * 
    	 * @param string $plugin_name Plugin identifier (should also be the WP plugin's dir and file name).
    	 * @return PraizedWP
    	 * @since 0.1
    	 * @see self::_plugin_name for details on $plugin_name
    	 */
    	function PraizedWP($plugin_name) {
    	    if ( ! isset($_SERVER['SCRIPT_URI']) ) {
    	        list($path, $qs) = explode('?', $_SERVER['REQUEST_URI']);
    	        $this->_script_uri = sprintf(
    	            '%s://%s%s',
    	            ( isset($_SERVER['HTTPS']) ) ? 'https' : 'http',
    	            $_SERVER['HTTP_HOST'],
    	            $path
    	        );
    	    } else {
    	        $this->_script_uri = $_SERVER['SCRIPT_URI'];
    	    }
    	    
    	    $this->_site_url        = get_bloginfo('wpurl');
    		$this->_blog_url        = get_option('home');
    		$this->_plugin_name     = strtolower(preg_replace('/[^a-zA-Z0-9-]/', '_', $plugin_name));
    		$this->_plugin_dir      = '/' . PLUGINDIR . '/' . $this->_plugin_name;
    		$this->_plugin_dir_url  = $this->_site_url .$this->_plugin_dir;
    		$this->_admin_url       = $this->_site_url . '/wp-admin';
    		$this->_includes        = ABSPATH . $this->_plugin_dir . '/includes';
    		$this->_praized_inc_dir = $this->_includes . '/php/praized-php';
    		$this->_praized_inc_url = $this->_plugin_dir_url . '/includes/php/praized-php';

            // WordPress version  
    		global $wp_db_version;
    		if ( $wp_db_version >= 8201 )
    			$this->_wp_version = 2.6;
    		elseif ( $wp_db_version >= 7558 )
    			$this->_wp_version = 2.5;
    		elseif ( $wp_db_version >= 6124 )
    			$this->_wp_version = 2.3;
    		elseif ( $wp_db_version >= 5183 )
    			$this->_wp_version = 2.2;
    		elseif ( $wp_db_version >= 4772 )
    			$this->_wp_version = 2.1;
    		else
    			$this->_wp_version = 0; // We do not support version less than 2.1 (officially 2.2) anyway
    		
    		// Localization if we're using WordPress in a different language
    		// Just drop it in "{this->_plugin_name}/includes/localization/{this->_plugin_name}-{lang code in wp-config}.mo"
    		$mo_path = '/includes/localization';
    		if ( $this->_wp_version >= 2.6 )
    			load_plugin_textdomain( $this->_plugin_name, FALSE, $this->_plugin_name . $mo_path );
    	    else
    	        load_plugin_textdomain( $this->_plugin_name, PLUGINDIR . '/' . $this->_plugin_name . $mo_path );
    		
    		if ( ! defined('PLUGINDIR') ) {
    			add_action( 'admin_notices', array(&$this, 'wp_action_too_old') );
    			return;
    		} elseif ( ! file_exists($this->_includes . '/../' . $this->_plugin_name . '.php') || ! file_exists($this->_praized_inc_dir.'/Praized.php') ) {
    			add_action( 'admin_notices', array(&$this, 'wp_action_incorrectly_installed') );
    			return;
    		}
    		
            if ( $this->_wp_version < 2.1 ) {
    			add_action( 'admin_notices', array(&$this, 'wp_action_too_old') );
    			return;
            }
    		
            $this->_cache_key   = $this->_plugin_name . '_cache';
    		$this->_wdgt_key    = $this->_plugin_name . '_widget';
    		
    		$this->_config_form = array();
    		
    		$this->_config = $this->_get_wp_option('config');
    		if ( ! is_array($this->_config)) {
        		$this->_config = array(
        			'community' => '',
        			'api_key'   => '',
        			'caching'   => 0,
        			'cache_ttl' => 0,
        		    'theme'     => '009900'
        	    );
    		} else {
    		    // Additions since 1.0 time
    		    if ( ! isset($this->_config['theme']) )
    		        $this->_config['theme'] = '009900'; 
    		}
    	        
    	    // Ensure we cache for at least 1 minute if caching is enabled
    	    if ( $this->_use_caching() && intval($this->_config['cache_ttl']) < 60 )
    	        $this->_config['cache_ttl'] = 60;
    	}
    	
    	/**
    	 * [returns] Convenience localization method, adds the proper text domain 
    	 *
    	 * @param string $str Localizable string
    	 * @return string
    	 * @since 0.1
    	 */
    	function __($str) {
    	    return __($str, $this->_plugin_name);
    	}
    	
    	/**
    	 * [echoes] Convenience localization method, adds the proper text domain 
    	 *
    	 * @param string $str Localizable string
    	 * @since 0.1
    	 */
    	function _e($str) {
    	    _e($str, $this->_plugin_name);
    	}
    	
    	/**
    	 * Standard method for echoing errors (or notices) in the admin section.
    	 *
    	 * @param boolean $notices Send TRUE to output WP admin notices instead of errors (just a different CSS style)
    	 * @since 0.1
    	 */
    	function wp_action_admin_errors($notices = FALSE) {
    		if ( $notices ) {
    		    $messages = $this->notices;
    		    $css = 'updated fade-ffffcc';
    		} else {
    		    $messages = $this->errors;
    		    $css = 'error fade-ffffcc';
    		}
    	    
    		echo '<div id="' . $this->_plugin_name . '-error" class="'. $css .'"><p>';
    		
    		if ( count($messages) == 1 )
    		    $out = $messages[0];
    		else
    		    $out = '<ul><li>' . implode( '</li><li>', $messages ) . "</li></ul>\n";
    		
    		if ( ! empty($this->_plugin_name) )
    			$title = ucwords(str_replace('-', ' ', $this->_plugin_name));
    		else
    			$title = $this->__('Praized Plugin');
    			
    		if ( $notices )
    			$title .= ' ' . $this->__('Notices');
    		else
    			$title .= ' ' . $this->__('Errors');
    	    
    		printf(
    			'<strong>%s:</strong> %s',
    	    	$title,
    			$out
    		);
    		echo "</p></div>\n";
    	}
    
    	/**
    	 * Standard method for echoing notices in the admin section, mostly used through WP's add_action('admin_notices', ...).
    	 *
    	 * @since 0.1
    	 */
    	function wp_action_admin_notices() {
    		$this->wp_action_admin_errors(TRUE);
    	}
    	 	
    	/**
    	 * Displays an admin error stating this version of WordPress is too old.
    	 *
    	 * @since 0.1
    	 */
    	function wp_action_too_old() {
    		$this->errors[] = sprintf(
    			$this->__('
    				<strong>WordPress Version Too Old:</strong>
    				The Praized Plugins are only compatible with WordPress 2.1+ and are designed for use with the latest version of WordPress.
    				Please <a href="%s">upgrade to the latest version</a>.
    			'),
    			'http://wordpress.org/download/'
    		);
    		add_action( 'admin_notices', array(&$this, 'wp_action_admin_errors') );
    	}
    
    	/**
    	 * Displays an admin error stating this plugin is incorrectly installed.
    	 *
    	 * @since 0.1
    	 */
    	function wp_action_incorrectly_installed() {
    		$this->errors[] = sprintf(
    			$this->__("
    				<strong>Praized Plugin Incorrectly Installed:</strong>
    				The Praized Plugins plugin must be installed to <code>%s</code> and it's directory structure intact.
    				You will not be able to use the plugin until this is fixed.
    			"),
    			$this->_plugin_dir
    		);
    		add_action( 'admin_notices', array(&$this, 'wp_action_admin_errors') );
    	}
    	
    	/**
    	 * Strips most undesirable things from strings to be printed onscreen or sent to the API (htmlspecialchars(strip_tags(stripslashes(urldecode($val))))).
    	 *
    	 * @param string $val Value to be cleaned up
    	 * @return string sanitized string (note: not a security panacea)
    	 * @since 0.1
    	 */
    	function stripper($val) {
    	    return htmlspecialchars(strip_tags(stripslashes(urldecode($val))));
    	}
    	
    	/**
    	 * Unique key generator for WP options based on the integrated plugin's name (EG: praized-tools)
    	 *
    	 * @param string $key
    	 * @return string
    	 * @since 0.1
    	 */
    	function _wp_option_key($key) {
    		return $this->_plugin_name . '-' . $key;
    	}
    	
    	/**
    	 * Returns a Praized WP option
    	 * 
    	 * @param string $key
    	 * @return string
    	 * @since 0.1
    	 */
    	function _get_wp_option($key) {
    		return get_option($this->_wp_option_key($key));
    	}
    	
    	/**
    	 * Saves a Praized WP option
    	 *
    	 * @param string $key
    	 * @param mixed $value Note: WP serializes values, so obj and arrays are okay
    	 * @return boolean WP's update_option() status
    	 */
    	function _save_wp_option($key, $value) {
    	    return update_option($this->_wp_option_key($key), $value);
    	}
    	
    	/**
    	 * Enqueues the upgrade notices to be displayed to the admin user through PraizedWP::wp_action_admin_notices()
    	 * 
    	 * @param array $notices Messages in the form of {version} => {message}
    	 * @return void
    	 * @since 1.7
    	 */
    	function _queue_upgrade_notices($notices) {
	    	if ( is_array($notices) ) {
				$out = sprintf(
					'<form action="%s/options-general.php?page=%s/%s.php" method="post"><ul>',
					$this->_admin_url,
					$this->_plugin_name,
					$this->_plugin_name
				);
				foreach ( $notices as $version => $msg ) {
					$out .= "<li><strong>{$version}</strong>: {$msg}</li>";
				}
				$out .= '</ul><p>';
				$out .= sprintf(
					'See the changelog included at the bottom of the <a href="%s/readme.txt" target="_blank">bundled README file</a> for more info.',
					$this->_plugin_dir_url
				);
				$out .= '</p>';
				$out .= sprintf(
					'<input type="submit" name="stop_nagging" value="%s" class="button-primary" style="margin-bottom: 10px;" />',
					$this->__('Acknowledged')
				) . '</form>';
				$this->notices[] = $out;
				add_action( 'admin_notices', array(&$this, 'wp_action_admin_notices') );
			}
    	}
    	
    	/**
    	 * Saves a wp options so that upgrade related notices stop nagging admin users.
    	 * 
    	 * @return booelan TRUE if processed, FALSE if not
    	 * @since 1.7
    	 */
    	function _clear_upgrade_notices() {
	    	if ( isset($_POST['stop_nagging']) ) {
				$this->_save_wp_option('last_upgrade', time());
				return TRUE;
			}
			return FALSE;
    	}
    	
    	/**
    	 * Tests if we have some errors in Praized::errors
    	 *
    	 * @return boolean
    	 * @since 0.1
    	 */
    	function _has_praized_errors() {
    		$pe = $this->Praized->errors;
    		if ( count($pe) > 0 ) {
    			$this->errors = $this->errors + $pe;
    			return TRUE;
    		} else {
    			return FALSE;
    		}
    	}
    	
    	/**
    	 * Loads the Praized PHP library (if not already loaded)
    	 *
    	 * @return boolean Status
    	 * @since 0.1
    	 */
    	function _load_praized() {
    		if ( is_object($this->Praized) ) {
    			return TRUE;
    		} else {
    			$p_inc = $this->_praized_inc_dir.'/Praized.php';
    	
    			if ( file_exists($p_inc) ) {
    				require_once($p_inc);
    				
    				if ( class_exists('Praized') ) {
    					$oauth_consumer_key    = ( isset($this->_config['oauth_consumer_key']) )
    					    ? $this->_config['oauth_consumer_key']
    					    : NULL;
    					
    					$oauth_consumer_secret = ( isset($this->_config['oauth_consumer_secret']) )
    					    ? $this->_config['oauth_consumer_secret']
    					    : NULL;
    					
    					$this->Praized = new Praized($this->_config['community'], $this->_config['api_key'], $oauth_consumer_key, $oauth_consumer_secret);
    					
    					if ( $this->_has_praized_errors() )
    						return FALSE;
    					elseif ( is_object($this->PraizedXHTML) ) {
                			return TRUE;
            		    } else {
            		        if ( ! class_exists('PraizedXHTML') )
            		            require_once($this->_praized_inc_dir.'/PraizedXHTML.php');
            		        $this->PraizedXHTML = new PraizedXHTML();
            		        return TRUE;
            		    }
    				} else {
    					$this->errors[] = sprintf($this->__('Requested Praized class not found inside %s.'), $p_inc);
    					return FALSE;
    				}
    			} else {
    				$this->errors[] = sprintf($this->__('Requested Praized library not found in %s.'), $p_inc);
    				return FALSE;
    			}
    		}
    	}
	
    	/**
    	 * Get xhtml output as provided by the PraizedXHTML library
    	 *
    	 * @param object $data Appropriate object as returned by the Praized portable php library
    	 * @param string $template Which template should be loaded (see praized-php/PraizedXHTML/*)
    	 * @param array $config Optional array storing configurations expected by PraizedXHTML::xhtml 
    	 * @return string
    	 */
    	function _xhtml($data, $template, $config = array()) {
    	    if ( ! $this->_load_praized() || ! $this->PraizedXHTML )
    	        return FALSE;
    	    return $this->PraizedXHTML->xhtml($data, $template, $config);
    	}
    	
    	/**
    	 * Returns the proper <link rel="stylesheet" /> as provided by PraizedXHTML::css()
    	 *
    	 * @return string
    	 */
    	function _css() {
    	    if ( ! $this->_load_praized() || ! $this->PraizedXHTML )
    	        return FALSE;
    	    $theme = $this->_config['theme'];
    	    if ( ! defined('WPLANG') || WPLANG == '' || ! isset($this->PraizedXHTML->themes[WPLANG]) )
    	    	$lang = 'en';
    	    else
    	    	$lang = WPLANG;
    	    if ( empty($theme) || ! isset($this->PraizedXHTML->themes[$lang][$theme]) )
    	         $theme = $this->PraizedXHTML->defaultTheme;
    	    return $this->PraizedXHTML->css($this->_praized_inc_url, $theme, $this->version);
    	}
    	
    	/**
    	 * Tests if caching is available and enabled at the WP level
    	 *
    	 * @return mixed TRUE if available OR descriptive error/warning string if not
    	 * @since 0.1
    	 */
    	function _test_caching() {
            if ( function_exists('wp_cache_get') && function_exists('wp_cache_set') ) {
                global $wp_object_cache;
                if ( is_object($wp_object_cache) && $wp_object_cache->cache_enabled ) {
    	            return TRUE;
    	        } else {
    	            return sprintf(
    	            	$this->__('<a href="%s" target="_bank">Wordpress caching</a> is currently disabled.'),
    	                'http://codex.wordpress.org/WordPress_Optimization/Caching'
    	            );
    	        }
    	    } else {
    	        return sprintf(
	            	$this->__('The <a href="%s" target="_bank">caching functions</a> do not seem to be available in your Wordpress install.'),
	                'http://codex.wordpress.org/Function_Reference/WP_Cache'
	            );
    	    }
    	}
    	
    	/**
    	 * Tests if the current Praized plugin is configured to use caching
    	 *
    	 * @return boolean
    	 * @since 0.1
    	 */
    	function _use_caching() {
    	    return ( ( TRUE === $this->_test_caching() ) && ( intval($this->_config['caching']) === 1 ) ) ? TRUE : FALSE;
    	}
    	
    	/**
    	 * Saves a key/value pair using the WP caching engine of choice, if enabled
    	 *
    	 * @param string $key Unique identifier
    	 * @param mixed $value Value to cache
    	 * @param integer $ttl Time to live, in seconds, defaults to self::_config['cache_ttl']
    	 * @return boolean
    	 * @since 0.1
    	 */
    	function _set_cache($key, $value, $ttl = 60) {
    	    if ( TRUE === $this->_use_caching() ) {
    	        if ( intval($ttl) < 60 ) {
        	        if ( isset($this->_config['cache_ttl']) && $this->_config['cache_ttl'] >= 60 ) {
        	            $ttl = $this->_config['cache_ttl'];
        	        } else {
        	            $ttl = 60;
        	        }
    	        }
    	        wp_cache_set($key, $value, $this->_cache_key, $ttl);
    	        return TRUE;
    	    } else {
    	        return FALSE;
    	    }
    	}
    	
    	/**
    	 * Retrieves a cached key/value pair from the WP caching engine of choice, if enabled
    	 *
    	 * @param string $key Unique identifier
    	 * @return mixed boolean FALSE OR Cached value
    	 * @since 0.1
    	 */
    	function _get_cache($key) {
    	    if ( TRUE === $this->_use_caching() ) {
        	    return wp_cache_get($key, $this->_cache_key);
    	    } else {
    	        return FALSE;
    	    }
    	}
    	
    	/**
    	 * Deletes a cached key/value pair from the WP caching engine of choice, if enabled
    	 *
    	 * @param string $key Unique identifier
    	 * @return mixed boolean FALSE OR Cached value
    	 * @since 1.7
    	 */
    	function _del_cache($key) {
    	    if ( TRUE === $this->_use_caching() ) {
        	    return wp_cache_delete($key, $this->_cache_key);
    	    } else {
    	        return FALSE;
    	    }
    	}
    	
    	/**
    	 * Saves the plugin configurations, expects self::_config_form
    	 *
    	 * @return boolean Status
    	 * @since 0.1
    	 */
    	function _save_config() {
    	    $form = $this->_config_form;
    	    
    	    foreach( $this->_config as $key => $value ) {
    	        if (isset($_POST[$key])) {
    	            $form[$key] = $this->_config[$key] = stripslashes($_POST[$key]);
    	        } else {
    	            $form[$key] = FALSE;
    	        }
    	    }
    	    
    	    if ( ! $this->_load_praized() ) {
    	        $this->errors[] = $this->__('Please be sure to fill all the required fields.');
    	        add_action( 'admin_notices', array(&$this, 'wp_action_admin_errors') );
    	        $status = FALSE;
    	    } elseif ( FALSE !== ( $response = $this->Praized->test() ) ) {
    	        $this->_save_wp_option('config', $form);
    	        $this->notices[] = $this->__('Your configurations were successfully tested and saved.');
    	        if ( isset($this->_config['trigger']) ) {
	    	        $base_url    = rtrim($response->community->base_url, '/');
	    	        $trigger_url = rtrim($this->_blog_url . $this->_config['trigger'], '/');
	    	        if ( $base_url != $trigger_url ) {
	    	        	$this->notices[] = $this->__('NOTE: Although your credentials are fine, the community URL you provided when requesting your API key does not exactly match how your blog is setup, which might lead to issues with the dynamic vote button.');
	    	        	$this->notices[] = sprintf(
	    	        		$this->__('%s vs. %s'),
	    	        		$base_url,
	    	        		$trigger_url
	    	        	);
	    	        	$this->notices[] = sprintf(
	    	        		$this->__('<a href="%s">Contact us</a> for help with the above, if you notice problems when voting while logged out.'),
	    	        		'help@praized.com'
	    	        	);
	    	        }
    	        }
    	        add_action( 'admin_notices', array(&$this, 'wp_action_admin_notices') );
    	        $status = TRUE;
    	    } else {
    	        $this->errors[] = $this->__('Sorry, but we could not activate your access to the Praized API with the submitted information.');
    	        add_action( 'admin_notices', array(&$this, 'wp_action_admin_errors') );
    	        $status = FALSE;
    	    }
    	    
    	    $this->_config_form = $form;
    	    
    	    return $status;
    	}
    	
    	/**
    	 * Returns merchant listing from cache if available or from Praized->merchants()->get()
    	 *
         * @param array $query Associative array matching the query string keys supported by the Praized API.
         * @return array List of merchants objects as returned by the Praize API
         * @since 0.1
    	 */
    	function merchants_get($query = array()) {
    	    $cache_key = 'merchants_get_' . md5(serialize($query));
    	    if ( FALSE === ( $results = $this->_get_cache($cache_key) ) ) {
    	    	$o = $this->Praized->merchants();
    	        $results = $o->get($query);
                $this->_set_cache($cache_key, $results);
    	    }
    	    return $results;
    	}
    	
    	/**
    	 * Returns merchant search results from cache if available or from Praized->merchants()->search()
    	 *
         * @param string $term Search term
         * @param string $location City/location
         * @param integer $limit Resultset limit
         * @param array $extra_query Supplemental query parameters (details, etc)
         * @return array List of merchants objects as returned by the Praize API
         * @since 0.1
    	 */
    	function merchants_search($term = '', $location = '', $limit = 10, $extra_query = array()) {
    	    $cache_key = 'merchants_search_' . md5(serialize(array($term, $location, $limit, $extra_query)));
    	    if ( FALSE === ( $results = $this->_get_cache($cache_key) ) ) {
    	        $o = $this->Praized->merchants();
    	    	$results = $o->search($term, $location, $limit, $extra_query);
                $this->_set_cache($cache_key, $results);
    	    }
    	    return $results;
    	}
    	
    	/**
    	 * Returns merchant search results from cache if available or from Praized->merchants()->resolve()
    	 *
         * @param array $list List of strings to be matched, in the form of $list = array('pids' => array(), 'permalinks' => array(), 'short_urls' => array())
         * @param integer $limit Resultset limit
         * @param array $extra_query Supplemental query parameters (details, etc)
         * @return array List of merchants objects as returned by the Praize API
         * @since 0.1
    	 */
    	function merchants_resolve($list, $limit = 10, $extra_query = array()) {
    	    $cache_key = 'merchants_resolve_' . md5(serialize(array($list, $limit, $extra_query)));
    	    if ( FALSE === ( $results = $this->_get_cache($cache_key) ) ) {
    	        $o = $this->Praized->merchants();
    	    	$results = $o->resolve($list, $limit, $extra_query);
                $this->_set_cache($cache_key, $results);
    	    }
    	    return $results;
    	}
    	
    	/**
    	 * Returns an individual merchant's data from cache if available or from Praized->merchant()->get()
    	 *
         * @param string $pid Merchant PID
         * @param array  $query Associative array matching the query string keys supported by the Praized API.
         * @return object Merchants object as returned by the Praize API
         * @since 0.1
    	 */
    	function merchant_get($pid, $query = array()) {
    	    $cache_key = 'merchant_get_' . md5(serialize(array($pid, $query)));
    	    if ( FALSE === ( $results = $this->_get_cache($cache_key) ) ) {
    	        $o = $this->Praized->merchant();
    	    	$results = $o->get($pid, $query);
                $this->_set_cache($cache_key, $results);
    	    }
    	    return $results;
    	}
    	
    	/**
    	 * Returns an individual merchant's attribute value from cache if available or from Praized->merchant()->get()
    	 *
         * @param string $pid Merchant PID
    	 * @param string $attribute Merchant attribute (permalink, name)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @return mixed, as returned by the Praized API
    	 */
    	function merchant_attribute($pid, $attribute, $query = array()) {
    	    $cache_key = 'merchant_attribute_' . md5(serialize(array($pid, $query)));
    	    if ( FALSE === ( $results = $this->_get_cache($cache_key) ) ) {
    	        $o = $this->Praized->merchant();
    	    	$results = $o->attribute($pid, $attribute, $query);
                $this->_set_cache($cache_key, $results);
    	    }
    	    return $results;
    	}
    	
    	/**
    	 * Returns an individual user's data from cache if available or from Praized->user()->get()
    	 *
         * @param string $username Praized username
         * @param array  $query Associative array matching the query string keys supported by the Praized API.
         * @return object Users object as returned by the Praize API
         * @since 0.1
    	 */
    	function user_get($username, $query = array()) {
    	    $cache_key = 'user_get_' . md5(serialize(array($username, $query)));
    	    if ( FALSE === ( $results = $this->_get_cache($cache_key) ) ) {
    	        $o = $this->Praized->user();
    	    	$results = $o->get($username, $query);
                $this->_set_cache($cache_key, $results);
    	    }
    	    return $results;
    	}
    	
    	/**
    	 * Returns an individual user's attribute value from cache if available or from Praized->user()->get()
    	 *
         * @param string $username Praized username
    	 * @param string $attribute User attribute (permalink, name)
    	 * @param array  $query Associative array matching the query string keys supported by the Praized API.
    	 * @return mixed, as returned by the Praized API
    	 */
    	function user_attribute($username, $attribute, $query = array()) {
    	    $cache_key = 'user_attribute_' . md5(serialize(array($username, $query)));
    	    if ( FALSE === ( $results = $this->_get_cache($cache_key) ) ) {
    	        $o = $this->Praized->user();
    	    	$results = $o->attribute($username, $attribute, $query);
                $this->_set_cache($cache_key, $results);
    	    }
    	    return $results;
    	}
    	
    	/**
    	 * Returns latest activity from cache if available or from Praized->merchants()->get()
    	 *
         * @param array $query Associative array matching the query string keys supported by the Praized API.
         * @return array List of merchants objects as returned by the Praize API
         * @since 2.0
    	 */
    	function actions_get($query = array()) {
    	    $cache_key = 'actions_get_' . md5(serialize($query));
    	    if ( FALSE === ( $results = $this->_get_cache($cache_key) ) ) {
    	    	$o = $this->Praized->actions();
    	        $results = $o->get($query);
                $this->_set_cache($cache_key, $results);
    	    }
    	    return $results;
    	}
    	
    	/**
    	 * Returns latest questions from cache if available or from Praized->merchants()->get()
    	 *
         * @param array $query Associative array matching the query string keys supported by the Praized API.
         * @return array List of merchants objects as returned by the Praize API
         * @since 2.0
    	 */
    	function questions_get($query = array()) {
    	    $cache_key = 'questions_get_' . md5(serialize($query));
    	    if ( FALSE === ( $results = $this->_get_cache($cache_key) ) ) {
    	    	$o = $this->Praized->questions();
    	        $results = $o->get($query);
                $this->_set_cache($cache_key, $results);
    	    }
    	    return $results;
    	}
    }
}
?>