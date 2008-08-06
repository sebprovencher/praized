<?php
	function smarty_function_mtpraizedhubaddplacelink($args, &$ctx) {
		$api =& PraizedMTApi::getInstance();
		return $api->praized_link('add_place');
	}
?>