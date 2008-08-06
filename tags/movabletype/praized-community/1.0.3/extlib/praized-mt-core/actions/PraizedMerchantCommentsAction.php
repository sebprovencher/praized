<?php
	class PraizedMerchantCommentsAction extends AbstractPraizedAction {
		function PraizedMerchantCommentsAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);
			
			$api =& PraizedMTApi::getInstance();
			
			$pid =  $request->getCleanRequest("/(\/merchants\/|\/comments\/?)/");
			
			if( sizeof($_POST) > 0 ) {
			   	$template = $this->fetchTemplate("merchant", "index");
			   	$request->getData()->update($template);
			
		
				$content = $api->merchant_comment_add($pid, $_POST);
			   	
			   	$ctx->stash("current_praized_merchant", $content->merchant);

				return true;
			} else {
				// Comments listing with pagination
				$template = $this->fetchTemplate("merchants_comments", "index");
				$request->getData()->update($template);

				$merchant = $api->merchant_get($pid)->merchant;

				if( ! $merchant )
					return false;
			
				$contents = $api->merchant_comments(
				    $pid,
				    array("page" => ($_GET["page"]) ? $_GET["page"] : 1)
				);

				if( ! $contents )
					return false;

			    $comments   = $contents->comments;
			    $pagination = $contents->pagination;
			
				if( ! $merchant || ! $comments || ! $pagination )
					return false;

			    $ctx->stash("current_praized_merchant", $merchant);
				$ctx->stash("collections_praized_merchant_comments", $comments);
				$ctx->stash("collections_praized_pagination_comments", $pagination);
			
				return true;
			}
		}
	}
?>