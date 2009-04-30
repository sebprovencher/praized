<?php
/**
 * Praized template fragment: User-level screen to let users reset their password (step 2)
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<h2><?php pzdc_e('Reset Your Password: Step 2'); ?></h2>
		
<?php pzdc_required_fields(); ?>

<p id="praized_required_errors" class="praized_required"><?php pzdc_user_confirmation_message(); ?></p>

<?php if ( ( count($_POST) < 1 ) || ( count($_POST) > 0 && pzdc_user_confirmation_error() ) ) : ?>
		
	<p class="praized_required">* <?php pzdc_e('Indicates required fields'); ?></p>

	<form action="<?php pzdc_community_base_url(); ?>/users/reset_password/<?php pzdc_user_confirmation_key(); ?>" method="post" class="praized_ui_tab_box" id="praized_ui_tab_box_password_change" style="<?php echo $tabs['password_change']; ?>">
		<fieldset>
			<table>
				<tr>
					<td class="top left">
						<label for="user_password" class="praized_required"><?php pzdc_e('New password'); ?><sup>*</sup></label>:
					</td>
					<td class="right">
						<input class="password text" id="user_password" name="user_password" size="30" type="password" />
					</td>
				</tr>
				<tr>
					<td class="left">
						&nbsp;
					</td>
					<td class="right">
						<small>between 6 and 40 characters</small>
					</td>
				</tr>
				<tr>
					<td class="top left">
						<label for="user_password_confirmation" class="praized_required"><?php pzdc_e('Confirm password'); ?><sup>*</sup></label>:
					</td>
					<td class="right">
						<input class="password text" id="user_password_confirmation" name="user_password_confirmation" size="30" type="password" />
					</td>
				</tr>
			</table>
		</fieldset>
		<button class="submit" type="submit"><span class="value"><?php pzdc_e('Reset Password'); ?></span></button>
	</form>

<?php endif; ?>

<?php if ( count($_POST) > 0 && ! pzdc_user_confirmation_error() ) : ?>

	<p>
		<?php
			if ( pzdc_is_authorized() ) {
				printf(
					pzdc__('<a href="%s">Click here</a> to go back to your profile.'),
					pzdc_current_user_permalink(NULL, FALSE)
				);
			} else {
				printf(
					pzdc__('<a href="%s">Click here</a> to go back to our community\'s home page.'),
					pzdc_community_base_url(FALSE)
				);
			}
		?>
	</p>

<?php endif; ?>

<br clear="all" />

<?php pzdc_credits(); ?>