<?php
	function smarty_function_mtpraizedseotitle($args, &$ctx) {
			$separator = (isset($args['separator'])) ? $args['separator'] : '|';
	
			// This is a small helper, we retreive the current type of page
			// And try to return a small contextual title
			$current_page_type = $ctx->stash('current_praized_page_type');
			
			if($current_page_type == 'users') {
				// Return the user login.
				if($user = $ctx->stash('current_praized_user'))
					return $user->login;
			} else if($current_page_type == 'merchants'){
				// we send a mixed title.
				// TODO How we do translation?
				$q   = $_GET['q'];
				$l	 = $_GET['l'];
				$tag = $_GET['tag'];
				
				$title = array();
				
				// pre
				if( ! empty($q) )
					array_push($title, $q);
				else if ( ! empty($tag) )
					array_push($title, $tag);
				else
					array_push($title, 'Everything');				
				
				if( ! empty($l) )
					array_push($title, $l);
				else
					array_push($title, 'Everywhere');

				for($i = 0; $i < sizeof($title); $i ++)
					$title[$i] = PraizedCore::_tempColinize($title[$i]);
				

				return join(" $separator ", $title);
			} else if($current_page_type == 'merchant') {
				$merchant = $ctx->stash("current_praized_merchant");
				return $merchant->name;
			}
						
			// fallback empty string.
			return '';
	}
?>