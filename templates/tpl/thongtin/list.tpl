<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<!--{$path_url}-->/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <!--{insert name="HearderCatMenu" cid=$smarty.request.cid root=$smarty.request.root act=$smarty.request.act}-->
    </ul>
</div>
<div class="goAction">
	<ul>
    	<li>
            <!--{if $checkPer1 eq "true" }-->
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<!--{$path_url}-->/sources/thongtin.php?act=add&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/add.png">
                </a> 
            <!--{else}-->  
                <a>
                    <img src="<!--{$path_url}-->/images/add-no.png">
                </a> 	
            <!--{/if}--> 
            
            <!--{if $checkPer3 eq "true" }-->
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/thongtin.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/delete.png">
               	</a> 
            <!--{else}-->   
               	<a>
                    <img src="<!--{$path_url}-->/images/delete-no.png">
               	</a> 
            <!--{/if}--> 
            
            <!--{if $checkPer2 eq "true" }--> 
               	<a href="javascript:void(0)" title="Show" onclick="ChangeAction('<!--{$path_url}-->/sources/thongtin.php?act=show&cid=<!--{$smarty.request.cid}-->')" >
                    <img src="<!--{$path_url}-->/images/active.png" />
               	</a> 

                <a href="javascript:void(0)" title="Hide" onclick="ChangeAction('<!--{$path_url}-->/sources/thongtin.php?act=hide&cid=<!--{$smarty.request.cid}-->');">
                   	<img src="<!--{$path_url}-->/images/inactive.png" />
                </a> 
                
                <a href="javascript:void(0)" title="Order" onclick="ChangeAction('<!--{$path_url}-->/sources/thongtin.php?act=order&cid=<!--{$smarty.request.cid}-->');">
                	<img src="<!--{$path_url}-->/images/order.png" />
                </a>  
          	<!--{else}-->  
                <a>
                   <img src="<!--{$path_url}-->/images/active-no.png" />
                </a> 
                <a>
                   <img src="<!--{$path_url}-->/images/inactive-no.png" />
                </a> 
                <a>
                	<img src="<!--{$path_url}-->/images/order-no.png" /> 
                </a> 
            <!--{/if}-->             
        </li>
    </ul>
</div>

<div class="MainContent">
    <!--<div class="MainSearch">
    	ádfasd
    </div>-->
    <div class="MainTable">
    	<form name="f" id="f" method="post">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdcheck"></td>
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td class="tdOrder">
                        <strong>THỨ TỰ</strong>
                    </td>
                    <td>
                        <strong>Tên</strong>
                    </td>
                    <td>
                        <strong>Tỷ Giá</strong>
                    </td>
                    <td>
                        <strong>Giá vàng N24K</strong>
                    </td>
                   
                    <td class="tdShowHide" align="center">
                        <strong>HIỆN/ẨN</strong>
                    </td>                                     
                    <td class="tdEdit">
                        <strong>SỬA</strong>
                    </td>
                </tr>
 				<!--{section name=i loop=$view}-->
                    <tr>
                       <td>
                            <input type="checkbox" value="<!--{$view[i].id}-->" name="iddel[]" id="check<!--{$smarty.section.i.index}-->">
                       </td>
                       <td>
                            <!--{$smarty.section.i.index+1+$number}-->
                       </td>
                       <td>
                            <input type="text" name="ordering[]" class="InputOrder"  value="<!--{$view[i].num}-->" size="2">
                            <input type="hidden" name="id[]" value="<!--{$view[i].id}-->" />
                       </td>                   
                      <td>
                            <!--{$view[i].name_vn}-->	
                        </td>
                        <td>
                            <!--{$view[i].tygia|number_format:0:".":","}-->	
                        </td> 
                       <td>
                            <!--{$view[i].giavangn24k|number_format:0:".":","}-->	
                        </td> 
                        
                        <td align="center">
                           <!--{if $view[i].active eq "1"}-->
                                <img width="20" src="<!--{$path_url}-->/images/active.png" alt="Show\Hide"  />
                             <!--{else}--> 
                                <img width="20" src="<!--{$path_url}-->/images/hide.png" alt="Show\Hide"  />
                             <!--{/if}-->
                        </td>
                        <td align="center">
                        	<!--{if $checkPer2 eq "true" }-->
                        		<a href="<!--{$path_url}-->/sources/thongtin.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->" title="Sửa"> 
                              		<img src="<!--{$path_url}-->/images/edit.png"/> 
                                </a>
                           	<!--{else}-->
                                 <img src="<!--{$path_url}-->/images/edit-no.png"/> 
                           	<!--{/if}-->             
                        </td>
                    </tr> 
                 <!--{/section}--> 
                                                
			</table>
    	</form>
        <div class="Paging">
        	<div class="pgLeft">Tổng số <!--{$total}--> trang</div>
            <div class="pgRight">
            	<!--{$link_url}-->
                
            </div>
        </div>
    </div>
</div>