<?php
/* Smarty version 4.1.1, created on 2023-08-28 09:23:24
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-A9-Xuat-Kho\editvang.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64ec051cdeca94_62574511',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'caac3c1e3fe148cf4e19a532d107c38379983624' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-A9-Xuat-Kho\\editvang.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64ec051cdeca94_62574511 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="breadcrumb">
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
/sources/Kho-A9-Xuat-Kho.php?act=editsmVang&cid=<?php echo $_REQUEST['cid'];?>
" method="post" enctype="multipart/form-data">
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
                             	<input type="hidden" name="nhomnguyenlieuvang" id="nhomnguyenlieuvang1" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['nhomnguyenlieuvang'];?>
" />
                               
                                    <span id="showtennhomnguyenlieuvang1">
                                        <?php if ($_smarty_tpl->tpl_vars['edit']->value['nhomnguyenlieuvang'] > 0) {?>
                                            <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['edit']->value['nhomnguyenlieuvang']),$_smarty_tpl);?>
                                        <?php } else { ?>
                                            Click chọn
                                        <?php }?>    
                                    </span>
                                
                             </td>
                             <td align="left">
                                 <input type="hidden" name="tennguyenlieuvang" id="tennguyenlieuvang1" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['tennguyenlieuvang'];?>
" />
                                 <span id="showtennguyenlieuvang1">
                                    <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['edit']->value['tennguyenlieuvang']),$_smarty_tpl);?>
                                 </span>
                             </td>
                           
                             <td align="left">
                                 <select class="selectOption" id="idloaivang" name="idloaivang" disabled="disabled" >
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
" onchange="getslcannangv(1)" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="cannangh" id="cannangh1" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['cannangh'];?>
" onchange="getslcannangv(1)" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="cannangv" id="cannangv1" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['cannangv'];?>
" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="tuoivang" id="tuoivang1" class="txtdatagirld autoNumeric4 text-right" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['tuoivang'];?>
" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="tienmatvang" id="tienmatvang1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['tienmatvang'];?>
" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 
                                <div id="siteIDload">
                                    <select name="chonphongbanin" id="chonphongbanin" class="abcd chonphonbanSanXuat">
                                         <option value="0">Chọn Phòng Sản Xuất</option>
                                         <?php echo insert_optionChuyenDenSelected(array('id' => '623, 169, 647, 706', 'chonphongbanin' => $_smarty_tpl->tpl_vars['edit']->value['chonphongbanin']),$_smarty_tpl);?>
                                    </select> 
                                </div>
                                 <?php echo '<script'; ?>
>
                                    $(function () {
                                        $("#siteIDload select").select2();
                                    });
                                <?php echo '</script'; ?>
>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="ghichueditvang" id="ghichueditvang1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['ghichuvang'];?>
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
            <input type="hidden" name="idct" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['idct'];?>
" />
            <input type="button" class="btn-save" onclick=" return SubmitFromPTKhoNguonVaoOne();" value="  Lưu " /> 
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
 src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/fancybox/jquery.fancybox-1.3.1.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/fancybox/jquery.fancybox-1.3.1.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/popup/dialog.css"><?php }
}
