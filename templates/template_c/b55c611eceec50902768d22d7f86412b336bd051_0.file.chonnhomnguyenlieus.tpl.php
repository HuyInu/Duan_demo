<?php
/* Smarty version 4.1.1, created on 2023-08-19 16:12:47
  from 'C:\wamp64\www\duan_demo\templates\tpl\allsearch\chonnhomnguyenlieus.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e0878f3d3083_14858436',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b55c611eceec50902768d22d7f86412b336bd051' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\chonnhomnguyenlieus.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e0878f3d3083_14858436 (Smarty_Internal_Template $_smarty_tpl) {
?><select class="selectOption" name="nhomnguyenlieus" id="nhomnguyenlieus" onchange="getTenNguyenLieu(this.value,0)">
    <option value="">---------All---------</option>
    <?php
$__section_i_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['nhomnguyenlieu']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_1_total = $__section_i_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_1_total !== 0) {
for ($__section_i_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_1_iteration <= $__section_i_1_total; $__section_i_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
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
