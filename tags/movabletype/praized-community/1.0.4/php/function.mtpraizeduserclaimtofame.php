<?php
	function smarty_function_mtpraizeduserclaimtofame($args, &$ctx) {
		return $ctx->stash("current_praized_user")->claim_to_fame;	
	}
?>