<?php
/* Smarty version 4.1.1, created on 2023-08-31 14:41:13
  from 'D:\wamp64\www\duan_demo\templates\tpl\huytulam\sweetAlert.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64f0441941d3f2_29684604',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40daba06fb7eb30fbbb7f8c3a116635638e52166' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\huytulam\\sweetAlert.tpl',
      1 => 1693466867,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64f0441941d3f2_29684604 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/css/huytulam/sweet-alert.css">
<div class='sweet_alert <?php echo $_smarty_tpl->tpl_vars['actResult']->value == 'success' ? 'success' : 'error';?>
'>
    <img class='icon' src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/<?php echo $_smarty_tpl->tpl_vars['actResult']->value == 'success' ? 'active' : 'delete';?>
.png" />
    <?php echo $_smarty_tpl->tpl_vars['actResult']->value;?>

</div>
<?php }
}
