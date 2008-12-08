<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die (__('Please do not load this page directly. Thanks!', 'wordpraized'));

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'wordpraized'); ?></p>
<?php
	return;
}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number(__('No Responses', 'wordpraized'), __('One Response', 'wordpraized'), __('% Responses', 'wordpraized'));?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<ol class="commentlist">
	<?php wp_list_comments(); ?>
	</ol>
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'wordpraized'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

    <div id="respond">
    
    <h3><?php comment_form_title( __('Leave a Reply', 'wordpraized'), __('Leave a Reply to %s', 'wordpraized') ); ?></h3>
    
    <div class="cancel-comment-reply">
    	<small><?php cancel_comment_reply_link(); ?></small>
    </div>
    
    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
    	<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'wordpraized'), get_option('siteurl') . '/wp-login.php?redirect_to=' . urlencode(get_permalink())); ?></p>
    <?php else : ?>
    
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        
        <?php if ( $user_ID ) : ?>
        
        	<p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'wordpraized'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'wordpraized'); ?>"><?php _e('Log out &raquo;', 'wordpraized'); ?></a></p>
        
        <?php else : ?>
        
            <p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
            <label for="author"><small><?php _e('Name', 'wordpraized'); ?> <?php if ($req) _e("(required)", "kubrick"); ?></small></label></p>
            
            <p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
            <label for="email"><small><?php _e('Mail (will not be published)', 'wordpraized'); ?> <?php if ($req) _e("(required)", "kubrick"); ?></small></label></p>
            
            <p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
            <label for="url"><small><?php _e('Website', 'wordpraized'); ?></small></label></p>
        
        <?php endif; ?>
        
        <!--<p><small><?php printf(__('<strong>XHTML:</strong> You can use these tags: <code>%s</code>', 'wordpraized'), allowed_tags()); ?></small></p>-->
        
        <p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>
        
        <p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'wordpraized'); ?>" />
            <?php comment_id_fields(); ?>
        </p>
        <?php do_action('comment_form', $post->ID); ?>
        
        </form>
        </div>
    
    <?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
