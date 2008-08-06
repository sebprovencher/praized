<?php
	// TODO replace limit with per_page. like in the user profile page.
	function smarty_block_mtpraizedmerchants($args, $content, &$ctx, &$repeat) {
			$filter = ($args["filter"]) ? $args["filter"]: "";
			$limit  = ($args["limit"]) ? $args["limit"]: 10;
			$query  = ($args["query"]) ? $args["query"]: "";
			$location  = ($args["location"]) ? $args["location"]: "";
			
			if(!isset($content)) {
				$counter = 0;

				if( $filter == "top" ) {
				
					$api =& PraizedMTApi::getInstance();
					$merchants = $api->merchant_search(
											$query,
											$location,
											$limit,
											$args
										);

					$ctx->stash("collection_praized_merchants$filter", $merchants->merchants);
				} 
				
		        $merchants = $ctx->stash("collection_praized_merchants$filter");
				
				$ctx->stash("current_praized_merchant", $merchants[$counter]);
				$ctx->stash("_block_praized_merchants_counter$filter", $counter);
				
				$repeat = (sizeof($merchants) > 0) ? true: false;
			} else {
				$merchants = $ctx->stash("collection_praized_merchants$filter");
				
				$counter = $ctx->stash("_block_praized_merchants_counter$filter");
				$counter++;
				if($counter < sizeof($merchants)) {
					$ctx->stash("current_praized_merchant", $merchants[$counter]);
					$ctx->stash("_block_praized_merchants_counter$filter", $counter);		
					$repeat = true;
				} else {
					$repeat = false;
				}
			}
			$has_next = (($counter + 1) < sizeof($tags)) ? 1 : 0;
			$ctx->stash("has_next_praized_merchant$filter", $has_next);
			return $content;
	}
?>