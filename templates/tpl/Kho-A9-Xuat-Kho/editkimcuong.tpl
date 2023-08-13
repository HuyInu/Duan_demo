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
	<form name="allsubmit" id="frmEdit" action="<!--{$path_url}-->/sources/Kho-A9-Xuat-Kho.php?act=editsmKimcuong&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
     	<div class="box-thongin" >
            <div class="MainTable">
               	<div class="table2scroll">
                    <table width="100%" border="1" id="addRowGirlVang">
                        <tr class="trheader">
                            <td align="center">
                                <strong>Nhóm Nguyên Liệu</strong>
                            </td>
                            <td align="center">
                                <strong>Tên Nguyên Liệu</strong>
                            </td>
                             <td align="center">
                                <strong>Tên Kim Cương</strong>
                            </td>
                            <td  align="center">
                                <strong>MS GĐPNJ</strong>
                            </td>
                            <td align="center">
                                <strong>MS Cạnh GIA</strong>
                            </td>
                            <td align="center">
                                <strong>Kích Thước</strong>
                            </td>
                            <td align="center">
                                <strong>Trọng Lượng Hột</strong>
                            </td>
                            <td align="center">
                                <strong>Độ Tinh Khiết</strong>
                            </td>
                            
                             <td align="center">
                                <strong>Cấp Độ Màu</strong>
                            </td>
                            <td align="center">
                                <strong>Độ Mài Bóng</strong>
                            </td>
                            <td align="center">
                                <strong>Kích Thước Bán</strong>
                            </td>
                            
                            <td align="center">
                                <strong>Tiền Mặt</strong>
                            </td>
                            <td align="center">
                                <strong>Đơn Giá</strong>
                            </td>  
                             <td align="center">
                                <strong>Ghi Chú Chỉnh Sửa</strong>
                            </td>  
                        </tr>
                        <tr>
                             <td align="left">
                                <input type="hidden" name="nhomnguyenlieukimcuong" id="nhomnguyenlieukimcuong1" value="<!--{$edit.nhomnguyenlieukimcuong}-->" />
                                
                                   <span id="showtennhomnguyenlieukimcuong1">
                                        <!--{if $edit.nhomnguyenlieukimcuong gt 0}-->
                                            <!--{insert name='getName' table='categories' names='name_vn' id=$edit.nhomnguyenlieukimcuong}-->
                                        <!--{else}-->
                                            Click chọn
                                        <!--{/if}-->
                                   </span>

                                
                             </td>
                             
                             <td align="left">
                                 <input type="hidden" name="tennguyenlieukimcuong" id="tennguyenlieukimcuong1" value="<!--{$edit.tennguyenlieukimcuong}-->" />
                                  <span id="showtennguyenlieukimcuong1">
                                        <!--{insert name='getName' table='categories' names='name_vn' id=$edit.tennguyenlieukimcuong}-->
                                  </span>
                             </td>
                             <td align="left">
                                <input type="hidden" name="idkimcuong" id="idkimcuong1" value="<!--{$edit.idkimcuong}-->" />
                                
                                   <span id="showtennkimcuong1">
                                        <!--{if $edit.idkimcuong gt 0}-->
                                            <!--{insert name='getName' table='loaikimcuonghotchu' names='size' id=$edit.idkimcuong}-->::<!--{insert name='getName' table='loaikimcuonghotchu' names='name_vn' id=$edit.idkimcuong}-->
                                        <!--{else}-->
                                            Click chọn tên
                                        <!--{/if}-->
                                   </span>
                                
                             </td>
                              <td align="left">
                                 <input  type="text" autocomplete="off" name="codegdpnj" id="codegdpnj1" class="txtdatagirld" value="<!--{$edit.codegdpnj}-->" disabled="disabled"/>
                             </td>
                              <td align="left">
                                 <input type="text" autocomplete="off" name="codecgta" id="codecgta1" class="txtdatagirld" value="<!--{$edit.codecgta}-->" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="kichthuoc" id="kichthuoc1" class="txtdatagirld" value="<!--{$edit.kichthuoc}-->" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="trongluonghot" id="trongluonghot1" class="txtdatagirld" value="<!--{$edit.trongluonghot}-->" disabled="disabled"/>
                             </td>
                              <td align="left">
                                 <input type="text" autocomplete="off" name="dotinhkhiet" id="dotinhkhiet1" class="txtdatagirld" value="<!--{$edit.dotinhkhiet}-->" disabled="disabled"/>
                             </td>
                              <td align="left">
                                 <input type="text" autocomplete="off" name="capdomau" id="capdomau1" class="txtdatagirld" value="<!--{$edit.capdomau}-->" disabled="disabled"/>
                             </td>
                              <td align="left">
                                 <input type="text" autocomplete="off" name="domaibong" id="domaibong1" class="txtdatagirld" value="<!--{$edit.domaibong}-->" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="kichthuocban" id="kichthuocban1" class="txtdatagirld" value="<!--{$edit.kichthuocban}-->" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="tienmatkimcuong" id="tienmatkimcuong1" class="txtdatagirld" value="<!--{$edit.tienmatkimcuong}-->" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" readonly="readonly" autocomplete="off" name="dongiaban" id="dongiaban1" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.dongiaban}-->" disabled="disabled"/>
                             </td>
                              <td align="left">
                                 <input type="text" autocomplete="off" name="ghichueditkimcuong" id="ghichueditkimcuong1" class="txtdatagirld" value="<!--{$edit.ghichukimcuong}-->"/>
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