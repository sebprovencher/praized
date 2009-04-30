<?php
/**
 * Praized template fragment: Hub communities listing, with paging
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<h2><?php pzdc_community_name(); ?><?php pzdc_e(': All Communities');?></h2>
<ul class="praized-communities-list">
  <?php if ( pzdc_has_hub_communities() ) : ?>
    <?php while ( pzdc_hub_communities_loop() ) : ?>
      <li><?php pzdc_tpt_fragment('community/hcard'); ?></li>
    <?php endwhile; ?>
  <?php else:?>
    <li><?php pzdc_tpt_fragment('community/no_results'); ?></li>
  <?php endif;?>
  <?php pzdc_paginate(); ?>
</ul>

<?php pzdc_credits(); ?>