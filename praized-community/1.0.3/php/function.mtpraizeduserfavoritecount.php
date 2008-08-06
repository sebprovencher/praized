<?php
	function smarty_function_mtpraizeduserfavoritecount($args, &$ctx) {
		return $ctx->stash("current_praized_user")->favorite_count;
	}
?>