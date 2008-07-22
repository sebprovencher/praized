<?php
	function smarty_function_mtpraizedmerchantcommentscount($args, &$ctx) {
		if($merchant = $ctx->stash("current_praized_merchant"))
			return $merchant->comment_count;
	}
?>