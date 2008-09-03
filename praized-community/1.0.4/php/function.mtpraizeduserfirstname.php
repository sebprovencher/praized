<?php
	function smarty_function_mtpraizeduserfirstname($args, &$ctx) {
		return $ctx->stash("current_praized_user")->first_name;			
	}
?>