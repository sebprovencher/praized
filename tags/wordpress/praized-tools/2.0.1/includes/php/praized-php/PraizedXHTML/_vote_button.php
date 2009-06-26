<?php
/**
 * Fake vote button fragment, included through PraizedXHTML::_fragment()
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
	'must_login' => 'You must login before you can vote! - Just click, we\'ll take you there and back!',
	'vote_up'    => 'Vote Up',
	'vote_down'  => 'Vote Down'
);

$merchant       = $this->_pzdxMerchant;
$community      = $this->_pzdxCommunity;
$config         = $this->_pzdxConfig;
    
$link           = $this->_permalink($merchant);
$voteCount      = intval($merchant->votes->count);
$votePosCount   = intval($merchant->votes->pos_count);
$baseUrl        = rtrim($community->base_url, '/');

if ( $voteCount < 1 )
	$voteCss = 'novotes';
elseif ( isset($merchant->self->rating) )
	$voteCss = 'voted-' . $merchant->self->rating;

$voteUpTitle   = ( isset($merchant->self) ) ? $captions['vote_up']   : $captions['must_login'];
$voteDownTitle = ( isset($merchant->self) ) ? $captions['vote_down'] : $captions['must_login'];

$voteUpTitle   = str_replace('"', '&#34;', $voteUpTitle);
$voteDownTitle = str_replace('"', '&#34;', $voteDownTitle);

if ( isset($config['translations']) && is_array($config['translations']) && ! empty($config['translations']) )
	$captions = array_merge($captions, $config['translations']);

if ( isset($config['lang']) && is_string($config['lang']) && ! empty($config['lang']) )
	$langCss = 'praized-vote-button-' . $config['lang'];
else
	$langCss = '';

$xhtml .= <<<EOS
    <!-- begin vote button -->
        <form action="{$baseUrl}/merchants/{$merchant->pid}/votes" class="praized-vote-button {$voteCss} {$langCss}" method="post">
        	<fieldset class="stats">
        		<legend>Stats:</legend>
        		<div class="score"><span class="positives">{$votePosCount}</span><span class="separator">/</span><span class="total">{$voteCount}</span></div>
        	</fieldset>
        	<fieldset class="actions">
        		<legend>Actions:</legend>
        			<button type="submit" title="{$voteUpTitle}"  class="vote-for vote-option login-required" name="vote" value="1"><b>{$captions['vote_up']}</b></button>
        			<button type="submit" title="{$voteDownTitle}"  class="vote-against vote-option login-required" name="vote" value="0"><b>{$captions['vote_down']}</b></button>
        	</fieldset>
        </form>
    <!-- end vote button -->
EOS;

?>