<?php
	function smarty_block_mtpraizeduservotes($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			// initializing the current block
			$api =& PraizedMTApi::getInstance();

			$user = $ctx->stash("current_praized_user");
			
			
			if(! ($merchants = $ctx->stash("collections_praized_user_votes")) ) {
				$contents = $api->user_votes($user->login, $args);

				$merchants = $contents->votes;
				
				$ctx->stash("collections_praized_user_votes", $merchants);

			}

			$counter = 0;			
			// populate the stash with the api request			
			$ctx->stash("_block_praized_user_votes_counter", $counter);
			$ctx->stash("current_praized_merchant", $merchants[$counter]->merchant);
			$ctx->stash("current_praized_vote", $merchants[$counter]);
						
			$repeat = ($merchants != null && sizeof($merchants) > 0) ? true: false;
		} else {
			// loop on the favorites
			$merchants = $ctx->stash("collections_praized_user_votes");
			$counter   = $ctx->stash("_block_praized_user_votes_counter");
			$counter++;

			if($counter < sizeof($merchants)) {
				$ctx->stash("current_praized_merchant", $merchants[$counter]->merchant);
				$ctx->stash("_block_praized_user_votes_counter", $counter);
				$ctx->stash("current_praized_vote", $merchants[$counter]);

				$repeat = true;
			} else {
				$repeat = false;
			}
		}
		$has_next = (($counter + 1) < sizeof($tags)) ? 1 : 0;
		$ctx->stash("has_next_praized_user_vote", $has_next);
		return $content;
	}
?>