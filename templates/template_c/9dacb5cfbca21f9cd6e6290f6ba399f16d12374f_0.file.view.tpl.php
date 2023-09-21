<?php
/* Smarty version 4.1.1, created on 2023-09-21 15:55:49
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Import\view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650c0515522315_33343347',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '9dacb5cfbca21f9cd6e6290f6ba399f16d12374f' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Import\\view.tpl',
      1 => 1695286546,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650c0515522315_33343347 (Smarty_Internal_Template $_smarty_tpl) {
?><link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.js"><?php echo '</script'; ?>
>

<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/search.css" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/jsapi.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/script.js"><?php echo '</script'; ?>
>
<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
       <?php echo insert_HearderCat(array('cid' => $_REQUEST['cid'], 'root' => $_REQUEST['root'], 'act' => $_REQUEST['act']),$_smarty_tpl);?>
    </ul>
</div>
<div class="MainContent">
    <div class="MainTable">
        <table class="table-bordered">
            <tr class="trheader" align="center">
                <td style="min-width:130px">
                    <strong>Trạng thái</strong>
                </td>
                <td style="min-width:93px">
                    <strong>Cửa hàng</strong>
                </td>
                <td style="min-width:130px">
                    <strong>Nơi đến</strong>
                </td>
                <td style="min-width:49px">
                    <strong>Nhân viên</strong>
                </td>
                <td style="min-width:90px">
                    <strong>Ngày</strong>
                </td>
                <td style="min-width:90px">
                    <strong>Ngày xác nhận</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Số phiếu</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Cửa hàng trước</strong>
                </td>
                <td style="min-width:42px">
                    <strong>STT</strong>
                </td>
                <td style="min-width:181px">
                    <strong>Ghi chú</strong>
                </td>
                <td style="min-width:76px">
                    <strong>Nhà cung cấp</strong>
                </td>
                <td style="min-width:50px">
                    <strong>Loại vàng</strong>
                </td>
                <td style="min-width:57px">
                    <strong>Loại nữ trang</strong>
                </td>
                <td style="min-width:59px">
                    <strong>Mã nữ trang</strong>
                </td>
                <td style="min-width:63px">
                    <strong>Mã cũ</strong>
                </td>
                <td style="min-width:50px">
                    <strong>Tên</strong>
                </td>
                <td style="min-width:46px">
                    <strong>GVH</strong>
                </td>
                <td style="min-width:60px">
                    <strong>TTL</strong>
                </td>
                <td style="min-width:60px">
                    <strong>TL Hột</strong>
                </td>
                <td style="min-width:60px">
                    <strong>TL Hột(Gr)</strong>
                </td>
                <td style="min-width:60px">
                    <strong>TL Vàng</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Tiền hột</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Tiền công</strong>
                </td>
                <td style="min-width:100px">
                    <strong>CVSP</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Tiền Đá/Ngọc trai</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Tiền công hột bán</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Thành tiền</strong>
                </td>
                <td style="min-width:100px">
                    <strong>MSM</strong>
                </td>
                <td style="min-width:261px">
                    <strong>Chi tiết hột tấm</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Chi tiết hột tấm thực tế</strong>
                </td>
                <td style="min-width:100px">
                    <strong>KH</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Mã số mẫu Catalogue 1</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Mã số mẫu Catalogue 2</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Giá bán</strong>
                </td>
                <td style="min-width:47px">
                    <strong>Số món</strong>
                </td>
                <td style="min-width:88px">
                    <strong>Mã Khuyến Mãi</strong>
                </td>
                <td style="min-width:100px">
                    <strong>Giá tạm tính</strong>
                </td>
            </tr>
            <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['view']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
            <tr>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['trangthaixacnhan'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cuahang'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['noiden'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhanvien'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['date'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datexacnhan'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['sophieu'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cuahangtruoc'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['STT'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichu'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhacungcap'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['loainutrang'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['manutrang'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['macu'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ten'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['gvh'];?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'],3);?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3);?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannanghgr'],3);?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'],3);?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienh']);?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tiencong']);?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cvsp']);?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tiendangoctrai']);?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienconghotban']);?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['thanhtien']);?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['msm'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['chitiethottam'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['chitiethottamthucte'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['kh'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['catalogue1'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['catalogue2'];?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['giaban']);?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['slmon'];?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['makhuyenmai'];?>

                </td>
                <td>
                    <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['giatamtinh']);?>

                </td>
            </tr>
            <?php
}
}
?>
        </table>
    </div>
</div><?php }
}
