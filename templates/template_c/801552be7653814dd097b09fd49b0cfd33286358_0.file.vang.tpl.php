<?php
/* Smarty version 4.1.1, created on 2023-09-23 14:36:44
  from 'C:\wamp64\www\duan_demo\templates\tpl\popup\DanhMucNguyenLieu\vang.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650e958c4d79e1_46774399',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '801552be7653814dd097b09fd49b0cfd33286358' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\popup\\DanhMucNguyenLieu\\vang.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650e958c4d79e1_46774399 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="main-popup">
	<div class="box-thongin box-thongin-popup">
    <div class="title-thongtin ">Nhóm Nguyên Liệu</div>
    <h2>Nguyên Liệu Vàng</h2>
    <div class="SubAll">
        <div class="SubLeft">
            Nhóm Nguyên Liệu Vàng
        </div>
        <div class="SubRight">
            <select name='idnhomnguyenlieuvang' id='idnhomnguyenlieuvang' onchange="getTenNguyenLieuVang(this.value)">
                <option value="0">---------Chọn Nhóm Nguyên liệu Vàng---------</option>
                <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['nhomnguyenlieu']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                    <option <?php if ($_smarty_tpl->tpl_vars['nhomnguyenlieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'] == $_smarty_tpl->tpl_vars['nhomnguyenlieuvangactive']->value) {?>selected="selected"<?php }?>value="<?php echo $_smarty_tpl->tpl_vars['nhomnguyenlieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
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
            Tên Nguyên Liệu vàng
        </div>
        <div class="SubRight">
            <select name='idtennguyenlieuvang' id='idtennguyenlieuvang'>  </select>
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
<?php if ($_smarty_tpl->tpl_vars['tennguyenlieuvangactive']->value > 0) {?>
	
	$(document).ready(function() {				   
		getTenNguyenLieuVang('<?php echo $_smarty_tpl->tpl_vars['nhomnguyenlieuvangactive']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['tennguyenlieuvangactive']->value;?>
');
	});
<?php }?>
function getTenNguyenLieuVang(id,idselect){
	$.post('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/ajax/loadDanhMucNguyenLieu.php',{id:id,idselect:idselect},function(data) {
		 var obj = jQuery.parseJSON(data);
		 $('#idtennguyenlieuvang').html(obj.status);
	});
	return false;		
}

function resetdl(){
	var numdong = '<?php echo $_smarty_tpl->tpl_vars['idshow']->value;?>
';
	$('#idnhomnguyenlieuvang').val(0); 
	$('#idtennguyenlieuvang').val(0);
	
	$('#nhomnguyenlieuvang'+numdong).val(0);
	$('#showtennhomnguyenlieuvang'+numdong).html('Click chọn');
	$('#tennguyenlieuvang'+numdong).val(0);
	$('#showtennguyenlieuvang'+numdong).html('');
	$.fancybox.close();	
}
	
function geteditDataBCTC(idshow){
	var nhomnguyenlieuvang = $('#idnhomnguyenlieuvang').val();
	if(nhomnguyenlieuvang != 0){
		var nhomnguyenlieuvangsplit = nhomnguyenlieuvang.split(';');
		var idnhomnguyenlieuvang = nhomnguyenlieuvangsplit[0];
		var showtennhomnguyenlieuvang = nhomnguyenlieuvangsplit[1];
		
		var tennguyenlieuvang = $('#idtennguyenlieuvang').val();
		var tennguyenlieuvangsplit = tennguyenlieuvang.split(';');
		var idtennguyenlieuvang = tennguyenlieuvangsplit[0];
		var showtennguyenlieuvang = tennguyenlieuvangsplit[1];
		
	
		$('#nhomnguyenlieuvang'+idshow).val(idnhomnguyenlieuvang);
		$('#showtennhomnguyenlieuvang'+idshow).html(showtennhomnguyenlieuvang);
		$('#tennguyenlieuvang'+idshow).val(idtennguyenlieuvang);
		$('#showtennguyenlieuvang'+idshow).html(showtennguyenlieuvang);
	}
	else{ //=0
		$('#nhomnguyenlieuvang'+idshow).val(0);
		$('#showtennhomnguyenlieuvang'+idshow).html('click chọn');
		$('#tennguyenlieuvang'+idshow).val(0);
		$('#showtennguyenlieuvang'+idshow).html('');	
	}

	$.fancybox.close();
}
	
<?php echo '</script'; ?>
><?php }
}
