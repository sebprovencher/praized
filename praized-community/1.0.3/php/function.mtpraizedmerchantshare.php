<?php
	function smarty_function_mtpraizedmerchantshare($args, &$ctx) {
        if($merchant = $ctx->stash("current_praized_merchant")) {
            $api =& PraizedMTApi::getInstance();
			$script = $api->Praized->merchant()->share($merchant->pid);
            if ( ! $script)
                return '';
            else
                return $script; 
        } else {
            return '';
        }
	}
?>