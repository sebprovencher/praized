<?php
	function smarty_function_mtpraizedmerchantcountrycode($args, &$ctx) {
		if($merchant = $ctx->stash("current_praized_merchant"))
			return $merchant->location->country->code;
	}
?>