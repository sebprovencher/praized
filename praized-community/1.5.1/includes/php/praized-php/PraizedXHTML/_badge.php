<?php
/**
 * Badge fragment, included through PraizedXHTML::_fragment()
 *
 * @version 1.5.1
 * @package Praized
 * @subpackage XHTML
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! $this->_pzdxMerchant )
    return;

$merchant       = $this->_pzdxMerchant;
    
$link           = $this->_permalink($merchant);
$voteCount      = intval($merchant->votes->count);
$votePosCount   = intval($merchant->votes->pos_count);
    
$xhtml .= <<<EOS
    <a style="text-decoration:none" class="praized-badge" id="praized-merchant-{$merchant->pid}-badge" href="{$link}">
      <span class="praized-badge-score">
        <strong class="praized-nominator">{$votePosCount}</strong>
        <strong class="praized-denominator">{$voteCount}</strong>
      </span>
      <span class="praized-descriptor">
        <span class="praized-brand">
          PRAIZED
        </span>
        <span class="praized-this">
          THIS
        </span>
      </span>
    </a>
EOS;

?>

