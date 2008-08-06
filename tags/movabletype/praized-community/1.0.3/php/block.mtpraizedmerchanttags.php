<?php
	function smarty_block_mtpraizedmerchanttags($args, $content, &$ctx, &$repeat) {
		$repeat = "booz";
		
		if(!isset($content)) {
			// initializing the current block
			$merchant = $ctx->stash("current_praized_merchant");

			$counter = 0;
			$tags = $merchant->tags;

			$ctx->stash("current_praized_merchant_tag", $tags[$counter]);
			$ctx->stash("_block_praized_merchant_tags_counter", $counter);
			
			$repeat = (sizeof($tags) > 0) ? true : false;
		} else {
			$merchant = $ctx->stash("current_praized_merchant");			
			$tags = $merchant->tags;
			
			$counter = $ctx->stash("_block_praized_merchant_tags_counter");
			$counter++;

			if($counter < sizeof($tags)) {
				$ctx->stash("current_praized_merchant_tag", $tags[$counter]);
				$ctx->stash("_block_praized_merchant_tags_counter", $counter);
				
				$repeat = true;
			} else {
				$repeat = false;
			}
		}
		$has_next = (($counter + 1) < sizeof($tags)) ? 1 : 0;
		$ctx->stash("has_next_praized_merchant_tag", $has_next);
		return $content;
	}
?>