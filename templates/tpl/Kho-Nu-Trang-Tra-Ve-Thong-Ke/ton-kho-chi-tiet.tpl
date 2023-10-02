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
	<form name="f" id="f" method="post" onsubmit="return searchKhoNuTrangTraVe('<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Thong-Ke.php?act=<!--{$smarty.request.act}-->&tab=<!--{$smarty.request.tab}-->&cid=<!--{$smarty.request.cid}-->')">
        <div class="MainSearch">
            <div class="formsearch">
                <label class="Fl labelsearch"> Từ ngày: </label>
                <input type="text" class="InputText textsearchdated" placeholder='dd/mm/yy' name="fromdays" id="fromdays" value="<!--{$fromdays}-->" onchange="DateCheck()" autocomplete="off"/>
            </div>
            <div class="formsearch">
                <label class="Fl labelsearch"> Đến ngày: </label>
                <input type="text" class="InputText textsearchdated" placeholder='dd/mm/yy' name="todays" id="todays" value="<!--{$todays}-->" onchange="DateCheck()" autocomplete="off"/>
            </div>
            <div class="formsearch"> 
                <input class="btn-save btn-search" value="Tìm kiếm" type="submit"> 
                <input type="button" name="reset" value=" Làm mới " onclick="ResetSearch();" class="btn-save btn-search"/>
                <input type="button" name="print" value="     In     " class="btn-save btn-search"/>
            </div>
        </div>
        <div class="ChonLoaiPhieu">
            <ul>
                <li <!--{if ($smarty.request.tab eq 'dangtonkho') || (!$smarty.request.tab)}-->class="active"<!--{/if}-->>
                    <a href="<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Thong-Ke.php?act=ChiTietTon&tab=dangtonkho&cid=<!--{$smarty.request.cid}-->" title="Tổng hộp">
                        ĐANG TỒN KHO
                    </a>
                </li>
                <li <!--{if $smarty.request.tab eq 'daxuatkho'}-->class="active"<!--{/if}-->>
                    <a href="<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Thong-Ke.php?act=ChiTietTon&tab=daxuatkho&cid=<!--{$smarty.request.cid}-->" title="Chờ nhập kho">
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
                            <input type="text" class="SearchCtrl InputText textwsearch text-right" name="cuahangs" id="cuahangs" value="<!--{$cuahangs}-->" placeholder="Cửa hàng..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch text-right" name="noidens" id="noidens" value="<!--{$noidens}-->" placeholder="Nơi đến..." autocomplete="off"/>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textsearchdated" name="dateds" id="dateds" value="<!--{$dateds}-->" placeholder="Ngày..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textsearchdated" name="datedxacnhans" id="datedxacnhans" value="<!--{$datedxacnhans}-->" placeholder="Ngày..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="sophieus" id="sophieus" value="<!--{$sophieus}-->" placeholder="Số phiếu..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="cuahangtruocs" id="cuahangtruocs" value="<!--{$cuahangtruocs}-->" placeholder="Cửa hàng trước..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="STTs" id="STTs" value="<!--{$STTs}-->" placeholder="STT..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="ghichus" id="ghichus" value="<!--{$ghichus}-->" placeholder="Ghi chú..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="nhacungcaps" id="nhacungcaps" value="<!--{$nhacungcaps}-->" placeholder="Nhà cung cấp..." autocomplete="off"/>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="macus" id="macus" value="<!--{$macus}-->" placeholder="Mã cũ..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="tens" id="tens" value="<!--{$tens}-->" placeholder="Tên..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="ghichu2s" id="ghichu2s" value="<!--{$ghichu2s}-->" placeholder="Ghi chú..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="gvhs" id="gvhs" value="<!--{$gvhs}-->" placeholder="GVH..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannangvhs" id="cannangvhs" value="<!--{$cannangvhs}-->" placeholder="Trọng lượng..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannanghs" id="cannanghs" value="<!--{$cannanghs}-->" placeholder="TL hột..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannanghgrs" id="cannanghgrs" value="<!--{$cannanghgrs}-->" placeholder="TL hột GR..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannangvs" id="cannangvs" value="<!--{$cannangvs}-->" placeholder="TL vàng..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tienhs" id="tienhs" value="<!--{$tienhs}-->" placeholder="Tiền hột..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tiencongs" id="tiencongs" value="<!--{$tiencongs}-->" placeholder="Tiền công..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cvsps" id="cvsps" value="<!--{$cvsps}-->" placeholder="CVSP..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tiendangoctrais" id="tiendangoctrais" value="<!--{$tiendangoctrais}-->" placeholder="Tiền đá/ngọc trai..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tienconghotbans" id="tienconghotbans" value="<!--{$tienconghotbans}-->" placeholder="Tiền công hột bán..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="thanhtiens" id="thanhtiens" value="<!--{$thanhtiens}-->" placeholder="Thành tiền..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="msms" id="msms" value="<!--{$msms}-->" placeholder="MSM..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="chitiethottams" id="chitiethottams" value="<!--{$chitiethottams}-->" placeholder="Chi tiết hột tấm..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="chitiethottamthuctes" id="chitiethottamthuctes" value="<!--{$chitiethottamthuctes}-->" placeholder="Hột tấm thực tế..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="khs" id="khs" value="<!--{$khs}-->" placeholder="KH..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="catalogue1s" id="catalogue1s" value="<!--{$catalogue1s}-->" placeholder="Catalogue 1..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="catalogue2s" id="catalogue2s" value="<!--{$catalogue2s}-->" placeholder="Catalogue 2..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="giabans" id="giabans" value="<!--{$giabans}-->" placeholder="Giá bán..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="slmons" id="slmons" value="<!--{$slmons}-->" placeholder="Số món..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="makhuyenmais" id="makhuyenmais" value="<!--{$makhuyenmais}-->" placeholder="Mã khuyến mãi..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="giatamtinhs" id="giatamtinhs" value="<!--{$giatamtinhs}-->" placeholder="Mã khuyến mãi..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="maphieusubs" id="maphieusubs" value="<!--{$maphieusubs}-->" placeholder="Mã phiếu nhập..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="midsubs" id="midsubs" value="<!--{$midsubs}-->" placeholder="Mã phiếu nhập..." autocomplete="off"/>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="maphieuimportsubs" id="maphieuimportsubs" value="<!--{$maphieuimportsubs}-->" placeholder="Ngày Import..." autocomplete="off"/>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textsearchdated" name="datedimportsubs" id="datedimportsubs" value="<!--{$datedimportsubs}-->" placeholder="Ngày Import..." autocomplete="off"/>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="maphieus" id="maphieus" value="<!--{$maphieus}-->" placeholder="Mã phiếu xuất..." autocomplete="off"/>
                        </td>
                        <td>
                            <input type="text" class="SearchCtrl InputText textwsearch" name="mids" id="mids" value="<!--{$mids}-->" placeholder="Mã phiếu xuất..." autocomplete="off"/>
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
                            <!--{$view[i].dated|date_format:'%d/%m/%Y'}-->
                        </td>
                        <td>
                            <!--{$view[i].datedxacnhan|date_format:'%d/%m/%Y'}-->
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
                            <!--{$view[i].ghichu2}-->
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
                        <td>
                            <!--{$phieuNhap[i].maphieu}-->
                        </td>
                        <td>
                            <!--{getName('admin', 'fullname', $phieuNhap[i].mid)}-->
                        </td>
                        <td>
                            <!--{$phieuNhap[i].datednhap|date_format:'%d/%m/%Y'}--><br><!--{$phieuNhap[i].timenhap}-->
                        </td>
                        <td>
                            <!--{$phieuNhap[i].maphieuimport}-->
                        </td>
                        <td>
                            <!--{getName('admin', 'fullname', $phieuNhap[i].midimport)}-->
                        </td>
                        <td>
                            <!--{$phieuNhap[i].datedimport|date_format:'%d/%m/%Y'}-->
                        </td>
                        <td>
                            <!--{$phieuNhap[i].timeimport}-->
                        </td>
                        <!--{if $view[i].trangthai eq '2'}-->
                        <td>
                            <!--{$view[i].maphieu}-->
                        </td>
                        <td>
                            <!--{getName('admin', 'fullname', $view[i].mid)}-->
                        </td>
                        <td>
                            <!--{$view[i].datedxuat|date_format:'%d/%m/%Y'}--><br><!--{$view[i].timexuat}-->
                        </td>
                        <td>
                        </td>
                        <!--{else}-->
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <!--{/if}-->
                    </tr>
                    <!--{/section}-->
                </table>
            </div>
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