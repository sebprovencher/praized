(function() {

	pte = function(el) { return document.getElementById(el); };

	pta = function() { return window.PraizedToolsAdmin; }

	pts = function() { return pta().Searchlet; }

	addEvent = function(element, type, handler) {
		if (document.addEventListener) {
			// Other
			element.addEventListener(type, handler, false);
		} else {
			// MSIE
			element.attachEvent('on' + type, handler);
		}
	};
	
	evTarget = function(event) {
		if (event.srcElement) {
			// MSIE
			return event.srcElement;
		} else {
			// Other
			return event.target;
		}
	};

	window.PraizedToolsAdmin = {
		
		init : function() {
			addEvent(document, 'click', function(event) {
				switch(evTarget(event).id) {
					case 'pta_load_searchlet':
				    	pts().show('widget_conf');
				    	break;
				    default:
				    	break;
				}
			});
		},
		
		Searchlet : {
	
			ieHackId   : 'pta_searchlet_ie_hack',
			screenId   : 'pta_searchlet_screen',
			wrapId     : 'pta_searchlet_wrap',
			iframeId   : 'pta_searchlet_iframe',
			intervalId : null,
			
			newDiv : function() {
				if ( pte(pts().ieHackId) && pte(pts().ieHackId).style )
					return;
				
				conf = window.ptasConf;
				
				gH = document.documentElement.scrollHeight;
				
				if (document.body.currentStyle)
					gH = gH + 30;

				if ( window.innerHeight ) 
					cH = window.innerHeight;
				else
					cH = document.documentElement.clientHeight;
				
				if (gH > cH)
					realHeight = gH + 'px';
				else if (cH > 1000)
					realHeight = cH + 'px';
				else
					realHeight = '1000px';

				ieHackDiv = document.createElement('div');
				ieHackDiv.id = pts().ieHackId;
				ieHackDiv.style.position = 'absolute';
				ieHackDiv.style.width = '100%';
				ieHackDiv.style.height = realHeight;
				ieHackDiv.style.top = 0;
				ieHackDiv.style.left = 0;
				ieHackDiv.style.zIndex = 999996;
				ieHackDiv.style.display = 'none';
				document.body.appendChild(ieHackDiv);
				
				screenDiv = document.createElement('div');
				screenDiv.id = pts().screenId;
				screenDiv.style.position = 'absolute';
				screenDiv.style.width = '100%';
				screenDiv.style.height = realHeight;
				screenDiv.style.zIndex = 999997;
				ieHackDiv.appendChild(screenDiv);

				wrapDiv = document.createElement('div');
				wrapDiv.id = pts().wrapId;
				wrapDiv.style.position = 'absolute';
				wrapDiv.style.width = '100%';
				wrapDiv.style.height = realHeight;
				wrapDiv.style.zIndex = 999998;
				addEvent(wrapDiv, 'click', function(){ pts().hide(); });
				ieHackDiv.appendChild(wrapDiv);

				var iframeWidth = 640;
				var iframeHeight = 480;
				var iframeMarginTop = Math.round( ( cH - iframeHeight ) / 2 );
				var iframeMarginLeft = Math.round( ( ( (window.innerWidth) ? window.innerWidth : document.documentElement.clientWidth ) - iframeWidth ) / 2 );
				
				if (top.location.href.match(/^https/))
					pts().iframeUrl.replace('http:', 'https:')
				
				newIframe = document.createElement('iframe');
				newIframe.id = pts().iframeId;
				newIframe.src = conf.schltUrl;
				newIframe.style.zIndex = 999999;
				newIframe.style.position = 'fixed';
				newIframe.style.width = iframeWidth + 'px';
				newIframe.style.height = iframeHeight + 'px';
				newIframe.style.margin = iframeMarginTop + 'px 0 0 ' + iframeMarginLeft + 'px';
				wrapDiv.appendChild(newIframe);
			},
			
			toggle : function(el, display) {
				if ( pte(el) && pte(el).style ) 
					pte(el).style.display = display;
			},
			
			show : function(context, btnSnap) {
				if ( ! pts().intervalId) {
					pts().intervalId = window.setInterval(pts().setText, 250);
				}
				pts().newDiv();
				pts().toggle(pts().ieHackId, 'block');
				if (context == 'mce')
					window.ptasConf.btnSnap = btnSnap;
			},
			
			hide : function() {
				if (pts().intervalId) {
					window.clearInterval(pts().intervalId);
					pts().intervalId = false;
					
					parts = top.location.href.split('#');
					top.location.href = parts[0] + '#';					
				}
				pts().toggle(pts().ieHackId, 'none');
			},
			
			setText : function() {
				if( data = pta().hashData()) {
					if ( data.type ) {
						var bbcode = pta().BBCodeFactory.create(data);
						pta().BlogEngine.insert(data, bbcode);
					}
					pts().hide();
				}
			}
		},
		
		BBCodeFactory : { 
			create : function(data) {
				var str = "[praized ";
				var key, v;
				for(key in data) {
					str += key + '="' + unescape(unescape(data[key].replace('"', ''))) + '" ';
				}
				str =  str.substr(0, str.length - 1) + "]";
				return str;
			}
		},
			
		hashData : function() {
			data = false;
			url = top.location.href;
			if (url.match('#')) {
				tmp = url.split('#');
				tmp = unescape(tmp[1]);
				tmp = tmp.match(/^praized(\{.*\})$/);
				if (tmp && tmp[1]) {
					eval('data = ' + tmp[1]);
				}
			}
			if (data !== false)
				return data;
			else
				return false;
		},
		
		getCurrentHost : function() {
			url = top.location.href;
			tmp = url.match(/^http(s?):\/\/.+?\//);
			return (tmp && tmp[0]) ? tmp[0].substr(0, tmp[0].length - 1) : '';
		}
	};
	
	/**
	 * INIT
	 */
	 window.PraizedToolsAdmin.init();

})();