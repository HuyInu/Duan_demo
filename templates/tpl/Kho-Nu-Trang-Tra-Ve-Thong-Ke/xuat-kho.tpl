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
                <input type="button" name="print" value="     In     " class="btn-save btn-search"/>
                <input type="button" name="print" value="Export Excel" onclick=" return ExportExcelVangNguyenLieuCongTyTabNhapKho('ExportExcelChiTiet',<!--{$smarty.request.cid}-->,'<!--{$fromdays}-->','<!--{$todays}-->','<!--{$strSearch}-->');" class="btn-save btn-search"/>
            </div>
        </div>
        <div class="MainTable">
            <div class="table-scroll">
                <div class="table-wrap">
                    <table class="table-bordered scroll-table">
                        <tr class="trheader" align="center">
                            <td style="min-width:30px">
                                <strong>STT</strong>
                            </td>
                            <td style="min-width:108px">
                                <strong>Ngày xuất kho</strong>
                            </td>
                            <td style="min-width:130px">
                                <strong>Mã phiếu xuất kho</strong>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
   </from>
</div>