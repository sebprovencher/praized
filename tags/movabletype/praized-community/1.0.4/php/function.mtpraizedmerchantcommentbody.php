<?php
	function smarty_function_mtpraizedmerchantcommentbody($args, &$ctx) {
		if($comment = $ctx->stash("current_praized_merchant_comment"))
			return $comment->comment;
	}
?>