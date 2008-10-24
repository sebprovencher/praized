<?php
/**
 * Praized template fragment: Merchant profile
 *
 * @version 1.5
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_merchant() ) : ?>
  
  <?php pzdc_tpt_fragment('merchant/hcard'); ?>
  
  <div id="praized-google-static-map" class="praized-merchant-section">  
    <?php pzdc_merchant_map(); ?>
  </div>
  
  <div id="praized-activity" class="praized-merchant-section">
    <h3 class="praized-merchant-section-title"><?php pzdc_e('Activity Stream'); ?></h3>
    <p class="praized-merchant-activity" style="padding-left: 25px;">
      <?php if ( pzdc_has_actions(array('per_page' => 5)) ) : ?>
        <?php while ( pzdc_actions_loop() ) : ?>
          <div class="praized-action-item" style="border:none;">
            <span class=""><?php pzdc_action_summary(); ?></span>
            <br />
            <small><abbr title="<?php pzdc_action_created_at(); ?>"><?php pzdc_time_distance(pzdc_action_created_at(FALSE)); ?></abbr></small>
          </div>
        <?php endwhile; ?>
        <a href="<?php pzdc_merchant_permalink('actions'); ?>"><?php pzdc_e('See all activity'); ?></a>
      <?php else:?>
        <span><?php pzdc_e('No activity'); ?></span>
      <?php endif;?>
    </p>
  </div>
  
  <div id="praized-favorites" class="praized-merchant-section">
    <h3 class="praized-merchant-section-title"><?php pzdc_merchant_favorite_count(); ?> <?php pzdc_e('Favorers'); ?></h3>
    <p class="praized-merchant-favorers">
      <?php if ( pzdc_has_favorites(array('per_page' => 5)) ) : ?>
        <?php while ( pzdc_favorites_loop() ) : ?>
          <a href="<?php pzdc_user_permalink(); ?>"><?php pzdc_user_login(); ?></a><?php if ( pzdc_has_next_favorite() ){ echo ", ";} ?>
        <?php endwhile; ?>
        <?php if ( pzdc_merchant_favorite_count(FALSE) > 5 ) : ?>
          <a href="<?php pzdc_merchant_permalink('favorites'); ?>"><?php pzdc_e('See all favorers'); ?></a>
        <?php endif;?>
      <?php else: ?>
        <span><?php pzdc_e('No favorer'); ?></span>
      <?php endif;?>
    </p>
  </div>
  
  <div id="praized-votes" class="praized-merchant-section">
    <h3 class="praized-merchant-section-title"><?php pzdc_merchant_vote_count(); ?> <?php pzdc_e('Praizers'); ?></h3>
    <p class="praized-merchant-praizers">
      <?php if ( pzdc_has_votes(array('per_page' => 5)) ) : ?>
        <?php while ( pzdc_votes_loop() ) : ?>
          <a href="<?php pzdc_user_permalink(); ?>"><?php pzdc_user_login(); ?></a><?php if ( pzdc_has_next_vote() ){ echo ", ";} ?>
        <?php endwhile; ?>
        <?php if ( pzdc_merchant_vote_count(FALSE) > 5 ) : ?>
          <a href="<?php pzdc_merchant_permalink('votes'); ?>"><?php pzdc_e('See all praizers'); ?></a>
        <?php endif;?>
      <?php else: ?>
        <span ><?php pzdc_e('No praizer'); ?></span>
      <?php endif;?>
    </p>
  </div>

  <div id="praized-comments" class="praized-merchant-section">
    <h3 class="praized-merchant-section-title"><?php pzdc_merchant_comment_count(); ?> <?php pzdc_e('Comments'); ?></h3>
    <ol class="praized-merchant-comments commentlist">
      <?php if ( pzdc_has_comments(array('per_page' => 5)) ) : ?>
        <?php $i = 0; while ( pzdc_comments_loop() ) : ?>
          <li class="<?php if( ($i % 2) == 0){ echo "alt"; } ?>" id="comment-<?php echo $i; ?>">
            <cite><a href="<?php pzdc_user_permalink(); ?>" rel="external nofollow"><?php pzdc_user_login(); ?></a></cite> <?php pzdc_e('says'); ?>:<br />
            <small class="commentmetadata"><abbr title="<?php pzdc_comment_created_at(); ?>"><?php pzdc_time_distance(pzdc_comment_created_at(FALSE)); ?></abbr></small>
            <p><?php pzdc_comment_body(); ?></p>
          </li>
        <?php ++$i; endwhile; ?>
        <?php if ( pzdc_merchant_comment_count(FALSE) > 5 ) : ?>
          <li ><a href="<?php pzdc_merchant_permalink('comments'); ?>"><?php pzdc_e('See all comments'); ?></a></li>
        <?php endif;?>
      <?php else: ?>
        <li><?php pzdc_e('No comment'); ?></li>
      <?php endif;?>
    </ol>
  </div>
  <?php pzdc_tpt_fragment('merchant/comment_form'); ?>
  
<?php else:?>
   <p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>
