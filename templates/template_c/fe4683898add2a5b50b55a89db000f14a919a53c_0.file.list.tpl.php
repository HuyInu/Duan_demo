<?php
/* Smarty version 4.1.1, created on 2023-09-23 14:37:13
  from 'C:\wamp64\www\duan_demo\templates\tpl\giahuy\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650e95a9241e99_58776803',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'fe4683898add2a5b50b55a89db000f14a919a53c' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\giahuy\\list.tpl',
      1 => 1692405747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:giahuy/modal.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_650e95a9241e99_58776803 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="vi">
<head>
<?php $_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/css/giahuy/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/css/giahuy/modal.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/css/giahuy/fontAwsome.css">
</head>
<body>
    <?php $_smarty_tpl->_subTemplateRender('file:giahuy/modal.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div class='container'>
        <div class='header'>
        </div>
        <div class='goAction'>
            <ul>
                <li>
                    <?php if ($_smarty_tpl->tpl_vars['checkPer1']->value == true) {?>
                        <a href="javascript:void(0)" title="Thêm" onclick="return ChangeAdd('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/thuchanh.php?act=add&cid=<?php echo $_REQUEST['cid'];?>
');">
                            <span class='add_icon icon-size-small'></span>
                        </a> 
                    <?php } else { ?>  
                            <a>
                            <span class='add_icon icon-size-small disable_icon'></span>
                        </a> 	
                    <?php }?> 
                    
                    <?php if ($_smarty_tpl->tpl_vars['checkPer3']->value == "true") {?>
                        <a href="javascript:void(0)" title="Delete" onclick="GiaHuy_openModal('modal','Bạn có muốn xóa?',Giahuy_ChangeAction,'<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/thuchanh.php?act=dellist&cid=<?php echo $_REQUEST['cid'];?>
')">
                            <span class='delete_icon icon-size-small'></span>
                        </a> 
                    <?php } else { ?>   
                        <a>
                            <span class='delete_icon icon-size-small disable_icon'></span>
                        </a> 
                    <?php }?> 
                    
                    <?php if ($_smarty_tpl->tpl_vars['checkPer2']->value == "true") {?> 
                        <a href="javascript:void(0)" title="Show" onclick="GiaHuy_openModal('modal','Bạn có muốn hiện?',Giahuy_ChangeAction,'<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/thuchanh.php?act=show&cid=<?php echo $_REQUEST['cid'];?>
')" >
                            <span class='check_icon icon-size-small'></span>
                        </a> 

                        <a href="javascript:void(0)" title="Hide" onclick="GiaHuy_openModal('modal','Bạn có muốn ẩn?',Giahuy_ChangeAction,'<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/thuchanh.php?act=hide&cid=<?php echo $_REQUEST['cid'];?>
');">
                            <span class='stop_icon icon-size-small'></span>
                        </a> 
                        
                        <a href="javascript:void(0)" title="Order" onclick="GiaHuy_openModal('modal','Bạn có muốn lưu?',Giahuy_ChangeAction,'<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/thuchanh.php?act=order&cid=<?php echo $_REQUEST['cid'];?>
');">
                            <span class='save_icon icon-size-small'></span>
                        </a>  
                    <?php } else { ?>  
                        <a>
                            <span class='check_icon icon-size-small disable_icon'></span>
                        </a> 
                        <a>
                            <span class='stop_icon icon-size-small disable_icon'></span>
                        </a> 
                        <a>
                            <span class='save_icon icon-size-small disable_icon'></span>
                        </a> 
                    <?php }?>
                </li>
            </ul>
        </div>
        <div class='content'>
            <div class=''><!--MainTable-->
                <form name="f" id="f" method="POST">
                    <div class=''>
                        <table class='shadow-box' style='width:100%'>
                            <tr class='tbheader'>
                                <td width='25px' class='tdcheck'><input type='checkbox' onclick="checkAll();" name='all'></td>
                                <td width='55px'>STT</td>
                                <td width='74px'>Thứ tự</td>
                                <td>Tên</td>
                                <td>Table</td>
                                <td>Table chi tiết</td>
                                <td>Table hạch toán</td>
                                <td width='95px'>Type phòng ban</td>
                                <td>Component</td>
                                <td>Mã phòng ban</td>
                                <td width='139px'>Phòng ban catalog</td>
                                <td width='111px'>No permission</td>
                                <td width='96px'>Hiện ẩn</td>
                                <td width='96px'>Sửa</td>
                            </tr>
                            <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['view']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                            <tr class='tbRow'>
                                <td><input type='checkbox' value="<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" name="iddel[]" id='check<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>
' ></td>
                                <td><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>
</td>
                                <td><input class='tableTxtbox text_box align-center' type='textbox' name='ordering[]' value='<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['num'];?>
'></td>
                                <td>
                                <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['has_child'] == 1) {?>
                                    <a href="thuchanh.php?cid=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" border="0">
                                        <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                                    </a>
                                <?php } else { ?>
                                        <?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                                <?php }?>	
                                </td> 
                                <td><?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['table'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tablect'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['tablehachtoan'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['typephongban'];?>
</td>
                                <?php if ($_REQUEST['cid'] == 79 || $_REQUEST['cid'] == 83) {?>
                                    <td>
                                    <?php if ($_SESSION['group_qlsxntjcorg_user'] == -1) {?>
                                        <select class="chonchuyenphong" onchange="getTTGiaoNhan(<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
, this.value)">
                                    <?php } else { ?>
                                        <select class="chonchuyenphong" disabled="disabled">
                                    <?php }?>
                                        <?php
$__section_j_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['typegiaonhanload']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_j_1_total = $__section_j_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_j'] = new Smarty_Variable(array());
if ($__section_j_1_total !== 0) {
for ($__section_j_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] = 0; $__section_j_1_iteration <= $__section_j_1_total; $__section_j_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']++){
?>
                                                <option <?php if ($_smarty_tpl->tpl_vars['typegiaonhanload']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] : null)]['id'] == $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['typegiaonhan']) {?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['typegiaonhanload']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] : null)]['id'];?>
">
                                                    <?php echo $_smarty_tpl->tpl_vars['typegiaonhanload']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_j']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_j']->value['index'] : null)]['name_vn'];?>

                                                </option>
                                            <?php
}
}
?>	
                                        </select>
                                    </td>
                                <?php }?>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'] == 27) {?>
                                        <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['has_child'] == "0") {?>
                                            <?php $_smarty_tpl->assign("comp" , insert_GetNameComponent (array('comp' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['comp']),$_smarty_tpl), true);?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['comp']->value['do'];?>
?cid=0">
                                                <?php echo $_smarty_tpl->tpl_vars['comp']->value['name'];?>
 
                                            </a>
                                        <?php }?>
                                    <?php } else { ?>
                                        <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['has_child'] == "0") {?>
                                            <?php $_smarty_tpl->assign("comp" , insert_GetNameComponent (array('comp' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['comp']),$_smarty_tpl), true);?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['comp']->value['do'];?>
?cid=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
">
                                                <?php echo $_smarty_tpl->tpl_vars['comp']->value['name'];?>
 
                                            </a>
                                        <?php }?>
                                    <?php }?>
                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['maphongban'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['phongbancatalog'];?>
</td>
                                <td align="center">   
                                    <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['nopermission'] == 1) {?>
                                        <span class='check_icon icon-size-small2'></span>
                                    <?php } else { ?> 
                                        <span class='ban_icon icon-size-small2'></span>
                                    <?php }?>
                                </td>
                                <td align="center">
                                    <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['active'] == "1") {?>
                                        <span class='check_icon icon-size-small2'></span>
                                    <?php } else { ?> 
                                        <span class='ban_icon icon-size-small2'></span>
                                    <?php }?>
                                </td>
                                <td align="center">
                                    <?php if ($_smarty_tpl->tpl_vars['checkPer2']->value == "true") {?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/thuchanh.php?act=edit&cid=<?php echo $_REQUEST['cid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
" title="Sửa"> 
                                        <span class='edit_icon icon-size-small2'></span>
                                    </a>
                                    <?php } else { ?>
                                        <span class='edit_icon icon-size-small2 disable_icon'></span> 
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
            </div>
        </div>
    </div>
</body>
<footer>
<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</footer>
</html><?php }
}
