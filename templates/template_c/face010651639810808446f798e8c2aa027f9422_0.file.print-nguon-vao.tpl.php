<?php
/* Smarty version 4.1.1, created on 2023-05-09 07:43:19
  from 'D:\wamp64\www\duan_demo\templates\tpl\allsearch\print-nguon-vao.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64599727cc0430_49208972',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'face010651639810808446f798e8c2aa027f9422' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\print-nguon-vao.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64599727cc0430_49208972 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['checkPer7']->value == "true") {?>
    <div class="formsearch formsearchend"> 
        <input type="button" name="print" value="     In     " onclick=" return printKhoNguonVao();" class="btn-save btn-search"/> 
    </div>
<?php }
}
}
