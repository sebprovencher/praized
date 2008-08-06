<?php
	function smarty_function_mtpraizedmerchantcreatedat($args, &$ctx) {
			if($merchant = $ctx->stash("current_praized_merchant")) {
				if(isset($args["format"]))
					return strftime($args["format"], strtotime($merchant->created_at));
				else
					return $merchant->created_at; 
			}
	}
?>