<?php
/**
 * Plugin Name:  Praized Community
 * Plugin URI:   http://praizedmedia.com/en/wordpress/
 * Version:      1.0.3
 * Description:  The Praized Community plugin allows you to deploys a complete local search section including 17M+ North American place listings, social tools and search functionalities through your WordPress blog. You need a <a href="http://praizedmedia.com/en/api/">Praized API key</a> to use it. <strong>This plugin currently requires PHP5</strong>. See also: The <a href="http://praizedmedia.com/en/download/wordpress/">Praized Tools</a> plugin.
 * Author:       <a href="http://www.praizedmedia.com/">Praized Media, Inc.</a>
 * 
 * @version 1.0.3
 * @package PraizedCommunity
 * @subpackage PluginInit
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 * 
 * Copyright 2008 Praized Media, Inc. Licensed under the Apache
 * License, Version 2.0 (the "License"); you may not use this file except
 * in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0 Unless required by applicable
 * law or agreed to in writing, software distributed under the License is
 * distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied. See the License for the specific
 * language governing permissions and limitations under the License.
 */

if ( PHP_VERSION < 5 ) {
    
    /**
     * Outputs an nice WP notice if the plugin is activated under PHP < 5
     *
     * @since 1.0.1
     */
    function pzdc_nocompat_error() {
		echo '<div id="praized-community-error" class="error fade-ffffcc">';
		echo '<p>';
		_e('<strong>PRAIZED COMMUNITY WARNING</strong>:', 'praized-community');
		echo '<br />';
		_e('Sorry, this plugin requires PHP5 or above, but our <a href="http://praizedmedia.com/en/download/">Praized Tools</a> plugin is PHP4 compatible.', 'praized-community');
		echo '</p>';
		echo "</div>\n";
	}
	
	add_action( 'admin_notices', 'pzdc_nocompat_error' );

} else {
    
    if ( ! class_exists('PraizedCommunity')) {
        /**
         * Include Praized Tools Class
         */
        require_once(dirname(realpath(__FILE__)).'/includes/php/PraizedCommunity.php');
        
        /**
         * Praized Community Init
         * @note: loaded on init WP action
         * 
         * @since 0.1
         */
        function praized_community_init() {
            global $PraizedCommunity;
            
            if ( ! is_object($PraizedCommunity)) {
                $PraizedCommunity = new PraizedCommunity();
                
        		if ( is_admin() ) {
        			$PraizedCommunity->admin_tools();
        		} else {
        			$PraizedCommunity->display_tools();
        		}
            }
        }
        
        /**
         * Praized Community Init
         * @note: loaded on plugins_loaded WP action, mainly so the widgets show at
         * the top instead of the bottom of the list in the design admin screen...
         * 
         * @since 0.1
         */
        function praized_community_widget_init() {
            global $PraizedCommunity;
            
            if ( ! is_object($PraizedCommunity))
                praized_community_init();
            
            if ( function_exists('register_sidebar_widget') ){
                register_sidebar_widget(array('Praized: Search Form', $PraizedCommunity->_plugin_name), 'widget_pzdc_search_form');
                register_sidebar_widget(array('Praized: Session',  $PraizedCommunity->_plugin_name), 'widget_pzdc_auth_nav');
                    
                if ( is_admin() ) {
                    register_widget_control(array('Praized: Search Form', $PraizedCommunity->_plugin_name), 'widget_pzdc_search_form_options_form');
                    register_widget_control(array('Praized: Session', $PraizedCommunity->_plugin_name), 'widget_pzdc_auth_nav_options_form');
                }
            }
        }
        
        /**
         * Start the plugin
         */
        add_action( 'init', 'praized_community_init' );
        add_action( 'plugins_loaded', 'praized_community_widget_init' );
        
        /**
         * Load template functions
         */
        foreach (glob(dirname(realpath(__FILE__)).'/includes/php/functions/*.php') as $filename) {
            require_once($filename);
        }
        
        /**
         * Widget: Praized Tools Merchant
         * 
         * @since 0.1
         */
        function widget_pzdc_search_form() {
            global $PraizedCommunity;
            $PraizedCommunity->widget_search_form();
        }
        
        /**
         * Widget option form: Praized Search Form
         * 
         * @since 0.1
         */
        function widget_pzdc_search_form_options_form() {
            global $PraizedCommunity;
            $PraizedCommunity->widget_search_form_options_form();
        }
        
        /**
         * Widget: Praized Tools Merchant
         * 
         * @since 0.1
         */
        function widget_pzdc_auth_nav() {
            global $PraizedCommunity;
            $PraizedCommunity->widget_auth_nav();
        }
        
        /**
         * Widget option form: Praized Auth Nav
         * 
         * @since 0.1
         */
        function widget_pzdc_auth_nav_options_form() {
            global $PraizedCommunity;
            $PraizedCommunity->widget_auth_nav_options_form();
        }
    }
}
?>