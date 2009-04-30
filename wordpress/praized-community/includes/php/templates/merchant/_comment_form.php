<?php
/**
 * Praized template fragment: Merchant comment form
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_merchant_permalink(NULL, FALSE) ) : ?>
	<?php if ( pzdc_has_merchant() ) : ?>
	    <br clear="all" />
	    <fieldset class="comments-open" id="comments-open">
	        <legend class="comments-open-header"><?php pzdc_e('Leave a comment'); ?></legend>
	        <div class="comments-open-content">
	          <form action="<?php pzdc_merchant_permalink('comments'); ?>" method="post" name="comments_form" id="commentform">
	            <input type="hidden" name="tab" value="comments" />
	            <p>
	            	<?php
	            	    if ( ! pzdc_is_authorized() ) {
	            	    	printf(
				    	    	pzdc__('You will be prompted to <a href="%s">login</a> before your comment is saved.'),
				    	        pzdc_auth_link(FALSE)
				    	    );
	            	    } else {
		            		printf(
		            	    	pzdc__('Authorized as <a href="%s">%s</a>.'),
		            	        pzdc_current_user_permalink(NULL, FALSE),
		            	        pzdc_current_user_name(FALSE)
		            	    );
	            	    }
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
	    </fieldset>
	<?php else:?>
		<p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
	<?php endif;?>
<?php endif; ?>