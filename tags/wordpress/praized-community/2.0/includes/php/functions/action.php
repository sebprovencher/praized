<?php
/**
 * Praized template functions/helpers/tags: individual merchant action related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Tests if the current merchant truly has an action
 *
 * @return boolean
 * @since 1.5
 */
function pzdc_has_action() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_action();
}

/**
 * Template function: Current action summary (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.5
 */
function pzdc_action_summary($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('action', 'summary', $echo);
}

/**
 * Template function: Current action creation date (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $format strftime type format string
 * @return string
 * @since 1.5
 */
function pzdc_action_created_at($echo = TRUE, $format = NULL) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('action', 'created_at', FALSE);
    if ( strstr($format, '%'))
        $out = pzdc_date($out, $format);
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current action type (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.5
 */
function pzdc_action_type($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('action', 'action_type->type_name', $echo);
}

/**
 * Template function: Current action comment body (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.5
 */
function pzdc_action_comment_body($echo = TRUE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('action', 'targets', FALSE);
    $html = ( $out[0] && $out[0]->comment && $out[0]->comment->comment ) ? $out[0]->comment->comment : FALSE;
    if ( $echo )
        echo $html;
    return $html;
}

/**
 * Template function: Current Question content (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_action_question_content($echo = TRUE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('action', 'targets', FALSE);
    $html = ( $out[0] && $out[0]->question && $out[0]->question->content ) ? $out[0]->question->content : FALSE;
    if ( ! $html )
    	return;
    if ( $echo )
        echo $html;
    return $html;
}

/**
 * Template function: Current Answer content (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_action_answer_content($echo = TRUE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('action', 'targets', FALSE);
    $answer = ( $out[0] && $out[0]->answer ) ? $out[0]->answer : FALSE;
    if ( ! $answer )
    	return;
    $html = $PraizedCommunity->tpt_answer_content(FALSE, $answer);
    if ( $echo )
        echo $html;
    return $html;
}

/**
 * Template function: Current Answer attached merchants (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_action_answer_merchants($echo = TRUE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('action', 'targets', FALSE);
    $merchants = ( $out[0] && $out[0]->answer && $out[0]->answer->merchants ) ? $out[0]->answer->merchants : FALSE;
    if ( ! $merchants )
    	return;
    $html = $PraizedCommunity->tpt_merchants_simple_list($merchants);
    if ( $echo )
        echo $html;
    return $html;
}

/**
 * Template function: Current action community name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_action_community_name($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('action', 'community->name', $echo);
}

/**
 * Template function: Current action community base url (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 2.0
 */
function pzdc_action_community_base_url($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('action', 'community->base_url', $echo);
}
?>