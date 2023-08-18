<link type="text/css" href="<!--{$path_url}-->/calendar/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$path_url}-->/calendar/jquery-ui.js"></script>
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
	<form name="allsubmit" id="frmEdit" action="<!--{$path_url}-->/sources/Kho-A9-Nhap-Kho.php?act=<!--{if $smarty.request.act eq 'add' }-->addsm<!--{else}-->editsm<!--{/if}-->&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
        <div class="main-content padding-topfooter">
            <div class="panel-left">
                <div class="box-thongin">
                    <div class="title-thongtin">Thông Tin Phiếu Nhập Kho</div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Người Lập Phiếu
                        </div>
                        
                        <div class="SubRight">
                            <input name="nguoilapphieu" id="nguoilapphieu" value="<!--{$edit.nguoilapphieu}-->" class="InputText" type="text"/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Đơn Vị
                        </div>
                        
                        <div class="SubRight">
                            <input name="donvilapphieu" id="donvilapphieu" value="<!--{$edit.donvilapphieu}-->" class="InputText" type="text" />
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Người Duyệt Phiếu
                        </div>
                        
                        <div class="SubRight">
                            <input name="nguoiduyetphieu" id="nguoiduyetphieu" value="<!--{$edit.nguoiduyetphieu}-->" class="InputText" type="text"/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Đơn Vị
                        </div>
                        
                        <div class="SubRight">
                            <input name="donviduyetphieu" id="donviduyetphieu" value="<!--{$edit.donviduyetphieu}-->" class="InputText" type="text"/>
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Lý Do
                        </div>
                        
                        <div class="SubRight">
                            <input name="lydo" id="lydo" value="<!--{$edit.lydo}-->" class="InputText" type="text" autocomplete="off" />
                        </div>
                    </div>
                    
                    
                    <div class="clear"></div>
                </div>
            </div>
            <div class="panel-right">
                <div class="box-thongin">
                    <div class="title-thongtin">Chứng từ</div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Mã phiếu
                        </div>
                        
                        <div class="SubRight">
                            <input readonly="readonly" name="maphieu" id="maphieu" value="<!--{$edit.maphieu}-->" class="InputText" type="text"  />
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Ngày nhập
                        </div>
                        
                        <div class="SubRight">
                            <input type="text" class="InputText" name="datedchungtu" id="datedchungtu" value="<!--{$edit.datedchungtu|date_format:'%d/%m/%Y'}-->"  readonly="readonly" />
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Ngày hạch toán
                        </div>
                        
                        <div class="SubRight">
                            <input type="text" class="InputText" name="datedhachtoan" value="<!--{$edit.datedhachtoan|date_format:'%d/%m/%Y'}-->" readonly="readonly" />
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Upload File Excel
                        </div>
                        <div class="SubRight">
                        	
                        	<input type="file" name="fileexcel" id="fileexcel" onchange="check_file('fileexcel');" />
                            <!--{if $edit.fileexcel neq ''}-->
                            	<a href="<!--{$path_url}-->/<!--{$edit.fileexcel}-->" title="Tải file"> 
                                	<img src="<!--{$path_url}-->/images/down-load.png">
                                </a>
                            <!--{/if}-->                           
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                </div>
            </div>
        </div>
     	<div class="box-thongin">
        	<div class="title-thongtin">Nội dung</div>
            <div class="MainTable">
            	<!--{include file="./allsearch/tabVangKimcuong.tpl"}-->
               	<div class="table2scroll">
                    <table width="100%" border="1" id="addRowGirlVang" class="vang">
                        <tr class="trheader">
                            <td width="3%" align="center">
                                <strong>STT</strong>
                            </td> 
                            
                            <td width="13%" align="center">
                                <strong>Nhóm Nguyên Liệu</strong>
                            </td>
                            <td width="13%" align="center">
                                <strong>Tên Nguyên Liệu</strong>
                            </td>
                            
                            <td width="8%" align="center">
                                <strong>Loại Vàng</strong>
                            </td>
                            <td width="10%" align="center">
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
                            <td width="12%" align="center">
                                <strong>Tiền Mặt</strong>
                            </td>
                            <td width="17%" align="center">
                                <strong>Ghi Chú</strong>
                            </td>
                        </tr>
                         <!--{section name=i loop=$viewtcctvang}-->
                            <tr>
                                 <td align="left">
                                    <!--{$smarty.section.i.index+1+$number}-->
                                    <input type="hidden" name="idctnxvang[]" value="<!--{$viewtcctvang[i].id}-->" />
                                 </td>
                                        
                                 <td align="left"> 
                                    <input type="hidden" name="nhomnguyenlieuvang[]" id="nhomnguyenlieuvang<!--{$smarty.section.i.index+1}-->" value="<!--{$viewtcctvang[i].nhomnguyenlieuvang}-->" />
                                    <a id="popupNhomDanhMucVang<!--{$smarty.section.i.index+1}-->" href="<!--{$path_url}-->/popup/DanhMucNguyenLieu.php?type=vang&idnhomdm=<!--{$nhomdanhmuc.id}-->&idnhomnguyenlieuvang=<!--{$viewtcctvang[i].nhomnguyenlieuvang}-->&idtennguyenlieuvang=<!--{$viewtcctvang[i].tennguyenlieuvang}-->&idshow=<!--{$smarty.section.i.index+1}-->">
                                        <span id="showtennhomnguyenlieuvang<!--{$smarty.section.i.index+1}-->">
                                            <!--{if $viewtcctvang[i].nhomnguyenlieuvang gt 0}-->
                                                <!--{insert name='getName' table='categories' names='name_vn' id=$viewtcctvang[i].nhomnguyenlieuvang}-->
                                            <!--{else}-->
                                                Click chọn
                                            <!--{/if}-->    
                                        </span>
                                    </a>
                                    <script type="text/javascript">
                                       $(document).ready(function() {
                                            $("#popupNhomDanhMucVang<!--{$smarty.section.i.index+1}-->").fancybox();
                                        }); 
                                    </script>

                                 </td>
                                 <td align="left">
                                     <input type="hidden" name="tennguyenlieuvang[]" id="tennguyenlieuvang<!--{$smarty.section.i.index+1}-->" value="<!--{$viewtcctvang[i].tennguyenlieuvang}-->" />
                                     <span id="showtennguyenlieuvang<!--{$smarty.section.i.index+1}-->">
                                        <!--{insert name='getName' table='categories' names='name_vn' id=$viewtcctvang[i].tennguyenlieuvang}-->
                                     </span>
                                 </td>
                               
                                 <td align="left">
                                     <!--{insert name='loadloaivang' idloaivang=$viewtcctvang[i].idloaivang idnum=$smarty.section.i.index+1}-->
                                 </td>
                                 
                                 <td align="left">
                                     <input type="text" autocomplete="off" name="cannangvh[]" id="cannangvh<!--{$smarty.section.i.index+1}-->" class="txtdatagirld text-right autoNumeric" value="<!--{$viewtcctvang[i].cannangvh}-->" onchange="getslcannangv(<!--{$smarty.section.i.index+1}-->)"/>
                                 </td>
                                  <td align="left">
                                     <input type="text" autocomplete="off" name="cannangh[]" id="cannangh<!--{$smarty.section.i.index+1}-->" class="txtdatagirld text-right autoNumeric" value="<!--{$viewtcctvang[i].cannangh}-->" onchange="getslcannangv(<!--{$smarty.section.i.index+1}-->)"/>
                                 </td>
                                 <td align="left">
                                     <input type="text" autocomplete="off" name="cannangv[]" id="cannangv<!--{$smarty.section.i.index+1}-->" class="txtdatagirld text-right autoNumeric" value="<!--{$viewtcctvang[i].cannangv}-->"/>
                                 </td>
                                 <td align="left">
                                     <input type="text" autocomplete="off" name="tuoivang[]" id="tuoivang<!--{$smarty.section.i.index+1}-->" class="txtdatagirld autoNumeric4 text-right" value="<!--{$viewtcctvang[i].tuoivang}-->"/>
                                 </td>
                                 <td align="left">
                                     <input type="text" autocomplete="off" name="tienmatvang[]" id="tienmatvang<!--{$smarty.section.i.index+1}-->" class="txtdatagirld" value="<!--{$viewtcctvang[i].tienmatvang}-->"/>
                                 </td>
                                 <td align="left">
                                     <input type="text" autocomplete="off" name="ghichuvang[]" id="ghichuvang<!--{$smarty.section.i.index+1}-->" class="txtdatagirld" value="<!--{$viewtcctvang[i].ghichuvang}-->"/>
                                 </td>       
                            </tr>
                        <!--{/section}--> 
                    </table>
                </div>
           		<div class="table2scroll">         
                   <table width="100%" border="1" id="addRowGirlKimCuong" class="kimcuong">
                        <tr class="trheader">
                            <td width="3%" align="center">
                                <strong>STT</strong>
                            </td> 
                            <td width="9%" align="center">
                                <strong>Nhóm Nguyên Liệu</strong>
                            </td>
                            <td width="9%" align="center">
                                <strong>Tên Nguyên Liệu</strong>
                            </td>
                             <td width="7%" align="center">
                                <strong>Tên Kim Cương</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>MS GĐPNJ</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>MS Cạnh GIA</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Kích Thước</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Trọng Lượng Hột</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Độ Tinh Khiết</strong>
                            </td>
                            
                             <td width="7%" align="center">
                                <strong>Cấp Độ Màu</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Độ Mài Bóng</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Kích Thước Bán</strong>
                            </td>
                            
                            <td width="9%" align="center">
                                <strong>Tiền Mặt</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Đơn Giá</strong>
                            </td>  
                        </tr>
                         <!--{section name=i loop=$viewtcctkimcuong}-->
                            <tr>
                                 <td align="left">
                                    <!--{$smarty.section.i.index+1+$number}-->
                                    <input type="hidden" name="idctnxkimcuong[]" value="<!--{$viewtcctkimcuong[i].id}-->" />
                                 </td>
                          
                                 <td align="left" class="kimcuong">
                                    <input type="hidden" name="nhomnguyenlieukimcuong[]" id="nhomnguyenlieukimcuong<!--{$smarty.section.i.index+1}-->" value="<!--{$viewtcctkimcuong[i].nhomnguyenlieukimcuong}-->" />
                                    <a id="popupNhomDanhMucKimCuong<!--{$smarty.section.i.index+1}-->" href="<!--{$path_url}-->/popup/DanhMucNguyenLieu.php?type=kimcuong&idnhomdm=<!--{$nhomdanhmuc.id}-->&idnhomnguyenlieukimcuong=<!--{$viewtcctkimcuong[i].nhomnguyenlieukimcuong}-->&idtennguyenlieukimcuong=<!--{$viewtcctkimcuong[i].tennguyenlieukimcuong}-->&idshow=<!--{$smarty.section.i.index+1}-->">
                                       <span id="showtennhomnguyenlieukimcuong<!--{$smarty.section.i.index+1}-->">
                                            <!--{if $viewtcctkimcuong[i].nhomnguyenlieukimcuong gt 0}-->
                                                <!--{insert name='getName' table='categories' names='name_vn' id=$viewtcctkimcuong[i].nhomnguyenlieukimcuong}-->
                                            <!--{else}-->
                                                Click chọn
                                            <!--{/if}-->
                                       </span>
                                    </a>
                                    <script type="text/javascript">
                                       $(document).ready(function() {
                                            $("#popupNhomDanhMucKimCuong<!--{$smarty.section.i.index+1}-->").fancybox();
                                        }); 
                                    </script>
    
                                 </td>
                                 
                                 <td align="left" class="kimcuong">
                                     <input type="hidden" name="tennguyenlieukimcuong[]" id="tennguyenlieukimcuong<!--{$smarty.section.i.index+1}-->" value="<!--{$viewtcctkimcuong[i].tennguyenlieukimcuong}-->" />
                                      <span id="showtennguyenlieukimcuong<!--{$smarty.section.i.index+1}-->">
                                            <!--{insert name='getName' table='categories' names='name_vn' id=$viewtcctkimcuong[i].tennguyenlieukimcuong}-->
                                      </span>
                                 </td>
                                 <td align="left" class="kimcuong">
                                    <input type="hidden" name="idkimcuong[]" id="idkimcuong<!--{$smarty.section.i.index+1}-->" value="<!--{$viewtcctkimcuong[i].idkimcuong}-->" />
                                    <a id="popupKimCuongHotChu<!--{$smarty.section.i.index+1}-->" href="<!--{$path_url}-->/popup/KimCuongHotChu.php?idkimcuong=<!--{$viewtcctkimcuong[i].idkimcuong}-->&idshow=<!--{$smarty.section.i.index+1}-->">
                                       <span id="showtennkimcuong<!--{$smarty.section.i.index+1}-->">
                                            <!--{if $viewtcctkimcuong[i].idkimcuong gt 0}-->
                                                <!--{insert name='getName' table='loaikimcuonghotchu' names='size' id=$viewtcctkimcuong[i].idkimcuong}-->::<!--{insert name='getName' table='loaikimcuonghotchu' names='name_vn' id=$viewtcctkimcuong[i].idkimcuong}-->
                                            <!--{else}-->
                                                Click chọn tên
                                            <!--{/if}-->
                                       </span>
                                    </a>
                                    <script type="text/javascript">
                                       $(document).ready(function() {
                                            $("#popupKimCuongHotChu<!--{$smarty.section.i.index+1}-->").fancybox();
                                        }); 
                                    </script>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="codegdpnj[]" id="codegdpnj<!--{$smarty.section.i.index+1}-->" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].codegdpnj}-->"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="codecgta[]" id="codecgta<!--{$smarty.section.i.index+1}-->" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].codecgta}-->"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="kichthuoc[]" id="kichthuoc<!--{$smarty.section.i.index+1}-->" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].kichthuoc}-->"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="trongluonghot[]" id="trongluonghot<!--{$smarty.section.i.index+1}-->" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].trongluonghot}-->"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="dotinhkhiet[]" id="dotinhkhiet<!--{$smarty.section.i.index+1}-->" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].dotinhkhiet}-->"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="capdomau[]" id="capdomau<!--{$smarty.section.i.index+1}-->" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].capdomau}-->"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="domaibong[]" id="domaibong<!--{$smarty.section.i.index+1}-->" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].domaibong}-->"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="kichthuocban[]" id="kichthuocban<!--{$smarty.section.i.index+1}-->" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].kichthuocban}-->"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" autocomplete="off" name="tienmatkimcuong[]" id="tienmatkimcuong<!--{$smarty.section.i.index+1}-->" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].tienmatkimcuong}-->"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" readonly="readonly" autocomplete="off" name="dongiaban[]" id="dongiaban<!--{$smarty.section.i.index+1}-->" class="txtdatagirld text-right autoNumeric" value="<!--{$viewtcctkimcuong[i].dongiaban}-->"/>
                                 </td>
                            </tr>
                        <!--{/section}--> 
                    </table>
                </div>
                
               
            </div>
            <div class="addRowGirlMain">
                <a href="javascript:void(0)" onclick="addNewRowGirlVang('<!--{$path_url}-->',<!--{$nhomdanhmuc.id}-->)" class="addRowGirl vang"> <strong>Thêm dòng</strong> </a>
                <a href="javascript:void(0)" onclick="addNewRowGirlKimCuong('<!--{$path_url}-->',<!--{$nhomdanhmuc.id}-->)" class="addRowGirl kimcuong"> <strong>Thêm dòng</strong> </a>
            </div>
           
            <div class="clear"></div>
        </div>
        
		<div class="MainContent TextCenter"> 
        	<input type="hidden" name="id" value="<!--{$edit.id}-->" />
            <input type="hidden" name="idnumvang" id="idnumvang" value="<!--{$coutndongvang}-->" />
            <input type="hidden" name="idnumkimcuong" id="idnumkimcuong" value="<!--{$coutndongkimcuong}-->" />
            <input type="button" class="btn-save" onclick=" return SubmitFromPTKhoNguonVao();" value="  Lưu " /> 
        </div>
   </form>
</div>
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/functions/function.js"></script>
<script src="<!--{$path_url}-->/fancybox/jquery.fancybox-1.3.1.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/fancybox/jquery.fancybox-1.3.1.css">
<link rel="stylesheet" href="<!--{$path_url}-->/popup/dialog.css">
<script>
$(document).ready(function() {
	$("#datedchungtu").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
 });
</script>	