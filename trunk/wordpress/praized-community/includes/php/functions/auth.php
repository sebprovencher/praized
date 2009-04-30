<?php
/**
 * Praized template functions/helpers/tags: authentication and session related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Praized session status check (oauth)
 * 
 * <code><?php if ( pzdc_is_authorized() ) : ?>...<?php endif; ?></code>
 *
 * @return boolean
 * @since 0.1
 */
function pzdc_is_authorized() {
    global $PraizedCommunity;
    return $PraizedCommunity->Praized->isAuthorized();
}

/**
 * Template function: Praized username of the currently authorized user (oauth).
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return mixed Boolean FALSE or String username
 * @since 0.1
 */
function pzdc_current_user_login($echo = TRUE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->Praized->currentUserLogin();
    if ( ! $out )
    	return FALSE; 
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Praized display name of the currently authorized user (oauth).
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return mixed Boolean FALSE or String username
 * @since 0.1
 */
function pzdc_current_user_name($echo = TRUE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->Praized->currentUserName();
    if ( ! $out ) {
    	if ( ! ( $out = pzdc_current_user_login(FALSE) ) )
    		return FALSE;
    }
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current authenticated user permalink [profile]
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_current_user_permalink($view = '', $echo = TRUE) {
    global $PraizedCommunity;
    if ( ! ( $out = pzdc_current_user_login(FALSE) ) )
    	return FALSE;
    if ( ! empty($view) )
        $out .= '/' . $view;
    $out = $PraizedCommunity->link_helper($out, 'user');
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Returns the fully qualified link to instantiate [login] (or destroy [logout]) a Praized oauth session.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @return mixed Boolean FALSE or String username
 * @since 0.1
 */
function pzdc_auth_link($echo = TRUE) {
    global $PraizedCommunity;
    $link = $PraizedCommunity->trigger_url . '/oauth';
    if ( pzdc_is_authorized() )
    	$link .= '/logout';
    else
    	$link .= '/login';
    if ($echo)
        echo $link;
    return $link;
}
?>