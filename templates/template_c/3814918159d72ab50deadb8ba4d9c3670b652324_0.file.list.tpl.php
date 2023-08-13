<?php
/* Smarty version 4.1.1, created on 2023-08-11 16:18:17
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Huy-Nhap-Kho\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d5fcd953ea15_92312066',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3814918159d72ab50deadb8ba4d9c3670b652324' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Huy-Nhap-Kho\\list.tpl',
      1 => 1691745492,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_64d5fcd953ea15_92312066 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="vi">
<head>
<?php $_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/css/giahuy/style.css">
</head>
<body>
    <div class='header'>
    </div>
    <div class='goAction'>
        <ul>
            <li>
                <?php if ($_smarty_tpl->tpl_vars['checkPer1']->value == true) {?>
                    <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/thuchanh.php?act=add&cid=<?php echo $_REQUEST['cid'];?>
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
                    <a href="javascript:void(0)" title="Delete" onclick="ChangeAction('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/thuchanh.php?act=dellist&cid=<?php echo $_REQUEST['cid'];?>
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
    <div class='content'>
        <div class='MainTable'>
            <form name="f" id="f" method="post">
                <div class='table'>
                    <table style='width:100%'>
                        <tr class='tbheader'>
                            <td width='25px' class='tdcheck'><input type='checkbox' onclick="checkAll();" name='all'></th>
                            <th width='50px'>STT</th>
                            <th width='74px'>Thứ tự</th>
                            <th>Tên</th>
                            <th>Table</th>
                            <th>Table chi tiết</th>
                            <th>Table hạch toán</th>
                            <th>Type phòng ban</th>
                            <th>Component</th>
                            <th>Mã phòng ban</th>
                            <th>Phòng ban catalog</th>
                            <th>No permission</th>
                            <th>Hiện ẩn</th>
                            <th>Sửa</th>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</body>
<footer>
<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</footer>
</html><?php }
}
