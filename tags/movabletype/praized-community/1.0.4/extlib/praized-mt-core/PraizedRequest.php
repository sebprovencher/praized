<?php
	/**
	* Simple Request object to manipulate the HTTP data.
	*
	* @version 0.1
	*/
	class PraizedRequest {
		var $_request;
		var $_data; 
		var $_params;
		var $_configs;
		
		/**
		* PraizedRequest();
		*
		* constructor
		* 
		* @param string $request the URI
		* @param hash $data MT template data
		* @param hash $get get parameters
		* @param hash $post post parameters
		* @since 0.1
		*/
		function PraizedRequest($request, $data = array(), $get = array(), $post = array()) {
			$this->_configs = PraizedMTConfigs::getInstance();
			
			$trigger = $this->_configs->getPraizedTrigger();
			
			$trigger = str_replace('/', '\/', preg_replace('/\/$/', '', $trigger));
			$request = preg_replace("/^$trigger/", "", $request);
			
			$this->_request = $request;

			$this->_data =& new PraizedMTTemplateMapper($data);
			$this->_params = array_merge($get, $post);			
		}
		
		/**
		* getRequest();
		*
		* Get the current URI
		*
		* @return string Current URI
		* @since 0.1
		*/
		function &getRequest() {
			return $this->_request;
		}
	
		/**
		* getCleanRequest();
		*
		* Clean the URI request with a Regexp.
		* and return it's
		*
		* @param string regular expression
		* @return string URI string.
		* @since 0.1
		*/
		function getCleanRequest($reg) {
			return preg_replace($reg, "", $this->_request);
		}
		
		/**
		* getData();
		* 
		* return the MT template hash
		*
		* @return hash return the MT template hash
		* @since 0.1
		*/
		function &getData() {
			return $this->_data;
		}
		
		/**
		* getParams();
		*
		* return the merged params from get and post hash
		* 
		* @return hash Return the merged get and post hash.
		* @since 0.1
		*/
		function getParams() {
			return $this->_params;
		}
	}
?>