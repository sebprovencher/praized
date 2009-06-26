<?php
/**
 * Praized template fragment: User-level screen to let users reset their password (step 1)
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<h2><?php pzdc_e('Reset Your Password: Step 1'); ?></h2>
		
<?php pzdc_required_fields(); ?>

<p id="praized_required_errors" class="praized_required"><?php pzdc_user_confirmation_message(); ?></p>

<?php if ( ( count($_POST) < 1 ) || ( ( count($_POST) > 0 ) && pzdc_user_confirmation_error() ) ) : ?>
		
	<p class="praized_required">* <?php pzdc_e('Indicates required fields'); ?></p>

	<form action="<?php pzdc_community_base_url(); ?>/users/forgot_password" method="post" class="praized_ui_tab_box" id="praized_ui_tab_box_password_change" style="<?php echo $tabs['password_change']; ?>">
		<fieldset>
			<table>
				<tr>
					<td class="top left">
						<label for="user_email" class="praized_required"><?php pzdc_e('Email'); ?><sup>*</sup></label>:
					</td>
					<td class="right">
						<input class="text" id="user_email" name="user_email" size="30" type="text" value="<?php echo $user_email; ?>" />
					</td>
				</tr>
			</table>
		</fieldset>
		<button class="submit" type="submit"><span class="value"><?php pzdc_e('Reset Password'); ?></span></button>
	</form>

<?php endif; ?>

<br clear="all" />

<?php pzdc_credits(); ?>