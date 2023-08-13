<?php
/* Smarty version 4.1.1, created on 2023-08-08 11:13:44
  from 'D:\wamp64\www\duan_demo\templates\tpl\users\changes.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_64d1c0f8bdbbc9_94996845',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0915dcf275175a4203c9bd319b2f7c0af8a9cac8' => 
    array (
      0 => 'D:\\wamp64\\www\\duan_demo\\templates\\tpl\\users\\changes.tpl',
      1 => 1578385540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64d1c0f8bdbbc9_94996845 (Smarty_Internal_Template $_smarty_tpl) {
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
        	<a>		
                Thay đổi mật khẩu 
            </a> 
        </li>
    </ul>
</div>
<div class="MainContent">
	<form name="allsubmit" id="frm" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    	<div class="form-group">
            <label class="col-sm-3 control-label">Mật khẩu cũ</label>
            <div class="col-sm-6">
            	<input type="password" name="pwold" id="pwold"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Mật khẩu mới</label>
            <div class="col-sm-6">
                <input type="password" name="password" id="password"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Xác nhận mật khẩu</label>
            <div class="col-sm-6">
            	<input type="password" name="password_conf" id="password_conf"/>
            </div>
        </div>
        <!-- Tâm - Thêm ngày 16 tháng 05 năm 2018 -->
        <div class="form-group">
            <label class="col-sm-3 control-label"> </label>
            <div class="col-sm-6">
            	<span style="color:red">(*) Mật khẩu phải có ít nhất 6 ký tự</span></br>
                 <span style="color:red">(*) Mật khẩu phải có ít nhất 1 ký tự thường hoặc ký tự in hoa hoặc ký tự số</span></br>
                 <span style="color:red">(*) Mật khẩu phải có ít nhất 1 ký tự đặc biệt</span>
            </div>
        </div>
        <!-- Tâm - Thêm ngày 16 tháng 05 năm 2018 -->
        <div class="col-xs-9 TextCenter"> 
            <input type="button" class="btn-save" onclick=" return CheckPass();"  value="Lưu"> 
        </div>
    </form>
</div>

<?php echo '<script'; ?>
 language="javascript">
function CheckPass(){
	var pwold = $('#pwold');
	var password = $('#password');
	var pwc = $('#password_conf');
	var pattern = /^(?=.*[a-zA-Z0-9])(?=.*[!@#\$%\^&\*])(?=.{6,})/; //Tâm - regularexpress
	if(pwold.val() == ""){
		alert('Vui lòng nhập vào mật khẩu mới.');
		pwold.focus();
		return false;
	}
	else if(password.val() == ""){
		alert('Vui lòng nhập vào mật khẩu mới.');
		password.focus();
		return false;
	}
	else if(password.val() != pwc.val()){
		alert('Xác nhận mật khẩu không đúng.');
		pwc.focus();
		return false;
	}
	else if(!pattern.test(password.val())){
		alert('Mật khẩu phải có ít nhất 6 ký tự, phải có ít nhất 1 ký tự thường hoặc ký tự in hoa hoặc ký tự số, phải có ít nhất 1 ký tự đặc biệt.');
		password.focus();
		return false;
	  }
	else{
		jQuery.post('<?php echo $_smarty_tpl->tpl_vars['path_url']->value;?>
/ajax/member.php',{pwold:pwold.val(),act:'changes'},function(data) {
			var obj = jQuery.parseJSON(data);
			 if(obj.status != ''){ //loi 
				 alert(obj.status);
				 pwold.focus();
				 return false;
			 }
			 else{
				document.allsubmit.submit();
			 }
		});	
	}
	
}
<?php echo '</script'; ?>
><?php }
}
