<?php
	function smarty_function_mtpraizedsearchquery($args, &$ctx) {
			$content = $ctx->stash("praized_querystring");
			if(is_array($content)) {
				$q = $content["q"];
				return (! is_null($q) ) ? PraizedCore::_tempColinize($q): "";
			}	
			return "";
	}
?>