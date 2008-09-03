<?php
/**
 * Praized template functions/helpers/tags: miscelaneous helpers related functions
 * 
 * @version 1.0.4
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
    	
/**
 * Template function: Convenience localization function, adds the proper text domain [RETURNS]
 * 
 * <code><?php $text = pzdc__('My internationalized caption'); ?></code>
 *
 * @param string $str String to be translated/internationalized
 * @return string
 * @since 0.1
 */
function pzdc__($string) {
    global $PraizedCommunity;
    return $PraizedCommunity->__($string);
}

/**
 * Template function: Convenience localization function, adds the proper text domain [ECHOES]
 * 
 * <code><?php pzdc_e('My internationalized caption'); ?></code>
 *
 * @param string $str String to be translated/internationalized
 * @return string
 * @since 0.1
 */
function pzdc_e($string) {
    global $PraizedCommunity;
    $PraizedCommunity->_e($string);
}

/**
 * Strips most undesirable things from strings to be printed onscreen or sent to the API (htmlspecialchars(strip_tags(stripslashes(urldecode($string))))).
 *
 * @param string $val Value to be cleaned up
 * @return string sanitized string (note: not a security panacea)
 * @since 0.1
 */
function pzdc_stripper($string) {
    global $PraizedCommunity;
    return $PraizedCommunity->stripper($string);
}

/**
 * Template function: Returns the desired common Praized links.
 *
 * @param string $link Key in PraizedCommunity::Praized->praizedLinks
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return mixed Boolean FALSE or String link
 * @since 0.1
 */
function pzdc_link($link, $echo = TRUE) {
    global $PraizedCommunity;
    $return = ( ! empty($PraizedCommunity->Praized->praizedLinks[$link]) )
        ? $PraizedCommunity->Praized->praizedLinks[$link]
        : FALSE;
    if ($echo)
        echo $return;
    return $return; 
}

/**
 * Template function: includes a user-defined or bundled template fragment.
 * Fragments start with an underscore (_), to be ommitted in $fragment, Ruby-on-Rails style.
 * 
 * Bundled fragments: {wp_plugins_path}/praized-community/includes/php/templates/{*}/_{*}.php
 * User-defined fragments: {wp_theme_path}/praized-community/{*}/_{*}.php
 * 
 * <code><?php pzdc_tpt_fragment('merchant/hcard'); ?></code>
 *
 * @param string $fragment
 */
function pzdc_tpt_fragment($fragment) {
    global $PraizedCommunity;
    $PraizedCommunity->fragment($fragment);
}

/**
 * Template function: Contextual page header
 *
 * @param string $separator
 * @param boolean $echo
 * @since 0.1
 */
function pzdc_page_header($separator = '&raquo;', $echo = TRUE) {
    global $PraizedCommunity;
    $header = $PraizedCommunity->page_header($separator);
    if ( $echo )
        echo $header;
    return $header;
}

/**
 * Template function: returns an image tag of a Google Static Map for the requested geo-coordinates.
 * 
 * <code><?php pzdc_map(45.50493, -73.568163); ?></code>
 *
 * @param float $latitude
 * @param float $longitude
 * @param array $raw_params Optional Google maps custom parameters (size, zoom, etc but except api_key)
 * @param string $caption Optional caption to be displayed in Google Map bubble when appropriate
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 */
function pzdc_map($latitude, $longitude, $raw_params = array(), $caption = '', $echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_map($latitude, $longitude, $raw_params, $caption, $echo);
}


/**
 * Template function: Returns the standard Praized credits.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return String
 * @since 0.1
 */
function pzdc_credits($echo = TRUE) {
    global $PraizedCommunity;
    $return = '<br /><p><small>' . $PraizedCommunity->Praized->credits() . '</small></p>';
    if ($echo)
        echo $return;
    return $return; 
}
?>