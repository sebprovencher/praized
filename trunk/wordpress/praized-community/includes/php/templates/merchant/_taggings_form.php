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

<?php if ( pzdc_merchant_permalink(NULL, FALSE) ) : ?>
	<?php if ( pzdc_has_merchant() ) : ?>
	    <h3><?php pzdc_e('Add Tag (space-separated)'); ?></h3>
	    <form action="<?php pzdc_merchant_permalink('taggings'); ?>" method="POST">
	      <fieldset>
	        <input type="text" name="tag_list" value="" size="40">
	        <input type="submit" name="commit" value="<?php pzdc_e('Add my tag'); ?>">
	      </fieldset>    	
	    </form>
	<?php else:?>
	    <p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
	<?php endif;?>
<?php endif;?>