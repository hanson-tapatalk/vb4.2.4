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
class vB_ActivityStream_Populate_Calendar_Event extends vB_ActivityStream_Populate_Base
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
		$typeid = vB::$vbulletin->activitystream['calendar_event']['typeid'];
		$this->delete($typeid);

		if (!vB::$vbulletin->activitystream['calendar_event']['enabled'])
		{
			return;
		}

		$timespan = TIMENOW - vB::$vbulletin->options['as_expire'] * 60 * 60 * 24;
		vB::$db->query_write("
			INSERT INTO " . TABLE_PREFIX . "activitystream
				(userid, dateline, contentid, typeid, action)
				(SELECT
					userid, dateline, eventid, '{$typeid}', 'create'
				FROM " . TABLE_PREFIX . "event
				WHERE
					dateline >= {$timespan}
						AND
					visible = 1
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