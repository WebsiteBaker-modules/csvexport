<?php

######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	This file provides clean-up functions. All database tables which are added by the module should be deleted if 
#	the module is uninstalled. This is a measure for a tidy database and good working praxis. All files contained in
#	the module directory will automatically be deleted by Website Baker itself, you do not need to care about that.
#
#	INVOKED BY:
#	This file is automatically invoked by Website Baker, if you uninstall this module via the Website Baker Backend
#	Add-Ons -> Modules -> Uninstall Module
#
#	LIST OF VARIABLES AND FUNCTIONS USED IN THIS FILE:
#		CONSTANTS AND VARIABLES USED:
#		WB_PATH:					only defined if config.php was included before
#		TABLE_PREFIX:			optional prefix for all database tables defined during Installation; stored in config.php
#		$database:				provides database functions (instance of class database defined in framework/class.database.php)
#
#		FUNCTIONS USED:
#		$database->query		function to create a database query (defined in framework/class.database.php)
#
######################################################################################################################

/**
 * Page module: CSV Export
 * For more information see info.php
*/

// prevent this file from being accessed directly
if(!defined('WB_PATH')) die(header('Location: index.php'));  

// delete the module database table
$database->query("DROP TABLE `" .TABLE_PREFIX ."mod_csvexport_settings`");

?>