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

$VB_API_WHITELIST = array(
	'session' => array('dbsessionhash', 'userid'),
	'show' => array()
);
class vB_APIMethod_login_facebook extends vBI_APIMethod
{
    public function output()
    {
        global $vbulletin, $db, $show, $VB_API_REQUESTS; 
        
        // check if facebook and session is enabled
		if (!is_facebookenabled())
		{
			return $this->error('feature_not_enabled');
		} 
        
        require_once(DIR . '/includes/functions_login.php');
        if (verify_facebook_app_authentication())
        {
            // create new session
            process_new_login('fbauto', false, '');

            // do redirect
            do_login_redirect();
        }

        else 
        {
            return $this->error('badlogin_facebook');
        }
	}
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/
?>
