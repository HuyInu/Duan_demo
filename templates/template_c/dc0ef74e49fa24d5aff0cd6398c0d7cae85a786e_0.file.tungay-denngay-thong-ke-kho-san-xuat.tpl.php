<?php
/* Smarty version 4.1.1, created on 2023-08-26 08:04:37
  from 'C:\wamp64\www\duan_demo\templates\tpl\allsearch\tungay-denngay-thong-ke-kho-san-xuat.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e94fa594a199_84201022',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dc0ef74e49fa24d5aff0cd6398c0d7cae85a786e' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\tungay-denngay-thong-ke-kho-san-xuat.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e94fa594a199_84201022 (Smarty_Internal_Template $_smarty_tpl) {
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
     <select class="selectOption" id="idloaivang" name="idloaivang" >
         <option value="">--Chọn loại vàng--</option>
         <?php
$__section_i_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['typegold']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_1_total = $__section_i_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_1_total !== 0) {
for ($__section_i_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_1_iteration <= $__section_i_1_total; $__section_i_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['typegold']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['idloaivang']->value == $_smarty_tpl->tpl_vars['typegold']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id']) {?>selected="selected"<?php }?>>
                <?php echo $_smarty_tpl->tpl_vars['typegold']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

            </option>
         <?php
}
}
?>
    </select>
</div>

<div class="formsearch formsearchend">    
    <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="Tìm kiếm" type="submit"> 
    <input type="button" name="reset" value=" Làm mới " onclick=" return resetsfrsearchdecuc();" class="btn-save btn-search"/>
</div><?php }
}
