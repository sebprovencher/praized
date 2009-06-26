<?php
/**
 * Praized template fragment: Question form
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

$form_id     = 'praized-question-form';
$fancy_id    = $form_id . '-fancy';
$text_id     = $form_id . '-text';
$switch_id   = $form_id . '-switcher';
$services_id = $form_id . '-services';

$switch_capt_to_fancy = pzdc__('Give me a guided box for my question');
$switch_capt_to_text  = pzdc__('Give me a blank box for my question');

$random_adjective = pzdc_questions_random_qualifier('adjective', FALSE);
$random_what      = pzdc_questions_random_qualifier('what', FALSE);
$random_where     = pzdc_questions_random_qualifier('where', FALSE);
?>
<script type="text/javascript">
	function interfaceSwitcher() {
		var fancyDiv = document.getElementById('<?php echo $fancy_id; ?>');
		var textDiv = document.getElementById('<?php echo $text_id; ?>');
		var switchDivLink = document.getElementById('<?php echo $switch_id; ?>-link');
		if ( fancyDiv.style.display == 'none' ) {
			fancyDiv.style.display = 'block';
			setFancy('set');
			textDiv.style.display = 'none';
			switchDivLink.innerHTML = '<?php echo $switch_capt_to_text; ?>';
		} else {
			setFancy('clear');
			fancyDiv.style.display = 'none';
			textDiv.style.display = 'block';
			document.getElementById('<?php echo $text_id; ?>-content').focus();
			switchDivLink.innerHTML = '<?php echo $switch_capt_to_fancy; ?>';
		}
	}

	function setFancy(action) {
		if ( ! action || action != 'set')
			action = 'clear';
		if ( action == 'set' ) {
			document.getElementById('switch_toggle_status').value = 'complex';
			document.getElementById('<?php echo $fancy_id; ?>-adjective').value = document.getElementById('random_adjective').value;
			document.getElementById('<?php echo $fancy_id; ?>-what').value      = document.getElementById('random_what').value;
			document.getElementById('<?php echo $fancy_id; ?>-where').value     = document.getElementById('random_where').value;
		} else {
			document.getElementById('switch_toggle_status').value = 'simple';
			document.getElementById('<?php echo $fancy_id; ?>-adjective').value = '';
			document.getElementById('<?php echo $fancy_id; ?>-what').value      = '';
			document.getElementById('<?php echo $fancy_id; ?>-where').value     = '';
		}
	}
</script>

<?php pzdc_required_fields(); ?>

<form id="<?php echo $form_id; ?>" action="<?php pzdc_community_base_url(); ?>/questions/" method="post">
	<input type="hidden" name="switch_toggle_status" id="switch_toggle_status" value="complex" />
	<input type="hidden" name="random_adjective" id="random_adjective" value="<?php echo $random_adjective; ?>" />
	<input type="hidden" name="random_what" id="random_what" value="<?php echo $random_what; ?>" />
	<input type="hidden" name="random_where" id="random_where" value="<?php echo $random_where; ?>" />
	<fieldset style="text-align:center;">
    	<div id="<?php echo $fancy_id; ?>">
    		<?php pzdc_e('Does anyone know a'); ?>
    		<input type="text" name="adjective" id="<?php echo $fancy_id; ?>-adjective" value="<?php echo $random_adjective; ?>" size="8" />
    		<input type="text" name="what" id="<?php echo $fancy_id; ?>-what" value="<?php echo $random_what; ?>" size="11" />
    		<?php pzdc_e('in'); ?>
    		<input type="text" name="where" id="<?php echo $fancy_id; ?>-where" value="<?php echo $random_where; ?>" size="11" />
    		?
    	</div>
    	<div id="<?php echo $text_id; ?>" style="display:none;">
    		<textarea name="content" id="<?php echo $text_id; ?>-content" rows="2" cols="55" style="width:99%"></textarea>
    	</div>
    	<div id="<?php echo $switch_id; ?>" style="float: right; margin-top: 4px;">
    		<small><a href="javascript:interfaceSwitcher();" id="<?php echo $switch_id; ?>-link"><?php echo $switch_capt_to_text; ?></a></small>
    	</div>
	</fieldset>
	<fieldset id="<?php echo $services_id; ?>" style="border-top:0;margin-top:0">
		<div id="<?php echo $services_id; ?>-caption" style="float: right;">
			<?php
				if ( pzdc_is_authorized() )
					$notification_setting_link = pzdc_current_user_permalink('edit', FALSE) . '?tab=notification_settings';
				else
					$notification_setting_link = pzdc_auth_link(FALSE);
			?>
			<small><a href="<?php echo $notification_setting_link; ?>"><?php pzdc_e('Add more networks'); ?></a></small>
		</div>
		<?php pzdc_e('Send via:'); ?>
		<?php pzdc_questions_user_broadcast_services(); ?>
	</fieldset>
	<fieldset style="text-align:right;padding:4px;border-top:0;margin-top:0;">
		<button type="submit"><?php pzdc_e('Ask'); ?></button>
	</fieldset>
</form>