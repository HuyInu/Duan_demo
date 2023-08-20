<?php
/* Smarty version 4.1.1, created on 2023-08-19 07:51:53
  from 'C:\wamp64\www\duan_demo\templates\tpl\allsearch\tungay-denngay-vang-kim-cuong.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e01229cb9651_83056347',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6eb89b67b3fd8810b2f162c629f74e826f167be8' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\tungay-denngay-vang-kim-cuong.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e01229cb9651_83056347 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="formsearch formsearchend"> 
    <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="Tìm kiếm" type="submit"> 
    <input type="button" name="reset" value=" Làm mới " onclick=" return resetNguonVaoVangKimCuong();" class="btn-save btn-search"/>
</div><?php }
}
