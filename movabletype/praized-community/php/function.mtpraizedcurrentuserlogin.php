<?php
	function smarty_function_mtpraizedcurrentuserlogin() {
		$api =& PraizedMTApi::getInstance();
		return $api->current_user_login();
	}
?>