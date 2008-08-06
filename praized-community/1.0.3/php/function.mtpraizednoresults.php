<?php
	function smarty_function_mtpraizednoresults($args, &$ctx) {
		if ( isset($_GET['q']) || isset($_GET['l']) || isset($_GET['t']) || isset($_GET['tag']) ) {
	        $out = '<p>No places matched your query.</p>';
		} else {
		    $out = '<p>No places have been <em>praized</em> in this community yet.</p>';
		    $out .= '<p>Search for your favorite places and start <em>praizing</em>!</p>';
		}
		return $out;
	}
?>