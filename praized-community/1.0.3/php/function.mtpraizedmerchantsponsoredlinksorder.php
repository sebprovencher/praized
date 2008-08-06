<?php
	function smarty_function_mtpraizedmerchantsponsoredlinksorder($args, &$ctx) {
		if($sponsor = $ctx->stash("current_praized_merchant_sponsoredlinks"))
			return $sponsor->order;
	}
?>