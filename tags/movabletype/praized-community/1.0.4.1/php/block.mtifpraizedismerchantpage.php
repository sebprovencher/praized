<?php
	function smarty_block_mtifpraizedismerchantpage($args, $content, &$ctx, &$repeat) {
		if( $ctx->stash("current_praized_merchant") && ! $ctx->stash("collection_praized_merchants") && ! $ctx->stash("collection_praized_merchantstop") ) {
			$condition = 1;		
		} else {
            $condition = 0;
		}
		
		return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);
	}
?>
