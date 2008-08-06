<?php
	class PraizedFavoriteAction extends AbstractPraizedAction {
		function PraizedFavoriteAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);
			
		   	$template = $this->fetchTemplate("merchant", "index");
		   	$request->getData()->update($template);
		   
			$pid    = $_POST["pid"];
			$action = ( $_POST["_action"] == 'delete' ) ? $_POST["_action"] : 'add';
			
			$api =& PraizedMTApi::getInstance();

			if($api->user_is_authorized()) {
			   	$identifier = $request->getCleanRequest("/(\/merchants\/|\/favorites)/");
			   	
			    if ( $action == 'add' )
				    $api->merchant_favorite_add($identifier);
				else
				    $api->merchant_favorite_delete($identifier);

				$content = $api->merchant_get($identifier);
				    
			   	$ctx->stash("current_praized_merchant", $content->merchant);
			} else {
				$api->login($_SERVER["HTTP_REFERER"]);
			}
			
			return true;
		}
	}
?>