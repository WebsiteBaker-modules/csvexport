<?php
/**
 * Page module: CSV Export
 * The file view.php delivers the page for the frontend
 * For more information see info.php
 *
 * Version 1.10: now replaces line feeds with spaces in csv file
*/

// prevent this file from being accessed directly
if (!defined('WB_PATH')) die(header('Location: ../../index.php'));

// load module language file
$lang = (dirname(__FILE__)) . '/languages/' . LANGUAGE . '.php';
require_once(!file_exists($lang) ? (dirname(__FILE__)) . '/languages/EN.php' : $lang );

/**
 * Include Website Baker template parser and define basic settings
 */
// include Website Baker template parser and create template object
require_once(WB_PATH . '/include/phplib/template.inc');
$tpl = new Template(dirname(__FILE__) . '/htt');

// define how to deal with unknown {PLACEHOLDERS} (remove:=default, keep, comment)
$tpl->set_unknowns('remove');

// define debug mode (0:=disabled (default), 1:=variable assignments, 2:=calls to get variable, 4:=debug internals)
$tpl->debug = 0;

/**
 * Output the module fronten text using the template parser
 */
// set the template file to be used (content of backend_view.htt is assigned to variable page)
$tpl->set_file('page', 'frontend_view.htt');

// replace all placeholder {xxx} of the template file with values from language file
foreach($LANG['frontend'] as $key => $value) {
	$tpl->set_var($key, $value);
}

// obtain data from module DB-table of the current displayed page (unique page defined via section_id)
$sql_result = $database->query("SELECT * FROM `" .TABLE_PREFIX ."mod_csvexport_settings` WHERE `section_id` = '$section_id'");
$sql_row = $sql_result->fetchRow();
$target_cp = htmlspecialchars($sql_row['target_cp']);
$source_cp = htmlspecialchars($sql_row['source_cp']);
$table = htmlspecialchars($sql_row['table']);
$target = htmlspecialchars($sql_row['target']);

// open target file
$target_dir = WB_PATH . dirname($target);
if (!file_exists($target_dir)) {
	if (!@mkdir($target_dir)) {
		echo $LANG['frontend']['TXT_DIR_ERR'];
		exit(0);
	}
}

$fh = @fopen (WB_PATH . $target, "w");
if (!$fh) {
	echo $LANG['frontend']['TXT_FILE_ERR'];
	exit(0);
}
$link = WB_URL . $target;

$qs= "SELECT * FROM " . $table; 
$q = $database->query($qs);
if($database->is_error()) {
	echo mysql_error();
	fclose($fh);
	exit(0);
}

$r=$q->fetchRow();

// print header row:
$i = 0;
foreach ($r as $k => $v) {
    $i++;
    if ($i > 1) {
        if ($i % 2 == 0) {
            fwrite($fh, "\"$k\"");
        } else {
            fwrite($fh, ";");
        }
    }
}
fwrite($fh, "\n");

// print first data row:
$i = 0;
foreach ($r as $k) {
	$i++;
	if ($i > 1) {
		if ($i % 2 == 0) {
			$z = preg_replace('/[\r\n]/', ' ', $k);
			if ($target_cp == "") {
				fwrite($fh, "\"$z\"");
			} else {
				fwrite($fh, "\"" . mb_convert_encoding($z, $target_cp , $source_cp) . "\"");
			}
		} else {
			fwrite($fh, ";");
		}
	}
}
fwrite($fh, "\n");

// print rest of file:
while ($r=$q->fetchRow()) {
    $i = 0;
    foreach ($r as $k) {
        $i++;
        if ($i > 1) {
            if ($i % 2 == 0) {
				$z = preg_replace('/[\r\n]/', ' ', $k);
				if ($target_cp == "") {
					fwrite($fh, "\"$z\"");
				} else {
					fwrite($fh, "\"" . mb_convert_encoding($z, $target_cp , $source_cp) . "\"");
				}
            } else {
                fwrite($fh, ";");
            }
        }
    }
    fwrite($fh, "\n");
}
fclose($fh);

// add template placeholders not defined in the language files
$tpl->set_var('MOD_CLASS', strtolower(basename(dirname(__FILE__))));
$tpl->set_var('LINK_DOWNLOAD', $link);

// output the template
$tpl->pparse('output', 'page');

?>