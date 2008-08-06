<?php
	function smarty_block_mtifpraizeduserisauthorized($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			$api =& PraizedMTApi::getInstance();
			$condition = ($api->user_is_authorized()) ? 1: 0;
			
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);
		} else {
			 return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
		}
	}
?>