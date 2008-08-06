<?php
	function smarty_function_mtpraizedmerchantstatsimg($args, &$ctx) {
        
	    if( ($merchant = $ctx->stash("current_praized_merchant")) && ! $ctx->stash("collection_praized_merchants") ) {
	        
            $api =& PraizedMTApi::getInstance();
        	
        	if ( ! ( $out = $api->Praized->merchant()->statsImage($merchant) ) )
            	return '';
            
            return $out;
        } else {
            return '';
        }
	}
?>