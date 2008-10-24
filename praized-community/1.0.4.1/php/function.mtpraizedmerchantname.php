<?php
	function smarty_function_mtpraizedmerchantname($args, &$ctx) {
		if($merchant = $ctx->stash("current_praized_merchant"))
			return $merchant->name;
	}
?>