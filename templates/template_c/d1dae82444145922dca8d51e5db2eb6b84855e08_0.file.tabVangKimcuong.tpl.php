<?php
/* Smarty version 4.1.1, created on 2023-08-23 13:06:48
  from 'D:\wamp64\www\duan_demo\templates\tpl\allsearch\tabVangKimcuong.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e5a1f88994a7_42486829',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd1dae82444145922dca8d51e5db2eb6b84855e08' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\tabVangKimcuong.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e5a1f88994a7_42486829 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="ChonLoaiPhieu">
    <ul>
        <li class="active" id="clickVang" onclick="clickVang()">
            <a>Vàng </a>
        </li>
        <li id="clickKimCuong" onclick="clickKimCuong()">
            <a>Kim Cương</a>
        </li>
    </ul>
    <input type="hidden" name="nhomdm" value="<?php echo $_smarty_tpl->tpl_vars['nhomdanhmuc']->value['id'];?>
" /> 
</div><?php }
}
