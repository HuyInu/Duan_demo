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
<div class="MainContent">
	<form name="allsubmit" id="frmEdit" action="<!--{$path_url}-->/sources/Kho-A9-Xuat-Kho.php?act=editsmVang&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
     	<div class="box-thongin" >
            <div class="MainTable">
               	<div class="table2scroll">
                    <table width="100%" border="1" id="addRowGirlVang" class="vang">
                        <tr class="trheader">
                            <td width="13%" align="center">
                                <strong>Nhóm Nguyên Liệu</strong>
                            </td>
                            <td width="10%" align="center">
                                <strong>Tên Nguyên Liệu</strong>
                            </td>
                            
                            <td width="7%" align="center">
                                <strong>Loại Vàng</strong>
                            </td>
                            <td width="9%" align="center">
                                <strong>Cân Nặng V+H</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Cân Nặng H</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Cân Nặng V</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Tuổi Vàng</strong>
                            </td>
                             
                            <td width="8%" align="center">
                                <strong>Tiền Mặt</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Phòng Ban</strong>
                            </td>
                            <td width="17%" align="center">
                                <strong>Ghi Chú Chỉnh Sửa</strong>
                            </td>
                        </tr>
                        <tr>
                             <td align="left"> 
                             	<input type="hidden" name="nhomnguyenlieuvang" id="nhomnguyenlieuvang1" value="<!--{$edit.nhomnguyenlieuvang}-->" />
                               
                                    <span id="showtennhomnguyenlieuvang1">
                                        <!--{if $edit.nhomnguyenlieuvang gt 0}-->
                                            <!--{insert name='getName' table='categories' names='name_vn' id=$edit.nhomnguyenlieuvang}-->
                                        <!--{else}-->
                                            Click chọn
                                        <!--{/if}-->    
                                    </span>
                                
                             </td>
                             <td align="left">
                                 <input type="hidden" name="tennguyenlieuvang" id="tennguyenlieuvang1" value="<!--{$edit.tennguyenlieuvang}-->" />
                                 <span id="showtennguyenlieuvang1">
                                    <!--{insert name='getName' table='categories' names='name_vn' id=$edit.tennguyenlieuvang}-->
                                 </span>
                             </td>
                           
                             <td align="left">
                                 <select class="selectOption" id="idloaivang" name="idloaivang" disabled="disabled" >
                                     <option value="">--Chọn loại vàng--</option>
                                     <!--{section name=i loop=$typegold}-->
                                     	<option value="<!--{$typegold[i].id}-->" <!--{if $edit.idloaivang eq $typegold[i].id}-->selected="selected"<!--{/if}-->>
                                        	<!--{$typegold[i].name_vn}-->
                                        </option>
                                     <!--{/section}-->
                                </select>
                             </td>
                             
                             <td align="left">
                                 <input type="text" autocomplete="off" name="cannangvh" id="cannangvh1" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.cannangvh}-->" onchange="getslcannangv(1)" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="cannangh" id="cannangh1" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.cannangh}-->" onchange="getslcannangv(1)" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="cannangv" id="cannangv1" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.cannangv}-->" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="tuoivang" id="tuoivang1" class="txtdatagirld autoNumeric4 text-right" value="<!--{$edit.tuoivang}-->" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="tienmatvang" id="tienmatvang1" class="txtdatagirld" value="<!--{$edit.tienmatvang}-->" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 
                                <div id="siteIDload">
                                    <select name="chonphongbanin" id="chonphongbanin" class="abcd chonphonbanSanXuat">
                                         <option value="0">Chọn Phòng Sản Xuất</option>
                                         <!--{insert name='optionChuyenDenSelected' id='623, 169, 647, 706' chonphongbanin = $edit.chonphongbanin}-->
                                    </select> 
                                </div>
                                 <script>
                                    $(function () {
                                        $("#siteIDload select").select2();
                                    });
                                </script>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="ghichueditvang" id="ghichueditvang1" class="txtdatagirld" value="<!--{$edit.ghichuvang}-->"/>
                             </td>       
                        </tr>
                    </table>
                </div> 
            </div>
            <div class="clear"></div>
        </div>
        
		<div class="MainContent TextCenter"> 
        	<input type="hidden" name="id" value="<!--{$edit.id}-->" />
            <input type="hidden" name="idct" value="<!--{$edit.idct}-->" />
            <input type="button" class="btn-save" onclick=" return SubmitFromPTKhoNguonVaoOne();" value="  Lưu " /> 
        </div>
   </form>
</div>
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/functions/function.js"></script>
<script src="<!--{$path_url}-->/fancybox/jquery.fancybox-1.3.1.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/fancybox/jquery.fancybox-1.3.1.css">
<link rel="stylesheet" href="<!--{$path_url}-->/popup/dialog.css">