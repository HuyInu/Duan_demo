<?php
/* Smarty version 4.1.1, created on 2023-05-09 09:26:07
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Kho-Kv-Thong-Ke\ton-kho.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6459af3fb15e15_86933855',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '754ed27c59dcb7370a64808ed2db2b232f8c2870' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Kho-Kv-Thong-Ke\\ton-kho.tpl',
      1 => 1683596104,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tungay-denngay-thong-ke-kho-san-xuat.tpl' => 1,
    'file:./allsearch/print-kho-san-xuat.tpl' => 1,
  ),
),false)) {
function content_6459af3fb15e15_86933855 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="breadcrumb">
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
    <form name="f" id="f" method="post" onsubmit="return searchKhoKhacKhoTongDeCucThongKe('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/KhoSanXuat-Kho-Vmnt-Thong-Ke.php?act=<?php echo $_REQUEST['act'];?>
&cid=<?php echo $_REQUEST['cid'];?>
')"> 
        <div class="MainSearch">            
             <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tungay-denngay-thong-ke-kho-san-xuat.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
             <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/print-kho-san-xuat.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
             <input type="hidden" id="getUrlPrintKhoNguonVao" value="act=tonkho&cid=<?php echo $_smarty_tpl->tpl_vars['phongbanchuyen']->value;?>
"  />
        </div>
        <div class="MainTable">
            <table  class="table-bordered">
                <tr class="trheader">
                    <td align="center">
                        <strong>Loại Vàng</strong>
                    </td>
                    <td align="center">
                        <strong>Số Dư Đầu Kỳ</strong>
                    </td>
                    <td align="center">
                        <strong>Số Lượng Nhập</strong>
                    </td>
                    <td align="center">
                        <strong>Số Lượng Xuất</strong>
                    </td>
                    <td align="center">
                        <strong>Hao Kết Dẻ</strong>
                    </td>
                    <td align="center">
                        <strong>Dư Kết Dẻ</strong>
                    </td>
                    
                     <td align="center">
                        <strong>Hao Chênh Lệch</strong>
                    </td>
                    <td align="center">
                        <strong>Dư Chênh Lệch</strong>
                    </td>
                    
                    <td align="center">
                        <strong>Tồn</strong>
                    </td>
                    <td align="center">
                        <strong>Tổng Trọng Lượng Q10</strong>
                    </td>
                    <td align="center">
                        <strong>Tổng Trọng Lượng Q10 Gia Cong</strong>
                    </td>

                </tr>
                <?php $_smarty_tpl->_assignInScope('tongQ10', 0);?>
                <?php $_smarty_tpl->_assignInScope('tongQ10GiaCong', 0);?>
				<?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['typegoldview']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                	<?php $_smarty_tpl->_assignInScope('viewdl', thongKeTonHienTaiKhoSanXuatTest($_smarty_tpl->tpl_vars['phongbanchuyen']->value,$_smarty_tpl->tpl_vars['typegoldview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id']));?>
                    <?php if ($_smarty_tpl->tpl_vars['viewdl']->value['idloaivang'] > 0) {?>
                    <tr class="fontSizeTon">
                        <td align="right">
                            <?php echo $_smarty_tpl->tpl_vars['typegoldview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                       </td>
                       <td align="right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['sltonsddk'],3,".",",");?>

                       </td>
                       <td align="right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slnhap'],3,".",",");?>

                       </td>
                       <td align="right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slxuat'],3,".",",");?>

                       </td>
                       <td align="right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slhao'],3,".",",");?>

                       </td>
                       <td align="right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['sldu'],3,".",",");?>

                       </td>
                        <td align="right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slhaochenhlech'],3,".",",");?>

                       </td>
                       <td align="right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slduchenhlech'],3,".",",");?>

                       </td>
                       <td align="right">
                            <strong><?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slton'],3,".",",");?>
</strong>
                       </td>
                       <td align="right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['tongQ10'],3,".",",");?>

                            <?php $_smarty_tpl->_assignInScope('tongQ10', $_smarty_tpl->tpl_vars['tongQ10']->value+$_smarty_tpl->tpl_vars['viewdl']->value['tongQ10']);?>
                       </td>
                       <td align="right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['tongQ10GiaCong'],3,".",",");?>

                            <?php $_smarty_tpl->_assignInScope('tongQ10GiaCong', $_smarty_tpl->tpl_vars['tongQ10GiaCong']->value+$_smarty_tpl->tpl_vars['viewdl']->value['tongQ10GiaCong']);?>
                    </td> 
                    </tr>  
                 <?php }?> 
            <?php
}
}
?>
                <tr class="Paging fontSizeTon">
                    <td align="right" colspan="9"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
                    <td align="right"><strong class="colorXanh"><?php echo number_format($_smarty_tpl->tpl_vars['tongQ10']->value,3,".",",");?>
 </strong></td>
                    <td align="right"><strong class="colorXanh"><?php echo number_format($_smarty_tpl->tpl_vars['tongQ10GiaCong']->value,3,".",",");?>
 </strong></td>
                </tr>
            </table>
        </div>
    </form>
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
