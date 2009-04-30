<?php
/**
 * Praized template functions/helpers/tags: individual vote related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Current tag name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_vote_rating($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('vote', 'rating', $echo);
}


/**
 * Template function: Current vote created date (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_vote_created_at($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('vote', 'created_at', $echo);
}

/**
 * Template function: Current vote community name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_vote_community_name($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('vote', 'community->name', $echo);
}

/**
 * Template function: Current vote community base url (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_vote_community_base_url($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('vote', 'community->base_url', $echo);
}
?>