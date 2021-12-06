/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */
CKEDITOR.editorConfig = function( config ) {
	
   config.extraPlugins = 'codemirror,tableresize,oembed,mediaembed';
   config.codemirror_theme = 'rubyblue';
   // Define changes to default configuration here. For example:
   // config.language = 'fr';
   config.uiColor = '#56A2F2';
   //config.height = 600;
   config.skin = 'moono';
   // Toolbar groups configuration.
	config.toolbarGroups = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools']},
	{ name: 'clipboard', groups: [ 'clipboard', 'undo','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ], },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
	//{ name: 'forms' },
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align'] },
	{ name: 'links' },
	{ name: 'insert' },
	{ name: 'styles' },
	{ name: 'colors' },
	{ name: 'others' },
	{ name: 'tool', items : [ 'Maximize', 'ShowBlocks'] },
	{ name: 'about'}
];
	
   //config.extraPlugins = 'tableresize';
   //COLOR CODE
   //var my_url = 'http://localhost/paritos/public/admin_assests/';
   config.filebrowserBrowseUrl = my_url+'plugins/ckeditor/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = my_url+'plugins/ckeditor/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = my_url+'plugins/ckeditor/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl = my_url+'plugins/ckeditor/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = my_url+'plugins/ckeditor/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl = my_url+'plugins/ckeditor/kcfinder/upload.php?type=flash';
};

