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
<div class="goAction">
	<ul>
    	<li>
            <!--{if $checkPer3 eq "true" }-->
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/delete.png">
               	</a> 
            <!--{else}-->   
               	<a>
                    <img src="<!--{$path_url}-->/images/delete-no.png">
               	</a> 
            <!--{/if}--> 
        </li>
   </ul>
</div>
<div class="MainContent">
   <form name="f" id="f" method="post" onsubmit="return searchKhoNuTrangTraVe('<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')"> 
        <div class="MainSearch">
            <div class="formsearch">
                <label class="Fl labelsearch"> Từ ngày: </label>
                <input type="text" class="SearchCtrl InputText textsearchdated" placeholder='dd/mm/yy' name="fromdays" id="fromdays" value="<!--{$fromdays}-->" onchange="DateCheck()" autocomplete="off"/>
            </div>
            <div class="formsearch">
                <label class="Fl labelsearch"> Đến ngày: </label>
                <input type="text" class="SearchCtrl InputText textsearchdated" placeholder='dd/mm/yy' name="todays" id="todays" value="<!--{$todays}-->" onchange="DateCheck()" autocomplete="off"/>
            </div>
            <div class="formsearch"> 
                <input class="btn-save btn-search" value="Tìm kiếm" type="submit"> 
                <input type="button" name="reset" value=" Làm mới " onclick="ResetSearch();" class="btn-save btn-search"/>
            </div>
            <div class="formsearch formsearchgroup"> 
                <div class="box-thongin">
                    <div class="title-thongtin"><strong>CHI TIẾT</strong></div>
                    <div class="divitem">
                        <a class="btn-save btn-search" onclick="ViewDetail()" href="#">Xem</a>
                        <input type="button" name="print" value="     In     " class="btn-save btn-search" onclick="printKhoNuTrangTraVe('nhapkho')"/>
                        <input type="button" name="print" value="Export Excel" class="btn-save btn-search" onclick="exportExcel()"/>
                    </div>
                </div>
            </div>
        </div>
        <!--{include 'Kho-Nu-Trang-Tra-Ve-Nhap-Kho/tabMenu.tpl'}-->
        <div class="MainTable fix-max-height">
            <div class="table-scroll">
                <div class="table-wrap">
                    <table  class="table-bordered scroll-table">
                        <tr class="trheader" align="center">
                            <td style="min-width:30px">
                                <input type="checkbox" onclick="checkAll();" name="all"/>
                            </td>
                            <td style="min-width:30px">
                                <strong>STT</strong>
                            </td>
                            <td style="min-width:130px">
                                <strong>Mã phiếu import</strong>
                            </td>
                            <td style="min-width:100px">
                                <strong>NV import</strong>
                            </td>
                            <td style="min-width:85px">
                                <strong>Ngày import</strong>
                            </td>
                            <td style="min-width:70px">
                                <strong>Giờ import</strong>
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
                            <td style="min-width:50px">
                                <strong>Duyệt nhập kho</strong>
                            </td>
                            <td style="min-width:50px">
                                <strong>Sửa</strong>
                            </td>
                            <td style="min-width:133px">
                                <strong>Trạng  thái</strong>
                            </td>
                            <td style="min-width:135px">
                                <strong>Số phiếu nhập kho</strong>
                            </td>
                            <td style="min-width:122px">
                                <strong>NV duyệt nhập kho</strong>
                            </td>
                            <td style="min-width:108px">
                                <strong>Ngày/ giờ duyệt nhập kho</strong>
                            </td>
                        </tr>
                        <tr id="search">
                            <td></td>
                            <td></td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch" name="maphieuimports" id="maphieuimports" value="<!--{$maphieuimports}-->" placeholder="Mã phiếu import..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch" name="midimports" id="midimports" value="<!--{$midimports}-->" placeholder="NV import..." autocomplete="off" style="width:100% !important" />
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Giờ import..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch text-right" name="cuahangs" id="cuahangs" value="<!--{$cuahangs}-->" placeholder="Cửa hàng..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch text-right" name="noidens" id="noidens" value="<!--{$noidens}-->" placeholder="Nơi đến..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textsearchdated" name="datedxacnhans" id="datedxacnhans" value="<!--{$datedxacnhans}-->" placeholder="Ngày xác nhận..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch" name="sophieus" id="sophieus" value="<!--{$sophieus}-->" placeholder="Số phiếu..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch" name="ghichus" id="ghichus" value="<!--{$ghichus}-->" placeholder="Ghi chú..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch" name="idloaivangs" id="idloaivangs" value="<!--{$idloaivangs}-->" placeholder="Loại vàng..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Loại nữ trang..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Mã nữ trang..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch" name="macus" id="macus" value="<!--{$macus}-->" placeholder="Mã cũ..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch" name="tens" id="tens" value="<!--{$tens}-->" placeholder="Tên..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch" name="slmons" id="slmons" value="<!--{$slmons}-->" placeholder="Số món..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannangvhs" id="cannangvhs" value="<!--{$cannangvhs}-->" placeholder="Trọng lượng..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannanghs" id="cannanghs" value="<!--{$cannanghs}-->" placeholder="TL hột..." autocomplete="off"/>
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
                                <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tiendangoctrais" id="tiendangoctrais" value="<!--{$tiendangoctrais}-->" placeholder="Tiền đá/ngọc trai..." autocomplete="off"/>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <!--{if ($smarty.request.act != 'uninsertShow') && ($smarty.request.act != 'insertedShow')}-->
                                <select class="SearchCtrl" id="trangthaiduyets" name="trangthaiduyets" style="width:100%">
                                    <option value=""> Tất cả </option>
                                    <option value="0" <!--{($types === '0')?'selected' : ''}-->> Đang chờ nhập kho  </option>
                                    <option value="1" <!--{($types === '1')?'selected' : ''}-->> Đã nhập kho  </option>
                                </select>
                                <!--{/if}-->
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch" name="maphieus" id="maphieus" value="<!--{$maphieus}-->" placeholder="Số phiếu nhập kho..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="SearchCtrl InputText textwsearch" name="mids" id="mids" value="<!--{$mids}-->" placeholder="NV duyệt nhập kho..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Ngày/ giờ duyệt nhập kho..." autocomplete="off"/>
                            </td>
                        </tr>
                        <!--{$slmon = 0}-->
                        <!--{$tongCannangvh = 0}-->
                        <!--{$tongCannangv = 0}-->
                        <!--{$tongCannangh = 0}-->
                        <!--{$tongTienHot = 0}-->
                        <!--{$tongTienCong = 0}-->
                        <!--{$tongTienDaNgocTrai =0}-->
                        <!--{section i loop=$view}-->
                        <tr id='g<!--{$view[i].id}-->'>
                            <td>
                                <input type="checkbox" class="check-phieu" id="check<!--{$smarty.section.i.index}-->" name="iddel[]" value="<!--{$view[i].id}-->"/>
                            </td>
                            <td>
                                <!--{$smarty.section.i.index+1}-->
                            </td>
                            <td>
                                <!--{$view[i].maphieuimport}-->
                            </td>
                            <td>
                                <!--{getName('admin', 'fullname', $view[i].midimport)}-->
                            </td>
                            <td>
                                <!--{$view[i].datedimport|date_format:'%d/%m/%Y'}-->
                            </td>
                            <td>
                                <!--{$view[i].timeimport}-->
                            </td>
                            <td>
                                <!--{$view[i].cuahang}-->
                            </td>
                            <td>
                                <!--{$view[i].noiden}-->
                            </td>
                            <td>
                                <!--{$view[i].datedxacnhan|date_format:'%d/%m/%Y'}-->
                            </td>
                            <td>
                                <!--{$view[i].sophieu}-->
                            </td>
                            <td>
                                <!--{$view[i].ghichu}-->
                            </td>
                            <td>
                                <!--{getName('loaivang', 'name_vn', $view[i].idloaivang)}-->
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
                                <!--{$view[i].cannangvh|number_format:3:".":","}-->
                            </td> 
                            <td>
                                <!--{$view[i].cannangh|number_format:3:".":","}-->
                            </td>
                            <td>
                                <!--{$view[i].cannangv|number_format:3:".":","}-->
                            </td>
                            <td>
                                <!--{$view[i].tienh|number_format}-->
                            </td>
                            <td>
                                <!--{$view[i].tiencong|number_format}-->
                            </td>
                            <td>
                                <!--{$view[i].tiendangoctrai|number_format}-->
                            </td>
                            <td>
                                <!--{if $view[i].type eq 0 }-->
                                    <!--{if $checkPer8 eq 'true' }-->
                                        <a href="javascript:void(0)" onclick="giahuy_chuyenKhoNguonVaogo('nhapkhonutrangtrave', <!--{$view[i].id}-->,'1867', <!--{$phongbanchuyen}-->, '')" title="Xác Nhận"> 
                                            <img src="<!--{$path_url}-->/images/xac-nhan.png"/> 
                                        </a>
                                    <!--{else}-->
                                        <img src="<!--{$path_url}-->/images/xac-nhan-no.png"/> 
                                    <!--{/if}-->
                                <!--{/if}-->
                            </td>
                            <td>
                                <!--{if $view[i].type eq 0}-->
                                    <!--{if $checkPer2 eq 'true' }-->
                                        <a href="<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->" title="Sửa"> 
                                            <img src="<!--{$path_url}-->/images/edit.png"/> 
                                        </a>
                                    <!--{else}-->
                                        <img src="<!--{$path_url}-->/images/edit-no.png"/>
                                    <!--{/if}-->
                                <!--{/if}-->
                            </td>
                            <td>
                                <!--{($view[i].type eq '0') ? 'Đang chờ nhập kho' : 'Đã nhập kho'}-->
                            </td>
                            <td>
                                <!--{$view[i].maphieu}-->
                            </td>
                            <td>
                                <!--{getName('admin', 'fullname', $view[i].mid)}-->
                            </td>
                            <td>
                                <!--{$view[i].datednhap|date_format:'%d/%m/%Y'}--><br><!--{$view[i].timenhap}-->
                            </td>
                        </tr>
                        <!--{$slmon = $slmon + $view[i].slmon}-->
                        <!--{$tongCannangvh = $tongCannangvh + $view[i].cannangvh}-->
                        <!--{$tongCannangv = $tongCannangv + $view[i].cannangv}-->
                        <!--{$tongCannangh = $tongCannangh + $view[i].cannangh}-->
                        <!--{$tongTienHot = $tongTienHot + $view[i].tienh}-->
                        <!--{$tongTienCong = $tongTienCong + $view[i].tiencong}-->
                        <!--{$tongTienDaNgocTrai = $tongTienDaNgocTrai + $view[i].tiendangoctrai}-->
                        <!--{/section}-->
                        <tr class="Paging fontSizeTon">
                            <td align="right" colspan="16"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                            <td align="right"><span class="colorXanh"> <!--{$slmon}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongCannangvh|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongCannangh|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongCannangv|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongTienHot|number_format}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongTienCong|number_format}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongTienDaNgocTrai|number_format}--> </span></td>
                            <td align="center" colspan="6"></td>
                        </tr>
                        <tr class="Paging fontSizeTon">
                            <td align="right" colspan="16"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongallslmon}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongallcannangvh|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongallcannangh|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongallcannangv|number_format:3:".":","}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongalltienh|number_format}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongalltiencong|number_format}--> </span></td>
                            <td align="right"><span class="colorXanh"> <!--{$tongAll.tongalltiendangoctrai|number_format}--> </span></td>
                            <td align="center" colspan="6"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </form>
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
<script>
function ViewDetail () {
    $urlParam = ''
    $('.check-phieu:checkbox:checked').each(function () {
        $urlParam += `&phieuid[]=${$(this).val()}`
    });
    console.log($urlParam)
    popupwindow('Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?act=view&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->'+$urlParam,'mywindow')
}
function printKhoNuTrangTraVe(act) {
    var str = "";
    str = `act=${act}&cid=<!--{$smarty.request.cid}-->&tab=<!--{$smarty.request.act}-->`;
    str += GetAllSearchStr();
    url = '<!--{$path_url}-->/print/print-kho-nu-trang-tra-ve.php?'+str;
    popupwindow(url, 'In')
    return false;	
}
function exportExcel(act) {
    var str = "";
    str = `act=exportexcel&cid=<!--{$smarty.request.cid}-->&tab=<!--{$smarty.request.act}-->`;
    str += GetAllSearchStr();
    url = '<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?'+str;
    popupwindow(url, 'In')
    return false;
}
</script>