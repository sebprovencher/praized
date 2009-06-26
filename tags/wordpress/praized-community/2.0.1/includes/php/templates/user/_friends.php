<?php
/**
 * Praized template fragment: User friend listing, with paging
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
    
  <div id="praized-friends" class="praized-user-section">
    <h3 class="praized-user-section-title"><?php pzdc_user_friend_count(); ?> <?php pzdc_e('Friends'); ?></h3>
    <?php if ( pzdc_has_friends(array('per_page' => 50)) ) : ?>
        <ul class="praized-merchant-praizers" style="padding-left:0; margin-left:5px;">
	    	<?php while ( pzdc_friends_loop() ) : ?>
		        <li style="padding-bottom: 10px;" class="praized-action-item">
		          	<a href="<?php pzdc_friend_permalink(); ?>" title="<?php pzdc_friend_display_name(); ?>" style="float: right;"><img src="<?php pzdc_friend_avatar_small(); ?>" border="none" alt="<?php pzdc_friend_display_name(); ?>" style="margin-right: 5px; border: 1px solid;" /></a>
		          	<span class="buzz-action" style="padding-left:0;">
		          	  <a href="<?php pzdc_friend_permalink(); ?>" title="<?php pzdc_friend_display_name(); ?>" style="font-weight: bold;"><?php pzdc_friend_display_name(); ?></a>
		          	</span>
		          	<br clear="all" />
	            </li>
            <?php endwhile; ?>
        </ul>
      <?php else:?>
        <p><?php pzdc_e('No friend yet'); ?></p>
    <?php endif;?>  
  </div>
    
  <?php pzdc_paginate(); ?>

<?php else:?>
  <p><?php pzdc_e('The requested user cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>
