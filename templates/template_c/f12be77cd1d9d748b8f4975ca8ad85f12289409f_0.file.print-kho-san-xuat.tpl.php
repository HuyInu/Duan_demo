<?php
/* Smarty version 4.1.1, created on 2023-08-26 08:04:37
  from 'C:\wamp64\www\duan_demo\templates\tpl\allsearch\print-kho-san-xuat.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e94fa5a555d1_99542524',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f12be77cd1d9d748b8f4975ca8ad85f12289409f' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\print-kho-san-xuat.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e94fa5a555d1_99542524 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['checkPer7']->value == "true") {?>
    <div class="formsearch formsearchend"> 
        <input type="button" name="print" value="     In     " onclick=" return printKhoSanxuat();" class="btn-save btn-search"/> 
    </div>
<?php }
}
}
