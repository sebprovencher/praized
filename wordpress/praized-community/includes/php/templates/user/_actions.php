<?php
/**
 * Praized template fragment: Action listing, with paging
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_user() ) : ?>
 
	<div style="margin-top:15px;"><?php pzdc_tpt_fragment('search_form'); ?></div>

    <?php pzdc_tpt_fragment('user/hcard'); ?>
    
    <div id="praized-actions" class="praized-user-section">
      <h3 class="praized-user-section-title"><?php pzdc_e('Activity Stream'); ?></h3>
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
  <p><?php pzdc_e('The requested user cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>