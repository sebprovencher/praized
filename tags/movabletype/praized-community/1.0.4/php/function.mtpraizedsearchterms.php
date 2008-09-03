<?php
	function smarty_function_mtpraizedsearchterms($args, &$ctx) {
		$content = $ctx->stash("praized_querystring");
		
		if(is_array($content)) {
			$tag = $content["tag"];
			$q   = $content["q"];

			if( ! empty($q) && empty($tag) ) // clearing search term if in tag search mode
				return PraizedCore::_tempColinize($q);
		}
		
		return "";
	}
?>