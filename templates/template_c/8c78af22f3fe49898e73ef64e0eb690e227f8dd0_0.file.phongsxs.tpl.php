<?php
/* Smarty version 4.1.1, created on 2023-05-08 13:55:33
  from 'D:\wamp64\www\duan_demo\templates\tpl\allsearch\phongsxs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64589ce562b939_40441510',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '8c78af22f3fe49898e73ef64e0eb690e227f8dd0' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\phongsxs.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64589ce562b939_40441510 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="siteIDload">
    <select name="phongsxs" id="phongsxs" class="abcd chonphonbanSanXuat">
         <option value="0">Chọn Phòng ban</option>
         <?php echo insert_optionChuyenDen(array('id' => '169,708'),$_smarty_tpl);?>
         <?php echo insert_optionKhoSanXuatChuyenDenPhong(array('id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id']),$_smarty_tpl);?>
         <?php echo insert_optionChuyenDen(array('id' => '708'),$_smarty_tpl);?> 
    </select> 
</div>
<?php echo '<script'; ?>
>
	$(function () {
		$("#siteIDload select").select2();
	});
<?php echo '</script'; ?>
>
<?php }
}
