<?php
/**
 * Praized template fragment: User actions listing, with paging
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<div class="praized-action-list">
  <div style="margin-top:15px;"><?php pzdc_tpt_fragment('search_form'); ?></div>
  <br clear="all" />
  <h2 class="praized-search-header"><?php pzdc_page_header(); ?></h2>
  <?php if ( pzdc_has_actions() ) : ?>
    <?php while ( pzdc_actions_loop() ) : ?>
      <?php pzdc_tpt_fragment('action/entry'); ?>
    <?php endwhile; ?>
  <?php else:?>
    <?php pzdc_tpt_fragment('action/no_results'); ?>
  <?php endif;?>
  <?php pzdc_paginate(); ?>
</div>

<?php pzdc_credits(); ?>