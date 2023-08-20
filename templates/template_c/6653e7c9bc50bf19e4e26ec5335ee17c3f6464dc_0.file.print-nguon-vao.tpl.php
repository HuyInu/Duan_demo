<?php
/* Smarty version 4.1.1, created on 2023-08-19 16:12:50
  from 'C:\wamp64\www\duan_demo\templates\tpl\allsearch\print-nguon-vao.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e08792302ca5_68876572',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6653e7c9bc50bf19e4e26ec5335ee17c3f6464dc' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\print-nguon-vao.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e08792302ca5_68876572 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['checkPer7']->value == "true") {?>
    <div class="formsearch formsearchend"> 
        <input type="button" name="print" value="     In     " onclick=" return printKhoNguonVao();" class="btn-save btn-search"/> 
    </div>
<?php }
}
}
