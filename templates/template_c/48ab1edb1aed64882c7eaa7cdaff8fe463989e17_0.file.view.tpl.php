<?php
/* Smarty version 4.1.1, created on 2023-08-10 08:33:57
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-A9-Nhap-Kho\view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d43e85089e78_90100352',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '48ab1edb1aed64882c7eaa7cdaff8fe463989e17' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-A9-Nhap-Kho\\view.tpl',
      1 => 1578385538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tabVangKimcuong.tpl' => 1,
  ),
),false)) {
function content_64d43e85089e78_90100352 (Smarty_Internal_Template $_smarty_tpl) {
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
                            <input  readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['nguoilapphieu'];?>
" class="InputText" type="text"/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                            Đơn Vị
                        </div>
                        
                        <div class="SubRight">
                            <input readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['donvilapphieu'];?>
" class="InputText" type="text" />
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Người Duyệt Phiếu
                        </div>
                        
                        <div class="SubRight">
                            <input readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['nguoiduyetphieu'];?>
" class="InputText" type="text"/>
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Đơn Vị
                        </div>
                        
                        <div class="SubRight">
                            <input readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['donviduyetphieu'];?>
" class="InputText" type="text"/>
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Lý nộp
                        </div>
                        
                        <div class="SubRight">
                            <input readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['lydo'];?>
" class="InputText" type="text" autocomplete="off" />
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
                            <input readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['maphieu'];?>
" class="InputText" type="text"  />
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Ngày nhập
                        </div>
                        
                        <div class="SubRight">
                            <input type="text" class="InputText" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['edit']->value['datedchungtu'],'%d/%m/%Y');?>
"  readonly="readonly" />
                        </div>
                    </div>
                    
                    <div class="SubAll">
                        <div class="SubLeft">
                           Ngày hạch toán
                        </div>
                        
                        <div class="SubRight">
                            <input type="text" class="InputText" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['edit']->value['datedhachtoan'],'%d/%m/%Y');?>
" readonly="readonly" />
                        </div>
                    </div>
                    <div class="SubAll">
                        <div class="SubLeft">
                           Upload File Excel
                        </div>
                        <div class="SubRight">
                        	
                            <?php if ($_smarty_tpl->tpl_vars['edit']->value['fileexcel'] != '') {?>
                            	<a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['edit']->value['fileexcel'];?>
" title="Tải file"> 
                                	<img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/down-load.png">
                                </a>
                            <?php }?>                           
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                </div>
            </div>
        </div>
     	<div class="box-thongin">
        	<div class="title-thongtin">Nội dung</div>
            <div class="MainTable">
            	<?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tabVangKimcuong.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
                         <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['viewtcctvang']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                            <tr>
                                 <td align="left">
                                    <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1+$_smarty_tpl->tpl_vars['number']->value;?>

                                 </td>
                                        
                                 <td align="left"> 
                                    <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieuvang']),$_smarty_tpl);?>
                                 </td>
                                 <td align="left">
                                     <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieuvang']),$_smarty_tpl);?>
                                 </td>
                               
                                 <td align="left">
                                     <?php echo insert_loadloaivang(array('idloaivang' => $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang']),$_smarty_tpl);?>
                                 </td>
                                 
                                 <td align="left">
                                     <input type="text" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'];?>
" eadonly="readonly"/>
                                 </td>
                                  <td align="left">
                                     <input type="text" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'];?>
" eadonly="readonly"/>
                                 </td>
                                 <td align="left">
                                     <input type="text" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'];?>
" eadonly="readonly"/>
                                 </td>
                                 <td align="left">
                                     <input type="text" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tuoivang'];?>
" eadonly="readonly"/>
                                 </td>
                                 <td align="left">
                                     <?php echo $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienmatvang'];?>

                                 </td>
                                 <td align="left">
                                    <?php echo $_smarty_tpl->tpl_vars['viewtcctvang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichuvang'];?>

                                 </td>       
                            </tr>
                        <?php
}
}
?> 
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
                         <?php
$__section_i_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['viewtcctkimcuong']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_1_total = $__section_i_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_1_total !== 0) {
for ($__section_i_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_1_iteration <= $__section_i_1_total; $__section_i_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                            <tr>
                                 <td align="left">
                                    <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1+$_smarty_tpl->tpl_vars['number']->value;?>

                                 </td>
                          
                                 <td align="left" class="kimcuong">
                                     <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieukimcuong']),$_smarty_tpl);?>
                                 </td>
                                 
                                 <td align="left" class="kimcuong">
                                       <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieukimcuong']),$_smarty_tpl);?>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <?php echo insert_getName(array('table' => 'loaikimcuonghotchu', 'names' => 'size', 'id' => $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idkimcuong']),$_smarty_tpl);?>::<?php echo insert_getName(array('table' => 'loaikimcuonghotchu', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idkimcuong']),$_smarty_tpl);?>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['codegdpnj'];?>
" eadonly="readonly"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['codecgta'];?>
" eadonly="readonly"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text"class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['kichthuoc'];?>
" eadonly="readonly"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['trongluonghot'];?>
" eadonly="readonly"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dotinhkhiet'];?>
" eadonly="readonly"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['capdomau'];?>
" eadonly="readonly"/>
                                 </td>
                                  <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['domaibong'];?>
" eadonly="readonly"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" class="txtdatagirld" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['kichthuocban'];?>
" eadonly="readonly"/>
                                 </td>
                                 <td align="left" class="kimcuong">
                                     <?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienmatkimcuong'];?>

                                 </td>
                                 <td align="left" class="kimcuong">
                                     <input type="text" readonly="readonly" class="txtdatagirld text-right autoNumeric" value="<?php echo $_smarty_tpl->tpl_vars['viewtcctkimcuong']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dongiaban'];?>
"/>
                                 </td>
                            </tr>
                        <?php
}
}
?> 
                        
                    </table>

               
            </div>
            
            <div class="clear"></div>
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
><?php }
}
