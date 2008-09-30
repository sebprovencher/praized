<?php
/**
 * Praized template fragment: User profile
 *
 * @version 1.5
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_user() ) : ?>
 
  <?php pzdc_tpt_fragment('user/hcard'); ?>
  
  <div id="praized-activity" class="praized-user-section">
    <h3 class="praized-user-section-title"><?php pzdc_e('Activity Stream'); ?></h3>
    <p class="praized-user-activity" style="padding-left: 25px;">
      <?php if ( pzdc_has_actions(array('per_page' => 5)) ) : ?>
        <?php while ( pzdc_actions_loop() ) : ?>
          <div class="praized-action-item" style="border:none;">
            <span class=""><?php pzdc_action_summary(); ?></span>
            <br />
            <small><abbr title="<?php pzdc_action_created_at(); ?>"><?php pzdc_time_distance(pzdc_action_created_at(FALSE)); ?></abbr></small>
          </div>
        <?php endwhile; ?>
        <a href="<?php pzdc_user_permalink('actions'); ?>"><?php pzdc_e('See all activity'); ?></a>
      <?php else:?>
        <span><?php pzdc_e('No activity'); ?></span>
      <?php endif;?>
    </p>
  </div>

  <div id="praized-friends" class="praized-user-section">
    <h3 class="praized-user-section-title"><?php pzdc_user_friend_count(); ?> <?php pzdc_e('Friends'); ?></h3>
    <p class="praized-user-friends">
      <?php if ( pzdc_has_friends(array('per_page' => 5)) ) : ?>
        <?php while ( pzdc_friends_loop() ) : ?>
          <a href="<?php pzdc_friend_permalink(); ?>"><?php pzdc_friend_login(); ?></a><?php if ( pzdc_has_next_friend() ) { echo ", "; } ?>
        <?php endwhile; ?>
        <?php if ( pzdc_user_friend_count(FALSE) > 5 ) : ?>
          <a href="<?php pzdc_user_permalink('friends'); ?>"><?php pzdc_e('See all friends'); ?></a>
        <?php endif;?>
      <?php else: ?>
        <span class="nofriends"><?php pzdc_e('No friend yet'); ?></span>
      <?php endif;?>
    </p>
  </div>

  <div id="praized-favorites" class="praized-user-section">
    <h3 class="praized-user-section-title"><?php pzdc_user_favorite_count(); ?> <?php pzdc_e('Favorites'); ?></h3>
    <ul class="praized-user-favorites">
      <?php if ( pzdc_has_favorites(array('per_page' => 5)) ) : ?>
        <?php while ( pzdc_favorites_loop() ) : ?>
          <li >
            <span class="praized-inline-merchant">
              <big>
                <a rel="bookmark" href="<?php pzdc_merchant_permalink(); ?>" class="praized-merchant-vote <?php pzdc_merchant_target_rating(); ?>"><b class="praized-value"><span class="praized-nominator"><?php pzdc_merchant_vote_pos_count(); ?></span><span class="praized-separator">/</span><span class="praized-denominator"><?php pzdc_merchant_vote_count(); ?></span></b>&nbsp;<?php pzdc_merchant_name(); ?></a>
              </big>
			  <br />
              <span class="praized-merchant-address">
                <?php pzdc_merchant_street_address(); ?>,
                <?php pzdc_merchant_city_name(); ?>
              </span>
            </span>
          </li>
        <?php endwhile; ?>
        <?php if ( pzdc_user_favorite_count(FALSE) > 5 ) : ?>
          <li ><a href="<?php pzdc_user_permalink('favorites'); ?>"><?php pzdc_e('See all favorites'); ?></a></li>
        <?php endif;?>
      <?php else:?>
        <li><?php pzdc_e('No favorite'); ?></li>
      <?php endif;?>   
    </ul>
  </div>

  <div id="praized-votes" class="praized-user-section">
    <h3 class="praized-user-section-title"><?php pzdc_user_vote_count(); ?> <?php pzdc_e('Votes'); ?></h3>
    <ul class="praized-user-votes">
      <?php if ( pzdc_has_votes(array('per_page' => 5)) ) : ?>
        <?php while ( pzdc_votes_loop() ) : ?>
          <li >
            <span class="praized-inline-merchant">
              <big>
                <a rel="bookmark" href="<?php pzdc_merchant_permalink(); ?>" class="praized-merchant-vote <?php pzdc_merchant_target_rating(); ?>"><b class="praized-value"><span class="praized-nominator"><?php pzdc_merchant_vote_pos_count(); ?></span><span class="praized-separator">/</span><span class="praized-denominator"><?php pzdc_merchant_vote_count(); ?></span></b>&nbsp;<?php pzdc_merchant_name(); ?></a>
              </big>
              <br />
              <span class="praized-merchant-address">
                <?php pzdc_merchant_street_address(); ?>,
                <?php pzdc_merchant_city_name(); ?>
              </span>
            </span>
          </li>
        <?php endwhile; ?>
        <?php if ( pzdc_user_vote_count(FALSE) > 5 ) : ?>
          <li><a href="<?php pzdc_user_permalink('votes'); ?>"><?php pzdc_e('See all votes'); ?></a></li>
        <?php endif;?>
      <?php else:?>
        <li>No vote</li>
      <?php endif;?>   
    </ul>
  </div>

  <div id="praized-comments" class="praized-user-section">
    <h3 class="praized-user-section-title"><?php pzdc_user_comment_count(); ?> <?php pzdc_e('Comments'); ?></h3>
    <ul class="praized-user-comments commentlist">
      <?php if ( pzdc_has_comments(array('per_page' => 5)) ) : ?>
        <?php $i = 0; while ( pzdc_comments_loop() ) : ?>
          <li class="<?php if( ($i % 2) == 0){ echo "alt"; } ?>" id="comment-<?php echo $i; ?>">
            <span class="praized-inline-merchant">
              <big>
                <a rel="bookmark" href="<?php pzdc_merchant_permalink(); ?>" class="praized-merchant-vote <?php pzdc_merchant_target_rating(); ?>"><b class="praized-value"><span class="praized-nominator"><?php pzdc_merchant_vote_pos_count(); ?></span><span class="praized-separator">/</span><span class="praized-denominator"><?php pzdc_merchant_vote_count(); ?></span></b> <?php pzdc_merchant_name(); ?></a>
              </big>
              <br />
              <span class="praized-merchant-address">
                <?php pzdc_merchant_street_address(); ?>,
                <?php pzdc_merchant_city_name(); ?>
              </span>
            </span>
            <small class="commentmetadata"><abbr title="<?php pzdc_comment_created_at(); ?>"><?php pzdc_time_distance(pzdc_comment_created_at(FALSE)); ?></abbr></small>
            <p><?php pzdc_comment_body(); ?></p>
          </li>
        <?php ++$i; endwhile; ?>
        <?php if ( pzdc_user_comment_count(FALSE) > 5 ) : ?>
          <li><a href="<?php pzdc_user_permalink('comments'); ?>"><?php pzdc_e('See all comments'); ?></a></li>
        <?php endif;?>
      <?php else: ?>
        <li><?php pzdc_e('No comment'); ?></li>
      <?php endif;?>
    </ul>
  </div>

<?php else:?>
  <p><?php pzdc_e('The requested user cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>
