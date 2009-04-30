<?php
/**
 * Badge template, included through PraizedXHTML::_template()
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
    
$merchant = $this->_pzdxMerchant;
$config   = $this->_pzdxConfig;

$link     = $this->_permalink($merchant);

if(strtolower($config['subtype']) == 'big'){
    if(isset($config['name']) && strtolower($config['name']) == 'true') {
    	if ( $link )
      		$xhtml .= "<a class=\"praized-merchant-inline-name\" href=\"{$link}\"><strong>{$merchant->name}</strong></a>";
     	else
     		$xhtml .= "<strong>{$merchant->name}</strong>";
     	$xhtml .= "<br />\n";
    } 
    
    $xhtml .= $this->_fragment('badge');
    
    if(isset($config['address']) && strtolower($config['address']) == 'true')
        $xhtml .= "<i class=\"praized-merchant-inline-address\">{$merchant->location->street_address}, {$merchant->location->city->name}</i><br />";
    
    if(isset($config['phone']) && strtolower($config['phone']) == 'true')
        $xhtml .= "<span class=\"praized-merchant-inline-phone\">{$merchant->phone}</span><br />";
}else{
    if ( $link )
      	$xhtml .= "<a class=\"praized-inline-merchant-container\" href=\"{$link}\">{$merchant->name}</a>";
     else
     	$xhtml .= $merchant->name;
    
    if(isset($config['address']) && strtolower($config['address']) == 'true')
        $xhtml .= " (<i class=\"praized-merchant-inline-address\">{$merchant->location->street_address}, {$merchant->location->city->name}</i>) ";
}

/**
 * Special blog-level var added to the 1st merchant by the blog
 * platforms when the data to be displayed has been saved statically.
 */
if ( isset($merchant->static_timestamp) ) 
    $xhtml .= '<p class="praized-merchant-static-timestamp">' . $merchant->static_timestamp . '</p>';

?>

