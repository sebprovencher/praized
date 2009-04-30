<?php
/**
 * List template, included through PraizedXHTML::_template()
 *
 * @version 2.0
 * @package Praized
 * @subpackage XHTML
 * @author Stephane Daury for Praized Media, Inc.
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
    
    $xhtml .= "<li id=\"praized-merchant-{$merchant->pid}\" class=\"praized-merchant\">";
    
    if ( $link )
		$xhtml .= "<a class=\"praized-inline-merchant-container\" href=\"{$link}\">{$merchant->name}</a>";
	else
		$xhtml .= $merchant->name;
    
    if(isset($config['address']) && strtolower($config['address']) == 'true')
        $xhtml .= "<br /><i class=\"praized-merchant-inline-address\">{$merchant->location->street_address}, {$merchant->location->city->name}</i>";
    
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