<?php
/**
 * Praized template functions/helpers/tags: individual comment related functions
 * 
 * @version 1.0.2
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Current comment body
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_comment_body($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('comment', 'comment', $echo);
}

/**
 * Template function: Current comment body
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $format strftime() conversion specifiers
 * @param string 
 * @return string
 * @since 0.1
 */
function pzdc_comment_created_at($echo = TRUE, $format = NULL) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('comment', 'created_at', FALSE);
    if ( ! strstr($format, '%'))
        $format = $PraizedCommunity->__('%a, %B %e %Y, %H:%M:%S');
    $out = strftime($format, strtotime($out));
    if ( $echo )
        echo $out;
    return $out;
}
?>