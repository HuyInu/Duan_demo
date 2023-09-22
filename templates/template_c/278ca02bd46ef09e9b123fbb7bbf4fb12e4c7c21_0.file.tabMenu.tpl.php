<?php
/* Smarty version 4.1.1, created on 2023-09-22 15:13:09
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Nhap-Kho\tabMenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650d4c956f9e59_77968985',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '278ca02bd46ef09e9b123fbb7bbf4fb12e4c7c21' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Nhap-Kho\\tabMenu.tpl',
      1 => 1695370387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650d4c956f9e59_77968985 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="ChonLoaiPhieu">
    <ul>
        <li <?php if (!$_REQUEST['act']) {?>class="active"<?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?cid=<?php echo $_REQUEST['cid'];?>
" title="Tổng hộp">
                TỔNG HỢP
            </a>
        </li>
        <li <?php if ($_REQUEST['act'] == 'uninsertShow') {?>class="active"<?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?act=uninsertShow&cid=<?php echo $_REQUEST['cid'];?>
" title="Chờ nhập kho">
                CHỜ NHẬP KHO
            </a>
        </li>
        <li <?php if ($_REQUEST['act'] == 'insertedShow') {?>class="active"<?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?act=insertedShow&cid=<?php echo $_REQUEST['cid'];?>
" title="Đã xác nhận nhập kho">
                ĐÃ XÁC NHẬP NHẬP KHO
            </a>
        </li>
    </ul>
</div><?php }
}
