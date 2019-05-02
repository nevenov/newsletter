/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file Slimbox plugin.
 */

(function() {
	var pluginName = 'slimbox';

	// Register plugin name.
	CKEDITOR.plugins.add( pluginName, {
		init : function( editor ) {
			// Add command for click on button
			editor.addCommand( pluginName,new CKEDITOR.dialogCommand( 'slimbox' ));
			// path to the dialog box.
			CKEDITOR.dialog.add( pluginName, this.path + 'dialogs/slimbox.js' );
			// Adding button
			editor.ui.addButton( 'slimbox', {
				label : 'Connect thumbnail with Lightbox enlarged image', //Title button
				command : pluginName,
				icon : this.path + 'logo.gif' //Путь к иконке
			});
		}
	});
})();