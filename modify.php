<?php
/**
 * The file modify.php delivers the backend main form of a module.
 * Page module: CSV Export
 * For more information see info.php
 *
 * Last change: version 1.30 - Security fix
*/

// prevent this file from being accessed directly
if (!defined('WB_PATH')) die(header('Location: ../../index.php'));

// load module language file
$lang = (dirname(__FILE__)) . '/languages/' . LANGUAGE . '.php';
require_once(!file_exists($lang) ? (dirname(__FILE__)) . '/languages/EN.php' : $lang );

// include Website Baker module functions and show edit button for optional module CSS files
require_once(WB_PATH . '/framework/module.functions.php');
edit_module_css(basename(dirname(__FILE__)));

/**
 * Include Website Baker template parser and configure basic settings
 */
// create new template instance and set path to template folder
require_once(WB_PATH . '/include/phplib/template.inc');
$tpl = new Template(dirname(__FILE__) . '/htt');

// define how to handle unknown variables (default:='remove', during development use 'keep' or 'comment')
$tpl->set_unknowns('keep');

// define debug mode (default:=0 (disabled), 1:=variable assignments, 2:=calls to get variable, 4:=show internals)
$tpl->debug = 0;

/**
 * Output the module backend text using the template parser
 */
// set the template file to be used (content of backend_view.htt is assigned to variable page)
$tpl->set_file('page', 'backend_view.htt');

// replace all placeholder {xxx} of the template file with values from language file
foreach($LANG['backend'] as $key => $value) {
	$tpl->set_var($key, $value);
}

// obtain data from module DB-table of the current displayed page (unique page defined via section_id)
$sql_result = $database->query("SELECT * FROM `" .TABLE_PREFIX ."mod_csvexport_settings` WHERE `section_id` = '$section_id' and page_id = '$page_id'");

// store all results (fields) in the array $sql_row
$sql_row = $sql_result->fetchRow();

// Note: before displaying a string in a text field, one needs to convert special characters into entities.
// Characters like " do not show up in text fields if not converted to entities.
// This also prevents that embedded Javascript/PHP/HTML tags are parsed by the browser.
$sql_row['target_cp'] = htmlspecialchars($sql_row['target_cp']);
$sql_row['source_cp'] = htmlspecialchars($sql_row['source_cp']);
$sql_row['table'] = htmlspecialchars($sql_row['table']);
$sql_row['target'] = htmlspecialchars($sql_row['target']);

// get table names
$tl = "";
$qs= "SHOW TABLES";
$q = $database->query($qs);
while ($r = $q->fetchRow()) {
	if ($r[0] == $sql_row['table']) {
		$tl .= '\t\t<option selected>' . $r[0] . "</option>\n";
	} else {
		$tl .= '\t\t<option>' . $r[0] . "</option>\n";
	}
}

// add template placeholders not defined in the language files
$tpl->set_var('MOD_CLASS', strtolower(basename(dirname(__FILE__))));
$tpl->set_var('PAGE', $page_id);
$tpl->set_var('SECTION', $section_id);
$tpl->set_var('WB_URL', WB_URL);
$tpl->set_var('TABLE_LIST', $tl);
$tpl->set_var('TFV', $sql_row['target']);
$tpl->set_var('TCV', $sql_row['target_cp']);
$tpl->set_var('SCV', $sql_row['source_cp']);

// output the template
$tpl->pparse('output', 'page');

?>