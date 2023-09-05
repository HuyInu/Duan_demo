<?php
/* Smarty version 4.1.1, created on 2023-09-05 08:17:52
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho\editkimcuong.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64f681c0f08da8_82419390',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '46e169cd63e1895f445d6b146a90e790b3165533' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho\\editkimcuong.tpl',
      1 => 1693876670,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64f681c0f08da8_82419390 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="ChonLoaiPhieu">
    <ul>
        <li class="active" id="clickVang" onclick="clickVang('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?act=<?php echo $_REQUEST['act'];?>
&cid=<?php echo $_REQUEST['cid'];?>
')">
            <a>Vàng</a>
        </li>
        <li id="clickKimCuong" onclick="clickKimCuong('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?act=<?php echo $_REQUEST['act'];?>
&cid=<?php echo $_REQUEST['cid'];?>
')">
            <a>Kim Cương</a>
        </li>
    </ul>
</div>
<div class="MainContent">
    <form name="allsubmit" id="frmEdit" action="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho1.php?act=<?php if ($_REQUEST['act'] == 'add') {?>addsm<?php } else { ?>editsm<?php }?>&cid=<?php echo $_REQUEST['cid'];?>
" method="post" enctype="multipart/form-data">
     	<div class="box-thongin" >
            <div class="MainTable">
            <div class="table2scroll">         
                <table width="100%" border="1" id="addRowGirlKimCuong" class="kimcuong">
                    <tr class="trheader">
                        <td width="13%" align="center">
                            <strong>Mã Phiếu</strong>
                        </td>
                        <td width="13%" align="center">
                            <strong>Ngày Nhập</strong>
                        </td>
                        <td width="9%" align="center">
                            <strong>Tiền Mặt</strong>
                        </td>
                        <td width="7%" align="center">
                            <strong>Đơn Giá</strong>
                        </td> 
                        <td width="7%" align="center">
                            <strong>Phòng Sản Xuất</strong>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <input type="text" readonly autocomplete="off" name="maphieu" id="maphieu" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['maphieu'];?>
"/>
                        </td>
                        <td align="left">
                            <input type="text" readonly autocomplete="off" name="dated" id="dated" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['dated'];?>
"/>
                        </td>
                        <td align="left" class="kimcuong">
                            <input type="text" autocomplete="off" name="tienmatkimcuong" id="tienmatkimcuong" class="txtdatagirld autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['tienmatkimcuong'];?>
"/>
                        </td>
                        <td align="left" class="kimcuong">
                            <input type="text" autocomplete="off" name="dongiaban" id="dongiaban" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['dongiaban'];?>
"/>
                        </td>
                        <td align="left">       
                            <div id="siteIDload">
                                <select name="chonphongbanin" id="chonphongbanin" class="abcd chonphonbanSanXuat">
                                        <option value="0">Chọn Phòng Sản Xuất</option>
                                        <?php echo insert_optionChuyenDenSelected(array('chonphongbanin' => $_smarty_tpl->tpl_vars['edit']->value['chonphongbanin'], 'id' => '283,376,708,169,1845'),$_smarty_tpl);?>
                                </select> 
                            </div>
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
