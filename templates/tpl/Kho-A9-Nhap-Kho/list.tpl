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
            <!--{if $checkPer1 eq "true" }-->
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<!--{$path_url}-->/sources/Kho-A9-Nhap-Kho.php?act=add&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/add.png">
                </a> 
            <!--{else}-->  
                <a>
                    <img src="<!--{$path_url}-->/images/add-no.png">
                </a> 	
            <!--{/if}--> 
            
            <!--{if $checkPer3 eq "true" }-->
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/Kho-A9-Nhap-Kho.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
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
<!--{include file="./allsearch/tabVangKimcuong.tpl"}-->
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit="return searchtop('<!--{$path_url}-->/sources/Kho-A9-Nhap-Kho.php?cid=<!--{$smarty.request.cid}-->')"> 
     	<div class="MainSearch">
        	<!--{include file="./allsearch/tungay-denngay.tpl"}-->
        </div>
        <div class="MainTable">
    		<table class="table-bordered">
                <tr class="trheader">
                    <td class="tdcheck"></td>
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td width="8%">
                        <strong>Ngày chứng từ</strong>
                    </td>
                    
                    <td width="10%">
                        <strong>Số chứng từ</strong>
                    </td>
                    
                    <td>
                        <strong>Người Lập</strong>
                    </td>
                    
                    <td>
                        <strong>ĐV Lập</strong>
                    </td>
                    
                    <td>
                        <strong>Người Duyệt</strong>
                    </td>
                    
                    <td>
                        <strong>ĐV Duyệt</strong>
                    </td>
                   
                    <td>
                        <strong>Lý do</strong>
                    </td>
                    <td>
                        <strong>Duyệt Chuyển</strong>
                    </td>
                    <td class="tdShowHide">
                        <strong>SỬA</strong>
                    </td> 
                     <td class="tdEdit">
                        <strong>File</strong>
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
                        <!--{include file="./allsearch/namelaps.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/donvilaps.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/nameduyets.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/donviduyets.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/lydos.tpl"}-->
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
 				<!--{insert name='getName' table='categories' names='name_vn' id='4' assign="chuyenden"}-->
                <!--{section name=i loop=$view}--> 
                    <tr ondblclick="popupwindow('Kho-A9-Nhap-Kho.php?act=view&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->','mywindow')" id="g<!--{$view[i].id}-->">
                    	<td>
                           <input type="checkbox" value="<!--{$view[i].id}-->" name="iddel[]" id="check<!--{$smarty.section.i.index}-->">
                        </td>
                        <td>
                            <!--{$smarty.section.i.index+1+$number}-->
                       </td>
                       <td>
                            <!--{$view[i].datedchungtu|date_format:"%d/%m/%Y"}-->
                       </td>
                       <td>
                            <!--{$view[i].maphieu}-->
                       </td>
                       <td>
                            <!--{$view[i].nguoilapphieu}-->
                       </td> 
                       <td>
                            <!--{$view[i].donvilapphieu}-->
                       </td> 
                       <td>
                            <!--{$view[i].nguoiduyetphieu}-->
                       </td> 
                       <td>
                            <!--{$view[i].donviduyetphieu}-->
                       </td> 
                       <td>
                            <!--{$view[i].lydo}-->
                       </td> 
                       
                       <td align="center">
                            <!--{if $checkPer6 eq "true" }-->                           		
                                <select id='chuyenKhoNguonVao<!--{$view[i].id}-->' class="chonchuyenphong" onchange="chuyenKhoNguonVaogo('TaoPhieuXuaKho',<!--{$view[i].id}-->,this.value,<!--{$phongbanchuyen}-->,'PXKACHIN')">
                                     <option value="">--<!--{$chuyenden}-->--</option>
                                     <option value="24">  <!--{insert name='getName' table='categories' names='name_vn' id='24'}-->  </option>
                                </select>  
                            <!--{else}-->
                                <select disabled="disabled">
                                     <option value="">--<!--{$chuyenden}-->--</option>
                                </select>  
                            <!--{/if}-->            
                       </td> 
                       <td align="center">
                        	<!--{if $checkPer2 eq "true" }-->
                        		<a href="<!--{$path_url}-->/sources/Kho-A9-Nhap-Kho.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->" title="Sửa"> 
                              		<img src="<!--{$path_url}-->/images/edit.png"/> 
                                </a>
                           	<!--{else}-->
                                 <img src="<!--{$path_url}-->/images/edit-no.png"/> 
                           	<!--{/if}--> 
                            
                            <!--{if $checkPer7 eq "true" }-->
                            	<a href="javascript:void(0)" onclick="popupwindow('<!--{$path_url}-->/print/khonguonvao.php?act=nhapkho&table=khonguonvao_khoachin&id=<!--{$view[i].id}-->&type=1','mywindow')" title="Print">
                              		<img class="margin-left10" width="25px" src="<!--{$path_url}-->/images/printer.png" align="top"> 
                                </a>
                            <!--{/if}-->       
                       </td>
                       <td align="center">
                            <!--{if $view[i].fileexcel neq ''}-->
                                <a href="<!--{$path_url}-->/<!--{$view[i].fileexcel}-->" title="Tải file"> 
                                <a href="javascript:void(0)" onclick="popupwindow('<!--{$path_url}-->/print/read-file-excel.php?act=nhapkho&table=khonguonvao_khoachin&id=<!--{$view[i].id}-->','mywindow')" title="Xem File">
                                    <img src="<!--{$path_url}-->/images/down-load.png">
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
