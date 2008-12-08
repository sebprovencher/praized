<?php
/**
 * Praized template fragment: Praized authentication and session (also used in Praized Session widget)
 *
 * @version 1.6
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<ul class="praized-auth-nav">
    <?php if ( pzdc_is_authorized() ) :?>
		<li class="praized-greeting"><?php pzdc_e('Hi'); ?> <a href="<?php pzdc_current_user_permalink(); ?>"><?php pzdc_current_user_login(); ?></a>!</li>
    	<li><a href="<?php pzdc_community_base_url(); ?>/places/"><?php pzdc_e('Top Places'); ?></a></li>
    	<li><a href="<?php pzdc_community_base_url(); ?>/actions/"><?php pzdc_e('The Local Buzz'); ?></a></li>
    	<li><a href="<?php pzdc_community_base_url(); ?>/questions/"><?php pzdc_e('Questions &amp; Answers'); ?></a></li>
		<li><a href="<?php pzdc_hub_add_place(); ?>"><?php pzdc_e('Add a new place'); ?></a></li>
		<li><a href="<?php pzdc_current_user_permalink(); ?>"><?php pzdc_e('View Profile'); ?></a></li>
		<li><a href="<?php pzdc_hub_user_profile(); ?>"><?php pzdc_e('Manage Profile'); ?></a></li>
		<li><a href="<?php pzdc_auth_link(); ?>"><?php pzdc_e('Disconnect Praized account'); ?></a></li>
    <?php else: ?>
    	<li><a href="<?php pzdc_community_base_url(); ?>/places/"><?php pzdc_e('Top Places'); ?></a></li>
    	<li><a href="<?php pzdc_community_base_url(); ?>/actions/"><?php pzdc_e('The Local Buzz'); ?></a></li>
    	<li><a href="<?php pzdc_community_base_url(); ?>/questions/"><?php pzdc_e('Questions &amp; Answers'); ?></a></li>
    	<li><a href="<?php pzdc_auth_link(); ?>"><?php pzdc_e('Connect to your Praized account'); ?></a></li>
    <?php endif; ?>
</ul>
