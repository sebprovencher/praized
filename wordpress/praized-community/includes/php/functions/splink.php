<?php
/**
 * Praized template functions/helpers/tags: sponsored links related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
    	
/**
 * Template function: Current sponsored link label
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_splink_label($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('splink', 'label', $echo);
}


/**
 * Template function: Current sponsored link url
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_splink_url($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('splink', 'url', $echo);
}


/**
 * Template function: Current sponsored link ordering index
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_splink_order($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('splink', 'order', $echo);
}
?>