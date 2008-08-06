<?php
	function smarty_function_mtpraizeduserfriendcount($args, &$ctx) {
		return $ctx->stash("current_praized_user")->friend_count;
	}
?>