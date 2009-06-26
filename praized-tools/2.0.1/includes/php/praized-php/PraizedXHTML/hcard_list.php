<?php
/**
 * hCard list template, included through PraizedXHTML::_template()
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

$xhtml .= '<div class="praized-xhtml-merchants-hcard-listing">';

foreach ( $merchants as $merchant ) {
    $this->_pzdxMerchant = $merchant;
    $xhtml .= $this->_fragment('hcard');
}

$xhtml .= '</div>';

/**
 * Special blog-level var added to the 1st merchant by the blog
 * platforms when the data to be displayed has been saved statically.
 */
if ( isset($merchants[0]->static_timestamp) ) 
    $xhtml .= '<p class="praized-merchant-static-timestamp">' . $merchants[0]->static_timestamp . '</p>';

?>