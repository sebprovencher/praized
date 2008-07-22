<?php
	function smarty_function_mtpraizedmerchantvotesposcount($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->votes->pos_count; 
	}
?>