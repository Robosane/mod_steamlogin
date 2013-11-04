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
<div id="steamlogin" class="steamlogin-module<?php echo $moduleclass_sfx; ?>">
    <img src="<?php echo JUri::root().'media/system/images/modal/spinner.gif'; ?>" />
    <?php echo JText::_('MOD_STEAMLOGIN_OPENID_TRANSACTION_IN_PROGRESS'); ?>
    <?php echo $form; ?>
    <script type="text/javascript">
    document.getElementById("openid_message").submit();
    </script>
</div>