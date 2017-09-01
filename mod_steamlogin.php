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
require_once __DIR__ . '/helper.php';

$user   = JFactory::getUser();
$layout = $params->get('layout', 'default');
$type   = ModSteamLoginHelper::getType();
$return = ModSteamLoginHelper::getReturnURL($params, $type);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

// Logged users must load the logout sublayout
if (!$user->guest) {
    // Profile link
    $profile_query = 'index.php?option=com_users&view=profile';
    $profile_item = JFactory::getApplication()->getMenu()->getItems('link', $profile_query, true);
    if ($profile_item) {
        $profile_url = JRoute::_('index.php?Itemid=' . $profile_item->id);
    } else {
        $profile_url = JRoute::_($profile_query);
    }
    $layout .= '_logout';
}

// Do not display module if already in view login
// $view = JRequest::getCmd('view');
// $option = JRequest::getCmd('option');
// if ($view == 'login' && ($option == 'com_users' || $option == 'com_steamid')) {
//     return;
// }

// Display template
require JModuleHelper::getLayoutPath('mod_steamlogin',$layout);
