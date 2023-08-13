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
        <li class="active" id="clickVang" onclick="clickVang('<!--{$path_url}-->/sources/Kho-A9-Xuat-Kho.php?cid=<!--{$smarty.request.cid}-->')">
            <a>Vàng</a>
        </li>
        <li id="clickKimCuong" onclick="clickKimCuong('<!--{$path_url}-->/sources/Kho-A9-Xuat-Kho.php?cid=<!--{$smarty.request.cid}-->')">
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
                <!--{insert name='optionChuyenDenTest' id='1826' assign="khoSanXuat_KhoVMNT"}-->
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
                            <!--{insert name='getName' table='categories' names='name_vn' id=$view[i].nhomnguyenlieuvang}-->
                        </td>
                        <td>
                            <!--{insert name='getName' table='categories' names='name_vn' id=$view[i].tennguyenlieuvang}-->
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
                        <td class="text-right">
                            <!--{$view[i].tuoivang|number_format:4:".":","}-->
                        </td>
                        <td>
                            <!--{$view[i].tienmatvang}-->
                        </td>
                        <td>
                            <!--{if $checkPer2 eq true}-->
                                <input id='showhao<!--{$view[i].id}-->' type="text" autocomplete="off" class="txtdatagirld text-right autoNumeric" value="<!--{$view[i].hao}-->" onchange="updatedong('updatedong',this.value,<!--{$view[i].id}-->,'hao','khonguonvao_khoachinct')"/>
                            <!--{else}-->
                                <!--{$view[i].hao}-->
                            <!--{/if}-->
                        </td>
                        <td>
                            <!--{if $checkPer2 eq true}-->
                                <input id='showhao<!--{$view[i].id}-->' type="text" autocomplete="off" class="txtdatagirld text-right autoNumeric" value="<!--{$view[i].hao}-->" onchange="updatedong('updatedong',this.value,<!--{$view[i].id}-->,'du','khonguonvao_khoachinct')"/>
                            <!--{else}-->
                                <!--{$view[i].du}-->
                            <!--{/if}-->
                        </td>
                        <td>
                            <!--{$view[i].ghichuvang}-->
                        </td>
                        <td align="center">
                            <!--{if $checkPer6 eq "true" }-->
                                <script>
                                    $(function () {
                                        $("#siteIDload select").select2();
                                    });
                                </script>
                                <div id="siteIDload">
                                    <select class="chuyenPhonbanSanXuat" id="chuyenkho<!--{$view[i].id}-->" onchange="chuyenKhoKhacTest('chuyenkhokhac', this.value, <!--{$view[i].id}-->,<!--{$phongbanchuyen}-->,'khonguonvao_achinh')">
                                        <option value="">--chuyển đến--</option>
                                        <!--{if $view[i].nhomnguyenlieuvang eq 372 || $view[i].nhomnguyenlieuvang eq 371}-->   <!--nhẫn trơn, JSC--> 
                                        	<!--{$khoSanXuat_KhoVMNT}-->
                                        <!--{/if}-->
                                        <!--{if $view[i].nhomnguyenlieuvang eq 75}-->   <!--Dẻ Cục--> 
                                        	<!--{$khoKhac_KhoTongDeCuc}--> 
                                        <!--{/if}-->
                                        <!--{if $view[i].nhomnguyenlieuvang eq 76}-->   <!--Nữ Trang Làm Mới--> 
                                        	<!--{$khoSanXuat_KhoLamMoi}--> 
                                        <!--{/if}-->
                                        <!--{$khoSanXuat_KhoThanhPham}-->     
                                        <!--{$khoVangChuSonNhan_KhoNguonVao}-->
                                    </select>
                                </div>
                            <!--{else}-->
                                <select disabled="disabled"></select>
                            <!--{/if}-->
                        </td>
                        <td align="center">
                        	<!--{if $checkPer2 eq "true" }-->
                        		<a href="<!--{$path_url}-->/sources/Kho-A9-Xuat-Kho.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->" title="Sửa"> 
                              		<img src="<!--{$path_url}-->/images/edit.png"/> 
                                </a>
                           	<!--{else}-->
                                 <img src="<!--{$path_url}-->/images/edit-no.png"/> 
                           	<!--{/if}--> 
                            <!--{if $checkPer7 eq "true" }-->
                            	<a href="javascript:void(0)" onclick="printKhoSanxuatXuatKho('<!--{$path_url}-->/print/print-kho-nguon-vao-xuat-kho.php?act=XuatKho&table=khonguonvao_khoachinct&id=<!--{$view[i].id}-->&cid=<!--{$phongbanchuyen}-->','mywindow')" title="Print">
                              		<img class="margin-left10" width="25px" src="<!--{$path_url}-->/images/printer.png" align="top"> 
                                </a>
                            <!--{/if}-->    
                            
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