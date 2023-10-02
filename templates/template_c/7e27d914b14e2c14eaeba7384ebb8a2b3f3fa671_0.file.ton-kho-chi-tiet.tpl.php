<?php
/* Smarty version 4.1.1, created on 2023-10-02 07:43:20
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Thong-Ke\ton-kho-chi-tiet.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_651a12284ce110_80914362',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '7e27d914b14e2c14eaeba7384ebb8a2b3f3fa671' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Thong-Ke\\ton-kho-chi-tiet.tpl',
      1 => 1696207394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_651a12284ce110_80914362 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\wamp64\\www\\duan_demo\\libraries\\smarty4\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
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
	<form name="f" id="f" method="post" onsubmit="return searchKhoNuTrangTraVe('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Thong-Ke.php?act=<?php echo $_REQUEST['act'];?>
&tab=<?php echo $_REQUEST['tab'];?>
&cid=<?php echo $_REQUEST['cid'];?>
')">
        <div class="MainSearch">
            <div class="formsearch">
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
                <input class="btn-save btn-search" value="Tìm kiếm" type="submit"> 
                <input type="button" name="reset" value=" Làm mới " onclick="ResetSearch();" class="btn-save btn-search"/>
                <input type="button" name="print" value="     In     " class="btn-save btn-search"/>
            </div>
        </div>
        <div class="ChonLoaiPhieu">
            <ul>
                <li <?php if (($_REQUEST['tab'] == 'dangtonkho') || (!$_REQUEST['tab'])) {?>class="active"<?php }?>>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Thong-Ke.php?act=ChiTietTon&tab=dangtonkho&cid=<?php echo $_REQUEST['cid'];?>
" title="Tổng hộp">
                        ĐANG TỒN KHO
                    </a>
                </li>
                <li <?php if ($_REQUEST['tab'] == 'daxuatkho') {?>class="active"<?php }?>>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Thong-Ke.php?act=ChiTietTon&tab=daxuatkho&cid=<?php echo $_REQUEST['cid'];?>
" title="Chờ nhập kho">
                        ĐÃ XUẤT KHO
                    </a>
                </li>
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
                        <td style="min-width:181px">
                            <strong>Ghi chú</strong>
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
                        <td style="min-width:100px">
                            <strong>Số phiếu nhập kho</strong>
                        </td>
                        <td style="min-width:100px">
                            <strong>NV nhập kho</strong>
                        </td>
                        <td style="min-width:100px">
                            <strong>Ngày/giờ duyệt nhập kho</strong>
                        </td>
                        <td style="min-width:100px">
                            <strong>Mã phiếu Import</strong>
                        </td>
                        <td style="min-width:100px">
                            <strong>NV Import</strong>
                        </td>
                        <td style="min-width:100px">
                            <strong>Ngày import</strong>
                        </td>
                        <td style="min-width:100px">
                            <strong>Giờ import</strong>
                        </td>
                        <td style="min-width:100px">
                            <strong>Số phiếu  xuất kho</strong>
                        </td>
                        <td style="min-width:100px">
                            <strong>NV duyệt xuất kho</strong>
                        </td>
                        <td style="min-width:100px">
                            <strong>Ngày/ giờ xuất kho</strong>
                        </td>
                        <td style="min-width:100px">
                            <strong>Tổ SX nhận xuất kho</strong>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch text-right" name="cuahangs" id="cuahangs" value="<?php echo $_smarty_tpl->tpl_vars['cuahangs']->value;?>
" placeholder="Cửa hàng..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch text-right" name="noidens" id="noidens" value="<?php echo $_smarty_tpl->tpl_vars['noidens']->value;?>
" placeholder="Nơi đến..." autocomplete="off"/>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textsearchdated" name="dateds" id="dateds" value="<?php echo $_smarty_tpl->tpl_vars['dateds']->value;?>
" placeholder="Ngày..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textsearchdated" name="datedxacnhans" id="datedxacnhans" value="<?php echo $_smarty_tpl->tpl_vars['datedxacnhans']->value;?>
" placeholder="Ngày..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="sophieus" id="sophieus" value="<?php echo $_smarty_tpl->tpl_vars['sophieus']->value;?>
" placeholder="Số phiếu..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="cuahangtruocs" id="cuahangtruocs" value="<?php echo $_smarty_tpl->tpl_vars['cuahangtruocs']->value;?>
" placeholder="Cửa hàng trước..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="STTs" id="STTs" value="<?php echo $_smarty_tpl->tpl_vars['STTs']->value;?>
" placeholder="STT..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="ghichus" id="ghichus" value="<?php echo $_smarty_tpl->tpl_vars['ghichus']->value;?>
" placeholder="Ghi chú..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="nhacungcaps" id="nhacungcaps" value="<?php echo $_smarty_tpl->tpl_vars['nhacungcaps']->value;?>
" placeholder="Nhà cung cấp..." autocomplete="off"/>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="macus" id="macus" value="<?php echo $_smarty_tpl->tpl_vars['macus']->value;?>
" placeholder="Mã cũ..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="tens" id="tens" value="<?php echo $_smarty_tpl->tpl_vars['tens']->value;?>
" placeholder="Tên..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="ghichu2s" id="ghichu2s" value="<?php echo $_smarty_tpl->tpl_vars['ghichu2s']->value;?>
" placeholder="Ghi chú..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="gvhs" id="gvhs" value="<?php echo $_smarty_tpl->tpl_vars['gvhs']->value;?>
" placeholder="GVH..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannangvhs" id="cannangvhs" value="<?php echo $_smarty_tpl->tpl_vars['cannangvhs']->value;?>
" placeholder="Trọng lượng..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannanghs" id="cannanghs" value="<?php echo $_smarty_tpl->tpl_vars['cannanghs']->value;?>
" placeholder="TL hột..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannanghgrs" id="cannanghgrs" value="<?php echo $_smarty_tpl->tpl_vars['cannanghgrs']->value;?>
" placeholder="TL hột GR..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannangvs" id="cannangvs" value="<?php echo $_smarty_tpl->tpl_vars['cannangvs']->value;?>
" placeholder="TL vàng..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tienhs" id="tienhs" value="<?php echo $_smarty_tpl->tpl_vars['tienhs']->value;?>
" placeholder="Tiền hột..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tiencongs" id="tiencongs" value="<?php echo $_smarty_tpl->tpl_vars['tiencongs']->value;?>
" placeholder="Tiền công..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cvsps" id="cvsps" value="<?php echo $_smarty_tpl->tpl_vars['cvsps']->value;?>
" placeholder="CVSP..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tiendangoctrais" id="tiendangoctrais" value="<?php echo $_smarty_tpl->tpl_vars['tiendangoctrais']->value;?>
" placeholder="Tiền đá/ngọc trai..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tienconghotbans" id="tienconghotbans" value="<?php echo $_smarty_tpl->tpl_vars['tienconghotbans']->value;?>
" placeholder="Tiền công hột bán..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="thanhtiens" id="thanhtiens" value="<?php echo $_smarty_tpl->tpl_vars['thanhtiens']->value;?>
" placeholder="Thành tiền..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="msms" id="msms" value="<?php echo $_smarty_tpl->tpl_vars['msms']->value;?>
" placeholder="MSM..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="chitiethottams" id="chitiethottams" value="<?php echo $_smarty_tpl->tpl_vars['chitiethottams']->value;?>
" placeholder="Chi tiết hột tấm..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="chitiethottamthuctes" id="chitiethottamthuctes" value="<?php echo $_smarty_tpl->tpl_vars['chitiethottamthuctes']->value;?>
" placeholder="Hột tấm thực tế..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="khs" id="khs" value="<?php echo $_smarty_tpl->tpl_vars['khs']->value;?>
" placeholder="KH..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="catalogue1s" id="catalogue1s" value="<?php echo $_smarty_tpl->tpl_vars['catalogue1s']->value;?>
" placeholder="Catalogue 1..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="catalogue2s" id="catalogue2s" value="<?php echo $_smarty_tpl->tpl_vars['catalogue2s']->value;?>
" placeholder="Catalogue 2..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="giabans" id="giabans" value="<?php echo $_smarty_tpl->tpl_vars['giabans']->value;?>
" placeholder="Giá bán..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="slmons" id="slmons" value="<?php echo $_smarty_tpl->tpl_vars['slmons']->value;?>
" placeholder="Số món..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="makhuyenmais" id="makhuyenmais" value="<?php echo $_smarty_tpl->tpl_vars['makhuyenmais']->value;?>
" placeholder="Mã khuyến mãi..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="giatamtinhs" id="giatamtinhs" value="<?php echo $_smarty_tpl->tpl_vars['giatamtinhs']->value;?>
" placeholder="Mã khuyến mãi..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="maphieusubs" id="maphieusubs" value="<?php echo $_smarty_tpl->tpl_vars['maphieusubs']->value;?>
" placeholder="Mã phiếu nhập..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="midsubs" id="midsubs" value="<?php echo $_smarty_tpl->tpl_vars['midsubs']->value;?>
" placeholder="Mã phiếu nhập..." autocomplete="off"/>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="maphieuimportsubs" id="maphieuimportsubs" value="<?php echo $_smarty_tpl->tpl_vars['maphieuimportsubs']->value;?>
" placeholder="Ngày Import..." autocomplete="off"/>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textsearchdated" name="datedimportsubs" id="datedimportsubs" value="<?php echo $_smarty_tpl->tpl_vars['datedimportsubs']->value;?>
" placeholder="Ngày Import..." autocomplete="off"/>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="maphieus" id="maphieus" value="<?php echo $_smarty_tpl->tpl_vars['maphieus']->value;?>
" placeholder="Mã phiếu xuất..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="mids" id="mids" value="<?php echo $_smarty_tpl->tpl_vars['mids']->value;?>
" placeholder="Mã phiếu xuất..." autocomplete="off"/>
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
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['trangthaixacnhan'] == 1 ? "Đã xác nhận" : "Chưa xác nhận";?>

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
                            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dated'],'%d/%m/%Y');?>

                        </td>
                        <td>
                            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datedxacnhan'],'%d/%m/%Y');?>

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
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichu2'];?>

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
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieu'];?>

                        </td>
                        <td>
                            <?php echo getName('admin','fullname',$_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['mid']);?>

                        </td>
                        <td>
                            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datednhap'],'%d/%m/%Y');?>
<br><?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['timenhap'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieuimport'];?>

                        </td>
                        <td>
                            <?php echo getName('admin','fullname',$_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['midimport']);?>

                        </td>
                        <td>
                            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datedimport'],'%d/%m/%Y');?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['timeimport'];?>

                        </td>
                        <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['trangthai'] == '2') {?>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieu'];?>

                        </td>
                        <td>
                            <?php echo getName('admin','fullname',$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['mid']);?>

                        </td>
                        <td>
                            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datedxuat'],'%d/%m/%Y');?>
<br><?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['timexuat'];?>

                        </td>
                        <td>
                        </td>
                        <?php } else { ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <?php }?>
                    </tr>
                    <?php
}
}
?>
                </table>
            </div>
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
><?php }
}
