<?php

/* ======================================================================*\
  || #################################################################### ||
  || # vBulletin 4.2.4 - Licence Number VBF83FEF44
  || # ---------------------------------------------------------------- # ||
  || # Copyright �2000-2019 vBulletin Solutions Inc. All Rights Reserved. ||
  || # This file may not be redistributed in whole or significant part. # ||
  || # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
  || # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
  || #################################################################### ||
  \*====================================================================== */

/**
 * Class to populate the activity stream from existing content
 *
 * @package	vBulletin
 * @version	$Revision: 92139 $
 * @date		$Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
 */
class vB_ActivityStream_Populate_Blog_Comment extends vB_ActivityStream_Populate_Base
{
	/**
	 * Constructor - set Options
	 *
	 */
	public function __construct()
	{
		return parent::__construct();
	}

	/*
	 * Don't get: Deleted threads, redirect threads, CMS comment threads
	 *
	 */
	public function populate()
	{
		if (!vB::$vbulletin->products['vbblog'])
		{
			return;
		}

		$typeid = vB::$vbulletin->activitystream['blog_comment']['typeid'];
		$this->delete($typeid);

		if (!vB::$vbulletin->activitystream['blog_comment']['enabled'])
		{
			return;
		}

		$timespan = TIMENOW - vB::$vbulletin->options['as_expire'] * 60 * 60 * 24;
		vB::$db->query_write("
			INSERT INTO " . TABLE_PREFIX . "activitystream
				(userid, dateline, contentid, typeid, action)
				(SELECT
					bt.userid, bt.dateline, bt.blogtextid, '{$typeid}', 'create'
				FROM " . TABLE_PREFIX . "blog_text AS bt
				LEFT JOIN " . TABLE_PREFIX . "blog AS b ON (b.blogid = bt.blogid)
				WHERE
					bt.dateline >= {$timespan}
						AND
					b.state NOT IN ('draft')
						AND
					b.pending = 0
						AND
					b.firstblogtextid <> bt.blogtextid
				)
		");
	}
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/