<?php
/**
 * Praized template fragment: Individual action entry
 *
 * @version 1.5
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
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
    <?php endif; ?>
    <br />
    <small><abbr title="<?php pzdc_action_created_at(); ?>"><?php pzdc_time_distance(pzdc_action_created_at(FALSE)); ?></abbr></small>
  </div>
<?php endif;?>