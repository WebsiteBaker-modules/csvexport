<?php
/**
 * Page module: CSV Export
 *
 * This module allows to export a MySQL table into a csv file.
 * Afterwards it creates a download link to this csv file.
 * 
 * This file defines the variables required for Website Baker.
 * 
 * LICENSE: Creative Commons Attribution-NonCommercial-No Derivate 3.0 License
 * 
 * @author		Frank Heyne (mod 4 wb at heysoft dot de)
 * @copyright	(c) 2009
 * @license		GNU General Public License 3.0
 * @version		1.20
 * @platform	Website Baker 2.7 or 2.8
 *
 * ------------------------------------------------------------------------------------------------
 *	MODULE VERSION HISTORY
 * ------------------------------------------------------------------------------------------------
 *	v1.00 RC1 (Frank Heyne: 25-Apr-2009)
 *	first version as module (previously used in a plain code snippet)
 * ------------------------------------------------------------------------------------------------
 *	v1.10 RC2 (Frank Heyne: 20-May-2009)
 *		linefeeds now will be replaced by spaces
 *		empty fields for the code pages are allowed now
 *		tries to use default charset now
 * ------------------------------------------------------------------------------------------------
 *	v1.20 stable (Frank Heyne: 18-Aug-2009)
 *		changed status to stable
 *		changed license to GPL
 * ------------------------------------------------------------------------------------------------
 *	v1.30 stable (Frank Heyne: 15-Dec-2010)
 *		Security fix for the backend
 * ------------------------------------------------------------------------------------------------
*/

$module_directory		= 'csvexport';
$module_name			= 'CSV Export';
$module_function		= 'page';
$module_version			= '1.30';
$module_status			= 'stable';
$module_platform		= '2.7;2.8';
$module_author			= 'Frank Heyne';
$module_license 		= 'GNU General Public License 3.0';
$module_requirements	= '-';
$module_description		= 'This module allows to export a MySQL table into a csv file and provides a download link to it.';
$module_guid = '3F7A4A9E-BB97-4B5C-A6C0-33CA927E1451';
$module_home = 'http://www.websitebakers.com/pages/modules/various/csvexport.php';

?>