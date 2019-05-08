<?php
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
/*
if (!isset($GLOBALS['vbulletin']->db))
{
	exit;
}
*/

class vB_Upgrade_423b4 extends vB_Upgrade_Version
{
	/*Constants=====================================================================*/

	/*Properties====================================================================*/

	/**
	* The short version of the script
	*
	* @var	string
	*/
	public $SHORT_VERSION = '423b4';

	/**
	* The long version of the script
	*
	* @var	string
	*/
	public $LONG_VERSION  = '4.2.3 Beta 4';

	/**
	* Versions that can upgrade to this script
	*
	* @var	string
	*/
	public $PREV_VERSION = '4.2.3 Beta 3';

	/**
	* Beginning version compatibility
	*
	* @var	string
	*/
	public $VERSION_COMPAT_STARTS = '';

	/**
	* Ending version compatibility
	*
	* @var	string
	*/
	public $VERSION_COMPAT_ENDS   = '';

	/**
	 * Change useragent from 100 to varchar 255 chars
	 */
	public function step_1()
	{
		if ($this->field_exists('postlog', 'useragent'))
		{
			$this->run_query(
				sprintf($this->phrase['core']['altering_x_table'], 'postlog', 1, 1),
				"ALTER TABLE " . TABLE_PREFIX . "postlog CHANGE useragent useragent VARCHAR(255) NOT NULL DEFAULT ''"
			);
		}
		else
		{
			$this->skip_message();
		}
	}

	/**
	 * Change useragent from 100 to varchar 255 chars
	 */
	public function step_2()
	{
		if ($this->field_exists('session', 'useragent'))
		{
			$this->run_query(
				sprintf($this->phrase['core']['altering_x_table'], 'session', 1, 2),
				"ALTER TABLE " . TABLE_PREFIX . "session CHANGE useragent useragent VARCHAR(255) NOT NULL DEFAULT ''"
			);
		}
		else
		{
			$this->skip_message();
		}
	}

	/**
	 * Change location to varchar 255
	 */
	public function step_3()
	{
		if ($this->field_exists('session', 'location'))
		{
			$this->run_query(
				sprintf($this->phrase['core']['altering_x_table'], 'session', 2, 2),
				"ALTER TABLE " . TABLE_PREFIX . "session CHANGE location location VARCHAR(255) NOT NULL DEFAULT ''"
			);
		}
		else
		{
			$this->skip_message();
		}
	}
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/
