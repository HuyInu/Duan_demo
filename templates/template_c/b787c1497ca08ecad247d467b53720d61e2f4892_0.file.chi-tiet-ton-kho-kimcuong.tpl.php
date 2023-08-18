<?php
/* Smarty version 4.1.1, created on 2023-08-18 13:16:25
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-A9-Thong-Ke\chi-tiet-ton-kho-kimcuong.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64df0cb9d913e4_57359162',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'b787c1497ca08ecad247d467b53720d61e2f4892' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-A9-Thong-Ke\\chi-tiet-ton-kho-kimcuong.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/codes.tpl' => 1,
    'file:./allsearch/chonnhomnguyenlieus.tpl' => 1,
    'file:./allsearch/chontennguyenlieus.tpl' => 1,
    'file:./allsearch/chontenkimcuongs.tpl' => 1,
  ),
),false)) {
function content_64df0cb9d913e4_57359162 (Smarty_Internal_Template $_smarty_tpl) {
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
	<form name="f" id="f" method="post" onsubmit="return KhoNguonVaoThongKeNhapXuatKimCuong('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Thong-Ke.php?act=<?php echo $_REQUEST['act'];?>
&cid=<?php echo $_REQUEST['cid'];?>
')"> 
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    <td>
                        <strong>Ngày nhập</strong>
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
                    
                    <td width="12%">
                        <strong>Tên Kim Cương</strong>
                    </td>
                    
                    <td>
                        <strong>Kích Thước</strong>
                    </td>
                    <td>
                        <strong>Trọng Lượng Hột</strong>
                    </td>
                    <td>
                        <strong>Độ Tinh Khiết</strong>
                    </td>
                    
                     <td>
                        <strong>Cấp Độ Màu</strong>
                    </td>
                    <td>
                        <strong>Độ Mài Bóng</strong>
                    </td>
                    <td>
                        <strong>Kích Thước Bán</strong>
                    </td>
                     <td width="5%">
                        <strong>Số lượng</strong>
                    </td>
                    <td width="8%">
                        <strong>Đơn Giá</strong>
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
                    	<?php $_smarty_tpl->_subTemplateRender("file:./allsearch/chontenkimcuongs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
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
                </tr>
                <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['view']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?> 
                	<?php $_smarty_tpl->_assignInScope('tongdongia', 1);?>
                    <tr id="g<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
">
                        <td>
                            <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1+$_smarty_tpl->tpl_vars['number']->value;?>

                       </td>
                       <td>
                            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dated'],"%d/%m/%Y");?>

                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieu'];?>

                       </td>
                       <td>
                            <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieukimcuong']),$_smarty_tpl);?>
                       </td> 
                       <td>
                           <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieukimcuong']),$_smarty_tpl);?>
                       </td> 
                      
                       <td>
                            <?php echo insert_getName(array('table' => 'loaikimcuonghotchu', 'names' => 'size', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idkimcuong']),$_smarty_tpl);?>::<?php echo insert_getName(array('table' => 'loaikimcuonghotchu', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idkimcuong']),$_smarty_tpl);?>
                       </td> 
                       
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['kichthuoc'];?>

                       </td> 
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['trongluonghot'];?>

                       </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dotinhkhiet'];?>

                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['capdomau'];?>

                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['domaibong'];?>

                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['kichthuocban'];?>

                       </td> 
                        <td class="text-right">
                            1
                       </td> 
                       <td class="text-right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dongiaban'],3,".",",");?>

                       </td> 
                       
                       <?php $_smarty_tpl->_assignInScope('tongsoluong', $_smarty_tpl->tpl_vars['tongsoluong']->value+1);?>
                       <?php $_smarty_tpl->_assignInScope('tongdongiatong', $_smarty_tpl->tpl_vars['tongdongiatong']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dongiaban']);?> 
                    </tr> 
                 <?php
}
}
?> 
                 <tr class="Paging fontSizeTon">
                    <td align="right" colspan="12"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongsoluong']->value,0,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongdongiatong']->value,3,".",",");?>
 </span></td>
                </tr>    
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="12"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotal']->value['tongsoluong'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotal']->value['tongdongia'];?>
 </span></td>
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
>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/select-checkbox/sol.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/select-checkbox/sol.css" />
<?php echo '<script'; ?>
>
	$('#tenkimcuongs').searchableOptionList({ maxHeight: 'auto', showSelectAll: true });
<?php echo '</script'; ?>
><?php }
}
