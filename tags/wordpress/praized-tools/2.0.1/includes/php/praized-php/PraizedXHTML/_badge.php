<?php
/**
 * Badge fragment, included through PraizedXHTML::_fragment()
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

$merchant       = $this->_pzdxMerchant;
$config         = $this->_pzdxConfig;

$link           = $this->_permalink($merchant);
$voteCount      = intval($merchant->votes->count);
$votePosCount   = intval($merchant->votes->pos_count);

if ( isset($config['lang']) && is_string($config['lang']) && ! empty($config['lang']) )
	$langCss = 'praized-badge-' . $config['lang'];
else
	$langCss = '';

$xhtml .= <<<EOS
	<span class="praized-badge-score">
		<strong class="praized-nominator">{$votePosCount}</strong>
		<strong class="praized-denominator">{$voteCount}</strong>
	</span>
EOS;

if ( $link )
	$xhtml = <<<EOS
	<a style="text-decoration:none" class="praized-badge {$langCss}" id="praized-merchant-{$merchant->pid}-badge" href="{$link}">
		{$xhtml}
	</a>
EOS;

?>

