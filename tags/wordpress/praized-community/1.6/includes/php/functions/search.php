<?php
/**
 * Praized template functions/helpers/tags: miscelaneous search related functions
 * 
 * @version 1.6
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury
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
    if ( isset($_GET['q']) && empty($_GET['q']) && isset($_GET['l']) && empty($_GET['l']) ) {
        // We still need users to be able to overwrite the defaults and submit an
        // "Everything + Everywhere" query, but only when the form is truly submitted.
        $out = '';
    } else {
        $out = ( ! empty($_GET['q']) )
             ? pzdc_stripper($_GET['q'])
             : ( ( ! empty($_GET['l']) )
                 ? ''
                 : $PraizedCommunity->_config['default_query'] );
    }
    if ( $echo )
        echo $out;
    return $out;
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
    if ( isset($_GET['q']) && empty($_GET['q']) && isset($_GET['l']) && empty($_GET['l']) ) {
        // We still need users to be able to overwrite the defaults and submit an
        // "Everything + Everywhere" query, but only when the form is truly submitted.
        $out = '';
    } else {
        $out = ( ! empty($_GET['l']) )
             ? pzdc_stripper($_GET['l'])
             : ( ( ! empty($_GET['q']) )
                 ? ''
                 : $PraizedCommunity->_config['default_location'] );
    }
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current merchants tag search term (?t= or ?tag=)
 * 
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_search_tag($echo = TRUE) {
    global $PraizedCommunity;
    if ( isset($_GET['tag']) )
        $out = pzdc_stripper($_GET['tag']);
    else
        $out = pzdc_stripper($_GET['t']);
    if ( $echo )
        echo $out;
    return $out;
}
?>