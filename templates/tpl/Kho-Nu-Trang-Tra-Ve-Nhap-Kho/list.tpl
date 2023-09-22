<style>
    .MainSearch {
        display: flex;
        align-items: center;
    }
    .title-thongtin {
        background: #eff3f8;
    }
    .SubAll {
        margin-top: -21px;
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
   <form name="f" id="f" method="post" onsubmit="return searchKhoTemDa('<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?cid=<!--{$smarty.request.cid}-->')"> 
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
                <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="Tìm kiếm" type="submit"> 
                <input type="reset" name="reset" value=" Làm mới " onclick=" return resetsfrsearchKeToanThuTien();" class="btn-save btn-search"/>
            </div>
            <div class="formsearch">
                <div class="box-thongin">
                    <div class="title-thongtin">Chi tiết</div>
                    <div class="SubAll">
                        <a href="Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?cid=<!--{$smarty.request.cid}-->&">
                            <input class="btn-save btn-search" value="Xem" type="button"> 
                        </a>
                    
                    <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="In" type="button"> 
                    <input class="btn-save btn-search" onclick=" return SubmitFrom();" value="Export Excel" type="button"> 
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
                                <input type="checkbox" onclick="checkAll(this.checked);" name="all"/>
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
                            <td style="min-width:50px">
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
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Mã phiếu import..."  autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="NV import..." autocomplete="off" style="width:100% !important" />
                            </td>
                            <td>
                                <input type="text" class="InputText textsearchdated" name="" id="" value="<!--{$}-->" placeholder="Ngày import..." autocomplete="off" style="width:100% !important" />
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Giờ import..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch text-right" name="" id="" value="<!--{$}-->" placeholder="Cửa hàng..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch text-right" name="" id="" value="<!--{$}-->" placeholder="Nơi đến..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Số phiếu..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Ghi chú..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Loại vàng..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Loại nữ trang..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Mã nữ trang..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Mã cũ..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Tên..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Số món..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<!--{$}-->" placeholder="Trọng lượng..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<!--{$}-->" placeholder="TL hột..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<!--{$}-->" placeholder="TL vàng..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<!--{$}-->" placeholder="Tiền hột..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<!--{$}-->" placeholder="Tiền công..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch autoNumericInt" name="" id="" value="<!--{$}-->" placeholder="Tiền đá/ngọc trai..." autocomplete="off"/>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Trạng thái..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Số phiếu nhập kho..." autocomplete="off"/>
                            </td>
                            <td>
                                <input type="text" class="InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="NV duyệt nhập kho..." autocomplete="off"/>
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
                        <tr>
                            <td>
                                <input type="checkbox" id="check<!--{$smarty.section.i.index}-->" name="iddel[]" value="<!--{$view[i].id}-->"/>
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
                                <!--{$view[i].datedimport}-->
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
                                <!--{$view[i].datedxacnhan}-->
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
                                <strong>Số phiếu nhập kho</strong>
                            </td>
                            <td>
                                <!--{getName('admin', 'fullname', $view[i].midnhap)}-->
                            </td>
                            <td>
                                <!--{$view[i].datednhap}--><br><!--{$view[i].timenhap}-->
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