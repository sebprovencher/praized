<?php
	class PraizedMerchantAction extends AbstractPraizedAction {
		function PraizedMerchantAction() { }
		
		/*
		* we take the current $request and call the api
		* to check if the resource exist.
		* If the request is legit we transform the MT record send it back to MT.
		* If the request doesn't exist when send the data back to MT and the blog
		* engine will throw a 404.
		*/
		function process($request, &$ctx) {
			parent::process($request, $ctx);
					
			$template = $this->fetchTemplate("merchant", "index");
			$request->getData()->update($template);
			
			// Make a simple call to the api. to find the right merchant and to
			// inject the initial data into the ctx. some other block tags will
			// do their own call.
			$api =& PraizedMTApi::getInstance();
			
			$identifier = $request->getCleanRequest("/\/merchants\//");
			$identifier = preg_replace("/\/$/", "", $identifier);
			
			if($content = $api->merchant_get($identifier)) {
				$ctx->stash("current_praized_page_type", "merchant");
				$ctx->stash("current_praized_merchant", $content->merchant);
			
		
				// this request will be cached.
				return true;
			} else {
				return false;
			}
				
		}
	}
?>