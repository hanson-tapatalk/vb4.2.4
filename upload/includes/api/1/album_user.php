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
if (!VB_API) die;

loadCommonWhiteList();

$VB_API_WHITELIST = array(
	'response' => array(
		'albumbits' => $VB_API_WHITELIST_COMMON['albumbits'],
		'latestbits' => $VB_API_WHITELIST_COMMON['albumbits'],
		'latest_pagenav' => $VB_API_WHITELIST_COMMON['pagenav'],
		'pagenav' => $VB_API_WHITELIST_COMMON['pagenav'],
		'userinfo' => array(
			'userid', 'username'
		)
	),
	'show' => array(
		'personalalbum', 'moderated', 'add_album_option'
	)
);

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/