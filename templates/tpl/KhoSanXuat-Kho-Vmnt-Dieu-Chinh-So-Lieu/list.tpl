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
	<form name="fMaPhierChinhSuaSoLieu" id="fMaPhierChinhSuaSoLieu" method="post" onsubmit="return searchKhoDauVaoXuatVang('<!--{$path_url}-->/sources/KhoSanXuat-Kho-Vmnt-Dieu-Chinh-So-Lieu.php?cid=<!--{$smarty.request.cid}-->')"> 
     	<div class="SearchMaPhieu">
        	<div class="formsearch">
                 <label class="Fl labelsearch"> Mã phiếu: </label>
                 <input type="text" name="maphieus" id="maphieus" value="<!--{$maphieus}-->" class="InputText" placeholder="Tìm mã phiếu" onkeyup="lookupChinhSuaSoLieu('<!--{$path_url}-->','KhoSanXuatChinhSuaSoLieu','khosanxuat_khovmnt',this.value);" autocomplete="off"/>
                <div id="suggestions" style="margin:3px 0 0 0;"></div>
            </div>
        	<!--{include file="./allsearch/tungay-denngay-vang-kim-cuong.tpl"}-->
            <div style="clear:both"></div>
            
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td width="7%">
                        <strong>Ngày nhập</strong>
                    </td>
                    
                    <td width="7%">
                        <strong>Mã phiếu</strong>
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
                    <td>
                        <strong>Phòng SX</strong>
                    </td>
                    <td>
                        <strong>Mã ĐH</strong>
                    </td>
                     <td width="10%">
                        <strong>Ghi chú</strong>
                    </td>
                    <td>
                        <strong>TT Nhập Xuất</strong>
                    </td>
                    <td width="6%">
                        <strong>Ngày Sửa</strong>
                    </td>
                    <td width="10%">
                        <strong>Ghi chú sửa</strong>
                    </td>
                    <td>
                        <strong>Sửa</strong>
                    </td>
                </tr>
                <tr>
                    <td align="center"></td>
                    <td align="center">
                        <!--{include file="./allsearch/daychungtus.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/codes.tpl"}-->
                    </td>
                    
                    <td align="center">
                        <!--{include file="./allsearch/loaivangs.tpl"}-->
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
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <!--{section name=i loop=$view}--> 
                    <tr id="g<!--{$view[i].id}-->">
                        <td>
                            <!--{$smarty.section.i.index+1+$number}-->
                       </td>
                       <td>
                            <!--{$view[i].dated|date_format:"%d/%m/%Y"}-->
                       </td>
                       <td>
                            <!--{$view[i].maphieu}-->
                       </td>
                       
                       <td>
                       		<!--{insert name='getName' table='loaivang' names='name_vn' id=$view[i].idloaivang}-->
                       </td> 
                       <td class="text-right">
                            <!--{$view[i].cannangvh|number_format:3:".":","}-->
                       </td> 
                       <td class="text-right">
                            <!--{$view[i].cannangh|number_format:3:".":","}-->
                       </td>
                        <td class="text-right">
                            <!--{$view[i].cannangv|number_format:3:".":","}-->
                       </td>
                       
                       <td> 
                       		<!--{if $view[i].chonphongbanin gt 0}--> 
                       			<!--{insert name='getNamKhoSanXuat' id=$view[i].chonphongbanin}--> 
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
                       <td>
                            <!--{if $view[i].type eq 1}-->
                            	Nhập Kho
                            <!--{else}--> 
                            	Xuất Kho
                            <!--{/if}-->     
                       </td>
                       <td>
                            <!--{$view[i].datedieuchinh|date_format:"%d/%m/%Y"}-->
                       </td>
                       <td>
                            <!--{$view[i].ghichueditvang}-->
                       </td>
                      <td align="center">
                        	<!--{if $checkPer2 eq "true" }-->
                        		<a href="<!--{$path_url}-->/sources/KhoSanXuat-Kho-Vmnt-Dieu-Chinh-So-Lieu.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->" title="Sửa"> 
                              		<img src="<!--{$path_url}-->/images/edit.png"/> 
                                </a>
                           	<!--{else}-->
                                 <img src="<!--{$path_url}-->/images/edit-no.png"/> 
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
<script type="text/javascript" src="<!--{$path_url}-->/js/tim-kiem.js"></script>

<script type="text/javascript" src="<!--{$path_url}-->/js/select-checkbox/sol.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/js/select-checkbox/sol.css" />