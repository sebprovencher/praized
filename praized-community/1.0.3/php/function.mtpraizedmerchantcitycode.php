<?php
	function smarty_function_mtpraizedmerchantcitycode($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->location->city->code; 
	}
?>