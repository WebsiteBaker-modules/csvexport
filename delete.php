<?php

######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	Delete the entry of the module DB-table of the page which will be deleted (filer: unique section_id)
#
#	INVOKED BY:
#	This file is automatically invoked by Website Baker, if you delete a page or section of your module type
#	via the Website Baker Backend: Pages -> Delete
#
#	LIST OF VARIABLES AND FUNCTIONS USED IN THIS FILE:
#		CONSTANTS AND VARIABLES USED:
#		WB_PATH:				only defined if config.php was included before
#		TABLE_PREFIX:			optional prefix for all database tables defined during Installation; stored in config.php
#		$database:				provides database functions (instance of class database defined in framework/class.database.php)
#		$section_id:			ID of the currents page section (automatically set by Website Baker)
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

//	delete module specific settings for the deleted section
$database->query("DELETE FROM `" .TABLE_PREFIX ."mod_csvexport_settings` WHERE section_id = '$section_id' and page_id = '$page_id'");

?>