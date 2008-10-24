<?php
	class PraizedUserFriendsAction extends AbstractPraizedAction {
		function PraizedUserFriendsAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);

            $api =& PraizedMTApi::getInstance();
			
            $userLogin = $request->getCleanRequest("/(\/users\/|\/friends\/?)/");						
			
			if(sizeof($_POST) > 0) {
				$action = ( $_POST["_action"] == 'delete' ) ? $_POST["_action"] : 'add';
			
			    if($api->user_is_authorized()) {
				   	$user = $_POST["user_login"];
				   	
				   	if ( $action == 'add' ) {
						$r = $api->user_friend_add($user);
				    } else if ( $action == 'delete' ) {
						$r = $api->user_friend_delete($user);
				    }
			
					$this->redirect("users/" . $userLogin);
				} else {
					$api->login($_SERVER["HTTP_REFERER"]);
				}
			} else {
    			$template = $this->fetchTemplate("users_friends", "index");
    			$request->getData()->update($template);
    			
    			$user = $api->user_get($userLogin)->user;
    
    			if( ! $user )
    				return false;
    			
    			$contents = $api->user_friends(
    			    $userLogin,
    			    array("page" => ($_GET["page"]) ? $_GET["page"] : 1)
    			);
    
    			if( ! $contents )
    				return false;
    
    		    $friends    = $contents->users;
    		    $pagination = $contents->pagination;
    			
    			if( ! $user || ! $friends || ! $pagination )
    				return false;
    
    		    $ctx->stash("current_praized_user", $user);
    			$ctx->stash("collections_praized_user_friends", $friends);
    			$ctx->stash("collections_praized_pagination_friends", $pagination);
			}
			$ctx->stash("current_praized_page_type", "users");
			
			return true;
		}
	}
?>