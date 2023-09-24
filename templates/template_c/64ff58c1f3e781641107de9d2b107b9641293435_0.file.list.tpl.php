<?php
/* Smarty version 4.1.1, created on 2023-09-23 10:36:13
  from 'C:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Xuat-Kho\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650e5d2d114159_79858853',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '64ff58c1f3e781641107de9d2b107b9641293435' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Xuat-Kho\\list.tpl',
      1 => 1695439220,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./allsearch/tungay-denngay.tpl' => 1,
  ),
),false)) {
function content_650e5d2d114159_79858853 (Smarty_Internal_Template $_smarty_tpl) {
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
            </table>
        </div>
    </form>
</div><?php }
}
