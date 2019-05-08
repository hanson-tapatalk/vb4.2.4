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

$VB_API_WHITELIST = array(
	'response' => array(
		'albuminfo' => array(
			'albumid', 'title', 'description'
		),
		'picturecomment_commentarea' => array(
			'messagestats',
			'pagenav' => $VB_API_WHITELIST_COMMON['pagenav'],
			'picturecommentbits' => array(
				'*' => array(
					'message' => array(
						'commentid', 'userid', 'username', 'avatarurl',
						'time', 'message','state','del_username','del_userid'
					),
					'show' => array(
						'edit', 'inlinemod', 'delete', 'undelete', 'approve',
						'pagenav', ''
					)
				)
			)
		),
		'pictureinfo' => array(
			'attachmentid', 'albumid', 'groupid', 'caption_censored',
			'pictureurl', 'caption_html', 'addtime'
		),
		'pic_location',
		'userinfo' => array(
			'userid', 'username'
		)
	),
	'show' => array(
		'picture_owner', 'edit_picture_option', 'add_group_link', 'reportlink',
		'picture_nav', 'moderation', 'picturecomment_options'
	)
);


function api_result_prerender_2($t, &$r)
{
	switch ($t)
	{
		case 'picturecomment_message':
		case 'picturecomment_message_deleted':
		case 'picturecomment_message_global_ignored':
		case 'picturecomment_message_ignored':
		case 'picturecomment_message_moderatedview':
			$r['message']['time'] = $r['message']['dateline'];
			break;
		case 'album_pictureview':
			$r['pictureinfo']['addtime'] = $r['pictureinfo']['dateline'];
			break;
	}
}

vB_APICallback::instance()->add('result_prerender', 'api_result_prerender_2', 2);

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/
