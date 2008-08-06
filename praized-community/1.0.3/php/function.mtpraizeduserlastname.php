<?php
	function smarty_function_mtpraizeduserlastname($args, &$ctx) {
		return $ctx->stash("current_praized_user")->last_name;
	}
?>