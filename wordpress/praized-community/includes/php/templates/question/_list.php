<?php
/**
 * Praized template fragment: Question listing, with paging
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<h2 class="praized-questions-header"><?php pzdc_page_header(); ?></h2>

<p class="praized-questions-sub-header"><strong><?php pzdc_e('Looking for a particular place?'); ?></strong> <span><?php pzdc_e('Ask your friends!'); ?></span></p>

<?php pzdc_tpt_fragment('question/form'); ?>

<br />

<p class="praized-questions-sub-header"><strong><?php pzdc_e('Got Answers?'); ?></strong> <span><?php pzdc_e('Tackle a question.'); ?></span></p>

<form class="praized-questions-list" action="#" method="get">
  <?php if ( pzdc_has_questions() ) : ?>
      <?php while ( pzdc_questions_loop() ) : ?>
        <?php
        $answer_count = (int) pzdc_question_answer_count(FALSE);
        $answer_count_caption = ( $answer_count < 1 )
                              ? pzdc__('No answers so far')
                              : ( ( $answer_count == 1 )
                                  ? $answer_count .' '. pzdc__('answer so far')
                                  : $answer_count .' '. pzdc__('answers so far') );
        ?>
         <div class="praized-action-item" style="margin-top: 20px;">
        	<a href="<?php pzdc_user_permalink(); ?>"><img src="<?php pzdc_user_avatar_small(); ?>" width="40" height="40" border="0" style="float:left; margin-right: 10px;"/></a>
        	<a href="<?php pzdc_user_permalink(); ?>"><?php pzdc_user_display_name(); ?></a> <?php pzdc_e('asked') ?> <?php pzdc_time_distance(pzdc_question_created_at(FALSE)); ?>
	    	<?php if ( pzdc_community_is_hub() ) : ?>
	    		<?php pzdc_e('via') ?> <a href="<?php pzdc_question_community_base_url(); ?>"><?php pzdc_question_community_name(); ?></a>
	    	<?php endif; ?>:
			<a href="<?php pzdc_question_permalink(); ?>" class="praized-action" style="float:right; padding:4px;"><?php pzdc_e('Answer') ?></a>
        	<p style="margin-top:5px;"><em><?php pzdc_question_content(); ?></em></p>
			<small><a href="<?php pzdc_question_permalink(); ?>"><?php echo  "{$answer_count_caption} &raquo;"; ?></a></small>
			<br clear="all" />
        </div>
      <?php endwhile; ?>
  <?php else:?>
    <?php pzdc_tpt_fragment('question/no_results'); ?>
  <?php endif;?>
  <?php pzdc_paginate(); ?>
</form>

<?php pzdc_credits(); ?>