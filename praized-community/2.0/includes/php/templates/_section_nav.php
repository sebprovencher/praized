<?php
/**
 * Praized template fragment: Praized sections navigation (also used in Praized Sections widget)
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<ul class="praized-section-nav">
    <li><a href="<?php pzdc_community_base_url(); ?>/places/"><?php pzdc_e('Top Places'); ?></a></li>
    <li><a href="<?php pzdc_community_base_url(); ?>/actions/"><?php pzdc_e('The Local Buzz'); ?></a></li>
    <li><a href="<?php pzdc_community_base_url(); ?>/questions/"><?php pzdc_e('Questions &amp; Answers'); ?></a></li>
    <?php if ( pzdc_community_is_hub() ) : ?>
    	<li><a href="<?php pzdc_community_base_url(); ?>/communities/"><?php pzdc_e('Communities'); ?></a></li>
    <?php endif; ?>
</ul>
