<?php
/* Smarty version 4.1.1, created on 2023-08-25 11:04:28
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e8284ce958f6_51602003',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '23d92af9e1c446515751720e259ba9f131208c9f' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho\\edit.tpl',
      1 => 1692936258,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e8284ce958f6_51602003 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\wamp64\\www\\duan_demo\\libraries\\smarty4\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <?php echo insert_HearderCat(array('cid' => $_REQUEST['cid'], 'root' => $_REQUEST['root'], 'act' => $_REQUEST['act']),$_smarty_tpl);?>
    </ul>
</div>
<div class="MainContent">
    <form name="allsubmit" id="frmEdit" action="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho.php?act=<?php if ($_REQUEST['act'] == 'add') {?>addsm<?php } else { ?>editsm<?php }?>&cid=<?php echo $_REQUEST['cid'];?>
" method="post" enctype="multipart/form-data">
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
                            <td width="7%" align="center">
                                <strong>Đơn Hàng</strong>
                            </td>
                            
                            <td  align="center">
                                <strong>Ghi Chú</strong>
                            </td>
                        </tr>
                        <tr>
                             <td align="left"> 
                             	<input type="text" autocomplete="off" name="maphieu" id="maphieu" class="txtdatagirld" readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['maphieu'];?>
"/>

                             </td>
                             <td align="left">
                                 <input type="text" name="dated" id="dated" class="txtdatagirld" readonly="readonly" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['edit']->value['dated'],'%d/%m/%Y');?>
"/>
                             </td>
                           
                             <td align="left">
                                 <select class="selectOption" id="idloaivang" name="idloaivang" >
                                     <option value="">--Chọn loại vàng--</option>
                                     <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['typegold']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                                     	<option value="<?php echo $_smarty_tpl->tpl_vars['typegold']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['edit']->value['idloaivang'] == $_smarty_tpl->tpl_vars['typegold']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id']) {?>selected="selected"<?php }?>>
                                        	<?php echo $_smarty_tpl->tpl_vars['typegold']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                                        </option>
                                     <?php
}
}
?>
                                </select>
                             </td>
                             
                             <td align="left">
                                 <input type="text" autocomplete="off" name="cannangvh" id="cannangvh1" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['cannangvh'];?>
" onchange="getslcannangv(1)"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="cannangh" id="cannangh1" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['cannangh'];?>
" onchange="getslcannangv(1)"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="cannangv" id="cannangv1" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['cannangv'];?>
" readonly="readonly"/>
                             </td>
                             <td align="left">
                                 <input onchange="checktuoivang(this.value)" type="text" autocomplete="off" name="tuoivang" id="tuoivang" class="txtdatagirld text-right autoNumeric4" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['tuoivang'];?>
" />
                                 <?php echo '<script'; ?>
>
								 	function checktuoivang(num){
										num = num.split(',').join('');
										if(num >= 1){
											alert('tuổi vàng phải nhỏ hơn 1.');
											$('#tuoivang').val(0);
										}
									}
								 <?php echo '</script'; ?>
>
                             </td>
                             <td align="left">
                                 
                                <div id="siteIDload">
                                    <select name="chonphongbanin" id="chonphongbanin" class="abcd chonphonbanSanXuat">
                                         <option value="0">Chọn Phòng Sản Xuất</option>
                                         <?php echo insert_optionChuyenDenSelected(array('chonphongbanin' => $_smarty_tpl->tpl_vars['edit']->value['chonphongbanin'], 'id' => '283,376,708,169,1845'),$_smarty_tpl);?>
                                    </select> 
                                </div>
                             </td>
                             
                             <td align="left">
                                 <?php echo '<script'; ?>
>
                                    $(function () {
                                        $("#siteIDload select").select2();
                                    });
                                <?php echo '</script'; ?>
>
                                <div id="siteIDload">
                                    <select name="madhin" id="madhin" class="abcd chonphonbanSanXuat" onchange="getSLVaoCotGhiChu(this.value)">
                                         <option value="0">Chọn Mã Đơn Hàng Catalog</option>
                                      
                                    </select> 
                                </div>
                             </td>
                             
                             <td align="left">
                                 <input type="text" autocomplete="off" name="ghichuvang" id="ghichuvang" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['ghichuvang'];?>
"/>
                             </td> 
                                   
                        </tr>
                    </table>
                </div> 
            </div>
            <div class="clear"></div>
        </div>
        
		<div class="MainContent TextCenter"> 
        	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['id'];?>
" />
            <input type="hidden" name="cid" id="cid" value="<?php echo $_REQUEST['cid'];?>
" />
            <input type="button" class="btn-save" onclick=" return SubmitFromXuatKhoSanXuat();" value="  Lưu " /> 
        </div>
   </form>
</div>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/autoNumeric.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/functions/function.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/select-checkbox/sol.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/select-checkbox/sol.css" />

   <!--insert name='optionChoDonHangCatalog' madhin=$edit.madhin cid=$phongbanchuyen--> <?php }
}
