<?php
/**
 * Plugin configuration screen template, included in PraizedCommunity::wp_options_page()
 *
 * @version 1.0.2
 * @package PraizedCommunity
 * @subpackage ConfigScreen
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>
<div class="wrap">
    <h2><?php $this->_e('Praized Community Options'); ?></h2>
    <form id="praized-community" name="praized-community" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
    	<h3><?php $this->_e('Praized API Connectivity'); ?></h3>
        <p>
            <?php
                printf(
                    $this->__('The following information (Community, API and OAuth details) is provided to you by <a href="%s">Praized Media</a> when you <a href="%s">request access to our API</a>.'),
                    $this->Praized->praizedLinks['corporate'],
                    $this->Praized->praizedLinks['api_request']
                );
            ?>
        </p>
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
    		<tr valign="top">
    			<th scope="row">
    				<label for="oauth_consumer_key"><?php $this->_e('OAuth Consumer Key'); ?></label>
    			</th>
    			<td>
    				<input id="oauth_consumer_key" name="oauth_consumer_key" value="<?php echo $form['oauth_consumer_key']; ?>" size="40" maxlength="512" />
    				<small>[<?php $this->_e('required') ?>]</small>
    			</td>
    		</tr>
    		<tr valign="top">
    			<th scope="row">
    				<label for="oauth_consumer_secret"><?php $this->_e('OAuth Consumer Secret'); ?></label>
    			</th>
    			<td>
    				<input id="oauth_consumer_secret" name="oauth_consumer_secret" value="<?php echo $form['oauth_consumer_secret']; ?>" size="40" maxlength="512" />
    				<small>[<?php $this->_e('required') ?>]</small>
    			</td>
    		</tr>
    	</table>
    	<h3><?php $this->_e('Permalink Structure'); ?></h3>
        <p>
            <?php
                $this->_e('Define where in your WordPress install the Praized Community plugin should be integrated.');
                echo '<br />';
                printf(
                	$this->__('For example, "/praized" or "/local", or use "/" if you want your section at the <a href="%s">root of your Wordpress install</a>.'),
                	$this->_site_url
                );
                echo '<br /><strong>';
                $this->_e('Important: This value must match the information you provided when registering your community with Praized Media.');
                echo '</strong>';
            ?>
        </p>
    	<table class="optiontable form-table">
    		<tr valign="top">
    			<th scope="row">
    				<label for="trigger"><?php $this->_e('URL Trigger'); ?></label>
    			</th>
    			<td>
    				<?php echo $this->_site_url; ?>
    				<input id="trigger" name="trigger" value="<?php echo $form['trigger']; ?>" size="20" maxlength="256" />
    				<small>[<?php $this->_e('required') ?>]</small>
    				<?php
    				if ( ! empty($form['trigger']) && ! empty($this->_config['api_key']) && empty($this->errors) ) {
    				    printf(
        				    $this->__('<p><strong><a href="%s%s">View your Praized community.</a></strong></p>'),
        				    $this->_site_url,
        				    ( ! preg_match('|^/|', $form['trigger']) ) ? '/' . $form['trigger'] : $form['trigger']
        				);
        				printf(
        				    $this->__('<p><strong>Tip</strong>: You can <a href="%s">create a page</a> matching the above URL for your community to appear in your standard WordPress navigation. Simply match the permalink and add the title you want to see in your page navigation list.</p>'),
        				    $this->_site_url . '/wp-admin/wp-admin/page-new.php'
        				);
    				}
    				?>
    			</td>
    		</tr>
    	</table>
    	<h3><?php $this->_e('Google Maps'); ?></h3>
    	<p>
    		<?php
    		    $this->_e('Request your Google Maps API key by clicking on the link below if you would like to display maps alongside your Praized place listings. This integration is optional, but creates a better user experience (and is a simple two-step process). Dimensions and zoom level will be automatically set for you, but you can modify them appropriately for your theme\'s layout.');
    		?>
    	</p>
    	<table class="optiontable form-table">
    		<tr valign="top">
    			<th scope="row">
    				<label for="map_api_key"><a href="http://code.google.com/apis/maps/signup.html" target="_blank"><?php $this->_e('Maps API Key'); ?></a></label>
    			</th>
    			<td>
    				<input id="map_api_key" name="map_api_key" value="<?php echo $form['map_api_key']; ?>" size="40" maxlength="256" />
    			</td>
    		</tr>
    		<tr valign="top">
    			<th scope="row">
    				<label for="map_width">
    				    <a href="http://code.google.com/apis/maps/documentation/staticmaps/" target="_blank"><?php $this->_e('Dimensions'); ?></a>
                    </label>
    			</th>
    			<td>
    				<strong><?php $this->_e('Width:'); ?></strong>
					<input id="map_width" name="map_width" value="<?php echo $form['map_width']; ?>" size="3" maxlength="3" /> px
    				/
    				<strong><?php $this->_e('Height:'); ?></strong>
					<input id="map_height" name="map_height" value="<?php echo $form['map_height']; ?>" size="3" maxlength="3" /> px
    				<?php $this->_e('(Default: 470x200. Maximum: 512x512)'); ?>
    			</td>
    		</tr>
    		<tr valign="top">
    			<th scope="row">
    				<label for="map_zoom_level">
    				    <a href="http://code.google.com/apis/maps/documentation/staticmaps/" target="_blank"><?php $this->_e('Zoom Level'); ?></a>
                    </label>
    			</th>
    			<td>
    				<input id="map_zoom_level" name="map_zoom_level" value="<?php echo $form['map_zoom_level']; ?>" size="2" maxlength="2" />
    				<?php $this->_e('(Default: 15. Definition: 0=far, 19=close)'); ?>
    			</td>
    		</tr>
    	</table>
    	<p class="submit">
    		<input type="submit" id="save_config" name="save_config" value="<?php $this->_e('Save Config'); ?>" />
    	</p>
    </form>
</div>
