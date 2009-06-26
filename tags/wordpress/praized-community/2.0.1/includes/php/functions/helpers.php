<?php
/**
 * Praized template functions/helpers/tags: miscelaneous helpers related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
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
 * Template function: Common date formatting, from standard api output (ISO 8601: 2008-06-18T15:42:28Z)
 *
 * @param string $date_str Date string as received from API (ISO 8601: 2008-06-18T15:42:28Z)
 * @param string $format strftime() conversion specifiers
 * @return string Formatted date
 * @since 1.5
 */
function pzdc_date($date_str, $format = NULL) {
    global $PraizedCommunity;
    if ( ! strstr($format, '%') )
        $format = $PraizedCommunity->__('%a, %B %e %Y, %H:%M:%S');
    return strftime($format, strtotime($date_str));
}

/**
 * Template function: Time distance helper
 * 
 * <code><?php pzdc_time_distance('January, 28th, 1975', FALSE); ?></code>
 *
 * @param mixed int|string $from Either a time in seconds, or a strtotime translatable string
 * @param boolean $echo
 * @return string How long ago was the $from from right now.
 * @since 1.5
 */
function pzdc_time_distance($from, $echo = TRUE) {
    global $PraizedCommunity;
    
    $translations = array(
		'lt_n_seconds'  => $PraizedCommunity->__('less than %d seconds ago'),
		'lt_a_minute'   => $PraizedCommunity->__('less than a minute ago'),
		'1_minute'      => $PraizedCommunity->__('1 minute ago'),
		'n_minutes'     => $PraizedCommunity->__('%d minutes ago'),
		'about_1_hour'  => $PraizedCommunity->__('about 1 hour ago'),
		'about_n_hours' => $PraizedCommunity->__('about %d hours ago'),
		'1_day'         => $PraizedCommunity->__('1 day ago'),
		'n_days'        => $PraizedCommunity->__('%d days ago'),
		'about_1_month' => $PraizedCommunity->__('about 1 month ago'),
		'n_months'      => $PraizedCommunity->__('%d months ago'),
		'about_1_year'  => $PraizedCommunity->__('about 1 year ago'),
		'over_1_year'   => $PraizedCommunity->__('over 1 year ago'),
		'over_n_years'  => $PraizedCommunity->__('over %d years ago')
	);
    
    return $PraizedCommunity->tpt_time_distance($from, $translations, $echo);
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
 * @since 0.1
 */
function pzdc_map($latitude, $longitude, $raw_params = array(), $caption = '', $echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_map($latitude, $longitude, $raw_params, $caption, $echo);
}

/**
 * Template function: Place picker searchlet script tag
 * 
 * <code><?php pzdc_place_picker_script(); ?></code>
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string html script tag
 * @since 1.6
 */
function pzdc_place_picker_script($echo = TRUE) {
    global $PraizedCommunity;
    if ( ! $PraizedCommunity->Praized )
    	return;
    $out = $PraizedCommunity->Praized->placePickerScript();
    if ( $echo )
    	echo $out;
    return $out;
}

/**
 * Template function: Returns the fully qualified link to the Praized functionality help.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @return mixed Boolean FALSE or String username
 * @since 1.7
 */
function pzdc_help_link($echo = TRUE) {
    global $PraizedCommunity;
    $link = $PraizedCommunity->trigger_url . '/help/';
    if ( $echo )
        echo $link;
    return $link;
}

/**
 * Template function: Returns the content of the remote help file.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @return string
 * @since 1.7
 */
function pzdc_help_content($echo = TRUE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_help_content;
    if ( ! $out || empty($out) )
    	return '';
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Prints errors found in required fields when dealing with forms such as user profile editing.
 * Based on state of $PraizedCommunity->tpt_missing_fields.
 * 
 * @return void
 * @since 2.0
 */
function pzdc_required_fields() {
	global $PraizedCommunity;
	$PraizedCommunity->required_fields();
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
    $return = '<br /><p><small>' . pzdc__('Powered by <a href="http://praizedmedia.com/">Praized Media</a>. US data provided by Localeze. Canadian business listings distributed by <a href="http://www.yellowpages.ca">YellowPages.ca™</a>.') . '</small></p>';
    if ( $echo )
        echo $return;
    return $return; 
}
?>