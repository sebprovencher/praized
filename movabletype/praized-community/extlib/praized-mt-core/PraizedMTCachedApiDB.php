<?php
	/**
	* Small cache api for the praized api calls.
	* 
	* @version 0.1
	*/
	class PraizedMTCachedApiDB extends AbstractPraizedMTCachedApi {
		static $current_instance;
		
		var $_cache_disabled = true;
		var $_db;
		var $_blog_id;
		var $_local_cache = array();
		
		/**
		* PraizedMTCachedApiDB();
		*
		* Constructor
		*
		* @since 0.1
		*/
		function PraizedMTCachedApiDB() {
			global $mt;
			$this->_db =& $mt->db();
			$this->_blog_id = $mt->blog_id;
		}
		
		/**
		* set();
		*
		* Save the object in the local cache and in the database
		*
		* @param string $key The key to save, it must be unique.
		* @param string $value the value to cache
		* @param unixtime $expiration cache expiration for this object
		* @since 0.1
		*/
		function set($key, $value, $expiration = null) {			
			$expiration = ( ! is_null($expiration) ) ? time() + $expiration : null;		
			
	
				
			$this->_delete($key);
			$this->_local_cache[$key] = array(
				"value" => $value,
				"expiration" => $expiration
			);
			
			$value = base64_encode(serialize($value));
			$sql = "INSERT INTO mt_praized_cache (praized_cache_key, 
									praized_cache_value, 
									praized_cache_expiration) 
						   			VALUES ('" . $key . "', ' " . $value . "',
									'" . $expiration . "')";

			if(! $this->_cache_disabled) $result = $this->_db->query($sql);
			return $result;
		}
		
		/**
		* get();
		*
		* First we look at the local cache, calculate if
		* the record is not expired.
		* 
		* if the record is not in the local cache we check in the
		* database.
		*
		* @param string $key The key to fetch the object
		* @return mixed $key return the unserialized object or the string.
		* @since 0.1
		*/
		function get($key) {
			if(array_key_exists($key, $this->_local_cache)) {
				if($this->_local_cached[$key]["expiration"] < time())
					return $this->_local_cached[$key]["value"];
			} else {
				$sql = "SELECT praized_cache_value FROM mt_praized_cache 
							WHERE praized_cache_key='" . $key
							  . "' AND praized_cache_expiration > " . time() . " OR praized_cache_expiration = NULL";
							
				$result = $this->_db->get_results($sql);
					
				if(!$result) {
					return null;
				} else {
					$unserialized = unserialize(base64_decode($result[0]["praized_cache_value"]));
					$this->_local_cache[$key] = $unserialized;
					return $unserialized;
				}
			}
			return null;
		}
		
		/**
		* _delete($key);
		*
		* Delete the current key in the database and do a cleanup
		* base on expiration.
		*
		* @param string $key the unique key to the object.
		* @return boolean true or false
		* @since 0.1
		*/
		function _delete($key) {
			unset($this->_local_cache[$key]);
			$sql = "DELETE FROM mt_praized_cache WHERE praized_cache_key ='" 
				   . $key . "' OR (praized_cache_expiration < NOW() AND
				   praized_cache_expiration != NULL)";
				
			return $this->_db->query($sql);
		}

		/**
		* getInstance();
		* This is a Singleton class.
		* Return the current instance or initialize it.
		* @return PraizedMTCachedApiDB
		* @since 0.1
		*/
		function getInstance() {
			if(!isset($current_instance)) {
				$object = __CLASS__;
				$current_instance =& new $object;
			}
			return $current_instance;
		}
	}
?>