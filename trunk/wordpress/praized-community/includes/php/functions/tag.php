<?php
/**
 * Praized template functions/helpers/tags: individual merchant tag related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Current tag name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_tag_name($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('tag', 'name', $echo);
}


/**
 * Template function: Current tag permalink (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_tag_link($echo = TRUE) {
    global $PraizedCommunity;
    if ( $tag = pzdc_tag_name(FALSE) ) {
        $out = $PraizedCommunity->link_helper("/category/$tag", 'merchant');
        if ( $echo )
            echo $out;
    }
    return $out;
}

?>