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
	<form name="f" id="f" method="post" onsubmit="return "> 
        <div class="MainSearch">     
            <!--{include file="./allsearch/tungay-denngay.tpl"}-->
            <a href="<!--{$path_url}-->/sources/==.php?act=print&cid=<!--{$smarty.request.cid}-->" title="In">
                <input type="button" name="print" value="In" class="btn-save btn-search"/>
            </a>
        </div>
        <div class="ChonLoaiPhieu">
            <ul>
                <li <!--{if $smarty.request.act eq ''}-->class="active"<!--{/if}-->>
                    <a href="<!--{$path_url}-->/sources/==.php?cid=3228" title="Bảng Tính Giá">
                        Đang tồn kho
                    </a>
                </li>
                <li <!--{if $smarty.request.act eq ''}-->class="active"<!--{/if}-->>
                    <a href="<!--{$path_url}-->/sources/==.php?act=BangTinhGiaChiTiet&cid=3228" title="Bảng Tính Giá Chi Tiết">
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
                        <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Tìm trạng thái"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Tìm cửa hàng"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Tìm nơi đến"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Tìm nhân viên"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText textsearchdated" name="" id="" value="<!--{$}-->" placeholder="Tìm ngày"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText textsearchdated" name="" id="" value="<!--{$}-->" placeholder="Tìm ngày xác nhận"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm số phiếu"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm cửa hàng trước"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm STT"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm ghi chú"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm nhà cung cấp"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm STT"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm ghi chú"  autocomplete="off"/>
                    </td>
                    <td>
                        <!--{insert name='loadloaivang' idloaivang=$loaivangs limitloaivang=$limitLoaiVang}-->
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm mã cũ"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm tên"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm GVH"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm TTL"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm TL Hột"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm TL Hột(Gr)"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm TL Vàng"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm tiền hột"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm tiền công"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm CVSP"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm tiền Đá/Ngọc trai"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm tiền công hột bán"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm thành tiền"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm MSM"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm chi tiết hột tấm"  autocomplete="off"/>
                    </td>
                    <td>
                        <input type="text" class="InputText" name="" id="" value="<!--{$}-->" placeholder="Tìm chi tiết hột tấm"  autocomplete="off"/>
                    </td>
                </tr>
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="7"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
                    <td align="right"><strong class="colorXanh"><!--{$tongQ10|number_format:3:".":","}--> </strong></td>
                </tr>
            </table>
        </div>
    </form>
</div>
<link type="text/css" href="<!--{$path_url}-->/calendar/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$path_url}-->/calendar/jquery-ui.js"></script> 
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<link type="text/css" href="<!--{$path_url}-->/js/searchajax/search.css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/jsapi.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/script.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/tim-kiem.js"></script>
<script>
   $(function() {
      $(".textsearchdated").datepicker({changeMonth: true,changeYear: true,dateFormat:"dd/mm/yy"});	
   });
</script>