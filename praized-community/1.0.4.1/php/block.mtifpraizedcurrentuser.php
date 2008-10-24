<?php
	function smarty_block_mtifpraizedcurrentuser($args, $content, &$ctx, &$repeat) {
		if(!isset($content)) {
			$user = $ctx->stash("current_praized_user");
			
			$api =& PraizedMTApi::getInstance();			
		
			if($user->login == $api->current_user_login())
				$condition = 1;
			else
				$condition = 0;
				
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat, $condition);
		} else {
			return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
		}
	}
?>