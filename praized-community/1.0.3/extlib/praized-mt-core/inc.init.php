<?php
	// TODO, add an autoload.
	include_once dirname(__FILE__) . "/AbstractPraizedAction.php";
	include_once dirname(__FILE__) . "/PraizedCommunity.php";
	include_once dirname(__FILE__) . "/PraizedRequest.php";
	include_once dirname(__FILE__) . "/PraizedRoute.php";
	include_once dirname(__FILE__) . "/PraizedRouter.php";
	include_once dirname(__FILE__) . "/actions/PraizedMerchantAction.php";
	include_once dirname(__FILE__) . "/actions/PraizedMerchantsTopAction.php";	
	include_once dirname(__FILE__) . "/actions/PraizedMerchantsAction.php";
	include_once dirname(__FILE__) . "/actions/PraizedUserAction.php";
	include_once dirname(__FILE__) . "/actions/PraizedUserFavoritesAction.php";
	include_once dirname(__FILE__) . "/actions/PraizedUserFriendsAction.php";
	include_once dirname(__FILE__) . "/actions/PraizedUserVotesAction.php";
 	include_once dirname(__FILE__) . "/actions/PraizedUserCommentsAction.php";
	include_once dirname(__FILE__) . "/actions/PraizedSearchAction.php";
	include_once dirname(__FILE__) . "/actions/PraizedOAuthAction.php";
	include_once dirname(__FILE__) . "/actions/PraizedMerchantVotesAction.php";
	include_once dirname(__FILE__) . "/actions/PraizedMerchantCommentsAction.php";
	include_once dirname(__FILE__) . "/actions/PraizedMerchantFavoritesAction.php";
	include_once dirname(__FILE__) . "/actions/PraizedMerchantTaggingsAction.php";
	include_once dirname(__FILE__) . "/PraizedMTTemplateMapper.php";
	include_once dirname(__FILE__) . "/PraizedMTApi.php";
	include_once dirname(__FILE__) . "/AbstractPraizedMTCachedApi.php";
	include_once dirname(__FILE__) . "/PraizedMTCachedApiDB.php";
	include_once dirname(__FILE__) . "/PraizedMTConfigs.php";
	include_once dirname(__FILE__) . "/../praized-php/Praized.php";
	include_once dirname(__FILE__) . "/../../php/PraizedViewer.php";
	include_once dirname(__FILE__) . "/PraizedMTUtils.php";

	/**
	* Small old-school-friendly-debugger.
	* dump the message in a <pre> tag.
	* 
	* @param string $message Message to dump
	* @since 0.1
	*/
	function d($message) {
		echo "<div id=\"praized_errors_list\" style=\"font-size: 9px; border: 1px solid Black; background-color: white; text-align: left; \">";
		echo "<pre>";
		var_dump($message);
		echo "</pre>";
		echo "</div>";
	}
?>