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
if (!VB_API) die;

loadCommonWhiteList();

$VB_API_WHITELIST = array(
	'response' => array(
		'albuminfo' => array(
			'albumid', 'title', 'description'
		),
		'albumtype', 'posthash', 'poststarttime',
		'pagenav' => $VB_API_WHITELIST_COMMON['pagenav'],
		'pagenumber', 'totalpages', 'start', 'end', 'total',
		'userinfo' => array(
			'userid', 'username'
		),
		'picturebits' => array(
			'*' => array(
				'picture' => array(
					'attachmentid', 'title', 'caption_preview', 'thumbnail_dateline',
					'hasthumbnail', 'pictureurl'
				),
				'show' => array(
					'moderation'
				)
			)
		)
	),
	'show' => array(
		'add_group_row', 'edit_album_option', 'add_picture_option'
	)
);

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/
