<?php
/* Smarty version 4.1.1, created on 2023-08-16 14:09:28
  from 'D:\wamp64\www\duan_demo\templates\tpl\huytulam\sweetAlert.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64dc7628369552_75208195',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40daba06fb7eb30fbbb7f8c3a116635638e52166' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\huytulam\\sweetAlert.tpl',
      1 => 1692169759,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64dc7628369552_75208195 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/css/huytulam/sweet-alert.css">
<div class='sweet_alert <?php echo $_smarty_tpl->tpl_vars['actResult']->value['result'] == '1' ? 'success' : 'error';?>
'>
    <img class='icon' src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/<?php echo $_smarty_tpl->tpl_vars['actResult']->value['result'] == '1' ? 'active' : 'delete';?>
.png" />
    <?php echo $_smarty_tpl->tpl_vars['actResult']->value['msg'];?>

</div>
<?php }
}
