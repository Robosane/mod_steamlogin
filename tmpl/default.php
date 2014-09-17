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
$image_src = JURI::root() . 'media/mod_steamlogin/images/' . $params->get('btn_image_src', 'sits_small.png');
JHtml::_('jquery.framework');
?>
<div id="steamlogin" class="steamlogin-module<?php echo $moduleclass_sfx; ?>">
    <form id="steamlogin_form" method="POST" action="<?= JRoute::_('index.php?option=com_steamid&view=login')?>">
        <input type="hidden" name="try_auth" value="1"/>
        <input type="image" src="<?php echo $image_src; ?>" />
        <input type="hidden" name="return" value="<?= base64_encode(JRoute::_($return, true, -1)); ?>" />
    </form>
    <div class="loader" style="display: none;">
        <img src="<?php echo JUri::root().'media/system/images/modal/spinner.gif'; ?>" />
        <?php echo JText::_('MOD_STEAMLOGIN_OPENID_TRANSACTION_IN_PROGRESS'); ?>
    </div>
</div>
<script type="text/javascript">
    jQuery('#steamlogin_form').on('submit', function() {
        jQuery(this).hide();
        jQuery("#steamlogin > .loader").show();

        jQuery.ajax({
            type: "POST",
            url: this.action,
            data: jQuery(this).serialize(),
            success: function(data) {
                var module = jQuery("#steamlogin", jQuery(data));
                jQuery("#steamlogin").replaceWith(module);
                jQuery("#openid_message", module).submit();
            }
        })

        return false;
    });
</script>
