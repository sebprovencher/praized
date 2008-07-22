<?php
	function smarty_function_mtpraizedmerchanturl($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->url; 
	}
?>