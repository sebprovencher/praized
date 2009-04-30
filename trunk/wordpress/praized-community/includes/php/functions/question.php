<?php
/**
 * Praized template functions/helpers/tags: individual question related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Tests if the current merchant truly has an question
 *
 * @return boolean
 * @since 1.6
 */
function pzdc_has_question() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_question();
}

/**
 * Template function: Current question pid (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_question_pid($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('question', 'pid', $echo);
}

/**
 * Template function: Current question permalink (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_question_permalink($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('question', 'permalink', $echo);
}

/**
 * Template function: Current question content (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_question_content($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('question', 'content', $echo);
}

/**
 * Template function: Current question "what" (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_question_what($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('question', 'what', $echo);
}

/**
 * Template function: Current question "where" (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_question_where($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('question', 'where', $echo);
}

/**
 * Template function: Current question "adjective" (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_question_adjective($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('question', 'adjective', $echo);
}

/**
 * Template function: Current question answer count (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_question_answer_count($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('question', 'answer_count', $echo);
}

/**
 * Template function: Current question creation date (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $format strftime type format string
 * @return string
 * @since 1.6
 */
function pzdc_question_created_at($echo = TRUE, $format = NULL) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('question', 'created_at', FALSE);
    if ( strstr($format, '%'))
        $out = pzdc_date($out, $format);
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current question update date (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $format strftime type format string
 * @return string
 * @since 1.6
 */
function pzdc_question_updated_at($echo = TRUE, $format = NULL) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('question', 'updated_at', FALSE);
    if ( strstr($format, '%'))
        $out = pzdc_date($out, $format);
    if ( $echo )
        echo $out;
    return $out;
}


/**
 * Template function: Returns an unordered list of merchants related to a specific structure question (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @return mixed Boolean FALSE or String unordered list of related merchants
 * @since 1.6
 */
function pzdc_question_related_merchants($echo = TRUE) {
	global $PraizedCommunity;
	$PraizedCommunity->tpt_question_related_merchants($echo);
}

/**
 * Template function: Current answer community name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_question_community_name($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('question', 'community->name', $echo);
}

/**
 * Template function: Current answer community base url (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_question_community_base_url($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('question', 'community->base_url', $echo);
}
?>