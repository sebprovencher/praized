<?php
	function smarty_function_mtpraizedmerchantlongitude($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->location->longitude; 
	}
?>