<?php
/* Smarty version 4.1.1, created on 2023-08-19 16:12:42
  from 'C:\wamp64\www\duan_demo\templates\tpl\allsearch\tungay-denngay-thong-ke.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e0878ae7f9e4_24602669',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cbfa96a0b3a2d6d4c7458ae76fbc6dc7909612bf' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\tungay-denngay-thong-ke.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e0878ae7f9e4_24602669 (Smarty_Internal_Template $_smarty_tpl) {
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
