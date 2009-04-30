<?php
/**
 * Praized Logger
 * 
 * Simple logging tool to ease debugging in contexts such as the Novable Type Smarty templates, etc.
 *
 * @version 2.0
 * @package Praized
 * @subpackage Logger
 * @author Pier-Hugures Pellerin
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedLogger') ) {
    define(PRAIZED_LOGGER_ERROR, 1);
    define(PRAIZED_LOGGER_WARN, 2);
    define(PRAIZED_LOGGER_DEBUG, 3);
    define(PRAIZED_LOGGER_INFO, 4);

    /**
     * Praized Logger: Class
     * 
     * @package Praized
	 * @subpackage Logger
     * @since 0.1
     */
    class PraizedLogger {
    	/**
    	 * Error container
    	 * @var array
    	 * @since 0.1
    	 */
        var $errors = array();
    	
    	/**
    	 * Constructor
    	 *
    	 * @return PraizedLogger
    	 * @since 0.1
    	 */
        function PraizedLogger() {
    	    $this->errors[PRAIZED_LOGGER_INFO]  = array();
    	    $this->errors[PRAIZED_LOGGER_WARN]  = array();
    	    $this->errors[PRAIZED_LOGGER_ERROR] = array();
    	    $this->errors[PRAIZED_LOGGER_DEBUG] = array();	
    	}
    	
    	/**
    	 * Warnings assignment
    	 *
    	 * @param string $message
    	 * @since 0.1
    	 */
    	function warn($message) {
    		PraizedLogger::log(PRAIZED_LOGGER_WARN, $message);
    	}
    	
    	/**
    	 * Informative messages assignment
    	 *
    	 * @param string $message
    	 * @since 0.1
    	 */
    	function info($message) {
    		PraizedLogger::log(PRAIZED_LOGGER_INFO, $message);
    	}
    	
    	/**
    	 * Errors assignment
    	 *
    	 * @param string $message
    	 * @since 0.1
    	 */
    	function error($message) {
    		PraizedLogger::log(PRAIZED_LOGGER_ERROR, $message);
    	}
    	
    	/**
    	 * Debugging messages assignment
    	 *
    	 * @param string $message
    	 * @since 0.1
    	 */
    	function debug($message) {
    		PraizedLogger::log(PRAIZED_LOGGER_ERROR, $message);		
    	}
    	
    	/**
    	 * Convenience method for message assignment
    	 *
    	 * @param integer $type Message type code
    	 * @param string $message
    	 * @since 0.1
    	 */
    	function log($type, $message) {
    		$instance =& PraizedLogger::getInstance();
    		array_push($instance->errors[$type], $message);
    	}
    	
    	/**
    	 * Message output method
    	 *
    	 * @param integer $type Message type code
    	 * @return array
    	 * @since 0.1
    	 */
    	function output($type = null) {
    		$instance =& PraizedLogger::getInstance();
    		
    		if(is_null($type))
    			return $instance->errors;
    		else
    			return $instance->errors[$type];
    	}
    	
    	/**
    	 * Dump to file: to be redefined as appropriate in extending classes
    	 *
    	 * @param mixed $file As defined in method redefinition (eg: path as string, file pointer as object)
    	 * @since 0.1
    	 */
    	function dump($file) {}
    	
    	/**
    	 * Convenience instantiator
    	 *
    	 * @return object INstance of self
    	 * @since 0.1
    	 */
    	function &getInstance() {
    		static $current_instance;
    		
    		if(!$current_instance) {
    			$current_instance = array(new PraizedLogger());
    		}
    		return $current_instance[0];
    	}
    }
}


?>