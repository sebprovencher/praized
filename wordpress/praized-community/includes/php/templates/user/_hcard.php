<?php
/**
 * Praized template fragment: User hcard
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
  <div class="praized-user vcard">
    <img src="<?php pzdc_user_avatar_medium(); ?>" border="none" alt="<?php pzdc_user_display_name(); ?>" style="float:right;" />
    
    <h2 class="fn">
      <a href="<?php pzdc_user_permalink(); ?>" class="fn"><?php pzdc_page_header(); ?></a>
    </h2>

    <ul>
      <li>
      	<strong><?php pzdc_e('User since'); ?>:</strong>
		<abbr title="<?php pzdc_user_created_at(); ?>"><?php pzdc_user_created_at(TRUE, pzdc__('%a, %B %e %Y at %H:%M:%S')); ?></abbr>
	  </li>
      <?php if ( pzdc_user_city_name(FALSE) ) : ?>
        <li class="adr">
          <strong><?php pzdc_e('Location'); ?>:</strong> 
          <span class="locality"><?php pzdc_user_city_name(); ?></span>
        </li>
      <?php endif; ?>
      <?php if ( pzdc_user_about(FALSE) ) : ?>
        <li>
          <strong><?php pzdc_e('About'); ?>:</strong> 
          <?php pzdc_user_about(); ?>
        </li>
      <?php endif; ?>
      <?php if ( pzdc_user_claim_to_fame(FALSE) ) : ?>
        <li>
          <strong><?php pzdc_e('Claim to fame'); ?>:</strong> 
          <?php pzdc_user_claim_to_fame(); ?>
        </li>
      <?php endif; ?>
    </ul>
  
    <?php if ( pzdc_is_authorized() && ! pzdc_user_is_self() ) :?>
      <div class="praized-add-to-friends">
        <form action="<?php pzdc_user_permalink('friends'); ?>" method="post">
          <?php if ( pzdc_user_is_friend() ) :?>
            <input type="hidden" name="_action" value="delete" />
            <button type="submit"><?php pzdc_e('Remove from my friends'); ?></button>
          <?php else: ?>
          	<input type="hidden" name="_action" value="add" />
            <button type="submit"><?php pzdc_e('Add to my friends'); ?></button>
          <?php endif; ?>
        </form>
      </div>
    <?php elseif ( pzdc_is_authorized() && pzdc_user_is_self() ) :?>
      <div class="praized-manage-profile">
        <a href="<?php pzdc_current_user_permalink('edit'); ?>" class="praized-action"><?php pzdc_e('Manage your profile'); ?></a>  
      </div>
    <?php endif; ?>
  </div>  
<?php else:?>
  <p><?php pzdc_e('The requested user cannot be found.'); ?></p>
<?php endif;?>
