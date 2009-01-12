<?php
/**
 * Praized template fragment: Merchant vote button
 *
 * @version 1.7
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_merchant() ) : ?>

	<?php pzdc_merchant_vote_button(); ?>

<?php endif;?>
