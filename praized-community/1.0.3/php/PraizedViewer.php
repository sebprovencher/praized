<?php
	include_once dirname(__FILE__) . "/../extlib/praized-mt-core/inc.init.php";

	# We need to subclass the MT Viewer to intercept the resolve_url() method.
	class PraizedViewer extends MT {
		var $_configs;
		
		/**
		* Constructor
		*
		* @param int $blog_id Blog id
		* @param string $cfg_file the config file path
		* @since 0.1
		*/
		function PraizedViewer($blog_id = null, $cfg_file = null) {
			parent::MT($blog_id, $cfg_file);

			#$this->debugging = true;
			$this->_configs =& PraizedMTConfigs::getInstance($this);

		}
		
		/**
		* We redefine resolv_url to catch non-existant url
		*
		* @param string $path path to find.
		* @return hash Return the template hash
		* @since 0.1
		*/
		function resolve_url($path) {
		   	$data =& parent::resolve_url($path);
		
			$trigger = $this->_configs->getPraizedTrigger();
		
		 	// Catch root template and 
		   if($data == null || $trigger == $path && !preg_match("/\.(\w{2,4})$/", $path) ) {
				/* this is only a mimic, the engine always 
				* load the main url/context.
				* we create a fake fileinfo
				*/ 
				$data =& parent::resolve_url($trigger . "index.html");
			
				$pc  = new PraizedCommunity($data, $path);

				$new_action = $pc->generate();
				
				if($new_action != false) {
					return $new_action;
				} else {
					return null;
				}
		   }
		   return $data;
		}
	}
?>