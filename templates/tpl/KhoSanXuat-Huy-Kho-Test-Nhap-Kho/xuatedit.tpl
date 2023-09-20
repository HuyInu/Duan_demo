<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<!--{$path_url}-->/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <!--{insert name="HearderCat" cid=$smarty.request.cid root=$smarty.request.root act=$smarty.request.act}-->
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
                            <input  type="text" value="" class="InputText" readonly/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Mã phiếu xuất kho:
                        </div>
                        
                        <div class="SubRight">
                            <input name="" value="" class="InputText" type="text" autocomplete="off" readonly/>
                        </div>
                    </div>

                    <div class="SubAll">
                        <div class="SubLeft">
                            Mã phiếu trả kho:
                        </div>
                        
                        <div class="SubRight">
                            <input name="" value="" class="InputText" type="text" autocomplete="off" />
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
                                    <input type="hidden" name="nhomnguyenlieuvang[]" id="nhomnguyenlieuvang" value="<!--{$viewtcctvang[i].nhomnguyenlieuvang}-->" />
                                    <a id="popupNhomDanhMucVang" href="<!--{$path_url}-->/popup/DanhMucNguyenLieu.php?type=vang&idnhomdm=<!--{$nhomdanhmuc.id}-->&idnhomnguyenlieuvang=<!--{$viewtcctvang[i].nhomnguyenlieuvang}-->&idtennguyenlieuvang=<!--{$viewtcctvang[i].tennguyenlieuvang}-->&idshow=<!--{$smarty.section.i.index+1}-->">
                                        <span id="showtennhomnguyenlieuvang">
                                            <!--{if $viewtcctvang[i].nhomnguyenlieuvang gt 0}-->
                                                <!--{insert name='getName' table='categories' names='name_vn' id=$viewtcctvang[i].nhomnguyenlieuvang}-->
                                            <!--{else}-->
                                                Click chọn
                                            <!--{/if}-->    
                                        </span>
                                    </a>
                                    <script type="text/javascript">
                                       $(document).ready(function() {
                                            $("#popupNhomDanhMucVang").fancybox();
                                        }); 
                                    </script>
                                </div>
                            </div>
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Tên Nguyên Liệu:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="hidden" name="tennguyenlieuvang" id="tennguyenlieuvang" value="" />
                                    <span id="showtennguyenlieuvang">
                                        <!--{insert name='getName' table='categories' names='name_vn' id=$viewtcctvang[i].tennguyenlieuvang}-->
                                    </span>
                                </div>
                            </div>
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Loại vàng:
                                </div>
                                
                                <div class="SubRight">
                                    <!--{insert name='loadloaivang' idloaivang=$viewtcctvang[i].idloaivang idnum=$smarty.section.i.index+1 limitloaivang=$limitLoaiVang}-->
                                </div>
                            </div>
                        </div>

                        <div class="panel-right">
                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng V+H:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld" autocomplete="off" name="" id="" value="" />
                                </div>
                            </div>

                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng H:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld" autocomplete="off" name="" id="" value="" />
                                </div>
                            </div>

                            <div class="SubAll">
                                <div class="SubLeft">
                                    Câng nặng V:
                                </div>
                                
                                <div class="SubRight">
                                    <input type="text" class="txtdatagirld" autocomplete="off" name="" id="" value="" />
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
                <table class="table-bordered">
                    <tr class="trheader" align="center">
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
        	<input type="hidden" name="id" value="<!--{$edit.id}-->" />
            <input type="button" class="btn-save" onclick=" return " value="  Lưu " /> 
        </div>
    </form>
</div>
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/functions/function.js"></script>
<script src="<!--{$path_url}-->/fancybox/jquery.fancybox-1.3.1.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/fancybox/jquery.fancybox-1.3.1.css">
<link rel="stylesheet" href="<!--{$path_url}-->/popup/dialog.css">