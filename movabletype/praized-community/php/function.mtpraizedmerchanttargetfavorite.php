<?php
	function smarty_function_mtpraizedmerchanttargetfavorite($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->target->favorite; 
	}
?>