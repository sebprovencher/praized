<?php
/**
 * Praized template fragment: Merchant tagging form
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

  <?php pzdc_tpt_fragment('merchant/hcard'); ?>

  <div id="praized-taggings-form" class="merchant-section">
    <?php pzdc_tpt_fragment('merchant/taggings_form'); ?>
  </div>

<?php else:?>
   <p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>
