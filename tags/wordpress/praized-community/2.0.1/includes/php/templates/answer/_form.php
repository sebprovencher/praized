<?php
/**
 * Praized template fragment: Answer form
 *
 * @version 2.0
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury for Praized Media, Inc.
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */

$form_id     = 'praized-answer-form';
$choice_id   = $form_id . '-choice';
$lookup_id   = $form_id . '-lookup';
$results_id  = $form_id . '-results';
$comment_id  = $form_id . '-comment';
$submit_id   = $form_id . '-submit';
$post_button_id = $submit_id . '-button';
?>
<script type="text/javascript">
	function interfaceSwitcher(type) {
		var lookupDiv  = document.getElementById('<?php echo $lookup_id; ?>');
		var commentDiv = document.getElementById('<?php echo $comment_id; ?>');
		var submitDiv  = document.getElementById('<?php echo $submit_id; ?>');
		var postButton = document.getElementById('<?php echo $post_button_id; ?>');
		var searchletPostButton = document.getElementById('praized-searchlet-submit-button');
		if ( ! type || type != 'suggest' )
			type = 'comment';
		if ( type == 'suggest' ) {
			lookupDiv.style.display  = 'block';
			postButton.style.display  = 'none';
			searchletPostButton.style.display  = 'block';			
			document.getElementById('praized-what').focus();
		} else {
			lookupDiv.style.display  = 'none';
			postButton.style.display  = 'block';	
			searchletPostButton.style.display  = 'none';
			document.getElementById('<?php echo $comment_id; ?>').style.display='block';											
			document.getElementById('<?php echo $comment_id; ?>-content').focus();
		}
		commentDiv.style.display = 'block';
		submitDiv.style.display  = 'block';
	}
</script>
<form id="<?php echo $form_id; ?>" action="<?php pzdc_question_permalink(); ?>/answers/" style="display:none" method="post">
	<fieldset id="<?php echo $choice_id; ?>" style="text-align:center;padding:10px;">
		<a href="javascript:interfaceSwitcher('suggest');void(0);" class="praized-action" style="padding: 5px 25px 5px 25px;"><?php pzdc_e('I want to suggest a place') ?></a>
		<span style="margin:0 10px 0 10px;"><?php pzdc_e('OR'); ?></span>
		<a href="javascript:interfaceSwitcher('comment');void(0);" class="praized-action" style="padding:5px 25px 5px 25px;"><?php pzdc_e('Give me a blank box') ?></a>
	</fieldset>

	<fieldset id="<?php echo $lookup_id; ?>" style="border-top:0;margin-top:0; display:none;text-align:center;padding:10px;">
	      <div id="praized-searchlet-interface-container">
          <div id="searchlet-head"></div>
          <p id="praized-answers-results-picks-labels"><b>search results</b><b>your picks</b></p>
          <div id="searchlet-results"></div>
          <div id="searchlet-user-picks"></div>
          <div id="searchlet-pagination"></div>
          <div id="searchlet-buttons"></div>
        </div>
        <?php pzdc_place_picker_script(); /* see ../../functions/helpers.php */ ?>
        <script type="text/javascript" charset="utf-8">
        Praized.Searchlet.init({
            formContainerSelector: '#searchlet-head',
            resultsContainerSelector: '#searchlet-results',
            userPicksContainerSelector: '#searchlet-user-picks',
            buttonContainerSelector: '#<?php echo $submit_id; ?>',
            paginationContainerSelector: '#searchlet-pagination',
            searchTerm: "<?php pzdc_search_query(); ?>",
            searchCity: "<?php pzdc_search_location(); ?>",
            buttonText: 'Post Answer',
            onInitialize: function(){
              document.getElementById('<?php echo $form_id; ?>').style.display = 'block';
            },
            callback: function(merchants){
              var pids = [];
              for(i=0;i<merchants.length;i++) pids.push(merchants[i].pid);
              var pidsInput = Praized.DOMTools.newElement('input',{type:'hidden',name:'pids',value: pids.join(',')});
              var form = document.getElementById('<?php echo $form_id; ?>');
              form.appendChild(pidsInput);
              if ( window.PraizedLightBox )
            	  window.PraizedLightBox.show();
              form.submit();
            }
        })
        </script>
        
	</fieldset>
	<fieldset id="<?php echo $comment_id; ?>" style="border-top:0;margin-top:0; display:none;">
	  <label><?php pzdc_e('Answer'); ?></label>
		<textarea name="content" id="<?php echo $comment_id; ?>-content" rows="2" cols="55" style="width:99%"></textarea>
	</fieldset>
	<fieldset id="<?php echo $submit_id; ?>" style="text-align:right;padding:4px;border-top:0;margin-top:0;display:none;">
		<button id="<?php echo $post_button_id; ?>" type="submit"><?php pzdc_e('Post answer'); ?></button>
	</fieldset>
</form>

