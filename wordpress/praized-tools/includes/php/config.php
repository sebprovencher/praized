<?php
/**
 * Plugin configuration screen template, included in PraizedTools::wp_options_page()
 *
 * @version 1.0.3
 * @package PraizedTools
 * @subpackage ConfigScreen
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>
<div class="wrap">
    <h2><?php $this->_e('Praized Tools Options'); ?></h2>
    <p>
            <?php
                printf(
                    $this->__('The following information (Community, API key) is provided to you by <a href="%s">Praized Media</a> when you <a href="%s">request access to our API</a>.'),
                    $this->Praized->praizedLinks['corporate'],
                    $this->Praized->praizedLinks['api_request']
                );
            ?>
    </p>
    <form id="praized-tools" name="praized-tools" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
    	<h3><?php $this->_e('API Connectivity'); ?></h3>
    	<table class="optiontable form-table">
    		<tr valign="top">
    			<th scope="row">
    				<label for="community"><?php $this->_e('Community Slug'); ?></label>
    			</th>
    			<td>
    				<input id="community" name="community" value="<?php echo $form['community']; ?>" size="40" maxlength="256" />
    				<small>[<?php $this->_e('required') ?>]</small>
    			</td>
    		</tr>
    		<tr valign="top">
    			<th scope="row">
    				<label for="api_key"><?php $this->_e('API Key'); ?></label>
    			</th>
    			<td>
    				<input id="api_key" name="api_key" value="<?php echo $form['api_key']; ?>" size="40" maxlength="256" />
    				<small>[<?php $this->_e('required') ?>]</small>
    			</td>
    		</tr>
    	</table>
<?
    	if ( empty($form['community']) && empty($form['api_key']) ) :	
		    if ( $pc_conf = get_option('praized-community-config') ) :
    		    if ( ! empty($pc_conf['community']) && ! empty($pc_conf['api_key']) ) :
?>
                	<p class="submit">
                		<input type="submit" id="get_pc_config" name="get_pc_config" value="<?php $this->_e('Use Existing Praized Community API Credentials'); ?>" />
                	</p>
<?php
    		    endif;
    		endif;
    	endif;
?>
    	<h3><?php $this->_e('Data Caching'); ?></h3>
    	<table class="optiontable form-table">
<?php
        $caching_checkbox = ($form['caching']) ? 'checked="checked"' : '';
        
        if ( TRUE === ($tmp = $this->_test_caching()) ) :
?>
    		<tr valign="top">
    			<th scope="row">
    				<label for="pta_caching"><?php $this->_e('Enable Caching'); ?></label>
    			</th>
    			<td>
                    <?php echo '<input type="checkbox" id="pta_caching" name="caching" value="1" '.$caching_checkbox.' /> '.$this->__('Yes'); ?>
    			</td>
    		</tr>
    		<tr valign="top" id="cache_ttl_tr">
    			<th scope="row">
    				<label for="pta_cache_ttl"><?php $this->_e('Cache for'); ?></label>
    			</th>
    			<td>
    				<select id="pta_cache_ttl" name="cache_ttl">
                    <?php
                        $cache_ttl_select = array(
                            0     =>       $this->__('No cache'),
                            60    => '1 ' .$this->__('minute'),
                            300   => '5 ' .$this->__('minutes'),
                            900   => '15 '.$this->__('minutes'),
                            1800  => '30 '.$this->__('minutes'),
                            3600  => '1 ' .$this->__('hour'),
                            21600 => '6 ' .$this->__('hours'),
                            43200 => '12 '.$this->__('hours'),
                            86400 => '24 '.$this->__('hours'),
                        ); 
    
                        foreach ($cache_ttl_select as $seconds => $caption) {
                            $selected = ( intval($form['cache_ttl']) == $seconds ) ? 'selected="selected"' : '';
                            echo '<option value="'.$seconds.'" '.$selected.'>'.$caption.'</option>';
                        }
                    ?>
    				</select>
    			</td>
    		</tr>
    	<?php else: ?>
    		<tr valign="top">
    			<th scope="row">
    				<label for="pta_caching"><?php $this->_e('Caching Notice'); ?></label>
    			</th>
    			<td>
                    <?php echo $tmp; ?>
    			</td>
    		</tr>
    	<?php endif; ?>
    	</table>
    	<p class="submit">
    		<input type="submit" id="save_config" name="save_config" value="<?php $this->_e('Save Config'); ?>" />
    	</p>
    </form>
</div>
