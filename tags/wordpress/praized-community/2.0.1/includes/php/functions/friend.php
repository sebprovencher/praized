<?php
/**
 * Praized template functions/helpers/tags: individual friend related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Tests if a valid friend object is set.
 * 
 * <code><?php if ( pzdc_has_friend() ) : ?>...<?php endif; ?></code>
 *
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 0.1
 */
function pzdc_has_friend($identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_friend();
}

/**
 * Template function: Current friend object
 * 
 * <code><?php $friend_object = pzdc_friend(); ?></code>
 *
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return mixed Boolean FALSE or Object Current friend (see params)
 * @since 0.1
 */
function pzdc_friend($identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! empty($identifier) )
        $PraizedCommunity->tpt_has_friend($identifier);
    return $PraizedCommunity->tpt_friend;
}

/**
 * Template function: Current friend login
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_login($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'login', $echo, $identifier);
}

/**
 * Template function: Current friend permalink
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_permalink($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $out = pzdc_friend_login(FALSE, $identifier);
    $out = $PraizedCommunity->link_helper($out, 'user');
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current friend display name
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_friend_display_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'display_name', $echo, $identifier);
}

/**
 * Template function: Current friend first name
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_first_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'first_name', $echo, $identifier);
}

/**
 * Template function: Current friend last name
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_last_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'last_name', $echo, $identifier);
}

/**
 * Template function: Current friend gender
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_gender($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'gender', $echo, $identifier);
}

/**
 * Template function: Current friend about
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_about($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'about', $echo, $identifier);
}

/**
 * Template function: Current friend date_of_birth
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_date_of_birth($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'date_of_birth', $echo, $identifier);
}

/**
 * Template function: Current friend claim_to_fame
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_claim_to_fame($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'claim_to_fame', $echo, $identifier);
}

/**
 * Template function: Current friend large avatar (140x140)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional friend identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_friend_avatar_large($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'avatar->large', $echo, $identifier);
}

/**
 * Template function: Current friend medium avatar (70x70)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional friend identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_friend_avatar_medium($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'avatar->medium', $echo, $identifier);
}

/**
 * Template function: Current friend small avatar (40x40)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional friend identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 2.0
 */
function pzdc_friend_avatar_small($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'avatar->small', $echo, $identifier);
}

/**
 * Template function: Current friend vote count
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_vote_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('friend', 'votes_count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count; 
}

/**
 * Template function: Current friend favorite count
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_favorite_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('friend', 'favorite_count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count;
}

/**
 * Template function: Current friend comment count
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_comment_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('friend', 'comment_count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count; 
}

/**
 * Template function: Current friend friend count
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_friend_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('friend', 'friend_count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count; 
}

/**
 * Template function: Current friend creation date
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $format strftime() conversion specifiers
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_created_at($echo = TRUE, $format = NULL, $identifier = FALSE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('friend', 'created_at', FALSE, $identifier);
    if ( strstr($format, '%') )
        $out = pzdc_date($out, $format);
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current friend last update date
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $format strftime() conversion specifiers
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_updated_at($echo = TRUE, $format = NULL, $identifier = FALSE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('friend', 'updated_at', FALSE, $identifier);
    if ( strstr($format, '%') )
        $out = pzdc_date($out, $format);
    if ( $echo )
        echo $out;
    return $out;
}
 
/**
 * Template function: Tests if the current displayed friend is already in the authn'd friend's friends
 *
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 0.1
 */
function pzdc_friend_is_self_friend($identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! empty($identifier) )
        $PraizedCommunity->tpt_has_friend($identifier);
    return $PraizedCommunity->tpt_friend_is_friend('self');
}

/**
 * Template function: Returns the value of the current displayed friend's self-friend node, related to the current authn'd friend.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_self_friend($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'self->friend', $echo, $identifier);
}

/**
 * Template function: Tests if the current displayed friend is already in the displayed friend's friends
 *
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return boolean
 * @since 0.1
 */
function pzdc_friend_is_target_friend($identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! empty($identifier) )
        $PraizedCommunity->tpt_has_friend($identifier);
    return $PraizedCommunity->tpt_friend_is_friend('target');
}

/**
 * Template function: Returns the value of the current displayed friend's target->friend node, related to the current authn'd friend.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @param string $identifier Optional user identifier (login) for custom template development (see bundled praized-php lib)
 * @return string
 * @since 0.1
 */
function pzdc_friend_target_friend($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('friend', 'target->friend', $echo, $identifier);
}
?>