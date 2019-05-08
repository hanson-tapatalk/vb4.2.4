<?php

/* ======================================================================*\
  || #################################################################### ||
  || # vBulletin 4.2.4 - Licence Number VBF83FEF44
  || # ---------------------------------------------------------------- # ||
  || # Copyright ©2000-2019 vBulletin Solutions Inc. All Rights Reserved. ||
  || # This file may not be redistributed in whole or significant part. # ||
  || # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
  || # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
  || #################################################################### ||
  \*====================================================================== */

abstract class vB_ActivityStream_View_Perm_Calendar_Base extends vB_ActivityStream_View_Perm_Base
{
	protected function fetchCanViewCalendarEvent($eventid)
	{
		if (!($eventinfo = $this->content['event'][$eventid]))
		{
			return false;
		}

		if (!vB::$vbulletin->userinfo['calendarpermissions'])
		{
			cache_calendar_permissions(vB::$vbulletin->userinfo);
		}

		if (
			$eventinfo['userid'] != vB::$vbulletin->userinfo['userid']
				AND
			!(vB::$vbulletin->userinfo['calendarpermissions']["$eventinfo[calendarid]"] & vB::$vbulletin->bf_ugp_calendarpermissions['canviewothersevent'])
		)
		{
			return false;
		}

		return $this->fetchCanViewCalendar($eventinfo['calendarid']);
	}

	protected function fetchCanViewCalendar($calendarid)
	{
		if (!($calendarinfo = $this->content['calendar'][$calendarid]))
		{
			return false;
		}

		if (!vB::$vbulletin->userinfo['calendarpermissions'])
		{
			cache_calendar_permissions(vB::$vbulletin->userinfo);
		}
		if (!(vB::$vbulletin->userinfo['calendarpermissions'][$calendarid] & vB::$vbulletin->bf_ugp_calendarpermissions['canviewcalendar']))
		{
			return false;
		}

		return true;
	}
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/