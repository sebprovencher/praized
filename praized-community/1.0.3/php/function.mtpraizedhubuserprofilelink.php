<?php
	function smarty_function_mtpraizedhubuserprofilelink($args, &$ctx) {
		$api =& PraizedMTApi::getInstance();
		return $api->praized_link('user_profile');
	}
?>