<?php
	function smarty_function_mtpraizedmerchantregions($args, &$ctx) {
		if($merchant = $ctx->stash("current_praized_merchant")) {
			if($merchant->location->regions->province)
				return $merchant->location->regions->province;
			else
				return $merchant->location->regions->state;
		}
	}
?>