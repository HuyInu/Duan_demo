<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<!--{$path_url}-->/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <li>
        	<span>&raquo;</span>
        	<a title=" QUẢN LÝ ACCOUNT" href="<!--{$path_url}-->/sources/users.php">		
                QUẢN LÝ ACCOUNT
            </a> 
        </li>
    </ul>
</div>
<div class="goAction">
	<ul>
    	<li>
            <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<!--{$path_url}-->/sources/users.php?act=add');">
                <img src="<!--{$path_url}-->/images/add.png">
            </a> 
        
            <a href="javascript:void(0)" title="Xóa" onclick="ChangeAction('<!--{$path_url}-->/sources/users.php?act=dellist');">
                <img src="<!--{$path_url}-->/images/delete.png">
            </a>     
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

                    <td>
                        <strong>TÊN</strong>
                    </td>
                    
                    <td>
                        <strong>User Name</strong>
                    </td>
                   
                    <td class="tdEdit" align="center">
                        <strong>Permission</strong>
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
                            <!--{$view[i].fullname}-->
                       </td>                   
                      
                        <td>
                            <!--{$view[i].username}-->
                        </td>
                        <td align="center">
                       		<a onclick="loadingpage();" href="<!--{$path_url}-->/sources/permission.php?act=permissionOne&id=<!--{$view[i].id}-->" title="permission"> 
                                <img src="<!--{$path_url}-->/images/permission.png" alt="permission"  /> 
                            </a> 
                        </td>
                        <td align="center">
                            <a href="<!--{$path_url}-->/sources/users.php?act=edit&id=<!--{$view[i].id}-->" title="Sửa"> 
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