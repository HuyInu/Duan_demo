<?php
/* Smarty version 4.1.1, created on 2023-09-27 08:56:34
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Xuat-Kho\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_65138bd28f6595_17155158',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'c6e5779665e0fd016828be23c3afef3518aaa0c0' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Xuat-Kho\\edit.tpl',
      1 => 1695779244,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65138bd28f6595_17155158 (Smarty_Internal_Template $_smarty_tpl) {
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
	<form name="f" id="f" method="post" action="Kho-Nu-Trang-Tra-Ve-Xuat-Kho?act=<?php if ($_REQUEST['act'] == 'add') {?>addsm<?php } else { ?>editsm<?php }?>&cid=<?php echo $_REQUEST['cid'];?>
">
        <div class="main-content padding-topfooter">
            <div class="panel-left">
                <div class="box-thongin">
                    <div class="title-thongtin">Thông Tin Phiếu</div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Ngày xuất kho:
                        </div>
                        
                        <div class="SubRight">
                            <input  type="text" value="<?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value['dated'];?>
" name="datedxuat" class="InputText" readonly/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Mã phiếu xuất kho:
                        </div>
                        
                        <div class="SubRight">
                            <input value="<?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value['maphieu'];?>
" name="maphieu" class="InputText"  autocomplete="off" readonly/>
                        </div>
                    </div>

                    <div class="SubAll">
                        <div class="SubLeft">
                            Mã phiếu trả kho:
                        </div>
                        
                        <div class="SubRight">
                            <select id="sophieu" name="sophieu" onchange="LoadDuLieuHangTraKho(<?php echo $_REQUEST['cid'];?>
, <?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value['id'];?>
)">
                                <option value="0" selected disabled>Chọn mã phiếu trả kho</option>
                                <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sophieu']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['sophieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)];?>
" <?php if ($_smarty_tpl->tpl_vars['phieuXuat']->value['maphieutrakho'] == $_smarty_tpl->tpl_vars['sophieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['sophieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)];?>
</option>
                                <?php
}
}
?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                </div>
            </div>
            <div class="panel-right">
                <div class="box-thongin">
                    <div class="title-thongtin">Thông Tin Xuất</div>
                    
                    <div>
                        <div class="panel-left">
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Nhóm Nguyên Liệu:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="hidden" name="nhomnguyenlieuvang" id="nhomnguyenlieuvang" value="<?php echo $_smarty_tpl->tpl_vars['viewedi']->value['nhomnguyenlieuvang'];?>
" />
                                    <a id="popupNhomDanhMucVang" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/popup/DanhMucNguyenLieu.php?type=vang&idnhomdm=<?php echo $_smarty_tpl->tpl_vars['nhomdanhmuc']->value['id'];?>
&idnhomnguyenlieuvang=<?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value['nhomnguyenlieuvang'];?>
&idtennguyenlieuvang=<?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value['tennguyenlieuvang'];?>
&idshow=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
">
                                        <span id="showtennhomnguyenlieuvang">
                                            <?php if ($_smarty_tpl->tpl_vars['phieuXuat']->value['nhomnguyenlieuvang'] > 0) {?>
                                                <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['phieuXuat']->value['nhomnguyenlieuvang']),$_smarty_tpl);?>
                                            <?php } else { ?>
                                                Click chọn
                                            <?php }?>    
                                        </span>
                                    </a>
                                    <?php echo '<script'; ?>
 type="text/javascript">
                                       $(document).ready(function() {
                                            $("#popupNhomDanhMucVang").fancybox();
                                        }); 
                                    <?php echo '</script'; ?>
>
                                </div>
                            </div>
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Tên Nguyên Liệu:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="hidden" name="tennguyenlieuvang" id="tennguyenlieuvang" value="" />
                                    <span id="showtennguyenlieuvang">
                                        <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['phieuXuat']->value['tennguyenlieuvang']),$_smarty_tpl);?>
                                    </span>
                                </div>
                            </div>
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Loại vàng:
                                </div>
                                
                                <div class="SubRight">
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
" <?php if ($_smarty_tpl->tpl_vars['phieuXuat']->value['idloaivang'] == $_smarty_tpl->tpl_vars['typegold']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id']) {?>selected="selected"<?php }?>>
                                            <?php echo $_smarty_tpl->tpl_vars['typegold']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                                        </option>
                                        <?php
}
}
?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="panel-right">
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng V+H:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld autoNumeric" autocomplete="off" name="cannangvh" id="cannangvh" value="<?php echo number_format($_smarty_tpl->tpl_vars['phieuXuat']->value['cannangvh'],3,".",",");?>
" onchange="getslcannangv('')"/>
                                </div>
                            </div>

                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng H:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld autoNumeric" autocomplete="off" name="cannangh" id="cannangh" value="<?php echo number_format($_smarty_tpl->tpl_vars['phieuXuat']->value['cannangh'],3,".",",");?>
" onchange="getslcannangv('')"/>
                                </div>
                            </div>

                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng V:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld autoNumeric" autocomplete="off" name="cannangv" id="cannangv" value="<?php echo number_format($_smarty_tpl->tpl_vars['phieuXuat']->value['cannangv'],3,".",",");?>
"/>
                                </div>
                            </div>
  
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Ghi chú:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="" autocomplete="off" name="ghichu" id="ghichu" value="<?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value['ghichu'];?>
"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="box-thongin">
            <div class="title-thongtin">Nội Dung (Dữ liệu chuyển hàng trả kho)</div>
            <div class="MainTable">
                <table class="table-bordered" id="DataTable">
                    <tr id="headTableData" class="trheader" align="center">
                        <td style="min-width:30px"></td>
                        <td style="min-width:64px">
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
                        <td style="min-width:84px">
                            <strong>Ngày</strong>
                        </td>
                        <td style="min-width:84px">
                            <strong>Ngày xác nhận</strong>
                        </td>
                        <td style="min-width:74px">
                            <strong>Số phiếu</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Cửa hàng trước</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>STT</strong>
                        </td>
                        <td style="min-width:129px">
                            <strong>Ghi chú</strong>
                        </td>
                        <td style="min-width:67px">
                            <strong>Nhà cung cấp</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Loại vàng</strong>
                        </td>
                        <td style="min-width:53px">
                            <strong>Loại nữ trang</strong>
                        </td>
                        <td style="min-width:53px">
                            <strong>Mã nữ trang</strong>
                        </td>
                        <td style="min-width:53px">
                            <strong>Mã cũ</strong>
                        </td>
                        <td style="min-width:53px">
                            <strong>Tên</strong>
                        </td>
                        <td style="min-width:129px">
                            <strong>Ghi chú</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>GVH</strong>
                        </td>
                        <td style="min-width:50px">
                            <strong>TTL</strong>
                        </td>
                        <td style="min-width:50px">
                            <strong>TL Hột</strong>
                        </td>
                        <td style="min-width:50px">
                            <strong>TL Hột(Gr)</strong>
                        </td>
                        <td style="min-width:50px">
                            <strong>TL Vàng</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Tiền hột</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Tiền công</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>CVSP</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Tiền Đá/Ngọc trai</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Tiền công hột bán</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Thành tiền</strong>
                        </td>
                        <td style="min-width:109px">
                            <strong>MSM</strong>
                        </td>
                        <td style="min-width:126px">
                            <strong>Chi tiết hột tấm</strong>
                        </td>
                        <td style="min-width:126px">
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
                        <td style="min-width:83px">
                            <strong>Giá bán</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Số món</strong>
                        </td>
                        <td style="min-width:30px">
                            <strong>Khuyến mãi</strong>
                        </td>
                        <td style="min-width:83px">
                            <strong>Giá tạm tính</strong>
                        </td>
                    </tr>
                    <?php $_smarty_tpl->_assignInScope('tongCannangvh', 0);?>
                    <?php $_smarty_tpl->_assignInScope('tongCannangh', 0);?>
                    <?php $_smarty_tpl->_assignInScope('tongCannangv', 0);?>
                    <?php $_smarty_tpl->_assignInScope('tongTienCong', 0);?>
                    <?php
$__section_i_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['phieuCt']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_2_total = $__section_i_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_2_total !== 0) {
for ($__section_i_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_2_iteration <= $__section_i_2_total; $__section_i_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                    <tr>
                        <td>
                            <input class='check-phieu' type='checkbox' id='check<?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
' name='idPhieuCt[]' value='<?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
' cannangvh='<?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'],3,".",",");?>
' cannangh='<?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3,".",",");?>
' cannangv='<?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'],3,".",",");?>
' onchange='getCell(this)' <?php if ((int)$_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idctnx'] != 0) {?>checked<?php }?>/>
                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['trangthaixacnhan'] == 1 ? "Đã xác nhận" : "Chưa xác nhận";?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cuahang'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['noiden'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhanvien'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dated'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datedxacnhan'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['sophieu'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cuahangtruoc'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['STT'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichu'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhacungcap'];?>

                        </td>
                        <td>
                            
                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['loainutrang'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['manutrang'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['macu'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ten'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichu2'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['gvh'];?>

                        </td>
                        <td>
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'],3,".",",");?>

                        </td>
                        <td>
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3,".",",");?>

                        </td>
                        <td>
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannanghgr'],3,".",",");?>

                        </td>
                        <td>
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'],3,".",",");?>

                        </td>
                        <td>
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienh']);?>

                        </td>
                        <td>
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tiencong']);?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cvsp'];?>

                        </td>
                        <td>
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tiendangoctrai']);?>

                        </td>
                        <td>
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienconghotban']);?>

                        </td>
                        <td>
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['thanhtien']);?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['msm'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['chitiethottam'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['chitiethottamthucte'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['kh'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['catalogue1'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['catalogue2'];?>

                        </td>
                        <td>
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['giaban']);?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['slmon'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['makhuyenmai'];?>

                        </td>
                        <td>
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['giatamtinh']);?>

                        </td>
                        <?php $_smarty_tpl->_assignInScope('tongCannangvh', $_smarty_tpl->tpl_vars['tongCannangvh']->value+$_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh']);?>
                        <?php $_smarty_tpl->_assignInScope('tongCannangh', $_smarty_tpl->tpl_vars['tongCannangh']->value+$_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh']);?>
                        <?php $_smarty_tpl->_assignInScope('tongCannangv', $_smarty_tpl->tpl_vars['tongCannangv']->value+$_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv']);?>
                        <?php $_smarty_tpl->_assignInScope('tongTienCong', $_smarty_tpl->tpl_vars['tongTienCong']->value+$_smarty_tpl->tpl_vars['phieuCt']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tiencong']);?>
                    </tr>
                    <?php
}
}
?>
                    <tr class='trfooter'>
                        <td align="right" colspan="19"> <strong class="colorXanh">Tổng:</strong> </td>
                        <td align="left"><span class="colorXanh" id="tongCannangVH"><?php echo number_format($_smarty_tpl->tpl_vars['tongCannangvh']->value,3,".",",");?>
</span></td>
                        <td align="left"><span class="colorXanh" id="tongCannangH"><?php echo number_format($_smarty_tpl->tpl_vars['tongCannangh']->value,3,".",",");?>
</span></td>
                        <td></td>
                        <td align="left"><span class="colorXanh" id="tongCannangV"><?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
</span></td>
                        <td align="left"></td>
                        <td align="left"><span class="colorXanh" id="tongTienCong"><?php echo number_format($_smarty_tpl->tpl_vars['tongTienCong']->value);?>
</span></td>
                        <td colspan="14"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="MainContent TextCenter"> 
        	<input type="hidden" name="idPhieuXuat" value="<?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value['id'];?>
" />
            <input type="button" class="btn-save" onclick=" return submitKhoNuTrangTraVe()" value="  Lưu " /> 
        </div>
    </form>
</div>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/autoNumeric.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/functions/function.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/fancybox/jquery.fancybox-1.3.1.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/fancybox/jquery.fancybox-1.3.1.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/popup/dialog.css">
<?php echo '<script'; ?>
>
    function LoadDuLieuHangTraKho (cid, idPhieu) {
        const sophieu = $('#sophieu').val();
        $('#loadingAjax').show();
        $.post('Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php',
            {
                idPhieu: idPhieu,
                act:'loaddulieutrakho',
                cid:cid,
                sophieu: sophieu
            },
            function(data) {
                var obj = jQuery.parseJSON(data);
                if (obj.status == 'success') {
                    let data = null;
                    $('#DataTable tr:not(.trheader):not(.trfooter)').remove();
                    $('#headTableData').after(obj.html);
                    $('#tongCannangVH').html(obj.tong.tongCannangVH)
                    $('#tongCannangH').html(obj.tong.tongCannangH)
                    $('#tongCannangV').html(obj.tong.tongCannangV)
                    $('#tongTienCong').html(obj.tong.tongTienCong)
                    const checkedCboxAmount = $('.check-phieu:checkbox:checked').length
                    if (checkedCboxAmount > 0) {
                        restoreCannang()
                    } else {
                        resetCannang()
                    }
                    $('#loadingAjax').hide();
                } else {
                    $('#loadingAjax').hide();
                    alert(obj.status);	 
                }
        });
    }
    function getCell (evt) {
        const thisCheckbox = $(evt)
        const cannangvhTbox = $('#cannangvh')
        const cannanghTbox = $('#cannangh')
        const cannangvh = thisCheckbox.attr('cannangvh')
        const cannangh = thisCheckbox.attr('cannangh')
        let cannangvhPlus = 0
        let cannanghPlus = 0
        if (thisCheckbox.prop('checked') == true) {
            cannangvhPlus = parseFloat(cannangvhTbox.val() === '' ? 0 : cannangvhTbox.val()) + parseFloat(cannangvh)
            cannanghPlus = parseFloat(cannanghTbox.val() === '' ? 0 : cannanghTbox.val()) + parseFloat(cannangh)
            
        } else {
            cannangvhPlus = parseFloat(cannangvhTbox.val() === '' ? 0 : cannangvhTbox.val()) - parseFloat(cannangvh)
            cannanghPlus = parseFloat(cannanghTbox.val() === '' ? 0 : cannanghTbox.val()) - parseFloat(cannangh)
        }
        cannangvhTbox.val(number_format(cannangvhPlus, 3, ","))
        cannanghTbox.val(number_format(cannanghPlus, 3, ","))
        getslcannangv('')
    }
    function number_format (number,decimalPosition, thousands_separator) {
        return roundNumber(number, decimalPosition).toFixed(decimalPosition).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, thousands_separator)
    }
    function resetCannang () {
        $('#cannangvh').val('0.000')
        $('#cannangh').val('0.000')
        $('#cannangv').val('0.000')
    }
    function restoreCannang () {
        $('#cannangvh').val(<?php echo number_format($_smarty_tpl->tpl_vars['phieuXuat']->value['cannangvh'],3,".",",");?>
)
        $('#cannangh').val(<?php echo number_format($_smarty_tpl->tpl_vars['phieuXuat']->value['cannangh'],3,".",",");?>
)
        $('#cannangv').val(<?php echo number_format($_smarty_tpl->tpl_vars['phieuXuat']->value['cannangv'],3,".",",");?>
)
    }            
    function roundNumber(num, scale) {
        if(!("" + num).includes("e")) {
            return +(Math.round(num + "e+" + scale)  + "e-" + scale);
        } else {
            var arr = ("" + num).split("e");
            var sig = ""
            if(+arr[1] + scale > 0) {
            sig = "+";
            }
            return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
        }
    }
    function submitKhoNuTrangTraVe () {
        let tongCanNangVSelected = 0
        const canNangV = roundNumber(parseFloat($('#cannangv').val()), 3)
        $('.check-phieu:checkbox:checked').each(function () {
            tongCanNangVSelected += roundNumber(parseFloat($(this).attr('cannangv')), 3)
        });
        if (canNangV !== tongCanNangVSelected) {
            alert('Tổng cân nặng vàng phiếu được chọn phải bằng với cân nặng vàng trên thông tin xuất.')
            return
        }
        if ($('#sophieu').val() === null) {
            alert('Vui lòng chọn mã phiếu trả kho.')
            return
        }
        document.forms.f.submit()
    }
<?php echo '</script'; ?>
><?php }
}
