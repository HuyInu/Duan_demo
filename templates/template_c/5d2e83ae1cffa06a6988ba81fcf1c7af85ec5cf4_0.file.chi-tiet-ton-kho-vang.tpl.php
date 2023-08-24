<?php
/* Smarty version 4.1.1, created on 2023-08-24 08:50:29
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-A9-Huy-Thong-Ke\chi-tiet-ton-kho-vang.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e6b765420cd0_96431917',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '5d2e83ae1cffa06a6988ba81fcf1c7af85ec5cf4' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-A9-Huy-Thong-Ke\\chi-tiet-ton-kho-vang.tpl',
      1 => 1692841790,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tungay-denngay-thong-ke-kho-san-xuat.tpl' => 1,
    'file:./allsearch/print-nguon-vao-nodated.tpl' => 1,
    'file:./allsearch/codes.tpl' => 1,
    'file:./allsearch/nhomnguyenlieus.tpl' => 1,
    'file:./allsearch/tennguyenlieus.tpl' => 1,
    'file:./allsearch/tuoivangs.tpl' => 1,
    'file:./allsearch/tienmats.tpl' => 1,
    'file:./allsearch/ghichus.tpl' => 1,
  ),
),false)) {
function content_64e6b765420cd0_96431917 (Smarty_Internal_Template $_smarty_tpl) {
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
	<form name="f" id="f" method="post" onsubmit="return searchKhoKhacKhoTongDeCucThongKe('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Huy-Thong-Ke.php?act=<?php echo $_REQUEST['act'];?>
&cid=<?php echo $_REQUEST['cid'];?>
')"> 
     	<div class="MainSearch">
        	<?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tungay-denngay-thong-ke-kho-san-xuat.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/print-nguon-vao-nodated.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <input type="hidden" id="getUrlPrintKhoNguonVao" value="act=tonkhochitiet&table=khonguonvao_khoachinct&cid=<?php echo $_smarty_tpl->tpl_vars['phongbanchuyen']->value;?>
"  />  
        </div>
        <div class="MainTable">
    		<table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td width="7%">
                        <strong>Ngày nhận</strong>
                    </td>
                    
                    <td width="7%">
                        <strong>Mã phiếu</strong>
                    </td>
                    
                    <td>
                        <strong>Nhóm N Liệu</strong>
                    </td>
                    
                    <td>
                        <strong>Tên N Liệu</strong>
                    </td>
                    
                    <td  width="8%">
                        <strong>Loại Vàng</strong>
                    </td>

                    <td width="8%">
                        <strong>Cân Nặng V+H</strong>
                    </td>
                    <td width="8%">
                        <strong>Cân Nặng H</strong>
                    </td>
                    <td width="8%">
                        <strong>Cân Nặng V</strong>
                    </td>
                    <td>
                        <strong>Tuổi Vàng</strong>
                    </td>
                    <td>
                        <strong>Tiền Mặt</strong>
                    </td>
                    <td width="8%">
                        <strong>TT Vàng Q10</strong>
                    </td>
                     <td>
                        <strong>Ghi chú</strong>
                    </td>
                    
                </tr>
                <tr>
                    <td align="center"></td>
                    <td align="center">
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/codes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/nhomnguyenlieus.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tennguyenlieus.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                     <td align="center"></td>
                     <td align="center"></td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tuoivangs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tienmats.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center"></td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/ghichus.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                </tr>
                <?php $_smarty_tpl->_assignInScope('tongVangHot', 0);?>
                <?php $_smarty_tpl->_assignInScope('tongHot', 0);?>
                <?php $_smarty_tpl->_assignInScope('tongVang', 0);?>
                <?php $_smarty_tpl->_assignInScope('tongQ10', 0);?>
                <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['view']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?> 
                    <?php $_smarty_tpl->assign("SLQ10" , insert_getTongQ10 (array('cannangv' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'], 'idloaivang' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang']),$_smarty_tpl), true);?>
                   		<tr>
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
                                <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nhomnguyenlieuvang']),$_smarty_tpl);?>
                           </td> 
                           <td>
                               <?php echo insert_getName(array('table' => 'categories', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tennguyenlieuvang']),$_smarty_tpl);?>
                           </td> 
                           <td>
                                <?php echo insert_getName(array('table' => 'loaivang', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang']),$_smarty_tpl);?>
                           </td> 
                           
                           <td class="text-right">
                           		<?php $_smarty_tpl->_assignInScope('tongVangHot', $_smarty_tpl->tpl_vars['tongVangHot']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh']);?>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'],3,".",",");?>

                           </td>
                           <td class="text-right">
                           		<?php $_smarty_tpl->_assignInScope('tongHot', $_smarty_tpl->tpl_vars['tongHot']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh']);?>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3,".",",");?>

                           </td>
                           <td class="text-right">
                           		<?php $_smarty_tpl->_assignInScope('tongVang', $_smarty_tpl->tpl_vars['tongVang']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv']);?>
                                <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'],3,".",",");?>

                           </td>
                           <td class="text-right">
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tuoivang'];?>

                           </td>
                           
                           <td >
                                <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tienmatvang'];?>

                           </td>
                       	  <td class="text-right">
                                <?php $_smarty_tpl->_assignInScope('tongQ10', $_smarty_tpl->tpl_vars['tongQ10']->value+$_smarty_tpl->tpl_vars['SLQ10']->value);?>
                                <?php echo number_format($_smarty_tpl->tpl_vars['SLQ10']->value,3,".",",");?>

                           </td>
                       		<td> 
                            	<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichuvang'];?>
 
                       		</td> 
                    </tr> 
                 <?php
}
}
?> 
                 <tr class="Paging fontSizeTon">
                    <td align="right" colspan="6"> <span class="colorXanh">Tổng Kho:</span> </td>
                    <td align="right"><strong class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongVangHot']->value,3,".",",");?>
 </strong></td>
                    <td align="right"><strong class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongHot']->value,3,".",",");?>
 </strong></td>
                    <td align="right"><strong class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongVang']->value,3,".",",");?>
 </strong></td>
                    <td align="right"> </td>
                    <td align="right"> </td>
                    <td align="right"><strong class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongQ10']->value,3,".",",");?>
</strong></td>
                    <td align="right"></td>
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
