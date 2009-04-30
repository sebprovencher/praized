<?php
/**
 * Praized template fragment: Praized authentication and session (also used in Praized Session widget)
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<ul class="praized-auth-nav">
    <?php if ( pzdc_is_authorized() ) :?>
		<li class="praized-greeting"><?php pzdc_e('Hi'); ?> <a href="<?php pzdc_current_user_permalink(); ?>"><?php pzdc_current_user_name(); ?></a>!</li>
		<li><a href="<?php pzdc_hub_add_place(); ?>"><?php pzdc_e('Add a place'); ?></a></li>
		<li><a href="<?php pzdc_current_user_permalink('edit'); ?>"><?php pzdc_e('Manage Profile'); ?></a></li>
		<li><a href="<?php pzdc_help_link(); ?>"><?php pzdc_e('Help'); ?></a></li>
		<li><a href="<?php pzdc_auth_link(); ?>"><?php pzdc_e('Praized Logout'); ?></a></li>
    <?php else: ?>
    	<li><a href="<?php pzdc_auth_link(); ?>"><?php pzdc_e('Praized Login'); ?></a></li>
    	<li><a href="<?php pzdc_auth_link(); ?>"><?php pzdc_e('Join'); ?></a></li>
		<li><a href="<?php pzdc_hub_add_place(); ?>"><?php pzdc_e('Add a place'); ?></a></li>
		<li><a href="<?php pzdc_help_link(); ?>"><?php pzdc_e('Help'); ?></a></li>
    <?php endif; ?>
</ul>
