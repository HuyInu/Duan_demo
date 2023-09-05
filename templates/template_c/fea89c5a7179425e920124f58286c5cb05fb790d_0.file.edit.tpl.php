<?php
/* Smarty version 4.1.1, created on 2023-09-05 14:13:47
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Huy-Kho-Vmnt-Hao-Du\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64f6d52baa80f2_34352462',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'fea89c5a7179425e920124f58286c5cb05fb790d' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Huy-Kho-Vmnt-Hao-Du\\edit.tpl',
      1 => 1693897838,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64f6d52baa80f2_34352462 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\wamp64\\www\\duan_demo\\libraries\\smarty4\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.js"><?php echo '</script'; ?>
>
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
/sources/KhoSanXuat-Huy-Kho-Vmnt-Hao-Du.php?act=<?php if ($_REQUEST['act'] == 'add') {?>addsm<?php } else { ?>editsm<?php }?>&cid=<?php echo $_REQUEST['cid'];?>
" method="post" enctype="multipart/form-data">
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
                            	<?php if ($_smarty_tpl->tpl_vars['edit']->value['img'] != '') {?>
                                	 <a href="javascript:void(0)" onclick="popupwindow('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['edit']->value['img'];?>
','mywindow')" title="Click Vào Xem hình lớn">
                                    	<img width="50" src="../<?php echo $_smarty_tpl->tpl_vars['edit']->value['img_thumb'];?>
"   />
                                     </a>   
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['edit']->value['img1'] != '') {?>
                                	<a href="javascript:void(0)" onclick="popupwindow('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['edit']->value['img1'];?>
','mywindow')" title="Click Vào Xem hình lớn">
                                    	<img width="50" src="../<?php echo $_smarty_tpl->tpl_vars['edit']->value['img_thumb'];?>
"   />
                                    </a>
                                <?php }?>
                                <br />
                                <input type="file" name="img" id="img" onchange="check_file('img');" /> 
                                Xóa Hình 1 <input type="checkbox" class="CheckBoxImg" name="del_img" value="del_img" /> <br />
                                
                                <input type="file" name="img1" id="img1" onchange="check_file('img1');" /> 
                                Xóa Hình 2 <input type="checkbox" class="CheckBoxImg" name="del_img1" value="del_img1" />
                             </td>
                             <td align="left"> 
                             	<input type="text" autocomplete="off" name="maphieu" id="maphieu" class="txtdatagirld" readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['maphieu'];?>
"/>

                             </td>
                             <td align="left">
                                 <input type="text" name="dated" id="dated" class="txtdatagirld" autocomplete="off" <?php if ($_REQUEST['act'] == 'edit') {?> readonly="readonly" <?php }?> value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['edit']->value['dated'],'%d/%m/%Y');?>
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
                                 <input type="text" autocomplete="off" name="hao" id="hao" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['hao'];?>
"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="du" id="du" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['du'];?>
"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="haochenhlech" id="haochenhlech" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['haochenhlech'];?>
"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="duchenhlech" id="duchenhlech" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['duchenhlech'];?>
"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="ghichu" id="ghichu" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['ghichu'];?>
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
            <input type="button" class="btn-save" onclick=" return SubmitFromXuatKhoSanXuatHaoDu();" value="  Lưu " /> 
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
>
<?php if ($_REQUEST['act'] == 'add') {?>
	$(document).ready(function() {
		$("#dated").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
	 });
<?php }
echo '</script'; ?>
><?php }
}
