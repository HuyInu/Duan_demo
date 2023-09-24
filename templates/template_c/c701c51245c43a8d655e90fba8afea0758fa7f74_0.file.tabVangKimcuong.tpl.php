<?php
/* Smarty version 4.1.1, created on 2023-09-23 14:37:16
  from 'C:\wamp64\www\duan_demo\templates\tpl\allsearch\tabVangKimcuong.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650e95ac7d3331_53620816',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c701c51245c43a8d655e90fba8afea0758fa7f74' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\allsearch\\tabVangKimcuong.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650e95ac7d3331_53620816 (Smarty_Internal_Template $_smarty_tpl) {
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
