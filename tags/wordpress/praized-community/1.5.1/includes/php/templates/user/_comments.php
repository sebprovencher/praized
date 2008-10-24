<?php
/**
 * Praized template fragment: User comment listing, with paging
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

  <div id="praized-comments" class="praized-user-section">
    <h3 class="praized-user-section-title"><?php pzdc_user_comment_count(); ?> <?php pzdc_e('Comments'); ?></h3>
    <ol class="praized-user-comments commentlist">
      <?php if ( pzdc_has_comments() ) : ?>
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
      <?php else: ?>
        <li><?php pzdc_e('No comment'); ?></li>
      <?php endif;?>
    </ol>
  </div>

  <?php pzdc_paginate(); ?>

<?php else:?>
   <p><?php pzdc_e('The requested user cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>