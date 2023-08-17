<?php
/* Smarty version 4.1.1, created on 2023-08-17 16:16:30
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-A9-Huy-Nhap-Kho\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64dde56e0058c1_59873376',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd8da4aecd1d6cd5f039713201f51a988c2eff8b2' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-A9-Huy-Nhap-Kho\\list.tpl',
      1 => 1692263385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tabVangKimcuong.tpl' => 1,
    'file:./allsearch/tungay-denngay.tpl' => 1,
    'file:./allsearch/daychungtus.tpl' => 1,
    'file:./allsearch/codes.tpl' => 1,
    'file:./allsearch/namelaps.tpl' => 1,
    'file:./allsearch/donvilaps.tpl' => 1,
    'file:./allsearch/nameduyets.tpl' => 1,
    'file:./allsearch/donviduyets.tpl' => 1,
    'file:./allsearch/lydos.tpl' => 1,
  ),
),false)) {
function content_64dde56e0058c1_59873376 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\wamp64\\www\\duan_demo\\libraries\\smarty4\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<div class="goAction">
	<ul>
    	<li>
            <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Huy-Nhap-Kho.php?act=add&cid=<?php echo $_REQUEST['cid'];?>
');">
                <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/add.png">
            </a> 
            <a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Huy-Nhap-Kho.php?act=dellist&cid=<?php echo $_REQUEST['cid'];?>
');">
                <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/delete.png">
            </a> 
        </li>
    </ul>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tabVangKimcuong.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit=""> 
     	<div class="MainSearch">
        	<?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tungay-denngay.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>
        <div class="MainTable">
    		<table class="table-bordered">
                <tr class="trheader">
                    <td class="tdcheck"></td>
                    <td class="tdSTT">
                        <strong>STT</strong>
                    </td>
                    
                    <td width="8%">
                        <strong>Ngày chứng từ</strong>
                    </td>
                    
                    <td width="10%">
                        <strong>Số chứng từ</strong>
                    </td>
                    
                    <td>
                        <strong>Người Lập</strong>
                    </td>
                    
                    <td>
                        <strong>ĐV Lập</strong>
                    </td>
                    
                    <td>
                        <strong>Người Duyệt</strong>
                    </td>
                    
                    <td>
                        <strong>ĐV Duyệt</strong>
                    </td>
                   
                    <td>
                        <strong>Lý do</strong>
                    </td>
                    <td>
                        <strong>Duyệt Chuyển</strong>
                    </td>
                    <td class="tdShowHide">
                        <strong>SỬA</strong>
                    </td> 
                     <td class="tdEdit">
                        <strong>File</strong>
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
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/namelaps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/donvilaps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/nameduyets.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/donviduyets.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/lydos.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
 				<?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['phieuNhap']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                <tr class="">
                    <td class="tdcheck"></td>
                    <td class="tdSTT" align="center">
                        <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>

                    </td>
                    
                    <td width="8%">
                        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['datedchungtu'],"%d/%m/%Y");?>

                    </td>
                    
                    <td width="10%">
                        <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieu'];?>

                    </td>
                    
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nguoilapphieu'];?>

                    </td>
                    
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['donvilapphieu'];?>

                    </td>
                    
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nguoiduyetphieu'];?>

                    </td>
                    
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['donviduyetphieu'];?>

                    </td>
                   
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['lydo'];?>

                    </td>
                    <td>
                        <strong>Duyệt Chuyển</strong>
                    </td>
                    <td class="tdShowHide">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Huy-Nhap-Kho.php?act=edit&cid=<?php echo $_REQUEST['cid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" title="Sửa"> 
                            <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/edit.png"/> 
                        </a>
                        <a href="javascript:void(0)" onclick="popupwindow('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/print/khonguonvao.php?act=nhapkho&table=khonguonvao_khoachin&id=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
&type=1','mywindow')" title="Print">
                            <img class="margin-left10" width="25px" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/printer.png" align="top"> 
                        </a>
                    </td> 
                    <td class="tdEdit">
                        <strong>File</strong>
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
