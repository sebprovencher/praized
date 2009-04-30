<?php
/**
 * Praized template functions/helpers/tags: merchants listing/search related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
    
/**
 * Template function: Tests if a valid merchants list is set.
 * @note: should be used before using merchants related functions.
 *
 * @param array $query Optional query for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 0.1
 */
function pzdc_has_merchants($query = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_merchants($query);
}

/**
 * Template function: Praized equivalent of the WP "the_loop" for the current merchant list, usually used in while loop
 *
 * @param array $query Optional query for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 0.1
 */
function pzdc_merchants_loop($query = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_merchants_loop($query);
}

/**
 * Template function: Tests if there is a next entry in the current loop
 *
 * @return boolean
 * @since 0.1
 */
function pzdc_has_next_merchant() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_next_merchant;
}
?>