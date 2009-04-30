<?php
/**
 * Praized template functions/helpers/tags: friend listing related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Tests if the current user truly has a friend/favorer list
 * 
 * <code><?php if ( pzdc_has_friends() ) : ?>...<?php endif; ?></code>
 *
 * @param array $query Optional query for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 0.1
 */
function pzdc_has_friends($query = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_friends($query);
}

/**
 * Template function: Praized equivalent of the WP "the_loop" for the current user friend list, usually used in while loop
 * 
 * <code><?php while ( pzdc_friends_loop() ) : ?>...<?php endwhile; ?></code>
 *
 * @param array $query Optional query for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 0.1
 */
function pzdc_friends_loop($query = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_friends_loop($query);
}

/**
 * Template function: Tests if there is a next entry in the current loop
 * 
 * <code><?php if ( pzdc_has_next_friend() ) : ?>...<?php endif; ?></code>
 *
 * @return boolean
 * @since 0.1
 */
function pzdc_has_next_friend() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_next_friend;
}
?>