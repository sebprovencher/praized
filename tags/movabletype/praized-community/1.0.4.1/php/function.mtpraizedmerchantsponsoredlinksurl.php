<?php
	function smarty_function_mtpraizedmerchantsponsoredlinksurl($args, &$ctx) {
		if($sponsor = $ctx->stash("current_praized_merchant_sponsoredlinks"))
			return $sponsor->url;
	}
?>