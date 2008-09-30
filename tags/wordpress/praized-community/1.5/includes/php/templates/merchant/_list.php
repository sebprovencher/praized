<?php
/**
 * Praized template fragment: Merchant listing, search and tag results, with paging
 *
 * @version 1.5
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<div class="praized-merchants-list">
  <h2 class="praized-search-header"><?php pzdc_page_header(); ?></h2>
  <?php if ( pzdc_has_merchants() ) : ?>
    <?php while ( pzdc_merchants_loop() ) : ?>
      <?php pzdc_tpt_fragment('merchant/hcard'); ?>
    <?php endwhile; ?>
  <?php else:?>
    <?php pzdc_tpt_fragment('merchant/no_results'); ?>
  <?php endif;?>
  <?php pzdc_paginate(); ?>
</div>

<?php pzdc_credits(); ?>