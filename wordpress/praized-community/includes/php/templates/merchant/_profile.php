<?php
/**
 * Praized template fragment: Merchant profile
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
  
  <?php pzdc_tpt_fragment('merchant/hcard'); ?>
  
  <div id="praized-google-static-map" class="praized-merchant-section">  
    <?php pzdc_merchant_map(); ?>
  </div>
  
  <?php if ( pzdc_merchant_permalink(NULL, FALSE) ) : ?>
  
	<br clear="all" style="margin-bottom: 20px;" />
 
	<?php
		$default_tab = 'activity';
		
		$tabs = array(
			$default_tab   => 'display: none;',
			'favorites'    => 'display: none;',
			'votes'        => 'display: none;',
			'comments'     => 'display: none;'
		);
		
		if ( pzdc_community_is_hub() )
			$tabs['communities'] = 'display: none;';
		
		if ( ! empty($_GET['tab']) )
			$tab = $_GET['tab'];
		else if ( ! empty($_POST['tab']) )
			$tab = $_POST['tab'];
		else
			$tab = $default_tab;
	
		if ( isset($tabs[$tab]) )
			$tabs[$tab] = 'display: block;';
		else {
			$tabs[$default_tab] = 'display: block;';
			$tab = $default_tab;
		}
	?>
	  
	<ul id="praized_ui_tabs">
	<li id="praized_ui_tab_activity" class="active"><a href="#praized_ui_tab_box_activity"><?php pzdc_e('Activity'); ?></a></li>
	<li id="praized_ui_tab_favorites"><a href="#praized_ui_tab_box_favorites"><?php pzdc_e('Favorites'); ?></a></li>
	<li id="praized_ui_tab_votes"><a href="#praized_ui_tab_box_votes"><?php pzdc_e('Praizers'); ?></a></li>
	<li id="praized_ui_tab_comments"><a href="#praized_ui_tab_box_comments"><?php pzdc_e('Comments'); ?></a></li>
	<?php if ( pzdc_community_is_hub() ) : ?>
		<li id="praized_ui_tab_communities"><a href="#praized_ui_tab_box_communities"><?php pzdc_e('Communities'); ?></a></li>
	<?php endif; ?>
	</ul>
	
	<div id="praized_ui_tab_container">
  
	  <div id="praized_ui_tab_box_activity" class="praized-user-section praized_ui_tab_box" style="<?php echo $tabs['activity']; ?>">
		<fieldset>
		    <legend class="praized-merchant-section-title"><?php pzdc_e('Activity Stream'); ?></legend>
		    <div class="praized-merchant-activity" style="padding-left:10px;">
		      <?php if ( pzdc_has_actions(array('per_page' => 5)) ) : ?>
		        <?php while ( pzdc_actions_loop() ) : ?>
		          <div class="praized-action-item" style="border:none;">
		            <span class=""><?php pzdc_action_summary(); ?></span>
		            <br />
		            <small>
		            	<abbr title="<?php pzdc_action_created_at(); ?>"><?php pzdc_time_distance(pzdc_action_created_at(FALSE)); ?></abbr>
				    	<?php if ( pzdc_community_is_hub() ) : ?>
				    		<?php pzdc_e('via') ?> <a href="<?php pzdc_action_community_base_url(); ?>"><?php pzdc_action_community_name(); ?></a>
				    	<?php endif; ?>
		            </small>
		          </div>
		        <?php endwhile; ?>
		        <p><a href="<?php pzdc_merchant_permalink('actions'); ?>"><?php pzdc_e('See all activity'); ?></a></p>
		      <?php else:?>
		        <p><?php pzdc_e('No activity'); ?></p>
		      <?php endif;?>
		    </div>
	    </fieldset>
	  </div>
	  
	  <div id="praized_ui_tab_box_favorites" class="praized-merchant-section praized-user-section praized_ui_tab_box" style="<?php echo $tabs['favorites']; ?>">
	    <fieldset>
		    <legend class="praized-merchant-section-title"><?php pzdc_merchant_favorite_count(); ?> <?php pzdc_e('Favorers'); ?></legend>
		    <div>
		      <?php if ( pzdc_has_favorites(array('per_page' => 5)) ) : ?>
		        <ul class="praized-merchant-praizers">
		          <?php while ( pzdc_favorites_loop() ) : ?>
		            <li style="padding-bottom: 10px;" class="praized-action-item">
			          	<a href="<?php pzdc_user_permalink(); ?>" title="<?php pzdc_user_display_name(); ?>" style="float: right;"><img src="<?php pzdc_user_avatar_small(); ?>" border="none" alt="<?php pzdc_user_display_name(); ?>" style="margin-right: 5px; border: 1px solid;" /></a>
			          	<span class="">
			          	  <span class="buzz-icon favorited">Voter</span>
			          	</span>
			          	<span class="buzz-action">
			          	  <a href="<?php pzdc_user_permalink(); ?>" title="<?php pzdc_user_display_name(); ?>" style="font-weight: bold;"><?php pzdc_user_display_name(); ?></a>
			          	</span>
			          	<br clear="all" />
			        </li>
		          <?php endwhile; ?>
		        </ul>
		        <?php if ( pzdc_merchant_favorite_count(FALSE) > 5 ) : ?>
		          <p><a href="<?php pzdc_merchant_permalink('favorites'); ?>"><?php pzdc_e('See all favorers'); ?></a></p>
		        <?php endif;?>
		      <?php else: ?>
		        <span><?php pzdc_e('No favorer'); ?></span>
		      <?php endif;?>
		    </div>
		</fieldset>
	  </div>
	  
	  <div id="praized_ui_tab_box_votes" class="praized-merchant-section praized-user-section praized_ui_tab_box" style="<?php echo $tabs['votes']; ?>">
	    <fieldset>
		    <legend class="praized-merchant-section-title"><?php pzdc_merchant_vote_count(); ?> <?php pzdc_e('Praizers'); ?></legend>
		    <div>
		      <?php if ( pzdc_has_votes(array('per_page' => 5)) ) : ?>
		        <ul class="praized-merchant-praizers">
		          <?php while ( pzdc_votes_loop() ) : ?>
		          	<li style="padding-bottom: 10px;" class="praized-action-item">
			          	<a href="<?php pzdc_user_permalink(); ?>" title="<?php pzdc_user_display_name(); ?>" style="float: right;"><img src="<?php pzdc_user_avatar_small(); ?>" border="none" alt="<?php pzdc_user_display_name(); ?>" style="margin-right: 5px; border: 1px solid;" /></a>
			          	<span class="">
			          	  <span class="buzz-icon voted-for">Voter</span>
			          	</span>
			          	<span class="buzz-action">
			          	  <a href="<?php pzdc_user_permalink(); ?>" title="<?php pzdc_user_display_name(); ?>" style="font-weight: bold;"><?php pzdc_user_display_name(); ?></a>
			          	</span>
				    	<br />
			            <small>
					    	<abbr title="<?php pzdc_vote_created_at(); ?>"><?php pzdc_time_distance(pzdc_vote_created_at(FALSE)); ?></abbr>
					    	<?php if ( pzdc_community_is_hub() ) : ?>
					    		<?php pzdc_e('via') ?> <a href="<?php pzdc_vote_community_base_url(); ?>"><?php pzdc_vote_community_name(); ?></a>
					    	<?php endif; ?>
					    </small>
			          	<br clear="all" />
			        </li>
		          <?php endwhile; ?>
		        </ul>
		        <?php if ( pzdc_merchant_vote_count(FALSE) > 5 ) : ?>
		          <p><a href="<?php pzdc_merchant_permalink('votes'); ?>"><?php pzdc_e('See all praizers'); ?></a></p>
		        <?php endif;?>
		      <?php else: ?>
		        <p><?php pzdc_e('No praizer'); ?></p>
		      <?php endif;?>
		    </div>
	    </fieldset>
	  </div>
	
	  <div id="praized_ui_tab_box_comments" class="praized-merchant-section praized_ui_tab_box" style="d<?php echo $tabs['comments']; ?>">
	    <fieldset>
		    <legend class="praized-merchant-section-title"><?php pzdc_merchant_comment_count(); ?> <?php pzdc_e('Comments'); ?></legend>
		    <ol class="praized-merchant-comments commentlist" style="padding-left:5px;">
		      <?php if ( pzdc_has_comments(array('per_page' => 5)) ) : ?>
		        <?php $i = 0; while ( pzdc_comments_loop() ) : ?>
		          <li class="<?php if( ($i % 2) == 0){ echo "alt"; } ?>" id="comment-<?php echo $i; ?>">
		            <img src="<?php pzdc_user_avatar_small(); ?>" width="40" height="40" border="none" alt="<?php pzdc_user_display_name(); ?>" style="float:right;" />
		            <cite><a href="<?php pzdc_user_permalink(); ?>" rel="external nofollow"><?php pzdc_user_display_name(); ?></a></cite> <?php pzdc_e('says'); ?>:<br />
		            <small class="commentmetadata">
		            	<abbr title="<?php pzdc_comment_created_at(); ?>"><?php pzdc_time_distance(pzdc_comment_created_at(FALSE)); ?></abbr>
				    	<?php if ( pzdc_community_is_hub() ) : ?>
				    		<?php pzdc_e('via') ?> <a href="<?php pzdc_comment_community_base_url(); ?>"><?php pzdc_comment_community_name(); ?></a>
				    	<?php endif; ?>
		            </small>
		            <p><?php pzdc_comment_body(); ?></p>
		          </li>
		        <?php ++$i; endwhile; ?>
		        <?php if ( pzdc_merchant_comment_count(FALSE) > 5 ) : ?>
		          <li style="margin-top:15px;"><a href="<?php pzdc_merchant_permalink('comments'); ?>"><?php pzdc_e('See all comments'); ?></a></li>
		        <?php endif;?>
		      <?php else: ?>
		        <li><?php pzdc_e('No comment'); ?></li>
		      <?php endif;?>
		    </ol>
	    </fieldset>
	    <?php pzdc_tpt_fragment('merchant/comment_form'); ?>
	  </div>
	  
	  <?php if ( pzdc_community_is_hub() ) : ?>
		  <div id="praized_ui_tab_box_communities" class="praized-user-section praized_ui_tab_box" style="<?php echo $tabs['communities']; ?>">
		    <fieldset>
			    <legend class="praized-merchant-section-title"><?php pzdc_e('Communities'); ?></legend>
			    <ul style="padding-left:5px;">
			      <?php if ( pzdc_has_hub_communities(array('per_page' => 5)) ) : ?>
			        <?php while ( pzdc_hub_communities_loop() ) : ?>
			          <li style="padding: 5px 0;"><a href="<?php pzdc_hub_community_base_url(); ?>"><?php pzdc_hub_community_name(); ?></a></li>
			        <?php endwhile; ?>
			        <li style="padding: 5px 0;"><a href="<?php pzdc_merchant_permalink('communities'); ?>"><?php pzdc_e('See all communities'); ?></a></li>
			      <?php else: ?>
			        <li style="padding: 5px 0;"><?php pzdc_e('No communities'); ?></li>
			      <?php endif;?>
			    </ul>
			</fieldset>
		  </div>
	  <?php endif; ?>
	
	</div>
		
	<script type="text/javascript">
		pcui().screenSetup(
			[
				'praized_ui_tab_box_activity',
				'praized_ui_tab_box_favorites',
				'praized_ui_tab_box_votes',
				'praized_ui_tab_box_comments'
				<?php if ( pzdc_community_is_hub() ) : ?>
					, 'praized_ui_tab_box_communities'
				<?php endif; ?>
			],
			'praized_ui_tab_box_<?php echo $tab; ?>'
		);
	</script>
  
  <?php endif; ?>
  
<?php else:?>
   <p><?php pzdc_e('The requested merchant cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>
