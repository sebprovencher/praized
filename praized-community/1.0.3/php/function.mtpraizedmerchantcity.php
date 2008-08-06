<?php
	function smarty_function_mtpraizedmerchantcity($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->location->city->name; 
	}
?>