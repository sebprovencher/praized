<?php
/**
 * Praized template functions/helpers/tags: miscelaneous search related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
    	
/**
 * Template function: Merchants search action url
 * 
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_search_link($echo = TRUE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->link_helper("/search", 'merchant');
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current merchants search term (?q=)
 * 
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_search_query($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_search_query($echo);
}

/**
 * Template function: Current merchants location query (?l=)
 * 
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_search_location($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_search_location($echo);
}

/**
 * Template function: Current merchants tag search term (?t= or ?tag= or ?category= or from route)
 * 
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_search_tag($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_search_tag($echo);
}

/**
 * Template function: returns the info to be displayed between the search form and result
 * 
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 1.7
 */
function pzdc_search_results_info($echo = TRUE) {
    global $PraizedCommunity;
    $PraizedCommunity->tpt_search_results_info($echo);
}
?>