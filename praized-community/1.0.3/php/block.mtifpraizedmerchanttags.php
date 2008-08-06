<?php
	function smarty_block_mtifpraizedmerchanttags($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			$merchant = $ctx->stash("current_praized_merchant");
			$tags = $merchant->tags;
			
			$condition = (sizeof($tags) > 0) ? 1: 0;
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);
		}	else {
				return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
		}
	}
?>