<?php
	function smarty_function_mtpraizedmerchantstreetaddress($args, &$ctx) {
		if($merchant = $ctx->stash("current_praized_merchant"))
			return $merchant->location->street_address;
	}
?>