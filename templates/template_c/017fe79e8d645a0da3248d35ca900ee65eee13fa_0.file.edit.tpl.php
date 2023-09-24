<?php
/* Smarty version 4.1.1, created on 2023-09-23 15:40:32
  from 'C:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Xuat-Kho\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650ea480311612_30033423',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '017fe79e8d645a0da3248d35ca900ee65eee13fa' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Xuat-Kho\\edit.tpl',
      1 => 1695458426,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650ea480311612_30033423 (Smarty_Internal_Template $_smarty_tpl) {
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
	<form name="f" id="f" method="post" action="">
        <div class="main-content padding-topfooter">
            <div class="panel-left">
                <div class="box-thongin">
                    <div class="title-thongtin">Thông Tin Phiếu</div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Ngày xuất kho:
                        </div>
                        
                        <div class="SubRight">
                            <input  type="text" value="<?php echo $_smarty_tpl->tpl_vars['datedxuat']->value;?>
" name="datedxuat" class="InputText" readonly/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Mã phiếu xuất kho:
                        </div>
                        
                        <div class="SubRight">
                            <input value="<?php echo $_smarty_tpl->tpl_vars['maphieu']->value;?>
" name="maphieu" class="InputText"  autocomplete="off" readonly/>
                        </div>
                    </div>

                    <div class="SubAll">
                        <div class="SubLeft">
                            Mã phiếu trả kho:
                        </div>
                        
                        <div class="SubRight">
                            <select id="sophieu" name="sophieu" form="" onchange="LoadDuLieuHangTraKho(<?php echo $_REQUEST['cid'];?>
)">
                                <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sophieu']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['sophieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)];?>
"><?php echo $_smarty_tpl->tpl_vars['sophieu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)];?>
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
                                    <input type="hidden" name="nhomnguyenlieuvang[]" id="nhomnguyenlieuvang" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieuvang'];?>
" />
                                    <a id="popupNhomDanhMucVang" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/popup/DanhMucNguyenLieu.php?type=vang&idnhomdm=<?php echo $_smarty_tpl->tpl_vars['nhomdanhmuc']->value['id'];?>
&idnhomnguyenlieuvang=<?php echo $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieuvang'];?>
&idtennguyenlieuvang=<?php echo $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieuvang'];?>
&idshow=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>
">
                                        <span id="showtennhomnguyenlieuvang">
                                            <?php if ($_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieuvang'] > 0) {?>
                                                <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieuvang']),$_smarty_tpl);?>
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
                                        <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieuvang']),$_smarty_tpl);?>
                                    </span>
                                </div>
                            </div>
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Loại vàng:
                                </div>
                                
                                <div class="SubRight">
                                    <?php echo insert_loadloaivang(array('idloaivang' => $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang'], 'idnum' => (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1, 'limitloaivang' => $_smarty_tpl->tpl_vars['limitLoaiVang']->value),$_smarty_tpl);?>
                                </div>
                            </div>
                        </div>

                        <div class="panel-right">
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng V+H:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld autoNumeric" autocomplete="off" name="" id="" value="" />
                                </div>
                            </div>

                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng H:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld autoNumeric" autocomplete="off" name="" id="" value="" />
                                </div>
                            </div>

                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng V:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld autoNumeric" autocomplete="off" name="" id="" value="" />
                                </div>
                            </div>
  
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Ghi chú:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="" autocomplete="off" name="" id="" value="" />
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
                </table>
            </div>
        </div>
        <div class="MainContent TextCenter"> 
        	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['id'];?>
" />
            <input type="button" class="btn-save" onclick=" return " value="  Lưu " /> 
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
    function LoadDuLieuHangTraKho (cid) {
        const sophieu = $('#sophieu').val();
        $('#loadingAjax').show();
        $.post('Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php',
            {
                act:'loaddulieutrakho',
                cid:cid,
                sophieu: sophieu
            },
            function(data) {																				
                var obj = jQuery.parseJSON(data);
                if(obj.status == 'success'){
                    let data = null;
                    $('#DataTable tr:not(.trheader)').remove();
                    $.each(obj.phieu, function( index, phieu ) {
                        data += `<tr>
                                        <td></td>
                                        <td>
                                            <strong>Trạng thái</strong>
                                        </td>
                                        <td>
                                            ${phieu.cuahang}
                                        </td>
                                        <td>
                                            ${phieu.noiden}
                                        </td>
                                        <td>
                                            ${phieu.nhanvien}
                                        </td>
                                        <td>
                                            ${phieu.dated}
                                        </td>
                                        <td>
                                            ${phieu.datedxacnhan}
                                        </td>
                                        <td>
                                            ${phieu.sophieu}
                                        </td>
                                        <td>
                                            ${phieu.cuahangtruoc}
                                        </td>
                                        <td>
                                            ${phieu.STT}
                                        </td>
                                        <td>
                                            ${phieu.ghichu}
                                        </td>
                                        <td>
                                            ${phieu.nhacungcap}
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            <strong>Loại nữ trang</strong>
                                        </td>
                                        <td>
                                            <strong>Mã nữ trang</strong>
                                        </td>
                                        <td>
                                            <strong>Mã cũ</strong>
                                        </td>
                                        <td>
                                            <strong>Tên</strong>
                                        </td>
                                        <td>
                                            <strong>Ghi chú</strong>
                                        </td>
                                        <td>
                                            <strong>GVH</strong>
                                        </td>
                                        <td>
                                            <strong>TTL</strong>
                                        </td>
                                        <td>
                                            <strong>TL Hột</strong>
                                        </td>
                                        <td>
                                            <strong>TL Hột(Gr)</strong>
                                        </td>
                                        <td>
                                            <strong>TL Vàng</strong>
                                        </td>
                                        <td>
                                            <strong>Tiền hột</strong>
                                        </td>
                                        <td>
                                            <strong>Tiền công</strong>
                                        </td>
                                        <td>
                                            <strong>CVSP</strong>
                                        </td>
                                        <td>
                                            <strong>Tiền Đá/Ngọc trai</strong>
                                        </td>
                                        <td>
                                            <strong>Tiền công hột bán</strong>
                                        </td>
                                        <td>
                                            <strong>Thành tiền</strong>
                                        </td>
                                        <td>
                                            <strong>MSM</strong>
                                        </td>
                                        <td>
                                            <strong>Chi tiết hột tấm</strong>
                                        </td>
                                        <td>
                                            <strong>Chi tiết hột tấm thực tế</strong>
                                        </td>
                                        <td>
                                            <strong>KH</strong>
                                        </td>
                                        <td>
                                            <strong>Mã số mẫu Catalogue 1</strong>
                                        </td>
                                        <td>
                                            <strong>Mã số mẫu Catalogue 2</strong>
                                        </td>
                                        <td>
                                            <strong>Giá bán</strong>
                                        </td>
                                        <td>
                                            <strong>Số món</strong>
                                        </td>
                                        <td>
                                            <strong>Khuyến mãi</strong>
                                        </td>
                                        <td>
                                            <strong>Giá tạm tính</strong>
                                        </td>
                                    </tr>`
                    });
                    $('#headTableData').after(data);
                    $('#loadingAjax').hide();
                }
                else{
                    $('#loadingAjax').hide();
                    alert(obj.status);	 
            }
        });
    }
<?php echo '</script'; ?>
><?php }
}
