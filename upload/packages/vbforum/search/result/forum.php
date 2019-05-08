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

require_once (DIR . '/vb/search/result.php');
require_once (DIR . '/vb/legacy/forum.php');

/**
 * Enter description here...
 *
 * @package vBulletin
 * @subpackage Search
 */
class vBForum_Search_Result_Forum extends vB_Search_Result
{

	public static function create($id)
	{
		$result = new vBForum_Search_Result_Forum();
		$result->forum = vB_Legacy_Forum::create_from_id($id);
		return $result;
	}

	protected function __construct() {}


	public function get_contenttype()
	{
		return vB_Search_Core::get_instance()->get_contenttypeid('vBForum', 'Forum');
	}

	public function can_search($user)
	{
		return $this->forum ? $this->forum->can_search($user) : false;
	}

	public function render($current_user, $criteria, $template_name = '')
	{
		global $vbulletin;

		if ('' == $template_name)
		{
			$template_name = 'search_results_forum';
		}
		$template = vB_Template::create($template_name);
		$template->register('forum', $this->forum->get_record());
		$template->register('dateformat', $vbulletin->options['dateformat']);
		$template->register('timeformat', $vbulletin->options['timeformat']);
		return $template->render();
	}


	/*** Returns the primary id. Allows us to cache a result item.
	 *
	 * @result	integer
	 ***/
	public function get_id()
	{
		if (isset($this->forum) AND ($forumid = $this->forum->get_field('forumid')) )
		{
			return $forumid;
		}
		return false;
	}

	private $forum;
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/
