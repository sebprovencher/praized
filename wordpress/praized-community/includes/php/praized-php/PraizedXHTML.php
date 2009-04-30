<?php
/**
 * Praized Common XHTML output
 *
 * @version 2.0
 * @package Praized
 * @subpackage XHTML
 * @author Stephane Daury for Praized Media, Inc.
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
    
        /**
         * Current community data holder
         * @var object
         * @since 0.1
         */
    	var $_pzdxCommunity;
        
    	/**
         * Current merchant list data holder
         * @var object
         * @since 0.1
         */
    	var $_pzdxMerchants;
        
    	/**
         * Current merchant data holder
         * @var object
         * @since 0.1
         */
    	var $_pzdxMerchant;
        
    	/**
         * Current xhtml config holder
         * @var array
         * @since 0.1
         */
    	var $_pzdxConfig;
    
        /**
         * Themes
         * @var array
         * @since 1.5
         */
    	var $themes = array(
    		'en' => array(
	    		'009900' => 'Green',
	    		'cc0000' => 'Red',
	    		'660000' => 'Wine',
	    		'ff6633' => 'Orange',
	    		'ff9900' => 'Burnt Orange',
	    		'ffcc00' => 'Yellow',
	    		'666633' => 'Tan Olive',
	    		'0066ff' => 'Light Blue',
	    		'0000cc' => 'Blue',
	    		'336666' => 'Ocean',
	    		'330066' => 'Purple',
	    		'cc33cc' => 'Magenta',
	    		'ff00cc' => 'Pink',
	    		'000000' => 'Black',
	    		'666666' => 'Grey',
	    		'ffffff' => 'White'
    		),
    		'fr_FR' => array(
	    		'009900' => 'Vert',
	    		'cc0000' => 'Rouge',
	    		'660000' => 'Rouge Vin',
	    		'ff6633' => 'Orange',
	    		'ff9900' => 'Orange Brûlée',
	    		'ffcc00' => 'Jaune',
	    		'666633' => 'Vert Olive',
	    		'0066ff' => 'Bleu Clair',
	    		'0000cc' => 'Bleu',
	    		'336666' => 'Océan',
	    		'330066' => 'Violet',
	    		'cc33cc' => 'Magenta',
	    		'ff00cc' => 'Rose',
	    		'000000' => 'Noir',
	    		'666666' => 'Gris',
	    		'ffffff' => 'Blanc'
    		)
        );
        
        /**
         * Default theme
         * @var string
         * @since 1.5
         */
    	var $defaultTheme = '009900';
    
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
    	 * @param string $template Selected template (see ./PraizedXHTML/* and PraizedXHTML::_template())
    	 * @param array $config Display configuration (show address, etc)
    	 * @return string
    	 * @since 0.1
    	 */
    	function xhtml($data, $template, $config = array()) {
			if ( ! $this->_env($data, $config) )
    	        return;
    	    return $this->_template($template);
    	}
    	
    	/**
    	 * Returns the proper <link rel="stylesheet" /> tags to support the XHTML provided by the present library
    	 *
    	 * @param string $path Web accessible path to the praized-php library
    	 * @param string $theme Selected theme, as found in PraizedXHTML::themes
    	 * @param array $version Optional version info (avoids extra persistant css caching by the browsers when upgrading to a new version of the lib)
    	 * @return string
    	 * @since 1.5
    	 */
    	function css($path, $theme, $version = null) {
    	    $path = rtrim($path, '/');
    	    
    	    if ( empty($theme) || ! isset($this->themes['en'][$theme]) )
    	         $theme = $this->defaultTheme;
    	    
    	    if ( empty($version) )
    	        $version = time(); 
    	    
    	    $styles = sprintf(
    	        '<link rel="stylesheet" id="praized-xhtml-css-theme" href="%s/PraizedXHTML/css/themes/%s/styles.css?v=%s" type="text/css" media="screen" />' . "\n",
    	        $path,
    	        $theme,
    	        $version
    	    );
    	    
    	    $styles .= sprintf(
    	        '<link rel="stylesheet" id="praized-xhtml-css" href="%s/PraizedXHTML/css/styles.css?v=%s" type="text/css" media="screen" />' . "\n",
    	        $path,
    	        $version
    	    );
    	    
    	    return $styles;
    	}
    }
}
?>