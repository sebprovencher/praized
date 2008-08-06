<?php
/**
 * Praized Common XHTML output
 *
 * @version 1.0.3
 * @package Praized
 * @subpackage XHTML
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedXHTML') ) {
    /**
     * Praized Common XHTML output: Class
     * 
     * @package Praized
	 * @subpackage XHTML
     * @since 0.1
     */
    class PraizedXHTML {
    
        var $_pzdxCommunity;
        var $_pzdxMerchants;
        var $_pzdxMerchant;
        var $_pzdxConfig;
    
		/**
		* Constructor: Just so we can use $this
		* 
		* @since 0.1
		*/
		function PraizedXHTML() { }

    	/**
    	 * Sets up the private holding variable, as appropriate, based on the sent API data
    	 *
    	 * @param object $data Data object as returned by the Praized PHP lib
    	 * @param array $config Display configuration (show address, etc)
    	 * @return boolean Success status
    	 * @since 0.1
    	 */
        function _env($data, $config = array()) {
            $this->_pzdxCommunity = ( isset($data->community) && is_object($data->community) ) ? $data->community : FALSE;
    	    if ( ! $this->_pzdxCommunity )
    	        return false;
    	    $this->_pzdxMerchants = ( isset($data->merchants) && is_array($data->merchants) )  ? $data->merchants : FALSE;
    	    $this->_pzdxMerchant  = ( isset($data->merchant)  && is_object($data->merchant) )  ? $data->merchant  : FALSE;
    	    if ( ! $this->_pzdxMerchants && ! $this->_pzdxMerchant )
    	        return false;
    	    $this->_pzdxConfig = $config;
    	    return true;
    	}
        
        /**
    	 * Includes the requested template
    	 *
    	 * @param string $template
    	 * @example merchants for PraizedXHTML/merchants.php
    	 * @since 0.1
    	 */
        function _template($template){
    	    $xhtml = '';
            if ( ! empty($template) && $template != '_' ) {
        	    $file = dirname(realpath(__FILE__)) . '/PraizedXHTML/' .  $template . '.php';
        	    if ( file_exists($file) )
        	        require($file);
    	    }
    	    return $xhtml;
    	}
    	
        /**
         * Includes the requested template fragment (files starting with _ in PraizedXHTML dir)
         *
         * @param string $fragment 
         * @example my_fragment for PraizedXHTML/_my_fragment.php or subdir/my_fragment for PraizedXHTML/subdir/_my_fragment.php
         * @since 0.1
         */
    	function _fragment($fragment) {
            if ( strstr($fragment, '/') )
                $template = preg_replace('|(.*)/([^/]*)$|', '\1/_\2', $fragment);
            else 
                $template = '_' . $fragment;
            return $this->_template($template);
    	}
    	
    	/**
    	 * Merchant permalink helper
    	 *
    	 * @param object $merchant
    	 * @return string Fully qualifed URL to destination community
    	 * @since 0.1
    	 */
    	function _permalink($merchant) {
    	    if ( ! $merchant->pid )
    	        return; // no such thing as a merchant w/o a pid
    	    $link = ( preg_match('|://|', $merchant->permalink) )
    	          ? $merchant->permalink
    	          : $this->_pzdxCommunity->base_url . '/places/' . $merchant->pid;
    	    return preg_replace('|([^:]{1})//|', '\1/', $link);
    	}
	
    	/**
    	 * Returns XHTML as string for the sent data and requested template/fragment.
    	 *
    	 * @param object $data Data object as returned by the Praized PHP lib
    	 * @param string $template merchants for PraizedXHTML/merchants.php
    	 * @param array $config Display configuration (show address, etc)
    	 * @return string
    	 * @since 0.1
    	 */
    	function xhtml($data, $template, $config = array()) {
			if ( ! $this->_env($data, $config) )
    	        return;
    	    return $this->_template($template);
    	}
    }
}
?>