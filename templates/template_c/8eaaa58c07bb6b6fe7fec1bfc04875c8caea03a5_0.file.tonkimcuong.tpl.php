<?php
/* Smarty version 4.1.1, created on 2023-08-29 15:45:42
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-A9-Huy-Thong-Ke\tonkimcuong.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64edb036a8e402_20850243',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '8eaaa58c07bb6b6fe7fec1bfc04875c8caea03a5' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-A9-Huy-Thong-Ke\\tonkimcuong.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tungay-denngay-thong-ke.tpl' => 1,
  ),
),false)) {
function content_64edb036a8e402_20850243 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="ChonLoaiPhieu">
    <ul>
        <li class="active" id="clickVang" onclick="clickVang('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Thong-Ke.php?cid=<?php echo $_REQUEST['cid'];?>
')">
            <a>Vàng</a>
        </li>
        <li id="clickKimCuong" onclick="clickKimCuong('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/Kho-A9-Thong-Ke.php?cid=<?php echo $_REQUEST['cid'];?>
')">
            <a>Kim Cương</a>
        </li>
    </ul>
</div>
<div class="MainContent">
    <form name="f" id="f" method="post" onsubmit="return thongke()"> 
        <div class="MainSearch">
            <?php $_smarty_tpl->_subTemplateRender("file:./allsearch/tungay-denngay-thong-ke.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['showlist']->value == 1) {?>
            <div class="MainTable">
            <table  class="table-bordered">
                <tr class="trheader">
                    <td class="tdSTT" align="center">
                        <strong>STT</strong>
                    </td>
                    
                    <td align="center">
                        <strong>Thông tin</strong>
                    </td>
                    
                    <td align="center">
                        <strong>Số Lượng</strong>
                    </td>
                    
                    <td align="center">
                        <strong>Đơn Giá</strong>
                    </td>
                </tr>

                <tr class="fontSizeTon">
                    <td>
                       1
                    </td>
                    <td>
                        Tồn đầu ngày
                   </td>
                   <td align="right">
                        <?php echo number_format($_smarty_tpl->tpl_vars['sltondaungay']->value,3,".",",");?>

                   </td>
                   <td align="right">
                        <?php echo number_format($_smarty_tpl->tpl_vars['dongiadaungay']->value,3,".",",");?>

                   </td>
                    
              	</tr>   
                
                 <tr class="fontSizeTon">
                    <td>
                       2
                    </td>
                    <td>
                        Nhập Kho
                   </td>
                   <td align="right">
                        <?php echo number_format($_smarty_tpl->tpl_vars['slnhapcuoingay']->value,3,".",",");?>

                   </td>
                   <td align="right">
                        <?php echo number_format($_smarty_tpl->tpl_vars['dongianhapcuoingay']->value,3,".",",");?>

                   </td>
                   
              	</tr>    
                
                <tr class="fontSizeTon">
                    <td>
                       3
                    </td>
                    <td>
                        Xuất Kho
                   </td>
                   <td align="right">
                        <?php echo number_format($_smarty_tpl->tpl_vars['slxuatcuoingay']->value,3,".",",");?>

                   </td>
                   <td align="right">
                        <?php echo number_format($_smarty_tpl->tpl_vars['dongiaxuatcuoingay']->value,3,".",",");?>

                   </td>
                   
              	</tr>  
                
                <tr class="fontSizeTon">
                    <td>
                       4
                    </td>
                    <td>
                        Tồn Kho
                   </td>
                   <td align="right">
                        <strong class="colorXanh"><?php echo number_format($_smarty_tpl->tpl_vars['sltontong']->value,3,".",",");?>
</strong>
                   </td>
                   <td align="right" class="trheader">
                        <strong class="colorXanh"><?php echo number_format($_smarty_tpl->tpl_vars['tongdongia']->value,3,".",",");?>
</strong>
                   </td>
                   
              	</tr>                                                                 
            </table>
        </div>  
        <?php }?> 
    </form>    
</div>
<link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.css" rel="stylesheet" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/calendar/jquery-ui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	$(document).ready(function() {
		$("#todays").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
		$("#fromdays").datepicker({changeMonth: true, changeYear: true,dateFormat:"dd/mm/yy"});
	});
<?php echo '</script'; ?>
><?php }
}
