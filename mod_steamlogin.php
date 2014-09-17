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
    $layout .= '_logout';
}

// Display template
require JModuleHelper::getLayoutPath('mod_steamlogin',$layout);
