<?php
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
/*
if (!isset($GLOBALS['vbulletin']->db))
{
	exit;
}
*/

class vB_Upgrade_423 extends vB_Upgrade_Version
{
	/*Constants=====================================================================*/

	/*Properties====================================================================*/

	/**
	* The short version of the script
	*
	* @var	string
	*/
	public $SHORT_VERSION = '423';

	/**
	* The long version of the script
	*
	* @var	string
	*/
	public $LONG_VERSION  = '4.2.3';

	/**
	* Versions that can upgrade to this script
	*
	* @var	string
	*/
	public $PREV_VERSION = '4.2.3 Release Candidate 1';

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

	/** VBIV-16186 **
	* Check attachment refcounts and fix any that are broken.
	* This checks to see if this fix has been previously run.
	* Strictly speaking this probably isnt necessasry, but as this
	* step is duplicated in 4.2.4 Beta 1, it keeps them aligned.  
	*/
	public function step_1()
	{
		$check = $this->db->query_first_slave("
			SELECT text
			FROM " . TABLE_PREFIX . "adminutil
			WHERE title = 'attach_fix'
		");

		$hasrun = intval($check['text']);

		if ($hasrun)
		{
			$this->skip_message();
		}
		else
		{
			$sql = "
				INSERT INTO " . TABLE_PREFIX . "adminutil 
				(title, text) VALUES ('attach_fix', '1')
			";

			$this->db->query_write($sql);

			$sql = "
				UPDATE " . TABLE_PREFIX . "filedata
				LEFT JOIN (
					SELECT filedataid, COUNT(attachmentid) AS actual
					FROM " . TABLE_PREFIX . "attachment
					GROUP BY filedataid
				) list USING (filedataid) 
				SET refcount = IFNULL(actual, 0)
				WHERE refcount <> IFNULL(actual, 0)
			";

			$this->run_query(sprintf($this->phrase['vbphrase']['update_table_x'], 'filedata', 1, 1), $sql);
		}
	}
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/
