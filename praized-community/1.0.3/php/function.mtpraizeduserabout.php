<?php
	function smarty_function_mtpraizeduserabout($args, &$ctx) {
		return $ctx->stash("current_praized_user")->about;
	}
?>