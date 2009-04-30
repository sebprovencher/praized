<?php
/**
 * Praized template fragment: Merchant tag listing
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_merchant() ) : ?>

  <p class="meta">
    <?php pzdc_e('Tags:'); ?>
    <?php if ( pzdc_has_tags() ) : ?>
      <?php while ( pzdc_tags_loop() ) : ?>
        <a rel="tag" href="<?php pzdc_tag_link(); ?>"><?php pzdc_tag_name(); ?></a><?php if ( pzdc_has_next_tag() ) { echo ','; }?>
      <?php endwhile; ?>
    <?php else: ?>
      <?php pzdc_e('No tags.'); ?>
    <?php endif;?>
    <?php if ( pzdc_merchant_permalink(NULL, FALSE) ) : ?>
    	<a class="praized-action" href="<?php pzdc_merchant_permalink('taggings'); ?>"><?php pzdc_e('add tags'); ?></a>
    <?php endif; ?>
 </p>

<?php endif;?>
