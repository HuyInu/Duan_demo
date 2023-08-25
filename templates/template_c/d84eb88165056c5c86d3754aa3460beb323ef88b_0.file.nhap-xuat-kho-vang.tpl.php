<?php
/* Smarty version 4.1.1, created on 2023-08-25 09:04:48
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-A9-Huy-Thong-Ke\nhap-xuat-kho-vang.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e80c4056d2d1_92428139',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'd84eb88165056c5c86d3754aa3460beb323ef88b' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-A9-Huy-Thong-Ke\\nhap-xuat-kho-vang.tpl',
      1 => 1692929087,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tungay-denngay-vang-kim-cuong.tpl' => 1,
    'file:./allsearch/codes.tpl' => 1,
    'file:./allsearch/chonnhomnguyenlieus.tpl' => 1,
    'file:./allsearch/chontennguyenlieus.tpl' => 1,
    'file:./allsearch/tuoivangs.tpl' => 1,
  ),
),false)) {
function content_64e80c4056d2d1_92428139 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="ChonLoaiPhieu">
    <ul>
        <li class="active" id="clickVang" onclick="clickVang('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Thong-Ke.php?act=<?php echo $_REQUEST['act'];?>
&cid=<?php echo $_REQUEST['cid'];?>
')">
            <a>Vàng</a>
        </li>
        <li id="clickKimCuong" onclick="clickKimCuong('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Thong-Ke.php?act=<?php echo $_REQUEST['act'];?>
&cid=<?php echo $_REQUEST['cid'];?>
')">
            <a>Kim Cương</a>
        </li>
    </ul>
</div>
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit="return KhoNguonVaoThongKeNhapXuatVang('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Huy-Thong-Ke.php?act=<?php echo $_REQUEST['act'];?>
&cid=<?php echo $_REQUEST['cid'];?>
')"> 
     	<div class="MainSearch">
        	<?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tungay-denngay-vang-kim-cuong.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    <td>
                        <strong>Ngày Nhập Xuất</strong>
                    </td>

                    <td>
                        <strong>Mã Phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Nhóm N Liệu</strong>
                    </td>
                    
                    <td>
                        <strong>Tên N Liệu</strong>
                    </td>
                    
                    <td>
                        <strong>Loại Vàng</strong>
                    </td>
                    <td>
                        <strong>Tuổi vàng</strong>
                    </td>
                    
                    <td>
                        <strong>Cân Nặng V+H Nhập</strong>
                    </td>
                   
                    <td>
                        <strong>Cân Nặng H Nhập</strong>
                    </td>
                    <td>
                        <strong>Cân Nặng V Nhập</strong>
                    </td>
                    
                    <td>
                        <strong>Cân Nặng V+H Xuất</strong>
                    </td>
                   
                    <td>
                        <strong>Cân Nặng H Xuất</strong>
                    </td>
                    <td>
                        <strong>Cân Nặng V Xuất</strong>
                    </td>
                    
                    
                    
                    <td width="4%">
                        <strong>Hao</strong>
                    </td>
                    <td width="4%">
                        <strong>Dư</strong>
                    </td>
                    <td>
                        <strong>Tiền mặt</strong>
                    </td>
                     
                </tr>
                <tr>
                    <td align="center"></td>
                    <td align="center"></td>
                    
                     <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/codes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/chonnhomnguyenlieus.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/chontennguyenlieus.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php echo insert_loadloaivang(array('idloaivang' => $_smarty_tpl->tpl_vars['loaivangs']->value),$_smarty_tpl);?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tuoivangs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                   <td align="center"></td>
                    <td align="center"></td>
                    
                </tr>
                <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['view']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                	<?php $_smarty_tpl->_assignInScope('checkKhoanTuNgayDenNgayXK', 0);?>
                	<?php $_smarty_tpl->assign("checkKhoanTuNgayDenNgayNK" , insert_checkKhoanTuNgayDenNgayNhapKho (array('dated' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dated'], 'fromdays' => $_smarty_tpl->tpl_vars['fromdayCheck']->value, 'todays' => $_smarty_tpl->tpl_vars['todaycheck']->value),$_smarty_tpl), true);?>
                    <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['trangthai'] == 2) {?> <!--Xuất Kho-->  
                		<?php $_smarty_tpl->assign("checkKhoanTuNgayDenNgayXK" , insert_checkKhoanTuNgayDenNgayXuatKho (array('datedxuat' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datedxuat'], 'fromdays' => $_smarty_tpl->tpl_vars['fromdayCheck']->value, 'todays' => $_smarty_tpl->tpl_vars['todaycheck']->value),$_smarty_tpl), true);?> 
                    <?php }?>
                    <tr id="g<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
">
                        <td>
                            <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1+$_smarty_tpl->tpl_vars['number']->value;?>

                       </td>
                       <td>
                       		<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dated'],"%d-%m-%Y");?>

                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieu'];?>

                       </td>
                       <td>
                            <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieuvang']),$_smarty_tpl);?>
                       </td> 
                       <td>
                           <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieuvang']),$_smarty_tpl);?>
                       </td> 
                       <td>
                       		<?php echo insert_getName(array('table' => 'loaivang', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang']),$_smarty_tpl);?>
                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tuoivang'];?>

                       </td>
                        
                       <td class="text-right">
                       		<?php if ($_smarty_tpl->tpl_vars['checkKhoanTuNgayDenNgayNK']->value == 1) {?>
                                <?php $_smarty_tpl->_assignInScope('tcannangvhnhap', $_smarty_tpl->tpl_vars['tcannangvhnhap']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh']);?>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'],3,".",",");?>
 
                            <?php }?>     
                       </td> 
                       <td class="text-right">
                       		<?php if ($_smarty_tpl->tpl_vars['checkKhoanTuNgayDenNgayNK']->value == 1) {?>
                            	<?php $_smarty_tpl->_assignInScope('tcannanghnhap', $_smarty_tpl->tpl_vars['tcannanghnhap']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh']);?>
                            	<?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3,".",",");?>

                            <?php }?>
                       </td>
                        <td class="text-right">
                        	<?php if ($_smarty_tpl->tpl_vars['checkKhoanTuNgayDenNgayNK']->value == 1) {?>
                                <?php $_smarty_tpl->_assignInScope('tcannangvnhap', $_smarty_tpl->tpl_vars['tcannangvnhap']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv']);?>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'],3,".",",");?>

                            <?php }?>
                       </td>
                       
                        <td class="text-right">
                            <?php if ($_smarty_tpl->tpl_vars['checkKhoanTuNgayDenNgayXK']->value == 1) {?>
                                <?php $_smarty_tpl->_assignInScope('tcannangvh', $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh']);?>
                                <?php $_smarty_tpl->_assignInScope('tcannangvhxuat', $_smarty_tpl->tpl_vars['tcannangvhxuat']->value+$_smarty_tpl->tpl_vars['tcannangvh']->value);?>
                                <?php echo number_format($_smarty_tpl->tpl_vars['tcannangvh']->value,3,".",",");?>

                            <?php }?>   
                       </td> 
                       <td class="text-right">
                            <?php if ($_smarty_tpl->tpl_vars['checkKhoanTuNgayDenNgayXK']->value == 1) {?>
                                <?php $_smarty_tpl->_assignInScope('tcannanghxuat', $_smarty_tpl->tpl_vars['tcannanghxuat']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh']);?>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3,".",",");?>

                            <?php }?>  
                       </td>
                        <td class="text-right">
                            <?php if ($_smarty_tpl->tpl_vars['checkKhoanTuNgayDenNgayXK']->value == 1) {?>
                                <?php $_smarty_tpl->_assignInScope('tcannangv', $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv']);?>
                                <?php $_smarty_tpl->_assignInScope('tcannangvxuat', $_smarty_tpl->tpl_vars['tcannangvxuat']->value+$_smarty_tpl->tpl_vars['tcannangv']->value);?>
                                <?php echo number_format($_smarty_tpl->tpl_vars['tcannangv']->value,3,".",",");?>
 
                            <?php }?> 
                       </td>
                       
                        <td align="right">
                        	<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['hao'];?>

                       </td>
                       <td align="right">
                       		<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['du'];?>

                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienmatvang'];?>

                       </td>
                       <?php $_smarty_tpl->_assignInScope('tonghao', $_smarty_tpl->tpl_vars['tonghao']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['hao']);?>
                       <?php $_smarty_tpl->_assignInScope('tongdu', $_smarty_tpl->tpl_vars['tongdu']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['du']);?>
                    </tr> 
                 <?php
}
}
?> 
                 <tr class="Paging fontSizeTon">
                    <td align="right" colspan="7"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tcannangvhnhap']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tcannanghnhap']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tcannangvnhap']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tcannangvhxuat']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tcannanghxuat']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tcannangvxuat']->value,3,".",",");?>
 </span></td>
                    <td align="right"> <?php echo number_format($_smarty_tpl->tpl_vars['tonghao']->value,3,".",",");?>
 </td>
                    <td align="right"> <?php echo number_format($_smarty_tpl->tpl_vars['tongdu']->value,3,".",",");?>
 </td>
                    <td align="center"></td>
                </tr>    
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="7"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotalnhap']->value['cannangvh'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotalnhap']->value['cannangh'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotalnhap']->value['cannangv'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotalxuat']->value['cannangvh'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotalxuat']->value['cannangh'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotalxuat']->value['cannangv'];?>
 </span></td>
                    <td align="right"> <?php echo $_smarty_tpl->tpl_vars['gettotalxuat']->value['hao'];?>
 </td>
                    <td align="right"> <?php echo $_smarty_tpl->tpl_vars['gettotalxuat']->value['du'];?>
 </td>
                    <td align="center"></td>
                </tr>                                 
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
