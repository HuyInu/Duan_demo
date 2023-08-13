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
<div class="ChonLoaiPhieu">
    <ul>
        <li class="active" id="clickVang" onclick="clickVang('<!--{$path_url}-->/sources/Kho-A9-Thong-Ke.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')">
            <a>Vàng</a>
        </li>
        <li id="clickKimCuong" onclick="clickKimCuong('<!--{$path_url}-->/sources/Kho-A9-Thong-Ke.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')">
            <a>Kim Cương</a>
        </li>
    </ul>
</div>
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit="return KhoNguonVaoThongKeNhapXuatVang('<!--{$path_url}-->/sources/Kho-A9-Thong-Ke.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')"> 
     	<div class="MainSearch">
        	<!--{include file="./allsearch/tungay-denngay-vang-kim-cuong.tpl"}-->
            <!--{include file="./allsearch/print-nguon-vao.tpl"}-->
            <!--{if $checkNhapXuat eq 1}-->
            	<input type="hidden" id="getUrlPrintKhoNguonVao" value="act=nhapkho&table=khonguonvao_khoachinct&typevkc=1&cid=<!--{$phongbanchuyen}-->"  />
            <!--{else}-->
            	<input type="hidden" id="getUrlPrintKhoNguonVao" value="act=xuatkho&table=khonguonvao_khoachinct&typevkc=1&cid=<!--{$phongbanchuyen}-->"  />
            <!--{/if}-->
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    <td>
                    	<!--{if $checkNhapXuat eq 1}-->
                            <strong>Ngày nhập</strong>
                        <!--{else}-->
                            <strong>Ngày xuất</strong>
                        <!--{/if}-->  
                    </td>

                    <td>
                        <strong>Mã Phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Nhóm N Liệu</strong>
                    </td>
                    
                    <td>
                        <strong>Tên N Liệu</strong>
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
                        <strong>Tuổi vàng</strong>
                    </td>
                    
                    <td width="4%">
                        <strong>Hao</strong>
                    </td>
                    <td width="4%">
                        <strong>Dư</strong>
                    </td>
                    <td>
                        <strong>Tiền mặt</strong>
                    </td> 
                    <td>
                        <strong>Ghi chú</strong>
                    </td> 
                </tr>
                <tr>
                    <td align="center"></td>
                    <td align="center"></td>
                    
                     <td align="center">
                        <!--{include file="./allsearch/codes.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/chonnhomnguyenlieus.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/chontennguyenlieus.tpl"}-->
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
                        <!--{include file="./allsearch/tuoivangs.tpl"}-->
                    </td>
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
                       		<!--{if $checkNhapXuat eq 1}-->
                                <!--{$view[i].dated|date_format:"%d/%m/%Y"}-->
                            <!--{else}-->
                                <!--{$view[i].datedxuat|date_format:"%d/%m/%Y"}-->
                            <!--{/if}-->  
                       </td>
                       <td>
                       		<!--{if $checkNhapXuat eq 1}-->
                            	<!--{$view[i].maphieu|replace:"PXK":"PNK"}-->
                            <!--{else}-->
                                <!--{$view[i].maphieu}-->
                            <!--{/if}-->      
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
                            <!--{$view[i].tuoivang}-->
                       </td>
                        <td align="right">
                        	<!--{$view[i].hao}-->
                       </td>
                       <td align="right">
                       		<!--{$view[i].du}-->
                       </td>
                       <td>
                            <!--{$view[i].tienmatvang}-->
                       </td>
                       <td>
                            <!--{$view[i].ghichuvang}-->
                       </td>
                       <!--{assign var="tongCannangvh" value=$tongCannangvh+$tcannangvh}-->
                       <!--{assign var="tongCannangh" value=$tongCannangh+$view[i].cannangh}-->
                       <!--{assign var="tongCannangv" value=$tongCannangv+$tcannangv}--> 
                       
                       <!--{assign var="tonghao" value=$tonghao+$view[i].hao}-->
                       <!--{assign var="tongdu" value=$tongdu+$view[i].du}-->
                    </tr>  
                 <!--{/section}--> 
                 <tr class="Paging fontSizeTon">
                    <td align="right" colspan="6"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                    <td align="right"><span class="colorXanh"> <!--{$tongCannangvh|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tongCannangh|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tongCannangv|number_format:3:".":","}--> </span></td>
                    <td align="center"></td>
                    <td align="right"> <!--{$tonghao|number_format:3:".":","}--> </td>
                    <td align="right"> <!--{$tongdu|number_format:3:".":","}--> </td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>  
                <!--{section name=j loop=$totalLoaivang}--> 
                    <tr class="Paging fontSizeTon">
                        <td align="right" colspan="6"><!--{insert name='getName' table='loaivang' names='name_vn' id=$totalLoaivang[j].idloaivang}--></td>
                        <td align="right"><!--{$totalLoaivang[j].cannangvh}--></td>
                        <td align="right"><!--{$totalLoaivang[j].cannangh}--></td>
                        <td align="right"><!--{$totalLoaivang[j].cannangv}--></td>
                        <td align="center"></td>
                        <td align="right"> <!--{$totalLoaivang[j].hao}--> </td>
                        <td align="right"> <!--{$totalLoaivang[j].du}--> </td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr> 
                <!--{/section}--> 
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="6"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.cannangvh}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.cannangh}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.cannangv}--> </span></td>
                    <td align="center"></td>
                    <td align="right"> <!--{$gettotal.hao}--> </td>
                    <td align="right"> <!--{$gettotal.du}--> </td>
                    <td align="center"></td>
                    <td align="center"></td>
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