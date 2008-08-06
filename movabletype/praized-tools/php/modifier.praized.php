<?php
/**
 * Praized Tools Content Modifier
 * 
 * @version 1.0.3
 * @package PraizedTools
 * @author Pier-Hughes Pellerin
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 * 
 * Copyright 2008 Praized Media, Inc. Licensed under the Apache
 * License, Version 2.0 (the "License"); you may not use this file except
 * in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0 Unless required by applicable
 * law or agreed to in writing, software distributed under the License is
 * distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied. See the License for the specific
 * language governing permissions and limitations under the License.
 */

include_once dirname(realpath(__FILE__)) . "/../extlib/praized-php/Praized.php";
include_once dirname(realpath(__FILE__)) . "/../extlib/praized-php/PraizedParser.php";
include_once dirname(realpath(__FILE__)) . "/../extlib/praized-php/PraizedXHTML.php";

/**
 * Handles the conversion from praized bbcode to xhtml on page view
 *
 * @param string $content Post content
 * @param integer $value Pass 1 to activate
 * @return string
 * @since 0.1
 */
function smarty_modifier_praized($content, $value) {
	if(intval($value) == 1) {
	  	global $mt;
		$db = $mt->db();
		$blog_id = $mt->blog_id;
		
		$results = $db->fetch_plugin_config("Praized Tools", "blog:" . $blog_id);
		
		$community_slug = $results["praized_community_slug"];
		$api_key 		= $results["praized_api_key"];
		
		$api = new Praized($community_slug, $api_key);
		
		$request_objects = PraizedParser::bbFind($content);

		if(sizeof($request_objects) > 0) {
			foreach($request_objects as $original => $specs) {
				$replacement = "";
				$type    = ( isset($specs->type) )     ? $specs->type : 'list';
		        $dynamic = ( isset($specs->dynamic) )  ? $specs->dynamic : 'true';

		        $dynamic = ( 'true' == strtolower($dynamic) ) ? TRUE : FALSE;
				$dynamic = true;
				

				$config = array();
	            						
				 switch ($type) {
		                case 'badge':
		                    if ( ! isset($specs->pid) || empty($specs->pid) )
		                        break;
		                    $config['subtype'] = ( isset($specs->subtype) ) ? $specs->subtype : 'big';
		                    $config['name']    = ( isset($specs->name) )    ? $specs->name    : 'false';
		                    $config['address'] = ( isset($specs->address) ) ? $specs->address : 'false';
		                    $config['phone']   = ( isset($specs->phone) )   ? $specs->phone   : 'false';
		            	   
		            	    $data = $api->merchant()->get($specs->pid);
							if(FALSE == $data)
								break;

		            }

		            if ( isset($data) && ( is_object($data) || is_array($data) ) ) {
		                $xObj = new PraizedXHTML();
		                $replacement = ( $xhtml = $xObj->xhtml($data, $type, $config) ) ? $xhtml : '';
		            }

		            $content = str_replace($original, $replacement, $content);
			}
		}				
		return $content;
	}
}
?>
