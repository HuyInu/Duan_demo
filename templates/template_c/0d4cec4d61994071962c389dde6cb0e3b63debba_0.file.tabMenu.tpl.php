<?php
/* Smarty version 4.1.1, created on 2023-09-23 09:22:27
  from 'C:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Nhap-Kho\tabMenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650e4be36305f0_11129746',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0d4cec4d61994071962c389dde6cb0e3b63debba' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Nhap-Kho\\tabMenu.tpl',
      1 => 1695434854,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650e4be36305f0_11129746 (Smarty_Internal_Template $_smarty_tpl) {
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
