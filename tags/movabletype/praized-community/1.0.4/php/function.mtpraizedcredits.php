<?php
	function smarty_function_mtpraizedcredits($args, &$ctx) {
		$api =& PraizedMTApi::getInstance();
		return $api->Praized->credits();
	}
?>