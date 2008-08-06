<?php
/**
 * Praized template fragment: Merchant vote listing, with paging
 *
 * @version 1.0.3
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_merchant() ) : ?>

  <?php pzdc_tpt_fragment('merchant/hcard'); ?>
    
  <div id="praized-praizers" class="praized-merchant-section">
    <h3 class="praized-merchant-section-title"><?php pzdc_merchant_vote_count(); ?> <?php pzdc_e('Praizers'); ?></h3>
    <ul class="praized-merchant-praizers">
      <?php if ( pzdc_has_votes(array('per_page' => 50)) ) : ?>
        <?php while ( pzdc_votes_loop() ) : ?>
          <li>
            <a href="<?php pzdc_user_permalink(); ?>"><?php pzdc_user_login(); ?></a>
          </li>
        <?php endwhile; ?>
      <?php else:?>
        <li><?php pzdc_e('No praizers'); ?></li>
      <?php endif;?>   
    </ul>
  </div>
    
  <?php pzdc_paginate(); ?>

<?php else:?>
   <p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>
