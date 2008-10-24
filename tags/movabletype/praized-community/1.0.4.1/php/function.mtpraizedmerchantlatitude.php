<?php
	function smarty_function_mtpraizedmerchantlatitude($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->location->latitude; 
	}
?>