<?php
	function smarty_function_mtpraizeduserlogin($args, &$ctx) {
		// Contextual meaning.
		// is it a comment or a user page?
		if($user = $ctx->stash("current_praized_user_friend")) {
			return $user->login;
		} elseif($comments = $ctx->stash("current_praized_merchant_comment")) {
			return $comments->user->login;
		} elseif($vote = $ctx->stash("current_praized_merchant_praizer")) {
			// use the object node here..
			return $vote->user->login;
		} elseif($user = $ctx->stash("current_praized_merchant_favorer")) {
			return $user->login;				
		} else {
			return $ctx->stash("current_praized_user")->login;			
		}
	}
?>