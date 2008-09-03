<?php
/**
 * Praized template: User favorite listing, with paging
 *
 * @version 1.0.4
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php get_header(); ?>

<div id="container">
  <div id="content" class="narrowcolumn">
    <?php pzdc_tpt_fragment('user/favorites'); ?>
  </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
