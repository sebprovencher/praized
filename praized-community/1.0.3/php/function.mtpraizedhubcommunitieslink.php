<?php
	function smarty_function_mtpraizedhubcommunitieslink($args, &$ctx) {
		$api =& PraizedMTApi::getInstance();
		return $api->praized_link('communities');
	}
?>