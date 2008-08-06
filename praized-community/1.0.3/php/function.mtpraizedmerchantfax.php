<?php
	function smarty_function_mtpraizedmerchantfax($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->fax; 
	}
?>