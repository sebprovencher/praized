<?php
/**
 * Praized template functions/helpers/tags: answer listing related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */


/**
 * Template function: Tests if the current merchant truly has a answer list
 *
 * @param array $query Optional query for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 1.6
 */
function pzdc_has_answers($query = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_answers($query);
}

/**
 * Template function: Praized equivalent of the WP "the_loop" for the current answers list, usually used in while loop
 *
 * @param array $query Optional query for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 1.6
 */
function pzdc_answers_loop($query = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_answers_loop($query);
}

/**
 * Template function: Tests if there is a next entry in the current loop
 *
 * @return boolean
 * @since 1.6
 */
function pzdc_has_next_answer() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_next_answer;
}
?>