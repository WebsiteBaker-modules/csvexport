<?php

/*
 * Page module: CSV Export
 * This file provides the installation functions of the module.
 * For more information see info.php
*/

if(defined('WB_URL')) {
		
	// Create tables
	$database->query("DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_csvexport_settings`");
	$q = 'CREATE TABLE `'.TABLE_PREFIX.'mod_csvexport_settings` ('
		. ' `section_id` INT NOT NULL DEFAULT \'0\' ,'
		. ' `page_id` INT NOT NULL DEFAULT \'0\' ,'
		. ' `table` VARCHAR(80) NOT NULL DEFAULT \'\' ,'
		. ' `target` VARCHAR(80) NOT NULL DEFAULT \'\' ,'
		. ' `target_cp` VARCHAR(20) NOT NULL DEFAULT \'\' ,'
		. ' `source_cp` VARCHAR(20) NOT NULL DEFAULT \'\' ,'
		. ' PRIMARY KEY (section_id) '
		. ' )';
	$database->query($q);

	// Check if there is a database error, otherwise say successful
	if($database->is_error()) {
		$admin->print_error($database->get_error(), $js_back);
	} else {
		$admin->print_success("OK", "");
	}

}

?>