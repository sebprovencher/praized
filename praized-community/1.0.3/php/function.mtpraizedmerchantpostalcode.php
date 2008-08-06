<?php
	function smarty_function_mtpraizedmerchantpostalcode($args, &$ctx) {
		if($merchant = $ctx->stash("current_praized_merchant"))
			return $merchant->location->postal_code;
	}
?>