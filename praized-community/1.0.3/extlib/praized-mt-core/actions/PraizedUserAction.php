<?php
	class PraizedUserAction extends AbstractPraizedAction {
		function PraizedUserAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);
			
			$template = $this->fetchTemplate("users", "index");
			$request->getData()->update($template);
		
			// fetch the current user.
			$api =& PraizedMTApi::getInstance();
	
			$pid =  $request->getCleanRequest("/(users|\/)/");


			if($user = $api->user_get($pid)->user) {	
		
				$ctx->stash("current_praized_user", $user);
			
	    		if( ! empty($_POST["_action"]) ) {
				    $action = ( $_POST["_action"] == 'delete' ) ? $_POST["_action"] : 'add';
					if ( $action == 'add' )
					    $api->user_friend_add($user->login, array(), $_SERVER["PHP_SELF"]);
					else
					    $api->user_friend_delete($user->login, array(), $_SERVER["PHP_SELF"]);
				}
				
				$ctx->stash("current_praized_page_type", "users");
				
				return true;
			} else {
				return false;
			}
		}
	}
?>