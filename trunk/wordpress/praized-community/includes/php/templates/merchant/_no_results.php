<?php
/**
 * Praized template fragment: "No results logic" when no merchants are found in
 * search results, or when nothing has been Praized in a community.
 *
 * @version 1.0.2
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( isset($_GET['q']) || isset($_GET['l']) || isset($_GET['t']) || isset($_GET['tag']) ) : ?>
	<p><?php pzdc_e('No places matched your query.'); ?></p>
<?php else: ?>
	<p><?php pzdc_e('No places have been <em>praized</em> in this community yet.'); ?></p>
	<p><?php pzdc_e('Search for your favorite places and start <em>praizing</em>!'); ?></p>
	<?php pzdc_tpt_fragment('search_form'); ?>
<?php endif; ?>
