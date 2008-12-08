<?php
/**
 * Praized template fragment: Action listing, with paging
 *
 * @version 1.6
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_merchant() ) : ?>

    <?php pzdc_tpt_fragment('merchant/hcard'); ?>
    
    <div id="praized-actions" class="praized-user-section">
      <h3 class="praized-merchant-section-title"><?php pzdc_e('Activity Stream'); ?></h3>
      <?php if ( pzdc_has_actions(array('per_page' => 25)) ) : ?>
        <?php while ( pzdc_actions_loop() ) : ?>
          <?php pzdc_tpt_fragment('action/entry'); ?>
        <?php endwhile; ?>
      <?php else:?>
        <?php pzdc_e('No activity'); ?>
      <?php endif;?>
    </div>
    
    <?php pzdc_paginate(); ?>

<?php else:?>
  <p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>