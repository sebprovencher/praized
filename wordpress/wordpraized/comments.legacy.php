<?php // Do not delete these lines

if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die (__('Please do not load this page directly. Thanks!', 'wordpraized'));

if (!empty($post->post_password)) { // if there's a password
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
		?>
			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'wordpraized'); ?></p>
		<?php
		return;
	}
}

/* This variable is for alternating comment background */
$oddcomment = 'class="alt" ';
?>

<!-- You can start editing here. -->

<?php if ($comments) : ?>
	
	<h3 id="comments"><?php comments_number(__('No Responses', 'wordpraized'), __('One Response', 'wordpraized'), __('% Responses', 'wordpraized'));?> <?php printf(__('to &#8220;%s&#8221;', 'wordpraized'), the_title('', '', false)); ?></h3>

	<ol class="commentlist">

	<?php foreach ($comments as $comment) : ?>

		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 32 ); ?>	
			<?php printf(__('<cite>%s</cite> Says:', 'wordpraized'), get_comment_author_link()); ?>
			<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('Your comment is awaiting moderation.', 'wordpraized'); ?></em>
			<?php endif; ?>
			<br />

			<small class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title=""><?php printf(__('%1$s at %2$s', 'wordpraized'), get_comment_date(__('F jS, Y', 'wordpraized')), get_comment_time()); ?></a> <?php edit_comment_link(__('edit', 'wordpraized'),'&nbsp;&nbsp;',''); ?></small>

			<?php comment_text() ?>

		</li>

	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>

	<?php endforeach; /* end for each comment */ ?>

	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'wordpraized'); ?></p>
	<?php endif; ?>

<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

    <h3 id="respond"><?php _e('Leave a Reply', 'wordpraized'); ?></h3>
    
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
            
            <p>
            	<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'wordpraized'); ?>" />
            	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
            </p>
            
            <?php do_action('comment_form', $post->ID); ?>
        
        </form>
    
    <?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
