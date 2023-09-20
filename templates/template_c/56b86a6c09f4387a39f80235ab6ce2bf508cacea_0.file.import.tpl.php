<?php
/* Smarty version 4.1.1, created on 2023-09-20 15:08:30
  from 'D:\wamp64\www\duan_demo\templates\tpl\Kho-Nu-Trang-Tra-Ve-Import\import.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_650aa87e9ec153_78063658',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '56b86a6c09f4387a39f80235ab6ce2bf508cacea' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\Kho-Nu-Trang-Tra-Ve-Import\\import.tpl',
      1 => 1695197308,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650aa87e9ec153_78063658 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="breadcrumb">
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
	<form name="allsubmit" class="form-horizontal" id="frmEdit" action="" method="post" enctype="multipart/form-data">
    	<div class="form-group">
            <label class="col-sm-3 control-label">Chọn file excel (.xlsx)</label>
            <div class="col-sm-6">
                <input type="file" name="file" id="file" onchange="check_file_import();"/>
                <input type="hidden" name="abc123" /> 
            </div>
        </div>
        <div class="col-xs-9 TextCenter"> 
            <input type="submit" class="btn-save" onclick=" return SubmitImport();"  value="Lưu"> 
        </div>
    </form>    
</div>
<?php echo '<script'; ?>
>
function SubmitImport(){
    var file = $('#file');
	if (file.val() == '') {
		alert('Chọn file Excel (.xlsx)');
		file.focus();
		return false;
	}
	else{
		document.allsubmit.submit();
	}
}
<?php echo '</script'; ?>
><?php }
}
