<?php
/* Smarty version 4.1.1, created on 2023-08-24 09:27:45
  from 'D:\wamp64\www\duan_demo\templates\tpl\allsearch\print-kho-san-xuat.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e6c021dea046_80347409',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd57dcd5b21f44fc5aee19693e3712bd33b37269a' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\print-kho-san-xuat.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e6c021dea046_80347409 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['checkPer7']->value == "true") {?>
    <div class="formsearch formsearchend"> 
        <input type="button" name="print" value="     In     " onclick=" return printKhoSanxuat();" class="btn-save btn-search"/> 
    </div>
<?php }
}
}
