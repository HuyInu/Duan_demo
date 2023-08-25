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
	<form name="f" id="f" method="post" onsubmit="return KhoNguonVaoThongKeNhapXuatVang('<!--{$path_url}-->/sources/KhoSanXuat-Kho-Vmnt-Thong-Ke.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')"> 
     	<div class="MainSearch">
        	<!--{include file="./allsearch/tungay-denngay-vang-kim-cuong.tpl"}-->
            <!--{include file="./allsearch/print-kho-san-xuat.tpl"}-->
            <!--{if $checkPer7 eq "true" }-->
                <div class="formsearch"> 
                    <input type="button"  value="     Export Excel    " onclick=" return exportExcelKhoSanXuat();" class="btn-save btn-search"/> 
                </div>
            <!--{/if}-->
            <!--{if $xuatkho eq 1}-->
                <input type="hidden" id="getUrlPrintKhoNguonVao" value="act=xuatkho&table=khosanxuat_khovmnt&cid=<!--{$phongbanchuyen}-->"  />
                <input type="hidden" id="getUrlExportExcel" value="act=KhoSanXuatNhapXuat&type=xuatkho&table=khosanxuat_khovmnt&cid=<!--{$phongbanchuyen}-->"  />
            <!--{else}-->
                <input type="hidden" id="getUrlPrintKhoNguonVao" value="act=nhapkho&table=khosanxuat_khovmnt&cid=<!--{$phongbanchuyen}-->"  />
                <input type="hidden" id="getUrlExportExcel" value="act=KhoSanXuatNhapXuat&type=nhapkho&table=khosanxuat_khovmnt&cid=<!--{$phongbanchuyen}-->"  />
            <!--{/if}-->
            
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    <td>
                    	<!--{if $xuatkho eq 1}-->
                        	<strong>Ngày Xuất</strong>
                        <!--{else}-->
                        	<strong>Ngày nhập</strong>
                        <!--{/if}-->
                    </td>

                    <td>
                        <strong>Mã Phiếu</strong>
                    </td>
					 
                    <td>
                        <strong>Loại Vàng</strong>
                    </td>
                    
                    <td>
                        <strong>Cân Nặng V+H</strong>
                    </td>
                   
                    <td>
                        <strong>Cân Nặng H</strong>
                    </td>
                    <td>
                        <strong>Cân Nặng V</strong>
                    </td>
                    
                    <td width="15%">
                    	<!--{if $xuatkho eq 1}-->
                        	<strong>Phòng SX</strong>
                        <!--{else}-->
                        	<strong>Phòng Chuyển</strong>
                        <!--{/if}-->
                    </td>
                    <td>
                        <strong>Mã ĐH</strong>
                    </td>
                    <td>
                        <strong>Ghi Chú</strong>
                    </td>
                </tr>
                <tr>
                    <td align="center"></td>
                    <td align="center"></td>
                    
                     <td align="center">
                        <!--{include file="./allsearch/codes.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{insert name='loadloaivang' idloaivang=$loaivangs}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/cannangvhs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/cannanghs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/cannangvs.tpl"}-->
                    </td>
                    <td align="center">
                    	<!--{if $xuatkho eq 1}-->
                    		<!--{include file="./allsearch/phongsxs.tpl"}-->
                        <!--{else}-->
                       		<!--{include file="./allsearch/phongchuyens.tpl"}--> 
                        <!--{/if}-->
                    </td>
                    <td align="center">
                    	<!--{include file="./allsearch/madhsxs.tpl"}-->
                    </td>
                    <td align="center">
                    	<!--{include file="./allsearch/ghichus.tpl"}-->
                    </td>
                </tr>
                <!--{section name=i loop=$view}--> 
                    <tr id="g<!--{$view[i].id}-->">
                        <td>
                            <!--{$smarty.section.i.index+1+$number}-->
                       </td>
                       <td>
                       		<!--{if $xuatkho eq 1}-->
                                <!--{$view[i].datedxuat|date_format:"%d/%m/%Y"}-->
                            <!--{else}-->
                                <!--{$view[i].dated|date_format:"%d/%m/%Y"}-->
                            <!--{/if}-->
                       </td>
                       <td>
                            <!--{$view[i].maphieu}-->
                       </td>
                       <td>
                       		<!--{insert name='getName' table='loaivang' names='name_vn' id=$view[i].idloaivang}-->
                       </td> 
                       <td class="text-right">
                       		<!--{assign var="tcannangvh" value=$view[i].cannangvh}-->
                            <!--{$tcannangvh|number_format:3:".":","}-->
                       </td> 
                       <td class="text-right">
                            <!--{$view[i].cannangh|number_format:3:".":","}-->
                       </td>
                        <td class="text-right">
                        	<!--{assign var="tcannangv" value=$view[i].cannangv}-->
                            <!--{$tcannangv|number_format:3:".":","}-->
                       </td>
                       <td>
                       		<!--{if $xuatkho eq 1}-->
                                <!--{if $view[i].chonphongbanin gt 0}--> 
                                    <!--{insert name='getNamKhoSanXuat' id=$view[i].chonphongbanin}--> 
                                <!--{/if}-->     
                            <!--{else}-->
                               <!--{if $view[i].cidchuyen gt 0}-->
                                    <!--{$view[i].typekhodau}-->
                                <!--{/if}-->
                            <!--{/if}-->
                       </td>
                       <td>
                       		<!--{if $view[i].madhin gt 0}-->
                            	<!--{insert name='getNamMaDonHangCatalog' madhin=$view[i].madhin}--> 
                            <!--{/if}-->
                       </td>
                       <td>
                            <!--{$view[i].ghichuvang}-->
                       </td>
                       
                       <!--{assign var="tongCannangvh" value=$tongCannangvh+$tcannangvh}-->
                       <!--{assign var="tongCannangh" value=$tongCannangh+$view[i].cannangh}-->
                       <!--{assign var="tongCannangv" value=$tongCannangv+$tcannangv}--> 
                    </tr>  
                 <!--{/section}--> 
                 <tr class="Paging fontSizeTon">
                    <td align="right" colspan="4"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                    <td align="right"><span class="colorXanh"> <!--{$tongCannangvh|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tongCannangh|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tongCannangv|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                </tr>  
                <!--{section name=j loop=$totalLoaivang}--> 
                    <tr class="Paging fontSizeTon">
                        <td align="right" colspan="4"><!--{insert name='getName' table='loaivang' names='name_vn' id=$totalLoaivang[j].idloaivang}--></td>
                        <td align="right"><!--{$totalLoaivang[j].cannangvh}--></td>
                        <td align="right"><!--{$totalLoaivang[j].cannangh}--></td>
                        <td align="right"><!--{$totalLoaivang[j].cannangv}--></td>
                        <td align="right"></td>
                        <td align="right"></td>
                         <td align="right"></td>
                    </tr> 
                <!--{/section}--> 
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="4"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.cannangvh}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.cannangh}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.cannangv}--> </span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                </tr>                                          
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
<script type="text/javascript" src="<!--{$path_url}-->/js/tim-kiem.js"></script>