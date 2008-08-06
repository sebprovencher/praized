<?php
	function smarty_function_mtpraizedsearchlocation($args, &$ctx) {
			$content = $ctx->stash("praized_querystring");
			if(is_array($content)) {
				$l = $content["l"];
				return (! is_null($l) ) ? PraizedCore::_tempColinize($l): "";
			}	
			return "";
	}
?>