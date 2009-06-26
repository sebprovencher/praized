<?php
/**
 * Praized template fragment: Merchant listing, search and tag results, with paging
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<div class="praized-merchants-list">
  <?php if ( pzdc_has_merchants() ) : ?>
    <div style="margin-top:15px;"><?php pzdc_tpt_fragment('search_form'); ?></div>
    <br clear="all" />
    <?php while ( pzdc_merchants_loop() ) : ?>
      <?php pzdc_tpt_fragment('merchant/hcard'); ?>
    <?php endwhile; ?>
  <?php else:?>
    <div style="margin-top:15px;"><?php pzdc_tpt_fragment('search_form'); ?></div>
    <br clear="all" />
    <?php pzdc_tpt_fragment('merchant/no_results'); ?>
  <?php endif;?>
  <?php pzdc_paginate(); ?>
</div>

<?php pzdc_credits(); ?>