<?php
/**
 * Praized Convenience Parsing Tools
 *
 * @version 2.0
 * @package Praized
 * @subpackage Parser
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

if ( ! class_exists('PraizedParser') ) {
    /**
     * Praized Convenience Parsing Tools: Class
     * 
     * @package Praized
	 * @subpackage Parser
     * @since 0.1
     */
    class PraizedParser {
        /**
         * Scans and parses out the [praized ... ] bbcodes/markdown and returns a standard PHP object
         *
         * @param string $content Content to be parse for Praized bbcode/markdown
         * @param boolean $returnAsObject Defines if the data should be returned as an object or a keyed array (hash).
         * @return mixed Boolean false or array 
         * @since 0.1
         */
        function bbFind($content, $returnAsObject = true) {
            $returns = array();
            $quotes = array(
                '&#8221;',
                '&#8243;',
                '&#34;',
                '&quot;',
                '”',
                '″'
            );
            
            preg_match_all('/\[praized[^\]]*?\]/i', $content, $matches);
            
            if ( isset($matches[0]) && is_array($matches[0]) && count($matches) > 0 ) {
                foreach ($matches[0] as $theMatch) {
                    $cleanMatch = str_replace($quotes, '"', $theMatch);
                    if ($tmp = PraizedParser::bbParse($cleanMatch, $returnAsObject))
                        $returns[$theMatch] = $tmp;
                }
            }
            
            if ( count($returns) < 1 ) 
	            $returns = false;
            
            return $returns;
        }
        
        /**
         * Parses an individual [praized ...] bbcode/markdown
         *
         * @param string $bbCode
         * @param boolean $returnAsObject Defines if the data should be returned as an object or a keyed array (hash).
         * @return mixed Boolean or Object, based on $returnAsObject
         */
        function bbParse($bbCode, $returnAsObject = true) {
            $bbCode = str_replace(array("\n", "\r"), ' ', $bbCode);
            
            if ( $returnAsObject !== true ) $returnAsObject = false;
                            
            if ( preg_match('/^\[praized/i', $bbCode) ) {
                preg_match_all('/(\S+)="([^"]+)"/', $bbCode, $matches);
                
                if ( isset($matches[1]) && is_array($matches[1]) && count($matches) > 0 ) {
                    $attributes = ( $returnAsObject ) ? new stdClass() : array();
                    
                    foreach ($matches[1] as $index => $key) {
                        $value = $matches[2][$index];
                        if ( $returnAsObject )
                            $attributes->$key = $value;
                        else    
                            $attributes[$key] = $value;
                    }
                    
                    return $attributes;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
		/**
         * Scans the content for URLs, parses the ones that look like Praized targets then returns
         * a standard PHP array compatible with PraizedMerchants::resolve() 
         *
         * @param string $content Content to be parse for Praized URLs
         * @return mixed Boolean false or array 
         * @since 1.6
         */
        function urlFind($content) {
            $returns = array(
            	'pids'        => array(),
            	'permalinks'  => array(),
            	'short_urls' => array()
            );
            
            preg_match_all('/https?:[^"\'\?<\s]+/i', $content, $matches);
            
            if ( isset($matches[0]) && is_array($matches[0]) && count($matches) > 0 ) {
                foreach ($matches[0] as $theMatch) {
                    if ( preg_match('/^http.{3,7}przd.com\/([a-z0-9]+-[a-z0-9]+)$/i', $theMatch, $match) && isset($match[1]) )
                        $returns['short_urls'][] = $match[1];
                    elseif ( preg_match('/^http.+\/(places|merchants)\/([a-z0-9]{32,34})/i', $theMatch, $match) && isset($match[2]) )
                        $returns['pids'][] = $match[2];
                    elseif ( preg_match('/^http.+\/places\/([a-z0-9\/-]+)/i', $theMatch, $match) && isset($match[1]) )
                        $returns['permalinks'][] = $match[1];
                }
            }
            
            if ( count($returns['pids']) < 1 && count($returns['permalinks']) < 1 && count($returns['short_urls']) < 1 ) 
	            $returns = false;
            
            return $returns;
        }
    }
}
?>