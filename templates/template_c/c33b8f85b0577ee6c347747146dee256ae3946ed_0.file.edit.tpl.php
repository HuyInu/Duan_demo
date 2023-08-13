<?php
/* Smarty version 4.1.1, created on 2023-08-09 08:07:44
  from 'D:\wamp64\www\duan_demo\templates\tpl\users\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d2e6e06b28f5_80038391',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c33b8f85b0577ee6c347747146dee256ae3946ed' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\users\\edit.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64d2e6e06b28f5_80038391 (Smarty_Internal_Template $_smarty_tpl) {
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
                <?php echo $_REQUEST['act'];?>
 
            </a> 
        </li>
    </ul>
</div>

<div class="MainContent">
    <form class="form-horizontal" name="allsubmit" id="frm" action="<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/sources/users.php?act=<?php if ($_REQUEST['act'] == 'add') {?>addsm<?php } else { ?>editsm<?php }?>" method="post" enctype="multipart/form-data">
    	<div class="form-group">
            <label class="col-sm-3 control-label">Họ và Tên</label>
            <div class="col-sm-6">
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['fullname'];?>
" name="fullname"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Tên đăng nhập</label>
            <div class="col-sm-6">
                 <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['username'];?>
" name="username" id="username"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Mật khẩu</label>
            <div class="col-sm-6">
                <input type="password" name="password" id="password" class="InputText" />     
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Xác nhận mật khẩu</label>
            <div class="col-sm-6">
                <input type="password" name="password_conf" id="password_conf"/>
            </div>
        </div>

      	<div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-6">
            	<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['email'];?>
" name="email"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Địa chỉ</label>
            <div class="col-sm-6">
                <textarea name="address"><?php echo $_smarty_tpl->tpl_vars['edit']->value['address'];?>
</textarea>     
            </div>
        </div>
        
        <div class="col-xs-9 TextCenter"> 
        	<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['edit']->value['id'];?>
" name="id"/>
        	<input type="button" class="btn-save" onclick="CheckPass();" value="Lưu" />
        </div>
    </form>    
</div>

<?php echo '<script'; ?>
 language="javascript">
function CheckPass(){
	var username = $('#username');
	var password = $('#password');
	var password_conf = $('#password_conf');
	var pattern = /^(?=.*[a-zA-Z0-9])(?=.*[!@#\$%\^&\*])(?=.{6,})/; //Tâm - regularexpress
	if(username.val() == ""){
		alert('Vui lòng nhập tên đăng nhập.');
		username.focus();
		return false;
	}
	<?php if ($_REQUEST['act'] == 'add') {?>
		else if(password.val() == ""){
			alert('Vui lòng nhập vào mật khẩu.');
			password.focus();
			return false;
		}
		else if(password.val() != password_conf.val()){
			alert('Xác nhận mật khẩu không đúng.');
			password_conf.focus();
			return false;
		}
		else if(!pattern.test(password.val())){
			alert('Mật khẩu phải có ít nhất 6 ký tự, phải có ít nhất 1 ký tự thường hoặc ký tự in hoa hoặc ký tự số, phải có ít nhất 1 ký tự đặc biệt.');
			password.focus();
			return false;
		  }
	<?php } else { ?>
		 if(password.val() != ""){
			if(password.val() != password_conf.val()){
				alert('Xác nhận mật khẩu không đúng.');
				password_conf.focus();
				return false;
			}
			else if(!pattern.test(password.val())){
				alert('Mật khẩu phải có ít nhất 6 ký tự, phải có ít nhất 1 ký tự thường hoặc ký tự in hoa hoặc ký tự số, phải có ít nhất 1 ký tự đặc biệt.');
				password.focus();
				return false;
			  }	 
		 }
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['edit']->value['id'] == '') {?>
	$.post('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/ajax/member.php',{username:username.val(),table:'admin'},function(data) {
	<?php } else { ?>
	$.post('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/ajax/member.php',{username:username.val(),table:'admin',id:<?php echo $_smarty_tpl->tpl_vars['edit']->value['id'];?>
},function(data) {
	<?php }?>
		 var obj = jQuery.parseJSON(data);
		 if(obj.status != ''){
			 alert(obj.status);
			 return false;
		 }
		 else{ 
			document.allsubmit.submit();
		 }
	 
	});
}
<?php echo '</script'; ?>
><?php }
}
