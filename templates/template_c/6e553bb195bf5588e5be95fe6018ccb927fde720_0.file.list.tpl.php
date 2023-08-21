<?php
/* Smarty version 4.1.1, created on 2023-08-21 15:59:20
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Huy-Kho-Kv-Nhap-Kho\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e327688221f9_74299178',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e553bb195bf5588e5be95fe6018ccb927fde720' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Huy-Kho-Kv-Nhap-Kho\\list.tpl',
      1 => 1692607106,
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
    'file:./allsearch/tuoivangs.tpl' => 1,
    'file:./allsearch/ghichus.tpl' => 1,
  ),
),false)) {
function content_64e327688221f9_74299178 (Smarty_Internal_Template $_smarty_tpl) {
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
        <?php echo getHearderCat(array('cid'=>$_REQUEST['cid'],'root'=>$_REQUEST['root'],'act'=>$_REQUEST['act']));?>

    </ul>
</div>
<div class="MainContent">
    <form name="f" id="f" method="post" onsubmit="return searchKhoDauVaoXuatVang('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/KhoSanXuat-Kho-Kv-Nhap-Kho.php?cid=<?php echo $_REQUEST['cid'];?>
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
                    
                    <td width="7%">
                        <strong>Ngày nhập</strong>
                    </td>
                    
                    <td width="7%">
                        <strong>Mã phiếu</strong>
                    </td>
					<td width="7%">
                        <strong>Phòng chuyển</strong>
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
                    <td>
                        <strong>Tuổi vàng</strong>
                    </td>
                    <td>
                        <strong>Mã ĐH</strong>
                    </td>
                     <td width="10%">
                        <strong>Ghi chú</strong>
                    </td>
                    <td class="tdShowHide">
                        <strong>Xác Nhận</strong>
                    </td>
                    <td class="tdShowHide">
                        <strong>Trả Lại</strong>
                    </td>
                </tr>
                <tr>
                    <td align="center"></td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/daychungtus.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/codes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center"></td>
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
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tuoivangs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </td>
                    <td align="center"></td>
                    <td align="center">
                        <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/ghichus.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
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
                    <td class="tdSTT">
                        <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>

                    </td>
                    
                    <td width="7%">
                        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dated'],'%d/%m/%Y');?>

                    </td>
                    
                    <td width="7%">
                        <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieu'];?>

                    </td>
					<td width="7%">
                        <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['phongbanchuyen'];?>

                    </td>
                    <td>
                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang'];
$_prefixVariable1 = ob_get_clean();
echo getName('loaivang','name_vn',$_prefixVariable1);?>

                    </td>
                    
                    <td>
                        <?php echo number_format($_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'],3,".",",");?>

                    </td>
                   
                    <td>
                        <?php echo number_format($_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3,".",",");?>

                    </td>
                    <td>
                        <?php echo number_format($_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'],3,".",",");?>

                    </td>
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['phongbanchuyen'];?>

                    </td>
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['madonhangsx'];?>

                    </td>
                     <td width="10%">
                         <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichuvang'];?>

                    </td>
                    <td class="tdShowHide">
                        <?php if ($_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['typechuyen'] == 1) {?>
                            <?php if ($_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['type'] == 1) {?>
                                <a href="javascript:void(0)" onclick="giahuy_xacnhanchuyenKhoSanXuat('xacnhanchuyenKhoSanXuat', <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cid'];?>
, <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
, '<?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['typekho'];?>
')" title="Xác Nhận"> 
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/xac-nhan.png"/> 
                                </a>
                            <?php }?>
                        <?php }?>
                    </td>
                    <td class="tdShowHide">
                        <?php if ($_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['typechuyen'] == 1) {?>
                            <?php if ($_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['type'] == 1) {?>
                                <a href="javascript:void(0);" onclick="giahuy_xacnhanchuyenKhoSanXuat('tralaichuyenKhoSanXuat', <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cid'];?>
, <?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
, '<?php echo $_smarty_tpl->tpl_vars['phieuNhap']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['typekho'];?>
')" title="Trả lại">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/tra-lai.png"/>    
                                </a>
                            <?php }?>
                        <?php }?>
                    </td>
                </tr>
                <?php
}
}
?>
            </table>
        </div>
    </form>
</div><?php }
}
