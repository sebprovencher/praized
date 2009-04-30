<?php
/**
 * Praized template functions/helpers/tags: resultset pagination related functions
 * 
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage TemplateFunctions
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
    	
/**
 * Template function: Current pagination object
 * 
 * <code><?php $pagination_object = pzdc_pagination(); ?></code>
 *
 * @return mixed Boolean FALSE or Object instance
 * @since 0.1
 */
function pzdc_pagination() {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_pagination;
}

/**
 * Template function: Current pagination xhtml (defaults to echo)
 * 
 * <code><?php pzdc_paginate( array('per_page' => 5) ); ?></code>
 *
 * @param boolean $echo Defines if the output should be echoed or simpy returned, defaults to TRUE
 * @return string
 * @since 0.1
 */
function pzdc_paginate($echo = TRUE) {
    global $PraizedCommunity;
    return $PraizedCommunity->tpt_paginate(NULL, $echo);
}
?>