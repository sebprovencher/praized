<?php
	function smarty_function_mtpraizeduserdateofbirth($args, &$ctx) {
		return $ctx->stash("current_praized_user")->date_of_birth;			
	}
?>
