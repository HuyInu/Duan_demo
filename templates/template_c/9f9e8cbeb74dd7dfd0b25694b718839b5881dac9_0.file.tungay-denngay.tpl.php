<?php
/* Smarty version 4.1.1, created on 2023-08-23 13:06:48
  from 'D:\wamp64\www\duan_demo\templates\tpl\allsearch\tungay-denngay.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e5a1f88c7e49_25658481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f9e8cbeb74dd7dfd0b25694b718839b5881dac9' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\tungay-denngay.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e5a1f88c7e49_25658481 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="formsearch">
     <label class="Fl labelsearch"> Từ ngày: </label>
     <input type="text" class="InputText textsearchdated" placeholder='dd/mm/yy' name="fromdays" id="fromdays" value="<?php echo $_smarty_tpl->tpl_vars['fromdays']->value;?>
" onchange="DateCheck()" autocomplete="off"/>
</div>
<div class="formsearch">
     <label class="Fl labelsearch"> Đến ngày: </label>
     <input type="text" class="InputText textsearchdated" placeholder='dd/mm/yy' name="todays" id="todays" value="<?php echo $_smarty_tpl->tpl_vars['todays']->value;?>
" onchange="DateCheck()" autocomplete="off"/>
</div>
<div class="formsearch"> 
    <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="Tìm kiếm" type="submit"> 
    <input type="button" name="reset" value=" Làm mới " onclick=" return resetsfrsearch();" class="btn-save btn-search"/>
</div> <?php }
}
