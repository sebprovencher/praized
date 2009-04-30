<?php
/**
 * Praized template fragment: User-level edit screen(s)
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_user() ) : ?>

	<?php if ( pzdc_user_is_self() ) : ?>
		
		<h2><?php pzdc_e('Profile Management'); ?>: <a href="<?php pzdc_user_permalink(); ?>" class="fn"><?php pzdc_page_header(); ?></a></h2>
		
		<p class="praized_required">* <?php pzdc_e('Indicates required fields'); ?></p>
		<br clear="all" />	
 
		<?php
			$default_tab = 'account_info';
			
			$tabs = array(
				$default_tab            => 'display: none;',
				'avatar'                => 'display: none;',
				'password_change'       => 'display: none;',
				'notification_settings' => 'display: none;'
			);
			
			if ( ! empty($_GET['tab']) )
				$tab = $_GET['tab'];
			else if ( ! empty($_POST['tab']) )
				$tab = $_POST['tab'];
			else
				$tab = $default_tab;
		
			if ( isset($tabs[$tab]) )
				$tabs[$tab] = 'display: block;';
			else {
				$tabs[$default_tab] = 'display: block;';
				$tab = $default_tab;
			}
		?>
		
		<ul id="praized_ui_tabs">
			<li id="praized_ui_tab_account_info"><a href="#praized_ui_tab_box_account_info"><?php pzdc_e('Profile'); ?></a></li>
			<li id="praized_ui_tab_avatar"><a href="#praized_ui_tab_box_avatar"><?php pzdc_e('Avatar'); ?></a></li>
			<li id="praized_ui_tab_password_change"><a href="#praized_ui_tab_box_password_change"><?php pzdc_e('Password'); ?></a></li>
			<li id="praized_ui_tab_notification_settings"><a href="#praized_ui_tab_box_notification_settings"><?php pzdc_e('Broadcast Settings'); ?></a></li>
		</ul>
		
		<div id="praized_ui_tab_container">
		
			<?php pzdc_required_fields(); ?>
			
			<!-- User Account Info Edit Form -->
			<?php
				$user_first_name    = pzdc_stripper( ( ! empty($_POST['user_first_name']) )    ? $_POST['user_first_name']    : pzdc_user_first_name(FALSE) );
				$user_last_name     = pzdc_stripper( ( ! empty($_POST['user_last_name']) )     ? $_POST['user_last_name']     : pzdc_user_last_name(FALSE) );
				$user_about         = pzdc_stripper( ( ! empty($_POST['user_about']) )         ? $_POST['user_about']         : pzdc_user_about(FALSE) );
				$user_city_name     = pzdc_stripper( ( ! empty($_POST['user_city_name']) )     ? $_POST['user_city_name']     : pzdc_user_city_name(FALSE) );
				$user_claim_to_fame = pzdc_stripper( ( ! empty($_POST['user_claim_to_fame']) ) ? $_POST['user_claim_to_fame'] : pzdc_user_claim_to_fame(FALSE) );
				
				// Can't use urldecode on email or it strips + signs...
				$user_email = htmlspecialchars(strip_tags(stripslashes(
					( ! empty($_POST['user_email']) )
					? $_POST['user_email']
					: pzdc_user_email(FALSE)
				)));
			?>
			<form action="<?php pzdc_current_user_permalink('edit'); ?>" method="post" class="praized_ui_tab_box" id="praized_ui_tab_box_account_info" style="<?php echo $tabs['account_info']; ?>">
				<input name="_method" type="hidden" value="put" />
				<input name="tab" type="hidden" value="account_info" />
				<fieldset>
					<legend><?php pzdc_e('Personal Information'); ?></legend>
					<table>
						<tr>
							<td class="left">
								<label for="user_first_name"><?php pzdc_e('First name'); ?></label>:
							</td>
							<td class="right">
								<input class="text" id="user_first_name" name="user_first_name" size="30" type="text" value="<?php echo $user_first_name; ?>" />
							</td>
						</tr>
						<tr>
							<td class="left">
								<label for="user_last_name"><?php pzdc_e('Last name'); ?></label>:
							</td>
							<td class="right">
								<input class="text" id="user_last_name" name="user_last_name" size="30" type="text" value="<?php echo $user_last_name; ?>" />
							</td>
						</tr>
						<tr>
							<td class="top left">
								<label for="user_email" class="praized_required"><?php pzdc_e('Email'); ?><sup>*</sup></label>:
							</td>
							<td class="right">
								<input class="text" id="user_email" name="user_email" size="30" type="text" value="<?php echo $user_email; ?>" />
							</td>
						</tr>
						<tr>
							<td class="left">
								&nbsp;
							</td>
							<td class="right">
								<small>
									<?php
										if ( pzdc_user_email_validated() )
											pzdc_e('You will be sent an email to confirm your email address if it is changed.');
										else
											printf(
												pzdc__('New email address validation pending. Please check your email. You can also <a href="%s">resend the address validation email</a> if needed.'),
												pzdc_community_base_url(FALSE) . '/users/resend_email_confirmation'
											);
									?>
								</small>
							</td>
						</tr>
					</table>
				</fieldset>
				<br clear="all" />
				<fieldset>
					<legend><?php pzdc_e('Other Information'); ?></legend>
					<table>
						<tr>
							<td class="left">
								<label for="user_location_city_name"><?php pzdc_e('City'); ?></label>:
							</td>
							<td class="right">
								<input class="text" id="user_location_city_name" name="user_location_city_name" size="30" type="text" value="<?php echo $user_city_name; ?>" />
							</td>
						</tr>
						<tr>
							<td class="top left">
								<label for="user_about"><?php pzdc_e('About'); ?></label>:
							</td>
							<td class="right">
								<textarea class="text" cols="40" id="user_about" name="user_about" rows="4"><?php echo $user_about; ?></textarea>
							</td>
						</tr>
						<tr>
							<td class="top left">
								<label for="user_claim_to_fame"><?php pzdc_e('Claim to fame'); ?></label>:
							</td>
							<td class="right">
								<textarea class="text" cols="40" id="user_claim_to_fame" name="user_claim_to_fame" rows="4"><?php echo $user_claim_to_fame; ?></textarea>
							</td>
						</tr>
					</table>
				</fieldset>
			 	<button class="submit" type="submit"><span class="value"><?php pzdc_e('Submit'); ?></span></button>
			</form>
			
			<!-- User Avatar Edit Form -->
			<form action="<?php pzdc_user_avatar_upload_url(); ?>" method="post" enctype="multipart/form-data" class="praized_ui_tab_box" id="praized_ui_tab_box_avatar" style="<?php echo $tabs['avatar']; ?>">
				<input name="tab" type="hidden" value="avatar" />
				<fieldset>
					<legend><?php pzdc_e('Manage Avatar'); ?></legend>
					<table>
						<tr>
							<td class="left">
								<label for="avatar_uploaded_data"><?php pzdc_e('Avatar'); ?></label>:
							</td>
							<td class="right">
								<input class="file" id="avatar_uploaded_data" name="avatar[uploaded_data]" size="30" type="file" />
							</td>
						</tr>
						<tr>
							<td class="left">
								&nbsp;
							</td>
							<td class="right">
								<small><?php pzdc_e('Maximum size of 500 kb (Gif, Jpg, Png)'); ?></small>
							</td>
						</tr>
						<tr>
							<td class="top left">
								<label for=""><?php pzdc_e('Current avatar'); ?></label>:
							</td>
							<td class="right">
								<img alt="<?php echo urlencode(pzdc_user_display_name(FALSE)); ?>" class="avatar" src="<?php pzdc_user_avatar_large(); ?>" />
							</td>
						</tr>
					</table>
				</fieldset>
				<button class="submit" type="submit"><span class="value"><?php pzdc_e('Submit'); ?></span></button>
				<br clear="all" />
				<fieldset>
					<legend><?php pzdc_e('Remove Avatar'); ?></legend>
					<table>
						<tr>
							<td class="left">
								<label for="remove_avatar"><?php pzdc_e('Delete'); ?></label>:
							</td>
							<td class="right">
								<input type="checkbox" class="checkbox" id="remove_avatar" name="remove_avatar" value="1" />
							</td>
						</tr>
					</table>
				</fieldset>
				<script type="text/javascript">
					function pzdc_avatar_delete_action() {
						if ( pcuie('remove_avatar').checked == true )
							top.location.href = '<?php pzdc_current_user_permalink('edit'); ?>?tab=avatar&remove_avatar=1';
						else
							alert('<?php pzdc_e('Check the checkbox to delete your avatar.'); ?>');
					}
				</script>
				<button class="submit" type="button" onclick="javascript: pzdc_avatar_delete_action();"><span class="value"><?php pzdc_e('Submit'); ?></span></button>
			</form>
			
			<!-- User Password Edit Form -->
			<form action="<?php pzdc_current_user_permalink('edit'); ?>" method="post" class="praized_ui_tab_box" id="praized_ui_tab_box_password_change" style="<?php echo $tabs['password_change']; ?>">
				<input name="tab" type="hidden" value="password_change" />
				<fieldset>
					<legend><?php pzdc_e('Change Password'); ?></legend>
					<table>
						<tr>
							<td class="top left">
								<label for="user_old_password" class="praized_required"><?php pzdc_e('Old password'); ?><sup>*</sup></label>:
							</td>
							<td class="right">
								<input class="password text" id="user_old_password" name="user_old_password" size="30" type="password" />
							</td>
						</tr>
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
								<small><?php pzdc_e('between 6 and 40 characters'); ?></small>
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
				<button class="submit" type="button" onclick="top.location.href='<?php pzdc_community_base_url(); ?>/users/forgot_password';"><span class="value"><?php pzdc_e('I Forgot my Password'); ?></span></button>
				<button class="submit" type="submit"><span class="value"><?php pzdc_e('Submit'); ?></span></button>
			</form>
			
			<!-- User Notification Settings -->
			<?php
				$setting_notify_by_email   = ( ( $_POST['setting_notify_by_email'] == 1 )   || pzdc_user_setting_notify_by_email(FALSE) )   ? 'checked="checked"' : '';
				$setting_notify_by_twitter = ( ( $_POST['setting_notify_by_twitter'] == 1 ) || pzdc_user_setting_notify_by_twitter(FALSE) ) ? 'checked="checked"' : '';
				
				$setting_facebook_enabled    = ( ( $_POST['setting_facebook_enabled'] == 1 )    || pzdc_user_setting_facebook_enabled(FALSE) )    ? 'checked="checked"' : '';
				$setting_twitter_enabled     = ( ( $_POST['setting_twitter_enabled'] == 1 )     || pzdc_user_setting_twitter_enabled(FALSE) )     ? 'checked="checked"' : '';
				$setting_laconica_enabled    = ( ( $_POST['setting_laconica_enabled'] == 1 )    || pzdc_user_setting_laconica_enabled(FALSE) )    ? 'checked="checked"' : '';
				$setting_friend_feed_enabled = ( ( $_POST['setting_friend_feed_enabled'] == 1 ) || pzdc_user_setting_friend_feed_enabled(FALSE) ) ? 'checked="checked"' : '';
				$setting_ping_fm_enabled     = ( ( $_POST['setting_ping_fm_enabled'] == 1 )     || pzdc_user_setting_ping_fm_enabled(FALSE) )     ? 'checked="checked"' : '';
				
				$setting_twitter_username        = pzdc_stripper( ( ! empty($_POST['setting_twitter_username']) )        ? $_POST['setting_twitter_username']        : pzdc_user_setting_twitter_username(FALSE) );
				$setting_twitter_password        = pzdc_stripper( ( ! empty($_POST['setting_twitter_password']) )        ? $_POST['setting_twitter_password']        : pzdc_user_setting_twitter_password(FALSE) );
				$setting_laconica_site           = pzdc_stripper( ( ! empty($_POST['setting_laconica_site']) )           ? $_POST['setting_laconica_site']           : pzdc_user_setting_laconica_site(FALSE) );
				$setting_laconica_username       = pzdc_stripper( ( ! empty($_POST['setting_laconica_username']) )       ? $_POST['setting_laconica_username']       : pzdc_user_setting_laconica_username(FALSE) );
				$setting_laconica_password       = pzdc_stripper( ( ! empty($_POST['setting_laconica_password']) )       ? $_POST['setting_laconica_password']       : pzdc_user_setting_laconica_password(FALSE) );
				$setting_friend_feed_username    = pzdc_stripper( ( ! empty($_POST['setting_friend_feed_username']) )    ? $_POST['setting_friend_feed_username']    : pzdc_user_setting_friend_feed_username(FALSE) );
				$setting_friend_feed_remote_key  = pzdc_stripper( ( ! empty($_POST['setting_friend_feed_remote_key']) )  ? $_POST['setting_friend_feed_remote_key']  : pzdc_user_setting_friend_feed_remote_key(FALSE) );
				$setting_ping_fm_application_key = pzdc_stripper( ( ! empty($_POST['setting_ping_fm_application_key']) ) ? $_POST['setting_ping_fm_application_key'] : pzdc_user_setting_ping_fm_application_key(FALSE) );
			?>
			<form action="<?php pzdc_current_user_permalink('edit'); ?>" method="post" class="praized_ui_tab_box" id="praized_ui_tab_box_notification_settings" style="<?php echo $tabs['notification_settings']; ?>">
				<input name="_method" type="hidden" value="put" />
				<input name="tab" type="hidden" value="notification_settings" />
				<fieldset>
					<legend><?php pzdc_e('Notification Settings'); ?></legend>
					<p><?php pzdc_e('Select how you would like to be notified for all new answers to your questions.'); ?></p>
					<p>
						<input type="checkbox" class="checkbox" id="setting_notify_by_email" name="setting_notify_by_email" value="1" <?php echo $setting_notify_by_email; ?> />
						<label for="setting_notify_by_email"><?php pzdc_e('Email'); ?></label>
						<input type="checkbox" class="checkbox" id="setting_notify_by_twitter" name="setting_notify_by_twitter" value="1" <?php echo $setting_notify_by_twitter; ?> />
						<label for="setting_notify_by_twitter"><?php pzdc_e('Twitter (check box and follow @<a href="http://twitter.com/praizedanswers" target="_blank">praizedanswers</a>)'); ?></label>
					</p>
				</fieldset>
				<br clear="all" />
				<fieldset>
					<legend><?php pzdc_e('Microblogging Settings'); ?></legend>
					<fieldset>
						<img src="<?php pzdc_link('hub'); ?>/images/settings/logo-facebook.png" width="92" height="23" border="0" class="microblogging_icon" style="margin-top:5px;" />
						<p>
							<?php if ( pzdc_user_memberships_facebook() ) : ?>
								<input type="checkbox" class="checkbox" id="setting_facebook_enabled" name="setting_facebook_enabled" value="1" <?php echo $setting_facebook_enabled; ?> />
								<?php pzdc_e('FACEBOOK'); ?>
							<?php else : ?>
								<?php pzdc_e('To broadcast your questions via Facebook, please log-in to this site using Facebook Connect.'); ?>
							<?php endif; ?>
						</p>
					</fieldset>
					<br clear="all"	/>
					<fieldset>
						<img src="<?php pzdc_link('hub'); ?>/images/settings/logo-twitter.png" width="81" height="56" border="0" class="microblogging_icon" />
						<p>
							<input type="checkbox" class="checkbox" id="setting_twitter_enabled" name="setting_twitter_enabled" value="1" <?php echo $setting_twitter_enabled; ?> onclick="javascript:pcui().broadcastFormDisplay('twitter');" />
							<?php pzdc_e('TWITTER'); ?>
						</p>
						<br clear="all" />
						<table id="setting_twitter_table">
							<tr>
								<td class="top left">
									<label for="setting_twitter_username" class="praized_required"><?php pzdc_e('Username'); ?><sup>*</sup></label>:
								</td>
								<td class="right">
									<input type="text" id="setting_twitter_username" name="setting_twitter_username" size="30" value="<?php echo $setting_twitter_username; ?>" />
								</td>
							</tr>
							<tr>
								<td class="top left">
									<label for="setting_twitter_password" class="praized_required"><?php pzdc_e('Password'); ?><sup>*</sup></label>:
								</td>
								<td class="right">
									<input type="password" id="setting_twitter_password" name="setting_twitter_password" size="30" value="<?php echo $setting_twitter_password; ?>" />
								</td>
							</tr>
						</table>
					</fieldset>
					<br clear="all"	/>
					<fieldset>
						<img src="<?php pzdc_link('hub'); ?>/images/settings/logo-identica.png" width="100" height="30" border="0" class="microblogging_icon" style="margin-top:10px;" />
						<p>
							<input type="checkbox" class="checkbox" id="setting_laconica_enabled" name="setting_laconica_enabled" value="1" <?php echo $setting_laconica_enabled; ?> onclick="javascript:pcui().broadcastFormDisplay('laconica');" />
							<?php pzdc_e('LACONICA / IDENTICA'); ?>
						</p>
						<br clear="all" />
						<table id="setting_laconica_table">
							<tr>
								<td class="top left">
									<label for="setting_laconica_site" class="praized_required"><?php pzdc_e('Laconica API URL'); ?><sup>*</sup></label>:
								</td>
								<td class="right">
									<input type="text" id="setting_laconica_site" name="setting_laconica_site" size="30" value="<?php echo $setting_laconica_site; ?>" />
								</td>
							</tr>
							<tr>
								<td class="top left">
									<label for="setting_laconica_username" class="praized_required"><?php pzdc_e('Username'); ?><sup>*</sup></label>:
								</td>
								<td class="right">
									<input type="text" id="setting_laconica_username" name="setting_laconica_username" size="30" value="<?php echo $setting_laconica_username; ?>" />
								</td>
							</tr>
							<tr>
								<td class="top left">
									<label for="setting_laconica_password" class="praized_required"><?php pzdc_e('Password'); ?><sup>*</sup></label>:
								</td>
								<td class="right">
									<input type="password" id="setting_laconica_password" name="setting_laconica_password" size="30" value="<?php echo $setting_laconica_password; ?>" />
								</td>
							</tr>
						</table>
					</fieldset>
					<br clear="all"	/>
					<fieldset>
						<img src="<?php pzdc_link('hub'); ?>/images/settings/logo-friendfeed.png" width="56" height="56" border="0" class="microblogging_icon" />
						<p>
							<input type="checkbox" class="checkbox" id="setting_friend_feed_enabled" name="setting_friend_feed_enabled" value="1" <?php echo $setting_friend_feed_enabled; ?> onclick="javascript:pcui().broadcastFormDisplay('friend_feed');" />
							<?php pzdc_e('FRIENDFEED'); ?>
						</p>
						<br clear="all" />
						<table id="setting_friend_feed_table">
							<tr>
								<td class="top left">
									<label for="setting_friend_feed_username" class="praized_required"><?php pzdc_e('Username'); ?><sup>*</sup></label>:
								</td>
								<td class="right">
									<input type="text" id="setting_friend_feed_username" name="setting_friend_feed_username" size="30" value="<?php echo $setting_friend_feed_username; ?>" />
								</td>
							</tr>
							<tr>
								<td class="top left">
									[<a href="https://friendfeed.com/account/api" target="_blank">?</a>]
									<label for="setting_friend_feed_remote_key" class="praized_required"><?php pzdc_e('Remote Key'); ?><sup>*</sup></label>:
								</td>
								<td class="right">
									<input type="password" id="setting_friend_feed_remote_key" name="setting_friend_feed_remote_key" size="30" value="<?php echo $setting_friend_feed_remote_key; ?>" />
								</td>
							</tr>
						</table>
					</fieldset>
					<br clear="all"	/>
					<fieldset>
						<img src="<?php pzdc_link('hub'); ?>/images/settings/pingfm.gif" width="100" height="48" border="0" class="microblogging_icon" />
						<p>
							<input type="checkbox" class="checkbox" id="setting_ping_fm_enabled" name="setting_ping_fm_enabled" value="1" <?php echo $setting_ping_fm_enabled; ?> onclick="javascript:pcui().broadcastFormDisplay('ping_fm');" />
							<?php pzdc_e('PING.FM'); ?>
						</p>
						<br clear="all" />
						<table id="setting_ping_fm_table">
							<tr>
								<td class="top left">
									[<a href="http://ping.fm/key/" target="_blank">?</a>]
									<label for="setting_ping_fm_application_key" class="praized_required"><?php pzdc_e('Application key'); ?><sup>*</sup></label>:
								</td>
								<td class="right">
									<input type="text" id="setting_ping_fm_application_key" name="setting_ping_fm_application_key" size="30" value="<?php echo $setting_ping_fm_application_key; ?>" />
								</td>
							</tr>
						</table>
					</fieldset>
					<br clear="all"	/>
				</fieldset>
				<button class="submit" type="submit"><span class="value"><?php pzdc_e('Submit'); ?></span></button>
			</form>
			
			<br clear="all" />
			
		</div>
		
		<script type="text/javascript">
			pcui().screenSetup(
				[
					'praized_ui_tab_box_account_info',
					'praized_ui_tab_box_avatar',
					'praized_ui_tab_box_password_change',
					'praized_ui_tab_box_notification_settings'
				],
				'praized_ui_tab_box_<?php echo $tab; ?>'
			);

			window.PraizedCommunityUI.broadcastFormDisplay = function(key) {
				if ( ! key )
					return; 
				var myForm;
				myTest = pcuie('setting_'+key+'_enabled');
				if ( ! myTest )
					return;
				if ( myTest.checked == true )
					pcuie('setting_'+key+'_table').style.display = 'block';
				else
					pcuie('setting_'+key+'_table').style.display = 'none';
			}

			var notifTypes = ['twitter', 'laconica', 'friend_feed', 'ping_fm', 'facebook'];
			
			for (i in notifTypes)
				pcui().broadcastFormDisplay(notifTypes[i]);
		</script>

	<?php else:?>
	  <p><?php printf(
	  	pzdc__('Nice try, but you can only edit <a href="%s">your own account</a>.'),
	  	( pzdc_current_user_permalink(NULL, FALSE) ) ? pzdc_current_user_permalink(NULL, FALSE) : pzdc_community_base_url(FALSE)
	  ); ?></p>
	  <script type="text/javascript"> top.location.href = '<?php ( pzdc_current_user_permalink(NULL, FALSE) ) ? pzdc_current_user_permalink(NULL) : pzdc_community_base_url(); ?>'; </script>
	<?php endif;?>

<?php else:?>
  <p><?php pzdc_e('The requested user cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>
