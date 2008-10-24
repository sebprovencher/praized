<?php
	function smarty_function_mtpraizedmerchantfavoritescount($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->favorite_count; 
	}
?>