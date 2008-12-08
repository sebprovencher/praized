<?php
/**
 * Praized template fragment: "No results logic" when no actions are found
 * in a community.
 *
 * @version 1.6
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<p><?php pzdc_e('There is no activity in this community yet.'); ?></p>
<p><?php pzdc_e('Search for your favorite places and start <em>praizing</em>!'); ?></p>
<?php pzdc_tpt_fragment('search_form'); ?>
