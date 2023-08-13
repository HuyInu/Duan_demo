<?php
/* Smarty version 4.1.1, created on 2023-08-10 14:07:53
  from 'D:\wamp64\www\duan_demo\templates\tpl\allsearch\chontenkimcuongs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d48cc9d1bc88_46237699',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '570c07218d20de0c9474c8232cacd8c0bd7e88b0' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\chontenkimcuongs.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64d48cc9d1bc88_46237699 (Smarty_Internal_Template $_smarty_tpl) {
?><select name="tenkimcuongs[]" id="tenkimcuongs" multiple="multiple" />
    <?php echo insert_getSelectOptionKimCuong(array('otionKimCuong' => $_smarty_tpl->tpl_vars['otionKimCuong']->value, 'str' => $_smarty_tpl->tpl_vars['tenkimcuongs']->value),$_smarty_tpl);?>	  											
</select><?php }
}
