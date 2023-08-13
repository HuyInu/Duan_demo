<?php
/* Smarty version 4.1.1, created on 2023-05-08 15:45:16
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Kho-Kv-Thong-Ke\ton-kho-hien-tai.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6458b69c78f8b1_07472098',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82049e49c4e31a2a594c311a030e588d3ce76321' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Kho-Kv-Thong-Ke\\ton-kho-hien-tai.tpl',
      1 => 1683535180,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/print-kho-san-xuat.tpl' => 1,
  ),
),false)) {
function content_6458b69c78f8b1_07472098 (Smarty_Internal_Template $_smarty_tpl) {
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
    <form name="f" id="f" method="post" onsubmit="return">
        <div class="MainSearch">            
            <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/print-kho-san-xuat.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <input type="hidden" id="getUrlPrintKhoNguonVao" value="act=tonkhohientai&cid=<?php echo $_smarty_tpl->tpl_vars['phongbanchuyen']->value;?>
"  />
       </div>
       <div class="MainTable">
            <table  class="table-bordered">
                <tr class="trheader">
                    <td align="center">
                        <strong>Loại Vàng</strong>
                    </td>
                    <td align="center">
                        <strong>Tồn</strong>
                    </td>
                    <td align="center">
                        <strong>Tổng Trọng Lượng Q10</strong>
                    </td>
                    <td align="center">
                        <strong>Tổng Trọng Lượng Q10 Gia Công</strong>
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
                                <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slton'],3,".",",");?>

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
                    <td align="right" colspan="2"> <span class="colorXanh">Tổng Trọng Lượng Q10:</span> </td>
                    <td align="right"><strong class="colorXanh"><?php echo number_format($_smarty_tpl->tpl_vars['tongQ10']->value,3,".",",");?>
 </strong></td>
                    <td align="right"><strong class="colorXanh"><?php echo number_format($_smarty_tpl->tpl_vars['tongQ10GiaCong']->value,3,".",",");?>
 </strong></td>
                </tr>
            </table>
       </div>
    </form>
</div><?php }
}
