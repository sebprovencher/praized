<?php
	class PraizedUserVotesAction extends AbstractPraizedAction {
		function PraizedUserVotesAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);
			
			$template = $this->fetchTemplate("users_votes", "index");
			$request->getData()->update($template);
			
			$api =& PraizedMTApi::getInstance();
			
			$userLogin =  $request->getCleanRequest("/(\/users\/|\/votes\/?)/");
			
			$user = $api->user_get($userLogin)->user;

			if( ! $user )
				return false;
			
			$contents = $api->user_votes(
			    $userLogin,
			    array("page" => ($_GET["page"]) ? $_GET["page"] : 1)
			);

			if( ! $contents )
				return false;
    
		    $votes      = $contents->votes;
		    $pagination = $contents->pagination;
			
			if( ! $user || ! $votes || ! $pagination )
				return false;

		    $ctx->stash("current_praized_user", $user);
			$ctx->stash("collections_praized_user_votes", $votes);
			$ctx->stash("collections_praized_pagination_votes", $pagination);
			
			return true;
		}
	}
?>