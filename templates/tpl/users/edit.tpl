<div class="breadcrumb">
    <ul>
        <li>
        	<a href="<!--{$path_url}-->/sources/main.php" title="trang chủ">
            	<i class="fa-home"></i>
            </a>    
        </li>
        <li>
        	<span>&raquo;</span>
        	<a title=" QUẢN LÝ ACCOUNT" href="<!--{$path_url}-->/sources/users.php">		
                <!--{$smarty.request.act}--> 
            </a> 
        </li>
    </ul>
</div>

<div class="MainContent">
    <form class="form-horizontal" name="allsubmit" id="frm" action="<!--{$path_url}-->/sources/users.php?act=<!--{if $smarty.request.act eq 'add' }-->addsm<!--{else}-->editsm<!--{/if}-->" method="post" enctype="multipart/form-data">
    	<div class="form-group">
            <label class="col-sm-3 control-label">Họ và Tên</label>
            <div class="col-sm-6">
                <input type="text" value="<!--{$edit.fullname}-->" name="fullname"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Tên đăng nhập</label>
            <div class="col-sm-6">
                 <input type="text" value="<!--{$edit.username}-->" name="username" id="username"/>
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
            	<input type="text" value="<!--{$edit.email}-->" name="email"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Địa chỉ</label>
            <div class="col-sm-6">
                <textarea name="address"><!--{$edit.address}--></textarea>     
            </div>
        </div>
        
        <div class="col-xs-9 TextCenter"> 
        	<input type="hidden" value="<!--{$edit.id}-->" name="id"/>
        	<input type="button" class="btn-save" onclick="CheckPass();" value="Lưu" />
        </div>
    </form>    
</div>

<script language="javascript">
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
	<!--{if $smarty.request.act eq 'add' }-->
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
	<!--{else }-->
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
	<!--{/if}-->
	<!--{if $edit.id eq ''}-->
	$.post('<!--{$path_url}-->/ajax/member.php',{username:username.val(),table:'admin'},function(data) {
	<!--{else}-->
	$.post('<!--{$path_url}-->/ajax/member.php',{username:username.val(),table:'admin',id:<!--{$edit.id}-->},function(data) {
	<!--{/if}-->
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
</script>