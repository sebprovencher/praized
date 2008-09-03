<?php
	function smarty_function_mtpraizedmerchanttagcount($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->tag_count; 
	}
?>