<?php
/**
 * Praized template functions/helpers/tags: individual user related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Tests if a valid user object is set.
 * 
 * <code><?php if ( pzdc_has_user() ) : ?>...<?php endif; ?></code>
 *
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 0.1
 */
function pzdc_has_user($identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_user($identifier);
}

/**
 * Template function: Current user object
 * 
 * <code><?php $user_object = pzdc_user(); ?></code>
 *
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return mixed Boolean FALSE or Object Current user (see params)
 * @since 0.1
 */
function pzdc_user($identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! empty($identifier) )
        $PraizedCommunity->tpt_has_user($identifier);
    return $PraizedCommunity->tpt_user;
}

/**
 * Template function: Current user login
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_login($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'login', $echo);
}

/**
 * Template function: Tests if the current user being interacted with is the currently authorized user
 *
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 0.1
 */
function pzdc_user_is_self($identifier = FALSE) {
    if ( ! empty($identifier) )
        $PraizedCommunity->tpt_has_user($identifier);
    return ( pzdc_user_login(FALSE) == pzdc_current_user_login(FALSE) )
        ? TRUE
        : FALSE;
}

/**
 * Template function: Current user permalink
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_permalink($view = '', $echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('user', 'permalink', FALSE, $identifier);
    if ( ! empty($view) )
        $out .= '/' . $view;
    $out = $PraizedCommunity->link_helper($out, 'user');
    $out = pzdc_stripper($out);
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current user display name
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_display_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'display_name', $echo, $identifier);
}

/**
 * Template function: Current user first name
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_first_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'first_name', $echo, $identifier);
}

/**
 * Template function: Current user last name
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_last_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'last_name', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_email($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->email', $echo, $identifier);
}

/**
 * Template function: Current user email address validation status (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_email_validated($identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->email_validated', FALSE, $identifier);
}

/**
 * Template function: Current user gender
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_gender($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'gender', $echo, $identifier);
}

/**
 * Template function: Current user about
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_about($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'about', $echo, $identifier);
}

/**
 * Template function: Current user date of birth
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_date_of_birth($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'date_of_birth', $echo, $identifier);
}

/**
 * Template function: Current user claim to fame
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_claim_to_fame($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'claim_to_fame', $echo, $identifier);
}

/**
 * Template function: Current user large avatar (140x140)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 1.6
 */
function pzdc_user_avatar_large($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'avatar->large', $echo, $identifier);
}

/**
 * Template function: Current user medium avatar (70x70)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 1.6
 */
function pzdc_user_avatar_medium($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'avatar->medium', $echo, $identifier);
}

/**
 * Template function: Current user small avatar (40x40)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 1.6
 */
function pzdc_user_avatar_small($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'avatar->small', $echo, $identifier);
}

/**
 * Template function: Current user vote count
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_vote_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('user', 'vote_count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count; 
}

/**
 * Template function: Current user favorite count
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_favorite_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('user', 'favorite_count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count;
}

/**
 * Template function: Current user comment count
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_comment_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('user', 'comment_count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count; 
}

/**
 * Template function: Current user friend count
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_friend_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('user', 'friend_count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count; 
}

/**
 * Template function: Current user created date
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $format strftime() conversion specifiers
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_created_at($echo = TRUE, $format = NULL, $identifier = FALSE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('user', 'created_at', FALSE, $identifier);
    if ( strstr($format, '%') )
        $out = pzdc_date($out, $format);
    if ( $echo )
        echo $out;
    return $out;
}
 
/**
 * Template function: Current user updated date
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $format strftime() conversion specifiers
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_updated_at($echo = TRUE, $format = NULL, $identifier = FALSE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('user', 'updated_at', FALSE, $identifier);
    if ( strstr($format, '%') )
        $out = pzdc_date($out, $format);
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current user latitude (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_latitude($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'location->latitude', $echo, $identifier);
}

/**
 * Template function: Current user longitude (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_longitude($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'location->longitude', $echo, $identifier);
}


/**
 * Template function: Current merchant street address (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_street_address($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'location->street_address', $echo, $identifier);
}

/**
 * Template function: Current user postal code (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_postal_code($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'location->postal_code', $echo, $identifier);
}

/**
 * Template function: Current user city name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_city_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'location->city->name', $echo, $identifier);
}

/**
 * Template function: Current user state or province name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_region_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! ($region = $PraizedCommunity->tpt_attribute_helper('user', 'location->regions->state', FALSE, $identifier)) ) {
        if ( ! ($region = $PraizedCommunity->tpt_attribute_helper('user', 'location->regions->province', FALSE, $identifier)) ) {
            return FALSE;
        }
    }
    if ( $echo )
        echo $region;
    return $region;
}

/**
 * Template function: Current user country name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_country_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'location->country->name', $echo, $identifier);
}

/**
 * Template function: Tests if the user has been befriended by the current or displayed user (see param)
 *
 * @param string $node "self" for current user or "target" for displayed user, defaults to "self"
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_is_friend($node = 'self', $identifier = FALSE) {
    global $PraizedCommunity;
    if ( $node != 'target')
        $node = 'self';
    return $PraizedCommunity->tpt_attribute_helper('user', $node . '->friend', $echo, $identifier);
}

/**
 * Template function: Returns the value of the current displayed user's self-friend node, related to the current authn'd user.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_self_friend($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->friend', $echo, $identifier);
}

/**
 * Template function: Returns the value of the current displayed user's target->friend node, related to the current authn'd user.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_user_target_friend($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('user', 'target->friend', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_notify_by_email($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->notify_by_email', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_notify_by_twitter($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->notify_by_twitter', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_facebook_enabled($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->facebook_enabled', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_twitter_enabled($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->twitter_enabled', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_twitter_username($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->twitter_username', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_twitter_password($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->twitter_password', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_laconica_enabled($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->laconica_enabled', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_laconica_site($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->laconica_site', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_laconica_username($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->laconica_username', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_laconica_password($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->laconica_password', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_friend_feed_enabled($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->friend_feed_enabled', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_friend_feed_username($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->friend_feed_username', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_friend_feed_remote_key($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->friend_feed_remote_key', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_ping_fm_enabled($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->ping_fm_enabled', $echo, $identifier);
}

/**
 * Template function: Current user email address (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_setting_ping_fm_application_key($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    return $PraizedCommunity->tpt_attribute_helper('user', 'self->setting->ping_fm_application_key', $echo, $identifier);
}

/**
 * Template function: Current unique identifier used in the reset password and email confirmation functionality (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @return string
 * @since 2.0
 */
function pzdc_user_confirmation_key($echo = TRUE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_confirmation_key;
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current state returned by the reset password and email confirmation functionality (defaults to echo)
 *
 * @return string
 * @since 2.0
 */
function pzdc_user_confirmation_error() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_confirmation_error;
}

/**
 * Template function: Current state message returned by the reset password and email confirmation functionality (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @return string
 * @since 2.0
 */
function pzdc_user_confirmation_message($echo = TRUE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_confirmation_message;
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Tells if the user is currently logged in via facebook connect (defaults to echo, only works if pzdc_user_is_self() at the API level)
 *
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_user_memberships_facebook($identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! pzdc_user_is_self() )
    	return FALSE;
    if ( $memberships = $PraizedCommunity->tpt_attribute_helper('user', 'self->memberships', FALSE, $identifier) ) {
    	if ( ! is_array($memberships) )
    		return FALSE;
    	foreach ( $memberships as $m ) {
			if ( $m->name && strtolower($m->name) == 'facebook' )
    			return TRUE;
    	}
    }
    return FALSE;
}
/**
 * Template function: Returns and/or echoes the secret tokenized url for a user's avatar upload. (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @return string
 * @since 2.0
 */
function pzdc_user_avatar_upload_url($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_user_avatar_upload_url($echo);
}
?>