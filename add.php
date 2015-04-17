<?php
/**
 * The file add.php adds an page with default values to the CMS.
 * Page module: CSV Export
 * For more information see info.php
 *
 * Last change: version 1.10
 * 	- moved default values from modify.php to add.php
 * 	- tries to use default charset now
*/

// prevent this file from being accessed directly
if (!defined('WB_PATH')) die(header('Location: ../../index.php'));

if(defined('DEFAULT_CHARSET')) {
	$cp = DEFAULT_CHARSET;
} else {
	$cp = 'UTF-8';
}

$SQL = "INSERT INTO " .TABLE_PREFIX."mod_csvexport_settings (";
$SQL .= "page_id, section_id, target_cp, source_cp";
$SQL .= ") VALUES (";
$SQL .= "'$page_id', '$section_id', 'Windows-1252', '$cp')";

$database->query($SQL);
?>