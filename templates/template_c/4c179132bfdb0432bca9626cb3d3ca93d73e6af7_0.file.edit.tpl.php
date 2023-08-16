<?php
/* Smarty version 4.1.1, created on 2023-08-16 10:00:22
  from 'D:\wamp64\www\duan_demo\templates\tpl\huytulam\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64dc3bc6db5070_87775242',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c179132bfdb0432bca9626cb3d3ca93d73e6af7' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\huytulam\\edit.tpl',
      1 => 1692154820,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64dc3bc6db5070_87775242 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
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
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/js/searchajax/Giahuy_script.js"><?php echo '</script'; ?>
>

<div class="MainContent">
<form name="allsubmit" class="form-horizontal" id="frmEdit" action="huymenu2.php?act=<?php if ($_REQUEST['act'] === 'add') {?>addsm<?php } else { ?>editsm&id=<?php echo $_REQUEST['id'];
}?>&cid=<?php echo $_REQUEST['cid'];?>
" method="post" enctype="multipart/form-data">
    	<div class="form-group">
            <label class="col-sm-3 control-label">Tên</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['name_vn'];?>
" name="name_vn" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Table (lấy tên table khi chuyển kho)</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['table'];?>
" name="table" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Table chi tiết</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['tablect'];?>
" name="tablect" />
            </div>
        </div>
        
         <div class="form-group">
            <label class="col-sm-3 control-label">Table hạch toán</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['tablehachtoan'];?>
" name="tablehachtoan" />
            </div>
        </div>
        
         <div class="form-group">
            <label class="col-sm-3 control-label">Type phòng ban</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['typephongban'];?>
" name="typephongban" class="InputNum"  onkeypress="return onlyNumberKey(event)"/>
            </div>
        </div>
            
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Mã Phòng Ban (Phân Mềm A.Tuấn)</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['maphongban'];?>
" name="maphongban" class="InputNum" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Số Thứ Tự</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['num'];?>
" name="num" class="InputNum"  onkeypress="return onlyNumberKey(event)"/>
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-3 control-label">No Permission</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox" name="nopermission"  value="1" <?php echo $_smarty_tpl->tpl_vars['category']->value['nopermission'] === '1' ? 'checked' : '';?>
/>    
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Hiện/Ẩn</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox" name="active" value="1" <?php echo $_smarty_tpl->tpl_vars['category']->value['active'] == '1' || $_REQUEST['act'] == 'add' ? 'checked' : '';?>
/>    
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Có Menu Con?</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox"  value="1" name="has_child" onclick="Giahuy_disable_Componet_TextBox(this)" <?php echo $_smarty_tpl->tpl_vars['category']->value['has_child'] === '1' ? 'checked' : '';?>
/>    
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Component</label>
            <div class="col-sm-6">
                <?php if ($_REQUEST['act'] == 'edit') {?>
                    <?php $_smarty_tpl->assign('conponent',Giahuy_getComponentById($_smarty_tpl->tpl_vars['category']->value['comp']));?>
                <?php }?>    
                <input style="width:60%;" name="namecomp" id="namecomp" autocomplete="off" class="InputText" type="text" value="<?php echo $_smarty_tpl->tpl_vars['conponent']->value['name'];?>
" onkeyup="Giahuy_componentLookup('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
', 'conponent', this.value)"/>
                <input type="text" name="comp" id="comp" value="<?php echo $_smarty_tpl->tpl_vars['conponent']->value['id'];?>
" class="InputNum" readonly>
                <div id="suggestions" class="suggestionsCat"></div>
            </div>
        </div>
        <div class="col-xs-9 TextCenter"> 
            <input type="button" class="btn-save" onclick="Giahuy_SubmitFrom(this)"  value="Lưu"> 
        </div>
    </form>    
</div>
<?php echo '<script'; ?>
>

function insertComponent(idcomponent, tencomponent){
    $('#comp').val(idcomponent);
    $('#namecomp').val(tencomponent);
}

<?php echo '</script'; ?>
><?php }
}
