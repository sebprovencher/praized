<?php
/**
 * Praized template fragment: Merchant sponsored links listing
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php
  $has_splinks = pzdc_has_splinks();
  $has_spimages = pzdc_has_spimages();
?>

<?php if ( pzdc_is_merchant_page() && ( $has_splinks || $has_spimages ) ) : ?>
  <p class="praized-sponsored-links">
    <span class=""><?php pzdc_e('Sponsored links'); ?></span>
    <?php if ( $has_spimages ) : ?>
      <div style="width:150px; margin-left:5px; padding:0; float:right; text-align:center;">
	    <?php while ( pzdc_spimages_loop() ) : ?>
	      <a href="<?php pzdc_spimage_target_url(); ?>"><img src="<?php pzdc_spimage_source_url(); ?>" alt="<?php pzdc_spimage_label(); ?>" style="margin:0 0 15px 0; padding:0; border:0;" /></a>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
    <?php if ( $has_splinks ) : ?>
      <ul>
        <?php while ( pzdc_splinks_loop() ) : ?>
          <li><a href="<?php pzdc_splink_url(); ?>"><?php pzdc_splink_label(); ?></a></li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </p>
<?php endif;?>