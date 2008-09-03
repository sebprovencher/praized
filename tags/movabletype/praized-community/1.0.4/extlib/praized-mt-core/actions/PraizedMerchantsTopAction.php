<?php
	class PraizedMerchantsTopAction extends AbstractPraizedAction {
		function PraizedMerchantsTopAction() {	}
		
		function process(&$request, &$ctx) {
			parent::process($request, $ctx);
			
			$template = $this->fetchTemplate("Main Index", "index");
			$request->getData()->update($template);


			return true;
		}
	}
?>