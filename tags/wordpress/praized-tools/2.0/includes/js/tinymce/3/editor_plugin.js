(function() {
	tinymce.PluginManager.requireLangPack('praizedtools');

	tinymce.create('tinymce.plugins.PraizedTools', {
		getInfo : function() {
			return {
				longname  : "Praized Tools",
				author    : 'Praized Media',
				authorurl : 'http://www.praizedmedia.com/',
				infourl   : 'http://www.praizedmedia.com/',
				version   : "0.1"
			};
		},

		init : function(ed, url) {
			ed.addButton('praizedtools', {
				title   : 'praizedtools.searchlet',
				image   : url + '/../../../css/commons/images/logo-20x20.png',
				onclick : function() {
					PraizedToolsAdmin.Searchlet.show('mce', 1);
				}
			});
		},

		/* placeholder */
		createControl : function(n, cm) {
			return null;
		}
	});

	tinymce.PluginManager.add('praizedtools', tinymce.plugins.PraizedTools);
})();