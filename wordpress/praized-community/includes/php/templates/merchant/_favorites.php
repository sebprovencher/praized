<?php
/**
 * Praized template fragment: Merchant favorite listing, with paging
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
  
  <div id="praized-favorers" class="praized-merchant-section">
    <h3 class="praized-merchant-section-title"><?php pzdc_merchant_favorite_count(); ?> <?php pzdc_e('Favorers'); ?></h3>
    <p class="praized-merchant-favorers">
      <?php if ( pzdc_has_favorites(array('per_page' => 50)) ) : ?>
        <?php while ( pzdc_favorites_loop() ) : ?>
          <a href="<?php pzdc_user_permalink(); ?>" title="<?php pzdc_user_display_name(); ?>"><img src="<?php pzdc_user_avatar_small(); ?>" border="none" alt="<?php pzdc_user_display_name(); ?>" style="margin-right: 5px; border: 1px solid;" /></a>
        <?php endwhile; ?>
      <?php else:?>
        <?php pzdc_e('No favorer'); ?>
      <?php endif;?>   
    </p>
  </div>
    
  <?php pzdc_paginate(); ?>

<?php else:?>
   <p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>
