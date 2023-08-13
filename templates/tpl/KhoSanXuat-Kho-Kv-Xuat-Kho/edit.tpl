<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<!--{$path_url}-->/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <!--{getHearderCat(array(cid=>$smarty.request.cid, root=>$smarty.request.root, act=>$smarty.request.act))}-->
    </ul>
</div>
<div class="MainContent">
    <form name="allsubmit" id="frmEdit" action="<!--{$path_url}-->/sources/KhoSanXuat-Kho-Kv-Xuat-Kho.php?act=<!--{if $smarty.request.act eq 'add' }-->addsm<!--{else}-->editsm<!--{/if}-->&cid=<!--{$smarty.request.cid}-->" method="post" enctype="multipart/form-data">
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
                            
                            <td width="7%" align="center">
                                <strong>Loại Vàng</strong>
                            </td>
                            <td width="10%" align="center">
                                <strong>Cân Nặng V+H</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Cân Nặng H</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Cân Nặng V</strong>
                            </td>
                            <td width="4%" align="center">
                                <strong>Tuổi vàng</strong>
                            </td>
                            <td width="7%" align="center">
                                <strong>Phòng Sản Xuất</strong>
                            </td>
                            <td  align="center">
                                <strong>Ghi Chú</strong>
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
                                 <input onchange="checktuoivang(this.value)" type="text" autocomplete="off" name="tuoivang" id="tuoivang" class="txtdatagirld text-right autoNumeric4" value="<!--{$edit.tuoivang}-->" />
                                 <script>
								 	function checktuoivang(num){
										num = num.split(',').join('');
										if(num >= 1){
											alert('tuổi vàng phải nhỏ hơn 1.');
											$('#tuoivang').val(0);
										}	
									}
								 </script>
                             </td>
                             <td align="left">
                                 
                                <div id="siteIDload">
                                    <select name="chonphongbanin" id="chonphongbanin" class="abcd chonphonbanSanXuat">
                                        <option value="0">Chọn Phòng Sản Xuất</option>
                                        <!--{optionChuyenDenSelectedTest(array(chonphongbanin=>$edit.chonphongbanin, id=>'283,376,708,169'))}-->
                                    </select> 
                                </div>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="ghichuvang" id="ghichuvang" class="txtdatagirld" value="<!--{$edit.ghichuvang}-->"/>
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