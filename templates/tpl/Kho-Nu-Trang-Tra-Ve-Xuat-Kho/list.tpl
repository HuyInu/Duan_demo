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
                        <!--{$view[i].maphieu}-->
                    </td>
                    <td>
                        <strong>Nhóm Nguyên Liệu</strong>
                    </td>
                    <td>
                        <strong>Tên Nguyên Liệu</strong>
                    </td>
                    <td>
                         <!--{getName('loaivang', 'name_vn', $view[i].idloaivang)}-->
                    </td>
                    <td>
                        <!--{$view[i].cannangvh|number_format:3:".":","}-->
                    </td>
                    <td>
                        <!--{$view[i].cannangh|number_format:3:".":","}-->
                    </td>
                    <td>
                        <!--{$view[i].cannangv|number_format:3:".":","}-->
                    </td>
                    <td>
                        <!--{$view[i].ghichu}-->
                    </td>
                    <td>
                        <!--{$view[i].maphieutrakho}-->
                    </td>
                    <td>
                        <strong>Duyệt Chuyển</strong>
                    </td>
                    <td>
                    <!--{if $checkPer2 eq "true" }-->
                    <a href="<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$view[i].id}-->" title="Sửa"> 
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
                </tr>
                <!--{/section}-->
            </table>
        </div>
    </form>
</div>