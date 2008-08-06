window.PraizedToolsAdmin.BlogEngine = {
	insert: function(data, bbcode) {
		var actual_content = app.editor.getHTML();
		app.editor.setHTML(actual_content + bbcode);
		app.editor.setChanged();
	}
};