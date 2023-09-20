<?php
/* Smarty version 4.1.1, created on 2023-09-20 11:07:14
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Huy-Kho-Test-Nhap-Kho\ton-kho-chi-tiet.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650a6ff2bacb34_50505769',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '31ac480812fc555a23fe58973c6831c038d2f529' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Huy-Kho-Test-Nhap-Kho\\ton-kho-chi-tiet.tpl',
      1 => 1695182832,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tungay-denngay.tpl' => 1,
  ),
),false)) {
function content_650a6ff2bacb34_50505769 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="breadcrumb">
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
	<form name="f" id="f" method="post" onsubmit="return "> 
        <div class="MainSearch">     
            <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tungay-denngay.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/==.php?act=print&cid=<?php echo $_REQUEST['cid'];?>
" title="In">
                <input type="button" name="print" value="In" class="btn-save btn-search"/>
            </a>
        </div>
        <div class="ChonLoaiPhieu">
            <ul>
                <li <?php if ($_REQUEST['act'] == '') {?>class="active"<?php }?>>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/==.php?cid=3228" title="Bảng Tính Giá">
                        Đang tồn kho
                    </a>
                </li>
                <li <?php if ($_REQUEST['act'] == '') {?>class="active"<?php }?>>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/==.php?act=BangTinhGiaChiTiet&cid=3228" title="Bảng Tính Giá Chi Tiết">
                        Đã xuất kho
                    </a>
                </li>
            </ul>
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader" align="center">
                    <td style="min-width:30px">
                        <strong>Trạng thái</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Cửa hàng</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Nơi đến</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Nhân viên</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Ngày</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Ngày xác nhận</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Số phiếu</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Cửa hàng trước</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>STT</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Ghi chú</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Nhà cung cấp</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Loại vàng</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Loại nữ trang</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Mã nữ trang</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Mã cũ</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Tên</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Ghi chú</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>GVH</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>TTL</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>TL Hột</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>TL Hột(Gr)</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>TL Vàng</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Tiền hột</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Tiền công</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>CVSP</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Tiền Đá/Ngọc trai</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Tiền công hột bán</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Thành tiền</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>MSM</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Chi tiết hột tấm</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Chi tiết hột tấm thực tế</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>KH</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Mã số mẫu Catalogue 1</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Mã số mẫu Catalogue 2</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Giá bán</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Số món</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Khuyến mãi</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Giá tạm tính</strong>
                    </td>
                </tr>
                <tr id="search">
                    <td>
                        <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm trạng thái"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm cửa hàng"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm nơi đến"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText textwsearch" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm nhân viên"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText textsearchdated" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm ngày"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText textsearchdated" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm ngày xác nhận"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm số phiếu"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm cửa hàng trước"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm STT"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm ghi chú"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm nhà cung cấp"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm STT"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm ghi chú"  autocomplete="off"/>
                    </td>
                    <td>
                        <?php echo insert_loadloaivang(array('idloaivang' => $_smarty_tpl->tpl_vars['loaivangs']->value, 'limitloaivang' => $_smarty_tpl->tpl_vars['limitLoaiVang']->value),$_smarty_tpl);?>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm mã cũ"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm tên"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm GVH"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm TTL"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm TL Hột"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm TL Hột(Gr)"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm TL Vàng"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm tiền hột"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm tiền công"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm CVSP"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm tiền Đá/Ngọc trai"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm tiền công hột bán"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm thành tiền"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm MSM"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm chi tiết hột tấm"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<?php echo $_smarty_tpl->tpl_vars['']->value;?>
" placeholder="Tìm chi tiết hột tấm"  autocomplete="off"/>
                    </td>
                </tr>
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="7"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
                    <td align="right"><strong class="colorXanh"><?php echo number_format($_smarty_tpl->tpl_vars['tongQ10']->value,3,".",",");?>
 </strong></td>
                </tr>
            </table>
        </div>
    </form>
</div>
<link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.js"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/autoNumeric.js"><?php echo '</script'; ?>
>
<link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/search.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/jsapi.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/script.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/tim-kiem.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
   $(function() {
      $(".textsearchdated").datepicker({changeMonth: true,changeYear: true,dateFormat:"dd/mm/yy"});	
   });
<?php echo '</script'; ?>
><?php }
}
