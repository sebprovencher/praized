<?php
/**
 * Praized Community
 * 
 * @version 1.0.3
 * @package PraizedCommunity
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Include Praized Core Wordpress Class
 */
require_once(dirname(realpath(__FILE__)).'/praized-wp-core/PraizedWP.php');

/**
 * Praized Community: class
 * 
 * @package PraizedCommunity
 * @since 0.1
 */
class PraizedCommunity extends PraizedWP {
	/**
     * Valid Praized Community URL routes
     * @var array
     * @since 0.1
     */
    var $_routes = array(
        'merchants',
        'places',
        'users',
        'oauth'
    );
    
    /**
     * Fully qualified URL where the Praized Community plugin starts taking over the WP install
     * @var mixed String or NULL
     * @since 0.1
     */
    var $trigger_url;
    
    /**
     * Keeps track of if the current page is a merchant listing route
     * @var boolean
     * @since 0.1
     */
    var $_route_is_merchants = FALSE;
    
    /**
     * Keeps track of if the current page is a tag-based merchant listing route
     * @var boolean
     * @since 0.1
     */
    var $_route_is_tag = FALSE;
    
    /**
     * Keeps track of if the current page is a single merchant route
     * @var boolean
     * @since 0.1
     */
    var $_route_is_merchant = FALSE;
    
    /**
     * Keeps track of if the current page is a single user route
     * @var boolean
     * @since 0.1
     */
    var $_route_is_user = FALSE;
    
    /**
     * API object holder: Community data
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_community = FALSE;
    
    /**
     * API object holder: Pagination data
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_pagination = FALSE;
    
    /**
     * API object holder: Authenticated user related data in vote nodes and such
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_auth_self = FALSE;
    
    /**
     * API object holder: Targeted user related data in vote nodes and such
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_auth_target = FALSE;
    
    /**
     * API object holder: Merchants data (collection)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_merchants = FALSE;
    
    /**
     * Keeps track of which merchant we're dealing with in $this->tpt_merchants_loop()
     * @var integer
     * @since 0.1
     */
    var $tpt_merchant_index = 0;
    
    /**
     * API object holder: Merchant data (single)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_merchant = FALSE;
    
    /**
     * Keeps track of if there is another merchant to be processed in $this->tpt_merchants_loop()
     * @var boolean
     * @since 0.1
     */
    var $tpt_has_next_merchant = FALSE;
    
    /**
     * API object holder: User data (single)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_user = FALSE;
    
    /**
     * API object holder: Merchant tag data (collection)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_tags = FALSE;
    
    /**
     * Keeps track of which merchant tag we're dealing with in $this->tpt_tags_loop()
     * @var integer
     * @since 0.1
     */
    var $tpt_tag_index = 0;
    
    /**
     * API object holder: Merchant tag data (single)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_tag = FALSE;
    
    /**
     * Keeps track of if there is another merchant tag to be processed in $this->tpt_tags_loop()
     * @var boolean
     * @since 0.1
     */
    var $tpt_has_next_tag = FALSE;
    
    /**
     * API object holder: Merchant sponsored link data (collection)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_splinks = FALSE;
    
    /**
     * Keeps track of which merchant sponsored link we're dealing with in $this->tpt_splinks_loop()
     * @var integer
     * @since 0.1
     */
    var $tpt_splink_index = 0;
    
    /**
     * API object holder: Merchant sponsored link data (single)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_splink = FALSE;
    
    /**
     * Keeps track of if there is another merchant sponsored link to be processed in $this->tpt_splinks_loop()
     * @var boolean
     * @since 0.1
     */
    var $tpt_has_next_splink = FALSE;
    
    /**
     * API object holder: Merchant or user comment data (collection)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_comments = FALSE;
    
    /**
     * Keeps track of which merchant or user comment we're dealing with in $this->tpt_comments_loop()
     * @var integer
     * @since 0.1
     */
    var $tpt_comment_index = 0;
    
    /**
     * API object holder: Merchant or user comment data (single)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_comment = FALSE;
    
    /**
     * Keeps track of if there is another merchant or user comment to be processed in $this->tpt_comments_loop()
     * @var boolean
     * @since 0.1
     */
    var $tpt_has_next_comment = FALSE;
    
    /**
     * API object holder: Merchant or user favorites/bookmarks data (collection)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_favorites = FALSE;
    
    /**
     * Keeps track of which merchant or user favorite/bookmark we're dealing with in $this->tpt_favorites_loop()
     * @var integer
     * @since 0.1
     */
    var $tpt_favorite_index = 0;
    
    /**
     * API object holder: Merchant or user favorite/bookmark data (single)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_favorite = FALSE;
    
    /**
     * Keeps track of if there is another merchant or user favorite/bookmark to be processed in $this->tpt_favorites_loop()
     * @var boolean
     * @since 0.1
     */
    var $tpt_has_next_favorite = FALSE;
    
    /**
     * API object holder: Merchant or user votes data (collection)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_votes = FALSE;
    
    /**
     * Keeps track of which merchant or user vote we're dealing with in $this->tpt_votes_loop()
     * @var integer
     * @since 0.1
     */
    var $tpt_vote_index = 0;
    
    /**
     * API object holder: Merchant or user vote data (single)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_vote = FALSE;
    
    /**
     * Keeps track of if there is another merchant or user vote to be processed in $this->tpt_votes_loop()
     * @var boolean
     * @since 0.1
     */
    var $tpt_has_next_vote = FALSE;
    
    /**
     * API object holder: Friends data (collection)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_friends = FALSE;
    
    /**
     * Keeps track of which friend we're dealing with in $this->tpt_friends_loop()
     * @var integer
     * @since 0.1
     */
    var $tpt_friend_index = 0;
    
    /**
     * API object holder: Friend data (single)
     * @var mixed boolean FALSE or object
     * @since 0.1
     */
    var $tpt_friend = FALSE;
    
    /**
     * Keeps track of if there is another friend to be processed in $this->tpt_friends_loop()
     * @var boolean
     * @since 0.1
     */
    var $tpt_has_next_friend = FALSE;
    
    /**
     * Search form widget identifier string
     * @var string
     * @since 0.1
     */
    var $wdgt_search_form_key;
    
    /**
     * Praized session widget identifier string
     * @var string
     * @since 0.1
     */
    var $wdgt_auth_nav_key;
    
    /**
	 * Constructor
	 *
	 * @return PraizedCommunity
	 * @since 0.1
	 * @see PraizedWP::PraizedWP()
	 */
	function PraizedCommunity() {
		PraizedWP::PraizedWP('praized-community');
		
		if ( ! isset($this->_config['trigger']) || empty($this->_config['trigger']) )
		    $this->_config['trigger'] = '/praized';
		    
		if ( ! isset($this->_config['oauth_consumer_key']) )
		    $this->_config['oauth_consumer_key'] = '';
		    
		if ( ! isset($this->_config['oauth_consumer_secret']) )
		    $this->_config['oauth_consumer_secret'] = '';

		if ( ! isset($this->_config['map_api_key']) )
		    $this->_config['map_api_key'] = '';

		if ( ! isset($this->_config['map_width']) )
		    $this->_config['map_width'] = '';

		if ( ! isset($this->_config['map_height']) )
		    $this->_config['map_height'] = '';

		if ( ! isset($this->_config['map_zoom_level']) )
		    $this->_config['map_zoom_level'] = '';
		
		$this->wdgt_search_form_key = $this->_wdgt_key . '_search_form';
		$this->wdgt_auth_nav_key    = $this->_wdgt_key . '_auth_nav';
	}

	/**
	 * Admin tools "constructor"
	 * 
	 * @since 0.1
	 */
	function admin_tools() {
		if ( ! strstr($_SERVER['QUERY_STRING'], $this->_plugin_name) && ( ! $this->_config['community'] || ! $this->_config['api_key']) ) {
			add_action('admin_notices', array(&$this, 'wp_action_install_warning'));
			return;
		}

		if ( count($_POST) > 0 ) {
			if ( strstr($_GET['page'], $this->_plugin_name) && isset($_POST['community']) ) {
                // Plugin config save
        		$missing_val_msg = $this->__('Please submit a value for the "%s" form field.');
                // error checking
        		if ( empty($_POST['community']) )
        		    $this->errors[] = sprintf( $missing_val_msg, $this->__('Community') );
                if ( empty($_POST['api_key']) ) 
        		    $this->errors[] = sprintf( $missing_val_msg, $this->__('API Key') );
                if ( empty($_POST['oauth_consumer_key']) ) 
        		    $this->errors[] = sprintf( $missing_val_msg, $this->__('OAuth Consumer Key') );
                if ( empty($_POST['oauth_consumer_secret']) ) 
        		    $this->errors[] = sprintf( $missing_val_msg, $this->__('OAuth Consumer Secret') );
                if ( empty($_POST['trigger']) ) 
        		    $this->errors[] = sprintf( $missing_val_msg, $this->__('URL Trigger') );
        		// error reporting
        		if ( count($this->errors) > 0 ) {
        		    add_action( 'admin_notices', array(&$this, 'wp_action_admin_errors') );
        		} else {
        		    if ( empty($_POST['trigger']) )
        		        $_POST['trigger'] = '/praized';
        		    $this->_save_config();
        		}
			} else {
    			// Search form widget config save
			    if( isset($_POST[$this->wdgt_search_form_key . '_title']) ) {
    			    $this->widget_search_form_options_save();
    			}
    			// Auth nav widget config save
    			if( isset($_POST[$this->wdgt_auth_nav_key . '_title']) ) {
    			    $this->widget_auth_nav_options_save();
    			}			    
			}
		}
		
		add_action('admin_menu', array(&$this, 'wp_action_admin_menu'));
	}
    
	/**
	 * Displays an admin notice to prompt the administrator(s) to configure the plugin.
	 *
	 * @since 0.1
	 */
	function wp_action_install_warning() {
		$this->_load_praized();
	    echo '<div id="praized-warning" class="error"><p>';
		printf(
			$this->__('Thank you for installing the <strong>Praized Community</strong> plugin. To finalize the installation, please take the time to <a href="%s">configure the last few details</a> and request your <a href="%s">Praized API key</a>.'),
			$this->_admin_url . '/options-general.php?page=' . $this->_plugin_name . '/' . $this->_plugin_name . '.php',
			$this->Praized->praizedLinks['api_request']
		);
		echo '</p></div>';
		echo "\n";
	}

	/**
	 * WP action: Admin menu handling
	 *
	 * @since 0.1
	 */
	function wp_action_admin_menu() {
		$name = 'Praized Community';
	    add_options_page(
			$this->__($name),
			$this->__($name),
			9,
			$this->_plugin_name . '/' . $this->_plugin_name . '.php',
			array(&$this, 'wp_options_page')
		);
	}

	
	/**
	 * Praized plugin configuration page
	 *
	 * @since 0.1
	 */
	function wp_options_page() {
		$form = ( count($this->_config_form) > 0 ) ? $this->_config_form : $this->_config;
		
		$permalink_structure = get_option('permalink_structure');
		if ( empty($permalink_structure) ) {
	        $this->errors[] = sprintf(
			    $this->__('Please be sure to use mod_rewrite and, by extension, "nice URLs" (ie: not "Default") in the <a href="%s/options-permalink.php">WordPress permalink structure</a> to setup your Praized Community.</p>'),
			    $this->_admin_url
			);
			$this->wp_action_admin_errors();
		} else {
		    $this->_load_praized();
		    require_once($this->_includes . '/php/config.php');
        }
	}	
	
	/**
	 * WP Widget: Search form option form
	 *
	 * @since 0.1
	 */
	function widget_search_form_options_form() {
	    $widget_id = $this->wdgt_search_form_key;
	    
	    $config = $this->_get_wp_option($widget_id);
	    if ( !is_array($config) )
	        $config = array();
	    
        $field_id = $widget_id . '_title';
	    echo '<p><label for="'.$field_id.'">'.$this->__('Widget Title').': '.'</label></br />';
	    echo '<input type="text" id="'.$field_id.'" name="'.$field_id.'" value="'.$config['title'].'" /></p>';
	}
	
	/**
	 * WP Widget: Search form option save process
	 *
	 * @since 0.1
	 */
	function widget_search_form_options_save() {
	    $widget_id = $this->wdgt_search_form_key;
	    // Note: _save_wp_option() sanitizes the content
	    $this->_save_wp_option($widget_id, array(
	        'title'   => $_POST[$widget_id . '_title']
	    ));
	}	
	
	/**
	 * WP Widget: Auth nav form option form
	 *
	 * @since 0.1
	 */
	function widget_auth_nav_options_form() {
	    $widget_id = $this->wdgt_auth_nav_key;
	    
	    $config = $this->_get_wp_option($widget_id);
	    if ( !is_array($config) )
	        $config = array();
	    
        $field_id = $widget_id . '_title';
	    echo '<p><label for="'.$field_id.'">'.$this->__('Widget Title').': '.'</label></br />';
	    echo '<input type="text" id="'.$field_id.'" name="'.$field_id.'" value="'.$config['title'].'" /></p>';
	}
	
	/**
	 * WP Widget: Auth nav option save process
	 *
	 * @since 0.1
	 */
	function widget_auth_nav_options_save() {
	    $widget_id = $this->wdgt_auth_nav_key;
	    // Note: _save_wp_option() sanitizes the content
	    $this->_save_wp_option($widget_id, array(
	        'title'   => $_POST[$widget_id . '_title']
	    ));
	}
	
	/**
	 * Display tools "constructor"
	 * 
	 * @since 0.1
	 */
	function display_tools() {
	    $this->_load_praized();
        
        // WP 2.3+
	    if ( function_exists('redirect_canonical') )
            add_filter('redirect_canonical', array(&$this, 'wp_filter_redirect_canonical'));
        
        add_filter('wp_title', array(&$this, 'wp_filter_page_title'));

        add_action('template_redirect', array(&$this, 'wp_action_template_redirect'));
        add_action('wp_head', array(&$this, 'wp_action_template_head'));
        add_action('wp_footer', array(&$this, 'wp_action_template_footer'));
	}
	
	/**
	 * Tests if the current URL is a Praized route
	 *
	 * @return mixed Boolean FALSE or String route.
	 * @since 0.1
	 */
	function _route_test() {
	    $trigger = $this->_config['trigger'];
	    if ( substr($trigger, 0, 1) != '/' )
	        $trigger = '/' . $trigger;
	    $this->trigger_url = $this->_site_url . $trigger;
	    if ( preg_match('|^' . $this->trigger_url . '(.*)$|', $this->_script_uri, $matches) ) {
	        $this->trigger_url = preg_replace('|/$|', '', $this->trigger_url);
	        return $matches[1];
	    } else {
	        return FALSE;
	    }
	}
	
	/**
	 * Contextual page header/title string generation
	 *
	 * @param string $separator Defaults to "&raquo;"
	 * @return string
	 */
	function page_header($separator = '&raquo;') {
	    $header = '';
	    if ( $this->_route_is_merchants ) {
	        $query    = ( $_GET['q'] ) ? $this->stripper($_GET['q']) : $this->__('Everything');
	        $location = ( $_GET['l'] ) ? $this->stripper($_GET['l']) : $this->__('Everywhere');
	        
	        if (  ! empty($_GET['t']) || ! empty($_GET['tag']) ) {
	            $tag = ( ! empty($_GET['t']) ) ? $this->stripper($_GET['t']) : $this->stripper($_GET['tag']);
	        } elseif ( $this->_route_is_tag ) {
	            preg_match('|/tag/([^/]*)|', $this->_script_uri, $matches);
	            if ( ! empty($matches[1]) )
	                 $tag = htmlspecialchars(urldecode($matches[1]));
	        }
	        
	        if ( isset($tag) )
	            $tag =  ' ' . $separator . ' ' . $this->__('Tag') . ': ' . $tag;
	        else
	            $tag = '';
	        
	        $header .= sprintf(
	            '%s %s %s%s',
	            ucfirst($query),
	            $separator,
	            ucfirst($location),
	            $tag
	        );
	    } elseif ( $this->_route_is_merchant && $this->tpt_has_merchant() ) {
	        $name    = $this->tpt_attribute_helper('merchant', 'name', FALSE);
	        $city    = $this->tpt_attribute_helper('merchant', 'location->city->name', FALSE);
	        $p_code  = $this->tpt_attribute_helper('merchant', 'location->postal_code', FALSE);
            $country = $this->tpt_attribute_helper('merchant', 'location->country->name', FALSE);
	        
            if ( ! ($region = $this->tpt_attribute_helper('merchant', 'location->regions->state', FALSE)) ) {
                $region = $this->tpt_attribute_helper('merchant', 'location->regions->province', FALSE);
            }
	        
            $header .= sprintf(
	            '%s (%s%s%s%s)',
	            $name,
	            ( $city )    ? $city    . ( ($region || $p_code || $country) ? ', ' : '') : '',
	            ( $region )  ? $region  . ( ($p_code || $country) ? ', ' : '') : '',
	            ( $p_code )  ? $p_code  . ( ($country) ? ', ' : '') : '',
	            ( $country ) ? $country : ''
	        );
	    } elseif ( $this->_route_is_user && $this->tpt_has_user() ) {
	        $login      = $this->tpt_attribute_helper('user', 'login', FALSE);
	        $first_name = $this->tpt_attribute_helper('user', 'first_name', FALSE);
	        $last_name  = $this->tpt_attribute_helper('user', 'last_name', FALSE);
	        
	        $full_name = $first_name . ( ($last_name) ? ' ' : '' ) . $last_name;
	        
	        $header = ( $full_name ) ? "{$full_name} ({$login})" : $login;
	    }
	    return $header;
	}
	
	/**
	 * Cancelling WP 2.3+ canonical redirects, but only if/when conflicting with the Praized integration
	 * 
	 * @return mixed Boolean FALSE or String url.
	 * @since 0.1
	 */
	function wp_filter_redirect_canonical($content) {
	    if ( FALSE !== $this->_route_test() )
	        return FALSE;
	    else
	        return $content;
	}
	
	/**
	 * Trigger-based API routing and template handling.
	 * 
	 * @since 0.1
	 */
	function wp_action_template_redirect() {
	    if ( FALSE !== ( $route = $this->_route_test() ) ) {
	        $this->_reroute($route);
	    }
	}
	
	/**
	 * WP action: processed when wp_head() is called in templates
	 *
	 * @since 0.1
	 */
	function wp_action_template_head() {
	    echo sprintf(
	        '<link rel="stylesheet" href="%s/includes/css/commons/styles.css?v=%s" type="text/css" media="screen" />' . "\n",
	        $this->_plugin_dir_url,
	        $this->version
	    );
	}
	
	/**
	 * WP action: processed when wp_head() is called in templates
	 *
	 * @since 0.1
	 */
	function wp_action_template_footer() {
	    echo sprintf(
	        '<script src="%s/includes/js/commons/PraizedVoteButton.js?v=%s" type="text/javascript" charset="utf-8"></script>' . "\n",
	        $this->_plugin_dir_url,
	        $this->version
	    );
	}
	
	/**
	 * WP filter: Generate SEO friendly page titles
	 *
	 * @param string $content Content sent by WP
	 * @since 0.1
	 */
	function wp_filter_page_title($content) {
	    $separator = '&raquo;';
	    $header = $this->page_header($separator);
	    return ( $header ) ? $content . ' ' . $separator . ' ' . $header : $content;
	}
	
	/**
	 * Resets the WP 404-related flags and checks (is_404(), http header, etc)
	 *
	 * @since 1.0.2
	 */
	function _reset_404() {
	    global $wp_query;
	    if ( is_object($wp_query) )
            $wp_query->is_404 = FALSE;
        status_header('200');
	}
	
    /**
     * Reroutes to the appropriate action and by extension, template.
     *
     * @param string $route EG: /merchants/search
	 * @since 0.1
     */
	function _reroute($route) {
	    /**
	     * Make sure to not hijack the entire wordpress install when
	     * $this->trigger_url is set to the site's root (/).
	     */
	    if ( $this->_config['trigger'] == '/' && $route != '/' && ! empty($route) ) {
	        $parts = explode('/', trim($route,'/'));
	        if ( ! $parts[0] || ! in_array($parts[0], $this->_routes) )
	            return;
	    }
	    
	    /**
	     * Default only to the merchant route when at the root of $this->trigger_url
	     */
	    if ( empty($route) || ($route == '/') )
	        $route = '/merchants';

        $parts = explode('/', trim($route,'/'));
        
        /**
         * If we're still really not in one of the Praized integration routes,
         * then just return and let WP handle the request. Allows for sub-pages
         * to $this->trigger_url, if not conflicting with the expected routes.
         */
        if ( ! isset($parts[0]) || ! in_array($parts[0], $this->_routes) )
            return;
        
        switch ($parts[0]) {
            case 'merchants':
            case 'places':
                $this->_route_merchants($parts);
                break;
            case 'users':
                $this->_route_user($parts);
                break;
            case 'oauth':
                if ( ! empty($_SERVER["HTTP_REFERER"]) && stristr($_SERVER["HTTP_REFERER"], $this->trigger_url) )
                    $callback = $_SERVER["HTTP_REFERER"];
                else
                    $callback = $this->trigger_url;
                $this->Praized->session($callback);
                break;
        }
    }
	
	/**
	 * Preserve the search query (q, l, t) when appropriate
	 *
	 * @param array $query Query string as associative array
	 * @return array
	 * @since 0.1
	 */
	function _preserveQuery($query = array()) {
        if ( ! is_array($query) ) 
	        $query = array();
	    
	    if ( isset($_GET['q']) && ! empty($_GET['q']) )
		    $query['q'] = urlencode($this->stripper($_GET['q']));

		if ( isset($_GET['l']) && ! empty($_GET['l']) )
		    $query['l'] = urlencode($this->stripper($_GET['l']));

        if ( ( isset($_GET['tag']) && ! empty($_GET['tag']) ) || ( isset($_GET['t']) && ! empty($_GET['t']) ) ) {
		    if ( isset($_GET['tag']) && ! empty($_GET['tag']) )
		        $query['t'] = urlencode($this->stripper($_GET['tag']));
		    else
		        $query['t'] = urlencode($this->stripper($_GET['t']));
	    }
	    
	    return $query;
	}
	
	/**
	 * Returns a fully qualified permalink url based on the sent fq url or path.
	 * 
	 * @param string $link Usually $this->tpt_merchant->permalink
	 * @param $type Link type (user, merchant, places)
	 * @return string
	 * @since 0.1
	 */
	function link_helper($link, $type = 'places') {
	    if ( ! strstr($link, '://') ) {
	        switch ( strtolower($type) ) {
	            case 'user':
	                $link = $this->trigger_url . '/users/' . ltrim($link, '/');
	                break;
	            case 'merchant':
	                $link = $this->trigger_url . '/merchants/' . ltrim($link, '/');
	                break;
	            default:
	                $link = $this->trigger_url . '/places/' . ltrim($link, '/');
	                break;
	        }
	        $query = $this->_preserveQuery();
	        if ( count($query) > 0 ) {
        		$qs = '?';
        		foreach ($query as $key => $val)
        			$qs .= urlencode($key).'='.urlencode(urldecode($val)).'&';
        		$link .= rtrim($qs, '&');
	        }
	    }
	    return $link;
	}
	
	/**
	 * Handles the /merchants*, and /places* API routes
	 * (from $this->_reroute())
	 *
	 * @param array $route_parts Indexed array of the elements making the current API route (as def in $this->_reroute())
	 * @since 0.1
	 */
	function _route_merchants($route_parts) {
 	    if ( ! isset($route_parts[1]) || empty($route_parts[1]) )
	        $route_parts[1]  = 'search';
	    
	    switch ($route_parts[1]) {
	        case 'search':
	            $this->_route_is_merchants = TRUE;
	            $this->_reset_404();
                $this->template('merchants');
	            break;
	        case 'tag':
	            $this->_route_is_merchants = TRUE;
	            $this->_route_is_tag = TRUE;
	            unset($_GET['q']); // Special case for tags, not preserving the ?q
	            $query = $this->_preserveQuery($_GET);
	            unset($query['tag']); // make sure we don't double-send
	            $query['t'] = $route_parts[2];
	            $this->tpt_has_merchants($query);
	            $this->_reset_404();
                $this->template('merchants');
	            break;
	        default:
	            /**
	             * Defaults to indiv merchant bc the url patterns
	             * are more difficult to match.
	             */
	            $this->_route_merchant($route_parts);
	            break;
	    }
	}
	
	/**
	 * Handles the /merchants/{merchant_pid}* and /places/{merchant_permalink}* API routes
	 * (from $this->_reroute(), through $htis->_route_merchants())
	 *
	 * @param array $route_parts  Indexed array of the elements making the current API route (as def in $this->_reroute())
	 * @since 0.1
	 */
	function _route_merchant($route_parts) {
	    switch ( $route_parts[0] ) {
            case 'places';
                $identifier = '/' . implode('/', $route_parts);
                if ( $identifier == '/' )
                    return; 
                break;
            case 'merchants':
                if ( empty($route_parts[1]) )
                    return;
                $identifier = $route_parts[1];
                break;
            default:
                return;
        }
        
        $mObj = $this->Praized->merchant();
        
        switch ($route_parts[2]) {
            case 'comments':
                if ( count($_POST) > 0 ) {
                    $return = $mObj->commentAdd($identifier, $_POST);
                    if ( isset($return->merchant->permalink) )
                        $redirect = $return->merchant->permalink;
                    else
                        $redirect = $this->link_helper($identifier, 'merchant');
                    wp_redirect($redirect);
                    exit;
                } else {
                    $template = 'merchant_comments';
                }
                break;
            case 'votes':
            case 'votes.json':
                if ( count($_POST) > 0 ) {
                    $this->_reset_404();
                    if ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHTTPRequest') {
                        // JSON output
                        $errorString = '{ "redirect_url" : null, "code" : 422, "errors" : { %s } }';
                        if ( ! $this->Praized->isAuthorized() ) {
                            echo '{ "redirect_url" : "' . $this->trigger_url . '/oauth", "code" : 401, "errors" : {} }';
                        } elseif($m = $mObj->voteAdd($identifier, $_POST)) {
        					if ( $m->vote->merchant->votes->count ) {
                                echo '{';
            					echo ' "pos_count" : "' . $m->vote->merchant->votes->pos_count . '",';
            					echo ' "neg_count" : "' . $m->vote->merchant->votes->neg_count . '",';
            					echo '  "count"    : "' . $m->vote->merchant->votes->count . '",';
            					echo '  "score"    : "' . $m->vote->merchant->votes->score . '"';
            					echo '}';
        					} else {
        					    echo sprintf($errorString, '"error" : "API succeeded but returned no merchant data."');
        					}
                        } else {
        					echo sprintf($errorString, '"error" : "Unknown Error"');
                        }
                    } else {
                        // Accessible vote form (ie: no JS)
                        if ( ! $this->Praized->isAuthorized() ) {
                            wp_redirect($this->trigger_url . '/oauth');
                        } else {
                            $return = $mObj->voteAdd($identifier, $_POST);
                            if ( isset($return->merchant->permalink) )
                                $redirect = $return->merchant->permalink;
                            else
                                $redirect = $this->link_helper($identifier, 'merchant');
                            wp_redirect($redirect);
                        }
                    }
                    exit;
                } else {
                    $template = 'merchant_votes';
                }
                break;
            case 'favorites':
                if ( isset($_POST['_action']) ) {
                    if ( $_POST['_action'] == 'delete' )
                        $return = $mObj->favoriteDelete($identifier, $_POST);
                    else
                        $return = $mObj->favoriteAdd($identifier, $_POST);
                    if ( isset($return->merchant->permalink) )
                        $redirect = $return->merchant->permalink;
                    else
                        $redirect = $this->link_helper($identifier, 'merchant');
                    wp_redirect($redirect);
                    exit;
                } else {
                    $template = 'merchant_favorites';
                }
                break;
            case 'taggings':
                if ( count($_POST) > 0 ) {
                    $return = $mObj->tagAdd($identifier, $_POST);
                    if ( isset($return->merchant->permalink) )
                        $redirect = $return->merchant->permalink;
                    else
                        $redirect = $this->link_helper($identifier, 'merchant');
                    wp_redirect($redirect);
                    exit;
                } else {
                    $template = 'merchant_taggings';
                }
                break;
            default:
                $template = 'merchant';
                break;
        }
        
        if ( $merchant_object = $mObj->get($identifier, $_GET) ) {
            if ( is_object($merchant_object) ) { 
                $this->_route_is_merchant = TRUE;
                $this->tpt_merchant = ( isset($merchant_object->merchant) ) ? $merchant_object->merchant : FALSE;
                $this->_tpt_environment($merchant_object);
	            $this->_reset_404();
                $this->template($template);
            }
        }
	}
	
	/**
	 * Handles the /users* API routes
	 * (from $this->_reroute())
	 *
	 * @param array $route_parts Indexed array of the elements making the current API route (as def in $this->_reroute())
	 * @since 0.1
	 */
	function _route_user($route_parts) {
        if ( $route_parts[0] != 'users' || empty($route_parts[1]) )
            return;
        
        $identifier = $route_parts[1];
        
        $uObj = $this->Praized->user();
        $mObj = $this->Praized->merchant();
        
        switch ($route_parts[2]) {
            case 'comments':
                $template = 'user_comments';
                break;
            case 'votes':
                $template = 'user_votes';
                break;
            case 'favorites':
                if ( isset($_POST['_action']) && isset($_POST['pid']) && ! empty($_POST['pid']) ) {
                    if ( $_POST['_action'] == 'delete' )
                        $mObj->favoriteDelete($_POST['pid'], $_POST);
                    else
                        $mObj->favoriteAdd($_POST['pid'], $_POST);
                    wp_redirect($this->link_helper($this->Praized->currentUserLogin(), 'user'));
                    exit;
                } else {
                    $template = 'user_favorites';
                }
                break;
            case 'friends':
                if ( isset($_POST['_action']) ) {
                    if ( $_POST['_action'] == 'delete' )
                        $uObj->friendDelete($identifier, $_POST);
                    else
                        $uObj->friendAdd($identifier, $_POST);
                    wp_redirect($this->link_helper($this->Praized->currentUserLogin(), 'user'));
                    exit;
                } else {
                    $template = 'user_friends';
                }
                break;
            default:
                $template = 'user';
                break;
        }

        if ( $user_object = $uObj->get($identifier, $_GET) ) {
            if ( is_object($user_object) ) {
                $this->_route_is_user = TRUE;
                $this->tpt_user = ( isset($user_object->user) ) ? $user_object->user : FALSE;
                $this->_tpt_environment($user_object);
	            $this->_reset_404();
                $this->template($template);
            }
        }
	}
	
	/**
	 * Sets the template environment with meta data such as the
	 * community's info, pagination, etc.
	 *
	 * @param object $target Praized object as returned by the Praized PHP lib.
	 * @return boolean
	 * @since 0.1
	 */
	function _tpt_environment($target) {
	    if ( ! isset($target->community) )
	        return FALSE;
	    $this->tpt_community  = ( isset($target->community) && is_object($target->community) )     ? $target->community  : FALSE;
	    $this->tpt_pagination = ( isset($this->tpt_pagination) && is_object($target->pagination) ) ? $target->pagination : FALSE;
	    return TRUE;
	}
	
	/**
	 * Includes the appropriate blogger-defined (theme) or default template
	 *
	 * @param string $template Template id (EG: merchants for user-defined praized_merchants.php or default merchants.php)
	 * @param boolean Are we dealing with a template fragment instead of a full template
	 * @since 0.1
	 */
    function template($template, $fragment = false){
	    if ( ! is_object($this->Praized) )
	        $this->_load_praized();
        
        if ( empty($template) || $template == '_' )
	        return FALSE;
	    
	    $user_tpt    = TEMPLATEPATH . '/' . $this->_plugin_name . '/' . $template . '.php';
	    $default_tpt = $this->_includes . '/php/templates/' .  $template . '.php';
	    
	    if ( file_exists($user_tpt) )
	        require($user_tpt);
	    elseif ( file_exists($default_tpt) )
	        require($default_tpt);
	    else
	        return FALSE;
	    
	    if ( ! $fragment )
	        exit;
	}
	
    /**
     * Includes a user-defined or default template fragment (files starting with _ in template dir)
     *
     * @param string $fragment (EG: merchants for templates/_merchants.php or merchant/hcard for templates/merchant/_hcard.php)
	 * @since 0.1
     */
	function fragment($fragment) {
        if ( strstr($fragment, '/') )
            $template = preg_replace('|(.*)/([^/]*)$|', '\1/_\2', $fragment);
        else 
            $template = '_' . $fragment;
        $this->template($template, true);
	}
	
	/**
	 * Template helper: returns and optionaly echos the desired API object attribute.
	 * Used as helper in the enabling of the template-level functions such as pzdc_merchant_name()
	 *
	 * @param string $parent Parent object id (EG: "merchant" for $this->tpt_merchant)
	 * @param string $attribute Parent object attribute chain (EG: "location->city->name" for $this->tpt_merchant->location->city->name)
	 * @param boolean $echo Should the output be written to STDOUT or simply returned
	 * @param string Optional endpoint (merchant pid/user login) identifier to be used instead of the $this->tpt_* holders
	 * @return mixed FALSE on error, usually a string on success, but depends on the requested attribute
	 * @see praized-community.php
	 * @since 0.1
	 */
	function tpt_attribute_helper($parent, $attribute, $echo = TRUE, $identifier = FALSE) {
        if ( ! empty($identifier) ) {
    	    switch ( $parent ) {
                case 'merchant':
                    $this->tpt_has_merchant($identifier);
                    break;
                case 'user':
                    $this->tpt_has_user($identifier);
                    break;
                case 'friend':
                    $this->tpt_has_friend($identifier);
                    break;
    	    }
        }
        
	    if ( ! preg_match('/^tpt_/', $parent) )
            $parent = 'tpt_' . $parent; 
	    
        if ( ! isset($this->$parent) )
	        return FALSE;
	        
	    // @note Cleaning up input in light of upcoming eval()
	    if ( ! preg_match('/^([a-zA-Z0-9_>-]*)?/', $attribute, $matches) || ! isset($matches[1]) )
	        return FALSE;

	    $ref = '$this->' . $parent . '->' . $matches[1];
	    eval('$out = ( isset('.$ref.') ) ? '.$ref.' : FALSE;');
        
	    switch (strtolower(trim($out))) {
	        case 'true':
	        	$out = TRUE;
	        	break;
	        case 'false':
	        	$out = FALSE;
	        	break;
	    }
        
	    if ( $echo ) 
            echo $out;

        return $out;
	}
	
	/**
	 * Template function: Tests if there are > 0 items in $this->tpt_merchants
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return mixed boolean FALSE or integer Merchant count
	 * @since 0.1
	 */
	function tpt_has_merchants($query = FALSE) {
        if ( ! $this->tpt_merchants ) {
            if ( ! is_array($query) )
                $query = $_GET;
            $mObj = $this->Praized->merchants();
            $response = $mObj->get($query);
            if ( is_object($response) && is_array($response->merchants) ) {
                $this->tpt_merchants = $response->merchants;
                $this->_tpt_environment($response);
            }
        }
	    if ( is_array($this->tpt_merchants) )
            return count($this->tpt_merchants);
        else
            return FALSE;
	}
	
	/**
	 * Template function: Praized equivalent of the WP "the_loop" for the current merchants list, usually used in while loop
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean and sets $this->tpt_merchant if appropriate
	 * @since 0.1
	 */
	function tpt_merchants_loop($query = FALSE) {
        $this->tpt_has_next_merchant = FALSE;
        if ( $this->tpt_has_merchants($query) ) {
            $merchants = $this->tpt_merchants;
	        if ( isset($merchants[$this->tpt_merchant_index]) ) {
	            $merchant = $merchants[$this->tpt_merchant_index];
	            $this->tpt_merchant = $merchant;
	            $this->tpt_tags = FALSE;
	            $this->tpt_tag_index = 0;
	            $this->tpt_tag = FALSE;
                if ( isset($merchants[$this->tpt_merchant_index + 1]) )
                    $this->tpt_has_next_merchant = TRUE;
	            $this->tpt_merchant_index++;
    	        return TRUE;
            } else {
                return FALSE;
            }
	    } else {
	        return FALSE;
	    }
	}
	
	/**
	 * Template function: Tests if there is a valid $this->tpt_merchant
	 *
	 * @param string Optional merchant pid identifier to be used instead of the $this->tpt_* holders
	 * @return boolean
	 * @since 0.1
	 */
	function tpt_has_merchant($identifier = FALSE) {
	    if ( ! $this->tpt_merchant ) {
	        if ( ! empty($identifier) ) {
	            $mObj = $this->Praized->merchant();
                $response = $mObj->get($identifier);
                if ( is_object($response) && isset($response->merchant) ) {
                    $this->tpt_merchant = ( is_object($response->merchant) && isset($response->merchant->pid) )
                        ? $response->merchant
                        : FALSE;
                    if ( ! $this->tpt_community )
                        $this->_tpt_environment($response);
                }
            }
	    }
        if ( is_object($this->tpt_merchant) && isset($this->tpt_merchant->pid) )
            return TRUE;
	    else
            return FALSE;
	}
	
	/**
	 * Template function: Tests if $this->tpt_tags truly has a tag list
	 *
	 * @return boolean
	 * @since 0.1
	 */
	function tpt_has_tags() {
        if ( ! $this->tpt_tags ) {
            $this->tpt_tags = ( isset($this->tpt_merchant->tags) && is_array($this->tpt_merchant->tags) )
                ? $this->tpt_merchant->tags
                : FALSE;
        }
        if ( is_array($this->tpt_tags) )
            return count($this->tpt_tags);
        else
            return FALSE;
	}
	
	/**
	 * Template function: Praized equivalent of the WP "the_loop" for the current merchant's tag list, usually used in while loop
	 *
	 * @return boolean and sets $this->tpt_merchant if appropriate
	 * @since 0.1
	 */
	function tpt_tags_loop() {
        $this->tpt_has_next_tag = FALSE;
	    if ( $this->tpt_has_tags() ) {
            $tag_list = $this->tpt_tags;
	        if ( isset($tag_list[$this->tpt_tag_index]) ) {
	            $tag = $tag_list[$this->tpt_tag_index];
	            $this->tpt_tag = $tag;
                if ( isset($tag_list[$this->tpt_tag_index + 1]) )
                    $this->tpt_has_next_tag = TRUE;
	            $this->tpt_tag_index++;
	            return TRUE;
            } else {
                return FALSE;
            }
	    } else {
	        return FALSE;
	    }
	}
	
	/**
	 * Template function: Tests if $this->tpt_splinks truly has a sponsored
	 * links list.  Will only work in the right views (ie: individual merchant
	 * show, not listings)
	 *
	 * @return boolean
	 * @since 0.1
	 */
	function tpt_has_splinks() {
        if ( ! $this->_route_is_merchant )
            return FALSE;
	    if ( ! $this->tpt_splinks ) {
            if ( isset($this->tpt_merchant->sponsored_links) && is_array($this->tpt_merchant->sponsored_links) ) {
                /**
                 * Mandatory extra loop to ensure we respect the sponsoredlink
                 * node's own order node to sort the list.
                 */
                $links = array();
                foreach ( $this->tpt_merchant->sponsored_links as $link) {
                   if ( is_object($link) && isset($link->order) )
                       $links[$link->order] = $link; 
                }
                $this->tpt_splinks = ( count($links) > 0 ) ? $links : FALSE;
            }
        }
        if ( is_array($this->tpt_splinks) )
            return count($this->tpt_splinks);
        else
            return FALSE;
	}
	
	/**
	 * Template function: Praized equivalent of the WP "the_loop" for the
	 * current merchant's sponsored link list, usually used in while loop.
	 * Will only work in the right views (ie: individual merchant show,
	 * not listings).
	 *
	 * @return boolean and sets $this->tpt_merchant if appropriate
	 * @since 0.1
	 */
	function tpt_splinks_loop() {
        $this->tpt_has_next_splink = FALSE;
	    if ( $this->tpt_has_splinks() ) {
            $splink_list = $this->tpt_splinks;
	        if ( isset($splink_list[$this->tpt_splink_index]) ) {
	            $splink = $splink_list[$this->tpt_splink_index];
	            $this->tpt_splink = $splink;
                if ( isset($splink_list[$this->tpt_splink_index + 1]) )
                    $this->tpt_has_next_splink = TRUE;
	            $this->tpt_splink_index++;
	            return TRUE;
            } else {
                return FALSE;
            }
	    } else {
	        return FALSE;
	    }
	}
	
	/**
	 * Template function: Tests if $this->tpt_comments truly has a comment list, or sets it.
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean
	 * @since 0.1
	 */
	function tpt_has_comments($query = FALSE) {
        if ( ! $this->tpt_comments ) {
            if ( ! is_array($query) )
                $query = $_GET;
            $mObj = $this->Praized->merchant();
            $uObj = $this->Praized->user();
            if ( $this->_route_is_merchant ) {
                $response = $mObj->comments($this->tpt_merchant->pid, $query); 
            } elseif ( $this->_route_is_user ) {
                $response = $uObj->comments($this->tpt_user->login, $query); 
            } else {
                $response = FALSE;
            }
            if ( is_object($response) ) {
                $this->tpt_comments = ( is_object($response) && is_array($response->comments) )
                    ? $response->comments
                    : FALSE;
                $this->_tpt_environment($response);
            }
        }
	    if ( is_array($this->tpt_comments) )
            return count($this->tpt_comments);
	    else
	        return FALSE;
	}
	
	/**
	 * Template function: Praized equivalent of the WP "the_loop" for the current merchant's comments list, usually used in while loop
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean and sets $this->tpt_merchant if appropriate
	 * @since 0.1
	 */
	function tpt_comments_loop($query = FALSE) {
        $this->tpt_has_next_comment = FALSE;
	    if ( $this->tpt_has_comments($query) ) {
            $comment_list = $this->tpt_comments;
	        if ( isset($comment_list[$this->tpt_comment_index]) ) {
	            $comment = $comment_list[$this->tpt_comment_index];
	            $this->tpt_comment = $comment;
	            if ( isset($comment->merchant) && $this->_route_is_user )
	                $this->tpt_merchant = $comment->merchant;
	            if ( isset($comment->user) && $this->_route_is_merchant )
	                $this->tpt_user = $comment->user;
                if ( isset($comment_list[$this->tpt_comment_index + 1]) )
                    $this->tpt_has_next_comment = TRUE;
	            $this->tpt_comment_index++;
	            return TRUE;
            } else {
                return FALSE;
            }
	    } else {
	        return FALSE;
	    }
	}
	
	/**
	 * Template function: Tests if $this->tpt_favorites truly has a favorite list, or sets it.
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean
	 * @since 0.1
	 */
	function tpt_has_favorites($query = FALSE) {
        if ( ! $this->tpt_favorites ) {
            if ( ! is_array($query) )
                $query = $_GET;
            $mObj = $this->Praized->merchant();
            $uObj = $this->Praized->user();
            if ( $this->_route_is_merchant ) {
                $response = $mObj->favorites($this->tpt_merchant->pid, $query);
            } elseif ( $this->_route_is_user ) {
                $response = $uObj->favorites($this->tpt_user->login, $query); 
            } else {
                $response = FALSE;
            }
            if ( is_object($response) ) {
                if ( isset($response->users) && is_array($response->users) )
                    $this->tpt_favorites = $response->users;
                elseif ( isset($response->merchants) && is_array($response->merchants) )
                    $this->tpt_favorites = $response->merchants;
                $this->_tpt_environment($response);
            }
        }
	    if ( is_array($this->tpt_favorites) )
            return count($this->tpt_favorites);
	    else
	        return FALSE;
	}
	
	/**
	 * Template function: Praized equivalent of the WP "the_loop" for the current merchant's favorites list, usually used in while loop
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean and sets $this->tpt_merchant if appropriate
	 * @since 0.1
	 */
	function tpt_favorites_loop($query = FALSE) {
        $this->tpt_has_next_favorite = FALSE;
	    if ( $this->tpt_has_favorites($query) ) {
            $favorite_list = $this->tpt_favorites;
	        if ( isset($favorite_list[$this->tpt_favorite_index]) ) {
	            $favorite = $favorite_list[$this->tpt_favorite_index];
	            if ( $this->_route_is_merchant )
	                $this->tpt_user = $favorite;
	            if ( $this->_route_is_user )
	                $this->tpt_merchant = $favorite;
	            if ( isset($favorite_list[$this->tpt_favorite_index + 1]) )
                    $this->tpt_has_next_favorite = TRUE;
	            $this->tpt_favorite_index++;
	            return TRUE;
            } else {
                return FALSE;
            }
	    } else {
	        return FALSE;
	    }
	}
	
	/**
	 * Template function: Tests if $this->tpt_votes truly has a vote list, or sets it.
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean
	 * @since 0.1
	 */
	function tpt_has_votes($query = FALSE) {
        if ( ! $this->tpt_votes ) {
            if ( ! is_array($query) )
                $query = $_GET;
            $mObj = $this->Praized->merchant();
            $uObj = $this->Praized->user();
            if ( $this->_route_is_merchant ) {
                $response = $mObj->votes($this->tpt_merchant->pid, $query); 
            } elseif ( $this->_route_is_user ) {
                $response = $uObj->votes($this->tpt_user->login, $query); 
            } else {
                $response = FALSE;
            }
            if ( is_object($response) ) {
                $this->tpt_votes = ( is_object($response) && is_array($response->votes) )
                    ? $response->votes
                    : FALSE;
                $this->_tpt_environment($response);
            }
        }
	    if ( is_array($this->tpt_votes) )
            return count($this->tpt_votes);
	    else
	        return FALSE;
	}
	
	/**
	 * Template function: Praized equivalent of the WP "the_loop" for the current merchant's votes list, usually used in while loop
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean and sets $this->tpt_merchant if appropriate
	 * @since 0.1
	 */
	function tpt_votes_loop($query = FALSE) {
        $this->tpt_has_next_vote = FALSE;
	    if ( $this->tpt_has_votes($query) ) {
            $vote_list = $this->tpt_votes;
	        if ( isset($vote_list[$this->tpt_vote_index]) ) {
	            $vote = $vote_list[$this->tpt_vote_index];
	            $this->tpt_vote = $vote;
	            if ( isset($vote->merchant) && $this->_route_is_user )
	                $this->tpt_merchant = $vote->merchant;
	            if ( isset($vote->user) && $this->_route_is_merchant )
	                $this->tpt_user = $vote->user;
	            if ( isset($vote_list[$this->tpt_vote_index + 1]) )
                    $this->tpt_has_next_vote = TRUE;
	            $this->tpt_vote_index++;
	            return TRUE;
            } else {
                return FALSE;
            }
	    } else {
	        return FALSE;
	    }
	}
	
	/**
	 * Template function: Tests if there is a valid $this->tpt_user
	 *
	 * @param string Optional user login identifier to be used instead of the $this->tpt_* holders
	 * @return boolean
	 * @since 0.1
	 */
	function tpt_has_user($identifier = FALSE) {
	    if ( ! $this->tpt_user ) {
	        if ( ! empty($identifier) ) {
                $uObj = $this->Praized->user();
	            $response = $uObj->get($identifier);
                if ( is_object($response) && isset($response->user) ) {
                    $this->tpt_user = ( is_object($response->user) && isset($response->user->login) )
                        ? $response->user
                        : FALSE;
                    if ( ! $this->tpt_community )
                        $this->_tpt_environment($response);
                }
            }
	    }
	    if ( is_object($this->tpt_user) && isset($this->tpt_user->login) )
            return TRUE;
        else
            return FALSE;
	}
	
	/**
	 * Template function: Tests if $this->tpt_friends truly has a friend list, or sets it.
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean
	 * @since 0.1
	 */
	function tpt_has_friends($query = FALSE) {
        if ( ! $this->tpt_friends ) {
            if ( ! is_array($query) )
                $query = $_GET;
            if ( $this->_route_is_user ) {
                $uObj = $this->Praized->user();
                $response = $uObj->friends($this->tpt_user->login, $query); 
            } else {
                $response = FALSE;
            }
            if ( is_object($response) ) {
                $this->tpt_friends = ( is_object($response) && is_array($response->users) )
                    ? $response->users
                    : FALSE;
                $this->_tpt_environment($response);
            }
        }
	    if ( is_array($this->tpt_friends) )
            return count($this->tpt_friends);
	    else
	        return FALSE;
	}
	
	/**
	 * Template function: Praized equivalent of the WP "the_loop" for the current user's friends list, usually used in while loop
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean and sets $this->tpt_merchant if appropriate
	 * @since 0.1
	 */
	function tpt_friends_loop($query = FALSE) {
        $this->tpt_has_next_friend = FALSE;
	    if ( $this->tpt_has_friends($query) ) {
            $friend_list = $this->tpt_friends;
	        if ( isset($friend_list[$this->tpt_friend_index]) ) {
	            $friend = $friend_list[$this->tpt_friend_index];
	            $this->tpt_friend = $friend;
	            if ( isset($friend_list[$this->tpt_friend_index + 1]) )
                    $this->tpt_has_next_friend = TRUE;
	            $this->tpt_friend_index++;
	            return TRUE;
            } else {
                return FALSE;
            }
	    } else {
	        return FALSE;
	    }
	}
	
	/**
	 * Template function: Tests if there is a valid $this->tpt_friend
	 *
	 * @param string Optional merchant pid identifier to be used instead of the $this->tpt_* holders
	 * @return boolean
	 * @since 0.1
	 */
	function tpt_has_friend($identifier = FALSE) {
	    if ( ! $this->tpt_friend ) {
	        if ( ! empty($identifier) ) {
                $uObj = $this->Praized->user();
	            $response = $uObj->get($identifier);
                if ( is_object($response) && isset($response->user) ) {
                    $this->tpt_friend = ( is_object($response->user) && isset($response->user->login) )
                        ? $response->user
                        : FALSE;
                    if ( ! $this->tpt_community )
                        $this->_tpt_environment($response);
                }
            }
	    }
	    if ( is_object($this->tpt_friend) && isset($this->tpt_friend->login) )
            return TRUE;
        else
            return FALSE;
	}
	
	/**
	 * Template function: Outputs a standard UL-based pagination toolbar from the currently instantiated $this->tpt_pagination
	 *
	 * @param array $options Pagination option overwrites, see PraizedCore::paginate
	 * @param boolean $echo
	 * @return mixed Boolean or String
	 * @since 0.1
	 */
	function tpt_paginate($options = array(), $echo = TRUE) {
		if ( ! isset($this->tpt_pagination) || ! is_object($this->tpt_pagination) )
		    return FALSE;
		
	    if ( ! isset($options['prev_label']) || empty($options['prev_label']) )
	        $options['prev_label'] = $this->__('Previous');
		
	    if ( ! isset($options['next_label']) || empty($options['next_label']) )
	        $options['next_label'] = $this->__('Next');
		    
		$xhtml = $this->Praized->paginate($this->tpt_pagination, $options);
	    
		if ( ! empty($xhtml) ) { 
    		if ( $echo )
    		    echo $xhtml;
		    return $xhtml;
		} else {
		    return FALSE;
		}
	}

	/**
	 * Google map integration
	 * @see http://code.google.com/apis/maps/documentation/staticmaps/
	 *
	 * @param float $latitude
	 * @param float $longitude
	 * @param array $raw_params
	 * @param boolean $echo
	 * @return string
	 * @since 0.1
	 */
	function tpt_map($latitude, $longitude, $raw_params = array(), $caption = '', $echo = TRUE) {
	    if ( ! isset($this->_config['map_api_key']) || empty($this->_config['map_api_key']) || empty($latitude) || empty($longitude) )
    	    return false;
    	
    	if ( ! isset($raw_params['size']) && $this->_config['map_width'] != '' && $this->_config['map_height'] != '' )
    	    $raw_params['size'] = intval($this->_config['map_width']) . 'x' . intval($this->_config['map_height']);
    	
    	if ( ! isset($raw_params['zoom']) && $this->_config['map_zoom_level'] != '' )
    	    $raw_params['zoom'] = intval($this->_config['map_zoom_level']);
    	
    	$out = $this->Praized->googleMap($this->_config['map_api_key'], $latitude, $longitude, $raw_params, $caption);
    	
    	if ( $echo )
    	    echo $out;
    	
    	return $out;
	}

	/**
	 * Looks for the stats image url in the current merchant's data
	 * and echoes/returns an image tag or NULL.  Will only work in
	 * the right views (ie: individual merchant show, not listings)
	 *
	 * @param boolean $echo
	 * @param string $identifier Optional merchant PID, defauts to $this->tpt_merchant
	 * @return mixed NULL or String
	 * @since 0.1
	 */
	function tpt_stats_img($echo = TRUE, $identifier = FALSE) {
	    if ( ! $this->_route_is_merchant || ! $this->tpt_has_merchant($identifier) )
    	    return;
    	
    	$mObj = $this->Praized->merchant();
    	$out = $mObj->statsImage($this->tpt_merchant);
    	
    	if ( $echo )
    	    echo $out;
    	
    	return $out;
	}

	/**
	 * Praized.com merchant sharing integration
	 *
	 * @param boolean $echo
	 * @param string $identifier Optional merchant PID, defauts to $this->tpt_merchant
	 * @return mixed NULL or String
	 * @since 0.1
	 */
	function tpt_share($echo = TRUE, $identifier = FALSE) {
	    $mObj = $this->Praized->merchant();
	    $out = $mObj->share($this->tpt_merchant->pid);
    	
    	if ( $echo )
    	    echo $out;
    	
    	return $out;
	}
	
	/**
	 * Widget: Search form
	 * 
	 * @param array $args WP standard
	 * @since 0.1
	 */
	 function widget_search_form($args = array()) {
        extract($args);
	    
        $widget_id = $this->wdgt_search_form_key;
        $config    = $this->_get_wp_option($widget_id);
        
        echo $before_widget; // WP STANDARD	    
        echo '<li id="'.$widget_id.'" class="widget '.$widget_id.'">';
        	    
	    $title = ( $config['title'] != '' ) ? $config['title'] : $this->__('Praized: Search');
	    
	    echo $before_title;  // WP STANDARD
	    echo '<h2>'.$title.'</h2>';
	    echo $after_title;   // WP STANDARD
        
        $this->template('_search_form', true);
        
        echo "\n</li>\n";
        echo $after_widget;  // WP STANDARD
	 }
	
	/**
	 * Widget: Authorization (oauth) nav
	 * 
	 * @param array $args WP standard
	 * @since 0.1
	 */
	 function widget_auth_nav($args = array()) {
        extract($args);
	    
        $widget_id = $this->wdgt_auth_nav_key;
        $config    = $this->_get_wp_option($widget_id);
        
        echo $before_widget; // WP STANDARD	    
        echo '<li id="'.$widget_id.'" class="widget '.$widget_id.'">';
        	    
	    $title = ( $config['title'] != '' ) ? $config['title'] : $this->__('Praized: Session');
	    
	    echo $before_title;  // WP STANDARD
	    echo '<h2>'.$title.'</h2>';
	    echo $after_title;   // WP STANDARD
        
        $this->template('_auth_nav', true);
        
        echo "\n</li>\n";
        echo $after_widget;  // WP STANDARD
	 }
}
?>