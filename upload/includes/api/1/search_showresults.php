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

define('VB_API_LOADLANG', true);

loadCommonWhiteList();

$VB_API_WHITELIST = array(
	'response' => array(
		'criteriaDisplay', 'displayCommon', 'searchtime', 'searchminutes',
		'first', 'last', 'total', 'search', 'pagenav' => $VB_API_WHITELIST_COMMON['pagenav'],
		'searchbits' => array(
			'*' => array(
				// Threadbit
				'post_statusicon',
				'userinfo' => array(
					'userid', 'username'
				),
				'thread' => $VB_API_WHITELIST_COMMON['thread'],
				'title', 'html_title', 'username', 'description',
				'parenttitle', 'parentid', 'previewtext', 'publishdate',
				'publishtime', 'lastpostdate', 'lastpostdatetime', 'lastposter',
				'lastposterinfo', 'avatar',
				// Blog
				'blog' => array(
					'blogid', 'username', 'userid', 'title',
					'blogtitle', 'previewtext', 'comments_total', 'trackbacks_total',
					'lastpostdate', 'lastposttime', 'lastcommenter', 'date', 'time'
				), 'blogposter',
				// Forum
				'forum' => $VB_API_WHITELIST_COMMON['forum'],
				// Article
				'article' => array(
					'contentid', 'nodeid', 'username', 'userid'
				),
				'page_url', 'lastcomment_url', 'parent_url', 'parenttitle', 'replycount',
				'categories' => array(
					'*' => array(
						'category', 'category_url', 'categoryid'
					)
				),
				'tags' => array(
					'*' => array(
						'tagtext'
					)
				),
				// Postbit
				'post' => array(
					'postid', 'postdate', 'posttime', 'threadid', 'threadtitle',
					'userid', 'username', 'replycount', 'views', 'typeprefix',
					'prefix', 'prefix_rich', 'posticonpath', 'posttitle',
					'pagetext', 'message_plain'
				),
				'show' => array(
					'avatar', 'detailedtime',
					// Threadbit
					'threadcount', 'gotonewpost', 'unsubscribe', 'pagenavmore',
					'managethread', 'taglist', 'rexpires', 'moderated', 'deletedthread',
					'paperclip', 'notificationtype', 'deletereason', 'inlinemod',
					// Forum
					'deleted'
				)
			)
		)
	),
	'show' => array(
		'results'
	)
);

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/