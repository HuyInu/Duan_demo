<link type="text/css" href="<!--{$path_url}-->/calendar/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$path_url}-->/calendar/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="<!--{$path_url}-->/js/searchajax/search.css" />
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/jsapi.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/script.js"></script>
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
            <!--{section i loop = $view}-->
            <tr>
                <td>
                    <!--{($view[i].trangthaixacnhan == 1) ? "Đã xác nhận" : "Chưa xác nhận"}-->
                </td>
                <td>
                    <!--{$view[i].cuahang}-->
                </td>
                <td>
                    <!--{$view[i].noiden}-->
                </td>
                <td>
                    <!--{$view[i].nhanvien}-->
                </td>
                <td>
                    <!--{$view[i].dated}-->
                </td>
                <td>
                    <!--{$view[i].datedxacnhan}-->
                </td>
                <td>
                    <!--{$view[i].sophieu}-->
                </td>
                <td>
                    <!--{$view[i].cuahangtruoc}-->
                </td>
                <td>
                    <!--{$view[i].STT}-->
                </td>
                <td>
                    <!--{$view[i].ghichu}-->
                </td>
                <td>
                    <!--{$view[i].nhacungcap}-->
                </td>
                <td>
                    <!--{$view[i].idloaivang}-->
                </td>
                <td>
                    <!--{$view[i].loainutrang}-->
                </td>
                <td>
                    <!--{$view[i].manutrang}-->
                </td>
                <td>
                    <!--{$view[i].macu}-->
                </td>
                <td>
                    <!--{$view[i].ten}-->
                </td>
                <td>
                    <!--{$view[i].gvh}-->
                </td>
                <td>
                    <!--{number_format($view[i].cannangvh, 3)}-->
                </td>
                <td>
                    <!--{number_format($view[i].cannangh, 3)}-->
                </td>
                <td>
                    <!--{number_format($view[i].cannanghgr, 3)}-->
                </td>
                <td>
                    <!--{number_format($view[i].cannangv, 3)}-->
                </td>
                <td>
                    <!--{number_format($view[i].tienh)}-->
                </td>
                <td>
                    <!--{number_format($view[i].tiencong)}-->
                </td>
                <td>
                    <!--{number_format($view[i].cvsp)}-->
                </td>
                <td>
                    <!--{number_format($view[i].tiendangoctrai)}-->
                </td>
                <td>
                    <!--{number_format($view[i].tienconghotban)}-->
                </td>
                <td>
                    <!--{number_format($view[i].thanhtien)}-->
                </td>
                <td>
                    <!--{$view[i].msm}-->
                </td>
                <td>
                    <!--{$view[i].chitiethottam}-->
                </td>
                <td>
                    <!--{$view[i].chitiethottamthucte}-->
                </td>
                <td>
                    <!--{$view[i].kh}-->
                </td>
                <td>
                    <!--{$view[i].catalogue1}-->
                </td>
                <td>
                    <!--{$view[i].catalogue2}-->
                </td>
                <td>
                    <!--{number_format($view[i].giaban)}-->
                </td>
                <td>
                    <!--{$view[i].slmon}-->
                </td>
                <td>
                    <!--{$view[i].makhuyenmai}-->
                </td>
                <td>
                    <!--{number_format($view[i].giatamtinh)}-->
                </td>
            </tr>
            <!--{/section}-->
        </table>
    </div>
</div>