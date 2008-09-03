<?php
/**
 * Praized template fragment: User friend listing, with paging
 *
 * @version 1.0.4
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_user() ) : ?>

  <?php pzdc_tpt_fragment('user/hcard'); ?>
    
  <div id="praized-friends" class="praized-user-section">
    <h3 class="praized-user-section-title"><?php pzdc_user_friend_count(); ?> <?php pzdc_e('Friends'); ?></h3>
    <ul class="praized-user-friends">
      <?php if ( pzdc_has_friends(array('per_page' => 50)) ) : ?>
        <?php while ( pzdc_friends_loop() ) : ?>
          <li >
            <a href="<?php pzdc_friend_permalink(); ?>"><?php pzdc_friend_login(); ?></a>
          </li>
        <?php endwhile; ?>
      <?php else:?>
        <li ><?php pzdc_e('No friend yet'); ?></li>
      <?php endif;?>   
    </ul>
  </div>
    
  <?php pzdc_paginate(); ?>

<?php else:?>
  <p><?php pzdc_e('The requested user cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>
