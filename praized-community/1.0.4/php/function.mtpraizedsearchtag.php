<?php
	function smarty_function_mtpraizedsearchtag($args, &$ctx) {
			$content = $ctx->stash("praized_querystring");
			if(is_array($content)) {
				$tag = $content["tag"];
				return (! is_null($tag) ) ? PraizedCore::_tempColinize($tag): "";
			}	
			return "";
	}
?>