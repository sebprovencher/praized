<?php
/**
 * hCard fragment, included through PraizedXHTML::_template()
 *
 * @version 2.0
 * @package Praized
 * @subpackage XHTML
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! $this->_pzdxMerchant )
    return;

$captions = array(
	'tags'      => 'Tags',
	'favorers'  => 'favorers',
	'praizers'  => 'praizers',
    'comments'  => 'comments'
);

$merchant = $this->_pzdxMerchant;
$config   = $this->_pzdxConfig;

$link     = $this->_permalink($merchant);
$location = $merchant->location;

if ( isset($config['translations']) && is_array($config['translations']) )
	$captions = array_merge($captions, $config['translations']);

// Format address markup

$address = '';

if ( isset($location->street_address) )
	$address .= '<span class="street-address">'.$location->street_address.'</span>';

if ( isset($location->city->name) ) {
	if ( ! empty($address) )
		$address .= '<br />'; 
	$address .= '<span class="locality">'.$location->city->name.'</span>';
}

if ( isset($location->regions->state) ) {
	if ( ! empty($address) )
		$address .= ', '; 
	$address .= '<span class="region">'.$location->regions->state.'</span>';
} elseif ( isset($location->regions->province) ) {
	if ( ! empty($address) )
		$address .= ', '; 
	$address .= '<span class="region">'.$location->regions->province.'</span>';
}

if ( isset($location->postal_code) ) {
	if ( ! empty($address) )
		$address .= ', '; 
	$address .= '<span class="postal-code">'.$location->postal_code.'</span>';
}

if ( isset($location->country->name) ) {
	if ( ! empty($address) )
		$address .= ', '; 
	$address .= '<span class="country-name">'.$location->country->name.'</span>';
}

if ( isset($location->latitude) && isset($location->longitude) ) {
	if ( ! empty($address) )
		$address .= ' '; 
	$address .= '<span class="geo" style="display:none">';
	$address .= '(<span class="latitude">'.$location->latitude.'</span>, ';
	$address .= '<span class="longitude">'.$location->longitude.'</span>)';
	$address .= '</span>';
}

// Format tag list

$tagList = '';

if ( ! $config['hide_tags'] ) {
    if ( is_array($merchant->tags) && count($merchant->tags) > 0 ) {
        foreach ( $merchant->tags as $tag ) {
            if ( ! empty($tagList) )
                $tagList .= ', ';
            $tagLink = rtrim($this->_pzdxCommunity->base_url, '/') . '/merchants/tag/' . $tag->name;
            $tagList .= "<a rel=\"tag\" href=\"{$tagLink}\">{$tag->name}</a>";
        }
    }
}

// Format hCard markup

$xhtml .= "<fieldset class=\"vcard praized-xhtml-merchant-hcard\" id=\"praized-xhtml-merchant-{$merchant->pid}-hcard\">\n";

if ( $link )
	$xhtml .= "<h4 class=\"fn\"><a class=\"org url\" href=\"{$link}\">{$merchant->name}</a></h4>\n";
else
	$xhtml .= "<h4 class=\"fn org\">{$merchant->name}</h4>\n";

if ( ! $config['hide_vote'] ) {
    $xhtml .= $this->_fragment('vote_button');
    $xhtml .= "\n<div class=\"praized-xhtml-adr\">\n";
}

if ( ! empty($address) )
	$xhtml .= "<span class=\"adr\">{$address}</span>\n";

if ( ! empty($merchant->phone) )
	$xhtml .= "<br /><strong class=\"tel pref\">{$merchant->phone}</strong>\n";

if ( ! empty($merchant->email) )
	$xhtml .= "<br /><a href=\"mailto:{$merchant->email}\" class=\"email\">{$merchant->email}</a>\n";

if ( ! empty($merchant->url) )
	$xhtml .= "<br /><a href=\"{$merchant->url}\" class=\"url\">{$merchant->url}</a>\n";

if ( ! $config['hide_vote'] )
    $xhtml .= "</div>\n";
	
if ( ! empty($tagList) )
    $xhtml .= "<p>{$captions['tags']}: {$tagList}</p>\n";
else
    $xhtml .= "<br />\n";

if ( ! $config['hide_stats'] && $link ) {
    $xhtml .= <<<____EOS
        <a href="{$link}?tab=favorites#praized_ui_tab_box_favorites">{$captions['favorers']} ({$merchant->favorite_count})</a>
        |
        <a href="{$link}?tab=votes#praized_ui_tab_box_votes">{$captions['praizers']} ({$merchant->votes->count})</a>
        |
        <a href="{$link}?tab=comments#praized_ui_tab_box_comments">{$captions['comments']} ({$merchant->comment_count})</a>
____EOS;
}

$xhtml .= "</fieldset>\n";

/**
 * Special blog-level var added to the 1st merchant by the blog
 * platforms when the data to be displayed has been saved statically.
 */
if ( isset($merchant->static_timestamp) ) 
    $xhtml .= '<p class="praized-merchant-static-timestamp">' . $merchant->static_timestamp . '</p>';

?>

