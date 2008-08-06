<?php
	function smarty_block_mtpraizedmerchantfavorers($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			// initializing the current block
			$api =& PraizedMTApi::getInstance();

			$merchant = $ctx->stash("current_praized_merchant");
			
			$contents = $api->merchant_favorers($merchant->pid);
	
			$users = $contents->users;

			$counter = 0;
			
			// populate the stash with the api request
			$ctx->stash("collections_praized_merchant_favorers", $users);
			$ctx->stash("_block_praized_merchant_favorers_counter", $counter);
			$ctx->stash("current_praized_merchant_favorer", $users[$counter]);
			
			$repeat = ($users != null && sizeof($users) > 0) ? true: false;
		} else {
			// loop on the users			
			$users = $ctx->stash("collections_praized_merchant_favorers");
			$counter  = $ctx->stash("_block_praized_merchant_favorers_counter");
			$counter++;

			if($counter < sizeof($users)) {
				$ctx->stash("current_praized_merchant_favorer", $users[$counter]);
				$ctx->stash("_block_praized_merchant_favorers_counter", $counter);

				$repeat = true;
			} else {
				$repeat = false;
			}
		}
		$has_next = (($counter + 1) < sizeof($tags)) ? 1 : 0;
        $ctx->stash("has_next_praized_merchant_favorer", $has_next);
        return $content;
	}
?>