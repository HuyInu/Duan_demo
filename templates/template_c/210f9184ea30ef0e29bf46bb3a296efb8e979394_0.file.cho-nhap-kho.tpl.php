<?php
/* Smarty version 4.1.1, created on 2023-08-24 09:27:52
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Kho-Vmnt-Thong-Ke\cho-nhap-kho.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e6c02819a926_38086790',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '210f9184ea30ef0e29bf46bb3a296efb8e979394' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Kho-Vmnt-Thong-Ke\\cho-nhap-kho.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tungay-denngay-vang-kim-cuong.tpl' => 1,
    'file:./allsearch/codes.tpl' => 1,
    'file:./allsearch/cannangvhs.tpl' => 1,
    'file:./allsearch/cannanghs.tpl' => 1,
    'file:./allsearch/cannangvs.tpl' => 1,
    'file:./allsearch/ghichus.tpl' => 1,
  ),
),false)) {
function content_64e6c02819a926_38086790 (Smarty_Internal_Template $_smarty_tpl) {
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
/sources/KhoSanXuat-Kho-Vmnt-Thong-Ke.php?act=<?php echo $_REQUEST['act'];?>
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
                        <strong>Ngày chuyển</strong>
                    </td>

                    <td>
                        <strong>Mã Phiếu</strong>
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
                    
                    <td width="15%">
                        <strong>Phòng chuyển</strong>
                    </td>
                    <td>
                        <strong>Mã ĐH</strong>
                    </td>
                    <td>
                        <strong>Ghi Chú</strong>
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
                        <?php echo insert_loadloaivang(array('idloaivang' => $_smarty_tpl->tpl_vars['loaivangs']->value),$_smarty_tpl);?>
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
                    <td align="center">
                    	<?php $_smarty_tpl->_subTemplateRender("file:./allsearch/ghichus.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                </tr>
                <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['view']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?> 
                    <tr id="g<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
">
                        <td>
                            <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1+$_smarty_tpl->tpl_vars['number']->value;?>

                       </td>
                       <td>
                             <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datechuyen'],"%d/%m/%Y");?>
 
                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieu'];?>

                       </td>
                       <td>
                       		<?php echo insert_getName(array('table' => 'loaivang', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang']),$_smarty_tpl);?>
                       </td> 
                       <td class="text-right">
                       		<?php $_smarty_tpl->_assignInScope('tcannangvh', $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh']);?>
                            <?php echo number_format($_smarty_tpl->tpl_vars['tcannangvh']->value,3,".",",");?>

                       </td> 
                       <td class="text-right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3,".",",");?>

                       </td>
                        <td class="text-right">
                        	<?php $_smarty_tpl->_assignInScope('tcannangv', $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv']);?>
                            <?php echo number_format($_smarty_tpl->tpl_vars['tcannangv']->value,3,".",",");?>

                       </td>
                       <td>
                            <?php echo insert_getNamKhoSanXuat(array('id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['phongban']),$_smarty_tpl);?>     
                       </td>
                       <td>
                       		<?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['madhin'] > 0) {?>
                            	<?php echo insert_getNamMaDonHangCatalog(array('madhin' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['madhin']),$_smarty_tpl);?> 
                            <?php }?>
                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichuvang'];?>

                       </td>
                       
                       <?php $_smarty_tpl->_assignInScope('tongCannangvh', $_smarty_tpl->tpl_vars['tongCannangvh']->value+$_smarty_tpl->tpl_vars['tcannangvh']->value);?>
                       <?php $_smarty_tpl->_assignInScope('tongCannangh', $_smarty_tpl->tpl_vars['tongCannangh']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh']);?>
                       <?php $_smarty_tpl->_assignInScope('tongCannangv', $_smarty_tpl->tpl_vars['tongCannangv']->value+$_smarty_tpl->tpl_vars['tcannangv']->value);?> 
                    </tr>  
                 <?php
}
}
?> 
                 <tr class="Paging fontSizeTon">
                    <td align="right" colspan="4"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangvh']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangh']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongCannangv']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                </tr>  
                <?php
$__section_j_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['totalLoaivang']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_j_1_total = $__section_j_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_j'] = new Smarty_Variable(array());
if ($__section_j_1_total !== 0) {
for ($__section_j_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] = 0; $__section_j_1_iteration <= $__section_j_1_total; $__section_j_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']++){
?> 
                    <tr class="Paging fontSizeTon">
                        <td align="right" colspan="4"><?php echo insert_getName(array('table' => 'loaivang', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['totalLoaivang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] : null)]['idloaivang']),$_smarty_tpl);?></td>
                        <td align="right"><?php echo $_smarty_tpl->tpl_vars['totalLoaivang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] : null)]['cannangvh'];?>
</td>
                        <td align="right"><?php echo $_smarty_tpl->tpl_vars['totalLoaivang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] : null)]['cannangh'];?>
</td>
                        <td align="right"><?php echo $_smarty_tpl->tpl_vars['totalLoaivang']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] : null)]['cannangv'];?>
</td>
                        <td align="right"></td>
                        <td align="right"></td>
                         <td align="right"></td>
                    </tr> 
                <?php
}
}
?> 
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="4"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotal']->value['cannangvh'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotal']->value['cannangh'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotal']->value['cannangv'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                    <td align="right"><span class="colorXanh"></span></td>
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
