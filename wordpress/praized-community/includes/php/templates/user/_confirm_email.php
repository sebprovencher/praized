<?php
/**
 * Praized template fragment: User-level screen accessed when a user has
 * clicked on the email-based link to confirm their email address.
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<h2><?php pzdc_e('Email Confirmation'); ?></h2>

<p><?php pzdc_user_confirmation_message(); ?></p>

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

<?php pzdc_credits(); ?>