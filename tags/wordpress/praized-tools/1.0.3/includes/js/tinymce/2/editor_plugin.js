
tinyMCE.importPluginLanguagePack('praizedtools');

var TinyMCE_PraizedTools = {
	getInfo : function() {
		return {
			longname  : "Praized Tools",
			author    : 'Praized Media',
			authorurl : 'http://www.praizedmedia.com/',
			infourl   : 'http://www.praizedmedia.com/',
			version   : "0.1"
		};
	},

	getControlHTML : function(cn) {
		switch (cn) {
			case 'praizedtools':
				return tinyMCE.getButtonHTML(
					'praizedtools_searchlet',
					'lang_praizedtools_searchlet',
					'{$pluginurl}/../../../css/commons/images/logo-20x20.png', 'praizedtools_searchlet'
				);
			default:
				return '';
		}
	},

	execCommand : function(editor_id, element, command, user_interface, value) {
		switch (command) {
			case 'praizedtools_searchlet':
				PraizedToolsAdmin.Searchlet.show('mce', 1);
				return true;
			default:
				return false;
		}
	}
};

tinyMCE.addPlugin('praizedtools', TinyMCE_PraizedTools);