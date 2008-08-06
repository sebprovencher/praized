<?php
	//todo checker avec frank demain matin.
	// rating name tag vs vote.
	function smarty_function_mtpraizedmerchantselfrating($args, &$ctx) {
		if($merchant = $ctx->stash("current_praized_merchant")) {
			$vote =  $merchant->self->rating;
			if ( ! empty($vote) )
			    $vote = 'voted-' . $vote;
			return $vote;
		}
	}
?>