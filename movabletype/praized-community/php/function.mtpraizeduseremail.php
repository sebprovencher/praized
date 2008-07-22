<?php
	function smarty_function_mtpraizeduseremail($args, &$ctx) {
		return $ctx->stash("current_praized_user")->email;			
	}
?>