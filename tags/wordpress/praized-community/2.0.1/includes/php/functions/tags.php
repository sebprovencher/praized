<?php
/**
 * Praized template functions/helpers/tags: merchant tag listing related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */


/**
 * Template function: Tests if the current merchant truly has a tag list
 *
 * @return boolean
 * @since 0.1
 */
function pzdc_has_tags() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_tags();
}

/**
 * Template function: Praized equivalent of the WP "the_loop" for the current merchant's tag list, usually used in while loop
 *
 * @return boolean
 * @since 0.1
 */
function pzdc_tags_loop() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_tags_loop();
}

/**
 * Template function: Tests if there is a next entry in the current loop
 *
 * @return boolean
 * @since 0.1
 */
function pzdc_has_next_tag() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_next_tag;
}
?>