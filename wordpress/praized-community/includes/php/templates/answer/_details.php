<?php
/**
 * Praized template fragment: Answer details
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<div class="praized-answer-details">
	<?php if ( pzdc_has_answer() ) : ?>

	  <h2 class="praized-question-header"><?php printf(pzdc__('<a href="%s">%s</a>\'s'), pzdc_user_permalink('', FALSE), pzdc_user_display_name(FALSE)); ?> <?php pzdc_e('answer'); ?></h2>

	  <?php if ( pzdc_has_question() ) : /* VERY IMPORTANT TO RESET THE VALUE OF $PraizedCommunity->tpt_user */ ?>
		<div style="margin-bottom: 30px;">
			<a href="<?php pzdc_user_permalink(); ?>"><img src="<?php pzdc_user_avatar_small(); ?>" width="40" height="40" border="0" style="float:left; margin-right: 10px;"/></a>
			<div>
				<a href="<?php pzdc_user_permalink(); ?>"><?php pzdc_user_display_name(); ?></a> <a href="<?php pzdc_question_permalink(); ?>"><?php pzdc_e('asked')?></a> <?php pzdc_time_distance(pzdc_question_created_at(FALSE)); ?>
		    	<?php if ( pzdc_community_is_hub() ) : ?>
		    		<?php pzdc_e('via') ?> <a href="<?php pzdc_question_community_base_url(); ?>"><?php pzdc_question_community_name(); ?></a>
		    	<?php endif; ?>:
				<p style="margin-top:5px;"><strong><?php pzdc_question_content(); ?></strong></p>
			</div>
		</div>
	  <?php else:?>
	    <p><?php pzdc_e('The requested question cannot be found.'); ?></p>
	  <?php endif;?>

	  <?php if ( pzdc_has_answer() ) : /* VERY IMPORTANT TO RESET THE VALUE OF $PraizedCommunity->tpt_user */ ?>
	    <?php $parent_answer_pid = pzdc_answer_pid(FALSE); ?>
	    <div class="praized-action-item" style="margin-top: 20px;">
		  <a href="<?php pzdc_user_permalink(); ?>"><img src="<?php pzdc_user_avatar_small(); ?>" width="40" height="40" border="0" style="float:left; margin-right: 10px;"/></a>
	      <a href="<?php pzdc_user_permalink(); ?>"><?php pzdc_user_display_name(); ?></a> <?php printf(pzdc__('gave an <a href="%s">%s</a>'), pzdc_answer_permalink(FALSE), pzdc__('answer')); ?> <?php pzdc_time_distance(pzdc_answer_created_at(FALSE)); ?>
		    	<?php if ( pzdc_community_is_hub() ) : ?>
		    		<?php pzdc_e('via') ?> <a href="<?php pzdc_answer_community_base_url(); ?>"><?php pzdc_answer_community_name(); ?></a>
		    	<?php endif; ?>:
	      <?php if ( pzdc_is_authorized() && ( pzdc_user_login(FALSE) == pzdc_current_user_login(FALSE) ) ) :?>
	        <form action="<?php pzdc_answer_permalink(); ?>" method="post" style="float:right; margin:0; padding:0;">
	          <input type="hidden" name="_action" value="delete" />
	          <button type="submit"><?php pzdc_e('Delete'); ?></button>
	        </form>
	      <?php endif;?>
		  <?php if ( $content = pzdc_answer_content(FALSE) ) : ?>
		    <p style="margin-top:5px;margin-bottom:15px;"><em><?php echo $content; ?></em></p>
		  <?php else : ?>
		  	<br clear="all" />
		  <?php endif;?>
		  <?php pzdc_answer_merchants(); ?>
		  <br clear="all" />
	    </div>
	  <?php endif;?>

	  <p style="text-align:right;padding-bottom:10px;"><?php printf('<a href="%s">%s</a>', pzdc_question_permalink(FALSE) , pzdc__('You can provide your own answer to this question by clicking here')) ?></p>

      <?php if ( pzdc_has_answers() ) : ?>
        <h2><?php pzdc_e('Other answers'); ?></h2>
        <?php while ( pzdc_answers_loop() ) : ?>
          <?php if (pzdc_answer_pid(FALSE) != $parent_answer_pid ) : ?>
	        <div class="praized-action-item" style="margin-top: 20px;">
			  <a href="<?php pzdc_user_permalink(); ?>"><img src="<?php pzdc_user_avatar_small(); ?>" width="40" height="40" border="0" style="float:left; margin-right: 10px;"/></a>
	          <a href="<?php pzdc_user_permalink(); ?>"><?php pzdc_user_display_name(); ?></a> <?php printf(pzdc__('gave an <a href="%s">%s</a>'), pzdc_answer_permalink(FALSE), pzdc__('answer')); ?> <?php pzdc_time_distance(pzdc_answer_created_at(FALSE)); ?>
			  <?php if ( pzdc_community_is_hub() ) : ?>
				<?php pzdc_e('via') ?> <a href="<?php pzdc_answer_community_base_url(); ?>"><?php pzdc_answer_community_name(); ?></a>
			  <?php endif; ?>:
	          <?php if ( pzdc_is_authorized() && ( pzdc_user_login(FALSE) == pzdc_current_user_login(FALSE) ) ) :?>
	            <form action="<?php pzdc_answer_permalink(); ?>" method="post" style="float:right; margin:0; padding:0;">
	              <input type="hidden" name="_action" value="delete" />
	              <button type="submit"><?php pzdc_e('Delete'); ?></button>
	            </form>
	          <?php endif;?>
			  <?php if ( $content = pzdc_answer_content(FALSE) ) : ?>
			    <p style="margin-top:5px;margin-bottom:15px;"><em><?php echo $content; ?></em></p>
			  <?php else : ?>
			  	<br clear="all" />
			  <?php endif;?>
			  <?php pzdc_answer_merchants(); ?>
			  <br clear="all" />
	        </div>
	      <?php endif;?>
        <?php endwhile; ?>
      <?php endif;?>

	<?php else:?>
	  <p><?php pzdc_e('The requested answer cannot be found.'); ?></p>
	<?php endif;?>
</div>

<?php pzdc_credits(); ?>