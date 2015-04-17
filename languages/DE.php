<?php
/**
 * Page module: CSV Export
 * This file contains the German module text outputs.
 * For more information see info.php
*/

// German module description
$module_description = 'Dieses Modul exportiert eine MySQL-Tabelle in eine csv-Datei und bietet diese anschlie&szlig;end zum Download an.';

// declare module language array
$LANG = array();

// Text outputs for the frontend
$LANG['frontend'] = array(
	'TXT_DOWNLOAD'	=> 'CSV-Datei herunterladen',
	'TXT_DIR_ERR'	=> 'Kann Zielverzeichnis nicht anlegen!',
	'TXT_FILE_ERR'	=> 'Kann Zieldatei nicht anlegen!'
);

// Text outputs for the backend
$LANG['backend'] = array(
	'TXT_HEADER_BACKEND'		=> 'CSV Export - Einstellungen',
	'TXT_TABLE'		=> 'Zu exportierende Tabelle:',
	'TXT_TARGET_FILE'	=> 'Zieldatei inklusive -verzeichnis:',
	'TXT_TARGET_FILE_HINT'	=> 'Verwenden Sie einen nicht einfach zu erratenden Dateinamen oder schr&auml;nken Sie besser noch die Zugriffsrechte f&uuml;r das Downloadverzeichnis mit .htaccess ein!<br>Beispiel: "/temp/export7537/result2589.csv"<br>Verwenden Sie hier immer (auch unter Windows) Slashs (/) statt Backslashs (\)!',
	'TXT_TARGET_CP'	=> 'Codepage des Zielsystems:',
	'TXT_TARGET_CP_HINT'	=> 'Kann frei gelassen werden, falls keine &Auml;nderung der Codierung notwendig ist,<br> "Windows-1252" scheint zu funktionieren, wenn auf dem lokalen Rechner ein deutsches Windows l&auml;uft.',
	'TXT_SOURCE_CP'	=> 'Codepage des MySQL-Quellsystems:',
	'TXT_SOURCE_CP_HINT'	=> 'Wird ignoriert, falls keine Codepage des Zielsystems angegeben wurde,<br> "UTF-8" scheint zu funktionieren, wenn es f&uuml;r die MySQL-Tabelle verwendet wird.',
	'TXT_SETTINGS'	=> 'Einstellungen &Uuml;bernehmen'
);
	
?>