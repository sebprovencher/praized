<?php
/**
 * Plugin configuration screen template, included in PraizedTools::wp_options_page()
 *
 * @version 1.5
 * @package PraizedTools
 * @subpackage ConfigScreen
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

/*
 * Note: Testing class_exists('PraizedCommunity') because the wp options
 * are still available and valid if the plugin has since been deactivated,
 * which can get confusing or create issues.
 */ 
if ( ! class_exists('PraizedCommunity') || ! ( $pc_conf = get_option('praized-community-config') ) )
    unset($pc_conf);

if ( isset($pc_conf) && ! empty($pc_conf['theme']) && $this->PraizedXHTML->themes[$pc_conf['theme']] )
    $current_theme = $pc_conf['theme'];
elseif ( ! empty($form['theme']) && $this->PraizedXHTML->themes[$form['theme']] )
    $current_theme = $form['theme'];
else
    $current_theme = $this->PraizedXHTML->defaultTheme;

$current_image = $this->_praized_inc_url . '/PraizedXHTML/css/themes/' . $current_theme . '/button.gif';
?>
<div class="wrap">
    <h2><?php $this->_e('Praized Tools Options'); ?></h2>
    <form id="praized-tools" name="praized-tools" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
    	<h3 style="margin:20px auto 0 auto;"><?php $this->_e('API Connectivity'); ?></h3>
        <p style="margin:5px auto 0 auto;">
        <?php
            printf(
                $this->__('The following information (Community, API key) is provided to you by <a href="%s">Praized Media</a> when you <a href="%s">request access to our API</a>.'),
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
    	</table>
    	<p class="submit">
    		<input type="submit" name="save_config" class="button-primary" value="<?php $this->_e('Save Config'); ?>" />
    		<? if ( isset($pc_conf) && ! empty($pc_conf['community']) && ! empty($pc_conf['api_key']) ) : ?>
    			<input type="submit" id="get_pc_config" name="get_pc_config" class="button-primary" value="<?php $this->_e('Use Praized Community API credentials'); ?>" />
    		<?php endif; ?>
    	</p>
    	<h3 style="margin: 0 auto 0 auto;"><?php $this->_e('Behavior and Interface Customization'); ?></h3>
    	<table class="optiontable form-table">
    		<?php
    		    $aggregate   = ($form['aggregate'])  ? 'checked="checked"' : '';
    		    $hide_vote   = ($form['hide_vote'])  ? 'checked="checked"' : '';
    		    $hide_tags   = ($form['hide_tags'])  ? 'checked="checked"' : '';
    		    $hide_stats  = ($form['hide_stats']) ? 'checked="checked"' : '';
    		?>
    		<tr valign="top">
    			<th scope="row">
    				<label for="aggregate"><?php $this->_e('Place Aggregation'); ?></label>
    			</th>
    			<td>
                    <script type="text/javascript">
                    	function przdAggregateChex() {
                    		if ( ! document.getElementById('pta_aggregate').checked ) {
                    			document.getElementById('pta_hide_vote').checked = false;
                    			document.getElementById('pta_hide_tags').checked = false;
                    			document.getElementById('pta_hide_stats').checked = false;
                    		}
                    	}
                    </script>
                    <input type="checkbox" id="pta_aggregate" name="aggregate" value="1" <?php echo $aggregate; ?> onchange="przdAggregateChex();" />
					<?php $this->_e('Show details for the places mentioned in posts/pages'); ?>
					<br />
                    <input type="checkbox" id="pta_hide_vote" name="hide_vote" value="1" <?php echo $hide_vote; ?> />
					<?php $this->_e('Hide vote button'); ?>
					<br />
                    <input type="checkbox" id="pta_hide_tags" name="hide_tags" value="1" <?php echo $hide_tags; ?> />
					<?php $this->_e('Hide place tags'); ?>
					<br />
                    <input type="checkbox" id="pta_hide_stats" name="hide_stats" value="1" <?php echo $hide_stats; ?> />
					<?php $this->_e('Hide place statistics'); ?>
                    <p>
                    <?php
                        $this->_e('
                        	When selected, this option will aggregate all of the places embedded in blog posts or pages
                        	using the Praized Tools, then list and <a href="http://microformats.net/">microformat</a>
                        	the locations\' details at the end of the content body (only when viewing individual posts/pages).
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
    				<? if ( ! isset($pc_conf) ) : ?>
        				<script type="text/javascript">
        					function przdThemePreview() {
        						el  = document.getElementById('pca_preview');
        						sel = document.getElementById('pca_theme');
        						el.src = el.src.replace(/themes\/([a-z0-9]{6})/i, 'themes/'+ sel.options[sel.selectedIndex].value);
        					}
        				</script>
        			<?php endif; ?>
    				<span style="display: block; float: left; width: 90px; height: 55px; overflow:hidden;"><img id="pca_preview" src="<?php echo $current_image; ?>" alt="Praized Vote Button Preview" /></span>
    				<? if ( isset($pc_conf) ) : ?>
            			<strong style="margin-left: 5px;">
            			<?php
            			    printf(
            			        $this->__('Currently using the <a href="%s">Praized Community</a> settings'),
            			        $this->_admin_url . '/options-general.php?page=praized-community/praized-community.php'
            			    );
            			?>
            			</strong>
            		<?php else : ?>
        				<select id="pca_theme" name="theme" onchange="przdThemePreview();">
                        <?php
                            foreach ($this->PraizedXHTML->themes as $theme => $caption) {
                                $selected = ( $current_theme == $theme ) ? 'selected="selected"' : '';
                                echo '<option value="'.$theme.'" '.$selected.'>'.$caption.'</option>';
                            }
                        ?>
        				</select>
        			<?php endif; ?>
    			</td>
    		</tr>
    	</table>
    	<p class="submit">
    		<input type="submit" name="save_config" class="button-primary" value="<?php $this->_e('Save Config'); ?>" />
    	</p>
    	<h3 style="margin: 0 auto 0 auto;"><?php $this->_e('Data Caching'); ?></h3>
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
    	<?php
    	    else:
    	?>
        		<tr valign="top">
        			<th scope="row">
        				<label for="pta_caching"><?php $this->_e('Caching Notice'); ?></label>
        			</th>
        			<td>
                        <?php echo $tmp; ?>
        			</td>
        		</tr>
    	<?php
    	    endif;
    	?>
    	</table>
    	<p class="submit">
    		<input type="submit" name="save_config" class="button-primary" value="<?php $this->_e('Save Config'); ?>" />
    	</p>
    </form>
</div>
