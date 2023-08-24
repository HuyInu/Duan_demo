<?php
/* Smarty version 4.1.1, created on 2023-08-24 09:27:51
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Kho-Vmnt-Thong-Ke\nhap-hao-du.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e6c0271e9b75_58344423',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'e5d4ff3062e1fcfec30627341c10f183a9062690' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Kho-Vmnt-Thong-Ke\\nhap-hao-du.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tungay-denngay-vang-kim-cuong.tpl' => 1,
    'file:./allsearch/print-kho-san-xuat.tpl' => 1,
    'file:./allsearch/codes.tpl' => 1,
  ),
),false)) {
function content_64e6c0271e9b75_58344423 (Smarty_Internal_Template $_smarty_tpl) {
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
	<form name="f" id="f" method="post" onsubmit="return KhoNguonVaoThongKeNhapXuatVang('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/KhoSanXuat-Kho-Vmnt-Thong-Ke.php?act=<?php echo $_REQUEST['act'];?>
&cid=<?php echo $_REQUEST['cid'];?>
')"> 
     	<div class="MainSearch">
        	<?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tungay-denngay-vang-kim-cuong.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/print-kho-san-xuat.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <input type="hidden" id="getUrlPrintKhoNguonVao" value="act=haodu&table=khosanxuat_khovmnthaodu&cid=<?php echo $_smarty_tpl->tpl_vars['phongbanchuyen']->value;?>
"  />
        </div>
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
                        <strong>Loại Vàng</strong>
                    </td>
                    
                    <td>
                        <strong>Hao Kết Dẻ</strong>
                    </td>
                   
                    <td>
                        <strong>Du Kết Dẻ</strong>
                    </td>
                    
                    <td>
                        <strong>Hao Chênh Lệch</strong>
                    </td>
                   
                    <td>
                        <strong>Du Chênh Lệch</strong>
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
                       		<?php echo insert_getName(array('table' => 'loaivang', 'names' => 'name_vn', 'id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang']),$_smarty_tpl);?>
                       </td> 
                       <td class="text-right">
                       		<?php $_smarty_tpl->_assignInScope('thao', $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['hao']);?>
                            <?php echo number_format($_smarty_tpl->tpl_vars['thao']->value,3,".",",");?>

                       </td> 
                        <td class="text-right">
                        	<?php $_smarty_tpl->_assignInScope('tdu', $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['du']);?>
                            <?php echo number_format($_smarty_tpl->tpl_vars['tdu']->value,3,".",",");?>

                       </td>
                       
                       <td class="text-right">
                       		<?php $_smarty_tpl->_assignInScope('thaochenhlech', $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['haochenhlech']);?>
                            <?php echo number_format($_smarty_tpl->tpl_vars['thaochenhlech']->value,3,".",",");?>

                       </td> 
                        <td class="text-right">
                        	<?php $_smarty_tpl->_assignInScope('tduchenhlech', $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['duchenhlech']);?>
                            <?php echo number_format($_smarty_tpl->tpl_vars['tduchenhlech']->value,3,".",",");?>

                       </td>
                       <td>
                            <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichu'];?>

                       </td>
                       <?php $_smarty_tpl->_assignInScope('tongHao', $_smarty_tpl->tpl_vars['tongHao']->value+$_smarty_tpl->tpl_vars['thao']->value);?>
                       <?php $_smarty_tpl->_assignInScope('tongDu', $_smarty_tpl->tpl_vars['tongDu']->value+$_smarty_tpl->tpl_vars['tdu']->value);?> 
                       
                       <?php $_smarty_tpl->_assignInScope('tongHaochenhlech', $_smarty_tpl->tpl_vars['tongHaochenhlech']->value+$_smarty_tpl->tpl_vars['thaochenhlech']->value);?>
                       <?php $_smarty_tpl->_assignInScope('tongDuchenhlech', $_smarty_tpl->tpl_vars['tongDuchenhlech']->value+$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tduchenhlech']);?> 
                    </tr>  
                 <?php
}
}
?> 
                 <tr class="Paging fontSizeTon">
                    <td align="right" colspan="4"> <strong class="colorXanh">Tổng/trang:</strong> </td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongHao']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongDu']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongHaochenhlech']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo number_format($_smarty_tpl->tpl_vars['tongDuchenhlech']->value,3,".",",");?>
 </span></td>
                    <td align="right"><span class="colorXanh"></span></td>
                </tr>  
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="4"> <strong class="colorXanh">Tổng tất cả:</strong> </td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotal']->value['hao'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotal']->value['du'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotal']->value['haochenhlech'];?>
 </span></td>
                    <td align="right"><span class="colorXanh"> <?php echo $_smarty_tpl->tpl_vars['gettotal']->value['duchenhlech'];?>
 </span></td>
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
