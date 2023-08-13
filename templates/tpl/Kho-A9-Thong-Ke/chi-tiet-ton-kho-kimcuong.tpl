
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
<div class="ChonLoaiPhieu">
    <ul>
        <li class="active" id="clickVang" onclick="clickVang('<!--{$path_url}-->/sources/Kho-A9-Thong-Ke.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')">
            <a>Vàng</a>
        </li>
        <li id="clickKimCuong" onclick="clickKimCuong('<!--{$path_url}-->/sources/Kho-A9-Thong-Ke.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')">
            <a>Kim Cương</a>
        </li>
    </ul>
</div>
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit="return KhoNguonVaoThongKeNhapXuatKimCuong('<!--{$path_url}-->/sources/Kho-A9-Thong-Ke.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')"> 
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    <td>
                        <strong>Ngày nhập</strong>
                    </td>

                    <td>
                        <strong>Mã Phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Nhóm N Liệu</strong>
                    </td>
                    
                    <td>
                        <strong>Tên N Liệu</strong>
                    </td>
                    
                    <td width="12%">
                        <strong>Tên Kim Cương</strong>
                    </td>
                    
                    <td>
                        <strong>Kích Thước</strong>
                    </td>
                    <td>
                        <strong>Trọng Lượng Hột</strong>
                    </td>
                    <td>
                        <strong>Độ Tinh Khiết</strong>
                    </td>
                    
                     <td>
                        <strong>Cấp Độ Màu</strong>
                    </td>
                    <td>
                        <strong>Độ Mài Bóng</strong>
                    </td>
                    <td>
                        <strong>Kích Thước Bán</strong>
                    </td>
                     <td width="5%">
                        <strong>Số lượng</strong>
                    </td>
                    <td width="8%">
                        <strong>Đơn Giá</strong>
                    </td>
                </tr>
                <tr>
                    <td align="center"></td>
                    <td align="center"></td>
                    
                     <td align="center">
                        <!--{include file="./allsearch/codes.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/chonnhomnguyenlieus.tpl"}-->
                    </td>
                    <td align="center">
                        <!--{include file="./allsearch/chontennguyenlieus.tpl"}-->
                    </td>
                    
                    <td align="center">
                    	<!--{include file="./allsearch/chontenkimcuongs.tpl"}-->
                    </td>
                   
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                     <td align="center"></td>
                </tr>
                <!--{section name=i loop=$view}--> 
                	<!--{assign var="tongdongia" value=1}-->
                    <tr id="g<!--{$view[i].id}-->">
                        <td>
                            <!--{$smarty.section.i.index+1+$number}-->
                       </td>
                       <td>
                            <!--{$view[i].dated|date_format:"%d/%m/%Y"}-->
                       </td>
                       <td>
                            <!--{$view[i].maphieu}-->
                       </td>
                       <td>
                            <!--{insert name='getName' table='categories' names='name_vn' id=$view[i].nhomnguyenlieukimcuong}-->
                       </td> 
                       <td>
                           <!--{insert name='getName' table='categories' names='name_vn' id=$view[i].tennguyenlieukimcuong}-->
                       </td> 
                      
                       <td>
                            <!--{insert name='getName' table='loaikimcuonghotchu' names='size' id=$view[i].idkimcuong}-->::<!--{insert name='getName' table='loaikimcuonghotchu' names='name_vn' id=$view[i].idkimcuong}-->
                       </td> 
                       
                       <td>
                            <!--{$view[i].kichthuoc}-->
                       </td> 
                       <td>
                            <!--{$view[i].trongluonghot}-->
                       </td>
                        <td>
                            <!--{$view[i].dotinhkhiet}-->
                       </td>
                       <td>
                            <!--{$view[i].capdomau}-->
                       </td>
                       <td>
                            <!--{$view[i].domaibong}-->
                       </td>
                       <td>
                            <!--{$view[i].kichthuocban}-->
                       </td> 
                        <td class="text-right">
                            1
                       </td> 
                       <td class="text-right">
                            <!--{$view[i].dongiaban|number_format:3:".":","}-->
                       </td> 
                       
                       <!--{assign var="tongsoluong" value=$tongsoluong+1}-->
                       <!--{assign var="tongdongiatong" value=$tongdongiatong+$view[i].dongiaban}--> 
                    </tr> 
                 <!--{/section}--> 
                 <tr class="Paging fontSizeTon">
                    <td align="right" colspan="12"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                    <td align="right"><span class="colorXanh"> <!--{$tongsoluong|number_format:0:".":","}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$tongdongiatong|number_format:3:".":","}--> </span></td>
                </tr>    
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="12"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.tongsoluong}--> </span></td>
                    <td align="right"><span class="colorXanh"> <!--{$gettotal.tongdongia}--> </span></td>
                </tr>                               
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

<script type="text/javascript" src="<!--{$path_url}-->/js/select-checkbox/sol.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/js/select-checkbox/sol.css" />
<script>
	$('#tenkimcuongs').searchableOptionList({ maxHeight: 'auto', showSelectAll: true });
</script>