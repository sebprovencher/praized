<?php
	function smarty_function_mtpraizedmerchantbusinesshours($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->business_hours; 
	}
?>