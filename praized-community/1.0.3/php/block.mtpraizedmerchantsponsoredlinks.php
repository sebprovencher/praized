<?php
	function smarty_block_mtpraizedmerchantsponsoredlinks($args, $content, &$ctx, &$repeat) {
    	if ( ! $ctx->stash("collection_praized_merchants") ) {
	        if(!isset($content)) {
    			// initializing the current block
    			$merchant = $ctx->stash("current_praized_merchant");
    			$sponsoredlinks = $merchant->sponsored_links;
    
    			$counter = 0;
    			
    			// We need to make sure we have the right order
    			$sponsoredlinks_sorted = array();
    			foreach($sponsoredlinks as $link) {
    				$sponsoredlinks_sorted[$link->order] = $link;
    			}
    			
    			// populate the stash with the api request
    			$ctx->stash("collections_praized_merchant_sponsoredlinks", $sponsoredlinks_sorted);
    			$ctx->stash("_block_praized_merchant_sponsoredlinks_counter", $counter);
    			$ctx->stash("current_praized_merchant_sponsoredlinks", $sponsoredlinks_sorted[$counter]);
    			
    			$repeat = ($sponsoredlinks != null && sizeof($sponsoredlinks) > 0) ? true: false;
    		} else {
    			// loop on the praizers			
    			$sponsoredlinks = $ctx->stash("collections_praized_merchant_sponsoredlinks");
    			$counter  = $ctx->stash("_block_praized_merchant_sponsoredlinks_counter");
    			$counter++;
    
    			if($counter < sizeof($sponsoredlinks)) {
    				$ctx->stash("current_praized_merchant_sponsoredlinks", $sponsoredlinks[$counter]);
    				$ctx->stash("_block_praized_merchant_sponsoredlinks_counter", $counter);
    
    				$repeat = true;
    			} else {
    				$repeat = false;
    			}
    			
    		}
    		$has_next = (($counter + 1) < sizeof($tags)) ? 1 : 0;
    		$ctx->stash("has_next_praized_merchant_sponsoredlink", $has_next);
            return $content;
    	} else {
    	    return '';
    	}
	}
?>