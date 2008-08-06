<?php
	function smarty_block_mtifpraizedhasnextuserfavorite($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			$condition = ( $ctx->stash("has_next_praized_user_favorite") ) ? 1 : 0;
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);
		} else {
            return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
		}
	}
?>