<?php
	// TODO add strftime
	function smarty_function_mtpraizedmerchantcommentdate($args, &$ctx) {
		if($comment = $ctx->stash("current_praized_merchant_comment")){
			if(isset($args["format"]))
				return strftime($args["format"], strtotime($comment->created_at));
			else
				return $comment->created_at;
		}
	}
?>