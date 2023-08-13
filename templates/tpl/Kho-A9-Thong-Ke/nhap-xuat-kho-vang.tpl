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
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    <td>
                        <strong>Ngày Nhập Xuất</strong>
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
                        <strong>Tuổi vàng</strong>
                    </td>
                    
                    <td>
                        <strong>Cân Nặng V+H Nhập</strong>
                    </td>
                   
                    <td>
                        <strong>Cân Nặng H Nhập</strong>
                    </td>
                    <td>
                        <strong>Cân Nặng V Nhập</strong>
                    </td>
                    
                    <td>
                        <strong>Cân Nặng V+H Xuất</strong>
                    </td>
                   
                    <td>
                        <strong>Cân Nặng H Xuất</strong>
                    </td>
                    <td>
                        <strong>Cân Nặng V Xuất</strong>
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
                        <!--{include file="./allsearch/tuoivangs.tpl"}-->
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                   <td align="center"></td>
                    <td align="center"></td>
                    
                </tr>
                <!--{section name=i loop=$view}-->
                	<!--{assign var="checkKhoanTuNgayDenNgayXK" value=0}-->
                	<!--{insert name='checkKhoanTuNgayDenNgayNhapKho' dated = $view[i].dated fromdays = $fromdayCheck todays = $todaycheck assign="checkKhoanTuNgayDenNgayNK"}-->
                    <!--{if $view[i].trangthai eq 2}--> <!--Xuất Kho-->  
                		<!--{insert name='checkKhoanTuNgayDenNgayXuatKho' datedxuat = $view[i].dated fromdays = $fromdayCheck todays = $todaycheck assign="checkKhoanTuNgayDenNgayXK"}--> 
                    <!--{/if}-->
                    <tr id="g<!--{$view[i].id}-->">
                        <td>
                            <!--{$smarty.section.i.index+1+$number}-->
                       </td>
                       <td>
                       		<!--{$view[i].dated|date_format:"%d-%m-%Y"}-->
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
                       <td>
                            <!--{$view[i].tuoivang}-->
                       </td>
                        
                       <td class="text-right">
                       		<!--{if $checkKhoanTuNgayDenNgayNK eq 1}-->
                                <!--{assign var="tcannangvhnhap" value=$tcannangvhnhap+$view[i].cannangvh}-->
                                <!--{$view[i].cannangvh|number_format:3:".":","}--> 
                            <!--{/if}-->     
                       </td> 
                       <td class="text-right">
                       		<!--{if $checkKhoanTuNgayDenNgayNK eq 1}-->
                            	<!--{assign var="tcannanghnhap" value=$tcannanghnhap+$view[i].cannangh}-->
                            	<!--{$view[i].cannangh|number_format:3:".":","}-->
                            <!--{/if}-->
                       </td>
                        <td class="text-right">
                        	<!--{if $checkKhoanTuNgayDenNgayNK eq 1}-->
                                <!--{assign var="tcannangvnhap" value=$tcannangvnhap+$view[i].cannangv}-->
                                <!--{$view[i].cannangv|number_format:3:".":","}-->
                            <!--{/if}-->
                       </td>
                       
                        <td class="text-right">
                            <!--{if $checkKhoanTuNgayDenNgayXK eq 1}-->
                                <!--{assign var="tcannangvh" value=$view[i].cannangvh}-->
                                <!--{assign var="tcannangvhxuat" value=$tcannangvhxuat+$tcannangvh}-->
                                <!--{$tcannangvh|number_format:3:".":","}-->
                            <!--{/if}-->   
                       </td> 
                       <td class="text-right">
                            <!--{if $checkKhoanTuNgayDenNgayXK eq 1}-->
                                <!--{assign var="tcannanghxuat" value=$tcannanghxuat+$view[i].cannangh}-->
                                <!--{$view[i].cannangh|number_format:3:".":","}-->
                            <!--{/if}-->  
                       </td>
                        <td class="text-right">
                            <!--{if $checkKhoanTuNgayDenNgayXK eq 1}-->
                                <!--{assign var="tcannangv" value=$view[i].cannangv}-->
                                <!--{assign var="tcannangvxuat" value=$tcannangvxuat+$tcannangv}-->
                                <!--{$tcannangv|number_format:3:".":","}--> 
                            <!--{/if}--> 
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
                       <!--{assign var="tonghao" value=$tonghao+$view[i].hao}-->
                       <!--{assign var="tongdu" value=$tongdu+$view[i].du}-->
                    </tr> 
                 <!--{/section}--> 
                 <tr class="Paging fontSizeTon">
                    <td align="right" colspan="7"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                    <td align="right"><span class="colorXanh"> <!--{$tcannangvhnhap|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tcannanghnhap|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tcannangvnhap|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tcannangvhxuat|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tcannanghxuat|number_format:3:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tcannangvxuat|number_format:3:".":","}--> </span></td>
                    <td align="right"> <!--{$tonghao|number_format:3:".":","}--> </td>
                    <td align="right"> <!--{$tongdu|number_format:3:".":","}--> </td>
                    <td align="center"></td>
                </tr>    
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="7"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotalnhap.cannangvh}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotalnhap.cannangh}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotalnhap.cannangv}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotalxuat.cannangvh}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotalxuat.cannangh}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotalxuat.cannangv}--> </span></td>
                    <td align="right"> <!--{$gettotalxuat.hao}--> </td>
                    <td align="right"> <!--{$gettotalxuat.du}--> </td>
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