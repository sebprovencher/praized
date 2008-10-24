<?php
	class PraizedOAuthAction extends AbstractPraizedAction {
		function PraizedOAuthAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);

			$api =& PraizedMTApi::getInstance();
			$api->session($_SERVER["HTTP_REFERER"]);

			return true;
		}
	}
?>