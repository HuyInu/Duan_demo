<?php
/* Smarty version 4.1.1, created on 2023-08-11 11:14:44
  from 'D:\wamp64\www\duan_demo\templates\tpl\giahuy\add_edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d5b5b4dbe060_85053323',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3eb18d35a435e5371b5edbd275db80e8509f6c11' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\giahuy\\add_edit.tpl',
      1 => 1691727282,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_64d5b5b4dbe060_85053323 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="vi">
<head>
<?php $_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/css/giahuy/style.css">
</head>
<body>
<div class='container'>
        <div class='header'>
        </div>
        <div class='MainContent'>
            <form method='post' class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tên</label>
                    <div class="col-sm-6">
                        <input type='text' name='name_vn' value='<?php echo $_smarty_tpl->tpl_vars['edit']->value['nam_vn'];?>
'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tên</label>
                    <div class="col-sm-6">
                        <input type='text' name='name_vn' value='<?php echo $_smarty_tpl->tpl_vars['edit']->value['nam_vn'];?>
'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tên</label>
                    <div class="col-sm-6">
                        <input type='text' name='name_vn' value='<?php echo $_smarty_tpl->tpl_vars['edit']->value['nam_vn'];?>
'>
                    </div>
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
