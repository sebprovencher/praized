<?php
/**
 * Praized template: User comment listing, with paging
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php get_header(); ?>

<div id="container">
  <div id="content" class="narrowcolumn">
    <?php pzdc_tpt_fragment('user/communities'); ?>
  </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
