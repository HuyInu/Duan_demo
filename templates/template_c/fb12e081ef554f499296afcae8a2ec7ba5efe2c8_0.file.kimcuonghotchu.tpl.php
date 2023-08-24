<?php
/* Smarty version 4.1.1, created on 2023-08-24 10:52:45
  from 'D:\wamp64\www\duan_demo\templates\tpl\popup\DanhMucNguyenLieu\kimcuonghotchu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e6d40d0ddef1_47587722',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fb12e081ef554f499296afcae8a2ec7ba5efe2c8' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\popup\\DanhMucNguyenLieu\\kimcuonghotchu.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e6d40d0ddef1_47587722 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/search.css" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/jsapi.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/script.js"><?php echo '</script'; ?>
>
<div class="main-popup">
    <div class="box-thongin box-thongin-popup">
        <div class="title-thongtin ">Vui lòng chọn Tên Kim Cương</div>
        <div class="SubAll">
            <div class="SubLeft">
                Nhập chọn tên 
            </div>
            <div class="SubRight">
                <input autocomplete="off" class="InputText" type="text" placeholder="Nhập tìm kiếm ( mã đá hoặc tên đá ) " onkeyup="lookup('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
','danhmuckimcuong',this.value);" />
                <input type="hidden" id="numdong" value="<?php echo $_smarty_tpl->tpl_vars['idshow']->value;?>
">
            </div>
            <div id="suggestions"></div>
        </div>
        <div class="clear"></div>
        <div class="addRowGirlMain chonxong">
            <a href="javascript:void(0)" onclick="resetdl()" class="addRowGirl"> <strong> Làm mới </strong> </a>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
>
	function resetdl(){
		var numdong = $('#numdong').val();
		$('#idkimcuong'+numdong).val(0);
		$('#showtennkimcuong'+numdong).html('Click chọn Tên');
		$('#dongiaban'+numdong).val(0);
		$.fancybox.close();	
	}
	function searchDMKimCuong(iddmkc, tenkc, sizekc, giaban){
		var numdong = $('#numdong').val();
		$('#idkimcuong'+numdong).val(iddmkc);
		$('#showtennkimcuong'+numdong).html(sizekc+':'+tenkc);
		$('#dongiaban'+numdong).val(giaban);
		$.fancybox.close();	
	}
<?php echo '</script'; ?>
><?php }
}
