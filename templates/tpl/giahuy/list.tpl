<!DOCTYPE html>
<html lang="vi">
<head>
<!--{include 'header.tpl'}-->

</head>
<body>
    <!--{include 'giahuy/modal.tpl'}-->
    <div class='container'>
        <div class='header'>
        </div>
        <div class='goAction'>
            <ul>
                <li>
                    <!--{if $checkPer1 eq true}-->
                        <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<!--{$path_url}-->/sources/thuchanh.php?act=add&cid=<!--{$smarty.request.cid}-->');">
                            <span class='add_icon icon-size-small'></span>
                        </a> 
                    <!--{else}-->  
                            <a>
                            <span class='add_icon icon-size-small disable_icon'></span>
                        </a> 	
                    <!--{/if}--> 
                    
                    <!--{if $checkPer3 eq "true" }-->
                        <a href="javascript:void(0)" title="Delete" onclick="GiaHuy_openModal('modal','Bạn có muốn xóa?',Giahuy_ChangeAction,'<!--{$path_url}-->/sources/thuchanh.php?act=dellist&cid=<!--{$smarty.request.cid}-->')">
                            <span class='delete_icon icon-size-small'></span>
                        </a> 
                    <!--{else}-->   
                        <a>
                            <span class='delete_icon icon-size-small disable_icon'></span>
                        </a> 
                    <!--{/if}--> 
                    
                    <!--{if $checkPer2 eq "true" }--> 
                        <a href="javascript:void(0)" title="Show" onclick="GiaHuy_openModal('modal','Bạn có muốn hiện?',Giahuy_ChangeAction,'<!--{$path_url}-->/sources/thuchanh.php?act=show&cid=<!--{$smarty.request.cid}-->')" >
                            <span class='check_icon icon-size-small'></span>
                        </a> 

                        <a href="javascript:void(0)" title="Hide" onclick="GiaHuy_openModal('modal','Bạn có muốn ẩn?',Giahuy_ChangeAction,'<!--{$path_url}-->/sources/thuchanh.php?act=hide&cid=<!--{$smarty.request.cid}-->');">
                            <span class='stop_icon icon-size-small'></span>
                        </a> 
                        
                        <a href="javascript:void(0)" title="Order" onclick="GiaHuy_openModal('modal','Bạn có muốn lưu?',Giahuy_ChangeAction,'<!--{$path_url}-->/sources/thuchanh.php?act=order&cid=<!--{$smarty.request.cid}-->');">
                            <span class='save_icon icon-size-small'></span>
                        </a>  
                    <!--{else}-->  
                        <a>
                            <span class='check_icon icon-size-small disable_icon'></span>
                        </a> 
                        <a>
                            <span class='stop_icon icon-size-small disable_icon'></span>
                        </a> 
                        <a>
                            <span class='save_icon icon-size-small disable_icon'></span>
                        </a> 
                    <!--{/if}-->
                </li>
            </ul>
        </div>
        <div class='content'>
            <div class=''><!--MainTable-->
                <form name="f" id="f" method="POST">
                    <div class=''>
                        <table class='shadow-box' style='width:100%'>
                            <tr class='tbheader'>
                                <td width='25px' class='tdcheck'><input type='checkbox' onclick="checkAll();" name='all'></td>
                                <td width='55px'>STT</td>
                                <td width='74px'>Thứ tự</td>
                                <td>Tên</td>
                                <td>Table</td>
                                <td>Table chi tiết</td>
                                <td>Table hạch toán</td>
                                <td width='95px'>Type phòng ban</td>
                                <td>Component</td>
                                <td>Mã phòng ban</td>
                                <td width='139px'>Phòng ban catalog</td>
                                <td width='111px'>No permission</td>
                                <td width='96px'>Hiện ẩn</td>
                                <td width='96px'>Sửa</td>
                            </tr>
                            <!--{section name=i loop=$view}-->
                            <tr class='tbRow'>
                                <td><input type='checkbox' value="<!--{$view[i].id}-->" name="iddel[]" id='check<!--{$smarty.section.i.index}-->' ></td>
                                <td><!--{$smarty.section.i.index}--></td>
                                <td><input class='tableTxtbox text_box align-center' type='textbox' name='ordering[]' value='<!--{$view[i].num}-->'></td>
                                <td>
                                <!--{if $view[i].has_child eq 1 }-->
                                    <a href="thuchanh.php?cid=<!--{$view[i].id}-->" border="0">
                                        <!--{$view[i].name_vn}-->
                                    </a>
                                <!--{else}-->
                                        <!--{$view[i].name_vn}-->
                                <!--{/if}-->	
                                </td> 
                                <td><!--{$view[i].table}--></td>
                                <td><!--{$view[i].tablect}--></td>
                                <td><!--{$view[i].tablehachtoan}--></td>
                                <td><!--{$view[i].typephongban}--></td>
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
                                <td><!--{$view[i].maphongban}--></td>
                                <td><!--{$view[i].phongbancatalog}--></td>
                                <td align="center">   
                                    <!--{if $view[i].nopermission eq 1}-->
                                        <span class='check_icon icon-size-small2'></span>
                                    <!--{else}--> 
                                        <span class='ban_icon icon-size-small2'></span>
                                    <!--{/if}-->
                                </td>
                                <td align="center">
                                    <!--{if $view[i].active eq "1"}-->
                                        <span class='check_icon icon-size-small2'></span>
                                    <!--{else}--> 
                                        <span class='ban_icon icon-size-small2'></span>
                                    <!--{/if}-->
                                </td>
                                <td align="center">
                                    <!--{if $checkPer2 eq "true" }-->
                                    <a href="<!--{$path_url}-->/sources/thuchanh.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->" title="Sửa"> 
                                        <span class='edit_icon icon-size-small2'></span>
                                    </a>
                                    <!--{else}-->
                                        <span class='edit_icon icon-size-small2 disable_icon'></span> 
                                    <!--{/if}--> 
                                </td>
                            </tr>
                        <!--{/section}-->
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<footer>
<!--{include 'footer.tpl'}-->
</footer>
</html>