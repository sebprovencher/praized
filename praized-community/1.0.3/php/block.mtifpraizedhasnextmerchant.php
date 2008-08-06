<?php
	function smarty_block_mtifpraizedhasnextmerchant($args, $content, &$ctx, &$repeat) {
		$filter = ($args["filter"]) ? $args["filter"]: "";
		if(!isset($content)) {
			$condition = ( $ctx->stash("has_next_praized_merchant$filter") ) ? 1 : 0;
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);
		} else {
            return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
		}
	}
?>