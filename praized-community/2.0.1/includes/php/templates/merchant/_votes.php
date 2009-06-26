<?php
/**
 * Praized template fragment: Merchant vote listing, with paging
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
    
  <div id="praized-praizers" class="praized-user-section">
    <h3 class="praized-merchant-section-title"><?php pzdc_merchant_vote_count(); ?> <?php pzdc_e('Praizers'); ?></h3>
    <?php if ( pzdc_has_votes(array('per_page' => 50)) ) : ?>
        <ul class="praized-merchant-praizers">
        <?php while ( pzdc_votes_loop() ) : ?>
          <li style="padding-bottom: 10px;" class="praized-action-item">
          	<a href="<?php pzdc_user_permalink(); ?>" title="<?php pzdc_user_display_name(); ?>" style="float: right;"><img src="<?php pzdc_user_avatar_small(); ?>" border="none" alt="<?php pzdc_user_display_name(); ?>" style="margin-right: 5px; border: 1px solid;" /></a>
          	<span class="">
          	  <span class="buzz-icon voted-for">Voter</span>
          	</span>
          	<span class="buzz-action">
          	  <a href="<?php pzdc_user_permalink(); ?>" title="<?php pzdc_user_display_name(); ?>" style="font-weight: bold;"><?php pzdc_user_display_name(); ?></a>
          	</span>
	    	<br />
            <small>
		    	<abbr title="<?php pzdc_vote_created_at(); ?>"><?php pzdc_time_distance(pzdc_vote_created_at(FALSE)); ?></abbr>
		    	<?php if ( pzdc_community_is_hub() ) : ?>
		    		<?php pzdc_e('via') ?> <a href="<?php pzdc_vote_community_base_url(); ?>"><?php pzdc_vote_community_name(); ?></a>
		    	<?php endif; ?>
		    </small>
          	<br clear="all" />
          </li>
        <?php endwhile; ?>
        </ul>
    <?php else:?>
        <p><?php pzdc_e('No praizers'); ?></p>
    <?php endif;?>
  </div>
    
  <?php pzdc_paginate(); ?>

<?php else:?>
   <p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>
