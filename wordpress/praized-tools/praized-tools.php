<?php
/**
 * Plugin Name:  Praized Tools
 * Plugin URI:   http://wordpress.org/extend/plugins/praized-tools/
 * Version:      2.0
 * Description:  The Praized Tools plugin is primarily a companion tool for our <a href="http://wordpress.org/extend/plugins/praized-community/"><strong>Praized Community</strong></a> plugin. It will enable new editorial tools within WordPress for you to blog about places and tie everything back to your own Praized Community. When running the Praized Tools without a Praized Community, the plugin will integrate with our <a href="http://praized.com/">Praized.com</a> hub instead. See also: the <a href="http://wordpress.org/extend/plugins/praized-community/">Praized Community</a> plugin.
 * Author:       <a href="http://www.praizedmedia.com/">Praized Media, Inc.</a>
 * 
 * @version 2.0
 * @package PraizedTools
 * @subpackage PluginInit
 * @author Stephane Daury for Praized Media, Inc.
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

if ( ! class_exists('PraizedTools')) {
    /**
     * Include Praized Tools Class
     */
    require_once(dirname(realpath(__FILE__)).'/includes/php/PraizedTools.php');

    /**
     * Include ButtonSnap.
     * Needs to be loaded outside the class in order to work right
     */
    if ( ! class_exists('buttonsnap') )
        require_once(dirname(realpath(__FILE__)) . '/includes/php/vendor/buttonsnap.php');
    if ( ! class_exists('buttonsnap2') )
        require_once(dirname(realpath(__FILE__)) . '/includes/php/vendor/buttonsnap2.php');
    
    /**
     * Praized Tools Init
     * @note: loaded on plugins_loaded WP action, mainly so the widgets show at
     * the top instead of the bottom of the list in the design admin screen...
     * 
     * @since 0.1
     */
    function praized_tools_init() {
        global $PraizedTools;
        
        if ( ! is_object($PraizedTools)) {
            $PraizedTools = new PraizedTools();

    		if ( is_admin() ) {
    			$PraizedTools->admin_tools();
    		} else {
    			$PraizedTools->display_tools();
    		}
    		
    		if ( function_exists('register_sidebar_widget') ){
                register_sidebar_widget(array('Praized: Search Query', $PraizedTools->_plugin_name), 'widget_pzdt_bbcode');
                register_sidebar_widget(array('Praized: Latest Activity', $PraizedTools->_plugin_name), 'widget_pzdt_latest_activity');
                register_sidebar_widget(array('Praized: Latest Questions', $PraizedTools->_plugin_name), 'widget_pzdt_latest_questions');
                
                if ( is_admin() ) {
                    register_widget_control(array('Praized: Search Query', $PraizedTools->_plugin_name), 'widget_pzdt_bbcode_options_form', 550, 270);
                    register_widget_control(array('Praized: Latest Activity', $PraizedTools->_plugin_name), 'widget_pzdt_latest_activity_options_form');
                    register_widget_control(array('Praized: Latest Questions', $PraizedTools->_plugin_name), 'widget_pzdt_latest_questions_options_form');
                }
    		}
        }
    }
    
    /**
     * Start this plugin once all other plugins are fully loaded
     */
    add_action( 'plugins_loaded', 'praized_tools_init' );
    
    /**
     * Widget: Praized Tools Merchant
     * 
     * @since 0.1
     */
    function widget_pzdt_bbcode() {
        global $PraizedTools;
        $PraizedTools->widget_bbcode();
    }
    
    /**
     * Widget option form: Praized Tools Merchant
     * 
     * @since 0.1
     */
    function widget_pzdt_bbcode_options_form() {
        global $PraizedTools;
        $PraizedTools->widget_bbcode_options_form();
    }
    
    /**
     * Widget option form: Praized Tools Activity
     * 
     * @since 0.1
     */
    function widget_pzdt_latest_activity_options_form() {
        global $PraizedTools;
        $PraizedTools->widget_latest_activity_options_form();
    }
    
    /**
     * Widget: Praized Tools Activity
     * 
     * @since 0.1
     */
    function widget_pzdt_latest_activity() {
        global $PraizedTools;
        $PraizedTools->widget_latest_activity();
    }
    
    /**
     * Widget option form: Praized Tools Questions
     * 
     * @since 0.1
     */
    function widget_pzdt_latest_questions_options_form() {
        global $PraizedTools;
        $PraizedTools->widget_latest_questions_options_form();
    }
    
    /**
     * Widget: Praized Tools Questions
     * 
     * @since 0.1
     */
    function widget_pzdt_latest_questions() {
        global $PraizedTools;
        $PraizedTools->widget_latest_questions();
    }
    
    /**
     * Praized API integration function: Merchant List
     * Allows you to integrate (read-only) with our API directly within your own plugin and/or theme.
     *
     * @param array $query Associative array matching the query string keys supported by the Praized API.
     * @return array List of merchants objects as returned by the Praize API
     * @since 0.1
     */
    function pzdt_merchants_get($query = array()) {
        global $PraizedTools;
        return $PraizedTools->merchants_get($query);
    }
    
    /**
     * Praized API integration function: Merchant Search
     * 
     * Allows you to integrate (read-only) with our API directly within your own plugin and/or theme.
     *
     * @param string $term Search term
     * @param string $location City/location
     * @param integer $limit Resultset limit
     * @param array $extra_query Supplemental query parameters (details, etc)
     * @return array List of merchants objects as returned by the Praize API
     * @since 0.1
     */
    function pzdt_merchants_search($term = '', $location = '', $limit = 10, $extra_query = array()) {
        global $PraizedTools;
        return $PraizedTools->merchants_search($term, $location, $limit, $extra_query);
    }
    
    /**
     * Praized API integration function: Individual Merchant
     * 
     * Allows you to integrate (read-only) with our API directly within your own plugin and/or theme.
     *
     * @param string $pid Merchant PID
     * @param array  $query Associative array matching the query string keys supported by the Praized API.
     * @return object Merchants object as returned by the Praize API
     * @since 0.1
     */
    function pzdt_merchant_get($pid, $query = array()) {
        global $PraizedTools;
        return $PraizedTools->merchant_get($pid, $query);
    }
    
    /**
     * Praized API integration function: Individual User
     * 
     * Allows you to integrate (read-only) with our API directly within your own plugin and/or theme.
     *
     * @param string $username Praized user id
     * @param array  $query Associative array matching the query string keys supported by the Praized API.
     * @return object User object as returned by the Praize API
     * @since 0.1
     */
    function pzdt_user_get($username, $query = array()) {
        global $PraizedTools;
        return $PraizedTools->user_get($username, $query);
    }
    
    /**
     * Praized API integration function: Activity List
     * Allows you to integrate (read-only) with our API directly within your own plugin and/or theme.
     *
     * @param array $query Associative array matching the query string keys supported by the Praized API.
     * @return array List of merchants objects as returned by the Praize API
     * @since 2.0
     */
    function pzdt_actions_get($query = array()) {
        global $PraizedTools;
        return $PraizedTools->actions_get($query);
    }
    
    /**
     * Praized API integration function: Activity List
     * Allows you to integrate (read-only) with our API directly within your own plugin and/or theme.
     *
     * @param array $query Associative array matching the query string keys supported by the Praized API.
     * @return array List of merchants objects as returned by the Praize API
     * @since 2.0
     */
    function pzdt_questions_get($query = array()) {
        global $PraizedTools;
        return $PraizedTools->questions_get($query);
    }
}

?>