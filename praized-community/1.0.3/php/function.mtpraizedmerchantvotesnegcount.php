<?php
	function smarty_function_mtpraizedmerchantvotesnegcount($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->votes->neg_count; 
	}
?>