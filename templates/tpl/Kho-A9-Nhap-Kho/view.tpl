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
	<form name="allsubmit" id="frmEdit">
        <div class="main-content padding-topfooter">
            <div class="panel-left">
                <div class="box-thongin">
                    <div class="title-thongtin">Thông Tin Phiếu Nhập Kho</div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Người Lập Phiếu
                        </div>
                        
                        <div class="SubRight">
                            <input  readonly="readonly" value="<!--{$edit.nguoilapphieu}-->" class="InputText" type="text"/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Đơn Vị
                        </div>
                        
                        <div class="SubRight">
                            <input readonly="readonly" value="<!--{$edit.donvilapphieu}-->" class="InputText" type="text" />
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Người Duyệt Phiếu
                        </div>
                        
                        <div class="SubRight">
                            <input readonly="readonly" value="<!--{$edit.nguoiduyetphieu}-->" class="InputText" type="text"/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Đơn Vị
                        </div>
                        
                        <div class="SubRight">
                            <input readonly="readonly" value="<!--{$edit.donviduyetphieu}-->" class="InputText" type="text"/>
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Lý nộp
                        </div>
                        
                        <div class="SubRight">
                            <input readonly="readonly" value="<!--{$edit.lydo}-->" class="InputText" type="text" autocomplete="off" />
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
                            <input readonly="readonly" value="<!--{$edit.maphieu}-->" class="InputText" type="text"  />
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Ngày nhập
                        </div>
                        
                        <div class="SubRight">
                            <input type="text" class="InputText" value="<!--{$edit.datedchungtu|date_format:'%d/%m/%Y'}-->"  readonly="readonly" />
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Ngày hạch toán
                        </div>
                        
                        <div class="SubRight">
                            <input type="text" class="InputText" value="<!--{$edit.datedhachtoan|date_format:'%d/%m/%Y'}-->" readonly="readonly" />
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Upload File Excel
                        </div>
                        <div class="SubRight">
                        	
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

                    <table width="100%" border="1" id="addRowGirlVang" class="vang">
                        <tr class="trheader">
                            <td width="3%" align="center">
                                <strong>STT</strong>
                            </td> 
                            
                            <td align="center">
                                <strong>Nhóm Nguyên Liệu</strong>
                            </td>
                            <td align="center">
                                <strong>Tên Nguyên Liệu</strong>
                            </td>
                            
                            <td align="center">
                                <strong>Loại Vàng</strong>
                            </td>
                            <td align="center">
                                <strong>Cân Nặng V+H</strong>
                            </td>
                            <td align="center">
                                <strong>Cân Nặng H</strong>
                            </td>
                            <td align="center">
                                <strong>Cân Nặng V</strong>
                            </td>
                            <td align="center">
                                <strong>Tuổi Vàng</strong>
                            </td>
                            <td align="center">
                                <strong>Tiền Mặt</strong>
                            </td>
                            <td align="center">
                                <strong>Ghi Chú</strong>
                            </td>
                        </tr>
                         <!--{section name=i loop=$viewtcctvang}-->
                            <tr>
                                 <td align="left">
                                    <!--{$smarty.section.i.index+1+$number}-->
                                 </td>
                                        
                                 <td align="left"> 
                                    <!--{insert name='getName' table='categories' names='name_vn' id=$viewtcctvang[i].nhomnguyenlieuvang}-->
                                 </td>
                                 <td align="left">
                                     <!--{insert name='getName' table='categories' names='name_vn' id=$viewtcctvang[i].tennguyenlieuvang}-->
                                 </td>
                               
                                 <td align="left">
                                     <!--{insert name='loadloaivang' idloaivang=$viewtcctvang[i].idloaivang}-->
                                 </td>
                                 
                                 <td align="left">
                                     <input type="text" class="txtdatagirld text-right autoNumeric" value="<!--{$viewtcctvang[i].cannangvh}-->" eadonly="readonly"/>
                                 </td>
                                  <td align="left">
                                     <input type="text" class="txtdatagirld text-right autoNumeric" value="<!--{$viewtcctvang[i].cannangh}-->" eadonly="readonly"/>
                                 </td>
                                 <td align="left">
                                     <input type="text" class="txtdatagirld text-right autoNumeric" value="<!--{$viewtcctvang[i].cannangv}-->" eadonly="readonly"/>
                                 </td>
                                 <td align="left">
                                     <input type="text" class="txtdatagirld" value="<!--{$viewtcctvang[i].tuoivang}-->" eadonly="readonly"/>
                                 </td>
                                 <td align="left">
                                     <!--{$viewtcctvang[i].tienmatvang}-->
                                 </td>
                                 <td align="left">
                                    <!--{$viewtcctvang[i].ghichuvang}-->
                                 </td>       
                            </tr>
                        <!--{/section}--> 
                    </table>
                
                   <table width="100%" border="1" id="addRowGirlKimCuong" class="kimcuong">
                        <tr class="trheader">
                            <td width="3%" align="center">
                                <strong>STT</strong>
                            </td> 
                            <td align="center">
                                <strong>Nhóm Nguyên Liệu</strong>
                            </td>
                            <td align="center">
                                <strong>Tên Nguyên Liệu</strong>
                            </td>
                             <td align="center">
                                <strong>Tên Kim Cương</strong>
                            </td>
                            <td align="center">
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
                            
                        </tr>
                         <!--{section name=i loop=$viewtcctkimcuong}-->
                            <tr>
                                 <td align="left">
                                    <!--{$smarty.section.i.index+1+$number}-->
                                 </td>
                          
                                 <td align="left" class="kimcuong">
                                     <!--{insert name='getName' table='categories' names='name_vn' id=$viewtcctkimcuong[i].nhomnguyenlieukimcuong}-->
                                 </td>
                                 
                                 <td align="left" class="kimcuong">
                                       <!--{insert name='getName' table='categories' names='name_vn' id=$viewtcctkimcuong[i].tennguyenlieukimcuong}-->
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <!--{insert name='getName' table='loaikimcuonghotchu' names='size' id=$viewtcctkimcuong[i].idkimcuong}-->::<!--{insert name='getName' table='loaikimcuonghotchu' names='name_vn' id=$viewtcctkimcuong[i].idkimcuong}-->
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].codegdpnj}-->" eadonly="readonly"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].codecgta}-->" eadonly="readonly"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text"class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].kichthuoc}-->" eadonly="readonly"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].trongluonghot}-->" eadonly="readonly"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].dotinhkhiet}-->" eadonly="readonly"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].capdomau}-->" eadonly="readonly"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].domaibong}-->" eadonly="readonly"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<!--{$viewtcctkimcuong[i].kichthuocban}-->" eadonly="readonly"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <!--{$viewtcctkimcuong[i].tienmatkimcuong}-->
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" readonly="readonly" class="txtdatagirld text-right autoNumeric" value="<!--{$viewtcctkimcuong[i].dongiaban}-->"/>
                                 </td>
                            </tr>
                        <!--{/section}--> 
                        
                    </table>

               
            </div>
            
            <div class="clear"></div>
        </div>
       
   </form>
</div>
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/functions/function.js"></script>