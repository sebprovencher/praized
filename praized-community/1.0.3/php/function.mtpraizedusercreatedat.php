<?php
	function smarty_function_mtpraizedusercreatedat($args, &$ctx) {
		$user = $ctx->stash("current_praized_user");
	
		if(isset($args["format"]) && !empty($user->created_at)) {
			return strftime($args["format"], strtotime($user->created_at));
		}
		return $user->create_at;
	}
?>