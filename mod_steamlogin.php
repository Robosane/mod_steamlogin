<?php
/**
 * @version     1.0.0
 * @package     mod_steamlogin
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      DZ Team <dev@dezign.vn> - dezign.vn
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$type   = ModSteamLoginHelper::getType();
$return = ModSteamLoginHelper::getReturnURL($params, $type);
$form = ModSteamLoginHelper::getForm($return);
$user   = JFactory::getUser();
$layout = $params->get('layout', 'default');

// Logged users must load the logout sublayout
if (!$user->guest) {
    $layout .= '_logout';
} else {
    if (JRequest::getVar('janrain_nonce')) {
        $credentials = $_GET;
        $credentials['password'] = '';

        JFactory::getApplication()->login($_GET, array('autoregister' => true));
    }
}

// Display template
require JModuleHelper::getLayoutPath('mod_steamlogin',$layout);
