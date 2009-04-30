<?php
/**
 * Praized template functions/helpers/tags: miscelaneous Praized.com Hub related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
    	
/**
 * Template function: Returns the fully qualified link to the "add a place" process on the Praized.com Hub
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return mixed Boolean FALSE or String URL
 * @since 0.1
 */
function pzdc_hub_add_place($echo = TRUE) {
    return pzdc_link('add_place', $echo);
}

/**
 * Template function: Returns the fully qualified link to the communities directory on the Praized.com Hub
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return mixed Boolean FALSE or String URL
 * @since 0.1
 */
function pzdc_hub_communities($echo = TRUE) {
    return pzdc_link('communities', $echo);
}

/**
 * Template function: Returns the fully qualified link to the current user's profile on the Praized.com Hub
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return mixed Boolean FALSE or String URL
 * @since 0.1
 */
function pzdc_hub_user_profile($echo = TRUE) {
    return pzdc_link('user_profile', $echo);
}
?>