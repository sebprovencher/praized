<?php
	function smarty_function_mtpraizedmerchantmap($args, &$ctx) {
        
	    if($merchant = $ctx->stash("current_praized_merchant")) {
            $width  = ($args['width'])  ? $args['width']  : '';
            $height = ($args['height']) ? $args['height'] : '';
            $zoom   = ($args['zoom'])   ? $args['zoom']   : '';
	        
            $api =& PraizedMTApi::getInstance();
            $configs = PraizedMTConfigs::getInstance();
            $maps_api_key = $configs->getGoogleMapsApiKey();
                
            if ( ! $maps_api_key )
                return '';
            
			$latitude  = ( isset($merchant->location->latitude) )  ? $merchant->location->latitude  : false;
            $longitude = ( isset($merchant->location->longitude) ) ? $merchant->location->longitude : false;
            
            if ( ! $latitude || ! $longitude ) {
        
                if ( isset($merchant->location->regions->state) )
                    $region_name = $merchant->location->regions->state;
                elseif ( isset($merchant->location->regions->province) )
                    $region_name = $merchant->location->regions->province;
                else 
                    $region_name = '';

                $query = '';
                
                $str = $merchant->location->street_address;
        
                if ( ! preg_match('/^po .*/', strtolower($str)) && ! preg_match('/^p\.o\. .*/', strtolower($str)) ) {
                    $query .= $str . ', ';
                    $query .= ( $str = $merchant->location->city->postal_code ) ? $str . ', ' : '';
                }
                
                $query .= ( $str = $merchant->location->city->name )     ? $str . ', ' : '';
                $query .= ( $str = $region_name )                        ? $str . ', ' : '';
                $query .= ( $str = $merchant->location->country->name )  ? $str        : '';
                
                if ( empty($query) )
                    return '';
                
                $geo = $api->Praized->googleGeoLookup(
                    $maps_api_key,
                    rtrim($query, ', ')
                );
                
                if ( ! is_array($geo) )
                    return '';
                
                $latitude = $geo['latitude'];
                $longitude = $geo['longitude'];
            }
        
            if ( ! $latitude || ! $longitude )
                return '';

        	$raw_params = array();
        	
            $configWidth = $configs->getGoogleMapsWidth();
            if ( ! $width && $configWidth )
        	    $width = intval($configWidth);

        	$configHeight = $configs->getGoogleMapsHeight();
            if ( ! $height && $configHeight )
        	    $height = intval($configHeight);

        	if ( $width && $height )
        	     $raw_params['size'] = $width . 'x' . $height;
        	
            $configZoom = $configs->getGoogleMapsZoomLevel();
            if ( ! $zoom && $configZoom )
        	    $zoom = intval($configZoom);

        	if ( $zoom )
        	     $raw_params['zoom'] = $zoom;
        	    
        	return $api->Praized->googleMap($maps_api_key, $latitude, $longitude, $raw_params, $merchant->name);
        } else {
            return '';
        }
	}
?>