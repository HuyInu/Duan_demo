<?php
/* Smarty version 4.1.1, created on 2023-09-28 15:30:34
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Xuat-Kho\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_651539aa465b73_25625581',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'b6927a8a7418125244cdf1096fb811276e3ab1e9' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Xuat-Kho\\list.tpl',
      1 => 1695889475,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tungay-denngay.tpl' => 1,
  ),
),false)) {
function content_651539aa465b73_25625581 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="goAction">
	<ul>
    	<li>
            <?php if ($_smarty_tpl->tpl_vars['checkPer1']->value == "true") {?>
                <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php?act=add&cid=<?php echo $_REQUEST['cid'];?>
');">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/add.png">
                </a> 
            <?php } else { ?>  
                <a>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/add-no.png">
                </a> 	
            <?php }?> 
            <?php if ($_smarty_tpl->tpl_vars['checkPer3']->value == "true") {?>
               	<a href="javascript:void(0)" title="Delete" onclick="ChangeAction('Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php?act=dellist&cid=<?php echo $_REQUEST['cid'];?>
');">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/delete.png">
               	</a> 
            <?php } else { ?>   
               	<a>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/delete-no.png">
               	</a> 
            <?php }?> 
        </li>
    </ul>
</div>
<div class="MainContent">
	<form name="f" id="f" method="post" onsubmit="return searchKhoTemDa('Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php?cid=<?php echo $_REQUEST['cid'];?>
')"> 
        <div class="MainSearch">
        	<?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tungay-denngay.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>
        <div class="MainTable fix-max-height">
            <table class="table-bordered">
                <tr class="trheader" align="center">
                    <td style="min-width:30px">
                        <input type="checkbox" onclick="checkAll(this.checked);" name="all"/>
                    </td>
                    <td style="min-width:30px">
                        <strong>STT</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Ngày xuất kho</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Mã phiếu xuất kho</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Nhóm Nguyên Liệu</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Tên Nguyên Liệu</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Loại vàng</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Cân nặng V+H</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Cân nặng H</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Cân nặng V</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Ghi Chú</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Mã phiếu trả kho</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Duyệt Chuyển</strong>
                    </td>
                    <td style="min-width:30px">
                        <strong>Sửa/In</strong>
                    </td>
                </tr>
                <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['view']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                <tr>
                    <td>
                        <input type="checkbox" id="check<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>
" name="iddel[]" value="<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
"/>
                    </td>
                    <td>
                        <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)+1;?>

                    </td>
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['dated'];?>

                    </td>
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieu'];?>

                    </td>
                    <td>
                        <strong>Nhóm Nguyên Liệu</strong>
                    </td>
                    <td>
                        <strong>Tên Nguyên Liệu</strong>
                    </td>
                    <td>
                         <?php echo getName('loaivang','name_vn',$_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['idloaivang']);?>

                    </td>
                    <td>
                        <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangvh'],3,".",",");?>

                    </td>
                    <td>
                        <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangh'],3,".",",");?>

                    </td>
                    <td>
                        <?php echo number_format($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cannangv'],3,".",",");?>

                    </td>
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['ghichu'];?>

                    </td>
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphieutrakho'];?>

                    </td>
                    <td>
                        <a href="#" onclick="giahuy_xacnhanchuyenKhoSanXuat('xacnhankhonutrangtrave', 2, <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
, 'abc')">Duyệt Chuyển</a>
                    </td>
                    <td>
                    <?php if ($_smarty_tpl->tpl_vars['checkPer2']->value == "true") {?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-Nu-Trang-Tra-Ve-Xuat-Kho.php?act=edit&cid=<?php echo $_REQUEST['cid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" title="Sửa"> 
                        <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/edit.png"/> 
                    </a>
                    <?php } else { ?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/edit-no.png"/> 
                    <?php }?> 
                  
                    <?php if ($_smarty_tpl->tpl_vars['checkPer7']->value == "true") {?>
                        <a href="javascript:void(0)" onclick="popupwindow('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/print/khonguonvao.php?act=nhapkho&table=khonguonvao_khoachin&id=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
&type=1','mywindow')" title="Print">
                             <img class="margin-left10" width="25px" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/images/printer.png" align="top"> 
                        </a>
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
