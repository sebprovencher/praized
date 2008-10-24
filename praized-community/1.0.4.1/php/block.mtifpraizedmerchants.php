<?php
	function smarty_block_mtifpraizedmerchants($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			$merchants = $ctx->stash("collection_praized_merchants");
			if(! is_null($merchants) && sizeof($merchants) > 0)
				$conditions = 1;
			else
				$condition  = 0;
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);
		} else {
			 return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
		}
	}
?>