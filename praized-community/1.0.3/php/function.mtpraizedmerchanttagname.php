<?php
	function smarty_function_mtpraizedmerchanttagname($args, &$ctx) {
		$tag = $ctx->stash("current_praized_merchant_tag");
		return $tag->name;
	}
?>