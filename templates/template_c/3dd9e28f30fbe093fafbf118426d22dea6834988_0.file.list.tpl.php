<?php
/* Smarty version 4.1.1, created on 2023-08-24 10:31:43
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e6cf1facd064_17673832',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '3dd9e28f30fbe093fafbf118426d22dea6834988' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho\\list.tpl',
      1 => 1692847898,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tungay-denngay-vang-kim-cuong.tpl' => 1,
    'file:./allsearch/daychungtus.tpl' => 1,
    'file:./allsearch/codes.tpl' => 1,
    'file:./allsearch/loaivangs.tpl' => 1,
    'file:./allsearch/cannangvhs.tpl' => 1,
    'file:./allsearch/cannanghs.tpl' => 1,
    'file:./allsearch/cannangvs.tpl' => 1,
  ),
),false)) {
function content_64e6cf1facd064_17673832 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="goAction">
	<ul>
    	<li>
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho.php?act=add&cid=<?php echo $_REQUEST['cid'];?>
');">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/add.png">
                </a> 
            
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho.php?act=dellist&cid=<?php echo $_REQUEST['cid'];?>
');">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/delete.png">
               	</a> 
        </li>
    </ul>
</div>
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit="return searchKhoDauVaoXuatVang('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/KhoSanXuat-Kho-Vmnt-Xuat-Kho.php?cid=<?php echo $_REQUEST['cid'];?>
')"> 
     	<div class="MainSearch">
        	<?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tungay-denngay-vang-kim-cuong.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                	<td class="tdcheck"></td>
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td width="7%">
                        <strong>Ngày nhập</strong>
                    </td>
                    
                    <td width="7%">
                        <strong>Mã phiếu</strong>
                    </td>
					
                    <td>
                        <strong>Loại Vàng</strong>
                    </td>
                    
                    <td>
                        <strong>Cân Nặng V+H</strong>
                    </td>
                   
                    <td>
                        <strong>Cân Nặng H</strong>
                    </td>
                    <td>
                        <strong>Cân Nặng V</strong>
                    </td>
                    <td width="4%" align="center">
                        <strong>Tuổi vàng</strong>
                    </td>
                    <td>
                        <strong>Phòng SX</strong>
                    </td>
                    <td>
                        <strong>Mã ĐH</strong>
                    </td>
                    
                     <td width="10%">
                        <strong>Ghi chú</strong>
                    </td>
                    <td class="tdShowHide">
                        <strong>Duyệt chuyển</strong>
                    </td>
                    <td>
                        <strong>Sửa/print</strong>
                    </td>
                </tr>
                <tr>
                	<td align="center"></td>
                    <td align="center"></td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/daychungtus.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/codes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/loaivangs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/cannangvhs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/cannanghs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/cannangvs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center"></td>
                     <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
                
                <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['phieuXuat']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?> 
                    <tr id="g<?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
">
                    	<td>
                           <input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" name="iddel[]" id="check<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>
">
                        </td>
                        <td>
                            <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1+$_smarty_tpl->tpl_vars['number']->value;?>

                       </td>
                       <td>
                            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dated'],"%d/%m/%Y");?>

                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieu'];?>

                       </td>
                       
                       <td>
                       		<?php echo insert_getName(array('table' => 'loaivang', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang']),$_smarty_tpl);?>
                       </td> 
                       <td class="text-right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'],3,".",",");?>

                       </td> 
                       <td class="text-right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3,".",",");?>

                       </td>
                        <td class="text-right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'],3,".",",");?>

                       </td>
                       <td class="text-right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tuoivang'],4,".",",");?>

                       </td>
                       <td> 
                       		<?php if ($_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['chonphongbanin'] > 0) {?> 
                       			<?php echo insert_getNamKhoSanXuat(array('id' => $_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['chonphongbanin']),$_smarty_tpl);?> 
                            <?php }?>     
                       </td> 
                        <td>
                        	<?php if ($_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['madhin'] > 0) {?>  
                       			<?php echo insert_getNamMaDonHangCatalog(array('madhin' => $_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['madhin']),$_smarty_tpl);?> 
                            <?php }?> 
                       </td> 
					   <td>
                            <?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichuvang'];?>

                       </td>
                       
                       <td align="center">
                            <select class="selectOption" id="chuyenkho<?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" onchange="chuyenKhoSanXuat('chuyenkhosanxuat', this.value, '<?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
','<?php echo $_smarty_tpl->tpl_vars['phongbanchuyen']->value;?>
','khosanxuat_vmnt')">
                                <option value="">--chuyển đến--</option>
                                <?php echo insert_optionChuyenDen(array('id' => $_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['chonphongbanin']),$_smarty_tpl);?>
                            </select>  
                       </td>
                        
                      <td align="center">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/KhoSanXuat-Huy-Kho-Vmnt-Xuat-Kho.php?act=edit&cid=<?php echo $_REQUEST['cid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['phieuXuat']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" title="Sửa"> 
                                <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/edit.png"/> 
                            </a> 
                       </td>
                    </tr> 
                 <?php
}
}
?> 
                                                
			</table>
    	</div>   
    </form> 
    <div class="Paging">
        <div class="pgLeft">Tổng số <?php echo $_smarty_tpl->tpl_vars['total']->value;?>
 trang</div>
        <div class="pgRight">
            <?php echo $_smarty_tpl->tpl_vars['link_url']->value;?>
  
        </div>
    </div>   
</div>
<link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.js"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/autoNumeric.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/tim-kiem.js"><?php echo '</script'; ?>
><?php }
}
