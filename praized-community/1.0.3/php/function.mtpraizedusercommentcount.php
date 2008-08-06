<?php
	function smarty_function_mtpraizedusercommentcount($args, &$ctx) {
		return $ctx->stash("current_praized_user")->comment_count;
	}
?>