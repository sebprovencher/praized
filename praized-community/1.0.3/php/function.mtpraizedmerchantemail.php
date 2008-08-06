<?php
	function smarty_function_mtpraizedmerchantemail($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->email; 
	}
?>