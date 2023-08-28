<?php
/* Smarty version 4.1.1, created on 2023-08-28 07:38:56
  from 'D:\wamp64\www\duan_demo\templates\tpl\KhoSanXuat-Huy-Kho-Vmnt-Thong-Ke\ton-kho-hien-tai.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64ebeca0c5ec76_87855616',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '539f2fc1adc9c0a96e6c79beefb074ff7af6f20d' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\KhoSanXuat-Huy-Kho-Vmnt-Thong-Ke\\ton-kho-hien-tai.tpl',
      1 => 1693182963,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/print-kho-san-xuat.tpl' => 1,
  ),
),false)) {
function content_64ebeca0c5ec76_87855616 (Smarty_Internal_Template $_smarty_tpl) {
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
                </tr>
                <?php $_smarty_tpl->_assignInScope('tongQ10', 0);?>
				<?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['typegoldview']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                	<?php $_smarty_tpl->_assignInScope('viewdl', thongKeTonHienTaiKhoSanXuat($_smarty_tpl->tpl_vars['phongbanchuyen']->value,$_smarty_tpl->tpl_vars['typegoldview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id']));?>
                    <?php if ($_smarty_tpl->tpl_vars['viewdl']->value['idloaivang'] > 0) {?>
                        <tr class="fontSizeTon">
                            <td align="right">
                                <?php echo $_smarty_tpl->tpl_vars['typegoldview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                           </td>
                          
                           <td align="right">
                                <strong><?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['slton'],3,".",",");?>
</strong>
                           </td>
                           <td align="right">
                                <?php echo number_format($_smarty_tpl->tpl_vars['viewdl']->value['tongQ10'],3,".",",");?>

                                <?php $_smarty_tpl->_assignInScope('tongQ10', $_smarty_tpl->tpl_vars['tongQ10']->value+$_smarty_tpl->tpl_vars['viewdl']->value['tongQ10']);?>
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
