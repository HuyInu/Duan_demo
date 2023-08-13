<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<!--{$path_url}-->/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
       <!--{getHearderCat(array(cid=>$smarty.request.cid, root=>$smarty.request.root, act=>$smarty.request.act))}-->
    </ul>
</div>
<div class="goAction">
	<ul>
    	<li>
            <!--{if $checkPer1 eq "true" }-->
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<!--{$path_url}-->/sources/KhoSanXuat-Kho-Kv-Xuat-Kho.php?act=add&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/add.png">
                </a> 
            <!--{else}-->  
                <a>
                    <img src="<!--{$path_url}-->/images/add-no.png">
                </a> 	
            <!--{/if}--> 
            
            
        </li>
    </ul>
</div>
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit="return searchKhoDauVaoXuatVang('<!--{$path_url}-->/sources/KhoSanXuat-Kho-Vmnt-Xuat-Kho.php?cid=<!--{$smarty.request.cid}-->')"> 
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
                       		<!--{getname('loaivang', 'name_vn', $view[i].idloaivang)}-->
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
                       		<!--{if $view[i].chonphongbanin gt 0}--> 
                       			<!--{        name='getNamKhoSanXuat' id=$view[i].chonphongbanin}--> 
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
                       
                       <td align="center">
                       		<!--{if $checkPer6 eq "true" }-->
                                <select class="selectOption" id="chuyenkho<!--{$view[i].id}-->" onchange="chuyenKhoSanXuat('chuyenkhosanxuat', this.value, '<!--{$view[i].id}-->','<!--{$phongbanchuyen}-->','khosanxuat_kv')">
                                    <option value="">--chuyển đến--</option>
                                    <!--{optionChuyenDenTest(array(id=>$view[i].chonphongbanin))}-->
                                </select>
                            <!--{else}-->
                                <select disabled="disabled">
                                     <option value="">--<!--{$chuyenden}-->--</option>
                                </select>  
                            <!--{/if}-->   
                       </td>
                        
                      <td align="center">
                        	<!--{if $checkPer2 eq "true" }-->
                        		<a href="<!--{$path_url}-->/sources/KhoSanXuat-Kho-Vmnt-Xuat-Kho.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->" title="Sửa"> 
                              		<img src="<!--{$path_url}-->/images/edit.png"/> 
                                </a>
                           	<!--{else}-->
                                 <img src="<!--{$path_url}-->/images/edit-no.png"/> 
                           	<!--{/if}--> 
                            <!--{if $checkPer7 eq "true" }-->
                            	<a href="javascript:void(0)" onclick="printKhoSanxuatXuatKho('<!--{$path_url}-->/print/print-kho-san-xuat.php?act=KhoSanXuat&table=khosanxuat_khovmnt&id=<!--{$view[i].id}-->','mywindow')" title="Print">
                              		<img class="margin-left10" width="25px" src="<!--{$path_url}-->/images/printer.png" align="top"> 
                                </a>
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