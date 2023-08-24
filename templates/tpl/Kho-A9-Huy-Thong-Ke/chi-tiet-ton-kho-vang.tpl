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
	<form name="f" id="f" method="post" onsubmit="return searchKhoKhacKhoTongDeCucThongKe('<!--{$path_url}-->/sources/Kho-A9-Huy-Thong-Ke.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')"> 
     	<div class="MainSearch">
        	<!--{include file="./allsearch/tungay-denngay-thong-ke-kho-san-xuat.tpl"}-->
            <!--{include file="./allsearch/print-nguon-vao-nodated.tpl"}-->
            <input type="hidden" id="getUrlPrintKhoNguonVao" value="act=tonkhochitiet&table=khonguonvao_khoachinct&cid=<!--{$phongbanchuyen}-->"  />  
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td width="7%">
                        <strong>Ngày nhận</strong>
                    </td>
                    
                    <td width="7%">
                        <strong>Mã phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Nhóm N Liệu</strong>
                    </td>
                    
                    <td>
                        <strong>Tên N Liệu</strong>
                    </td>
                    
                    <td  width="8%">
                        <strong>Loại Vàng</strong>
                    </td>

                    <td width="8%">
                        <strong>Cân Nặng V+H</strong>
                    </td>
                    <td width="8%">
                        <strong>Cân Nặng H</strong>
                    </td>
                    <td width="8%">
                        <strong>Cân Nặng V</strong>
                    </td>
                    <td>
                        <strong>Tuổi Vàng</strong>
                    </td>
                    <td>
                        <strong>Tiền Mặt</strong>
                    </td>
                    <td width="8%">
                        <strong>TT Vàng Q10</strong>
                    </td>
                     <td>
                        <strong>Ghi chú</strong>
                    </td>
                    
                </tr>
                <tr>
                    <td align="center"></td>
                    <td align="center">
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/codes.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/nhomnguyenlieus.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/tennguyenlieus.tpl"}-->
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                     <td align="center"></td>
                     <td align="center"></td>
                    <td align="center">
                        <!--{include file="./allsearch/tuoivangs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/tienmats.tpl"}-->
                    </td>
                    <td align="center"></td>
                    <td align="center">
                        <!--{include file="./allsearch/ghichus.tpl"}-->
                    </td>
                </tr>
                <!--{assign var="tongVangHot" value=0}-->
                <!--{assign var="tongHot" value=0}-->
                <!--{assign var="tongVang" value=0}-->
                <!--{assign var="tongQ10" value=0}-->
                <!--{section name=i loop=$view}--> 
                    <!--{insert name='getTongQ10' cannangv=$view[i].cannangv idloaivang=$view[i].idloaivang assign="SLQ10"}-->
                   		<tr>
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
                                <!--{insert name='getName' table='categories' names='name_vn' id=$view[i].nhomnguyenlieuvang}-->
                           </td> 
                           <td>
                               <!--{insert name='getName' table='categories' names='name_vn' id=$view[i].tennguyenlieuvang}-->
                           </td> 
                           <td>
                                <!--{insert name='getName' table='loaivang' names='name_vn' id=$view[i].idloaivang}-->
                           </td> 
                           
                           <td class="text-right">
                           		<!--{assign var="tongVangHot" value=$tongVangHot+$view[i].cannangvh}-->
                                <!--{$view[i].cannangvh|number_format:3:".":","}-->
                           </td>
                           <td class="text-right">
                           		<!--{assign var="tongHot" value=$tongHot+$view[i].cannangh}-->
                                <!--{$view[i].cannangh|number_format:3:".":","}-->
                           </td>
                           <td class="text-right">
                           		<!--{assign var="tongVang" value=$tongVang+$view[i].cannangv}-->
                                <!--{$view[i].cannangv|number_format:3:".":","}-->
                           </td>
                           <td class="text-right">
                                <!--{$view[i].tuoivang}-->
                           </td>
                           
                           <td >
                                <!--{$view[i].tienmatvang}-->
                           </td>
                       	  <td class="text-right">
                                <!--{assign var="tongQ10" value=$tongQ10+$SLQ10}-->
                                <!--{$SLQ10|number_format:3:".":","}-->
                           </td>
                       		<td> 
                            	<!--{$view[i].ghichuvang}--> 
                       		</td> 
                    </tr> 
                 <!--{/section}--> 
                 <tr class="Paging fontSizeTon">
                    <td align="right" colspan="6"> <span class="colorXanh">Tổng Kho:</span> </td>
                    <td align="right"><strong class="colorXanh"> <!--{$tongVangHot|number_format:3:".":","}--> </strong></td>
                    <td align="right"><strong class="colorXanh"> <!--{$tongHot|number_format:3:".":","}--> </strong></td>
                    <td align="right"><strong class="colorXanh"> <!--{$tongVang|number_format:3:".":","}--> </strong></td>
                    <td align="right"> </td>
                    <td align="right"> </td>
                    <td align="right"><strong class="colorXanh"> <!--{$tongQ10|number_format:3:".":","}--></strong></td>
                    <td align="right"></td>
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