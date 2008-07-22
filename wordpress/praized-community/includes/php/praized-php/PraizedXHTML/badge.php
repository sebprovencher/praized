<?php
/**
 * Badge template, included in PraizedXHTML::_template()
 *
 * @version 1.0.2
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
$commentCount   = intval($merchant->comment_count);
$favoriteCount  = intval($merchant->favorite_count);

$config         = $this->_pzdxConfig;

if(strtolower($config['subtype']) == 'big'){

    if(isset($config['name']) && strtolower($config['name']) == 'true'){
      $xhtml .= "<a class=\"praized-merchant-inline-name\" href=\"{$link}\"><b>{$merchant->name}</b></a>";
      $xhtml .= '<br />';
    }
    
    $xhtml .= <<<EOS
    <a style="text-decoration:none" class="praized-badge" id="praized-merchant-{$merchant->pid}-badge" href="{$link}">
      <span class="praized-badge-score">
        <b class="praized-nominator">{$votePosCount}</b>
        <b class="praized-denominator">{$voteCount}</b>
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
    
    if(isset($config['address']) && strtolower($config['address']) == 'true'){
        $xhtml .= "<i class=\"praized-merchant-inline-address\">{$merchant->location->street_address}, {$merchant->location->city->name}</i><br />";
    }
    
    if(isset($config['phone']) && strtolower($config['phone']) == 'true'){
        $xhtml .= "<span class=\"praized-merchant-inline-phone\">{$merchant->phone}</span><br />";
    }

}else{

    $xhtml .= "<a class=\"praized-inline-merchant-container\" href=\"{$link}\">{$merchant->name} ";
    
    if(isset($config['address']) && strtolower($config['address']) == 'true'){
        $xhtml .= " (<i class=\"praized-merchant-inline-address\">{$merchant->location->street_address}, {$merchant->location->city->name}</i>) ";
    }
    
    $xhtml .= " <img class=\"praized-inline-merchant-arrow\" src=\"http://static.praized.com/praized-com/images/icons/up-right-green-arrow-9x9.gif\" border=\"0\" height=\"9\" width=\"9\"></span></a>";

}

/**
 * Special blog-level var added to the 1st merchant by the blog
 * platforms when the data to be displayed has been saved statically.
 */
if ( isset($merchant->static_timestamp) ) 
    $xhtml .= '<p class="praized-merchant-static-timestamp">' . $merchant->static_timestamp . '</p>';

?>

