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
    <form name="allsubmit" id="frmEdit" action="<!--{$path_url}-->/sources/KhoSanXuat-Kho-Vmnt-Hao-Du.php?act=<!--{if $smarty.request.act eq 'add' }-->addsm<!--{else}-->editsm<!--{/if}-->&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
     	<div class="box-thongin" >
            <div class="MainTable">
               	<div class="table2scroll">
                    <table width="100%" border="1">
                        <tr class="trheader">
                        	<td width="10%" align="center">
                                <strong>Hình</strong>
                            </td>
                            <td width="13%" align="center">
                                <strong>Mã Phiếu</strong>
                            </td>
                            <td width="13%" align="center">
                                <strong>Ngày Nhập</strong>
                            </td>
                            
                            <td width="8%" align="center">
                                <strong>Loại Vàng</strong>
                            </td>
                            <td width="10%" align="center">
                                <strong>Hao Kết Dẻ</strong>
                            </td>
                            <td width="10%" align="center">
                                <strong>Dư Kết Dẻ</strong>
                            </td>
                            <td width="10%" align="center">
                                <strong>Hao Chênh Lệch</strong>
                            </td>
                            <td width="10%" align="center">
                                <strong>Dư Chênh Lệch</strong>
                            </td>
                            <td  align="center">
                                <strong>Ghi Chú</strong>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left" class="imgthumb"> 
                            	<!--{if $edit.img neq ""}-->
                                	 <a href="javascript:void(0)" onclick="popupwindow('<!--{$path_url}-->/<!--{$edit.img}-->','mywindow')" title="Click Vào Xem hình lớn">
                                    	<img width="50" src="../<!--{$edit.img_thumb}-->"   />
                                     </a>   
                                <!--{/if}-->
                                <!--{if $edit.img1 neq ""}-->
                                	<a href="javascript:void(0)" onclick="popupwindow('<!--{$path_url}-->/<!--{$edit.img1}-->','mywindow')" title="Click Vào Xem hình lớn">
                                    	<img width="50" src="../<!--{$edit.img_thumb}-->"   />
                                    </a>
                                <!--{/if}-->
                                <br />
                                <input type="file" name="img" id="img" onchange="check_file('img');" /> 
                                Xóa Hình 1 <input type="checkbox" class="CheckBoxImg" name="del_img" value="del_img" /> <br />
                                
                                <input type="file" name="img1" id="img1" onchange="check_file('img1');" /> 
                                Xóa Hình 2 <input type="checkbox" class="CheckBoxImg" name="del_img1" value="del_img1" />
                             </td>
                             <td align="left"> 
                             	<input type="text" autocomplete="off" name="maphieu" id="maphieu" class="txtdatagirld" readonly="readonly" value="<!--{$edit.maphieu}-->"/>

                             </td>
                             <td align="left">
                                 <input type="text" name="dated" id="dated" class="txtdatagirld" autocomplete="off" <!--{if $smarty.request.act eq 'edit' }--> readonly="readonly" <!--{/if}--> value="<!--{$edit.dated|date_format:'%d/%m/%Y'}-->"/>
                             </td>
                           
                             <td align="left">
                                 <select class="selectOption" id="idloaivang" name="idloaivang" >
                                     <option value="">--Chọn loại vàng--</option>
                                     <!--{section name=i loop=$typegold}-->
                                     	<option value="<!--{$typegold[i].id}-->" <!--{if $edit.idloaivang eq $typegold[i].id}-->selected="selected"<!--{/if}-->>
                                        	<!--{$typegold[i].name_vn}-->
                                        </option>
                                     <!--{/section}-->
                                </select>
                             </td>
                             
                             <td align="left">
                                 <input type="text" autocomplete="off" name="hao" id="hao" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.hao}-->"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="du" id="du" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.du}-->"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="haochenhlech" id="haochenhlech" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.haochenhlech}-->"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="duchenhlech" id="duchenhlech" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.duchenhlech}-->"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="ghichu" id="ghichu" class="txtdatagirld" value="<!--{$edit.ghichu}-->"/>
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
            <input type="button" class="btn-save" onclick=" return SubmitFromXuatKhoSanXuatHaoDu();" value="  Lưu " /> 
        </div>
   </form>
</div>
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/functions/function.js"></script>
<script>
<!--{if $smarty.request.act eq 'add' }-->
	$(document).ready(function() {
		$("#dated").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
	 });
<!--{/if}-->
</script>