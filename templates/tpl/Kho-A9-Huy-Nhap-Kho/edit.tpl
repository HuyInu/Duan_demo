<link type="text/css" href="<!--{$path_url}-->/calendar/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$path_url}-->/calendar/jquery-ui.js"></script>

<div class="MainContent">
	<form name="allsubmit" id="frmEdit" action="<!--{$path_url}-->/sources/Kho-A9-Huy-Nhap-Kho.php?act=<!--{if $smarty.request.act eq 'add' }-->addsm<!--{else}-->editsm<!--{/if}-->&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
        <div class="main-content padding-topfooter">
            <div class="panel-left">
                <div class="box-thongin">
                    <div class="title-thongtin">Thông Tin Phiếu Nhập Kho</div>                   
                    <div class="SubAll">
                        <div class="SubLeft">
                            Người Lập Phiếu
                        </div>
                        
                        <div class="SubRight">
                            <input name="nguoilapphieu" id="nguoilapphieu" value="<!--{$toa.nguoilapphieu}-->" class="InputText" type="text"/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Đơn Vị
                        </div>
                        
                        <div class="SubRight">
                            <input name="donvilapphieu" id="donvilapphieu" value="<!--{$toa.donvilapphieu}-->" class="InputText" type="text" />
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Người Duyệt Phiếu
                        </div>
                        
                        <div class="SubRight">
                            <input name="nguoiduyetphieu" id="nguoiduyetphieu" value="<!--{$toa.nguoiduyetphieu}-->" class="InputText" type="text"/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Đơn Vị
                        </div>
                        
                        <div class="SubRight">
                            <input name="donviduyetphieu" id="donviduyetphieu" value="<!--{$toa.donviduyetphieu}-->" class="InputText" type="text"/>
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Lý Do
                        </div>
                        
                        <div class="SubRight">
                            <input name="lydo" id="lydo" value="<!--{$toa.lydo}-->" class="InputText" type="text" autocomplete="off" />
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
                            <input readonly="readonly" name="maphieu" id="maphieu" value="<!--{$toa.maphieu}-->" class="InputText" type="text"  />
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Ngày nhập
                        </div>
                        
                        <div class="SubRight">
                            <input type="text" class="InputText" name="datedchungtu" id="datedchungtu" value="<!--{$toa.datedchungtu|date_format:'%d/%m/%Y'}-->"  readonly="readonly" />
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Ngày hạch toán
                        </div>
                        
                        <div class="SubRight">
                            <input type="text" class="InputText" name="datedhachtoan" id="datedhachtoan" value="<!--{$toa.datedhachtoan|date_format:'%d/%m/%Y'}-->" readonly="readonly" />
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Upload File Excel
                        </div>
                        <div class="SubRight">
                        	<input type="file" name="fileexcel" id="fileexcel" onchange="check_file('fileexcel');" />
                            <!--{if $toa.fileexcel neq ''}-->
                            	<a href="<!--{$path_url}-->/<!--{$toa.fileexcel}-->" title="Tải file"> 
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
                        <!--{section name=i loop=$ctToaVang}-->
                        <tr>
                            <td width="3%" align="center">
                                 <!--{$smarty.section.i.index + 1}--> 
                                 <input type="hidden" name="idctnxvang[]" value="<!--{$ctToaVang[i].id}-->" />
                            </td> 
                            <td width="13%" align="center">
                                <input type="hidden" name="nhomnguyenlieuvang[]" id="nhomnguyenlieuvang<!--{$smarty.section.i.index+1}-->" value="<!--{$ctToaVang[i].nhomnguyenlieuvang}-->" />
                                <a id="popupNhomDanhMucVang<!--{$smarty.section.i.index+1}-->" href="<!--{$path_url}-->/popup/DanhMucNguyenLieu.php?type=vang&idnhomdm=<!--{$nhomdanhmuc.id}-->&idnhomnguyenlieuvang=<!--{$ctToaVang[i].nhomnguyenlieuvang}-->&idtennguyenlieuvang=<!--{$ctToaVang[i].tennguyenlieuvang}-->&idshow=<!--{$smarty.section.i.index+1}-->">
                                    <span id="showtennhomnguyenlieuvang<!--{$smarty.section.i.index+1}-->">
                                        <!--{if $ctToaVang[i].nhomnguyenlieuvang gt 0}-->
                                            <!--{getName('categories', 'name_vn', <!--{$ctToaVang[i].nhomnguyenlieuvang}-->)}-->
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
                            <td width="13%" align="center">
                                <input type="hidden" name="tennguyenlieuvang[]" id="tennguyenlieuvang<!--{$smarty.section.i.index+1}-->" value="<!--{$ctToaVang[i].tennguyenlieuvang}-->" />
                                <span id="showtennguyenlieuvang<!--{$smarty.section.i.index+1}-->">
                                    <!--{getName('categories', 'name_vn', <!--{$ctToaVang[i].tennguyenlieuvang}-->)}-->
                                </span>
                            </td>
                            <td width="8%" align="center">
                                <!--{loadloaivang($ctToaVang[i].idloaivang,'',$smarty.section.i.index+1)}-->
                            </td>
                            <td width="10%" align="center">
                                <input type="text" autocomplete="off" name="cannangvh[]" id="cannangvh<!--{$smarty.section.i.index+1}-->" value="<!--{$ctToaVang[i].cannangvh}-->" class="txtdatagirld text-right autoNumeric" onkeyup="getslcannangv(<!--{$smarty.section.i.index+1}-->)"/>
                            </td>
                            <td width="8%" align="center">
                                <input type="text" autocomplete="off" name="cannangh[]" id="cannangh<!--{$smarty.section.i.index+1}-->" value="<!--{$ctToaVang[i].cannangh}-->" class="txtdatagirld text-right autoNumeric" onkeyup="getslcannangv(<!--{$smarty.section.i.index+1}-->)"/>
                            </td>
                            <td width="8%" align="center">
                                <input type="text" autocomplete="off" name="cannangv[]" id="cannangv<!--{$smarty.section.i.index+1}-->" value="<!--{$ctToaVang[i].cannangv}-->" class="txtdatagirld text-right autoNumeric"/>
                            </td>
                            <td width="8%" align="center">
                                <input type="text" autocomplete="off" name="tuoivang[]" id="tuoivang<!--{$smarty.section.i.index+1}-->" value="<!--{$ctToaVang[i].tuoivang}-->" class="txtdatagirld text-right autoNumeric"/>
                            </td>
                            <td width="12%" align="center">
                                <input type="text" autocomplete="off" name="tienmatvang[]" id="tienmatvang<!--{$smarty.section.i.index+1}-->" value="<!--{$ctToaVang[i].tienmatvang}-->" class="txtdatagirld text-right autoNumeric"/> 
                            </td>
                            <td width="17%" align="center">
                                <input type="text" autocomplete="off" name="ghichuvang[]" id="ghichuvang<!--{$smarty.section.i.index+1}-->" value="<!--{$ctToaVang[i].ghichuvang}-->" class="txtdatagirld text-right autoNumeric"/>
                            </td>
                        </tr>
                        <!--{/section}-->
                    </table>
                </div>
            </div>
            <div class="addRowGirlMain">
                <a href="javascript:void(0)" onclick="addNewRowGirlVang('<!--{$path_url}-->',<!--{$nhomdanhmuc.id}-->)" class="addRowGirl vang"> <strong>Thêm dòng</strong> </a>
            </div>
        </div>
        <div class="MainContent TextCenter"> 
        	<input type="hidden" name="id" value="<!--{$toa.id}-->" />
            <input type="hidden" name="idnumvang" id="idnumvang" value="<!--{$coutndongvang}-->" />
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