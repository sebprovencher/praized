<?php
/**
 * Praized template fragment: Merchant search form (also used in Praized Search widget)
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<form action="<?php pzdc_search_link(); ?>" class="form" method="get" id="praized-search-form">
  <fieldset>
    <label>
      <span class="label"><?php pzdc_e('Look for:'); ?></span>
      <input class="text" id="search_keywords" name="q" size="15" maxlength="256" type="text" value="<?php pzdc_search_query(); ?>" />
    </label>
    <label>
      <span class="label"><?php pzdc_e('City:'); ?></span>
      <input class="text" id="search_location" name="l" size="18" maxlength="256" type="text" value="<?php pzdc_search_location(); ?>"/>
    </label>
    <button type="submit"><?php pzdc_e('Find'); ?></button>
  </fieldset>
</form>
<?php pzdc_search_results_info(); ?>