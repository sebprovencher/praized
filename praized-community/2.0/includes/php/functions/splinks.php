<?php
/**
 * Praized template functions/helpers/tags: sponsored links listing related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Tests if the current merchant truly has a sponsored links
 * list.  Will only work in the right views (ie: individual merchant show, not
 * listings)
 * 
 * <code><?php if ( pzdc_has_splinks() ) : ?>...<?php endif; ?></code>
 *
 * @return boolean
 * @since 0.1
 */
function pzdc_has_splinks() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_splinks();
}

/**
 * Template function: Praized equivalent of the WP "the_loop" for the current
 * merchant's sponsored links list, usually used in while loop. Will only work
 * in the right views (ie: individual merchant show, not listings)
 * 
 * <code><?php while ( pzdc_splinks_loop() ) : ?>...<?php endwhile; ?></code>
 *
 * @return boolean
 * @since 0.1
 */
function pzdc_splinks_loop() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_splinks_loop();
}

/**
 * Template function: Tests if there is a next entry in the current loop
 * 
 * <code><?php if ( pzdc_has_next_splink() ) : ?>...<?php endif; ?></code>
 *
 * @return boolean
 * @since 0.1
 */
function pzdc_has_next_splink() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_next_splink;
}
?>