<?php
	function smarty_function_mtpraizedmerchantvotescount($args, &$ctx) {
		if($merchant = $ctx->stash("current_praized_merchant"))
			return $merchant->votes->count;
	}
?>