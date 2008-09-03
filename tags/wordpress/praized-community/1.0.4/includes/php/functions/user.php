<?php
/**
 * Praized template functions/helpers/tags: individual user related functions
 * 
 * @version 1.0.4
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury
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
    $out = pzdc_user_login(FALSE, $identifier);
    if ( ! empty($view) )
        $out .= '/' . $view;
    $out = $PraizedCommunity->link_helper($out, 'user');
    if ( $echo )
        echo $out;
    return $out;
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
    if ( ! strstr($format, '%'))
        $format = $PraizedCommunity->__('%a, %B %e %Y, %H:%M:%S');
    $out = strftime($format, strtotime($out));
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
    if ( ! strstr($format, '%'))
        $format = $PraizedCommunity->__('%a, %B %e %Y, %H:%M:%S');
    $out = strftime($format, strtotime($out));
    if ( $echo )
        echo $out;
    return $out;
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
?>