<?php
	function smarty_function_mtpraizedmerchantdescription($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->description; 
	}
?>