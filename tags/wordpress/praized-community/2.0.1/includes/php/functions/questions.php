<?php
/**
 * Praized template functions/helpers/tags: question listing related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */


/**
 * Template function: Tests if the current merchant truly has a question list
 *
 * @param array $query Optional query for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 1.6
 */
function pzdc_has_questions($query = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_questions($query);
}

/**
 * Template function: Praized equivalent of the WP "the_loop" for the current questions list, usually used in while loop
 *
 * @param array $query Optional query for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 1.6
 */
function pzdc_questions_loop($query = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_questions_loop($query);
}

/**
 * Template function: Tests if there is a next entry in the current loop
 *
 * @return boolean
 * @since 1.6
 */
function pzdc_has_next_question() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_next_question;
}

/**
 * Template function: Returns a random string of the proper requested type for the fancy question form
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_questions_random_qualifier($type, $echo = TRUE) {
    $adjective = array(pzdc__('good'), pzdc__('cheap'), pzdc__('fancy'), pzdc__('respectable'));
    $what = array(pzdc__('restaurant'), pzdc__('cafe'), pzdc__('mechanic'));
    $where = ( $w = pzdc_search_location(FALSE) ) ? array($w) : array(pzdc__('Montreal'), pzdc__('San Francisco'), pzdc__('New York'));
    if ( $type != 'what' && $type != 'where' )
        $type = 'adjective';
    $array = $$type;
    shuffle($array);
    if ( $echo )
        echo $array[0];
    return $array[0];
}

/**
 * Template function: Returns a list of the current user's configured broadcast services as checkboxes.
 * 
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.6
 */
function pzdc_questions_user_broadcast_services($echo = TRUE) {
	global $PraizedCommunity;
	return $PraizedCommunity->tpt_questions_user_broadcast_services($echo);
}
?>