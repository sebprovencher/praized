<?php
	function smarty_function_mtpraizedmerchantshorturl($args, &$ctx) {
		if($merchant = $ctx->stash("current_praized_merchant"))
			return $merchant->short_url;
	}
?>