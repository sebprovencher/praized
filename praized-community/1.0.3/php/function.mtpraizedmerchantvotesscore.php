<?php
	function smarty_function_mtpraizedmerchantvotesscore($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->votes->score; 
	}
?>