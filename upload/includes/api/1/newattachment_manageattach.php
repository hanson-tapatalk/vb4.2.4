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

$VB_API_WHITELIST = array(
	'response' => array(
		'attachkeybits' => array(
			'*' => array(
				'extension' => array(
					'extension', 'size', 'width', 'height'
				)
			)
		),
		'attachlimit',
		'attachments' => array(
			'*' => array(
				'attach' => array(
					'extension', 'attachmentid', 'dateline', 'filename',
					'filesize'
				)
			)
		),
		'attachsize',
		'attachsum', 'attach_username', 'contenttypeid',
		'editpost', 'errorlist', 'inimaxattach',
		'totallimit', 'totalsize', 'values'
	),
	'show' => array(
		'errors', 'attachmentlimits', 'currentsize', 'totalsize', 'attachoption',
		'attachfile', 'attachurl', 'attachmentlist'
	)
);

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/