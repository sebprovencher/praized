<?php
	function smarty_function_mtpraizedmerchantpermalink($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->permalink;
			return "";
	}
?>