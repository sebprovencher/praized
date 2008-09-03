<?php
function smarty_function_mtpraizeduserpermalink($args, &$ctx) {
    $blog = $ctx->stash('blog');
    $url = $blog['blog_site_url'];
    if (!preg_match('!/$!', $url))
        $url .= '/';


	
		
			
	if($login = smarty_function_mtpraizeduserlogin($args, $ctx)){
		
		$url .= "/users/" . $login;
		
		return preg_replace('|([^:]{1})//|', '\1/', $url);
	} else {
		return "";
	}
}
?>