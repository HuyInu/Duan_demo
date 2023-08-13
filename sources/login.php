<?php
include_once("../maininclude.php");
$act= isset($_GET["act"])?$_GET["act"]:'';
$str = array();
switch($act){
	case "log-out":
		$str = Logout();
		echo"<script type=\"text/javascript\">	
			parent.location.reload();
		</script>";
	break;	

	case "sm":
		$str = Login();
		$smarty->assign("msg",$str['msg']);
		$smarty->assign("pagelink",$str['page']);
		$template = "transfer.tpl";
	break;
	
	case "forgot":
		$template = "for-got-pw.tpl";
	break;
	
	case 'forgotsm':
		$str = ForgotPass();
		$smarty->assign("msg",$str['msg']);
		$smarty->assign("pagelink",$str['page']);
		$smarty->assign("err",$str['err']);
		$smarty->assign("err1","sendpw");
		$template = "for-got-pw.tpl";
	break;
	
	case 'resetpass':
		ResetPass();
		$tpl = 'resetpass';
	break;
	
	default:
		$template = "login.tpl";
	break;
}

$smarty->display($template);

function Logout(){
	global $path_url;
	unset($_SESSION['store_qlsxntjcorg_login']);
	unset($_SESSION['admin_qlsxntjcorg_username']);
	unset($_SESSION['group_qlsxntjcorg_user']);
	unset($_SESSION['admin_qlsxntjcorg_id']);
	
	$msg = "Đăng xuất thành công";             
	$page = $path_url."/index.php";             
	return(array ("msg" =>$msg,"page" =>$page));
}

function Login(){
	global $path_url;
	if(!isset($_SESSION['counter_artseed_login'])){
		$_SESSION['counter_artseed_login'] = 0;
	}
	if(!empty($_POST['security_code']) && $_POST['security_code'] == $_SESSION['codesecurity']){
		$_SESSION['codesecurity'] = '';
		$username = isset($_POST["username"])     ? $_POST["username"]     : '';
		$username =  addslashes(trim($username));
		$password = isset($_POST["password"])     ? $_POST["password"]     : '';
		$password = addslashes($password);
		$password = md5(md5($password));
		//-------------------------------------------------
		$sql_select = "select * from $GLOBALS[db_sp].admin  where username='$username' ";
		$result = $GLOBALS["sp"]->getRow($sql_select);
		
		if(!$result)
		{
			$_SESSION['counter_artseed_login']++;
			$msg = "Tên đăng nhập không đúng";
			$page = "index.php?do=login&error=1";
			return(array ("msg" =>$msg,"page" =>$page));
		}
		if(md5($password)!= $result["password"])
		{
			$_SESSION['counter_artseed_login']++;
			$msg = "Mật khẩu không đúng";
			$page = "index.php?do=login&error=1";
			return(array ("msg" =>$msg,"page" =>$page));
		}
		
		if(md5($password) == $result["password"] && $username == $result["username"] )
		{
			//session_register("store_qlsxntjcorg_login");
			$_SESSION["store_qlsxntjcorg_login"]    = "store_qlsxntjcorg_login";
			//session_register("admin_qlsxntjcorg_username");
			$_SESSION["admin_qlsxntjcorg_username"]    = $username;
			//session_register('group_qlsxntjcorg_user');
			$_SESSION['group_qlsxntjcorg_user'] = $result['group'];
			//session_register('admin_qlsxntjcorg_id');
			$_SESSION['admin_qlsxntjcorg_id'] = $result['id'];
			$msg = "Đăng nhập thành công.";
			$page = $path_url."/index.php";
			return(array ("msg" =>$msg,"page" =>$page));
		}
		
	}
	else{
		
		$_SESSION['counter_artseed_login']++;
		$msg = "Mã bảo vệ không đúng.";
		$page = "index.php?do=login&error=1";
		return(array ("msg" =>$msg,"page" =>$page));
		
	}
}
function ForgotPass()
{
	global $db,$act, $msg, $mail, $FullUrl, $path_url;
	$msg = "Email không tồn tại!";
	$err = "false";
	$sql = "select * from $GLOBALS[db_sp].admin where email='" . $_POST["email"] . "'";
	//die($sql);
	$r = $GLOBALS["sp"]->getRow($sql);
	if($r['email']){
		$body = file_get_contents('./forgot-password.html');
		$body = eregi_replace("[\]",'',$body);
		
		$password = rand (1,"1234567");
		$passwordsql = md5($password);
		$UserPw = "UsserName :".$r['username'] . " ; PassWord :" .$password ;
		
		$body = str_replace('[LINK]', $UserPw, $body);
		$mail->Subject    = "Forgot password admin";
		$mail->MsgHTML($body);
		$mail->AddAddress( $_POST["email"], "Ho Tro");
		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		  die();
		} else {
		 	$sql = "update $GLOBALS[db_sp].admin SET password='".$passwordsql."' where email='".$r['email']."'";
			$GLOBALS["sp"]->execute($sql);		
		}
		
	
		$msg = 'Email đã gửi đến bạn. Mời check mail để reset password!';
		$err = "true";
	}
	
	return(array ("msg" =>$msg,"page" =>$link,"err" => $err));
	
}
function ResetPass()
{
	global $db,$act, $msg, $new_pass, $path_url;
	$msg="Tài khoản này không tồn tại";
	$sql = "select * from admin where email='" . $_GET["email"] . "'";
	$r = $db->getRow($sql);
	if($r){
		if($r['password'] == $_GET['password']){
			
			$new_pass = time();
			$arr = array();
			$arr['password'] = md5($new_pass);
			vaUpdate('admin',$arr, "email='" . $_GET["email"] . "'");
			
			$msg = "Xin chào <strong>" . $r['username'] . "</strong> <br />Password mới của bạn là: <strong>$new_pass</strong> <br /> Bạn hãy đổi password ngay sau khi đăng nhập";
		}
	}
}
?>