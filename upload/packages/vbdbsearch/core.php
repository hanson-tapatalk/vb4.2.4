<?php if (!defined('VB_ENTRY')) die('Access denied.');

/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.2.4 - Licence Number VBF83FEF44
|| # ---------------------------------------------------------------- # ||
|| # Copyright ©2000-2019 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/

/**
 * @package vbdbsearch
 * @author Kevin Sours, vBulletin Development Team
 * @version $Revision: 92139 $
 * @since $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
 * @copyright vBulletin Solutions Inc.
 */

require_once (DIR . '/packages/vbdbsearch/indexer.php');
require_once (DIR . '/packages/vbdbsearch/coresearchcontroller.php');
require_once (DIR . '/packages/vbdbsearch/postindexcontroller.php');

/**
*/
class vBDBSearch_Core extends vB_Search_Core
{
	/**
	 * Enter description here...
	 *
	 */
	static function init()
	{
		//register implementation objects with the search system.
		$search = vB_Search_Core::get_instance();
		$search->register_core_indexer(new vBDBSearch_Indexer());
		$search->register_index_controller('vBForum', 'Post', new vBDBSearch_PostIndexController());
		$__vBDBSearch_CoreSearchController = new vBDBSearch_CoreSearchController();
		$search->register_default_controller($__vBDBSearch_CoreSearchController);
//		$search->register_search_controller('vBForum', 'Post',$__vBDBSearch_CoreSearchController);
	}

}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/

