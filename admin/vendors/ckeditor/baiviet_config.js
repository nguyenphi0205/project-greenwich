/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'vi';
	// config.uiColor = '#AADC6E';
	config.skin = 'kama';
	config.enterMode = CKEDITOR.ENTER_BR;
	//config.toolbar = 'basic';
	config.uiColor = '#e3e5c5';
	config.basicEntities = false;
	config.entities = false;

	config.toolbar =    [

    ['Source','-','Preview'],

    ['Cut','Copy','Paste','PasteText','PasteFromWord'],

    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],

    ['Link','Unlink','Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe','Maximize'],
    
    '/',

    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],

    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],

    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],

    ['Format','Font','FontSize'],

    ['TextColor','BGColor']

    ];
        

    config.filebrowserBrowseUrl = '/laravel_5/public/admin/vendors/ckfinder/ckfinder.html';
   
    config.filebrowserImageBrowseUrl = '/laravel_5/public/admin/vendors/ckfinder/ckfinder.html?type=Images';

    config.filebrowserFlashBrowseUrl = '/laravel_5/public/admin/vendors/ckfinder/ckfinder.html?type=Flash';

    config.filebrowserUploadUrl = '/laravel_5/public/admin/vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';

    config.filebrowserImageUploadUrl = '/laravel_5/public/admin/vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';

    config.filebrowserFlashUploadUrl = '/laravel_5/public/admin/vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

};
