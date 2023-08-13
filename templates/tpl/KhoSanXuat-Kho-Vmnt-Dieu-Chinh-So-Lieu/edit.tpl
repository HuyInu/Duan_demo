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
    <form name="allsubmit" id="frmEdit" action="<!--{$path_url}-->/sources/KhoSanXuat-Kho-Vmnt-Dieu-Chinh-So-Lieu.php?act=editsm&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
     	<div class="box-thongin" >
            <div class="MainTable">
               	<div class="table2scroll">
                
                    <table width="100%" border="1">
                        <tr class="trheader">
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
                                <strong>Cân Nặng V+H</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Cân Nặng H</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Cân Nặng V</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Phòng Sản Xuất</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Đơn Hàng</strong>
                            </td>
                            <td  align="center">
                                <strong>Ghi Chú</strong>
                            </td>
                            <td width="8%" align="center">
                                <strong>Ngày Sửa</strong>
                            </td>
                            <td  align="center">
                                <strong>Ghi Chú Sửa</strong>
                            </td>
                        </tr>
                        <tr>
                             <td align="left"> 
                             	<input type="text" autocomplete="off" name="maphieu" id="maphieu" class="txtdatagirld" readonly="readonly" value="<!--{$edit.maphieu}-->"/>

                             </td>
                             <td align="left">
                                 <input type="text" name="dated" id="dated" class="txtdatagirld" readonly="readonly" value="<!--{$edit.dated|date_format:'%d/%m/%Y'}-->"/>
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
                                 <input type="text" autocomplete="off" name="cannangvh" id="cannangvh1" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.cannangvh}-->" onchange="getslcannangv(1)"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="cannangh" id="cannangh1" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.cannangh}-->" onchange="getslcannangv(1)"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="cannangv" id="cannangv1" class="txtdatagirld text-right autoNumeric" value="<!--{$edit.cannangv}-->" readonly="readonly"/>
                             </td>
                             <td align="left">
                                 
                                <div id="siteIDload">
                                    <select name="chonphongbanin" id="chonphongbanin" class="abcd chonphonbanSanXuat">
                                         <option value="0">Chọn Phòng Sản Xuất</option>
                                         <!--{insert name='optionKhoSanXuatChonPhong' chonphongbanin=$edit.chonphongbanin noid='623'}-->
                                    </select> 
                                </div>
                             </td>
                             
                             <td align="left">
                                 <script>
                                    $(function () {
                                        $("#siteIDload select").select2();
                                    });
                                </script>
                                <div id="siteIDload">
                                    <select name="madhin" id="madhin" class="abcd chonphonbanSanXuat" onchange="getSLVaoCotGhiChu(this.value)">
                                         <option value="">Chọn Mã Đơn Hàng Catalog</option>
                                         <!--{insert name='optionChoDonHangCatalog' madhin=$edit.madhin cid=$phongbanchuyen}-->
                                    </select> 
                                </div>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="ghichuvang" id="ghichuvang" class="txtdatagirld" value="<!--{$edit.ghichuvang}-->"/>
                             </td> 
                            <td align="left">
                                <input type="text" autocomplete="off" name="datedieuchinh" id="datedieuchinh" class="txtdatagirld" placeholder="dd/mm/yyyy" autocomplete="off" value="<!--{$edit.datedieuchinh|date_format:'%d/%m/%Y'}-->"/>
                                <!--{include file="./allsearch/datedieuchinh.tpl"}-->
                            </td>
                            <td align="left">
                                <input type="text" autocomplete="off" name="ghichueditvang" id="ghichuvang" class="txtdatagirld" value="<!--{$edit.ghichueditvang}-->"/>
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
            <input type="button" class="btn-save" onclick=" return SubmitFromXuatKhoSanXuat('DieuChinhSoLieu');" value="  Lưu " /> 
        </div>
   </form>
</div>
<script type="text/javascript" src="<!--{$path_url}-->/js/autoNumeric.js"></script>
<script type="text/javascript" src="<!--{$path_url}-->/js/functions/function.js"></script>

<script type="text/javascript" src="<!--{$path_url}-->/js/select-checkbox/sol.js"></script>
<link rel="stylesheet" href="<!--{$path_url}-->/js/select-checkbox/sol.css" />