<?php
	class PraizedMerchantVotesAction extends AbstractPraizedAction {
		function PraizedMerchantVotesAction() { }
		
		function process($request, &$ctx) {
			parent::process($request, $ctx);
            
			$api =& PraizedMTApi::getInstance();
			
			$pid = $request->getCleanRequest("/(\/merchants\/|\/votes\/?)/");
			$pid = str_replace('.json', '', $pid);
			
			if( sizeof($_POST) > 0 ) {
				
				if ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHTTPRequest') {
					// JSON output
				    $errorString = '{ "redirect_url" : null, "code" : 422, "errors" : { %s } }';
                    if ( ! $api->user_is_authorized() ) {
                        echo '{ "redirect_url" : "' . $this->redirect("oauth/login/", true) . '/oauth", "code" : 401, "errors" : {} }';
                    } elseif( $m = $api->merchant_vote_add($pid, $_POST) ) {
    					if ( $m->vote->merchant->votes->count ) {
                            echo '{';
        					echo ' "pos_count" : "' . $m->vote->merchant->votes->pos_count . '",';
        					echo ' "neg_count" : "' . $m->vote->merchant->votes->neg_count . '",';
        					echo '  "count"    : "' . $m->vote->merchant->votes->count . '",';
        					echo '  "score"    : "' . $m->vote->merchant->votes->score . '"';
        					echo '}';
    					} else {
    					    echo sprintf($errorString, '"error" : "API succeeded but returned no merchant data."');
    					}
                    } else {
    					echo sprintf($errorString, '"error" : "Unknown Error"');
                    }
					exit;
				} else {
					// Fall back for no ajax
					if( ! $api->user_is_authorized() ) {
						$api->login($_SERVER["HTTP_REFERER"], true);
						exit;
					} else {
						$m = $api->merchant_vote_add($pid, $_POST);
						$this->redirect($_SERVER["HTTP_REFERER"]);
					}
				}	
			} else {
    			$template = $this->fetchTemplate("merchants_votes", "index");
    			$request->getData()->update($template);
    			
    			$merchant = $api->merchant_get($pid)->merchant;
    

    			if( ! $merchant )
    				return false;

    			$contents = $api->merchant_praizers(
    			    $pid,
    			    array("page" => ($_GET["page"]) ? $_GET["page"] : 1)
    			);

    
    			if( ! $contents )
    				return false;

    
    		    $votes    = $contents->votes;
    		    $pagination = $contents->pagination;


    			
    			if( ! $merchant || ! $votes || ! $pagination )
    				return false;


	
    		    $ctx->stash("current_praized_merchant", $merchant);
    			$ctx->stash("collections_praized_merchant_votes", $votes);
    			$ctx->stash("collections_praized_pagination_votes", $pagination);

				return true;
			}
		}
	}
?>
