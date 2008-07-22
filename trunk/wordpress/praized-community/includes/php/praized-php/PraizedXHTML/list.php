<?php
/**
 * List template, included in PraizedXHTML::_template()
 *
 * @version 1.0.2
 * @package Praized
 * @subpackage XHTML
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! $this->_pzdxMerchants )
    return;

$merchants = $this->_pzdxMerchants;
$config    = $this->_pzdxConfig;

$xhtml .= '<ul class="praized-merchants-listing">';

foreach ( $merchants as $merchant ) {
    
    $link      = $this->_permalink($merchant);
    $voteScore = intval($merchant->votes->score);
    
    $xhtml .= "<li id=\"praized-merchant-{$merchant->pid}\" class=\"praized-merchant\">";
    $xhtml .= "<a class=\"praized-inline-merchant-container\" href=\"{$link}\">{$merchant->name} ";
    $xhtml .= " <img class=\"praized-inline-merchant-arrow\" src=\"http://static.praized.com/praized-com/images/icons/up-right-green-arrow-9x9.gif\" border=\"0\" height=\"9\" width=\"9\"></span></a>";
    
    if(isset($config['address']) && strtolower($config['address']) == 'true'){
        $xhtml .= "<br /><i class=\"praized-merchant-inline-address\">{$merchant->location->street_address}, {$merchant->location->city->name}</i>";
    }
    
    $xhtml .= "</li>";
}

$xhtml .= '</ul>';

/**
 * Special blog-level var added to the 1st merchant by the blog
 * platforms when the data to be displayed has been saved statically.
 */
if ( isset($merchants[0]->static_timestamp) ) 
    $xhtml .= '<p class="praized-merchant-static-timestamp">' . $merchants[0]->static_timestamp . '</p>';

?>