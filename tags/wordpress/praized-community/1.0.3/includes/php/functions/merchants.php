<?php
/**
 * Praized template functions/helpers/tags: merchants listing/search related functions
 * 
 * @version 1.0.3
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
    
/**
 * Template function: Tests if a valid merchants list is set.
 * @note: should be used before using merchants related functions.
 *
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
function pzdc_has_next_merchant($query = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_next_merchant;
}
?>