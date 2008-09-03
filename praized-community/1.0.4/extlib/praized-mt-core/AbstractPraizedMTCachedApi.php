<?php
	/**
	* AbstractPraizedMTCachedApi 
	* 
	* Define a common interface for developing cached hash.
	*/
	class AbstractPraizedMTCachedApi {
		function AbstractPraizedMTCachedApi() {}
		
		/**
		* Get the cached data for the current key
		*
		* @param string $key Unique identifier
		* @return mixed Return the unserialized data.
		* @since 0.1
		*/
		function get($key) {}
		
		/**
		* Save the current data with a unique key,
		* you can speici
		*
		* @param string $key The unique identifier
		* @param mixed $value Value to cache
		* @since 0.1
		*/
		function set($key, $value, $expiration = null) {}
		
		
		/**
		* We have data for the current unique key?
		*
		* @param string $key The unique identifier
		* @return boolean true if we have data set for this key
		* @since 0.1
		*/
		function isCached($key) {}
	}
?>