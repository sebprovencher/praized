<?php
	function smarty_function_mtpraizedmerchantcountry($args, &$ctx) {
		if($merchant = $ctx->stash("current_praized_merchant"))
			return $merchant->location->country->name;
	}
?>