<?php
/* Smarty version 4.1.1, created on 2023-05-09 07:43:19
  from 'D:\wamp64\www\duan_demo\templates\tpl\allsearch\chonnhomnguyenlieus.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64599727d2d6c7_64720134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11bb3dd5315f136f8e343b17f80da1d6a4cd7720' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\chonnhomnguyenlieus.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64599727d2d6c7_64720134 (Smarty_Internal_Template $_smarty_tpl) {
?><select class="selectOption" name="nhomnguyenlieus" id="nhomnguyenlieus" onchange="getTenNguyenLieu(this.value,0)">
    <option value="">---------All---------</option>
    <?php
$__section_i_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['nhomnguyenlieu']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_2_total = $__section_i_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_2_total !== 0) {
for ($__section_i_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_2_iteration <= $__section_i_2_total; $__section_i_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
    	<option <?php if ($_smarty_tpl->tpl_vars['nhomnguyenlieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'] == $_smarty_tpl->tpl_vars['nhomnguyenlieus']->value) {?>selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['nhomnguyenlieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['nhomnguyenlieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>
 </option>
     <?php
}
}
?>
</select>
<?php echo '<script'; ?>
>
	<?php if ($_smarty_tpl->tpl_vars['nhomnguyenlieus']->value > 0) {?>
		$(document).ready(function() {
			getTenNguyenLieu('<?php echo $_smarty_tpl->tpl_vars['nhomnguyenlieus']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['tennguyenlieus']->value;?>
');
		});
	<?php }?>

	function getTenNguyenLieu(id,idselect){
		$.post('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/ajax/loadDanhMucNguyenLieu.php',{act:'searchTenNguyenLieu',id:id,idselect:idselect},function(data) {
			 var obj = jQuery.parseJSON(data);
			 $('#tennguyenlieus').html(obj.status);
		});
	}
<?php echo '</script'; ?>
><?php }
}
