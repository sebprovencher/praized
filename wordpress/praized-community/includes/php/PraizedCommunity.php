<?php
/**
 * Praized Community
 * 
 * @version 1.6
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
     * PraizedTools version
     * @var string
     * @since 1.0.4
     */
    var $version = '1.6';
    
	/**
     * Valid Praized Community URL routes
     * @var array
     * @since 0.1
     */
    var $_routes = array(
        'merchants',
        'places',
        'users',
        'oauth',
        'actions',
        'questions',
    	'answers'
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
     * Keeps track of if the current page is an action listing route
     * @var boolean
     * @since 1.5
     */
    var $_route_is_actions = FALSE;
    
    /**
     * Keeps track of if the current page is a questions listing route
     * @var boolean
     * @since 1.6
     */
    var $_route_is_questions = FALSE;
    
    /**
     * Keeps track of if the current page is a single question route
     * @var boolean
     * @since 1.6
     */
    var $_route_is_question = FALSE;
    
    /**
     * Keeps track of if the current page is a single answer route
     * @var boolean
     * @since 1.6
     */
    var $_route_is_answer = FALSE;
    
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
     * API object holder: Actions data (collection)
     * @var mixed boolean FALSE or object
     * @since 1.5
     */
    var $tpt_actions = FALSE;
    
    /**
     * Keeps track of which action we're dealing with in $this->tpt_actions_loop()
     * @var integer
     * @since 1.5
     */
    var $tpt_action_index = 0;
    
    /**
     * API object holder: Action data (single)
     * @var mixed boolean FALSE or object
     * @since 1.5
     */
    var $tpt_action = FALSE;
    
    /**
     * Keeps track of if there is another action to be processed in $this->tpt_actions_loop()
     * @var boolean
     * @since 1.5
     */
    var $tpt_has_next_action = FALSE;
    
    /**
     * API object holder: Questions data (collection)
     * @var mixed boolean FALSE or object
     * @since 1.6
     */
    var $tpt_questions = FALSE;
    
    /**
     * Keeps track of which question we're dealing with in $this->tpt_questions_loop()
     * @var integer
     * @since 1.6
     */
    var $tpt_question_index = 0;
    
    /**
     * API object holder: Question data (single)
     * @var mixed boolean FALSE or object
     * @since 1.6
     */
    var $tpt_question = FALSE;
    
    /**
     * Keeps track of if there is another question to be processed in $this->tpt_questions_loop()
     * @var boolean
     * @since 1.6
     */
    var $tpt_has_next_question = FALSE;
    
    /**
     * API object holder: Answers data (collection)
     * @var mixed boolean FALSE or object
     * @since 1.6
     */
    var $tpt_answers = FALSE;
    
    /**
     * Keeps track of which answer we're dealing with in $this->tpt_answers_loop()
     * @var integer
     * @since 1.6
     */
    var $tpt_answer_index = 0;
    
    /**
     * API object holder: Answer data (single)
     * @var mixed boolean FALSE or object
     * @since 1.6
     */
    var $tpt_answer = FALSE;
    
    /**
     * Keeps track of if there is another answer to be processed in $this->tpt_answers_loop()
     * @var boolean
     * @since 1.6
     */
    var $tpt_has_next_answer = FALSE;
    
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

		if ( ! isset($this->_config['default_view']) )
		    $this->_config['default_view'] = 'places';

		if ( ! isset($this->_config['default_query']) )
		    $this->_config['default_query'] = '';

		if ( ! isset($this->_config['default_location']) )
		    $this->_config['default_location'] = '';
		    
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
	        if ( isset($_GET['q']) && empty($_GET['q']) && isset($_GET['l']) && empty($_GET['l']) ) {
                // We still need users to be able to overwrite the defaults and submit an
                // "Everything + Everywhere" query, but only when the form is truly submitted.
	            $query    = $this->__('Everything');
                $location = $this->__('Everywhere');
	        } else {
    	        $query    = ( ! empty($_GET['q']) )
    	                  ? $this->stripper($_GET['q'])
    	                  : ( ( ! empty($this->_config['default_query']) && empty($_GET['l']) )
    	                      ? $this->_config['default_query']
    	                      : $this->__('Everything') );
    	        
    	        $location = ( ! empty($_GET['l']) )
    	                  ? $this->stripper($_GET['l'])
    	                  : ( ( ! empty($this->_config['default_location']) && empty($_GET['q']) )
    	                      ? $this->_config['default_location']
    	                      : $this->__('Everywhere') );
	        }
	        
	        if (  ! empty($_GET['t']) || ! empty($_GET['tag']) || ! empty($_GET['category']) ) {
	            $tag = ( ! empty($_GET['t']) )
	                 ? $this->stripper($_GET['t'])
	                 : ( ! empty($_GET['tag']) )
	                     ? $this->stripper($_GET['tag'])
	                     : $this->stripper($_GET['category']);
	        } elseif ( $this->_route_is_tag ) {
	            preg_match('/\/(tag|category)\/([^\/]*)/', $this->_script_uri, $matches);
	            if ( ! empty($matches[2]) )
	                 $tag = htmlspecialchars(urldecode($matches[2]));
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
	        
	        $full_name  = $first_name . ( ($last_name) ? ' ' : '' ) . $last_name;
	        
	        $header     = ( $full_name ) ? "{$full_name} ({$login})" : $login;
	    } elseif ( $this->_route_is_actions && $this->tpt_has_actions() ) {
	        $header     = $this->__('The Local Buzz');
	    } elseif ( $this->_route_is_questions && $this->tpt_has_questions() ) {
	        $header     = $this->__('Local Questions &amp; Answers');
	    } elseif ( $this->_route_is_question && $this->tpt_has_question() ) {
	        $answer_count = (int) $this->tpt_attribute_helper('question', 'answer_count', FALSE);
	    	$answer_count .= ( $answer_count < 2 ) ? ' ' . $this->__('answer') : ' ' . $this->__('answers');
	    	$header     = $this->__('Question:') . ' ' . $this->tpt_attribute_helper('question', 'content', FALSE) . ' (' . $answer_count . ')';
	    } elseif ( $this->_route_is_answer && $this->tpt_has_answer() ) {
	        $header     = $this->__('Answer:') . ' ' . $this->tpt_attribute_helper('answer', 'content', FALSE);
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
	    if ( $css = $this->_css() )
	        echo $css;
	    printf(
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
	    printf(
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
	    if ( empty($route) || ($route == '/') ) {
	        $route = ( empty($this->_config['default_view']) || ! in_array($this->_config['default_view'], $this->_routes) )
	               ? '/places'
	               : '/' . $this->_config['default_view'];
	    }

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
                if ( ! empty($_GET['return_to']) && stristr(rawurldecode($_GET['return_to']), $this->trigger_url) )
                	$callback = $_GET['return_to'];
            	elseif ( ! empty($_SERVER["HTTP_REFERER"]) && stristr($_SERVER["HTTP_REFERER"], $this->trigger_url) )
                    $callback = $_SERVER["HTTP_REFERER"];
                else
                    $callback = $this->trigger_url;
                $this->Praized->session($callback);
                break;
            case 'actions':
                $this->_route_actions($parts);
                break;
            case 'questions':
                $this->_route_questions($parts);
                break;
            case 'answers':
                $this->_route_answer($parts);
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
	function _preserve_query($query = array()) {
        if ( ! is_array($query) ) 
	        $query = array();
	    
	    if ( isset($_GET['q']) && ! empty($_GET['q']) )
		    $query['q'] = urlencode($this->stripper($_GET['q']));

		if ( isset($_GET['l']) && ! empty($_GET['l']) )
		    $query['l'] = urlencode($this->stripper($_GET['l']));

        if ( isset($_GET['tag']) && ! empty($_GET['tag']) ) {
		    $query['t'] = urlencode($this->stripper($_GET['tag']));
	    } elseif ( isset($_GET['category']) && ! empty($_GET['category']) ) {
	        $query['t'] = urlencode($this->stripper($_GET['category']));
	    } elseif ( isset($_GET['t']) && ! empty($_GET['t']) ) {
	        $query['t'] = urlencode($this->stripper($_GET['t']));
	    }
	    
	    return $query;
	}
	
	/**
	 * Standard cookie name to be used with $this->_preserve_post()
	 * 
	 * @return string
	 * @since 1.6
	 */
	function _preserve_post_cookie_name() {
		return 'praized_'.$this->_config['community'].'_post_holder';
	}
	
	/**
	 * Tries to conserve the _POST vars in a cookie to be retrieved later (used when eg: posting questions or answers while not signed in).
	 * 
	 * @param boolean $preserve true to save the cookie, false to delete it
	 * @return void
	 * @since 1.6
	 */
	function _preserve_post($preserve = TRUE) {
		if ( ! headers_sent() ) {
			$name = $this->_preserve_post_cookie_name();
			if ( $preserve )
				setcookie($name, serialize($_POST), 0, '/');
			else
				setcookie($name, '', time() - 3600 );
		} else {
			if ( $preserve )
				$_COOKIE[$name] = serialize($_POST);
			else
				unset($_COOKIE[$name]);
		}
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
	            case 'question':
	                $link = $this->trigger_url . '/questions/' . ltrim($link, '/');
	                break;
	            case 'answer':
	                $link = $this->trigger_url . '/answers/' . ltrim($link, '/');
	                break;
	            default:
	                $link = $this->trigger_url . '/places/' . ltrim($link, '/');
	                break;
	        }
	        $query = $this->_preserve_query();
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
	        case 'category':
	            $this->_route_is_merchants = TRUE;
	            $this->_route_is_tag = TRUE;
	            unset($_GET['q']); // Special case for tags, not preserving the ?q
	            $query = $this->_preserve_query($_GET);
	            unset($query['tag']); // make sure we don't double-send
	            unset($query['category']); // make sure we don't double-send
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
	 * (from $this->_reroute(), through $this->_route_merchants())
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
        
        // handles posting votes while not logged in to the praized network
		if ( ( $identifier == $route_parts[1] ) && $this->Praized->isAuthorized() && isset($_GET['oauth_token']) && isset($_COOKIE[$this->_preserve_post_cookie_name()]) ) {
			$route_parts[2] = 'votes';
        	$_POST = unserialize(stripslashes($_COOKIE[$this->_preserve_post_cookie_name()]));
			$this->_preserve_post(FALSE);
		} elseif ( isset($_COOKIE[$this->_preserve_post_cookie_name()]) ) {
			$this->_preserve_post(FALSE);
		}
        
        switch ($route_parts[2]) {
            case 'comments':
                if ( count($_POST) > 0 ) {
                    $return = $mObj->commentAdd($identifier, $_POST);
                    if ( isset($return->merchant->permalink) )
                        $redirect = $return->merchant->permalink;
                    elseif( isset($mObj->errors[401]) )
                        $redirect = $this->trigger_url . '/oauth/logout';
                    else
                        $redirect = $this->link_helper($identifier, 'merchant');
                    wp_redirect($redirect);
                    exit;
                }
                $template = 'merchant_comments';
                break;
            case 'votes':
            case 'votes.json':
                if ( count($_POST) > 0 ) {
                    $this->_reset_404();
                    $errorString = '{ "redirect_url" : null, "code" : 422, "errors" : { %s } }';
                    if ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHTTPRequest') {
                        // JSON output
                        if ( ! $this->Praized->isAuthorized() ) {
                            $this->_preserve_post();
                        	$return_to = ( strstr($identifier, '/') ) ? $this->trigger_url . $identifier : $this->link_helper($identifier, 'merchant');
                        	echo '{ "redirect_url" : "' . $this->trigger_url . '/oauth/login?return_to=' . rawurlencode($return_to) . '", "code" : 401, "errors" : {} }';
                        } elseif($m = $mObj->voteAdd($identifier, $_POST)) {
        					if ( $m->vote->merchant->votes->count ) {
                                echo '{';
            					echo ' "pos_count" : "' . $m->vote->merchant->votes->pos_count . '",';
            					echo ' "neg_count" : "' . $m->vote->merchant->votes->neg_count . '",';
            					echo '  "count"    : "' . $m->vote->merchant->votes->count . '",';
            					echo '  "score"    : "' . $m->vote->merchant->votes->score . '"';
            					echo '}';
        					} else {
        					    printf($errorString, '"error" : "API succeeded but returned no merchant data."');
        					}
                        } elseif( isset($mObj->errors[401]) ) {
                            echo '{ "redirect_url" : "' . $this->trigger_url . '/oauth/logout", "code" : 401, "errors" : {} }';
                        } else {
        					printf($errorString, '"error" : "Unknown Error"');
                        }
                    } else {
                        // Accessible vote form (ie: no JS)
                        if ( ! $this->Praized->isAuthorized() ) {
                        	$this->_preserve_post();
                        	wp_redirect($this->trigger_url . '/oauth/login');
                        } else {
                            $return = $mObj->voteAdd($identifier, $_POST);
                            if ( isset($return->vote->merchant->permalink) )
                                $redirect = $return->vote->merchant->permalink;
                            elseif ( isset($return->merchant->permalink) )
                                $redirect = $return->merchant->permalink;
                            elseif( isset($mObj->errors[401]) )
                                $redirect = $this->trigger_url . '/oauth/logout';
                            else
                                $redirect = $this->link_helper($identifier, 'merchant');
                            wp_redirect($redirect);
                        }
                    }
                    exit;
                }
                $template = 'merchant_votes';
                break;
            case 'favorites':
                if ( isset($_POST['_action']) ) {
                    if ( $_POST['_action'] == 'delete' )
                        $return = $mObj->favoriteDelete($identifier, $_POST);
                    else
                        $return = $mObj->favoriteAdd($identifier, $_POST);
                    if ( isset($return->merchant->permalink) )
                        $redirect = $return->merchant->permalink;
                    elseif( isset($mObj->errors[401]) )
                        $redirect = $this->trigger_url . '/oauth/logout';
                    else
                        $redirect = $this->link_helper($identifier, 'merchant');
                    wp_redirect($redirect);
                    exit;
                }
                $template = 'merchant_favorites';
                break;
            case 'taggings':
                if ( count($_POST) > 0 ) {
                    $return = $mObj->tagAdd($identifier, $_POST);
                    if ( isset($return->merchant->permalink) )
                        $redirect = $return->merchant->permalink;
                    elseif( isset($mObj->errors[401]) )
                        $redirect = $this->trigger_url . '/oauth/logout';
                    else
                        $redirect = $this->link_helper($identifier, 'merchant');
                    wp_redirect($redirect);
                    exit;
                }
                $template = 'merchant_taggings';
                break;
            case 'actions':
                $template = 'merchant_actions';
                break;
            default:
                $template = 'merchant';
                break;
        }
        
        if ( $merchant_object = $mObj->get($identifier, $_GET) ) {
            if ( is_object($merchant_object) ) { 
            	$this->_route_is_merchant = TRUE;
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
                    if( isset($mObj->errors[401]) )
                        $redirect = $this->trigger_url . '/oauth/logout';
                    else
                        $redirect = $this->link_helper($this->Praized->currentUserLogin(), 'user');
                    wp_redirect($redirect);
                    exit;
                }
                $template = 'user_favorites';
                break;
            case 'friends':
                if ( isset($_POST['_action']) ) {
                    if ( $_POST['_action'] == 'delete' )
                        $uObj->friendDelete($identifier, $_POST);
                    else
                        $uObj->friendAdd($identifier, $_POST);
                    if( isset($uObj->errors[401]) )
                        $redirect = $this->trigger_url . '/oauth/logout';
                    else
                        $redirect = $this->link_helper($this->Praized->currentUserLogin(), 'user');
                    wp_redirect($redirect);
                    exit;
                }
                $template = 'user_friends';
                break;
            case 'actions':
                $template = 'user_actions';
                break;
            default:
                $template = 'user';
                break;
        }

        if ( $user_object = $uObj->get($identifier, $_GET) ) {
            if ( is_object($user_object) ) {
                $this->_route_is_user = TRUE;
                $this->_tpt_environment($user_object);
	            $this->_reset_404();
                $this->template($template);
            }
        }
	}
	
	/**
	 * Handles the /actions* API routes
	 * (from $this->_reroute())
	 *
	 * @param array $route_parts Indexed array of the elements making the current API route (as def in $this->_reroute())
	 * @since 1.5
	 */
	function _route_actions($route_parts) {
	    // Leaving switch for future-proofing
	    switch ($route_parts[1]) {
	        default:
	            $this->_route_is_actions = TRUE;
	            $this->_reset_404();
                $this->template('actions');
	            break;
	    }
	}
	
	/**
	 * Handles the /questions* API routes
	 * (from $this->_reroute())
	 *
	 * @param array $route_parts Indexed array of the elements making the current API route (as def in $this->_reroute())
	 * @since 1.6
	 */
	function _route_questions($route_parts) {
	    if ( ! isset($route_parts[1]) || empty($route_parts[1]) )
	        $route_parts[1]  = '';
	    
 	    // Leaving switch for future-proofing
	    switch ($route_parts[1]) {
	        case '':
            	// handles posting questions while not logged in to the praized network
	        	if ( $this->Praized->isAuthorized() && isset($_GET['oauth_token']) && isset($_COOKIE[$this->_preserve_post_cookie_name()]) ) {
                    $_POST = unserialize(stripslashes($_COOKIE[$this->_preserve_post_cookie_name()]));
                    $this->_preserve_post(FALSE);
            	}
                if ( count($_POST) > 0 ) {
                    if ( ! $this->Praized->isAuthorized() )
                    	$this->_preserve_post();
                	$qObj = $this->Praized->question();
                    $return = $qObj->add($_POST);
                    if ( isset($return->question->permalink) )
                        $redirect = $return->question->permalink;
                    elseif( isset($qObj->errors[401]) )
                        $redirect = $this->trigger_url . '/oauth/logout';
                    else
                        $redirect = $this->link_helper('', 'question');
                    wp_redirect($redirect);
                    exit;
                }
	            $qObj = $this->Praized->questions();
	            if ( $questions_object = $qObj->get($_GET) ) {
	                if ( is_object($questions_object) ) {
	                    $this->_route_is_questions = TRUE;
	                    $this->_tpt_environment($questions_object);
	                    $this->_reset_404();
	                    $this->template('questions');
	                }
	            }
	            break;
	        default:
	            $this->_route_question($route_parts);
	            break;
	    }
	}
	
	/**
	 * Handles the /questions/{question_pid}* API routes
	 * (from $this->_reroute(), through $this->_route_questions())
	 *
	 * @param array $route_parts  Indexed array of the elements making the current API route (as def in $this->_reroute())
	 * @since 1.6
	 */
	function _route_question($route_parts) {
	    if ( empty($route_parts[1]) )
            return;
        
        $identifier = $route_parts[1];
        
        // handles posting answers while not logged in to the praized network
        if ( $this->Praized->isAuthorized() && isset($_GET['oauth_token']) && isset($_COOKIE[$this->_preserve_post_cookie_name()]) && $route_parts[2] == 'answers' ) {
            $_POST = unserialize(stripslashes($_COOKIE[$this->_preserve_post_cookie_name()]));
            $this->_preserve_post(FALSE);
        }
        
	    if ( ! isset($route_parts[2]) || empty($route_parts[2]) )
	        $route_parts[2]  = '';
	    elseif ( $route_parts[2] == 'answers' && ( ! isset($route_parts[3]) || empty($route_parts[3]) ) && count($_POST) == 0 )
	        $route_parts[2]  = $route_parts[3] = '';
	        
        switch ($route_parts[2]) {
            case 'answers':
                if ( count($_POST) > 0 ) {
                    if ( ! $this->Praized->isAuthorized() )
                    	$this->_preserve_post();
                    $qObj = $this->Praized->question();
                    $return = $qObj->answerAdd($identifier, $_POST);
                    if ( isset($return->answer->question->permalink) )
                        $redirect = $return->answer->question->permalink;
                    elseif ( isset($return->answer->permalink) )
                        $redirect = $return->answer->permalink;
                    elseif( isset($qObj->errors[401]) )
                        $redirect = $this->trigger_url . '/oauth/logout';
                    else
                        $redirect = $this->link_helper($identifier, 'question');
                    wp_redirect($redirect);
                    exit;
                }
                $this->_route_answer($route_parts);
                break;
            default:
	            $qObj = $this->Praized->question();
	            if ( $question_object = $qObj->answers($identifier, $_GET) ) {
	                if ( is_object($question_object) ) {
	                	$this->_route_is_question = TRUE;
	                    if ( isset($question_object->user->login) ) 
	                        $this->tpt_user = $question_object->user;
	                    if ( isset($question_object->answers) ) 
	                        $this->tpt_answers = $question_object->answers;
	                    $this->_tpt_environment($question_object);
	                    $this->_reset_404();
	                    $this->template('question');
	                }
	            }
                break;
        }
	}
	
	/**
	 * Handles the /questions/{question_pid}/answers/{answer_pid} API routes
	 * (from $this->_reroute(), through $this->_route_question())
	 *
	 * @param array $route_parts  Indexed array of the elements making the current API route (as def in $this->_reroute())
	 * @since 1.6
	 */
	function _route_answer($route_parts) {
		if ( $route_parts[0] == 'answers' ) {
			if ( empty($route_parts[1]) )
				return;
			$identifier   =  $route_parts[1];
			$alt_redirect = '../questions'; // should be path to questions list
		} elseif ( $route_parts[0] == 'questions' ) {
			if ( empty($route_parts[3]) )
				return;
			$identifier   =  $route_parts[3];
			$alt_redirect = '../'; // should be path to parent question
		} else {
			return;
		}
		
		$qObj = $this->Praized->question();
		
		if ( $answer_object = $qObj->answer($identifier, $_GET) ) {
			if ( ! is_object($answer_object) ) {
				wp_redirect($alt_redirect);
				exit;
			}
			if ( $_POST['_action'] == 'delete' ) {
				$qObj->answerDelete($identifier, $_POST);
				if ( isset($answer_object->answer->question->permalink) )
					wp_redirect($answer_object->answer->question->permalink);
				else
					wp_redirect($alt_redirect);
				exit;
			}
			$this->_route_is_answer = TRUE;
			if ( isset($answer_object->answer->question) ) 
				$this->tpt_question = $answer_object->answer->question;
			if ( isset($answer_object->answer->user->login) ) 
				$this->tpt_user = $answer_object->answer->user;
			if ( isset($answer_object->answer->merchants) ) 
				$this->tpt_merchants = $answer_object->answer->merchants;
			$this->_tpt_environment($answer_object);
			$this->_reset_404();
			$this->template('answer');
		} else {
			wp_redirect($alt_redirect);
			exit;
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
	    foreach ( $target as $key => $value ) {
	        $tpt_key = 'tpt_' . $key;
	        if ( isset($this->$tpt_key) && ( is_object($target->$key) || is_array($target->$key) ) )
	            $this->$tpt_key = $value;
	    }
	    return TRUE;
	}
	
	/**
	 * Includes the appropriate blogger-defined (theme) or default template
	 *
	 * @param string $template Template id (EG: merchants for user-defined /themes/x/praized-community/merchants.php or default merchants.php)
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
            if ( ! is_array($query) ) {
                $query = $_GET;
                if ( isset($_GET['q']) && empty($_GET['q']) && isset($_GET['l']) && empty($_GET['l']) ) {
                    // We still need users to be able to overwrite the defaults and submit an
                    // "Everything + Everywhere" query, but only when the form is truly submitted.
                    $query['q'] = $query['l'] = ''; // Just for clarity
                } else {
                    // Important to test against the original $_GET value in the ternary operator,
                    // or the query transformation (1st) will mess up the location transformation
                    // (2nd) done after... 
                    if ( empty($query['q']) )
                        $query['q'] = ( ! empty($_GET['l']) ) ? '' : $this->_config['default_query'];
                    if ( empty($query['l']) )
                        $query['l'] = ( ! empty($_GET['q']) ) ? '' : $this->_config['default_location'];
                }
            }
            $mObj = $this->Praized->merchants();
            $response = $mObj->get($query);
            if ( is_object($response) && is_array($response->merchants) )
                $this->_tpt_environment($response);
        }
	    if ( is_array($this->tpt_merchants) )
            return count($this->tpt_merchants);
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
            }
	    }
	    return FALSE;
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
                if ( is_object($response) && isset($response->merchant) )
                    $this->_tpt_environment($response);
            }
	    }
        if ( is_object($this->tpt_merchant) && isset($this->tpt_merchant->pid) )
            return TRUE;
        return FALSE;
	}
	
	/**
	 * Template function: Tests if the current page is a single merchant page
	 *
	 * @return boolean
	 * @since 1.0.4
	 */
	function tpt_is_merchant_page() {
	    if ( $this->_route_is_merchant )
	        return TRUE;
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
            }
	    }
        return FALSE;
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
            }
	    }
	    return FALSE;
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
            if ( is_object($response) )
                $this->_tpt_environment($response);
        }
	    if ( is_array($this->tpt_comments) )
            return count($this->tpt_comments);
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
            }
	    }
		return FALSE;
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
            }
	    }
	    return FALSE;
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
            if ( is_object($response) )
                $this->_tpt_environment($response);
        }
	    if ( is_array($this->tpt_votes) )
            return count($this->tpt_votes);
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
            }
	    }
	    return FALSE;
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
                if ( is_object($response) && isset($response->user) )
                    $this->_tpt_environment($response);
            }
	    }
	    if ( is_object($this->tpt_user) && isset($this->tpt_user->login) )
            return TRUE;
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
            }
	    }
	    return FALSE;
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
        return FALSE;
	}
	
	/**
	 * Template function: Tests if there are > 0 items in $this->tpt_actions
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return mixed boolean FALSE or integer Action count
	 * @since 1.5
	 */
	function tpt_has_actions($query = FALSE) {
        if ( ! $this->tpt_actions ) {
            if ( ! is_array($query) )
                $query = $_GET;
            if ( $this->_route_is_merchant ) {
                $obj = $this->Praized->merchant();
                $response = $obj->actions($this->tpt_merchant->pid, $query); 
            } elseif ( $this->_route_is_user ) {
                $obj = $this->Praized->user();
                $response = $obj->actions($this->tpt_user->login, $query); 
            } else {
                $obj = $this->Praized->actions();
                $response = $obj->get($query);
            }
            if ( is_object($response) && is_array($response->actions) )
                $this->_tpt_environment($response);
        }
	    if ( is_array($this->tpt_actions) )
            return count($this->tpt_actions);
        return FALSE;
	}
	
	/**
	 * Template function: Praized equivalent of the WP "the_loop" for the current actions list, usually used in while loop
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean and sets $this->tpt_action if appropriate
	 * @since 1.5
	 */
	function tpt_actions_loop($query = FALSE) {
        $this->tpt_has_next_action = FALSE;
        if ( $this->tpt_has_actions($query) ) {
            $actions = $this->tpt_actions;
	        if ( isset($actions[$this->tpt_action_index]) ) {
	            $action = $actions[$this->tpt_action_index];
	            $this->tpt_action = $action;
                if ( isset($actions[$this->tpt_action_index + 1]) )
                    $this->tpt_has_next_action = TRUE;
	            $this->tpt_action_index++;
    	        return TRUE;
            }
	    }
        return FALSE;
	}
	
	/**
	 * Template function: Tests if there is a valid $this->tpt_action
	 *
	 * @return boolean
	 * @since 1.5
	 */
	function tpt_has_action() {
	    if ( is_object($this->tpt_action) && isset($this->tpt_action->summary) )
            return TRUE;
        return FALSE;
	}
	
	/**
	 * Template function: Tests if there are > 0 items in $this->tpt_questions
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return mixed boolean FALSE or integer Question count
	 * @since 1.6
	 */
	function tpt_has_questions($query = FALSE) {
        if ( ! $this->tpt_questions ) {
            if ( ! is_array($query) )
                $query = $_GET;
            if ( $this->_route_is_merchant ) {
                $obj = $this->Praized->merchant();
                $response = $obj->questions($this->tpt_merchant->pid, $query); 
            } elseif ( $this->_route_is_user ) {
                $obj = $this->Praized->user();
                $response = $obj->questions($this->tpt_user->login, $query); 
            } else {
                $obj = $this->Praized->questions();
                $response = $obj->get($query);
            }
            if ( is_object($response) && is_array($response->questions) )
                $this->_tpt_environment($response);
        }
	    if ( is_array($this->tpt_questions) )
            return count($this->tpt_questions);
        return FALSE;
	}
	
	/**
	 * Template function: Praized equivalent of the WP "the_loop" for the current questions list, usually used in while loop
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean and sets $this->tpt_action if appropriate
	 * @since 1.6
	 */
	function tpt_questions_loop($query = FALSE) {
        $this->tpt_has_next_question = FALSE;
        if ( $this->tpt_has_questions($query) ) {
            $questions = $this->tpt_questions;
	        if ( isset($questions[$this->tpt_question_index]) ) {
	            $question = $questions[$this->tpt_question_index];
	            $this->tpt_question = $question;
	            if ( isset($question->user->login) )
	                $this->tpt_user = $question->user;
                if ( isset($questions[$this->tpt_question_index + 1]) )
                    $this->tpt_has_next_question = TRUE;
	            $this->tpt_question_index++;
    	        return TRUE;
            }
	    }
	    return FALSE;
	}
	
	/**
	 * Returns an array of the current user's configured broadcast services.
	 * 
	 * @return mixed Boolean FALSE or Array
	 * @since 1.6
	 */
	function _user_broadcast_services() {
		if ( ! ( $identifier = $this->Praized->currentUserLogin() ) )
			return FALSE;
		$uObj = $this->Praized->user();
		if ( ! ( $data = $uObj->get($identifier) ) || ! isset($data->user) || ! isset($data->user->self) )
			return FALSE;
		if ( ! ( $self = $data->user->self ) || ! isset($self->broadcast_services) || ! is_array($self->broadcast_services) )
			return FALSE;
		return $self->broadcast_services;
	}
	
	/**
	 * Template function: Tests if there is a valid $this->tpt_question
	 *
	 * @return boolean
	 * @since 1.6
	 */
	function tpt_has_question() {
	    if ( is_object($this->tpt_question) && isset($this->tpt_question->pid) ) {
            if ( isset($this->tpt_question->answers) )
                $this->tpt_answers = $this->tpt_question->answers;
            if ( isset($this->tpt_question->user) )
                $this->tpt_user = $this->tpt_question->user;
            return TRUE;
	    }
        return FALSE;
	}
	
	/**
	 * Template function: Tests if there are > 0 items in $this->tpt_answers
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return mixed boolean FALSE or integer Answer count
	 * @since 1.6
	 */
	function tpt_has_answers($query = FALSE) {
        if ( ! $this->tpt_answers ) {
            if ( ! is_array($query) )
                $query = $_GET;
            if ( $this->_route_is_merchant ) {
                $obj = $this->Praized->merchant();
                $response = $obj->answers($this->tpt_merchant->pid, $query); 
            } elseif ( $this->_route_is_user ) {
                $obj = $this->Praized->user();
                $response = $obj->answers($this->tpt_user->login, $query); 
            } elseif ( is_object($this->tpt_question) && isset($this->tpt_question->pid) ) {
                $obj = $this->Praized->question();
                $response = $obj->answers($this->tpt_question->pid);
            }
            if ( is_object($response) && is_array($response->answers) )
                $this->_tpt_environment($response);
        }
	    if ( is_array($this->tpt_answers) )
            return count($this->tpt_answers);
        return FALSE;
	}
	
	/**
	 * Template function: Praized equivalent of the WP "the_loop" for the current answers list, usually used in while loop
	 *
	 * @param array Optional query to overwrite the current context and force fetch other data
	 * @return boolean and sets $this->tpt_action if appropriate
	 * @since 1.6
	 */
	function tpt_answers_loop($query = FALSE) {
        $this->tpt_has_next_answer = FALSE;
        if ( $this->tpt_has_answers($query) ) {
            $answers = $this->tpt_answers;
	        if ( isset($answers[$this->tpt_answer_index]) ) {
	            $answer = $answers[$this->tpt_answer_index];
	            $this->tpt_answer = $answer;
	            if ( isset($answer->user->login) )
	                $this->tpt_user = $answer->user;
	            if ( isset($answer->merchants) )
	                $this->tpt_merchants = $answer->merchants;
                if ( isset($answers[$this->tpt_answer_index + 1]) )
                    $this->tpt_has_next_answer = TRUE;
	            $this->tpt_answer_index++;
    	        return TRUE;
            }
	    }
        return FALSE;
	}
	
	/**
	 * Template function: Tests if there is a valid $this->tpt_answer
	 *
	 * @return boolean
	 * @since 1.6
	 */
	function tpt_has_answer() {
	    if ( is_object($this->tpt_answer) && isset($this->tpt_answer->pid) ) {
            if ( isset($this->tpt_answer->merchants) )
                $this->tpt_merchants = $this->tpt_answer->merchants;
            if ( isset($this->tpt_answer->user) )
                $this->tpt_user = $this->tpt_answer->user;
            if ( isset($this->tpt_answer->question) )
                $this->tpt_question = $this->tpt_answer->question;
            return TRUE;
	    }
        return FALSE;
	}

	/**
	 * Returns the content node of an answer, with the localized "deleted at" text instead of required
	 *
	 * @param boolean $echo
	 * @return string content
	 * @since 1.6
	 */
	function tpt_answer_content($echo = TRUE, $answer = FALSE) {
	    if ( ! $answer )
	    	$answer = $this->tpt_answer;
		if ( ! $answer || ! $answer->pid )
	    	return FALSE;
    	if ( isset($answer->deleted_at) )
    		$out = $this->__('This answer has been deleted.');
    	else
    		$out = $answer->content;
	    if ( $echo )
    	    echo $out;
    	return $out;
	}

	/**
	 * Returns an unordered list of merchants related to a specific answer.
	 *
	 * @param boolean $echo
	 * @return mixed Boolean FALSE or String unordered list of merchants
	 * @since 1.6
	 */
	function tpt_answer_merchants($echo = TRUE) {
	    if ( ! $this->tpt_answer || ! $this->tpt_answer->merchants || ! is_array($this->tpt_answer->merchants) || count($this->tpt_answer->merchants) < 1 )
	    	return FALSE;
	    $merchants = $this->tpt_answer->merchants;
    	$out = '<p class="praized-questions-sub-header"><strong>'.$this->__('Suggested places').'</strong></p>';
	    $out .= $this->tpt_merchants_simple_list($merchants);
	    if ( $echo )
    	    echo $out;
    	return $out;
	}
	
	/**
	 * Template function: Vote button
	 *
	 * @param boolean $echo
	 * @param string $identifier Optional merchant PID, defauts to $this->tpt_merchant
	 * @return string
	 * @since 1.5
	 */
	function tpt_vote_button($echo = TRUE, $identifier = FALSE) {
	    if ( ! $this->tpt_has_merchant($identifier) )
    	    return;
	    
	    if ( ! $this->_load_praized() || ! $this->PraizedXHTML )
	        return;
	    
	    $translations = array(
        	'must_login' => $this->__('You must login before you can vote! - Just click, we\'ll take you there and back!'),
        	'vote_up'    => $this->__('Vote Up'),
        	'vote_down'  => $this->__('Vote Down')
        );
        
        // The PraizedXHTML vote button template needs a comunity node to get the base url 
        $hack = new stdClass();
        $hack->merchant  = $this->tpt_merchant;
        $hack->community = $this->tpt_community;
        
        $out = $this->PraizedXHTML->xhtml($hack, 'vote_button', array('translations' => $translations));
        
        if ( $echo )
    	    echo $out;
    	
    	return $out;
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
	 * Praized.com twitter integration
	 *
	 * @param object $merchantData
	 * @return string Twitter URL with merchant data
	 * @since 1.0.4
	 */
	function tpt_twitter_link($echo = TRUE, $identifier = FALSE) {
	    if ( ! $this->_route_is_merchant || ! $this->tpt_has_merchant($identifier) )
    	    return;
    	
    	$mObj = $this->Praized->merchant();
    	$out = $mObj->twitterLink($this->tpt_merchant);
    	
    	if ( $echo )
    	    echo $out;
    	
    	return $out;
	}

	/**
	 * Time distance helper
	 *
	 * @param mixed int|string $from Either a time in seconds, or a strtotime translatable string
	 * @param array $translations Translated captions, see source for keys and English captions.
	 * @param boolean $echo
	 * @return string How long ago was the $from from right now.
	 * @since 1.5
	 */
	function tpt_time_distance($from, $translations = array(), $echo = TRUE) {
	    $out = $this->Praized->timeDistance($from, $translations);
    	if ( $echo )
    	    echo $out;
    	return $out;
	}
	
	/**
	 * Template function: Returns a simple <ul> of the passed merchants array.
	 * 
	 * @param array $merchants
	 * @return string
	 * @since 1.6
	 */
	function tpt_merchants_simple_list($merchants) {
	    if ( ! is_array($merchants) || count($merchants) < 1 )
	    	return ''; 
    	$out .= '<ul>';
    	foreach ( $merchants as $merchant ) {
			$out .= '<li>';
			$out .= '<a href="'.$merchant->permalink.'">'.$merchant->name.'</a>';
			if ( $location =  $merchant->location ) {
				$out .= ': <small>';
				if ( $location->city->name ) {
					$out .= $location->city->name;
					if ( $location->regions->state || $location->regions->province || $location->country->name )
						$out .= ', ';
				}
				if ( $location->regions->state || $location->regions->province ) {
					$out .= ( $location->regions->state ) ? $location->regions->state : $location->regions->province;
					if ( $location->country->name )
						$out .= ', ';
				}
				if ( $location->country->name ) {
					$out .= $location->country->name;
				}
				$out .= '</small>';
			}
			$out .= '</li>';
    	}
    	$out .= '</ul>';
		return $out;
	}
	
	/**
	 * Template function: Returns a list of the current user's configured broadcast services as checkboxes.
	 * 
	 * @param boolean $echo
	 * @return string
	 * @since 1.6
	 */
	function tpt_questions_user_broadcast_services($echo = TRUE) {
		if ( ! ( $services = $this->_user_broadcast_services() ) )
			return '';
		$checkboxes = '';
		foreach ( $services as $service ) {
			if ( isset($service->service_type) && isset($service->name) ) {
				$service_id = 'praized_broadcast_service_'.strtolower($service->service_type);
				$checkboxes .= '<input type="checkbox" name="broadcast_services[]" id="'.$service_id.'" value="'.$service->service_type.'" class="praized_broadcast_service" checked="checked"/> '
							.  '<label for="'.$service_id.'">'.$service->name.'</label> ';
			}
		}
		if ( $echo )
			echo $checkboxes;
		return $checkboxes;
	}

	/**
	 * Template function: Returns an unordered list of merchants related to a specific structured question.
	 *
	 * @param boolean $echo
	 * @param string Optional question pid, or defaults to $this->tpt_question->pid
	 * @return mixed Boolean FALSE or String unordered list of related merchants
	 * @since 1.6
	 */
	function tpt_question_related_merchants($echo = TRUE, $identifier = FALSE) {
	    if ( ! $identifier ) {
	    	if ( ! $this->tpt_question || ! $this->tpt_question->pid )
	    		return FALSE;
	    	$identifier = $this->tpt_question->pid;
	    }
	    $obj = $this->Praized->question();
	    $data = $obj->relatedMerchants($identifier);
	    if ( ! ($merchants = $data->merchants) || ! is_array($merchants) || count($merchants) < 1 )
	    	return FALSE; 
    	$out = '<p class="praized-questions-sub-header"><strong>'.$this->__('Other related places').'</strong></p>';
    	$out .= $this->tpt_merchants_simple_list($merchants);
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
	    echo '<h2 class="widgettitle">'.$title.'</h2>';
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
	    echo '<h2 class="widgettitle">'.$title.'</h2>';
	    echo $after_title;   // WP STANDARD
        
        $this->template('_auth_nav', true);
        
        echo "\n</li>\n";
        echo $after_widget;  // WP STANDARD
	 }
}
?>