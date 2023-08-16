<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<!--{$path_url}-->/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <!--{insert name="HearderCatMenu" cid=$smarty.request.cid root=$smarty.request.root act=$smarty.request.act}-->
    </ul>
</div>``
<div class="goAction">
	<ul>
    	<li>
            <!--{if $checkPer1 eq "true" }-->
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<!--{$path_url}-->/sources/categories.php?act=add&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/add.png">
                </a> 
            <!--{else}-->  
                <a>
                    <img src="<!--{$path_url}-->/images/add-no.png">
                </a> 	
            <!--{/if}--> 
            
            <!--{if $checkPer3 eq "true" }-->
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/categories.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/delete.png">
               	</a> 
            <!--{else}-->   
               	<a>
                    <img src="<!--{$path_url}-->/images/delete-no.png">
               	</a> 
            <!--{/if}--> 
            
            <!--{if $checkPer2 eq "true" }--> 
               	<a href="javascript:void(0)" title="Show" onclick="ChangeAction('<!--{$path_url}-->/sources/categories.php?act=show&cid=<!--{$smarty.request.cid}-->')" >
                    <img src="<!--{$path_url}-->/images/active.png" />
               	</a> 

                <a href="javascript:void(0)" title="Hide" onclick="ChangeAction('<!--{$path_url}-->/sources/categories.php?act=hide&cid=<!--{$smarty.request.cid}-->');">
                   	<img src="<!--{$path_url}-->/images/inactive.png" />
                </a> 
                
                <a href="javascript:void(0)" title="Order" onclick="ChangeAction('<!--{$path_url}-->/sources/categories.php?act=order&cid=<!--{$smarty.request.cid}-->');">
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
                    <td class="tdcheck">
                        <input type="checkbox" onclick="checkAll();"  name="all"/>                                  
                    </td>
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td class="tdOrder">
                        <strong>THỨ TỰ</strong>
                    </td>
                    
                    <td>
                        <strong>TÊN</strong>
                    </td>
                    
                    <td>
                        <strong>TABLE</strong>
                    </td>
                    
                    <td>
                        <strong>TABLE CHI TIẾT</strong>
                    </td>
                    
                    <td>
                        <strong>TABLE HẠCH TOÁN</strong>
                    </td>
                     <td width="10%">
                        <strong>Type Phòng Ban </strong>
                    </td>
                    <!--{if $smarty.request.cid eq 79 || $smarty.request.cid eq 83}-->
                        <td width="10%">
                            <strong> TT Giao Nhận </strong>
                        </td>
                    <!--{/if}-->
                    
                    <td width="10%">
                        <strong> COMPONENT </strong>
                    </td>
                    <td width="10%">
                        <strong> Mã Phòng Ban(PM A.Tuấn) </strong>
                    </td>
                    <td width="12%">
                        <strong> Phòng Ban Catalog </strong>
                    </td>
                    <td align="center" width="8%">
                        <strong>No Permission</strong>
                    </td>    
                    <td class="tdShowHide" align="center">
                        <strong>HIỆN/ẨN</strong>
                    </td>                                     
                    <td class="tdEdit">
                        <strong>SỬA</strong>
                    </td>
                </tr>
 				<!--{section name=i loop=$view}-->
                    <tr id="g<!--{$view[i].mspid}-->">
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
                       <!--{if $view[i].has_child eq 1 }-->
                       <td>
                           <a href="categories.php?cid=<!--{$view[i].id}-->" border="0">
                                <!--{$view[i].name_vn}-->
                            </a>
                        <!--{else}-->
                        <td>
                            <!--{$view[i].name_vn}-->
                        <!--{/if}-->	
                        </td> 
                        <td>
                            <!--{$view[i].table}-->
                        </td>
                        <td>
                            <!--{$view[i].tablect}-->
                        </td>
                        <td>
                            <!--{$view[i].tablehachtoan}-->
                        </td>
                        <td>
                            <!--{$view[i].typephongban}-->
                        </td>
                        <!--{if $smarty.request.cid eq 79 || $smarty.request.cid eq 83}-->
                            <td>
                            	<!--{if $smarty.session.group_qlsxntjcorg_user eq -1}-->
                                    <select class="chonchuyenphong" onchange="getTTGiaoNhan(<!--{$view[i].id}-->, this.value)">
                                <!--{else}-->
                                	<select class="chonchuyenphong" disabled="disabled">
                                <!--{/if}-->
                                       <!--{section name=j loop=$typegiaonhanload}-->
                                            <option <!--{if $typegiaonhanload[j].id eq $view[i].typegiaonhan }--> selected="selected" <!--{/if}--> value="<!--{$typegiaonhanload[j].id}-->">
                                                <!--{$typegiaonhanload[j].name_vn}-->
                                            </option>
                                        <!--{/section}-->	
                                    </select>
                            </td>
                        <!--{/if}-->
                        <td>
                            <!--{if $view[i].id eq 27}-->
                                <!--{if $view[i].has_child eq "0"}-->
                                    <!--{insert name="GetNameComponent" comp=$view[i].comp assign="comp" }-->
                                    <a href="<!--{$comp.do}-->?cid=0">
                                        <!--{$comp.name}--> 
                                    </a>
                                <!--{/if}-->
                            <!--{else}-->
                                <!--{if $view[i].has_child eq "0"}-->
                                    <!--{insert name="GetNameComponent" comp=$view[i].comp assign="comp" }-->
                                    <a href="<!--{$comp.do}-->?cid=<!--{$view[i].id}-->">
                                        <!--{$comp.name}-->
                                    </a>
                                <!--{/if}-->
                            <!--{/if}-->
                        </td>
                        <td align="center">
                           <!--{$view[i].maphongban}-->     
                        </td>
                        <td>
                           <!--{insert name=getNamPhongBanCatalog str=$view[i].phongbancatalog}-->     
                        </td>
                        <td align="center">
                           <!--{if $view[i].nopermission eq "1"}-->
                                <img width="20" src="<!--{$path_url}-->/images/active.png" alt="Show\Hide"  />
                             <!--{else}--> 
                                <img width="20" src="<!--{$path_url}-->/images/hide.png" alt="Show\Hide"  />
                             <!--{/if}-->
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
                        		<a href="<!--{$path_url}-->/sources/categories.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->" title="Sửa"> 
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
<script>
	function getTTGiaoNhan(id, typegiaonhan){
		var answer = confirm("Bạn chất muốn thực hiện không ?");
		if (answer)
		{
			$('#loadingAjax').show();
			$.post('<!--{$path_url}-->/ajax/Checkip.php',{act:'UpdateTTGiaoNhan',id:id,typegiaonhan:typegiaonhan},function(data) {																				
				var obj = jQuery.parseJSON(data);
				$('#loadingAjax').hide();
			});
		}
		else{
			location.reload();	
		}
	}
</script>