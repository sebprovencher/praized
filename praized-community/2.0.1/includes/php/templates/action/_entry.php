<?php
/**
 * Praized template fragment: Individual action entry
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_action() ) : ?>
  <div class="praized-action-item">
    <span class=""><?php pzdc_action_summary(); ?></span>
    <?php if ( pzdc_action_type(FALSE) == 'comment' ) : ?>
    	<br />
    	<blockquote><?php pzdc_action_comment_body(); ?></blockquote>
    <?php elseif ( pzdc_action_type(FALSE) == 'question' ) : ?>
    	<br />
    	<blockquote><?php pzdc_action_question_content(); ?></blockquote>
    <?php elseif ( pzdc_action_type(FALSE) == 'answer' ) : ?>
    	<br />
    	<blockquote><?php pzdc_action_answer_content(); ?></blockquote>
    	<?php pzdc_action_answer_merchants(); ?>
    <?php endif; ?>
    <br clear="all" />
    <small>
    	<abbr title="<?php pzdc_action_created_at(); ?>"><?php pzdc_time_distance(pzdc_action_created_at(FALSE)); ?></abbr>
    	<?php if ( pzdc_community_is_hub() ) : ?>
    		<?php pzdc_e('via') ?> <a href="<?php pzdc_action_community_base_url(); ?>"><?php pzdc_action_community_name(); ?></a>
    	<?php endif; ?>
    </small>
  </div>
<?php endif;?>
