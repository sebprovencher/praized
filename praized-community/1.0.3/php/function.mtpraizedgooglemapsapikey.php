<?php
	function smarty_function_mtpraizedgooglemapsapikey($args, &$ctx) {
		$configs = PraizedMTConfigs::getInstance();
		return $configs->getGoogleMapsApiKey();
	}
?>