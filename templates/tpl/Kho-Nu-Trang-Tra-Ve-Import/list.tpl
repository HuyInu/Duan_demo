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
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Import.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
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
   <form name="f" id="f" method="post" onsubmit="return searchKhoNuTrangTraVe('<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Import.php?cid=<!--{$smarty.request.cid}-->')"> 
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
            <!--{if $checkPer10 eq "true" }-->
               <a href="<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Import.php?act=importexcel&cid=<!--{$smarty.request.cid}-->" title="Import Excel">
                  <input type="button" name="importexcel" value=" Import Excel " class="btn-save btn-search"/>
               </a>
            <!--{/if}-->
         </div>
      </div>
      <div class="MainTable fix-max-height">
         <table class="table-bordered">
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
               <td style="min-width:100px">
                  <strong>Ngày import</strong>
               </td>
               <td style="min-width:130px">
                  <strong>Giờ import</strong>
               </td>
               <td style="min-width:65px">
                  <strong>Tổng số món import</strong>
               </td>
               <td style="min-width:95px">
                  <strong>Tổng Trọng lượng</strong>
               </td>
               <td style="min-width:95px">
                  <strong>Tổng TL Hột</strong>
               </td>
               <td style="min-width:95px">
                  <strong>Tổng TL vàng</strong>
               </td>
               <td style="min-width:50px">
                  <strong>Tổng tiền hột</strong>
               </td>
               <td style="min-width:50px">
                  <strong>Tổng tiền công</strong>
               </td>
               <td style="min-width:50px">
                  <strong>Tổng tiền đá/ngọc trai</strong>
               </td>
               <td style="min-width:50px">
                  <strong>Duyệt chuyển đến chờ nhập kho</strong>
               </td>
            </tr>
            <tr id="search">
               <td></td>
               <td></td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch" name="maphieus" id="maphieus" value="<!--{$searchKeyword.maphieus}-->" placeholder="Mã phiếu import..."  autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch" name="midNames" id="midNames" value="<!--{$searchKeyword.midNames}-->" placeholder="NV import..." autocomplete="off" style="width:100% !important" />
               </td>
               <td>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch" name="" id="" value="<!--{$}-->" placeholder="Giờ import..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="slmons" id="slmons" value="<!--{$searchKeyword.slmons}-->" placeholder="Tổng số món import..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch  autoNumericInt" name="cannangvhs" id="cannangvhs" value="<!--{$searchKeyword.cannangvhs}-->" placeholder="Tổng Trọng lượng..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannanghs" id="cannanghs" value="<!--{$searchKeyword.cannanghs}-->" placeholder="Tổng TL Hột..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="cannangvs" id="cannangvs" value="<!--{$searchKeyword.cannangvs}-->" placeholder="Tổng TL vàng..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tongtienhots" id="tongtienhots" value="<!--{$searchKeyword.tongtienhots}-->" placeholder="Tổng tiền hột..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tongtiencongs" id="tongtiencongs" value="<!--{$searchKeyword.tongtiencongs}-->" placeholder="Tổng tiền công..." autocomplete="off"/>
               </td>
               <td>
                  <input type="text" class="SearchCtrl InputText textwsearch autoNumericInt" name="tongtiendangoctrais" id="tongtiendangoctrais" value="<!--{$searchKeyword.tongtiendangoctrais}-->" placeholder="Tổng tiền đá/ngọc trai..." autocomplete="off"/>
               </td>
               <td>
               </td>
            </tr>
            <!--{section i loop=$view}-->
            <tr ondblclick="popupwindow('Kho-Nu-Trang-Tra-Ve-Import.php?act=view&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->','mywindow')" id="g<!--{$view[i].id}-->">
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
                  <!--{getName('admin', 'fullname', <!--{$smarty.session.admin_qlsxntjcorg_id}-->)}-->
               </td>
               <td>
                  <!--{$view[i].dated}-->
               </td>
               <td>
                  <!--{$view[i].time}-->
               </td>
               <td>
                  <!--{$view[i].slmon}-->
               </td>
               <td>
                  <!--{number_format((float)$view[i].cannangvh, 3)}-->
               </td>
               <td>
                  <!--{number_format($view[i].cannangh, 3)}-->
               </td>
               <td>
                  <!--{number_format($view[i].cannangv, 3)}-->
               </td>
               <td>
                  <!--{number_format($view[i].tongtienhot)}-->
               </td>
               <td>
                  <!--{number_format($view[i].tongtiencong)}-->
               </td>
               <td>
                  <!--{number_format($view[i].tongtiendangoctrai)}-->
               </td>
               <td>
                  <!--{if $view[i].typeimport == 0}-->
                     <!--{if $checkPer8 eq "true"}-->
                        <a href="javascript:void(0)" onclick="giahuy_chuyenKhoNguonVaogo('duyetchuyenimport', <!--{$view[i].id}-->,'1866',<!--{$phongbanchuyen}-->, '') ">
                           Duyệt chuyển
                        </a>
                     <!--{/if}-->
                  <!--{/if}-->
               </td>
            </tr>
            <!--{/section}-->
         </table>
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
   $(function() {
      $(".textsearchdated").datepicker({changeMonth: true,changeYear: true,dateFormat:"dd/mm/yy"});	
   });

   function resetsfrsearch () {

   }
</script>