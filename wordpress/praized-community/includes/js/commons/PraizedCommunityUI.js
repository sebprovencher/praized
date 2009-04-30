(function() {
	
	window.pcuie = function(el) { return document.getElementById(el); };
	
	window.pcui = function() { return window.PraizedCommunityUI; };
	
	window.PraizedCommunityUI = {
		
		boxes : new Array(),
		
		screenSwitch : function(target) {
			var screenPrefix = 'praized_ui_tab_box_';
			if ( ! target || ! pcuie(target) )
				return;
			var targetScreen = pcuie(target);
			targetScreen.style.display = 'block';
			var myScreens = pcui().boxes;
			var myScreen;
			for (i in myScreens) {
				myScreen = pcuie(myScreens[i]);
				if ( myScreen.style && ( myScreen != targetScreen ) )
					myScreen.style.display = 'none';
			}
		},
	
		tabInit : function(target) {
			var screenPrefix = 'praized_ui_tab_box_';
			var tabIndex = target.replace(screenPrefix, 'praized_ui_tab_');
			var tab = pcuie(tabIndex);
			if ( ! tab )
				tab = pcuie('praized_ui_tabs').getElementsByTagName('li')[0];
			var myTabs = pcuie('praized_ui_tabs').getElementsByTagName('li');
			for (i in myTabs) {
				if ( typeof(myTabs[i]) == 'object' )
					myTabs[i].className = ( myTabs[i] == tab ) ? 'active' : 'inactive';
			}
			pcui().screenSwitch(target);
		},
	
		screenSetup : function(boxes, defaultTab) {
			if ( ! boxes )
				return;
			pcui().boxes = boxes;
			if ( ! defaultTab || ! pcuie(defaultTab) )
				return;
			myLinks = pcuie('praized_ui_tabs').getElementsByTagName('a');
			var target;
			for (i in myLinks) {
				if ( myLinks[i].href ) {
					target = myLinks[i].href.replace(/^.+#/,'');
					myLinks[i].href = "javascript:pcui().tabClick('"+target+"');";
				}
			}
			pcui().tabInit(defaultTab);
		},
	
		tabClick : function(target) {
			var requiredErrors = pcuie('praized_required_errors');
			if ( requiredErrors && requiredErrors.style && requiredErrors.style.display != 'none' )
				requiredErrors.style.display = 'none';
			pcui().tabInit(target);
		}
			
	}


})();