<!--{if $actResult !== null}-->
    <!--{include 'huytulam/sweetAlert.tpl'}-->
<!--{/if}-->
<div class='container'>
    <div class="goAction">
        <ul>
            <li>
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<!--{$path_url}-->/sources/huymenu2.php?act=add&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/add.png">
                </a> 
            
                <a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/huymenu2.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/delete.png">
                </a> 
            
                <a href="javascript:void(0)" title="Show" onclick="ChangeAction('<!--{$path_url}-->/sources/huymenu2.php?act=show&cid=<!--{$smarty.request.cid}-->')" >
                    <img src="<!--{$path_url}-->/images/active.png" />
                </a> 

                <a href="javascript:void(0)" title="Hide" onclick="ChangeAction('<!--{$path_url}-->/sources/huymenu2.php?act=hide&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/inactive.png" />
                </a> 
                
                <a href="javascript:void(0)" title="Order" onclick="ChangeAction('<!--{$path_url}-->/sources/huymenu2.php?act=order&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/order.png" />
                </a>               
            </li>
        </ul>
    </div>
    <div class="MainContent">
        <div class="MainTable">
            <form name="f" id="f" method="post">
                <table  class="table-bordered">
                    <tr class="trheader">
                        <td class="tdcheck">
                            <input type="checkbox" id="grandCheck" name="all" onclick="Giahuy_checkdAllCheckBox(<!--{count($categoriesList)}-->, event)"/>                                  
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
                    <!--{section name=i loop=$categoriesList}-->
                    <tr class="">
                        <td class="tdcheck">
                            <input type="checkbox" value='<!--{$categoriesList[i].id}-->' name="checkedItemID[]" id="checkbox<!--{$smarty.section.i.index+1}-->"/>                                  
                        </td>

                        <td class="tdSTT">
                            <!--{$smarty.section.i.index+1}-->
                        </td>
                        
                        <td class="tdOrder">
                            <input type='text' class='InputOrder' name='num[]' value='<!--{$categoriesList[i].num}-->' onkeypress="return onlyNumberKey(event)">
                            <input type='hidden' name='id[]' value= '<!--{$categoriesList[i].id}-->'>
                        </td>
                        
                        <td>
                            <!--{if $categoriesList[i].has_child === '1'}-->
                                <a href="<!--{$path_url}-->/sources/huymenu2?cid=<!--{$categoriesList[i].id}-->">
                                    <!--{$categoriesList[i].name_vn}-->
                                </a>
                            <!--{else}-->
                                <!--{$categoriesList[i].name_vn}-->
                            <!--{/if}-->
                        </td>
                        
                        <td>
                            <!--{$categoriesList[i].table}-->
                        </td>
                        
                        <td>
                            <!--{$categoriesList[i].tablect}-->
                        </td>

                        <td>
                            <!--{$categoriesList[i].tablehachtoan}-->
                        </td>

                        <td width="10%">
                            <!--{$categoriesList[i].typephongban}-->
                        </td>
                        <td width="10%">
                            <!--{Giahuy_getComponentById($categoriesList[i].comp) assign='component'}-->
                            <!--{if count($component) > 0 && $component.id !== '0'}-->
                                <a href="<!--{$component.do}-->/?cid=<!--{$categoriesList[i].id}-->"><!--{$component.name}--></a>
                            <!--{/if}-->
                            
                        </td>
                        <td width="10%">
                            <!--{$categoriesList[i].maphongban}-->
                        </td>
                        <td width="12%">
                            <!--{$categoriesList[i].phongbancatalog}-->
                        </td>
                        <td align="center" width="8%">
                            <img width="20" src="<!--{$path_url}-->/images/<!--{($categoriesList[i].phongbancatalog === '0') ? 'active.png' : 'hide.png'}-->" alt="Show\Hide"  />
                        </td>    
                        <td class="tdShowHide" align="center">
                            <img width="20" src="<!--{$path_url}-->/images/<!--{($categoriesList[i].active === '1') ? 'active.png' : 'hide.png'}-->" alt="Show\Hide"  />
                        </td>                                     
                        <td class="tdEdit">
                            <a href="huymenu2?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$categoriesList[i].id}-->">
                                <img src="<!--{$path_url}-->/images/edit.png"/> 
                            </a>
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
</div>