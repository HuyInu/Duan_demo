<?php
/* Smarty version 4.1.1, created on 2023-08-14 07:49:23
  from 'D:\wamp64\www\duan_demo\templates\tpl\giahuy\modal.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d97a13089e59_68253620',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fcc4a3f3d8008c72295bfbaad9690d0c7a294b5a' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\giahuy\\modal.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64d97a13089e59_68253620 (Smarty_Internal_Template $_smarty_tpl) {
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
