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

/**
 * Description of facebook_getforumid
 *
 * @author Jorge Tiznado
 */
class vB_APIMethod_facebook_getforumid extends vBI_APIMethod {
    //put your code here
    public function output()
    {
            $data = array('response' => array('forumid' => $this->getforumId()));
            return $data;
    }

    private function getforumId()
    {
        global $vbulletin, $db;

        $arrayResponse = array();

        
        
            $vbulletin->input->clean_array_gpc('r', array(
                'threadid' => TYPE_STR,
            ));

            $vbulletin->GPC['threadid'] = convert_urlencoded_unicode($vbulletin->GPC['threadid']);
            $threadid = $vbulletin->GPC['threadid'];

            $forumid = $db->query_first("
				SELECT thread.forumid
				FROM " . TABLE_PREFIX . "thread AS thread
				
				WHERE thread.threadid = $threadid
			");
            return $forumid['forumid'];
        
    }
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:01, Mon May 6th 2019 : $Revision: 92139 $
|| # $Date: 2016-12-30 20:02:36 -0800 (Fri, 30 Dec 2016) $
|| ####################################################################
\*======================================================================*/
?>
