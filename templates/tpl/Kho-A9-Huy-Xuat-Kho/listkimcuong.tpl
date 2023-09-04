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
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/Kho-A9-Xuat-Kho.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
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
	<form name="f" id="f" method="post" onsubmit="return searchKhoDauVaoXuatKimCuong('<!--{$path_url}-->/sources/Kho-A9-Xuat-Kho.php?cid=<!--{$smarty.request.cid}-->')"> 
     	<div class="MainSearch">
        	<!--{include file="./allsearch/tungay-denngay-vang-kim-cuong.tpl"}-->
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                	<td class="tdcheck"></td>
                    <td  class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td>
                        <strong>Ngày nhập</strong>
                    </td>
                    
                    <td>
                        <strong>Mã phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Tên Kim Cương</strong>
                    </td>
                    
                    <td>
                        <strong>MS GĐPNJ</strong>
                    </td>
                    <td>
                        <strong>MS Cạnh GIA</strong>
                    </td>
                    <td>
                        <strong>Kích Thước</strong>
                    </td>
                    <td>
                        <strong>Trọng Lượng Hột</strong>
                    </td>
                    <td>
                        <strong>Độ Tinh Khiết</strong>
                    </td>
                    
                     <td>
                        <strong>Cấp Độ Màu</strong>
                    </td>
                    <td>
                        <strong>Độ Mài Bóng</strong>
                    </td>
                    <td>
                        <strong>Kích Thước Bán</strong>
                    </td>
                    
                    <td>
                        <strong>Tiền Mặt</strong>
                    </td>
                    <td>
                        <strong>Đơn Giá</strong>
                    </td>
                     <td>
                        <strong>Ghi chú</strong>
                    </td>
                    <td>
                        <strong>Duyệt Chuyển</strong>
                    </td>
                    <td>
                        <strong>Sửa</strong>
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
                        <!--{include file="./allsearch/tenkimcuongs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/masogdpnjs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/mscanhgtas.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/kichthuocs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/trongluonghots.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/dotinhkhiets.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/capdomaus.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/domaibongs.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/kichthuocbans.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/tienmats.tpl"}-->
                    </td>
                    <td align="center">
                    	<!--{include file="./allsearch/dongias.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/ghichus.tpl"}-->
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
 				<!--{insert name='optionChuyenDen' id='284' assign="khoThanhPham_KhoKimCuongNhatHot"}-->
                <!--{insert name='optionChuyenDen' id='205' assign="khoKhac_KhoKimCuongEpTem"}-->
                <!--{insert name='optionChuyenDen' id='811' assign="khoSanXuat_KhoThanhPham"}-->
                <!--{section name=i loop=$view}--> 
                    <tr id="g<!--{$view[i].id}-->">
                    	<td>
                           <input type="checkbox" value="<!--{$view[i].id}-->" name="iddel[]" id="check<!--{$smarty.section.i.index}-->">
                        </td>
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
                             <!--insert name='getName' table='loaikimcuonghotchu' names='size' id=$view[i].idkimcuong}-->::<!--insert name='getName' table='loaikimcuonghotchu' names='name_vn' id=$view[i].idkimcuong-->
                       </td> 
                       <td>
                           	<!--{$view[i].codegdpnj}-->
                       </td> 
                       <td>
                       		<!--{$view[i].codecgta}-->
                       </td> 
                       <td>
                            <!--{$view[i].kichthuoc}-->
                       </td> 
                       <td>
                            <!--{$view[i].trongluonghot}-->
                       </td>
                        <td>
                            <!--{$view[i].dotinhkhiet}-->
                       </td>
                       <td>
                            <!--{$view[i].capdomau}-->
                       </td>
                       <td>
                            <!--{$view[i].domaibong}-->
                       </td>
                       <td>
                            <!--{$view[i].kichthuocban}-->
                       </td> 
                       <td>
                            <!--{$view[i].tienmatkimcuong}-->
                       </td> 
                       <td class="text-right">
                            <!--{$view[i].dongiaban|number_format:3:".":","}-->
                       </td> 
                        
                       <td>
                       		<!--{if $checkPer2 eq "true" }-->
                            	<input type="text" autocomplete="off" class="txtdatagirld" value="<!--{$view[i].ghichukimcuong}-->" onchange="updatedong('updatedong',this.value,<!--{$view[i].id}-->,'ghichukimcuong','khonguonvao_khoachinct')"/>
                             <!--{else}-->
                            	<!--{$view[i].ghichukimcuong}-->
                            <!--{/if}-->
                       </td> 
                       <td align="center">
                            <!--{if 1 == 1 }-->  
                            	<script>
									$(function () {
										$("#siteIDload select").select2();
									});
								</script>
								<div id="siteIDload">                         		
                                    <select class="chuyenPhonbanSanXuat" id="chuyenkho<!--{$view[i].id}-->" onchange="giahuy_chuyenKhoKhac('chuyenkhokhac', this.value, <!--{$view[i].id}-->,<!--{$phongbanchuyen}-->,'khonguonvao_achinh')">
                                        <option value="">--chuyển đến--</option>
                                        <!--{$khoThanhPham_KhoKimCuongNhatHot}-->
                                        <!--{$khoSanXuat_KhoThanhPham}-->
                                        <!--{$khoKhac_KhoKimCuongEpTem}-->
                                        <!--{optionChuyenDenTest('1834')}-->
                                        
                                    </select> 
                                </div> 
                            <!--{else}-->
                                <select disabled="disabled"></select>  
                            <!--{/if}-->  
                       </td> 
                      <td align="center">
                            <a href="<!--{$path_url}-->/sources/Kho-A9-Huy-Xuat-Kho.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->" title="Sửa"> 
                                <img src="<!--{$path_url}-->/images/edit.png"/> 
                            </a>                     
                       </td>
                       <td>
                      	   <!--{if $view[i].tralai eq 1}-->	
                           		<a>Trả Lại</a>
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