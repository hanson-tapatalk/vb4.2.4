<?php if (!defined('VB_ENTRY')) die('Access denied.');
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

/**
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 92139 $
 * @since $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
 * @copyright vBulletin Solutions Inc.
 */

class vB_Facebook_RegisterConnectlogin
{
	/**
	 * Url destination for post request
	 *
	 * @var	string
	 */
	CONST POSTURL = 'https://services.vbulletin.com/services/vbfacebook/v1/';

	/**
	 * Registry
	 *
	 * @var	vB_Registry
	 */
	private static $registry = null;

	/**
	 * Send Post request with user's fbuserid
	 *
	 * @param	vB_Registry Object
	 * @param	bool		Bypass the session->created check
	 *
	 * @return	string	Response to this request from remote server
	 */
	public static function registerLogin(&$registry, $bypassCreated = false)
	{
		self::$registry = $registry;

		if ((!$bypassCreated AND !self::$registry->session->created) OR !self::$registry->userinfo['userid'] OR !self::$registry->userinfo['fbuserid'] OR !is_facebookenabled())
		{
			return;
		}

		$params = array(
			'facebookProfileId'   => self::$registry->userinfo['fbuserid'],
			'facebookAccessToken' => self::$registry->userinfo['fbaccesstoken'],
			'licenseKey'          => '[#]facebookguid[#]',
			'hideFbConnect'       => self::$registry->userinfo['disablevbsocial'],
		);

		return self::sendRequest('registerConnectLogin', $params);
	}

	/**
	 * Send POST request to API server
	 *
	 * @param	string	API method to call
	 * @param	array	Variables to post
	 *
	 * @return	string	Response to this request from remote server
	 */
	private static function sendRequest($method, $params)
	{
		require_once(DIR . '/includes/class_vurl.php');
		$vurl = new vB_vURL(self::$registry);
		$vurl->set_option(VURL_URL, self::POSTURL . $method);
		$vurl->set_option(VURL_POST, 1);
		$vurl->set_option(VURL_RETURNTRANSFER, 1);
		$vurl->set_option(VURL_CLOSECONNECTION, true);
		$vurl->set_option(VURL_POSTFIELDS, http_build_query($params, '', '&'));
		return $vurl->exec();
	}
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/