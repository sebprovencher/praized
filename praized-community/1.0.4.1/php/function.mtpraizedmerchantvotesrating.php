<?php
	function smarty_function_mtpraizedmerchantvotesrating($args, &$ctx) {

			if($content = $ctx->stash("current_praized_vote")){
				return $content->rating; 
			}
	}
?>