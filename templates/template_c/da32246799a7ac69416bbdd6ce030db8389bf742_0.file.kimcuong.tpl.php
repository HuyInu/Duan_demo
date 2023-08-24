<?php
/* Smarty version 4.1.1, created on 2023-08-24 10:51:19
  from 'D:\wamp64\www\duan_demo\templates\tpl\popup\DanhMucNguyenLieu\kimcuong.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e6d3b70d5d57_76687027',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da32246799a7ac69416bbdd6ce030db8389bf742' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\popup\\DanhMucNguyenLieu\\kimcuong.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e6d3b70d5d57_76687027 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="main-popup">
	<div class="box-thongin box-thongin-popup">
    <div class="title-thongtin ">Nhóm Nguyên Liệu</div>
    
    <h2 style="margin-top:20px;">Nguyên Liệu Kim Cương</h2>
    <div class="SubAll">
        <div class="SubLeft">
            Nhóm Nguyên Liệu Kim Cương
        </div>
        <div class="SubRight">
            <select name='idnhomnguyenlieukimcuong' id='idnhomnguyenlieukimcuong' onchange="getTenNguyenLieuKimCuong(this.value)">
                <option value="0">---------Chọn Nhóm Nguyên liệu Kim Cương---------</option>
                <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['nhomnguyenlieu']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                    <option <?php if ($_smarty_tpl->tpl_vars['nhomnguyenlieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'] == $_smarty_tpl->tpl_vars['nhomnguyenlieukimcuongactive']->value) {?>selected="selected"<?php }?>value="<?php echo $_smarty_tpl->tpl_vars['nhomnguyenlieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
;<?php echo $_smarty_tpl->tpl_vars['nhomnguyenlieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>
"> <?php echo $_smarty_tpl->tpl_vars['nhomnguyenlieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>
</option>
                <?php
}
}
?>
            </select>
        </div>
    </div>
    <div class="clear"></div>
    <div class="SubAll">
        <div class="SubLeft">
            Tên Nguyên Liệu Kim Cương
        </div>
        <div class="SubRight">
            <select name='idtennguyenlieukimcuong' id='idtennguyenlieukimcuong'>  </select>
        </div>
    </div>
    <div class="clear"></div>

    <div class="addRowGirlMain chonxong">
        <a href="javascript:void(0)" onclick="geteditDataBCTC('<?php echo $_smarty_tpl->tpl_vars['idshow']->value;?>
')" class="addRowGirl"> <strong> Lưu </strong> </a>
        <a href="javascript:void(0)" onclick="resetdl()" class="addRowGirl" style="margin-left:10px;"> <strong> Làm mới </strong> </a>
    </div>
</div>
</div>
<?php echo '<script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['tennguyenlieukimcuongactive']->value > 0) {?>
	$(document).ready(function() {
		getTenNguyenLieuKimCuong('<?php echo $_smarty_tpl->tpl_vars['nhomnguyenlieukimcuongactive']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['tennguyenlieukimcuongactive']->value;?>
');
	});
<?php }?>
function getTenNguyenLieuKimCuong(id,idselect){
	$.post('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/ajax/loadDanhMucNguyenLieu.php',{id:id,idselect:idselect},function(data) {
		 var obj = jQuery.parseJSON(data);
		 $('#idtennguyenlieukimcuong').html(obj.status);
	});
	return false;		
}

function resetdl(){
	var numdong = '<?php echo $_smarty_tpl->tpl_vars['idshow']->value;?>
';
	$('#idnhomnguyenlieukimcuong').val(0); 
	$('#idtennguyenlieukimcuong').val(0);
	
	$('#nhomnguyenlieukimcuong'+numdong).val(0);
	$('#showtennhomnguyenlieukimcuong'+numdong).html('Click chọn');
	$('#tennguyenlieukimcuong'+numdong).val(0);
	$('#showtennguyenlieukimcuong'+numdong).html('');
	$.fancybox.close();	
}

function geteditDataBCTC(idshow){
	var nhomnguyenlieukimcuong = $('#idnhomnguyenlieukimcuong').val();
	if(nhomnguyenlieukimcuong != 0){
		var nhomnguyenlieukimcuongsplit = nhomnguyenlieukimcuong.split(';');
		var idnhomnguyenlieukimcuong = nhomnguyenlieukimcuongsplit[0];
		var showtennhomnguyenlieukimcuong = nhomnguyenlieukimcuongsplit[1];
		
		var tennguyenlieukimcuong = $('#idtennguyenlieukimcuong').val();
		var tennguyenlieukimcuongsplit = tennguyenlieukimcuong.split(';');
		var idtennguyenlieukimcuong = tennguyenlieukimcuongsplit[0];
		var showtennguyenlieukimcuong = tennguyenlieukimcuongsplit[1];
		
		$('#nhomnguyenlieukimcuong'+idshow).val(idnhomnguyenlieukimcuong);
		$('#showtennhomnguyenlieukimcuong'+idshow).html(showtennhomnguyenlieukimcuong);
		$('#tennguyenlieukimcuong'+idshow).val(idtennguyenlieukimcuong);
		$('#showtennguyenlieukimcuong'+idshow).html(showtennguyenlieukimcuong);
	}
	else{
		$('#nhomnguyenlieukimcuong'+idshow).val(0);
		$('#showtennhomnguyenlieukimcuong'+idshow).html('');
		$('#tennguyenlieukimcuong'+idshow).val(0);
		$('#showtennguyenlieukimcuong'+idshow).html('');	
	}	
	$.fancybox.close();
}
	
<?php echo '</script'; ?>
><?php }
}
