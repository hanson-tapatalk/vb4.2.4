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
 * Class to update the popularity score of stream items
 *
 * @package	vBulletin
 * @version	$Revision: 92139 $
 * @date		$Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
 */
class vB_ActivityStream_Popularity_SocialGroup_Photo extends vB_ActivityStream_Popularity_Base
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
	 * Update popularity score
	 *
	 */
	public function updateScore()
	{
		if (!vB::$vbulletin->activitystream['socialgroup_photo']['enabled'])
		{
			return;
		}

		$typeid = vB::$vbulletin->activitystream['socialgroup_photo']['typeid'];
		vB::$db->query_write("
			UPDATE " . TABLE_PREFIX . "activitystream AS a
			INNER JOIN " . TABLE_PREFIX . "attachment AS at ON (a.contentid = at.attachmentid)
			SET
				a.score = (1 + (at.counter / 1000))
			WHERE
				a.typeid = {$typeid}
		");
	}
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/