<?php
	function smarty_block_mtpraizedmerchantcomments($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			// initializing the current block
			$api =& PraizedMTApi::getInstance();

			$merchant = $ctx->stash("current_praized_merchant");
			
			$contents = $api->merchant_comments($merchant->pid);
	
			$comments = $contents->comments;

			$counter = 0;
			
			// populate the stash with the api request
			$ctx->stash("collections_praized_merchant_comments", $comments);
			$ctx->stash("_block_praized_merchant_comments_counter", $counter);
			$ctx->stash("current_praized_merchant_comment", $comments[$counter]);
			
			$repeat = ($comments != null && sizeof($comments) > 0) ? true: false;
		} else {
			// loop in the comments, slashing spammers in the way.			
			$comments = $ctx->stash("collections_praized_merchant_comments");
			$counter  = $ctx->stash("_block_praized_merchant_comments_counter");
			$counter++;

			if($counter < sizeof($comments)) {
				$ctx->stash("current_praized_merchant_comment", $comments[$counter]);
				$ctx->stash("_block_praized_merchant_comments_counter", $counter);

				$repeat = true;
			} else {
				$repeat = false;
			}
		}
		$has_next = (($counter + 1) < sizeof($tags)) ? 1 : 0;
		$ctx->stash("has_next_praized_merchant_comment", $has_next);
		return  $content;
	}
?>