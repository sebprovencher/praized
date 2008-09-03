<?php
	function smarty_function_mtpraizedpagination($args, &$ctx) {
		$type = ($args["type"]) ? $args["type"]: "merchants";
		
		$pagination = $ctx->stash("collections_praized_pagination_$type");
		

		if( ! is_null($pagination) && intval($pagination->page_count) > 1) {
			// make the call to the api.
			// and use the values in the logic.
			$current_page   = $pagination->current_page;
			$per_page 	    = $pagination->per_page;
			$total_entries  = $pagination->total_entries;
			$total_pages    = ceil($total_entries / $per_page);

			$url = preg_replace("/\?.+$/", "", $_SERVER["REQUEST_URI"]);
					
			// implementing will_paginate in dirty php.. 
			// this is a straight port of it.
			$opt = array(
				"class"		   => "pagination",
				"prev_label"   => '&laquo; Previous',
				"next_label"   => 'Next &raquo;',
				"inner_window" => 4,
				"outer_window" => 1,
				"gap_marker"   => "..."
			);
		
			$inner_window = $opt["inner_window"];
			$outer_window = $opt["outer_window"];
			$gap_marker   = $opt["gap_marker"];
			$next_label   = $opt["next_label"];
			$previous_label = $opt["prev_label"];
		

			$window_from = $current_page - $inner_window;
			$window_to   = $current_page + $inner_window;

			if($window_to > $total_pages) {
				$window_from -= $window_to - $total_pages;
				$window_to 	  = $total_pages;
			} else if($window_from < 1) {
				$window_to  += 1 - $window_from;
				$window_from = 1;
			}

			$visible    = range(1, $total_pages);
			$left_gap   = range(2 + $outer_window, $window_from); 
			$right_gap  = range($window_to + 1, ($total_pages - $outer_window));

			if(($left_gap[sizeof($left_gap) - 1] - $last_gap[0]) > 1)
				$visible = array_diff($visible, $left_gap);
	
			if(($right_gap[sizeof($right_gap) - 1] - $right_gap[0]) > 1)
				$visible = array_diff($visible, $right_gap);
	
			// page to show
			$links = array();
			$prev  = null;
		
			$search_query = "";
			if($_GET["q"])
				$search_query .= "q=" . $_GET["q"] . "&";
				
			if($_GET["l"])
				$search_query .= "l=" . $_GET["l"] . "&";
				
			// building the html.
			// TODO.
			$str = "<ul class=\"praized-pagination\">";
			if($current_page == 1)
				$str .= "<li class=\"praized-pagination-disabled\">" . $previous_label . "</li>";
			else
				$str .= "<li><a href=\"" . $url . "?" . $search_query . "page=" . ($current_page - 1) . "\">" . $previous_label . "</a></li>";

		
			foreach($visible as $item) {
				if($prev != null && $item > $prev + 1)
					$str .= "<li>...</li>";
				
				if($current_page == $item) 
					$str .= "<li class=\"praized-pagination-current\">" . $item . "</li>";
				else
					$str .= "<li><a href=\"" . $url ."?" . $search_query . "page=" . $item . "\">" . $item . "</a></li>";	

		    	$prev = $item;
		    }
			if($current_page == $total_pages)
				$str .= "<li class=\"praized-pagination-disabled\">" . $next_label . "</li>";
			else
				$str .= "<li><a href=\"" . $url . "?" . $search_query . "page=" . ($current_page + 1) . "\">" . $next_label . "</a></li>";

	
			$str .= "</ul>";
		
			return $str;
		} else {
			return "";
		}
   }  
?>