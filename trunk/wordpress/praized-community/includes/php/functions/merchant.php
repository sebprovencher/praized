<?php
/**
 * Praized template functions/helpers/tags: individual merchant related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/**
 * Template function: Tests if a valid merchant object is set.
 * @note: should be used before using merchants related functions.
 *
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return boolean
 * @since 0.1
 */
function pzdc_has_merchant($identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_has_merchant($identifier);
}

/**
 * Template function: Tests if the current page is a single merchant page
 *
 * @return boolean
 * @since 1.0.4
 */
function pzdc_is_merchant_page() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_is_merchant_page();
}

/**
 * Template function: Current merchant xhtml or object (defaults to echo xhtml)
 *
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return mixed Boolean FALSE or Object Current merchant (see params)
 * @since 0.1
 */
function pzdc_merchant($identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! empty($identifier) )
        $PraizedCommunity->tpt_has_merchant($identifier);
    return $PraizedCommunity->tpt_merchant;
}

/**
 * Template function: Current merchant unique identifier (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_pid($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'pid', $echo, $identifier);
}

/**
 * Template function: Current merchant name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'name', $echo, $identifier);
}

/**
 * Template function: Current merchant permalink (defaults to echo)
 *
 * @param string $view Defines which sub view link to build (eg: merchant's comment list, etc)
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_permalink($view = '', $echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! empty($view) ) {
        $pid = $PraizedCommunity->tpt_attribute_helper('merchant', 'pid', FALSE, $identifier);
        $out = $PraizedCommunity->link_helper("/$pid/$view", 'merchant');
    } else {
        $out = $PraizedCommunity->tpt_attribute_helper('merchant', 'permalink', FALSE, $identifier);
    }
    $out = pzdc_stripper($out);
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Vote button
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 1.5
 */
function pzdc_merchant_vote_button($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $PraizedCommunity->tpt_vote_button($echo, $identifier);
}

/**
 * Template function: Current merchant short url (przd.com) (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_short_url($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'short_url', $echo, $identifier);
}

/**
 * Template function: Current merchant description (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_description($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'description', $echo, $identifier);
}

/**
 * Template function: Current merchant phone number (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_phone($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'phone', $echo, $identifier);
}

/**
 * Template function: Current merchant fax number (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_fax($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'fax', $echo, $identifier);
}

/**
 * Template function: Current merchant email address (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_email($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'email', $echo, $identifier);
}

/**
 * Template function: Current merchant web site url (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_url($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'url', $echo, $identifier);
}

/**
 * Template function: Current merchant latitude (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_latitude($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'location->latitude', $echo, $identifier);
}

/**
 * Template function: Current merchant longitude (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_longitude($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'location->longitude', $echo, $identifier);
}

/**
 * Template function: returns an image tag of a Google Static Map for the requested merchant.
 *
 * @param array $raw_params Optional Google maps parameters (size, zoom, etc)
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 */
function pzdc_merchant_map($raw_params = array(), $echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    
    $latitude  = pzdc_merchant_latitude(FALSE, $identifier);
    $longitude = pzdc_merchant_longitude(FALSE, $identifier);

    if ( ! $latitude || ! $longitude ) {
        
        if ( ! is_object($PraizedCommunity->Praized) )
            return FALSE;

        $query = '';
        
        $str = pzdc_merchant_street_address(FALSE, $identifier);
        
        if ( ! preg_match('/^po .*/', strtolower($str)) && ! preg_match('/^p\.o\. .*/', strtolower($str)) ) {
            $query .= $str . ', ';
            $query .= ( $str = pzdc_merchant_postal_code(   FALSE, $identifier) ) ? $str . ', ' : '';
        }
        
        $query .= ( $str = pzdc_merchant_city_name(     FALSE, $identifier) ) ? $str . ', ' : '';
        $query .= ( $str = pzdc_merchant_region_name(   FALSE, $identifier) ) ? $str . ', ' : '';
        $query .= ( $str = pzdc_merchant_country_name(  FALSE, $identifier) ) ? $str        : '';
        
        if ( empty($query) )
            return FALSE;
        
        $geo = $PraizedCommunity->Praized->googleGeoLookup(
            $PraizedCommunity->_config['map_api_key'],
            rtrim($query, ', ')
        );
        
        if ( ! is_array($geo) )
            return FALSE;
        
        $latitude = $geo['latitude'];
        $longitude = $geo['longitude'];
    }

    if ( ! $latitude || ! $longitude )
        return FALSE;
    
    return pzdc_map($latitude, $longitude, $raw_params, pzdc_merchant_name(FALSE), $echo);
}


/**
 * Template function: Current merchant street address (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_street_address($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'location->street_address', $echo, $identifier);
}

/**
 * Template function: Current merchant postal code (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_postal_code($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'location->postal_code', $echo, $identifier);
}

/**
 * Template function: Current merchant city name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_city_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'location->city->name', $echo, $identifier);
}

/**
 * Template function: Current merchant city code (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_city_code($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'location->city->code', $echo, $identifier);
}

/**
 * Template function: Current merchant state or province name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_region_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    if ( ! ($region = $PraizedCommunity->tpt_attribute_helper('merchant', 'location->regions->state', FALSE, $identifier)) ) {
        if ( ! ($region = $PraizedCommunity->tpt_attribute_helper('merchant', 'location->regions->province', FALSE, $identifier)) ) {
            return FALSE;
        }
    }
    if ( $echo )
        echo $region;
    return $region;
}

/**
 * Template function: Current merchant country name (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_country_name($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'location->country->name', $echo, $identifier);
}

/**
 * Template function: Current merchant country code (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_country_code($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'location->country->code', $echo, $identifier);
}

/**
 * Template function: Current merchant tag count (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_tag_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('merchant', 'tag_count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count; 
}

/**
 * Template function: Current merchant favorite count (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_favorite_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('merchant', 'favorite_count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count;
}

/**
 * Template function: Current merchant comment count (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_comment_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('merchant', 'comment_count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count; 
}

/**
 * Template function: Current merchant vote score (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_vote_score($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $score = intval($PraizedCommunity->tpt_attribute_helper('merchant', 'votes->score', FALSE, $identifier));
    if ( $echo )
        echo $score;
    return $score; 
}

/**
 * Template function: Current merchant vote count (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_vote_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $count = intval($PraizedCommunity->tpt_attribute_helper('merchant', 'votes->count', FALSE, $identifier));
    if ( $echo )
        echo $count;
    return $count; 
}

/**
 * Template function: Current merchant positive (up) vote count (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_vote_pos_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'votes->pos_count', $echo, $identifier);
}

/**
 * Template function: Current merchant negative (down) vote count (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_vote_neg_count($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'votes->neg_count', $echo, $identifier);
}

/**
 * Template function: Current merchant creation date (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $format strftime() conversion specifiers
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_created_at($echo = TRUE, $format = NULL, $identifier = FALSE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('merchant', 'created_at', FALSE, $identifier);
    if ( strstr($format, '%') )
        $out = pzdc_date($out, $format);
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Current merchant last update date (defaults to echo)
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string $format strftime() conversion specifiers
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_updated_at($echo = TRUE, $format = NULL, $identifier = FALSE) {
    global $PraizedCommunity;
    $out = $PraizedCommunity->tpt_attribute_helper('merchant', 'updated_at', FALSE, $identifier);
    if ( strstr($format, '%') )
        $out = pzdc_date($out, $format);
    if ( $echo )
        echo $out;
    return $out;
}

/**
 * Template function: Returns the value of the current merchant's self-favorite node, related to the current authn'd user.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_self_favorite($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'self->favorite', $echo, $identifier);
}

/**
 * Template function: Tests if the merchant has been favorited by the current or displayed user (see param)
 *
 * @param string $node "self" for current user or "target" for displayed user, defaults to "self"
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_is_favorited($node = 'self', $identifier = FALSE) {
    global $PraizedCommunity;
    if ( $node != 'target')
        $node = 'self';
    return $PraizedCommunity->tpt_attribute_helper('merchant', $node . '->favorite', FALSE, $identifier);
}

/**
 * Template function: Returns the value of the current merchant's self->rating node, related to the current authn'd user.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_self_rating($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    $vote = $PraizedCommunity->tpt_attribute_helper('merchant', 'self->rating', FALSE, $identifier);
    if ( ! empty($vote) )
        $vote = 'voted-' . $vote;
    if ( $echo )
        echo $vote;
    return $vote;
}

/**
 * Template function: Tests if the merchant has been voted on by the current or displayed user (see param)
 *
 * @param string $node "self" for current user or "target" for displayed user, defaults to "self"
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_is_voted($node = 'self', $identifier = FALSE) {
    global $PraizedCommunity;
    if ( $node != 'target')
        $node = 'self';
    $response = $PraizedCommunity->tpt_attribute_helper('merchant', $node . '->rating', FALSE, $identifier);
    return ( $response != FALSE ) ? TRUE : FALSE;
}

/**
 * Template function: Returns the value of the current merchant's target->favorite node, related to the current authn'd user.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_target_favorite($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'target->favorite', $echo, $identifier);
}

/**
 * Template function: Returns the value of the current merchant's target->rating node, related to the current authn'd user.
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned
 * @param string Optional merchant PID, defauts to $this->_tpt_merchant
 * @return string
 * @since 0.1
 */
function pzdc_merchant_target_rating($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_attribute_helper('merchant', 'target->rating', $echo, $identifier);
}

/**
 * Template function: Looks for the stats image url in the current merchant's
 * data and echoes/returns an image tag or NULL. Will only work in the right
 * views (ie: individual merchant show, not listings)
 *
 * @param boolean $echo
 * @param string $identifier Optional merchant PID, defauts to $this->_tpt_merchant
 * @return mixed NULL or String
 * @since 0.1
 */
function pzdc_merchant_stats_img($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_stats_img($echo = TRUE, $identifier = FALSE);
}

/**
 * Template function: Praized.com sharing.
 *
 * @param boolean $echo
 * @param string $identifier Optional merchant PID, defauts to $this->_tpt_merchant
 * @return mixed NULL or String
 * @since 0.1
 */
function pzdc_merchant_share($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_share($echo = TRUE, $identifier = FALSE);
}

/**
 * Template function: Twitter link
 *
 * @param boolean $echo
 * @param string $identifier Optional merchant PID, defauts to $this->_tpt_merchant
 * @return mixed NULL or String
 * @since 1.0.4
 */
function pzdc_merchant_twitter_link($echo = TRUE, $identifier = FALSE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_twitter_link($echo = TRUE, $identifier = FALSE);
}
?>