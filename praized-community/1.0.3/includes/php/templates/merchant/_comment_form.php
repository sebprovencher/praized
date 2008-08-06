<?php
/**
 * Praized template fragment: Merchant comment form
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
    <?php if ( pzdc_is_authorized() ) :?>
      <div class="comments-open" id="comments-open">
        <h2 class="comments-open-header"><?php pzdc_e('Leave a comment'); ?></h2>
        <div class="comments-open-content">
          <form action="<?php pzdc_merchant_permalink('comments'); ?>" method="post" name="comments_form" id="commentform">
            <p>
            	<?php
            	    printf(
            	    	pzdc__('Authorized as <a href="%s">%s</a>.'),
            	        pzdc_current_user_permalink(NULL, FALSE),
            	        pzdc_current_user_login(FALSE)
            	    );
            	?>
			</p>
            <div style="display: block;" id="comments-open-text">
              <textarea id="comment-text" class="text" cols="50" id="comment_comment" name="comment" rows="5"></textarea>
            </div>
            <div style="display: block;" id="comments-open-footer">
              <button id="submit" class="submit button" name="commit" type="submit"><?php pzdc_e('Add my comment'); ?></button>
            </div>
          </form>
        </div>
      </div>
    <?php else: ?>
      <div class="comments-open" id="comments-open">
        <?php
    	    printf(
    	    	pzdc__('You need to <a href="%s">login to the praized network</a> in order to leave a comment.'),
    	        pzdc_auth_link(FALSE)
    	    );
    	?>
      </div>
    <?php endif; ?>
<?php else:?>
	<p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
<?php endif;?>
