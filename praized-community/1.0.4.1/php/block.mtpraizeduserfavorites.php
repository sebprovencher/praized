<?php
	function smarty_block_mtpraizeduserfavorites($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			// initializing the current block
			$api =& PraizedMTApi::getInstance();

			$user = $ctx->stash("current_praized_user");
			
			
			if(! ($merchants = $ctx->stash("collections_praized_user_favorites")) ) {
				$contents = $api->user_favorites($user->login, $args);

				$merchants = $contents->merchants;
				$ctx->stash("collections_praized_user_favorites", $merchants);

			}		
			$counter = 0;
			
			// populate the stash with the api request
			$ctx->stash("_block_praized_user_favorites_counter", $counter);
			$ctx->stash("current_praized_merchant", $merchants[$counter]);
			
			$repeat = ($merchants != null && sizeof($merchants) > 0) ? true: false;
		} else {
			// loop on the favorites	
			$merchants = $ctx->stash("collections_praized_user_favorites");
			$counter  = $ctx->stash("_block_praized_user_favorites_counter");
			$counter++;

			if($counter < sizeof($merchants)) {
				$ctx->stash("current_praized_merchant", $merchants[$counter]);
				$ctx->stash("_block_praized_user_favorites_counter", $counter);

				$repeat = true;
			} else {
				$repeat = false;
			}
		}
		$has_next = (($counter + 1) < sizeof($tags)) ? 1 : 0;
        $ctx->stash("has_next_praized_user_favorite", $has_next);
		return  $content;
	}
?>