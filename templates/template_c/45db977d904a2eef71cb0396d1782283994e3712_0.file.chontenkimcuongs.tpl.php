<?php
/* Smarty version 4.1.1, created on 2023-08-19 16:12:47
  from 'C:\wamp64\www\duan_demo\templates\tpl\allsearch\chontenkimcuongs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e0878f58c071_76235408',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '45db977d904a2eef71cb0396d1782283994e3712' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\chontenkimcuongs.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e0878f58c071_76235408 (Smarty_Internal_Template $_smarty_tpl) {
?><select name="tenkimcuongs[]" id="tenkimcuongs" multiple="multiple" />
    <?php echo insert_getSelectOptionKimCuong(array('otionKimCuong' => $_smarty_tpl->tpl_vars['otionKimCuong']->value, 'str' => $_smarty_tpl->tpl_vars['tenkimcuongs']->value),$_smarty_tpl);?>	  											
</select><?php }
}
