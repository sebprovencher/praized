<?php
/**
 * Praized template fragment: Merchant comment listing, with paging
 *
 * @version 1.6
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_merchant() ) : ?>

  <?php pzdc_tpt_fragment('merchant/hcard'); ?>

  <div id="praized-comments" class="praized-merchant-section">
    <h3 class="praized-merchant-section-title"><?php pzdc_merchant_comment_count(); ?> <?php pzdc_e('Comments'); ?></h3>
    <ol class="praized-merchant-comments commentlist">
      <?php if ( pzdc_has_comments() ) : ?>
        <?php $i = 0; while ( pzdc_comments_loop() ) : ?>
          <li class="<?php if( ($i % 2) == 0){ echo "alt"; } ?>" id="comment-<?php echo $i; ?>">
            <img src="<?php pzdc_user_avatar_small(); ?>" width="40" height="40" border="none" alt="<?php pzdc_user_login(); ?>" style="float:right;" />
            <cite><a href="<?php pzdc_user_permalink(); ?>" rel="external nofollow"><?php pzdc_user_login(); ?></a></cite> <?php pzdc_e('says'); ?>:<br />
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
  <?php pzdc_tpt_fragment('merchant/comment_form'); ?>

<?php else:?>
   <p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>