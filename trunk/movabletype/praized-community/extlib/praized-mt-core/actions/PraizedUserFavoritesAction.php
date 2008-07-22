<?php
	class PraizedUserFavoritesAction extends AbstractPraizedAction {
		function PraizedUserFavoritesAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);
		
			$api =& PraizedMTApi::getInstance();
			
			$userLogin = $request->getCleanRequest("/(\/users\/|\/favorites\/?)/");				

			if(sizeof($_POST) > 0) {
				$action = ( $_POST["_action"] == 'delete' ) ? $_POST["_action"] : 'add';
			
			    if($api->user_is_authorized()) {
				   	$pid = $_POST["pid"];
			
				    if ( $action == 'add' ) {
		                $r = $api->user_favorite_add($pid);
						
					    // TODO add remove favorites, not yet
						// implemented in the api.
						$this->redirect("users/" . $userLogin);
					}
				} else {
					$api->login($_SERVER["HTTP_REFERER"]);
				}
			} else {
    			$template = $this->fetchTemplate("users_favorites", "index");
    			$request->getData()->update($template);
    			
    			$user = $api->user_get($userLogin)->user;
   
    			if( ! $user )
    				return false;
    			
    			$contents = $api->user_favorites(
    			    $userLogin,
    			    array("page" => ($_GET["page"]) ? $_GET["page"] : 1)
    			);
    			
    			if( ! $contents )
    				return false;
    
    		    $favorites  = $contents->merchants;
    		    $pagination = $contents->pagination;
    			
    			if( ! $user || ! $favorites || ! $pagination )
    				return false;
    
    		    $ctx->stash("current_praized_user", $user);
    			$ctx->stash("collections_praized_user_favorites", $favorites);
    			$ctx->stash("collections_praized_pagination_favorites", $pagination);
			}	
			$ctx->stash("current_praized_page_type", "users");
			
			return true;
		}
	}
?>