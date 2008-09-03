<?php
	function smarty_function_mtpraizedusergender($args, &$ctx) {
		return $ctx->stash("current_praized_user")->gender;			
	}
?>