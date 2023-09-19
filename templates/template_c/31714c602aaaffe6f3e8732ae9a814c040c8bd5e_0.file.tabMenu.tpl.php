<?php
/* Smarty version 4.1.1, created on 2023-09-19 16:00:31
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Huy-Kho-Test-Nhap-Kho\tabMenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6509632f3a5eb9_55794052',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31714c602aaaffe6f3e8732ae9a814c040c8bd5e' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Huy-Kho-Test-Nhap-Kho\\tabMenu.tpl',
      1 => 1695114028,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6509632f3a5eb9_55794052 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="ChonLoaiPhieu">
    <ul>
        <li <?php if ($_REQUEST['act'] == '' || $_REQUEST['act'] == 'edit' || $_REQUEST['act'] == 'editTinhChatCapGia') {?>class="active"<?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/==.php?cid=3228" title="Bảng Tính Giá">
                TỔNG HỢP
            </a>
        </li>
        <li <?php if ($_REQUEST['act'] == 'BangTinhGiaChiTiet') {?>class="active"<?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/==.php?act=BangTinhGiaChiTiet&cid=3228" title="Bảng Tính Giá Chi Tiết">
                CHỜ NHẬP KHO
            </a>
        </li>
        <li <?php if ($_REQUEST['act'] == 'ToaHangNhaCungCap' || $_REQUEST['act'] == 'ToaHangNhaCungCapEdit') {?>class="active"<?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/==.php?act=ToaHangNhaCungCap&cid=3228" title="Bảng Tính Giá Chi Tiết">
                ĐÃ XÁC NHẬP NHẬP KHO
            </a>
        </li>
    </ul>
</div><?php }
}
