<?php
/**
 * Praized template fragment: Merchant sharing functionality
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_is_merchant_page() ) : ?>
    <p class="praized-merchant-share">
        <input type="text" value="<?php pzdc_merchant_short_url(); ?>" />
        |
        <a href="<?php pzdc_merchant_twitter_link(); ?>" class="praized-action"><?php pzdc_e('twitter this'); ?></a>
        |
        <?php pzdc_merchant_share(); ?>
    </p>
<?php endif; ?>
