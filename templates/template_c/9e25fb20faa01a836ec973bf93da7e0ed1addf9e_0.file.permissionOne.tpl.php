<?php
/* Smarty version 4.1.1, created on 2023-09-26 07:57:55
  from 'D:\wamp64\www\duan_demo\templates\tpl\permission\permissionOne.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_65122c939242d9_75542511',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '9e25fb20faa01a836ec973bf93da7e0ed1addf9e' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\permission\\permissionOne.tpl',
      1 => 1691973449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65122c939242d9_75542511 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="breadcrumb">
    <ul>
        <li>
        	<a href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <li>
        	<span>&raquo;</span>
        	<a title=" QUẢN LÝ ACCOUNT" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/users.php">		
                Phân Quyền User
            </a> 
        </li>
        <li>
        	<span>&raquo;</span>
        	<a>		
                <?php echo $_smarty_tpl->tpl_vars['viewuser']->value['username'];?>

            </a> 
        </li>
    </ul>
</div>
<div class="MainContent main-permission">
	<ul id="pmsHeader">
        <li class="pms-header" >
            <div class="col1"> Tên</div>
            <div class="col2"> Xem </div>	
            <div class="col2"> Thêm </div>
            <div class="col2"> Sửa</div>
            <div class="col2"> Xóa</div>
            <div class="col2"> Chuyển</div>
            <div class="col2"> Duyệt </div>
            <div class="col2"> Trả lại </div>
            <div class="col2"> Print & Export </div>
             <div class="col2"> Import </div>
            <div class="col2"> All </div>
        </li>

    </ul>
    <ul>
        <?php echo $_smarty_tpl->tpl_vars['viewListmenu']->value;?>

        <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['view']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
            <?php echo insert_getPmscheck(array('cid' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'], 'uid' => $_smarty_tpl->tpl_vars['uid']->value, 'name_vn' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name_vn']),$_smarty_tpl);?>
            <?php if ($_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['has_child'] == 1) {?>
                 <?php echo insert_getSubcategory(array('id' => $_smarty_tpl->tpl_vars['view']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['id'], 'uid' => $_smarty_tpl->tpl_vars['uid']->value),$_smarty_tpl);?>	
            <?php }?>
        <?php
}
}
?>
    </ul>
</div>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/fancybox/jquery.fancybox-1.3.1.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/fancybox/jquery.fancybox-1.3.1.css">

<?php echo '<script'; ?>
>
	$(document).ready(function() {
		$(".popupPms").fancybox();
	});
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	$(window).scroll(function () {
		if($(window).scrollTop() > 50) {
			$('#pmsHeader').addClass("pms-header-fix");
		}
		else{
			$('#pmsHeader').removeClass("pms-header-fix");
		}
	});
<?php echo '</script'; ?>
><?php }
}
