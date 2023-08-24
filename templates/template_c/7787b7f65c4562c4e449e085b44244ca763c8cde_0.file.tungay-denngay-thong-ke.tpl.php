<?php
/* Smarty version 4.1.1, created on 2023-08-24 11:52:44
  from 'D:\wamp64\www\duan_demo\templates\tpl\allsearch\tungay-denngay-thong-ke.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e6e21ccc0145_99465113',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7787b7f65c4562c4e449e085b44244ca763c8cde' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\tungay-denngay-thong-ke.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e6e21ccc0145_99465113 (Smarty_Internal_Template $_smarty_tpl) {
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
    <input class="btn-save btn-search" value="Tìm kiếm" type="submit"> 
    <input type="reset" name="reset" value=" Làm mới " class="btn-save btn-search"/>
</div>
<?php echo '<script'; ?>
>
	function thongke(){
		var fromdays = $('#fromdays');	
		var todays = $('#todays');
		if(fromdays.val() == ''){
			alert('Vui lòng chọn từ ngày');
			fromdays.focus();
			return false;
		}
		else if(todays.val() == ''){
			alert('Vui lòng chọn đến ngày');
			todays.focus();	
			return false;
		}
		else{
			return true;	
		}
	}
<?php echo '</script'; ?>
><?php }
}
