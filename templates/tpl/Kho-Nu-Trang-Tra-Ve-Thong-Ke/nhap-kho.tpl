<style>
    .formsearchgroup{
        margin: -10px 0;
    }
    .formsearchgroup .title-thongtin{
        margin-top: -15px;
        font-size: 12px;
        background: #eff3f8;
        padding: 0 5px;
        display: inline-block;
        vertical-align: top;
    }
    .formsearchgroup .divitem{
        margin-top: -15px;
    }
</style>
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
   <form name="f" id="f" method="post" onsubmit="return searchKhoNuTrangTraVe('<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Thong-Ke.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')"> 
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
                <input type="reset" name="reset" value=" Làm mới " onclick=" return resetsfrsearchKeToanThuTien();" class="btn-save btn-search"/>
            </div>
            <div class="formsearch formsearchgroup"> 
                <div class="box-thongin">
                    <div class="title-thongtin"><strong>CHI TIẾT</strong></div>
                    <div class="divitem">
                        {* <a class="btn-save btn-search" onclick=" return viewVangNguyenLieuCongTyTabNhapKho('viewChiTiet',<!--{$smarty.request.cid}-->,'<!--{$fromdays}-->','<!--{$todays}-->','<!--{$strSearch}-->')" href="#">Xem</a> *}
                        {* <input type="button" name="print" value="     In     " class="btn-save btn-search"/> *}
                        {* <input type="button" name="print" value="Export Excel" onclick=" return ExportExcelVangNguyenLieuCongTyTabNhapKho('ExportExcelChiTiet',<!--{$smarty.request.cid}-->,'<!--{$fromdays}-->','<!--{$todays}-->','<!--{$strSearch}-->');" class="btn-save btn-search"/> *}
                    </div>
                </div>
            </div>
        </div>
        <div class="MainTable">
            <div class="table-scroll">
                <div class="table-wrap">
                    <table class="table-bordered scroll-table">
                        <tr class="trheader" align="center">
                            <td style="min-width:30px">
                                <input type="checkbox" onclick="checkAll(this.checked);" name="all"/>
                            </td>
                            <td style="min-width:30px">
                                <strong>STT</strong>
                            </td>
                            <td style="min-width:130px">
                                <strong>Mã phiếu nhập kho</strong>
                            </td>
                            <td style="min-width:100px">
                                <strong>NV duyệt nhập kho</strong>
                            </td>
                            <td style="min-width:108px">
                                <strong>Ngày/giờ duyệt nhập kho</strong>
                            </td>
                            <td style="min-width:84px">
                                <strong>Cửa hàng</strong>
                            </td>
                            <td style="min-width:84px">
                                <strong>Nơi đến</strong>
                            </td>
                            <td style="min-width:85px">
                                <strong>Ngày xác nhận</strong>
                            </td>
                            <td style="min-width:100px">
                                <strong>Số phiếu</strong>
                            </td>
                            <td style="min-width:179px">
                                <strong>Ghi chú</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Loại vàng</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Loại nữ trang</strong>
                            </td>
                            <td style="min-width:91px">
                                <strong>Mã nữ trang</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Mã cũ</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Tên</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Số món</strong>
                            </td>
                            <td style="min-width:68px">
                                <strong>Trọng lượng</strong>
                            </td> 
                            <td style="min-width:68px">
                                <strong>TL Hột</strong>
                            </td>
                            <td style="min-width:68px">
                                <strong>TL vàng</strong>
                            </td>
                            <td style="min-width:101px">
                                <strong>Tiền hột</strong>
                            </td>
                            <td style="min-width:101px">
                                <strong>Tiền công</strong>
                            </td>
                            <td style="min-width:101px">
                                <strong>Tiền đá/ngọc trai</strong>
                            </td>
                            <td style="min-width:130px">
                                <strong>Mã phiếu Import</strong>
                            </td>
                            <td style="min-width:100px">
                                <strong>NV Import</strong>
                            </td>
                            <td style="min-width:85px">
                                <strong>Ngày Import</strong>
                            </td>
                            <td style="min-width:85px">
                                <strong>Giờ Import</strong>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Mã phiếu nhập kho..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="NV Nhập kho..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Ngày/giờ duyệt kho..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Cửa hàng..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Nơi đến..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textsearchdated" name="" id="" value="" placeholder="Ngày xác nhận..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Số phiếu..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Ghi chú..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Ghi chú..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Loại nữ trang..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Mã nữ trang..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Mã cũ..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Tên..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Số món..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Trọng lượng..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="TL Hột..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="TL Vàng..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Tiền hột..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Tiền công..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder=" Tiền đá/ngọc trai..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Mã phiếu Import..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="NV Import..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textsearchdated" name="" id="" value="" placeholder="Ngày Import..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="" placeholder="Giờ Import..."  autocomplete="off"/>
                            </td>
                        </tr>
                        <!--{section i loop=$view}-->
                        <tr>
                            <td>
                                <input type="checkbox" id="check<!--{$smarty.section.i.index}-->" name="iddel[]" value="<!--{$view[i].id}-->"/>
                            </td>
                            <td>
                                <!--{$smarty.section.i.index+1}-->
                            </td>
                            <td>
                                <!--{$view[i].maphieu}-->
                            </td>
                            <td>
                                <!--{getName('admin','fullname', $view[i].mid)}-->
                            </td>
                            <td>
                                <!--{$view[i].datednhap}--><!--{$view[i].timenhap}-->
                            </td>
                            <td>
                                <!--{$view[i].cuahang}-->
                            </td>
                            <td>
                                <!--{$view[i].noiden}-->
                            </td>
                            <td>
                                <!--{$view[i].datedxacnhan|date_format:"%d/%m/%Y"}-->
                            </td>
                            <td>
                                <!--{$view[i].sophieu}-->
                            </td>
                            <td>
                                <!--{$view[i].ghichu}-->
                            </td>
                            <td>
                                <!--{getName('loaivang','name_vn', $view[i].idloaivang)}-->
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
                                <!--{$view[i].slmon}-->
                            </td>
                            <td>
                                <!--{$view[i].cannangvh}-->
                            </td> 
                            <td>
                                <!--{$view[i].cannangh}-->
                            </td>
                            <td>
                                <!--{$view[i].cannangv}-->
                            </td>
                            <td>
                                <!--{$view[i].tienh}-->
                            </td>
                            <td>
                                <!--{$view[i].tiencong}-->
                            </td>
                            <td>
                                <!--{$view[i].tiendangoctrai}-->
                            </td>
                            <td>
                                <!--{$view[i].maphieuimport}-->
                            </td>
                            <td>
                                <!--{getName('admin','fullname', $view[i].midimport)}-->
                            </td>
                            <td>
                                <!--{$view[i].datedimport|date_format:"%d/%m/%Y"}-->
                            </td>
                            <td>
                                <!--{$view[i].timeimport}-->
                            </td>
                        </tr>   
                        <!--{/section}-->
                        <tr class="Paging fontSizeTon">
                            <td align="right" colspan="15"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                            <td align="right"><span class="colorXanh"> <!--{$slmon}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongCannangvh|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongCannangh|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongCannangv|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongTienHot|number_format}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongTienCong|number_format}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongTienDaNgocTrai|number_format}--> </span></td>
                            <td align="center" colspan="7"></td>
                        </tr>
                        <tr class="Paging fontSizeTon">
                            <td align="right" colspan="15"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongallslmon}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongallcannangvh|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongallcannangh|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongallcannangv|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongalltienh|number_format}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongalltiencong|number_format}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongalltiendangoctrai|number_format}--> </span></td>
                            <td align="center" colspan="7"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
   </from>
   <div class="Paging">
      <div class="pgLeft">Tổng số <!--{$total}--> trang</div>
      <div class="pgRight">
         <!--{$link_url}-->  
      </div>
   </div>
</div>
<link type="text/css" href="<!--{$path_url}-->/calendar/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$path_url}-->/calendar/jquery-ui.js"></script> 
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<link type="text/css" href="<!--{$path_url}-->/js/searchajax/search.css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/jsapi.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/searchajax/script.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/tim-kiem.js"></script>