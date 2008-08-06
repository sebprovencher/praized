<?php
	function smarty_function_mtpraizedsearchterms($args, &$ctx) {
		$content = $ctx->stash("praized_querystring");
		
		if(is_array($content)) {
			$tag = $content["tag"];
			$q   = $content["q"];
		
			if( ! empty($q) ) 
				return PraizedCore::_tempColinize($q);
			else if( ! empty($tag) )
				return PraizedCore::_tempColinize($tag);
		}
		
		return "";
	}
?>