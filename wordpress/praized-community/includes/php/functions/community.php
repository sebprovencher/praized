<?php
/**
 * Praized template functions/helpers/tags: community related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Current community object
 * 
 * <code><?php $community_object = pzdc_community(); ?></code>
 *
 * @return mixed Boolean FALSE or Object instance
 * @since 0.1
 */
function pzdc_community() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_community;
}

/**
 * Template function: Current community name
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_community_name($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('community', 'name', $echo);
}

/**
 * Template function: Current community base url
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_community_base_url($echo = TRUE) {
    global $PraizedCommunity;
    $out = rtrim($PraizedCommunity->trigger_url, '/');
    if ( $echo )
        echo $out; 
    return $out;
}

/**
 * Template function: Current community slug
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_community_slug($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('community', 'slug', $echo);
}

/**
 * Template function: Current community home url (usually the parent site)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_community_home_url($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('community', 'home_url', $echo);
}

/**
 * Template function: Current community type (hub or not)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_community_type($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('community', 'type', $echo);
}

/**
 * Template function: Defines if a community is a hub or not
 *
 * @return boolean
 * @since 2.0
 */
function pzdc_community_is_hub() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_community_is_hub();
}
?>