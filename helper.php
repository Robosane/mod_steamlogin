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

abstract class modSteamLoginHelper
{
    public static function getReturnURL($params, $type)
    {
        $app    = JFactory::getApplication();
        $router = $app->getRouter();
        $url = null;
        if ($itemid = $params->get($type))
        {
            $db     = JFactory::getDbo();
            $query  = $db->getQuery(true)
                ->select($db->quoteName('link'))
                ->from($db->quoteName('#__menu'))
                ->where($db->quoteName('published') . '=1')
                ->where($db->quoteName('id') . '=' . $db->quote($itemid));

            $db->setQuery($query);
            if ($link = $db->loadResult())
            {
                if ($router->getMode() == JROUTER_MODE_SEF)
                {
                    $url = 'index.php?Itemid='.$itemid;
                }
                else {
                    $url = $link.'&Itemid='.$itemid;
                }
            }
        }
        if (!$url)
        {
            // Stay on the same page
            $uri = clone JUri::getInstance();
            $vars = $router->parse($uri);
            unset($vars['lang']);
            if ($router->getMode() == JROUTER_MODE_SEF)
            {
                if (isset($vars['Itemid']))
                {
                    $itemid = $vars['Itemid'];
                    $menu = $app->getMenu();
                    $item = $menu->getItem($itemid);
                    unset($vars['Itemid']);
                    if (isset($item) && $vars == $item->query)
                    {
                        $url = 'index.php?Itemid='.$itemid;
                    }
                    else {
                        $url = 'index.php?'.JUri::buildQuery($vars).'&Itemid='.$itemid;
                    }
                }
                else
                {
                    $url = 'index.php?'.JUri::buildQuery($vars);
                }
            }
            else
            {
                $url = 'index.php?'.JUri::buildQuery($vars);
            }
        }

        return $url;
    }

    public static function getType()
    {
        $user = JFactory::getUser();
        return (!$user->get('guest')) ? 'logout' : 'login';
    }

    public static function getForm($return_url)
    {
        $path = ini_get('include_path');
        $path_extra = JPATH_LIBRARIES.'/openid/';
        $path = $path_extra . PATH_SEPARATOR . $path;
        ini_set('include_path', $path);

        require_once JPATH_LIBRARIES.'/openid/Auth/OpenID/Consumer.php';
        require_once JPATH_LIBRARIES.'/openid/Auth/OpenID/FileStore.php';

        $identifier = 'http://steamcommunity.com/openid';
        $store_path = '/tmp';
        $store = new Auth_OpenID_FileStore($store_path);
        $consumer = new Auth_OpenID_Consumer($store);

        $auth_request = $consumer->begin($identifier);

        // Generate form markup and render it.
        $form_id = 'openid_message';
        $form_html = $auth_request->formMarkup(JUri::root(), JRoute::_($return_url, true, -1),
                                                false, array('id' => $form_id));
        $form_html = str_replace('type="submit"', 'type="image" src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_small.png" alt="Steam Login"',$form_html);
        return $form_html;
    }
}