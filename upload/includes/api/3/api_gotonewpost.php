<?php
/*======================================================================*\
|| #################################################################### ||
|| # vBulletin Blog 4.2.4 - Licence Number VBF83FEF44
|| # ---------------------------------------------------------------- # ||
|| # Copyright �2000-2019 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/
if (!VB_API) die;

class vB_APIMethod_api_gotonewpost extends vBI_APIMethod
{
	public function output()
	{
		global $vbulletin, $threadid, $postid, $db, $VB_API_WHITELIST;

		require_once(DIR . '/includes/functions_bigthree.php');
		
		$threadinfo = verify_id('thread', $threadid, 1, 1);

		if ($vbulletin->options['threadmarking'] AND $vbulletin->userinfo['userid'])
		{
			$vbulletin->userinfo['lastvisit'] = max($threadinfo['threadread'], $threadinfo['forumread'], TIMENOW - ($vbulletin->options['markinglimit'] * 86400));
		}

		$coventry = fetch_coventry('string');
		$posts = $db->query_first("
			SELECT MIN(postid) AS postid
			FROM " . TABLE_PREFIX . "post
			WHERE threadid = $threadinfo[threadid]
				AND visible = 1
				AND dateline > " . intval($vbulletin->userinfo['lastvisit']) . "
				". ($coventry ? "AND userid NOT IN ($coventry)" : "") . "
			LIMIT 1
		");

		if ($posts['postid'])
		{
			$postid = $posts['postid'];
		}
		else
		{
			$postid = $threadinfo['lastpostid'];
		}

		loadAPI('showthread');

		include(DIR . '/showthread.php');
	}
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/