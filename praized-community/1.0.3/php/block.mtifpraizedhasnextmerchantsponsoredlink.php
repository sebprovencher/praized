<?php
	function smarty_block_mtifpraizedhasnextmerchantsponsoredlink($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			$condition = ( $ctx->stash("has_next_praized_merchant_sponsoredlink") ) ? 1 : 0;
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);
		} else {
            return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
		}
	}
?>