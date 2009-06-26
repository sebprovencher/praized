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

<?php if ( pzdc_has_merchant() ) : ?>

    <?php pzdc_tpt_fragment('merchant/hcard'); ?>
    
    <div id="praized-communities" class="praized-user-section">
      <h3 class="praized-communities-section-title"><?php pzdc_e('Communities'); ?></h3>
      <?php if ( pzdc_has_hub_communities(array('per_page' => 25)) ) : ?>
        <ul class="praized-communities-list">
          <?php while ( pzdc_hub_communities_loop() ) : ?>
            <li><?php pzdc_tpt_fragment('community/hcard'); ?></li>
          <?php endwhile; ?>
        </ul>
      <?php else:?>
        <?php pzdc_e('No communities'); ?>
      <?php endif;?>
    </div>
    
    <?php pzdc_paginate(); ?>

<?php else:?>
  <p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>