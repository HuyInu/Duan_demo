<!--{if isset($actResult)}-->
    <!--{include 'huytulam/sweetAlert.tpl'}-->
<!--{/if}-->
<div class="goAction">
	<ul>
    	<li>
            <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<!--{$path_url}-->/sources/Kho-A9-Huy-Nhap-Kho.php?act=add&cid=<!--{$smarty.request.cid}-->');">
                <img src="<!--{$path_url}-->/images/add.png">
            </a> 
            <a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<!--{$path_url}-->/sources/Kho-A9-Huy-Nhap-Kho.php?act=dellist&cid=<!--{$smarty.request.cid}-->');">
                <img src="<!--{$path_url}-->/images/delete.png">
            </a> 
        </li>
    </ul>
</div>
<!--{include file="./allsearch/tabVangKimcuong.tpl"}-->
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit=""> 
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
                <!--{getName('categories','name_vn',4) assign="chuyenden"}-->
 				<!--{section name=i loop=$phieuNhap}-->
                <tr class="" id="g<!--{$phieuNhap[i].id}-->">
                    <td class="tdcheck">
                        <input type='checkbox' value ='<!--{$phieuNhap[i].id}-->' name='iddel[]' id='check<!--{$smarty.section.i.index + 1}-->'
                    </td>
                    <td class="tdSTT" align="center">
                        <!--{$smarty.section.i.index + 1}-->
                    </td>
                    
                    <td width="8%">
                        <!--{$phieuNhap[i].datedchungtu|date_format: "%d/%m/%Y"}-->
                    </td>
                    
                    <td width="10%">
                        <!--{$phieuNhap[i].maphieu}-->
                    </td>
                    
                    <td>
                        <!--{$phieuNhap[i].nguoilapphieu}-->
                    </td>
                    
                    <td>
                        <!--{$phieuNhap[i].donvilapphieu}-->
                    </td>
                    
                    <td>
                        <!--{$phieuNhap[i].nguoiduyetphieu}-->
                    </td>
                    
                    <td>
                        <!--{$phieuNhap[i].donviduyetphieu}-->
                    </td>
                   
                    <td>
                        <!--{$phieuNhap[i].lydo}-->
                    </td>
                    <td>
                        <select class="chonchuyenphong" onchange="giahuy_chuyenKhoNguonVaogo('TaoPhieuXuatKho',  <!--{$phieuNhap[i].id}-->, this.value, <!--{$phongbanchuyen}-->, 'PXKACHIN')">
                            <option><!--{$chuyenden}--></option>
                            <option value="1829"><!--{getName('categories', 'name_vn', 1829)}--></option>
                        </select>
                    </td>
                    <td class="tdShowHide">
                        <a href="Kho-A9-Huy-Nhap-Kho.php?act=edit&cid=<!--{$smarty.request.cid}-->&id=<!--{$phieuNhap[i].id}-->" title="Sửa"> 
                            <img src="<!--{$path_url}-->/images/edit.png"/> 
                        </a>
                    </td> 
                    <td class="tdEdit">
                        <strong>File</strong>
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