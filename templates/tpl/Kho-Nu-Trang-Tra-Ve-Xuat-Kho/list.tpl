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
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php?act=add&cid=<!--{$smarty.request.cid}-->');">
                    <img src="<!--{$path_url}-->/images/add.png">
                </a> 
            <!--{else}-->  
                <a>
                    <img src="<!--{$path_url}-->/images/add-no.png">
                </a> 	
            <!--{/if}--> 
            <!--{if $checkPer3 eq "true" }-->
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
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
	<form name="f" id="f" method="post" onsubmit="return searchKhoTemDa('Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php?cid=<!--{$smarty.request.cid}-->')"> 
        <div class="MainSearch">
        	<!--{include file="./allsearch/tungay-denngay.tpl"}-->
        </div>
        <div class="MainTable fix-max-height">
            <table class="table-bordered">
                <tr class="trheader" align="center">
                    <td style="min-width:30px">
                        <strong>STT</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Ngày xuất kho</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Mã phiếu xuất kho</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Nhóm Nguyên Liệu</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Tên Nguyên Liệu</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Loại vàng</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Cân nặng V+H</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Cân nặng H</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Cân nặng V</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Ghi Chú</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Mã phiếu trả kho</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Duyệt Chuyển</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Sửa/In</strong>
                    </td>
                </tr>
                <!--{section i loop=$view}-->
                <tr>
                    <td>
                        <!--{$smarty.section.i.index+1}-->
                    </td>
                    <td>
                        <!--{$view[i].dated}-->
                    </td>
                    <td>
                        <strong>Mã phiếu xuất kho</strong>
                    </td>
                    <td>
                        <strong>Nhóm Nguyên Liệu</strong>
                    </td>
                    <td>
                        <strong>Tên Nguyên Liệu</strong>
                    </td>
                    <td>
                        <strong>Loại vàng</strong>
                    </td>
                    <td>
                        <strong>Cân nặng V+H</strong>
                    </td>
                    <td>
                        <strong>Cân nặng H</strong>
                    </td>
                    <td>
                        <strong>Cân nặng V</strong>
                    </td>
                    <td>
                        <strong>Ghi Chú</strong>
                    </td>
                    <td>
                        <strong>Mã phiếu trả kho</strong>
                    </td>
                    <td>
                        <strong>Duyệt Chuyển</strong>
                    </td>
                    <td>
                        <strong>Sửa/In</strong>
                    </td>
                </tr>
                <!--{/section}-->
            </table>
        </div>
    </form>
</div>