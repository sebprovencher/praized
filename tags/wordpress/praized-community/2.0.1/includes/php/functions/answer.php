<?php
/**
 * Praized template functions/helpers/tags: individual answer related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Tests if the current merchant truly has an answer
 *
 * @return boolean
 * @since 1.6
 */
function pzdc_has_answer() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_answer();
}

/**
 * Template function: Current answer pid (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_answer_pid($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('answer', 'pid', $echo);
}

/**
 * Template function: Current answer permalink (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_answer_permalink($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('answer', 'permalink', $echo);
}

/**
 * Template function: Current answer content (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_answer_content($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_answer_content($echo);
}

/**
 * Template function: Current answer creation date (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $format strftime type format string
 * @return string
 * @since 1.6
 */
function pzdc_answer_created_at($echo = TRUE, $format = NULL) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('answer', 'created_at', FALSE);
    if ( strstr($format, '%'))
        $out = pzdc_date($out, $format);
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current answer update date (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $format strftime type format string
 * @return string
 * @since 1.6
 */
function pzdc_answer_updated_at($echo = TRUE, $format = NULL) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('answer', 'updated_at', FALSE);
    if ( strstr($format, '%'))
        $out = pzdc_date($out, $format);
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Returns the list of merchants/places associated with an answer as <ul>
 *
 * @return string
 * @since 1.6
 */
function pzdc_answer_merchants() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_answer_merchants();
}

/**
 * Template function: Current answer community name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_answer_community_name($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('answer', 'community->name', $echo);
}

/**
 * Template function: Current answer community base url (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_answer_community_base_url($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('answer', 'community->base_url', $echo);
}
?>