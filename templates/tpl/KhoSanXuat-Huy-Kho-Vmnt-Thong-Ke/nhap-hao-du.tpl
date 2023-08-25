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
            <input type="hidden" id="getUrlPrintKhoNguonVao" value="act=haodu&table=khosanxuat_khovmnthaodu&cid=<!--{$phongbanchuyen}-->"  />
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    <td>
                    	<strong>Ngày nhập</strong>
                    </td>

                    <td>
                        <strong>Mã Phiếu</strong>
                    </td>

                    <td>
                        <strong>Loại Vàng</strong>
                    </td>
                    
                    <td>
                        <strong>Hao Kết Dẻ</strong>
                    </td>
                   
                    <td>
                        <strong>Du Kết Dẻ</strong>
                    </td>
                    
                    <td>
                        <strong>Hao Chênh Lệch</strong>
                    </td>
                   
                    <td>
                        <strong>Du Chênh Lệch</strong>
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
                       		<!--{assign var="thao" value=$view[i].hao}-->
                            <!--{$thao|number_format:3:".":","}-->
                       </td> 
                        <td class="text-right">
                        	<!--{assign var="tdu" value=$view[i].du}-->
                            <!--{$tdu|number_format:3:".":","}-->
                       </td>
                       
                       <td class="text-right">
                       		<!--{assign var="thaochenhlech" value=$view[i].haochenhlech}-->
                            <!--{$thaochenhlech|number_format:3:".":","}-->
                       </td> 
                        <td class="text-right">
                        	<!--{assign var="tduchenhlech" value=$view[i].duchenhlech}-->
                            <!--{$tduchenhlech|number_format:3:".":","}-->
                       </td>
                       <td>
                            <!--{$view[i].ghichu}-->
                       </td>
                       <!--{assign var="tongHao" value=$tongHao+$thao}-->
                       <!--{assign var="tongDu" value=$tongDu+$tdu}--> 
                       
                       <!--{assign var="tongHaochenhlech" value=$tongHaochenhlech+$thaochenhlech}-->
                       <!--{assign var="tongDuchenhlech" value=$tongDuchenhlech+$view[i].tduchenhlech}--> 
                    </tr>  
                 <!--{/section}--> 
                 <tr class="Paging fontSizeTon">
                    <td align="right" colspan="4"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                    <td align="right"><span class="colorXanh"> <!--{$tongHao|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tongDu|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tongHaochenhlech|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tongDuchenhlech|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                </tr>  
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="4"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.hao}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.du}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.haochenhlech}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.duchenhlech}--> </span></td>
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