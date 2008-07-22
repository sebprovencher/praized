<?php
	class PraizedMerchantTaggingsAction extends AbstractPraizedAction {
		function PraizedMerchantTaggingsAction() { }
		
		/*
		* we take the current $request and call the api
		* to check if the resource exist.
		* If the request is legit we transform the MT record send it back to MT.
		* If the request doesn't exist when send the data back to MT and the blog
		* engine will throw a 404.
		*/
		function process($request, &$ctx) {
			parent::process($request, $ctx);
					
			$template = $this->fetchTemplate("taggings", "index");
			$request->getData()->update($template);

			$action = $_POST["_action"];

			$api =& PraizedMTApi::getInstance();

		   	$identifier = $request->getCleanRequest("/(\/merchants\/|\/taggings)/");			

			// We keep the current pid in the template.
			$ctx->stash("current_taggings_pid", $identifier);


			if($api->user_is_authorized()) {
				if($action == "add" && !empty($_POST["tag_list"])) {
			   		if($content = $api->merchant_tag_add($identifier, $_POST)) {	
						$content->merchant->permalink;
					}
					$this->redirect("merchants/" . $identifier);
				}
				
				$content = $api->merchant_get($identifier);
				$ctx->stash("current_praized_merchant", $content->merchant);
			} else {
				$api->login($_SERVER["HTTP_REFERER"]);
			}

			// this request will be cached.
			return true;
		}
	}
?>