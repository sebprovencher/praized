<?php
	function smarty_block_mtifpraizedmerchantfavorited($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			$merchant = $ctx->stash("current_praized_merchant");
					
			$condition = ($merchant->self->favorite == "true") ? 1: 0;
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);
		} else {
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
		}
	}
?>