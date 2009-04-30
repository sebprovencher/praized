<?php
/**
 * Plugin configuration screen template, included in PraizedCommunity::wp_options_page()
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage ConfigScreen
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>
<div class="wrap">
    <h2><?php $this->_e('Praized Community Options'); ?></h2>
    <form id="praized-community" name="praized-community" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
    	<h3 style="margin:20px auto 0 auto;"><?php $this->_e('API Connectivity'); ?></h3>
        <p style="margin:5px auto 0 auto;">
            <?php $this->_e('The following information (Community, API and OAuth details) is provided to you by <a href="http://praizedmedia.com/">Praized Media</a> when you <a href="http://praizedmedia.com/en/api">request access to our API</a>.'); ?>
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
    	<p class="submit">
    		<input type="submit" name="save_config" class="button-primary" value="<?php $this->_e('Save Config'); ?>" />
    	</p>
    	<h3 style="margin: 0 auto 0 auto;"><?php $this->_e('Permalink Structure'); ?></h3>
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
        				echo '<p>';
    				    $this->_e('Define where in your WordPress install the Praized Community plugin should be integrated.');
                        echo '<br />';
                        printf(
                        	$this->__('For example, "/praized" or "/local", or use "/" if you want your section at the <a href="%s">root of your Wordpress install</a>.'),
                        	$this->_site_url
                        );
                        echo '<br /><strong>';
                        $this->_e('Important: This value must match the information you provided when registering your community with Praized Media.');
                        echo '</strong></p>';
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
    	<p class="submit">
    		<input type="submit" name="save_config" class="button-primary" value="<?php $this->_e('Save Config'); ?>" />
    	</p>
    	<h3 style="margin: 0 auto 0 auto;"><?php $this->_e('Behavior and Interface Customization'); ?></h3>
    	<table class="optiontable form-table">
			<tr valign="top">
    			<th scope="row">
    				<label for="default_view"><?php $this->_e('Default View'); ?></label>
    			</th>
    			<td>
    				<?php
    					if ($form['default_view'] == 'actions') {
    						$default_view_actions   = 'checked="checked"';
    						$default_view_questions = '';
    						$default_view_places    = '';
    					} elseif ($form['default_view'] == 'questions') {
    						$default_view_actions   = '';
    						$default_view_questions = 'checked="checked"';
    						$default_view_places    = '';
    					} else {
    						$default_view_actions   = '';
    						$default_view_questions = '';
    						$default_view_places    = 'checked="checked"';
    					}
    					echo ' <input type="radio" id="pca_default_view" name="default_view" value="actions" '.$default_view_actions.' /> '.$this->__('Activity Stream');
    					echo ' <input type="radio" id="pca_default_view" name="default_view" value="questions" '.$default_view_questions.' /> '.$this->__('Questions &amp; Answers');
    					echo ' <input type="radio" id="pca_default_view" name="default_view" value="places" '.$default_view_places.' /> '.$this->__('Top Places');
    				?>
    			</td>
    		</tr>
    		<tr valign="top">
    			<th scope="row">
    				<label for="dpca_efault_query"><?php $this->_e('Default Search'); ?></label>
    			</th>
    			<td>
    				<?php pzdc_e('Look for'); ?>: <input id="pca_default_query" name="default_query" value="<?php echo $form['default_query']; ?>" size="20" maxlength="256" />
    				<?php pzdc_e('City'); ?>: <input id="dpca_efault_location" name="default_location" value="<?php echo $form['default_location']; ?>" size="20" maxlength="256" />
    			</td>
    		</tr>
    		<tr valign="top">
    			<th scope="row">
    				<label for="pca_overlay_login"><?php $this->_e('Overlay Login'); ?></label>
    			</th>
    			<td>
    				<?php $overlay_login = ($form['overlay_login'])  ? 'checked="checked"' : ''; ?>
                    <input type="checkbox" id="pca_overlay_login" name="overlay_login" value="1" <?php echo $overlay_login; ?> />
					<label for="pca_overlay_login"><?php $this->_e('Use overlay login instead of redirecting the entire page.'); ?></label>
                    <p>
                    <?php
                        $this->_e('
                        	When selected, this option will make the Praized Network login and authorization proceed within
                        	an overlaid iframe instead of redirecting the entire page, for a less intrusive experience.
                        ');
                    ?>
                    </p>
					
    			</td>
    		</tr>
    		<tr valign="top">
    			<th scope="row">
    				<label for="theme"><?php $this->_e('Button Theme'); ?></label>
    			</th>
    			<td>
                    <?php
			    	    if ( ! defined('WPLANG') || WPLANG == '' || ! isset($this->PraizedXHTML->themes[WPLANG]) )
			    	    	$theme_lang = 'en';
			    	    else
			    	    	$theme_lang = WPLANG;
                        $current_theme = ( ! $form['theme'] || ! $this->PraizedXHTML->themes[$theme_lang][$form['theme']] )
                                       ? $this->PraizedXHTML->defaultTheme
                                       : $form['theme'];
                        $current_image = $this->_praized_inc_url . '/PraizedXHTML/css/themes/' . $current_theme . '/button.gif';
                    ?>
    				<script type="text/javascript">
    					function przdThemePreview() {
    						el  = document.getElementById('pca_preview');
    						sel = document.getElementById('pca_theme');
    						el.src = el.src.replace(/themes\/([a-z0-9]{6})/i, 'themes/'+ sel.options[sel.selectedIndex].value);
    					}
    				</script>
    				<span style="display: block; float: left; width: 90px; height: 55px; overflow:hidden;"><img id="pca_preview" src="<?php echo $current_image; ?>" alt="Praized Vote Button Preview" /></span>
    				<select id="pca_theme" name="theme" onchange="przdThemePreview();">
                    <?php
                        foreach ($this->PraizedXHTML->themes[$theme_lang] as $theme => $caption) {
                            $selected = ( $current_theme == $theme ) ? 'selected="selected"' : '';
                            echo '<option value="'.$theme.'" '.$selected.'>'.$caption.'</option>';
                        }
                    ?>
    				</select>
    			</td>
    		</tr>
    	</table>
    	<p class="submit">
    		<input type="submit" name="save_config" class="button-primary" value="<?php $this->_e('Save Config'); ?>" />
    	</p>
    	<h3 style="margin: 0 auto 0 auto;"><?php $this->_e('Google Maps'); ?></h3>
    	<table class="optiontable form-table">
    		<tr valign="top">
    			<th scope="row">
    				<label for="map_api_key"><a href="http://code.google.com/apis/maps/signup.html" target="_blank"><?php $this->_e('Maps API Key'); ?></a></label>
    			</th>
    			<td>
    				<input id="map_api_key" name="map_api_key" value="<?php echo $form['map_api_key']; ?>" size="40" maxlength="256" />
                	<p>
                		<?php
                		    printf(
                		        $this->__('Request your Google Maps API key by <a href="%s" target="_blank">visiting this link</a> if you would like to display maps alongside your Praized place listings. This integration is optional, but creates a better user experience (and is a simple two-step process).'),
                		        'http://code.google.com/apis/maps/signup.html'
                		    );
                		?>
                	</p>
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
    				<?php $this->_e('(Default: 470x200. Maximum: 640x640)'); ?>
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
    		<input type="submit" name="save_config" class="button-primary" value="<?php $this->_e('Save Config'); ?>" />
    	</p>
    </form>
</div>
