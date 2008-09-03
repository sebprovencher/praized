<?php
	/**
	* This class map the praized's templates keys to the MT
	* template hash.
	*
	* This mapping is valid for MT3, MT4 and MT4.1
	* 
	* @version 0.1
	*/
	class PraizedMTTemplateMapper {
		var $_data;

		/**
		* Constructor
		*
		* @param hash $data MT template hash
		* @return 
		* @since 0.1
		*/
		function PraizedMTTemplateMapper($data) {
			$this->_data = $data;
		}
		
		/**
		*
		* Map the real template to the dummy data.
		* 
		* @param hash $new_data Hash with the MT's templates elements
		* @since 0.1
		*/
		function update($new_data) {
			  $new_data["template_build_dynamic"] = "1";
			
			  $this->_data["template"]["template_id"] 				 = $new_data["template_id"];
			  $this->_data["template"]["template_build_dynamic"] 	 = $new_data["template_build_dynamic"];
			  $this->_data["template"]["template_linked_file"] 		 = $new_data["template_linked_file"];
			  $this->_data["template"]["template_linked_file_mtime"] = $new_data["template_linked_file_mtime"];
			  $this->_data["template"]["template_linked_file_size"]  = $new_data["template_linked_file_size"];
			  $this->_data["template"]["template_name"] 			 = $new_data["template_name"];
			  $this->_data["template"]["template_rebuild_me"] 		 = $new_data["template_rebuild_me"];
			  $this->_data["template"]["template_text"] 			 = $new_data["template_text"];
			  $this->_data["fileinfo"]["fileinfo_template_id"]		 = $new_data["template_id"];
	
			
		}
		
		/**
		*
		* @return hash return the template data
		* @since 0.1
		*/
		function &get() {
			return $this->_data;
		}
	}
?>