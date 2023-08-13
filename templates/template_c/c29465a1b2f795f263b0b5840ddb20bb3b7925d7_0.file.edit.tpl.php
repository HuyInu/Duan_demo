<?php
/* Smarty version 4.1.1, created on 2023-08-11 14:40:29
  from 'D:\wamp64\www\duan_demo\templates\tpl\giahuy\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d5e5ed2c64c5_59803431',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'c29465a1b2f795f263b0b5840ddb20bb3b7925d7' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\giahuy\\edit.tpl',
      1 => 1691739612,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_64d5e5ed2c64c5_59803431 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="vi">
<head>
<?php $_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/css/giahuy/style.css">

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/select-checkbox/sol.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/select-checkbox/sol.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/search.css" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/jsapi.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/script.js"><?php echo '</script'; ?>
>
</head>
<body>
<div class='container'>
        <div class='header'>
        </div>
        <div class='MainContent'>
            <form name="allsubmit" method='post' class="form-horizontal" id="frmEdit" action="thuchanh.php?act=<?php if ($_REQUEST['act'] == 'add') {?>addsm<?php } else { ?>editsm<?php }?>&cid=<?php echo $_REQUEST['cid'];?>
" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tên</label>
                    <div class="col-sm-6">
                        <input type='text' name='name_vn' value='<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['edit']->value['name_vn'], ENT_QUOTES, 'UTF-8', true);?>
'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Table (lấy tên table khi chuyển kho)</label>
                    <div class="col-sm-6">
                        <input type='text' name='table' value='<?php echo $_smarty_tpl->tpl_vars['edit']->value['table'];?>
'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Table chi tiết</label>
                    <div class="col-sm-6">
                        <input type='text' name='tablecb' value='<?php echo $_smarty_tpl->tpl_vars['edit']->value['tablecb'];?>
'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Table hạch toán</label>
                    <div class="col-sm-6">
                        <input type='text' name='tablehachtoan' value='<?php echo $_smarty_tpl->tpl_vars['edit']->value['tablehachtoan'];?>
'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Type phòng ban</label>
                    <div class="col-sm-6">
                        <input class='short_textbox' type='text' name='typephongban' value='<?php echo $_smarty_tpl->tpl_vars['edit']->value['typephongban'];?>
'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mã Phòng Ban (Phân Mềm A.Tuấn)</label>
                    <div class="col-sm-6">
                        <input class='short_textbox' type='text' name='maphongban' value='<?php echo $_smarty_tpl->tpl_vars['edit']->value['maphongban'];?>
'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Số Thứ Tự</label>
                    <div class="col-sm-6">
                        <input class='short_textbox' type='text' name='num' value='<?php echo $_smarty_tpl->tpl_vars['edit']->value['num'];?>
'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">No Permission</label>
                    <div class="col-sm-6">
                        <input type='checkbox' name='nopermission' value='nopermission'<?php if ($_smarty_tpl->tpl_vars['edit']->value['nopermission'] == '1') {?> checked <?php }?> >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Hiện/Ẩn</label>
                    <div class="col-sm-6">
                        <input type='checkbox' name='active' value='active'<?php if ($_smarty_tpl->tpl_vars['edit']->value['active'] == '1') {?> checked <?php }?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Có Menu Con?</label>
                    <div class="col-sm-6">
                        <input type='checkbox' name='has_child' value="has_child" <?php if ($_smarty_tpl->tpl_vars['edit']->value['has_child'] == '1') {?> checked <?php }?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Component</label>
                    <div class="col-sm-6">
                        <input style="width:60%;" name="namecomp" id="namecomp" autocomplete="off" class="InputText" type="text" value="<?php echo insert_getName(array('table' => 'component', 'names' => 'name', 'id' => $_smarty_tpl->tpl_vars['edit']->value['comp']),$_smarty_tpl);?>" placeholder="Nhập tìm kiếm tên component phù hợp " onkeyup="lookup('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
','component',this.value);" />
                        <input type="text" name="comp" id="comp" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['comp'];?>
" class="InputNum" readonly>
                        <div id="suggestions" class="suggestionsCat"></div>
                    </div>
                </div>
                <div class="col-xs-9 TextCenter"> 
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['id'];?>
" />
                    <input type="hidden" name="cat" value="2" />
                    <input type="button" class="btn-save" onclick=" return SubmitFrom('checkForm','');"  value="Lưu"> 
                </div>
            </form>
        </div>
</div>
</body>
<footer>
<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</footer>
</html>
<?php echo '<script'; ?>
>

function insertComponent(idcomponent, tencomponent){
    $('#comp').val(idcomponent);
    $('#namecomp').val(tencomponent);
}

<?php echo '</script'; ?>
><?php }
}
