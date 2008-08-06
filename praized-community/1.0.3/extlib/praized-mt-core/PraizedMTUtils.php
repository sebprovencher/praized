<?php
	class PraizedMTUtils {
		function query_string(&$ctx = null, $str = "") {
			$query_str = "";

			if(isset($str) && ! empty($str))
				$query_string .= trim($str);

			$query_params = array();

			if(isset($_GET["q"]) && ! empty($_GET["q"]))
				$query_params["q"] = urlencode($_GET["q"]);

			if(isset($_GET["l"]) && ! empty($_GET["l"]))
				$query_params["l"] = urlencode($_GET["l"]);

			if(isset($_GET["tag"]) && ! empty($_GET["tag"])) {
				$query_params["tag"] = urlencode($_GET["tag"]);
			} else if(isset($_GET["t"]) && ! empty($_GET["t"])) {
				$query_params["tag"] = urlencode($_GET["t"]);
			} else if(!is_null($ctx) && $content = $ctx->stash("praized_querystring")) {
				if(! is_null($content["tag"]))
					$query_params["tag"] = urlencode($content["tag"]);
			}

			if(! empty($query_str))
				$query_str .=  "&";

			foreach($query_params as $k => $v) {
				$query_str .= $k . "=". $v . "&";
			}

			$query_str = preg_replace("/\&$/", "", $query_str);

			if(! empty($query_str) && ! preg_match("/^\?/", $query_str))
				$query_str = "?" . $query_str;

			return $query_str;
		}
	}
?>