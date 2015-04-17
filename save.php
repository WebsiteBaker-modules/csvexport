<?php
/*
######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	This file reads the output text specified by the user (formular in modify.php). The user input is filterd to avoid
#	security vulnerabilities like: SQL-injection, XSS, parsing of code, defacing of layout...
#	Once the input is filtered, it is written to the module DB-table. Depending on the result, a status message is 
#	shonw. If no database error occured, the user is redirected to the modify.php file.
#
#	INVOKED BY:
# 	This file is invoked when a user clicks on the Save button in the module page backend (modify.php)
#	Pages -> Page of your module type -> Click on Page Title link -> Save
#
#	LIST OF VARIABLES AND FUNCTIONS USED IN THIS FILE:
#		CONSTANTS AND VARIABLES USED:
#		WB_PATH:				path to the WB root directory (set during installation; stored in config.php)
#		THEME_URL:				URL to the WB backend (set during installation; stored in config.php)
#		TABLE_PREFIX:			optional prefix for all database tables defined during Installation (stored in config.php)
#		$database:				provides database functions (instance of class database defined in framework/class.database.php)
#		$page_id:				ID of the current displayed page (automatically set by Website Baker)
#		$section_id:			ID of the currents page section (automatically set by Website Baker)
#		$sql_query:				string for the MySQL database query
#
#		VARIABLES DEFINED IN LANGUAGE FILES:
#		$MESSAGE['PAGES']['SAVED']:	status messsage (defined in /languages/XX.php)
#
#		FUNCTIONS USED:
#		$database->query():			function to create a database query
#		$database->is_error():		function to check the result of a database query
#		$database->get_error():		function to get the error onfo of a database query
#		$admin->print_error():		function to print the error message on screen
#		$admin->print_success():	function to print the success message on screen
#
#
######################################################################################################################

/**
 * Page module: CSV Export
 * For more information see info.php
 * Last change: version 1.30 - Security fix
*/

// manually include the config.php file (defines the required constants)
require('../../config.php');

// unset page/section IDs defined via GET before including the admin file (we expect POST here)
unset($_GET['page_id']);
unset($_GET['section_id']);

/**
*	INCLUDE THE WB-ADMIN WRAPPER SCRIPT 
*	The admin wrapper script provides functions to add the look & feel of WB-Backend pages
*	to the save.php file (backend header, last modified, backend footer...).
*	The admin wrapper also takes care about the users permissions to view and change the files.
*/
// tell the admin wrapper to actualize the DB settings when this page was last updated
$update_when_modified = true;
// include the admin wrapper script (includes framework/class.admin.php)
include(WB_PATH . '/modules/admin.php');

// get data send via POST using function defined in framework/class.wb.php 
// $admin->get_post prevents output of warnings if the specified value does not exist
// strip_tags removes all HTML, PHP and Javascript tags from the string (we are only interested in the text; nothing else)
$table = strip_tags($admin->get_post('table'));
$target = strip_tags($admin->get_post('target'));
$target_cp = strip_tags($admin->get_post('targetcp'));
$source_cp = strip_tags($admin->get_post('sourcecp'));

// escape special characters (', ", \, NULL byte) before  writing to the database to prevent SQL-injections!!!
// make use of add_slashes (defined in framework/class.wb.php) to prevent double escaping of data derived 
// via GET, POST or COOKIES, if magic_quotes_gpc is enabled in the php.ini!!!
$table  = $admin->add_slashes($table);
$target = $admin->add_slashes($target);
$target_cp = $admin->add_slashes($target_cp);
$source_cp = $admin->add_slashes($source_cp);

// now write the text to the database, add unix timestamp to store modification date and time
$sql_query = "UPDATE `" .TABLE_PREFIX ."mod_csvexport_settings` SET `table` = '$table', `target` = '$target', `target_cp` = '$target_cp',"
		   . " `source_cp` = '$source_cp' WHERE `section_id` = '$section_id' and page_id = '$page_id'";
$database->query($sql_query);

// check if there is a database error, otherwise say successful (functions defined or included via modules/admin.php)
if($database->is_error()) {
	$admin->print_error($database->get_error(), $js_back);
} else {
	$admin->print_success($MESSAGE['PAGES']['SAVED'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// print admin footer
$admin->print_footer();

?>