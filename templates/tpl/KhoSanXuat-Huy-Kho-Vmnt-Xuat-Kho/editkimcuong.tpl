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
        <li class="active" id="clickVang" onclick="clickVang('<!--{$path_url}-->/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')">
            <a>Vàng</a>
        </li>
        <li id="clickKimCuong" onclick="clickKimCuong('<!--{$path_url}-->/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?act=<!--{$smarty.request.act}-->&cid=<!--{$smarty.request.cid}-->')">
            <a>Kim Cương</a>
        </li>
    </ul>
</div>
<div class="MainContent">
    <form name="allsubmit" id="frmEdit" action="<!--{$path_url}-->/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?act=<!--{if $smarty.request.act eq 'add' }-->addsm<!--{else}-->editsm<!--{/if}-->&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
     	<div class="box-thongin" >
            <div class="MainTable">
            <div class="table2scroll">         
                <table width="100%" border="1" id="addRowGirlKimCuong" class="kimcuong">
                    <tr class="trheader">
                        <td width="13%" align="center">
                            <strong>Mã Phiếu</strong>
                        </td>
                        <td width="13%" align="center">
                            <strong>Ngày Nhập</strong>
                        </td>
                        <td width="9%" align="center">
                            <strong>Tiền Mặt</strong>
                        </td>
                        <td width="7%" align="center">
                            <strong>Đơn Giá</strong>
                        </td> 
                        <td width="7%" align="center">
                            <strong>Phòng Sản Xuất</strong>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <!--{$edit.maphieu}-->
                        </td>
                        <td align="left">
                            <!--{$edit.dated}-->
                        </td>
                        <td align="left" class="kimcuong">
                            <input type="text" autocomplete="off" name="tienmatkimcuong" id="tienmatkimcuong" class="txtdatagirld autoNumeric" value="<!--{$edit.tienmatkimcuong}-->"/>
                        </td>
                        <td align="left" class="kimcuong">
                            <input type="text" autocomplete="off" name="dongiaban" id="dongiaban" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.dongiaban}-->"/>
                        </td>
                        <td align="left">       
                            <div id="siteIDload">
                                <select name="chonphongbanin" id="chonphongbanin" class="abcd chonphonbanSanXuat">
                                        <option value="0">Chọn Phòng Sản Xuất</option>
                                        <!--{insert name='optionChuyenDenSelected' chonphongbanin=$edit.chonphongbanin id='283,376,708,169,1845'}-->
                                </select> 
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            </div>
            <div class="clear"></div>
        </div>
        
		<div class="MainContent TextCenter"> 
        	<input type="hidden" name="id" value="<!--{$edit.id}-->" />
            <input type="hidden" name="cid" id="cid" value="<!--{$smarty.request.cid}-->" />
            <input type="button" class="btn-save" onclick=" return SubmitFromXuatKhoSanXuat();" value="  Lưu " /> 
        </div>
   </form>
</div>
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/functions/function.js"></script>

<script type="text/javascript" src="<!--{$path_url}-->/js/select-checkbox/sol.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/js/select-checkbox/sol.css" />

   <!--insert name='optionChoDonHangCatalog' madhin=$edit.madhin cid=$phongbanchuyen--> 