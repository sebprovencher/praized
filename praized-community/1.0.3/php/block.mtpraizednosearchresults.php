<?php
	function smarty_block_mtpraizednosearchresults($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			$merchants = $ctx->stash("collection_praized_merchants");

			if(sizeof($merchants) == 0)
				$condition = 1;
			else
				$condition = 0;
			
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);
		} else {
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
		}
	}
?>