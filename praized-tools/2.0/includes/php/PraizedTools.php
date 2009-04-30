<?php
/**
 * Praized Tools
 * 
 * @version 2.0
 * @package PraizedTools
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Include Praized Core Wordpress Class
 */
require_once(dirname(realpath(__FILE__)).'/praized-wp-core/PraizedWP.php');

/**
 * Praized Tools: class
 * 
 * @package PraizedTools
 * @since 0.1
 */
class PraizedTools extends PraizedWP {
    /**
     * PraizedTools version
     * @var string
     * @since 1.0.2
     */
    var $version = '2.0';
    
	/**
     * Merchant widget identifier string
     * @var string
     * @since 0.1
     */
    var $_wdgt_bbcode_key;
    
    /**
     * Latest activity widget identifier string
     * @var string
     * @since 2.0
     */
    var $_wdgt_latest_activity_key;
    
    /**
     * Latest questions widget identifier string
     * @var string
     * @since 2.0
     */
    var $_wdgt_latest_questions_key;
    
	/**
	 * Constructor
	 *
	 * @return PraizedTools
	 * @since 0.1
	 * @see PraizedWP::PraizedWP()
	 */
	function PraizedTools() {
		PraizedWP::PraizedWP('praized-tools');
		
		if ( ! isset($this->_config['aggregate']) )
		    $this->_config['aggregate'] = FALSE;

		if ( ! isset($this->_config['hide_vote']) )
		    $this->_config['hide_vote'] = FALSE;

		if ( ! isset($this->_config['hide_tags']) )
		    $this->_config['hide_tags'] = FALSE;

		if ( ! isset($this->_config['hide_stats']) )
		    $this->_config['hide_stats'] = FALSE;
		    
		$this->_wdgt_bbcode_key           = $this->_wdgt_key . '_bbcode';
		$this->_wdgt_latest_activity_key  = $this->_wdgt_key . '_latest_activity';
		$this->_wdgt_latest_questions_key = $this->_wdgt_key . '_latest_questions';
		
		add_action('init', array(&$this, 'wp_action_mce_extras'));
	}
	
	/**
	 * Initializes default API creds linking to the Praized hub
	 *
	 * @since 1.6
	 */
	function _init_defaults() {
        if ( empty($this->_config['community']) )
		    $this->_config['community'] = 'praized-tools';

		if ( empty($this->_config['api_key']) )
		    $this->_config['api_key'] = 'd7b379a513515186260108bd4faadc76';
	}

	/**
	 * Admin tools "constructor"
	 * 
	 * @since 0.1
	 */
	function admin_tools() {
		if ( ! strstr($_SERVER['QUERY_STRING'], $this->_plugin_name) && ( ! $this->_config['community'] || ! $this->_config['api_key']) ) {
			add_action('admin_notices', array(&$this, 'wp_action_install_warning'));
		}
		
		$this->_init_defaults();

		if ( count($_POST) > 0 ) {
			if ( strstr($_GET['page'], $this->_plugin_name) && isset($_POST['community']) ) {
                
			    if ( isset($_POST['get_pc_config']) && ( $pc_conf = get_option('praized-community-config') ) ) {
			        // Try to get community slug and API key from the Praized Community plugin's configs.
			        if ( empty($pc_conf['community']) || empty($pc_conf['api_key']) ) {
			            $this->errors[] = $this->__('Sorry, but we were unable to acquire appropriate configurations from the Praized Community plugin. Please enter your community slug and API key manually instead.');
			        } else{
			            $_POST['community'] = $pc_conf['community'];
			            $_POST['api_key']   = $pc_conf['api_key'];
			        }
			    } else {
			        // Or get the configs from the form instead.
			        $missing_val_msg = $this->__('Please submit a value for the "%s" form field.');
    			    if ( empty($_POST['community']) )
            		    $this->errors[] = sprintf( $missing_val_msg, $this->__('Community') );
                    if ( empty($_POST['api_key']) ) 
            		    $this->errors[] = sprintf( $missing_val_msg, $this->__('API Key') );
			    }
			    
		        if ( count($this->errors) > 0 ) {
        		    add_action( 'admin_notices', array(&$this, 'wp_action_admin_errors') );
        		} else {
        		    $this->_save_config();
        		}
			
			} else {
    			// Merchant widget config save
			    if( isset($_POST[$this->_wdgt_bbcode_key . '_wdgt_title']) ) {
    			    $this->widget_bbcode_options_save();
    			}
    			// Latest activity widget config save
			    if( isset($_POST[$this->_wdgt_latest_activity_key . '_title']) ) {
    			    $this->widget_latest_activity_options_save();
    			}
    			// Latest questions widget config save
			    if( isset($_POST[$this->_wdgt_latest_questions_key . '_title']) ) {
    			    $this->widget_latest_questions_options_save();
    			}
		    }
		}

		add_action('admin_head', array(&$this, 'wp_action_admin_head'));
		add_action('admin_menu', array(&$this, 'wp_action_admin_menu'));
		
		wp_enqueue_script('praized-tools-commons', $this->_plugin_dir . '/includes/js/commons/praized-tools-admin.js', FALSE, $this->version);
	    wp_enqueue_script('praized-tools-wp', $this->_plugin_dir . '/includes/js/admin.js', 'praized-tools-commons', $this->version);
	}
    
	/**
	 * Displays an admin notice to prompt the administrator(s) to configure the plugin.
	 *
	 * @since 0.1
	 */
	function wp_action_install_warning() {
		$this->_load_praized();
	    echo '<div id="praized-warning" class="updated fade"><p>';
		printf(
			$this->__('Thank you for installing the <strong>Praized Tools</strong> plugin. To finalize the installation, please take the time to <a href="%s">configure the last few details</a>.'),
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
		$name = 'Praized Tools';
	    add_options_page(
			$this->__($name),
			$this->__($name),
			9,
			$this->_plugin_name . '/' . $this->_plugin_name . '.php',
			array(&$this, 'wp_options_page')
		);
	}
	
	/**
	 * WP Action: Admin header (html) handling
	 *
	 * @since 0.1
	 */
	function wp_action_admin_head() {
	    if ( ! $this->_load_praized() )
	        return FALSE;
	    
	    echo sprintf(
	        '<link rel="stylesheet" href="%s/includes/css/commons/praized-tools-admin.css?v=%s" type="text/css" media="screen" />' . "\n",
	        $this->_plugin_dir_url,
	        $this->version
	    );
	    
        if ( isset($_SERVER['HTTPS']) && ( ! empty($_SERVER['HTTPS']) ) ) {
            $proto = 'https';
            $schlt_host = str_replace('http:', 'https:', $this->Praized->praizedLinks['searchlet']);
        } else {
            $proto = 'http';
            $schlt_host = $this->Praized->praizedLinks['searchlet'];
        }
        
        $self_url = $proto
                  . '://'
                  . $_SERVER['SERVER_NAME']
                  . $_SERVER['REQUEST_URI'];
        
        $schlt_url = sprintf(
            '%s/%s/merchants/search/?api_key=%s&callback=%s',
            $schlt_host,
            $this->_config['community'],
            $this->_config['api_key'],
            urlencode($self_url)
        );
        
        $widget_content_field  = $this->_wdgt_bbcode_key .'_content';
        
        echo <<<________EOS
        <script type='text/javascript'>
        /* <![CDATA[ */
            window.ptasConf = {
                schltUrl           : "$schlt_url",
                widgetContentField : "$widget_content_field"
            };
        /* ]]> */
        </script>
________EOS;
	    echo "\n";
	}
	
	/**
	 * Praized plugin configuration page
	 *
	 * @since 0.1
	 */
	function wp_options_page() {
		$form = ( count($this->_config_form) > 0 ) ? $this->_config_form : $this->_config;
		$this->_load_praized();
		require_once($this->_includes . '/php/config.php');
	}
	
	/**
	 * WP Widget: option form
	 *
	 * @since 0.1
	 */
	function widget_bbcode_options_form() {
	    $widget_id = $this->_wdgt_bbcode_key;
	    
	    $config = $this->_get_wp_option($widget_id);
	    
	    if ( !is_array($config) )
	        $config = array();
	    
	    echo '<p><strong>'.$this->__('Use the "Praized Searchlet" button below to customize your widget.').'</strong></p>';
	        
        $field_id = $widget_id . '_wdgt_title';
	    echo '<p><label for="'.$field_id.'">'.$this->__('Widget Title').'</label><br />';
	    echo '<input type="text" id="'.$field_id.'" name="'.$field_id.'" value="'.$config['wdgt_title'].'" size="60" style="width: 99%;" /></p>';

        $field_id = $widget_id . '_content';
	    echo '<p><label for="'.$field_id.'">'.$this->__('Configurations').'</label><br />';
	    echo '<textarea id="'.$field_id.'" name="'.$field_id.'" cols="60" rows="3" style="width: 99%;">'.stripslashes($config['content']).'</textarea></p>';
	    
	    echo '<a href="#" id="pta_load_searchlet" class="pta_widget_button">'.$this->__('Praized Searchlet').'</a>';
	}
	
	/**
	 * WP Widget: option save process
	 *
	 * @since 0.1
	 */
	function widget_bbcode_options_save() {
	    $widget_id = $this->_wdgt_bbcode_key;
	    // Note: _save_wp_option() sanitizes the content
	    $this->_save_wp_option($widget_id, array(
	        'wdgt_title' => $_POST[$widget_id . '_wdgt_title'],
	        'content'    => $_POST[$widget_id . '_content']
	    ));
	}
	
	/**
	 * WP Widget: Latest activity option form
	 *
	 * @since 2.0
	 */
	function widget_latest_activity_options_form() {
	    $widget_id = $this->_wdgt_latest_activity_key;
	    
	    $config = $this->_get_wp_option($widget_id);
	    if ( ! is_array($config) )
	        $config = array();
	    
        $field_id = $widget_id . '_title';
	    echo '<p><label for="'.$field_id.'">'.$this->__('Widget Title').': '.'</label></br />';
	    echo '<input type="text" id="'.$field_id.'" name="'.$field_id.'" value="'.$config['title'].'" /></p>';
	    
        $field_id = $widget_id . '_limit';
	    echo '<p><label for="'.$field_id.'">'.$this->__('Limit to').': '.'</label></br />';
	    echo '<input type="text" id="'.$field_id.'" name="'.$field_id.'" value="'.$config['limit'].'" size="5" /> '.$this->__('items').'</p>';
	}
	
	/**
	 * WP Widget: Latest activity option save process
	 *
	 * @since 2.0
	 */
	function widget_latest_activity_options_save() {
	    $widget_id = $this->_wdgt_latest_activity_key;
	    // Note: _save_wp_option() sanitizes the content
	    $this->_save_wp_option($widget_id, array(
	        'title'   => $_POST[$widget_id . '_title'],
	        'limit'   => $_POST[$widget_id . '_limit']
	    ));
	}
	
	/**
	 * WP Widget: Latest questions option form
	 *
	 * @since 2.0
	 */
	function widget_latest_questions_options_form() {
	    $widget_id = $this->_wdgt_latest_questions_key;
	    
	    $config = $this->_get_wp_option($widget_id);
	    if ( !is_array($config) )
	        $config = array();
	    
        $field_id = $widget_id . '_title';
	    echo '<p><label for="'.$field_id.'">'.$this->__('Widget Title').': '.'</label></br />';
	    echo '<input type="text" id="'.$field_id.'" name="'.$field_id.'" value="'.$config['title'].'" /></p>';
	    
        $field_id = $widget_id . '_limit';
	    echo '<p><label for="'.$field_id.'">'.$this->__('Limit to').': '.'</label></br />';
	    echo '<input type="text" id="'.$field_id.'" name="'.$field_id.'" value="'.$config['limit'].'" size="5" /> '.$this->__('items').'</p>';
	}
	
	/**
	 * WP Widget: Latest questions option save process
	 *
	 * @since 2.0
	 */
	function widget_latest_questions_options_save() {
	    $widget_id = $this->_wdgt_latest_questions_key;
	    // Note: _save_wp_option() sanitizes the content
	    $this->_save_wp_option($widget_id, array(
	        'title'   => $_POST[$widget_id . '_title'],
	        'limit'   => $_POST[$widget_id . '_limit']
	    ));
	}
	
    /**
     * WP Action: Extends the Tiny MCE and Code editors with the Praized functionalities
     *
     * @since 0.1
     */
	function wp_action_mce_extras() {
		
	    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;

		$btn_snap = array(
		    'img'  => $this->_plugin_dir_url . '/includes/css/commons/images/logo-20x20.png',
		    'capt' => $this->__('Praized Tools')
		);
	    
        if ( 'true' == get_user_option('rich_editing') ) {
	        if ( $this->_wp_version >= 2.5 ) {
                // WordPress 2.5+ (TinyMCE 3.x)
			    add_filter( 'mce_external_plugins', array(&$this, 'wp_filter_mce_plugins_3') );
				add_filter( 'mce_buttons_3', array(&$this, 'wp_filter_mce_buttons') );
			} else {
				// WordPress 2.1+ (TinyMCE 2.x)
			    add_filter('mce_plugins', array(&$this, 'wp_filter_mce_plugins_2'));
				add_filter('mce_buttons', array(&$this, 'wp_filter_mce_buttons'));
				add_action('tinymce_before_init', array(&$this, 'wp_action_mce_b4init'));
			}
        }
		
        // set the Code view button
		buttonsnap2_jsbutton($btn_snap['img'], $btn_snap['capt'], 'PraizedToolsAdmin.Searchlet.show("mce", 2);');
	}

    /**
     * WP Filter: Loads the TinyMCE 2 Praized plugin
     *
     * @param array $plugins List of TinyMCE 2 plugins, sent by WP
     * @return Modified TinyMCE 2 plugins list
     * @since 0.1
     */
	function wp_filter_mce_plugins_2($plugins) {
		array_push($plugins, 'praizedtools');
		return $plugins;
	}

    /**
     * WP Filter: Loads the TinyMCE 3 Praized plugin
     *
     * @param array $plugins List of TinyMCE 3 plugins, sent by WP
     * @return Modified TinyMCE 3 plugins list
     * @since 0.1
     */
	function wp_filter_mce_plugins_3($plugins) {
	    $plugins['praizedtools'] = $this->_plugin_dir_url . '/includes/js/tinymce/3/editor_plugin.js';
    	return $plugins;
	}
	
	/**
	 * WP Filter: Loads the Tiny MCE 2 or 3 Praized buttons
	 *
	 * @param array $buttons List of TinyMCE buttons, sent by WP
	 * @return Modified TinyMCE 3 buttons list
     * @since 0.1
	 */
	function wp_filter_mce_buttons($buttons) {
	    if ( $this->_wp_version < 2.5 ) array_push($buttons, 'separator');
	    array_push($buttons, 'praizedtools');
		return $buttons;
	}
	
	/**
	 * WP Action: TinyMCE 2 init
	 *
     * @since 0.1
	 */
	function wp_action_mce_b4init() {
		// WordPress < 2.5
		echo 'tinyMCE.loadPlugin("praizedtools", "' . $this->_plugin_dir_url . '/includes/js/tinymce/2/");';
	}
	
	/**
	 * Display tools "constructor"
	 * 
	 * @since 0.1
	 */
	function display_tools() {
		$this->_init_defaults();
	    $this->_load_praized();
	    
	    // Test to make sure caching wasn't disabled at the WP level since the prefs were last saved.
	    if ( FALSE === $this->_use_caching() )
	        $this->_config['caching'] = FALSE;
		
	    add_action('wp_head', array(&$this, 'wp_action_template_head'));
		add_filter('the_content', array(&$this, 'wp_filter_the_content'));
	}
	
	/**
	 * WP action: processed when wp_head() is called in templates
	 *
	 * @since 0.1
	 */
	function wp_action_template_head() {
	    if ( ! class_exists('PraizedCommunity') && $css = $this->_css() ) // Note: "$css =" is an assignment, not just a test 
	        echo $css;
	    
	    printf(
	        '<link rel="stylesheet" href="%s/includes/css/commons/praized-tools.css?v=%s" type="text/css" media="screen" />' . "\n",
	        $this->_plugin_dir_url,
	        $this->version
	    );
	}
	
	/**
	 * Saves static data as non-autoloading option
	 *
	 * @param string $key
	 * @param mixed $value Note: WP serializes values, so obj and arrays are okay
	 * @since 0.1
	 */
	function _save_static($key, $value) {
	    $key = $this->_wp_option_key($key);
        $css_class = '';
	    if ( isset($value->merchants[0]) && ! isset($value->merchants[0]->static_timestamp) )
	        $value->merchants[0]->static_timestamp = date('Y-m-d H:i:s');
	    elseif ( isset($value->merchant) && ! isset($value->merchant->static_timestamp) )
	        $value->merchant->static_timestamp = 'Data as of ' . date('Y-m-d H:i');
    	if ( ! get_option($key) )
	        add_option($key, $value, '', 'no');
	    else
        	update_option($key, $value);
	}
	
	/**
	 * Get static data (non-autoloading option, but cached)
	 *
	 * @param string $key
	 * @since 0.1
	 */
	function _get_static($key) {
	    $val = $this->_get_wp_option($key);
	    return ( $val ) ? $val : FALSE;
	}
	
	/**
	 * WP Filter: Applied to the post/page content retrieved from the database, prior to printing on the screen
	 *
	 * @param string $content Post/page content
	 * @return string Modified post/page content
	 * @since 0.1
	 * @deprecated 1.5.1 Only here for backward compatibility. See PraizedTools::_parse_merchants().
	 */
	function _parse_bbcode($content, $with_aggregate = FALSE) {
	    return $this->_parse_merchants($content, $with_aggregate);
	}
	
	/**
	 * Checks the aggregate container array structure for duplicate merchants (pids) and removes them if any
	 *
	 * @param array $aggregate See $aggregate in PraizedTools::_parse_merchants();
	 * @return array
	 * @since 1.6
	 */
	function _aggregate_duplicate_test($aggregate) {
	    $test = array();
	    foreach ($aggregate->merchants as $agg_key => $agg_val) {
            if ( in_array($agg_val->pid, $test) )
                unset($aggregate->merchants[$agg_key]);
            else
                $test[] = $agg_val->pid;
        }
        return $aggregate;
	}
	
	/**
	 * WP Filter: Applied to the post/page content retrieved from the database, prior to printing on the screen
	 *
	 * @param string $content Post/page content
	 * @return string Modified post/page content
	 * @since 1.6
	 */
	function _parse_merchants($content, $with_aggregate = FALSE) {
	    $cache_key = 'post_cache_' . md5($content);
	    
	    if ( ! ( FALSE === ( $cached_content = $this->_get_cache($cache_key) ) ) )
	        return $cached_content;	     
	    
	    require_once($this->_praized_inc_dir . '/PraizedParser.php');
	    
	    /**
	     * Note: it's important to scan for URLs before we scan for bbcodes,
	     * or we'll process the same info twice (ie: converted bbcode).
	     */
            
        if ( $with_aggregate && ( is_single() || is_page() ) ) {
            $aggregate = new stdClass();
            $aggregate->merchants = array();
            $urls = PraizedParser::urlFind($content);
        } else {
            $urls = FALSE;
        }
	    
	    $bb_tags = PraizedParser::bbFind($content);
	    
	    if ( ! $urls && ! $bb_tags )
	        return $content;
        
	    if ( $bb_tags ) {
            foreach ( $bb_tags as $original => $specs ) {
                $replacement = '';
                
                $type    = ( isset($specs->type) )     ? $specs->type : 'list';
                $dynamic = ( isset($specs->dynamic) )  ? $specs->dynamic : 'true';
                
                $dynamic = ( 'true' == strtolower($dynamic) ) ? TRUE : FALSE;
    
                $static_key = 'bbcode_static_' . md5(serialize($specs));
                
                $config = array();
                
                switch ($type) {
                    case 'badge':
                        if ( ! isset($specs->pid) || empty($specs->pid) )
                            break;
                        
                        $config['subtype'] = ( isset($specs->subtype) ) ? $specs->subtype : 'big';
                        $config['name']    = ( isset($specs->name) )    ? $specs->name    : 'false';
                        $config['address'] = ( isset($specs->address) ) ? $specs->address : 'false';
                        $config['phone']   = ( isset($specs->phone) )   ? $specs->phone   : 'false';
				        
                        if ( defined('WPLANG') && WPLANG != '' && isset($this->PraizedXHTML->themes[WPLANG]) )
				        	$config['lang'] = WPLANG;
                        
                        if ( FALSE == $dynamic ) {
                	        if ( FALSE == ( $data = $this->_get_static($static_key) ) ) {
                	            if ( FALSE != ( $data = $this->merchant_get($specs->pid) ) ) {
                	                $this->_save_static($static_key, $data);
                	                break;
                	            }
                	        }
                	    } elseif ( FALSE == ( $data = $this->merchant_get($specs->pid) ) ) {
                	        break;
                	    }
                	    
                	    if ( isset($aggregate) && is_object($data->merchant) )
                	        $aggregate->merchants[] = $data->merchant;
        	            
                	    break;
                    default:
                        $specs->limit = ( intval($specs->limit) > 25 ) ? 25 : $specs->limit;
                        
                        $type = 'list';
                        
                        $config['query']    = ( isset($specs->query) )    ? $specs->query    : '';
                        $config['location'] = ( isset($specs->location) ) ? $specs->location : '';
                        $config['limit']    = ( isset($specs->limit) )    ? $specs->limit    : 5;
                        $config['address']  = ( isset($specs->address) ) ? $specs->address : 'false';
                        
                        if ( FALSE == $dynamic ) {
                	        if ( FALSE == ( $data = $this->_get_static($static_key) ) ) {
                	            if ( FALSE != ( $data = $this->merchants_search($config['query'], $config['location'], $config['limit']) ) ) {
                	                $this->_save_static($static_key, $data);
                	                break;
                	            }
                	        }
                	    } elseif ( FALSE == ( $data = $this->merchants_search($config['query'], $config['location'], $config['limit']) ) ) {
                	        break;
                	    }
                	    
                	    if ( isset($aggregate) && is_array($data->merchants) )
                	        $aggregate->merchants = array_merge($aggregate->merchants, $data->merchants);
                        
                	    break;
                }
                
                if ( isset($data) && ( is_object($data) || is_array($data) ) )
                    $replacement = ( $xhtml = $this->_xhtml($data, $type, $config) ) ? $xhtml : '';
                
                $content = str_replace($original, $replacement, $content);
            }
	    }
        
	    if ( isset($aggregate) ) {
            if ( count($aggregate->merchants) > 0 )
                $aggregate = $this->_aggregate_duplicate_test($aggregate);
            
            if ( $urls ) {
                $limit = 0;
                
                if ( isset($urls['pids']) )
                    $limit += count($urls['pids']);
                
                if ( isset($urls['permalinks']) )
                    $limit += count($urls['permalinks']);
                
                if ( isset($urls['short_urls']) )
                    $limit += count($urls['permalinks']);
                
                if ( $limit == 0 )
                    $limit = 10;
                elseif ( $limit > 25 )
                    $limit = 25;
                
                if ( $urls_merchants = $this->merchants_resolve($urls, $limit) ) {
                    if ( ! isset($aggregate->community) )
                        $aggregate->community = $urls_merchants->community;
                    $aggregate->merchants = array_merge($aggregate->merchants, $urls_merchants->merchants);
                    $aggregate = $this->_aggregate_duplicate_test($aggregate);
                }
            }
            
            if ( count($aggregate->merchants) > 0 ) {
                if ( ! isset($aggregate->community) )
                    $aggregate->community = $data->community;
                
				$captions = array(
					'tags'       => $this->__('Tags'),
					'favorers'   => $this->__('favorers'),
					'praizers'   => $this->__('praizers'),
				    'comments'   => $this->__('comments'),
					'must_login' => $this->__('You must login before you can vote! - Just click, we\'ll take you there and back!'),
					'vote_up'    => $this->__('Vote Up'),
					'vote_down'  => $this->__('Vote Down')
				);
                
                $display_options = array(
                    'hide_vote'    => $this->_config['hide_vote'],
                    'hide_tags'    => $this->_config['hide_tags'],
                    'hide_stats'   => $this->_config['hide_stats'],
                	'translations' => $captions,
				    'lang'         => ( defined('WPLANG') && WPLANG != '' && isset($this->PraizedXHTML->themes[WPLANG]) ) ? WPLANG : ''
                );

                if ( $xhtml = $this->_xhtml($aggregate, 'hcard_list', $display_options ) ) {
                    $content .= "\n\n<h3>"
                             .  sprintf(
                             		$this->__('Places mentioned in %s'),
                                    ( is_page() ) ? $this->__('this page') : $this->__('this post')
                                )
                             . "</h3>\n";
                    $content .= $xhtml;
                }
            }
        }
        
        $this->_set_cache($cache_key, $content);
	    
	    return $content;
	}
	
	/**
	 * WP Filter: Applied to the post/page content retrieved from the database, prior to printing on the screen
	 *
	 * @param string $content Post/page content
	 * @return string Modified post/page content
	 * @since 0.1
	 */
	function wp_filter_the_content($content) {
	    return $this->_parse_merchants($content, $this->_config['aggregate']);
	}
	
	/**
	 * WP Widget: Merchant display 
	 *
	 * @param array $args
	 * @since 0.1
	 */
	function widget_bbcode($args = array()) {
	    extract($args);
	    
	    $widget_id = $this->_wdgt_bbcode_key;
	    $config    = $this->_get_wp_option($widget_id);
	    
	    if ( ! is_array($config) || ! isset($config['content']) || empty($config['content']) )
	        return;
	    elseif ( ! ($xhtml = $this->_parse_merchants(stripslashes($config['content']), FALSE)) )
	        return;
	    
	    echo $before_widget; // WP STANDARD	    
	    echo '<li id="'.$widget_id.'" class="widget '.$widget_id.'">';
	    
	    $title = ( $config['wdgt_title'] != '' ) ? $config['wdgt_title'] : $this->__('Praized');
	    
	    echo $before_title;  // WP STANDARD
	    echo '<h2>'.$title.'</h2>';
	    echo $after_title;   // WP STANDARD

        echo $xhtml;

	    echo "\n</li>\n";
	    echo $after_widget;  // WP STANDARD
	}
	
	/**
	 * Widget: Latest activity
	 * 
	 * @param array $args WP standard
	 * @since 2.0
	 */
	function widget_latest_activity($args = array()) {
	 	// no need to show the search form when it's already shown in the main content area
	 	global $PraizedCommunity;
	 	if ( isset($PraizedCommunity) && $PraizedCommunity->_route_is_actions )
			return;
	 	
	 	extract($args);
	    
        $widget_id = $this->_wdgt_latest_activity_key;
        $config    = $this->_get_wp_option($widget_id);
        	    
	    $title = ( $config['title'] != '' ) ? $config['title'] : $this->__('Praized: Latest Activity');
	    $limit = ( $config['limit'] != '' ) ? $config['limit'] : 5;
        
        $data = $this->actions_get(array('per_page' => $limit));
        
        if ( ! isset($data->actions) || ! is_array($data->actions) || empty($data->actions) )
        	return; 
        
        echo $before_widget; // WP STANDARD	    
        echo '<li id="'.$widget_id.'" class="widget '.$widget_id.'">';
	    
	    echo $before_title;  // WP STANDARD
	    echo '<h2 class="widgettitle">'.$title.'</h2>';
	    echo $after_title;   // WP STANDARD
        
        echo '<div class="praized-actions-listing">';

		foreach ( $data->actions as $action ) {
		    echo "<div id=\"praized-action-".md5($action->summary)."\" class=\"praized-tools-widget-item\">";
		    echo $action->summary;
		    echo "</div>";
		}
		
		echo '</div>';
        
        echo "\n</li>\n";
        echo $after_widget;  // WP STANDARD
	}
	
	/**
	 * Widget: Latest questions
	 * 
	 * @param array $args WP standard
	 * @since 2.0
	 */
	function widget_latest_questions($args = array()) {
	 	// no need to show the search form when it's already shown in the main content area
	 	global $PraizedCommunity;
	 	if ( isset($PraizedCommunity) && $PraizedCommunity->_route_is_questions )
			return;
	 	
	 	extract($args);
	    
        $widget_id = $this->_wdgt_latest_questions_key;
        $config    = $this->_get_wp_option($widget_id);
        	    
	    $title = ( $config['title'] != '' ) ? $config['title'] : $this->__('Praized: Latest Questions');
	    $limit = ( $config['limit'] != '' ) ? $config['limit'] : 5;
        
        $data = $this->questions_get(array('per_page' => $limit));
        
        if ( ! isset($data->questions) || ! is_array($data->questions) || empty($data->questions) )
        	return; 
        
        echo $before_widget; // WP STANDARD	    
        echo '<li id="'.$widget_id.'" class="widget '.$widget_id.'">';
	    
	    echo $before_title;  // WP STANDARD
	    echo '<h2 class="widgettitle">'.$title.'</h2>';
	    echo $after_title;   // WP STANDARD
        
        echo '<div class="praized-questions-listing">';
        
		foreach ( $data->questions as $question ) {
		    echo "<div id=\"praized-question-".md5($question->content)."\" class=\"praized-tools-widget-item\">";
		    echo '<a href="'.$question->permalink.'">'.$question->content.'</a>';
		    echo "</div>";
		}
		
		echo '</div>';
        
        echo "\n</li>\n";
        echo $after_widget;  // WP STANDARD
	}
}
?>