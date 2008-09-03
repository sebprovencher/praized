<?php
	function smarty_block_mtpraizedusercomments($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			// initializing the current block
			$api =& PraizedMTApi::getInstance();

			$user = $ctx->stash("current_praized_user");

			if(! ($comments = $ctx->stash("collections_praized_user_comments")) ) {
				$contents = $api->user_comments($user->login, $args);
				$comments = $contents->comments;

				$ctx->stash("collections_praized_user_comments", $comments);
			}
					
		    $counter = 0;
			
			// populate the stash with the api request
	
			$ctx->stash("_block_praized_user_comments_counter", $counter);
			$ctx->stash("current_praized_merchant_comment", $comments[$counter]);
			$ctx->stash("current_praized_merchant", $comments[$counter]->merchant);
						
			$repeat = ($comments != null && sizeof($comments) > 0) ? true: false;
		} else {
			// loop on the favorites	
			$comments = $ctx->stash("collections_praized_user_comments");
			$counter   = $ctx->stash("_block_praized_user_comments_counter");
			$counter++;

			if($counter < sizeof($comments)) {
				$ctx->stash("current_praized_merchant_comment", $comments[$counter]);
				$ctx->stash("_block_praized_user_comments_counter", $counter);
				$ctx->stash("current_praized_merchant", $comments[$counter]->merchant);
			
				$repeat = true;
			} else {
				$repeat = false;
			}
		}
		$has_next = (($counter + 1) < sizeof($tags)) ? 1 : 0;
		$ctx->stash("has_next_praized_user_comment", $has_next);
		return $content;
	}
?>