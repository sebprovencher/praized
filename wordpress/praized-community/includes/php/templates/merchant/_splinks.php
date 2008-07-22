<?php
/**
 * Praized template fragment: Merchant sponsored links listing
 *
 * @version 1.0.2
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_merchant() && pzdc_has_splinks() ) : ?>
  <p class="praized-sponsored-links">
    <span class=""><?php pzdc_e('Sponsored links'); ?></span>
    <ul>
      <?php while ( pzdc_splinks_loop() ) : ?>
        <li><a href="<?php pzdc_splink_url(); ?>"><?php pzdc_splink_label(); ?></a></li>
      <?php endwhile; ?>
    </ul>
  </p>
<?php endif;?>