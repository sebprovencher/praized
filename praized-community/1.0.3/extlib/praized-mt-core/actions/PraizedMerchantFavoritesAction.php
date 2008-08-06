<?php
	class PraizedMerchantFavoritesAction extends AbstractPraizedAction {
		function PraizedMerchantFavoritesAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);

			
			$template = $this->fetchTemplate("merchants_favorites", "index");
			$request->getData()->update($template);
			
			$api =& PraizedMTApi::getInstance();
			
			$pid =  $request->getCleanRequest("/(\/merchants\/|\/favorites\/?)/");
			
			$merchant = $api->merchant_get($pid)->merchant;



			if( ! $merchant )
				return false;
			
			$contents = $api->merchant_favorers(
			    $pid,
			    array("page" => ($_GET["page"]) ? $_GET["page"] : 1)
			);

			if( ! $contents )
				return false;

		    $favorites  = $contents->users;
		    $pagination = $contents->pagination;

			if( ! $merchant || ! $favorites || ! $pagination )
				return false;


		    $ctx->stash("current_praized_merchant", $merchant);
			$ctx->stash("collections_praized_merchant_favorites", $favorites);
			$ctx->stash("collections_praized_pagination_favorites", $pagination);
			
			return true;
		}
	}
?>