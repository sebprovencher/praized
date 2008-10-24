<?php
	//todo checker avec frank demain matin.
	// rating name tag vs vote.
	function smarty_function_mtpraizedmerchantselffavorite($args, &$ctx) {
		if($merchant = $ctx->stash("current_praized_merchant"))
			return $merchant->self->favorite;
	}
?>