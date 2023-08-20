<?php
/* Smarty version 4.1.1, created on 2023-08-19 07:58:49
  from 'C:\wamp64\www\duan_demo\templates\tpl\categories\edit_test.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64e013c94ba482_28962449',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'f65e66bb6a1b681ac3e6339194670bc5c2a42859' => 
    array (
      0 => 'C:\\wamp64\\www\\duan_demo\\templates\\tpl\\categories\\edit_test.tpl',
      1 => 1683102324,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e013c94ba482_28962449 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <?php echo insert_HearderCatMenu(array('cid' => $_REQUEST['cid'], 'root' => $_REQUEST['root'], 'act' => $_REQUEST['act']),$_smarty_tpl);?>
    </ul>
</div>
<div class="MainContent">
    <form name="allsubmit" class="form-horizontal" id="frmEdit" action="categories_test.php?act=<?php if ($_REQUEST['act'] == 'add') {?>addsm<?php } else { ?>editsm<?php }?>&cid=<?php echo $_REQUEST['cid'];?>
" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-3 control-label">Tên</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['edit']->value['name_vn'], ENT_QUOTES, 'UTF-8', true);?>
" name="name_vn" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Table (lấy tên table khi chuyển kho)</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['table'];?>
" name="table" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Table chi tiết</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['tablect'];?>
" name="tablect" />
            </div>
        </div>
        
         <div class="form-group">
            <label class="col-sm-3 control-label">Table hạch toán</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['tablehachtoan'];?>
" name="tablehachtoan" />
            </div>
        </div>
        
         <div class="form-group">
            <label class="col-sm-3 control-label">Type phòng ban</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['typephongban'];?>
" name="typephongban" class="InputNum" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Mã Phòng Ban (Phân Mềm A.Tuấn)</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['maphongban'];?>
" name="maphongban" class="InputNum" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Số Thứ Tự</label>
            <div class="col-sm-6">
                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['edit']->value['num'] == '') {?>0<?php } else {
echo $_smarty_tpl->tpl_vars['edit']->value['num'];
}?>" name="num" class="InputNum" />
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-3 control-label">No Permission</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox" name="nopermission" value="nopermission" <?php if ($_smarty_tpl->tpl_vars['edit']->value['nopermission'] == 1) {?>checked<?php }?> />    
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Hiện/Ẩn</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox" name="active" value="active" <?php if ($_smarty_tpl->tpl_vars['edit']->value['active'] == 1 || $_REQUEST['act'] == 'add') {?>checked<?php }?> />    
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Có Menu Con?</label>
            <div class="col-sm-6">
                <input type="checkbox" class="CheckBox" onclick="CheckHasChild(this);" value="has_child" name="has_child"  <?php if ($_smarty_tpl->tpl_vars['edit']->value['has_child'] == 1) {?>checked<?php }?>/>    
            </div>
        </div>
        <?php if ($_REQUEST['cid'] == 79 || $_REQUEST['cid'] == 83) {?>
            <div class="form-group">
                <label class="col-sm-3 control-label">Giao Nhập Nhà Xưởng (Phần Mềm A Tuấn)</label>
                <div class="col-sm-6">
                    <select id="typegiaonhan" name="typegiaonhan">
                        <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['typegiaonhanload']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                            <option <?php if ($_smarty_tpl->tpl_vars['typegiaonhanload']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'] == $_smarty_tpl->tpl_vars['edit']->value['typegiaonhan']) {?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['typegiaonhanload']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'];?>
">
                                <?php echo $_smarty_tpl->tpl_vars['typegiaonhanload']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn'];?>

                            </option>
                        <?php
}
}
?>											
                    </select>
                </div>
            </div>
        <?php }?>
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
            <input type="submit" class="btn-save" onclick=" return SubmitFrom('checkForm','');"  value="Lưu"> 
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
