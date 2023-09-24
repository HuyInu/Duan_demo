<?php
/* Smarty version 4.1.1, created on 2023-09-23 14:37:13
  from 'C:\wamp64\www\duan_demo\templates\tpl\giahuy\modal.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650e95a954a347_68998431',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f89cd63a1f46867165647540c2120f9252ece1f' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\giahuy\\modal.tpl',
      1 => 1691897202,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650e95a954a347_68998431 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/css/giahuy/modal.css" />
<div id='modal' class='modal-background hidden displayNon'>
    <div  class='modal'>
        <div class='card'>
            <div class='card-header'>
                Thông báo
            </div>
            <div class='card-body modal-body'>
                <div id='modal-content' class='modal-content'>
                    asdasdasda
                </div>
                <hr>
                <div class='card-action'>
                    <input type="button" id='confirmModal_btn' class='button-success button' value='Đồng ý'>
                    <input type="button" id='closeModal_btn' onclick="GiaHuy_closeModal('modal')" class='button-exit button' value='Không'>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/giahuy/modal.js"><?php echo '</script'; ?>
><?php }
}
