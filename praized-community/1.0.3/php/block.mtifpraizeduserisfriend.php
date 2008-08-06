<?php
	function smarty_block_mtifpraizeduserisfriend($args, $content, &$ctx, &$repeat) {
		$api =& PraizedMTApi::getInstance();
		
		if(!isset($content)) {
			$user = $ctx->stash("current_praized_user");

			$is_friend = ($user->self->friend == "false") ? false : true;
			

			if($ctx->stash("current_praized_user_is_authorized") 
								&& $is_friend) {
				$condition = 1;
			} else {		
				$condition = 0;
			}

			return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);

		} else {
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
		}
	}
?>