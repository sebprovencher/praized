<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle"><?php _e('Search Results', 'wordpraized'); ?></h2>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'wordpraized')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'wordpraized')) ?></div>
		</div>


		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'wordpraized'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h3>
				<small><?php the_time('l, F jS, Y') ?></small>

				<p class="postmetadata"><?php the_tags(__('Tags:', 'wordpraized') . ' ', ', ', '<br />'); ?> <?php printf(__('Posted in %s', 'wordpraized'), get_the_category_list(', ')); ?> | <?php edit_post_link(__('Edit', 'wordpraized'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;', 'wordpraized'), __('1 Comment &#187;', 'wordpraized'), __('% Comments &#187;', 'wordpraized'), '', __('Comments Closed', 'wordpraized') ); ?></p>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'wordpraized')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'wordpraized')) ?></div>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e('No posts found. Try a different search?', 'wordpraized'); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
