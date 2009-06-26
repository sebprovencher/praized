<?php
/**
 * Praized template functions/helpers/tags: hub community related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */


/**
 * Template function: Tests if a valid hub community object is set.
 * @note: should be used before using hub community related functions.
 *
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return boolean
 * @since 2.0
 */
function pzdc_has_hub_community() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_hub_community();
}

/**
 * Template function: Current hub community object
 * 
 * <code><?php $hub_community_object = pzdc_hub_community(); ?></code>
 *
 * @return mixed Boolean FALSE or Object instance
 * @since 2.0
 */
function pzdc_hub_community() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_hub_community;
}

/**
 * Template function: Current hub community name
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_hub_community_name($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('hub_community', 'name', $echo);
}

/**
 * Template function: Current hub community base url
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_hub_community_base_url($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('hub_community', 'base_url', $echo);
}

/**
 * Template function: Current hub community slug
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_hub_community_slug($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('hub_community', 'slug', $echo);
}

/**
 * Template function: Current hub community home url (usually the parent site)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_hub_community_home_url($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('hub_community', 'home_url', $echo);
}

/**
 * Template function: Current hub community type (hub or not)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_hub_community_type($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('hub_community', 'type', $echo);
}

/**
 * Template function: Defines if a hub community is also a hub itself or not
 *
 * @return boolean
 * @since 2.0
 */
function pzdc_hub_community_is_hub() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_community_is_hub($PraizedCommunity->tpt_hub_community);
}
?>