<?php
/**
 * Praized Convenience Parsing Tools
 *
 * @version 1.5
 * @package Praized
 * @subpackage Parser
 * @author Stephane Daury
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
         * @return mixed Boolean or Object, based on $returnAsObject
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
    }
    
    /**
     * Convenience container used by PraizedParser
     *
     * @version 1.0
     * @package PraizedParser
     * @package Praized
     * @author Stephane Daury
     * @copyright Praized Media, Inc. <http://praizedmedia.com/>
     * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
     * @deprecated 1.5
     */
    class PraizedParserContainer {
        /**
         * Constructor: set class variables based on sent bbcode/markdown attributes
         *
         * @param unknown_type $attributes
         * @return PraizedParserContainer
         */
        function PraizedParserContainer($attributes) {
            foreach ($attributes as $key => $value) {
                $this->$key = $value;
            }
        }
    }
}
?>