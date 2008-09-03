<?php
	function smarty_function_mtpraizedmerchantpid($args, &$ctx) {
			if($pid = $ctx->stash("current_taggings_pid"))
				return $pid;
			elseif($merchant = $ctx->stash("current_praized_merchant"))
				return $merchant->pid; 
	}
?>