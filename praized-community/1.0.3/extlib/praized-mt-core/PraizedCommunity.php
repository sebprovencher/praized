<?php
/**
* Initialize the Praized Community plugin
* 
* @version 0.1
*/
class PraizedCommunity {
	/**
	* MT main object reference..
	* @var MTViewer
	* @since 0.1
	*/
	var $_mt;
	
	/**
	* Routing object for dispatching
	* @var PraizedRouter
	* @since 0.1
	*/  
	var $_router;
	
	/**
	* Request object
	*
	* @var PraizedRequest
	* @since 0.1
	*/  
	var $_request;
	
	/**
	* PraizedCommunity();
	*
	* @since 0.1
	*/
	function PraizedCommunity($mt_data, $path) {
		global $mt, $_POST, $_GET;
		
		$this->_mt =& $mt;

		
		$this->_mapRoutes();
		$this->_request = new PraizedRequest($path, $mt_data, $_GET, $_POST);
	}
	
	/**
	* generate();
	* Try to find a route matching the current request
	* and find the corresponding template for this type.
	* 
	* @return hash Return the hash for the MT parser.
	* @since 0.1
	*/	
	function generate() {
		if($action = $this->_router->compile($this->_request)) {
			if($action->process($this->_request, $this->_mt->context())) {
				$d = $this->_request->getData()->get();
				return $d;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* _mapRoutes();
	* We define all the routes we want to accept
	* keep in mind this is not a complete restful router.
	* 
	* @since 0.1
	*/
	function _mapRoutes() {
		$this->_router = new PraizedRouter();

		// Merchants
		$this->_router->add(new PraizedRoute("/^\/$/", 
											new PraizedMerchantsTopAction()));

	    $this->_router->add(new PraizedRoute("/^\/merchants\/[0-9a-f]{32,34}\/votes\/?/",
											new PraizedMerchantVotesAction()));

	    $this->_router->add(new PraizedRoute("/^\/merchants\/[0-9a-f]{32,34}\/favorites\/?/",
											new PraizedMerchantFavoritesAction()));

	    $this->_router->add(new PraizedRoute("/^\/merchants\/[0-9a-f]{32,34}\/comments\/?/",
											new PraizedMerchantCommentsAction()));
											
		$this->_router->add(new PraizedRoute("/^\/merchants\/[0-9a-f]{32,34}\/taggings\/?/",
												new PraizedMerchantTaggingsAction()));
		
		$this->_router->add(new PraizedRoute("/^\/merchants\/search\/?/",
											new PraizedMerchantsAction()));

		$this->_router->add(new PraizedRoute("/^\/merchants\/tag\/.+\/?/", 
											new PraizedMerchantsAction()));

		$this->_router->add(new PraizedRoute("/^\/merchants\/[0-9a-f]{32,34}\/?/", 
											new PraizedMerchantAction()));

		$this->_router->add(new PraizedRoute("/^\/merchants\/?$/", 
											new PraizedMerchantsAction()));

		$this->_router->add(new PraizedRoute("/^\/places\/.+/", 
											new PraizedMerchantAction()));

		// Path relative the users (profile, votes, comment with pagination.)
	    $this->_router->add(new PraizedRoute('|^\/users\/([^\.~!%\^\*\(\)\{\}\|\"\'\`&<>\[\];,\+\\\\/]+)\/favorites\/?$|',
											new PraizedUserFavoritesAction()));

 		$this->_router->add(new PraizedRoute('|^\/users\/([^\.~!%\^\*\(\)\{\}\|\"\'\`&<>\[\];,\+\\\\/]+)\/friends\/?$|',
												new PraizedUserFriendsAction()));

		$this->_router->add(new PraizedRoute('|^\/users\/([^\.~!%\^\*\(\)\{\}\|\"\'\`&<>\[\];,\+\\\\/]+)\/votes\/?$|',
												new PraizedUserVotesAction()));

		$this->_router->add(new PraizedRoute('|^\/users\/([^\.~!%\^\*\(\)\{\}\|\"\'\`&<>\[\];,\+\\\\/]+)\/comments\/?$|',
												new PraizedUserCommentsAction()));					

		$this->_router->add(new PraizedRoute('|^\/users\/([^\.~!%\^\*\(\)\{\}\|\"\'\`&<>\[\];,\+\\\\/]+)\/?$|', 
									new PraizedUserAction()));
											
		// This is use for oauth handling.
        $this->_router->add(new PraizedRoute("/^\/oauth\/(login|logout)\/?/", 
	   									new PraizedOAuthAction()));
	}  
}
?>