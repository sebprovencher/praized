<?php
	function smarty_block_mtpraizeduserfriends($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			// initializing the current block
			$api =& PraizedMTApi::getInstance();

			$user = $ctx->stash("current_praized_user");

			if(! ($friends = $ctx->stash("collections_praized_user_friends")) ) {
				$contents = $api->user_friends($user->login, $args);

				$friends = $contents->users;
				$ctx->stash("collections_praized_user_friends", $friends);

			}
			
			$counter = 0;
			
			// populate the stash with the api request
			$ctx->stash("_block_praized_user_friends_counter", $counter);
			$ctx->stash("current_praized_user_friend", $friends[$counter]);
			
			$repeat = ($friends != null && sizeof($friends) > 0) ? true: false;
		} else {
			// loop on the friends			
			$friends = $ctx->stash("collections_praized_user_friends");
			$counter  = $ctx->stash("_block_praized_user_friends_counter");
			$counter++;

			if($counter < sizeof($friends)) {
				$ctx->stash("current_praized_user_friend", $friends[$counter]);
				$ctx->stash("_block_praized_user_friends_counter", $counter);

				$repeat = true;
			} else {
				$ctx->stash("current_praized_user_friend", "");
				$repeat = false;
			}
		}
		$has_next = (($counter + 1) < sizeof($tags)) ? 1 : 0;
        $ctx->stash("has_next_praized_user_friend", $has_next);
		return $content;
	}
?>