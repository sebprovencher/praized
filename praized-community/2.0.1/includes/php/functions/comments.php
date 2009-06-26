<?php
/**
 * Praized template functions/helpers/tags: comment listing related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Tests if the current merchant truly has a comment list
 * 
 * <code><?php if ( pzdc_has_comments() ) : ?>...<?php endif; ?></code>
 *
 * @param array $query Optional query for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 0.1
 */
function pzdc_has_comments($query = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_comments($query);
}

/**
 * Template function: Praized equivalent of the WP "the_loop" for the current merchant's comment list, usually used in while loop
 * 
 * <code><?php while ( pzdc_comments_loop() ) : ?>...<?php endwhile; ?></code>
 *
 * @param array $query Optional query for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 0.1
 */
function pzdc_comments_loop($query = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_comments_loop($query);
}

/**
 * Template function: Tests if there is a next entry in the current loop
 * 
 * <code><?php if ( pzdc_has_next_comment() ) : ?>...<?php endif; ?></code>
 *
 * @return boolean
 * @since 0.1
 */
function pzdc_has_next_comment() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_next_comment;
}
?>