<?php
/**
 * Praized template fragment: User profile
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_user() ) : ?>
 
  <div style="margin-top:15px;"><?php pzdc_tpt_fragment('search_form'); ?></div>
  
  <?php pzdc_tpt_fragment('user/hcard'); ?>
  
  <br clear="all" style="margin-bottom: 20px;" />
 
  <?php
	$default_tab = 'activity';
	
	$tabs = array(
		$default_tab   => 'display: none;',
		'friends'      => 'display: none;',
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
	<li id="praized_ui_tab_friends"><a href="#praized_ui_tab_box_friends"><?php pzdc_e('Friends'); ?></a></li>
	<li id="praized_ui_tab_favorites"><a href="#praized_ui_tab_box_favorites"><?php pzdc_e('Favorites'); ?></a></li>
	<li id="praized_ui_tab_votes"><a href="#praized_ui_tab_box_votes"><?php pzdc_e('Votes'); ?></a></li>
	<li id="praized_ui_tab_comments"><a href="#praized_ui_tab_box_comments"><?php pzdc_e('Comments'); ?></a></li>
	<?php if ( pzdc_community_is_hub() ) : ?>
		<li id="praized_ui_tab_communities"><a href="#praized_ui_tab_box_communities"><?php pzdc_e('Communities'); ?></a></li>
	<?php endif; ?>
  </ul>
  
  <div id="praized_ui_tab_container">
  
	  <div id="praized_ui_tab_box_activity" class="praized-user-section praized_ui_tab_box" style="<?php echo $tabs['activity']; ?>">
	    <fieldset>
	      <legend class="praized-user-section-title"><?php pzdc_e('Activity Stream'); ?></legend>
	      <div style="padding-left:5px;">
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
	        <p><a href="<?php pzdc_user_permalink('actions'); ?>"><?php pzdc_e('See all activity'); ?></a></p>
	      <?php else:?>
	        <p><?php pzdc_e('No activity'); ?></p>
	      <?php endif;?>
	      </div>
	    </fieldset>
	  </div>
	
	  <div id="praized_ui_tab_box_friends" class="praized-user-section praized_ui_tab_box" style="<?php echo $tabs['friends']; ?>">
	    <fieldset>
	      <legend class="praized-user-section-title"><?php pzdc_user_friend_count(); ?> <?php pzdc_e('Friends'); ?></legend>
	      <div>
		      <?php if ( pzdc_has_friends(array('per_page' => 5)) ) : ?>
		      	<ul class="praized-user-friends" style="padding-left:0; margin-left:5px;">  
			        <?php while ( pzdc_friends_loop() ) : ?>
			            <li style="padding-bottom: 10px;" class="praized-action-item">
				          	<a href="<?php pzdc_friend_permalink(); ?>" title="<?php pzdc_friend_display_name(); ?>" style="float: right;"><img src="<?php pzdc_friend_avatar_small(); ?>" border="none" alt="<?php pzdc_friend_display_name(); ?>" style="margin-right: 5px; border: 1px solid;" /></a>
				          	<span class="buzz-action" style="padding-left:0;">
				          	  <a href="<?php pzdc_friend_permalink(); ?>" title="<?php pzdc_friend_display_name(); ?>" style="font-weight: bold;"><?php pzdc_friend_display_name(); ?></a>
				          	</span>
				          	<br clear="all" />
				        </li>
			        <?php endwhile; ?>
			    </ul>
		        <?php if ( pzdc_user_friend_count(FALSE) > 5 ) : ?>
		          <p><a href="<?php pzdc_user_permalink('friends'); ?>"><?php pzdc_e('See all friends'); ?></a></p>
		        <?php endif;?>
		      <?php else: ?>
		        <p class="nofriends"><?php pzdc_e('No friend yet'); ?></p>
		      <?php endif;?>
	      </div>
	    </fieldset>
	  </div>
	
	  <div id="praized_ui_tab_box_favorites" class="praized-user-section praized_ui_tab_box" style="<?php echo $tabs['favorites']; ?>">
	    <fieldset>
	    	<legend class="praized-user-section-title"><?php pzdc_user_favorite_count(); ?> <?php pzdc_e('Favorites'); ?></legend>
		    <ul class="praized-user-favorites" style="padding-left:5px;">
		      <?php if ( pzdc_has_favorites(array('per_page' => 5)) ) : ?>
		        <?php while ( pzdc_favorites_loop() ) : ?>
		          <li>
		            <span class="praized-inline-merchant">
		              <big>
		                <?php if ( pzdc_merchant_permalink(NULL, FALSE) ) : ?>
		                	<a rel="bookmark" href="<?php pzdc_merchant_permalink(); ?>" class="praized-merchant-vote <?php pzdc_merchant_target_rating(); ?>"><b class="praized-value"><span class="praized-nominator"><?php pzdc_merchant_vote_pos_count(); ?></span><span class="praized-separator">/</span><span class="praized-denominator"><?php pzdc_merchant_vote_count(); ?></span></b> <?php pzdc_merchant_name(); ?></a>
		                <?php else : ?>
		                	<span class="praized-merchant-vote <?php pzdc_merchant_target_rating(); ?>"><b class="praized-value"><span class="praized-nominator"><?php pzdc_merchant_vote_pos_count(); ?></span><span class="praized-separator">/</span><span class="praized-denominator"><?php pzdc_merchant_vote_count(); ?></span></b> <?php pzdc_merchant_name(); ?></span>
		                <?php endif; ?>
		              </big>
					  <br />
		              <span class="praized-merchant-address">
		                <?php pzdc_merchant_street_address(); ?>,
		                <?php pzdc_merchant_city_name(); ?>
		              </span>
		            </span>
		            <br clear="all" />
		          </li>
		        <?php endwhile; ?>
		        <?php if ( pzdc_user_favorite_count(FALSE) > 5 ) : ?>
		          <li style="margin-top:15px;"><a href="<?php pzdc_user_permalink('favorites'); ?>"><?php pzdc_e('See all favorites'); ?></a></li>
		        <?php endif;?>
		      <?php else:?>
		        <li><?php pzdc_e('No favorite'); ?></li>
		      <?php endif;?>   
		    </ul>
	    </fieldset>
	  </div>
	
	  <div id="praized_ui_tab_box_votes" class="praized-user-section praized_ui_tab_box" style="<?php echo $tabs['votes']; ?>">
	    <fieldset>
		    <legend class="praized-user-section-title"><?php pzdc_user_vote_count(); ?> <?php pzdc_e('Votes'); ?></legend>
		    <ul class="praized-user-votes" style="padding-left:5px;">
		      <?php if ( pzdc_has_votes(array('per_page' => 5)) ) : ?>
		        <?php while ( pzdc_votes_loop() ) : ?>
		          <li >
		            <span class="praized-inline-merchant">
		              <big>
		                <?php if ( pzdc_merchant_permalink(NULL, FALSE) ) : ?>
		                	<a rel="bookmark" href="<?php pzdc_merchant_permalink(); ?>" class="praized-merchant-vote <?php pzdc_merchant_target_rating(); ?>"><b class="praized-value"><span class="praized-nominator"><?php pzdc_merchant_vote_pos_count(); ?></span><span class="praized-separator">/</span><span class="praized-denominator"><?php pzdc_merchant_vote_count(); ?></span></b> <?php pzdc_merchant_name(); ?></a>
		                <?php else : ?>
		                	<span class="praized-merchant-vote <?php pzdc_merchant_target_rating(); ?>"><b class="praized-value"><span class="praized-nominator"><?php pzdc_merchant_vote_pos_count(); ?></span><span class="praized-separator">/</span><span class="praized-denominator"><?php pzdc_merchant_vote_count(); ?></span></b> <?php pzdc_merchant_name(); ?></span>
		                <?php endif; ?>
		              </big>
		              <br />
		              <span class="praized-merchant-address">
		                <?php pzdc_merchant_street_address(); ?>,
		                <?php pzdc_merchant_city_name(); ?>
		              </span>
		              <br />
		              <small style="margin-bottom:5px;">
				    	<abbr title="<?php pzdc_vote_created_at(); ?>"><?php pzdc_time_distance(pzdc_vote_created_at(FALSE)); ?></abbr>
				    	<?php if ( pzdc_community_is_hub() ) : ?>
				    		<?php pzdc_e('via') ?> <a href="<?php pzdc_vote_community_base_url(); ?>"><?php pzdc_vote_community_name(); ?></a>
				    	<?php endif; ?>
				      </small>
		            </span>
		            <br clear="all" />
		          </li>
		        <?php endwhile; ?>
		        <?php if ( pzdc_user_vote_count(FALSE) > 5 ) : ?>
		          <li style="margin-top:15px;"><a href="<?php pzdc_user_permalink('votes'); ?>"><?php pzdc_e('See all votes'); ?></a></li>
		        <?php endif;?>
		      <?php else:?>
		        <li>No vote</li>
		      <?php endif;?>   
		    </ul>
	    </fieldset>
	  </div>
	
	  <div id="praized_ui_tab_box_comments" class="praized-user-section praized_ui_tab_box" style="<?php echo $tabs['comments']; ?>">
	    <fieldset>
		    <legend class="praized-user-section-title"><?php pzdc_user_comment_count(); ?> <?php pzdc_e('Comments'); ?></legend>
		    <ul class="praized-user-comments commentlist" style="padding-left:5px;">
		      <?php if ( pzdc_has_comments(array('per_page' => 5)) ) : ?>
		        <?php $i = 0; while ( pzdc_comments_loop() ) : ?>
		          <li class="<?php if( ($i % 2) == 0){ echo "alt"; } ?>" id="comment-<?php echo $i; ?>">
		            <span class="praized-inline-merchant">
		              <big>
		                <?php if ( pzdc_merchant_permalink(NULL, FALSE) ) : ?>
		                	<a rel="bookmark" href="<?php pzdc_merchant_permalink(); ?>" class="praized-merchant-vote <?php pzdc_merchant_target_rating(); ?>"><b class="praized-value"><span class="praized-nominator"><?php pzdc_merchant_vote_pos_count(); ?></span><span class="praized-separator">/</span><span class="praized-denominator"><?php pzdc_merchant_vote_count(); ?></span></b> <?php pzdc_merchant_name(); ?></a>
		                <?php else : ?>
		                	<span class="praized-merchant-vote <?php pzdc_merchant_target_rating(); ?>"><b class="praized-value"><span class="praized-nominator"><?php pzdc_merchant_vote_pos_count(); ?></span><span class="praized-separator">/</span><span class="praized-denominator"><?php pzdc_merchant_vote_count(); ?></span></b> <?php pzdc_merchant_name(); ?></span>
		                <?php endif; ?>
		              </big>
		              <br />
		              <span class="praized-merchant-address">
		                <?php pzdc_merchant_street_address(); ?>,
		                <?php pzdc_merchant_city_name(); ?>
		              </span>
		            </span>
		            <small class="commentmetadata">
		            	<abbr title="<?php pzdc_comment_created_at(); ?>"><?php pzdc_time_distance(pzdc_comment_created_at(FALSE)); ?></abbr>
		            	<?php if ( pzdc_community_is_hub() ) : ?>
				    		<?php pzdc_e('via') ?> <a href="<?php pzdc_comment_community_base_url(); ?>"><?php pzdc_comment_community_name(); ?></a>
				    	<?php endif; ?>
		            </small>
		            <p><?php pzdc_comment_body(); ?></p>
		          </li>
		        <?php ++$i; endwhile; ?>
		        <?php if ( pzdc_user_comment_count(FALSE) > 5 ) : ?>
		          <li style="margin-top:15px;"><a href="<?php pzdc_user_permalink('comments'); ?>"><?php pzdc_e('See all comments'); ?></a></li>
		        <?php endif;?>
		      <?php else: ?>
		        <li><?php pzdc_e('No comment'); ?></li>
		      <?php endif;?>
		    </ul>
	    </fieldset>
	  </div>
	  
	  <?php if ( pzdc_community_is_hub() ) : ?>
		  <div id="praized_ui_tab_box_communities" class="praized-user-section praized_ui_tab_box" style="<?php echo $tabs['communities']; ?>">
		    <fieldset>
			    <legend class="praized-user-section-title"><?php pzdc_e('Communities'); ?></legend>
			    <ul style="padding-left:5px;">
			      <?php if ( pzdc_has_hub_communities(array('per_page' => 5)) ) : ?>
			        <?php while ( pzdc_hub_communities_loop() ) : ?>
			          <li style="padding: 5px 0;"><a href="<?php pzdc_hub_community_base_url(); ?>"><?php pzdc_hub_community_name(); ?></a></li>
			        <?php endwhile; ?>
			        <li style="padding: 5px 0;"><a href="<?php pzdc_user_permalink('communities'); ?>"><?php pzdc_e('See all communities'); ?></a></li>
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
			'praized_ui_tab_box_friends',
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

<?php else:?>
  <p><?php pzdc_e('The requested user cannot be found.'); ?></p>
<?php endif;?>

<?php pzdc_credits(); ?>
