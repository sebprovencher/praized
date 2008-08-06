<?php
	class PraizedFriendAction extends AbstractPraizedAction {
		function PraizedFriendAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);
			
		   	$template = $this->fetchTemplate("user", "index");
		   	$request->getData()->update($template);
		   
			$pid    = $_POST["pid"];
			$action = ( $_POST["_action"] == 'delete' ) ? $_POST["_action"] : 'add';
			
			$api =& PraizedMTApi::getInstance();

			if($api->user_is_authorized()) {
			   	$identifier = $request->getCleanRequest("/(\/users\/|\/friends)/");
			   	
			    if ( $action == 'add' )
				    $api->user_friend_add($identifier);
				else
				    $api->user_friend_delete($identifier);

				$content = $api->user_get($identifier);
				    
			   	$ctx->stash("current_praized_user", $content->user);
			} else {
				$api->login($_SERVER["HTTP_REFERER"]);
			}
			
			return true;
		}
	}
?>