<?php
	function smarty_function_mtpraizeduservotecount($args, &$ctx) {
		return $ctx->stash("current_praized_user")->vote_count;
	}
?>