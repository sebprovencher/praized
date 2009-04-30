<?php
/**
 * Vote button template, included through PraizedXHTML::_template()
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

$xhtml .= $this->_fragment('vote_button');

/**
 * Special blog-level var added to the 1st merchant by the blog
 * platforms when the data to be displayed has been saved statically.
 */
if ( isset($merchant->static_timestamp) ) 
    $xhtml .= '<p class="praized-merchant-static-timestamp">' . $merchant->static_timestamp . '</p>';

?>

