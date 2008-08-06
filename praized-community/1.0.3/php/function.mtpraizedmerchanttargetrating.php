<?php
	function smarty_function_mtpraizedmerchanttargetrating($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->target->rating; 
	}
?>