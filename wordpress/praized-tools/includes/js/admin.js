(function() {
	
	ptc = function() { return pta().BlogEngine.Config; }
		
	window.PraizedToolsAdmin.BlogEngine = {
		
		Config : {
			cacheTtl : function() {
		    	if (pte('pta_caching').checked == true) {
		    		pte('pta_cache_ttl').disabled = '';
		    	} else {
		    		pte('pta_cache_ttl').disabled = 'disabled';
		    		pte('pta_cache_ttl').options.selectedIndex = 0;
		    	}
			},
			
			caching : function() {
				if (pte('pta_cache_ttl').options.selectedIndex == 0) {
					pte('pta_caching').checked = false;
					ptc().cacheTtl();
				}
			}
		},
		
		init : function() {
			addEvent(document, 'load', function() {
				if ( pte('pta_cache_ttl') ) {
					ptc().cacheTtl();
				}
			});
			
			addEvent(document, 'change', function(event) {
		    	switch(evTarget(event).id) {
		    		case 'pta_caching':
		    			ptc().cacheTtl();
		    			break;
		    		case 'pta_cache_ttl':
		    			ptc().caching();
		    			break;
				    default:
				    	break;
		    	}
			});
		},
		
		insert : function(data, bbCode) {
			conf = window.ptasConf;
			if (conf.btnSnap) {
				// Content editor
				if (conf.btnSnap == 2)
					buttonsnap2_settext(bbCode);
				else
					buttonsnap_settext(bbCode);
			} else if (pte(conf.widgetContentField)) {
				// Widget admin
				pte(conf.widgetContentField).value = bbCode;
			}
			pts().hide();
		}
	};
	
		
	/**
	 * INIT
	 */
	 window.PraizedToolsAdmin.BlogEngine.init();
	
})();