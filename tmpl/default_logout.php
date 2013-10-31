<?php
/**
 * @version     1.0.0
 * @package     mod_steamlogin
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      DZ Team <dev@dezign.vn> - dezign.vn
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="steamlogin-module<?php echo $moduleclass_sfx; ?>">
    <h4><?php echo $user->name; ?></h4>
    <a href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>">
        <?php echo JText::_('MOD_STEAMLOGIN_YOUR_PROFILE'); ?>
    </a>

    <form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-vertical">
        <div class="logout-button">
            <input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" />
            <input type="hidden" name="option" value="com_users" />
            <input type="hidden" name="task" value="user.logout" />
            <input type="hidden" name="return" value="<?php echo base64_encode($return); ?>" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>