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

// ######################## SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);
if (!is_object($vbulletin->db))
{
	exit;
}

// ########################################################################
// ######################### START MAIN SCRIPT ############################
// ########################################################################

require_once (DIR . '/includes/class_sitemap.php');

$runner = new vB_SiteMapRunner_Cron($vbulletin);
$runner->set_cron_item($nextitem);

$status = $runner->check_environment();
if ($status['error'])
{
	// if an error has happened, display/log it if necessary and die

	if (VB_AREA == 'AdminCP')
	{
		print_stop_message($status['error']);
	}
	else if ($status['loggable'])
	{
		$rows = $vbulletin->db->query_first("
			SELECT COUNT(*) AS count
			FROM " . TABLE_PREFIX . "adminmessage
			WHERE varname = '" . $vbulletin->db->escape_string($status['error']) . "'
				AND status = 'undone'
		");
		if ($rows['count'] == 0)
		{
			$vbulletin->db->query_write("
				INSERT INTO " . TABLE_PREFIX . "adminmessage
					(varname, dismissable, script, action, execurl, method, dateline, status)
				VALUES
					('" . $vbulletin->db->escape_string($status['error']) . "',
					1,
					'sitemap.php',
					'buildsitemap',
					'sitemap.php?do=buildsitemap',
					'get',
					" . TIMENOW . ",
					'undone')
			");
		}
	}

	exit;
}

$runner->generate();

if ($runner->is_finished)
{
	$log_text = $runner->written_filename . ', vbulletin_sitemap_index.xml';
}
else
{
	$log_text = $runner->written_filename;
}

log_cron_action($log_text, $nextitem, 1);

if (defined('IN_CONTROL_PANEL'))
{
	echo "<p>$log_text</p>";
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/