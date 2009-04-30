<?php
/**
 * Praized template fragment: "No results logic" when no merchants are found in
 * search results, or when nothing has been Praized in a community.
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( isset($_GET['q']) || isset($_GET['l']) || isset($_GET['t']) || isset($_GET['tag']) ) : ?>
	<p>
    <?php
        printf(
            pzdc__('We did not find this place in Praized. Our place database currently includes the US and Canada. If you’re searching in that region, you can try a new search or <a href="%s">add a place</a> in the Praized database.'),
            pzdc_hub_add_place(FALSE) . '&city=' . urlencode(pzdc_search_location(FALSE)) . '&name=' . urlencode(pzdc_search_query(FALSE)) 
        );
    ?>
	</p>
<?php else: ?>
	<p><?php pzdc_e('No places have been <em>praized</em> in this community yet.'); ?></p>
	<p><?php pzdc_e('Search for your favorite places and start <em>praizing</em>!'); ?></p>
<?php endif; ?>
