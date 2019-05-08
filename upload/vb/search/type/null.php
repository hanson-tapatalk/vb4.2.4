<?php if (!defined('VB_ENTRY')) die('Access denied.');

/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.2.4 - Licence Number VBF83FEF44
|| # ---------------------------------------------------------------- # ||
|| # Copyright �2000-2019 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/

/**
 * @package vBulletin
 * @subpackage Search
 * @author Kevin Sours, vBulletin Development Team
 * @version $Revision: 92139 $
 * @since $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
 * @copyright vBulletin Solutions Inc.
 */

require_once (DIR . '/vb/search/type.php');
require_once (DIR . '/vb/search/result/null.php');

/**
 * Enter description here...
 *
 * @package vBulletin
 * @subpackage Search
 */
class vB_Search_Type_Null extends vB_Search_Type
{
	public function fetch_validated_list($user, $ids, $gids)
	{
		//null items are never valid
		$retval = array_fill_keys($ids, false);

		($hook = vBulletinHook::fetch_hook('search_validated_list')) ? eval($hook) : false;

		return $retval;
	}

	public function is_enabled()
	{
		return false;
	}

	public function get_display_name()
	{
		return 'Null Type';
	}

	public function create_item($id)
	{
		//this shouldn't normally be called
		return new vB_Search_Result_Null();
	}

}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/

