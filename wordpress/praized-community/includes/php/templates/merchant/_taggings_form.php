<?php
/**
 * Praized template fragment: Merchant tagging form
 *
 * @version 1.5
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_merchant() ) : ?>
  <?php if ( pzdc_is_authorized() ) :?>
    <h3><?php pzdc_e('Add Tag (space-separated)'); ?></h3>
    <form action="<?php pzdc_merchant_permalink('taggings'); ?>" method="POST">
      <fieldset>
        <input type="text" name="tag_list" value="" size="40">
        <input type="submit" name="commit" value="Add my tag">
      </fieldset>    	
    </form>
  <?php else: ?>
    <p>
    	<?php
    	    printf(
    	    	pzdc__('You need to <a href="%s">login</a> to add tags.'),
    	        pzdc_auth_link(FALSE)
    	    );
    	?>
	</p>
  <?php endif; ?>
<?php else:?>
    <p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
<?php endif;?>
