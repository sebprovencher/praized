<?php
	class PraizedUserCommentsAction extends AbstractPraizedAction {
		function PraizedUserCommentsAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);
			
			$template = $this->fetchTemplate("users_comments", "index");
			$request->getData()->update($template);
			
			$api =& PraizedMTApi::getInstance();
			
			$userLogin =  $request->getCleanRequest("/(\/users\/|\/comments\/?)/");
			
			$user = $api->user_get($userLogin)->user;

			if( ! $user )
				return false;
			
			$contents = $api->user_comments(
			    $userLogin,
			    array("page" => ($_GET["page"]) ? $_GET["page"] : 1)
			);

			if( ! $contents )
				return false;

		    $comments   = $contents->comments;
		    $pagination = $contents->pagination;
			
			if( ! $user || ! $comments || ! $pagination )
				return false;

		    $ctx->stash("current_praized_user", $user);
			$ctx->stash("collections_praized_user_comments", $comments);
			$ctx->stash("collections_praized_pagination_comments", $pagination);
			
			return true;
		}
	}
?>