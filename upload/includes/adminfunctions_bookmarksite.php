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

error_reporting(E_ALL & ~E_NOTICE);


// #############################################################################
/**
* Caches social bookmark site data to the datastore
*/
function build_bookmarksite_datastore()
{
	global $vbulletin;
	
	$vbulletin->bookmarksitecache = array();
	
	$bookmarksitelist = $vbulletin->db->query_read("
		SELECT *  
		FROM " . TABLE_PREFIX . "bookmarksite AS bookmarksite
		WHERE active = 1
		ORDER BY displayorder ASC, bookmarksiteid ASC
	");
	if ($bookmarksitelist)
	{
		while ($bookmarksite = $vbulletin->db->fetch_array($bookmarksitelist))
		{
			$vbulletin->bookmarksitecache["$bookmarksite[bookmarksiteid]"] = $bookmarksite;
		}
	}

	// store the cache array into the database
	build_datastore('bookmarksitecache', serialize($vbulletin->bookmarksitecache), 1);
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/
?>