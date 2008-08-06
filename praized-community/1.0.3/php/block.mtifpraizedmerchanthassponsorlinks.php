<?php
	function smarty_block_mtifpraizedmerchanthassponsorlinks($args, $content, &$ctx, &$repeat) {
		if(!isset($content) && ! $ctx->stash("collection_praized_merchants")) {

			$merchant = $ctx->stash("current_praized_merchant");
			$sponsoredlinks = $merchant->sponsored_links;
		
		
			$condition = ($sponsoredlinks != null && sizeof($sponsoredlinks) > 0) ? 1: 0;		

			return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);
		} else {
            return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
		}
	}
?>



