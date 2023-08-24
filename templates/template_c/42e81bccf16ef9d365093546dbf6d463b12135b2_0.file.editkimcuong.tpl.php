<?php
/* Smarty version 4.1.1, created on 2023-08-24 14:23:59
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-A9-Xuat-Kho\editkimcuong.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e7058fe4fee0_33847304',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '42e81bccf16ef9d365093546dbf6d463b12135b2' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-A9-Xuat-Kho\\editkimcuong.tpl',
      1 => 1692861828,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e7058fe4fee0_33847304 (Smarty_Internal_Template $_smarty_tpl) {
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
/sources/Kho-A9-Xuat-Kho.php?act=editsmKimcuong&cid=<?php echo $_REQUEST['cid'];?>
" method="post" enctype="multipart/form-data">
     	<div class="box-thongin" >
            <div class="MainTable">
               	<div class="table2scroll">
                    <table width="100%" border="1" id="addRowGirlVang">
                        <tr class="trheader">
                            <td align="center">
                                <strong>Nhóm Nguyên Liệu</strong>
                            </td>
                            <td align="center">
                                <strong>Tên Nguyên Liệu</strong>
                            </td>
                             <td align="center">
                                <strong>Tên Kim Cương</strong>
                            </td>
                            <td  align="center">
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
                             <td align="center">
                                <strong>Ghi Chú Chỉnh Sửa</strong>
                            </td>  
                        </tr>
                        <tr>
                             <td align="left">
                                <input type="hidden" name="nhomnguyenlieukimcuong" id="nhomnguyenlieukimcuong1" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['nhomnguyenlieukimcuong'];?>
" />
                                
                                   <span id="showtennhomnguyenlieukimcuong1">
                                        <?php if ($_smarty_tpl->tpl_vars['edit']->value['nhomnguyenlieukimcuong'] > 0) {?>
                                            <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['edit']->value['nhomnguyenlieukimcuong']),$_smarty_tpl);?>
                                        <?php } else { ?>
                                            Click chọn
                                        <?php }?>
                                   </span>

                                
                             </td>
                             
                             <td align="left">
                                 <input type="hidden" name="tennguyenlieukimcuong" id="tennguyenlieukimcuong1" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['tennguyenlieukimcuong'];?>
" />
                                  <span id="showtennguyenlieukimcuong1">
                                        <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['edit']->value['tennguyenlieukimcuong']),$_smarty_tpl);?>
                                  </span>
                             </td>
                             <td align="left">
                                <input type="hidden" name="idkimcuong" id="idkimcuong1" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['idkimcuong'];?>
" />
                                
                                   <span id="showtennkimcuong1">
                                        <?php if ($_smarty_tpl->tpl_vars['edit']->value['idkimcuong'] > 0) {?>
                                            <!--insert name='getName' table='loaikimcuonghotchu' names='size' id=$edit.idkimcuong}-->::<!--insert name='getName' table='loaikimcuonghotchu' names='name_vn' id=$edit.idkimcuong}-->
                                        <?php } else { ?>
                                            Click chọn tên
                                        <?php }?>
                                   </span>
                                
                             </td>
                              <td align="left">
                                 <input  type="text" autocomplete="off" name="codegdpnj" id="codegdpnj1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['codegdpnj'];?>
" disabled="disabled"/>
                             </td>
                              <td align="left">
                                 <input type="text" autocomplete="off" name="codecgta" id="codecgta1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['codecgta'];?>
" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="kichthuoc" id="kichthuoc1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['kichthuoc'];?>
" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="trongluonghot" id="trongluonghot1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['trongluonghot'];?>
" disabled="disabled"/>
                             </td>
                              <td align="left">
                                 <input type="text" autocomplete="off" name="dotinhkhiet" id="dotinhkhiet1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['dotinhkhiet'];?>
" disabled="disabled"/>
                             </td>
                              <td align="left">
                                 <input type="text" autocomplete="off" name="capdomau" id="capdomau1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['capdomau'];?>
" disabled="disabled"/>
                             </td>
                              <td align="left">
                                 <input type="text" autocomplete="off" name="domaibong" id="domaibong1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['domaibong'];?>
" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="kichthuocban" id="kichthuocban1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['kichthuocban'];?>
" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" autocomplete="off" name="tienmatkimcuong" id="tienmatkimcuong1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['tienmatkimcuong'];?>
" disabled="disabled"/>
                             </td>
                             <td align="left">
                                 <input type="text" readonly="readonly" autocomplete="off" name="dongiaban" id="dongiaban1" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['dongiaban'];?>
" disabled="disabled"/>
                             </td>
                              <td align="left">
                                 <input type="text" autocomplete="off" name="ghichueditkimcuong" id="ghichueditkimcuong1" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['ghichukimcuong'];?>
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
