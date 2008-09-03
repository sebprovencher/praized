<?php
	class PraizedSearchAction extends AbstractPraizedAction {
		function PraizedSearchAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);
			
			$template = $this->fetchTemplate("merchants", "index");	
			$request->getData()->update($template);
						
			return true;
		}
	}
?>