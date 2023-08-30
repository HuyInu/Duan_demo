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
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<!--{$path_url}-->/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?act=add&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/add.png">
                </a> 
            
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/delete.png">
               	</a> 
        </li>
    </ul>
</div>
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit="return searchKhoDauVaoXuatVang('<!--{$path_url}-->/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?cid=<!--{$smarty.request.cid}-->')"> 
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
                    <td width="4%" align="center">
                        <strong>Tuổi vàng</strong>
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
                    <td class="tdShowHide">
                        <strong>Duyệt chuyển</strong>
                    </td>
                    <td>
                        <strong>Sửa/print</strong>
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
                </tr>
                
                <!--{section name=i loop=$phieuXuat}--> 
                    <tr id="g<!--{$phieuXuat[i].id}-->">
                    	<td>
                           <input type="checkbox" value="<!--{$phieuXuat[i].id}-->" name="iddel[]" id="check<!--{$smarty.section.i.index}-->">
                        </td>
                        <td>
                            <!--{$smarty.section.i.index+1+$number}-->
                       </td>
                       <td>
                            <!--{$phieuXuat[i].dated|date_format:"%d/%m/%Y"}-->
                       </td>
                       <td>
                            <!--{$phieuXuat[i].maphieu}-->
                       </td>
                       
                       <td>
                       		<!--{insert name='getName' table='loaivang' names='name_vn' id=$phieuXuat[i].idloaivang}-->
                       </td> 
                       <td class="text-right">
                            <!--{$phieuXuat[i].cannangvh|number_format:3:".":","}-->
                       </td> 
                       <td class="text-right">
                            <!--{$phieuXuat[i].cannangh|number_format:3:".":","}-->
                       </td>
                        <td class="text-right">
                            <!--{$phieuXuat[i].cannangv|number_format:3:".":","}-->
                       </td>
                       <td class="text-right">
                            <!--{$phieuXuat[i].tuoivang|number_format:4:".":","}-->
                       </td>
                       <td> 
                       		<!--{if $phieuXuat[i].chonphongbanin gt 0}--> 
                       			<!--{insert name='getNamKhoSanXuat' id=$phieuXuat[i].chonphongbanin}--> 
                            <!--{/if}-->     
                       </td> 
                        <td>
                        	<!--{if $phieuXuat[i].madhin gt 0}-->  
                       			<!--{insert name='getNamMaDonHangCatalog' madhin=$phieuXuat[i].madhin}--> 
                            <!--{/if}--> 
                       </td> 
					   <td>
                            <!--{$phieuXuat[i].ghichuvang}-->
                       </td>
                       
                       <td align="center">
                            <select class="selectOption" id="chuyenkho<!--{$phieuXuat[i].id}-->" onchange="giahuy_chuyenKhoSanXuat('chuyenkhosanxuat', this.value, '<!--{$phieuXuat[i].id}-->','<!--{$phongbanchuyen}-->','khosanxuat_vmnt')">
                                <option value="">--chuyển đến--</option>
                                <!--{insert name='optionChuyenDen' id=$phieuXuat[i].chonphongbanin}-->
                            </select>  
                       </td>
                        
                      <td align="center">
                            <a href="<!--{$path_url}-->/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$phieuXuat[i].id}-->" title="Sửa"> 
                                <img src="<!--{$path_url}-->/images/edit.png"/> 
                            </a> 
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