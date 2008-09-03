<?php
	function smarty_block_mtpraizedmerchantpraizers($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			// initializing the current block
			$api =& PraizedMTApi::getInstance();
			
			$merchant = $ctx->stash("current_praized_merchant");
			$contents = $api->merchant_praizers($merchant->pid);
			
			$praizers = $contents->votes; 
			
			$counter = 0;
			
			// populate the stash with the api request
			$ctx->stash("block_praized_merchant_praizers", $praizers);
			$ctx->stash("_block_praized_merchant_praizers_counter", $counter);
			
			$ctx->stash("current_praized_merchant_praizer", $praizers[$counter]);
						
			$repeat = (sizeof($praizers) > 0) ? true: false;
		} else {
			$praizers = $ctx->stash("block_praized_merchant_praizers");
			$counter  = $ctx->stash("_block_praized_merchant_praizers_counter");
			$counter++;
			
			if($counter < sizeof($praizers)) {
				$ctx->stash("current_praized_merchant_praizer", $praizers[$counter]);
				$ctx->stash("_block_praized_merchant_praizers_counter", $counter);
				$repeat = true;
			} else {
				$repeat = false;
			}
		}
		$has_next = (($counter + 1) < sizeof($tags)) ? 1 : 0;
		$ctx->stash("has_next_praized_merchant_praizer", $has_next);
		return $content;
	}
?>