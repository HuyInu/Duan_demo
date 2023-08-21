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
            <a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/Kho-A9-Huy-Xuat-Kho.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
                <img src="<!--{$path_url}-->/images/delete.png">
            </a> 
        </li>
    </ul>
</div>
<div class="ChonLoaiPhieu">
    <ul>
        <li class="active" id="clickVang" onclick="clickVang('<!--{$path_url}-->/sources/Kho-A9-Huy-Xuat-Kho.php?cid=<!--{$smarty.request.cid}-->')">
            <a>Vàng</a>
        </li>
        <li id="clickKimCuong" onclick="clickKimCuong('<!--{$path_url}-->/sources/Kho-A9-Huy-Xuat-Kho.php?cid=<!--{$smarty.request.cid}-->')">
            <a>Kim Cương</a>
        </li>
    </ul>
</div>
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit="return searchKhoDauVaoXuatVang('<!--{$path_url}-->/sources/Kho-A9-Xuat-Kho.php?cid=<!--{$smarty.request.cid}-->')"> 
     	<div class="MainSearch">
        	<!--{include file="./allsearch/tungay-denngay-vang-kim-cuong.tpl"}-->
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                	<td class="tdcheck"></td>
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
                    <td>
                        <strong>Tiền Mặt</strong>
                    </td>
                    <td width="4%">
                        <strong>Hao</strong>
                    </td>
                    <td width="4%">
                        <strong>Dư</strong>
                    </td>
                     <td width="10%">
                        <strong>Ghi chú</strong>
                    </td>
                    <td>
                        <strong>Duyệt Chuyển</strong>
                    </td>
                     <td>
                        <strong>Sửa/print</strong>
                    </td>
                     <td>
                        <strong>Trạng thái</strong>
                    </td>
                </tr>
                <tr>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center">
                        <!--{include file="./allsearch/daychungtus.tpl"}-->
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
                    <td align="center">
                        <!--{include file="./allsearch/tuoivangs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/tienmats.tpl"}-->
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center">
                        <!--{include file="./allsearch/ghichus.tpl"}-->
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                <!--{optionChuyenDenTest('623') assign="khoSanXuat_KhoVMNT"}-->
                <!--{section i $phieuXuatList}-->
                <tr class="">
                	<td class="tdcheck">
                        <input type="checkbox" name="iddle[]" value="<!--{$phieuXuatList[i].id}-->"
                    </td>
                    <td class="tdSTT">
                        <!--{$smarty.section.i.index + 1}-->
                    </td>
                    
                    <td width="7%">
                        <!--{$phieuXuatList[i].dated|date_format:"%d/%m/%Y"}-->
                    </td>
                    
                    <td width="7%">
                        <!--{$phieuXuatList[i].maphieu}-->
                    </td>
                    
                    <td>
                        <!--{getName('categories', 'name_vn', <!--{$phieuXuatList[i].nhomnguyenlieuvang}-->)}-->
                    </td>
                    
                    <td>
                        <!--{getName('categories', 'name_vn', <!--{$phieuXuatList[i].tennguyenlieuvang}-->)}-->
                    </td>
                    
                    <td>
                        <!--{getName('categories', 'name_vn', <!--{$phieuXuatList[i].idloaivang}-->)}-->
                    </td>
                    
                    <td>
                        <!--{$phieuXuatList[i].cannangvh|number_format:3:".":","}-->
                    </td>
                   
                    <td>
                        <!--{$phieuXuatList[i].cannangh|number_format:3:".":","}-->
                    </td>
                    <td>
                        <!--{$phieuXuatList[i].cannangv|number_format:3:".":","}-->
                    </td>
                    <td>
                        <!--{$phieuXuatList[i].tuoivang|number_format:4:".":","}-->
                    </td>
                    <td>
                        <!--{$phieuXuatList[i].tienmatvang}-->
                    </td>
                    <td width="4%">
                        <input id='showhao<!--{$phieuXuatList[i].id}-->' type="text" autocomplete="off" class="txtdatagirld text-right autoNumeric" value="<!--{$phieuXuatList[i].hao}-->" onchange="updatedong('updatedong',this.value,<!--{$phieuXuatList[i].id}-->,'hao','khonguonvao_khoachinct')"/>
                    </td>
                    <td width="4%">
                        <input id='showhao<!--{$phieuXuatList[i].id}-->' type="text" autocomplete="off" class="txtdatagirld text-right autoNumeric" value="<!--{$phieuXuatList[i].du}-->" onchange="updatedong('updatedong',this.value,<!--{$phieuXuatList[i].id}-->,'du','khonguonvao_khoachinct')"/>
                    </td>
                     <td width="10%">
                        <!--{$phieuXuatList[i].ghichuvang}-->
                    </td>
                    <td>
                        <script>
                            $(function () {
                                $("#siteIDload select").select2();
                            });
                        </script>
                        <div id="siteIDload">                       		
                            <select class="chuyenPhonbanSanXuat" id="chuyenkho<!--{$phieuXuatList[i].id}-->" onchange="giahuy_chuyenKhoKhac('chuyenkhokhac', this.value, <!--{$phieuXuatList[i].id}-->,<!--{$phongbanchuyen}-->,'khonguonvao_achinh')">
                                <option value="">--chuyển đến--</option> 
                                <!--{$khoSanXuat_KhoVMNT}--> 
                            </select> 
                        </div>
                    </td>
                     <td>
                        <strong>Sửa/print</strong>
                    </td>
                     <td>
                        <strong>Trạng thái</strong>
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