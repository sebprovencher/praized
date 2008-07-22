<?php
/**
* Abstract action for Praized's custom pages.
*/
class AbstractPraizedAction {
	/**
	* Api gateway
	* @var 
	* @since 0.1
	*/
	var $_api;
	
	/**
	* Constructor
	*		
	* @since 0.1
	*/
	function AbstractPraizedAction() { }

	/**
	* Process base for all MT request.
	* 
	*
	* @param PraizedRequest $request The object with all the informations for the current request.
	* @param MTViewer $ctx The MT context for the current request.
	* @since 0.1
	*/
	function process($request, &$ctx) {
		$this->_api =& PraizedMTApi::getInstance();
		$ctx->stash("current_praized_user_is_authorized", $this->_api->user_is_authorized());
	}		
	
	/**
	* Fetch a specific template for the current request.
	*
	* @param string $name Name of the template to fetch.
	* @param string $type The type of template to fetch, praized's templates are index templates.
	* @return hash 
	* @since 0.1
	*/	
	function fetchTemplate($name, $type = "index") {
		global $mt;
		$db = $mt->db();
		
		// we need to push the current blog_id into the context stash.
		// because its done below the resolv url.
		$mt->context()->stash('blog_id', $mt->blog_id);
		$template = $db->load_special_template($mt->context(), $name, $type);
		
		return $template;
	}
	
	
	/**
	* Small helper function to redirect the user to the right page.
	*
	* @param string $to Where to redirect.
	* @since 0.1
	*/
	function redirect($to, $return = false) {
		if( ! preg_match("/^https?/", $to )) {
			$trigger = PraizedMTConfigs::getInstance()->getPraizedTrigger();

			$url .= $trigger . $to;
			if( ! preg_match("/\//", $url)) $url = "/";
		} else {
			$url  = $to;
		}
		
		if($return == false) {
			header("Location: " . $url, 302);
			exit;
		} else {
			return $url;
		}
	}
	
	
	/**
	* Return the referer for the current request
	*
	* @since 0.1
	*/
	function getReferer() {
		$url = $_SERVER["HTTP_REFERER"];
		return $url;
	}
}
?>