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
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<!--{$path_url}-->/sources/KhoSanXuat-Kho-Vmnt-Hao-Du.php?act=add&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/add.png">
                </a> 
            <!--{else}-->  
                <a>
                    <img src="<!--{$path_url}-->/images/add-no.png">
                </a> 	
            <!--{/if}--> 
            
            <!--{if $checkPer3 eq "true" }-->
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/KhoSanXuat-Kho-Vmnt-Hao-Du.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
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
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit="return searchKhoSanXuatHaoDu('<!--{$path_url}-->/sources/KhoSanXuat-Kho-Vmnt-Hao-Du.php?cid=<!--{$smarty.request.cid}-->')"> 
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
                   	<td width="10%">
                        <strong>hình</strong>
                    </td> 
                    <td width="12%">
                        <strong>Ngày nhập</strong>
                    </td>
                    
                    <td width="12%">
                        <strong>Mã phiếu</strong>
                    </td>
					
                    <td width="14%">
                        <strong>Loại Vàng</strong>
                    </td>
                    
                    <td>
                        <strong>Hao Kết Dẻ</strong>
                    </td>
                   
                    <td>
                        <strong>Dư Kết Dẻ</strong>
                    </td>
                    
                    <td>
                        <strong>Hao Chênh Lệch</strong>
                    </td>
                   
                    <td>
                        <strong>Dư Chênh Lệch</strong>
                    </td>
                    
                     <td>
                        <strong>Ghi chú</strong>
                    </td>
                    <td>
                        <strong>Sửa</strong>
                    </td>
                </tr>
                <tr>
                	<td align="center"></td>
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
                        <!--{include file="./allsearch/haos.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/dus.tpl"}-->
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center">
                        <!--{include file="./allsearch/ghichus.tpl"}-->
                    </td>
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
                       <td align="center" valign="middle">
                            <!--{if $view[i].img neq ""}-->
                                <a href="javascript:void(0)" onclick="popupwindow('<!--{$path_url}-->/<!--{$view[i].img}-->','mywindow')" title="Click Vào Xem hình lớn">
                                    <img width="50" src="../<!--{$view[i].img_thumb}-->"   />
                                </a>   
                            <!--{/if}-->
                            <!--{if $view[i].img1 neq ""}-->
                                <a href="javascript:void(0)" onclick="popupwindow('<!--{$path_url}-->/<!--{$view[i].img1}-->','mywindow')" title="Click Vào Xem hình lớn">
                                    <img width="50" src="../<!--{$view[i].img_thumb}-->"   />
                                </a>
                            <!--{/if}-->
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
                            <!--{$view[i].hao|number_format:3:".":","}-->
                       </td> 
                       <td class="text-right">
                            <!--{$view[i].du|number_format:3:".":","}-->
                       </td>
                       
                       <td class="text-right">
                            <!--{$view[i].haochenhlech|number_format:3:".":","}-->
                       </td> 
                       <td class="text-right">
                            <!--{$view[i].duchenhlech|number_format:3:".":","}-->
                       </td>
                       
                       <td> 
                            <!--{$view[i].ghichu}--> 
                       </td> 
                      <td align="center">
                        	<!--{if $checkPer2 eq "true" }-->
                        		<a href="<!--{$path_url}-->/sources/KhoSanXuat-Kho-Vmnt-Hao-Du.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->" title="Sửa"> 
                              		<img src="<!--{$path_url}-->/images/edit.png"/> 
                                </a>
                           	<!--{else}-->
                                 <img src="<!--{$path_url}-->/images/edit-no.png"/> 
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