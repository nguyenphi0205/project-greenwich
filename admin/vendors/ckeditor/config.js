/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = '/laravel_5/public/admin/vendors/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/laravel_5/public/admin/vendors/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = '/laravel_5/public/admin/vendors/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = '/laravel_5/public/admin/vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '/laravel_5/public/admin/vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = '/laravel_5/public/admin/vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
