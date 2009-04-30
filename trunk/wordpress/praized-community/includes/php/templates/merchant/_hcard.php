<?php
/**
 * Praized template fragment: Merchant hcard
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_merchant() ) : ?>
  <div class="praized-merchant-item vcard">
    
    <div class="praized-merchant-info">
    
      <h2 class="fn">
      	<?php if ( pzdc_merchant_permalink(NULL, FALSE) ) : ?>
      		<a class="org url" rel="bookmark" href="<?php pzdc_merchant_permalink(); ?>"><?php pzdc_merchant_name(); ?></a>
      	<?php else : ?>
      		<span class="org"><?php pzdc_merchant_name(); ?></span>
      	<?php endif; ?>
        <?php pzdc_merchant_stats_img(); ?>
      </h2>
      <br />
      <?php pzdc_tpt_fragment('merchant/vote_button'); ?>
      <div class="adr">
        <?php if ( pzdc_merchant_street_address(FALSE) ) : ?>
          <span class="street-address"><?php pzdc_merchant_street_address(); ?></span><?php if ( pzdc_merchant_city_name(FALSE) ){ echo ', ';} ?>
        <?php endif; ?>
        <?php if ( pzdc_merchant_city_name(FALSE) ) : ?>
          <span class="locality"><?php pzdc_merchant_city_name(); ?></span><?php if ( pzdc_merchant_country_name(FALSE) ){ echo ', ';} ?>
        <?php endif; ?>
        <?php if ( pzdc_merchant_street_address(FALSE) && pzdc_merchant_country_name(FALSE) ) : ?>
          <br />
        <?php endif; ?>
        <?php if ( pzdc_merchant_region_name(FALSE) ) : ?>
          <span class="region"><?php pzdc_merchant_region_name(); ?></span><?php if ( pzdc_merchant_postal_code(FALSE) ){ echo ', '; } ?>
        <?php endif; ?>
        <?php if ( pzdc_merchant_postal_code(FALSE) ) : ?>
          <span class="postal-code"><?php pzdc_merchant_postal_code(); ?></span><?php if ( pzdc_merchant_country_name(FALSE) ){ echo ', '; } ?>
        <?php endif; ?>
        <?php if ( pzdc_merchant_country_name(FALSE) ) : ?>
          <span class="country-name"><?php pzdc_merchant_country_name(); ?></span>
        <?php endif; ?>
        <span style="display:none" class="geo">
          <?php if ( pzdc_merchant_latitude(FALSE) ) : ?>
            <i class="latitude"><?php pzdc_merchant_latitude(); ?></i>
          <?php endif; ?>
          <?php if ( pzdc_merchant_longitude(FALSE) ) : ?>
            <i class="longitude"><?php pzdc_merchant_longitude(); ?></i>
          <?php endif; ?>
        </span>
      </div>
      
      <div class="contact-info">
        <?php if ( pzdc_merchant_phone(FALSE) ) : ?>
          <b class="phone-number"><span class="tel pref"><?php pzdc_merchant_phone(); ?></span></b><br />
        <?php endif; ?>
        <?php if ( pzdc_merchant_fax(FALSE) ) : ?>
          <b class="fax-number"><span class="tel fax"><?php pzdc_merchant_fax(); ?></span></b><br />
        <?php endif; ?>
        <?php if ( pzdc_merchant_email(FALSE) ) : ?>
          <b class="web-contact"><span class="email"><?php pzdc_merchant_email(); ?></span></b><br />
        <?php endif; ?>
        <?php if ( pzdc_merchant_url(FALSE) ) : ?>
          <em class="web-site"><a class="website" href="<?php pzdc_merchant_url(); ?>"><?php pzdc_merchant_url(); ?></a></em>
        <?php endif; ?>
      </div>
      
      <?php pzdc_tpt_fragment('merchant/tags'); ?>

	  <?php pzdc_tpt_fragment('merchant/share'); ?>
      
      <?php if ( pzdc_merchant_permalink(NULL, FALSE) ) : ?>      
	      <div class="praized-merchant-extra">
	        <a href="<?php pzdc_merchant_permalink(); ?>?tab=favorites#praized_ui_tab_box_favorites" title="Clicking here directs you to the favorers section of <?php echo urlencode(pzdc_merchant_name(FALSE)); ?>'s page"><?php pzdc_e('favorers'); ?> (<?php pzdc_merchant_favorite_count(); ?>)</a>
	        |
	        <a href="<?php pzdc_merchant_permalink(); ?>?tab=votes#praized_ui_tab_box_votes" title="Clicking here directs you to the praizers section of <?php echo urlencode(pzdc_merchant_name(FALSE)); ?>'s page"><?php pzdc_e('praizers'); ?> (<?php pzdc_merchant_vote_count(); ?>)</a>
	        |
	        <a href="<?php pzdc_merchant_permalink(); ?>?tab=comments#praized_ui_tab_box_comments" title="Clicking here directs you to the praizers section of <?php echo urlencode(pzdc_merchant_name(FALSE)); ?>'s page"><?php pzdc_e('comments'); ?> (<?php pzdc_merchant_comment_count(); ?>)</a>
	        
	        <?php if ( pzdc_is_authorized() ) :?>
	          |
	          <ins class="praized-add-to-favorites">
	            <form action="<?php pzdc_current_user_permalink('favorites'); ?>" method="post">
	              <fieldset>
	                <input id="pid" name="pid" type="hidden" value="<?php pzdc_merchant_pid(); ?>" />
	                <?php if ( pzdc_merchant_is_favorited() ) :?>
	                  <input type="hidden" name="_action" value="delete" />
	                  <button type="submit"><?php pzdc_e('Remove from my favorites'); ?></button>
	      		    <?php else: ?>
	                  <input type="hidden" name="_action" value="add" />
	      		      <button type="submit"><?php pzdc_e('Add to my favorites'); ?></button>
	      		    <?php endif; ?>
	              </fieldset>
	            </form>
	          </ins>
	        <?php endif;?>
	      </div>
      <?php endif; ?>
    
    </div>
 
  </div>

  <?php pzdc_tpt_fragment('merchant/splinks'); ?>
  
  <br />

<?php endif;?>
