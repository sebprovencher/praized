<?php
	class PraizedMerchantsAction extends AbstractPraizedAction {
		function PraizedMerchantsAction() {	}
		
		function process(&$request, &$ctx) {
			parent::process($request, $ctx);
			
			$template = $this->fetchTemplate("merchants", "index");
			
			$request->getData()->update($template);
			
			$params = $request->getParams();

			// do we have a tag search?
			if(preg_match("/^\/merchants\/tag\/?/", $request->getRequest()))
				$tag = $request->getCleanRequest("/^\/merchants\/tag\//");
			
			// We need to save the querystring parameters
			// to show them in the templates.
			$ctx->stash("praized_querystring", array(
														"q" => $params["q"],
														"l" => $params["l"],
														"tag" => $tag
													 ));

			$api =& PraizedMTApi::getInstance();

			$content = $api->merchant_search(
									$params["q"],
									$params["l"],
									10,
									array(
										"page" => ($params["page"]) ? $params["page"] : 1,
										"tag" => $tag
									)
							 );
				
			$merchants  = $content->merchants;
			$pagination = $content->pagination;
			
			$merchants  = ( ! $merchants ) ? array() : $merchants;
			
			$ctx->stash("collections_praized_pagination", $pagination);
			$ctx->stash("collection_praized_merchants", $merchants);
			
			
			$ctx->stash("current_praized_page_type", "merchants");
			
			return true;
		}
	}
?>