<?php
/**
 * Page module: CSV Export
 * This file contains the English module text outputs.
 * For more information see info.php
*/

// English module description
$module_description	= 'This module allows to export a MySQL table into a csv file and provides a download link to it.';

// declare module language array
$LANG = array();

// Text outputs for the frontend
$LANG['frontend'] = array(
	'TXT_DOWNLOAD'	=> 'Download the CSV file',
	'TXT_DIR_ERR'	=> 'Can not create target directory!',
	'TXT_FILE_ERR'	=> 'Can not create target file!'
);

// Text outputs for the backend
$LANG['backend'] = array(
	'TXT_HEADER_BACKEND'		=> 'CSV Export - Settings',
	'TXT_TABLE'		=> 'Table to export:',
	'TXT_TARGET_FILE'	=> 'Target file including path',
	'TXT_TARGET_FILE_HINT'	=> 'Choose a not so easy to guess file name or make sure to htaccess the directory!<br>Example: "/temp/export7537/result2589.csv"<br>Even on Windows, use slashs, not backslashs!',
	'TXT_TARGET_CP'	=> 'Target encoding:',
	'TXT_TARGET_CP_HINT'	=> 'Leave blank if no encoding is required,<br> "Windows-1252" seems to work if your local machine has a German Windows.',
	'TXT_SOURCE_CP'	=> 'MySQL table encoding:',
	'TXT_SOURCE_CP_HINT'	=> 'Will be ignored if no target encoding is specified,<br> "UTF-8" seems to work if you use it for your MySQL tables.',
	'TXT_SETTINGS'	=> 'Submit settings'

);
	
?>