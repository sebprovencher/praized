<?php
	function smarty_function_mtpraizedmerchanttaglink($args, &$ctx) {
		$tag = $ctx->stash("current_praized_merchant_tag");
		return "merchants/tag/" . $tag->name  . "/" . PraizedMTUtils::query_string($ctx, $args["query_string"]);
	}
?>