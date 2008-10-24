<?php
	function smarty_function_mtpraizedmerchantphone($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->phone; 
	}
?>