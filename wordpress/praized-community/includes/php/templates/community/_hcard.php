<?php
/**
 * Praized template fragment: Community hcard
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_hub_community() ) : ?>
      <span class="praized-community-item vcard">
      	<a class="fn org url" rel="bookmark" href="<?php pzdc_hub_community_base_url(); ?>"><?php pzdc_hub_community_name(); ?></a>
      </span>
<?php endif;?>
